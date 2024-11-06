
<?= $this->extend("Template/main_template"); ?>

<?= $this->section("css"); ?>
            
<style>
     /* Menggeser kolom pencarian ke sebelah kanan */
    .dataTables_wrapper .dataTables_filter {
        float: right;
    }
            
    /* Menyelaraskan teks "Search" dengan kolom pencarian dan memberikan jarak */
    .dataTables_wrapper .dataTables_filter label {
        display: flex;
        align-items: center;
    }
            
    /* Memberikan jarak di antara teks dan kolom pencarian */
    .dataTables_wrapper .dataTables_filter input[type="search"] {
        margin-left: 5px; /* Sesuaikan nilai margin sesuai dengan kebutuhan Anda */
    }
</style>

<?= $this->endSection(); ?>

<?= $this->section("title-content"); ?>
    <?="Quisoner"?>
<?= $this->endSection(); ?> 

<?= $this->section("content"); ?>

<section class="section">
            
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>
        <div class="card-body">
           
        <form action="<?= base_url('penilaian/store') ?>" method="post" id="form-store-quis">

              <?php helper("Quisioner") ?>
              <?php $no;  foreach($quis as $q) :?>     
                  <?php  if($q['jns'] == 'I'): ?>
                    <?php  if($q['Id_q'] <= 3): ?>
                      <div>  
                    <?php  else: ?>
                      <div class="not-required">  
                    <?php endif; ?> 
                    
                      <figure>
                        <?php $no = $q['Id_q'] ?>
                        <h4 ><?=$q['Id_q']?>. <?= $q['ur'] ?></h4>
                        <?php elseif($q['jns'] == 'Q'): ?>
                          <blockquote class="blockquote fw-bold text-body-emphasis">
                            <p><?= $q['ur'] ?></p>
                          </blockquote>
                          <?php elseif($q['jns'] == 'K'): ?>
                            <figcaption class="blockquote-footer fw-bold text-muted">
                              <cite title="Source Title"><?= $q['ur'] ?></cite>
                            </figcaption>
                      </figure>

                          <div data-group="<?=$q['Id_q']?>">
                      
                          <ul>
                          <div class="row">
                              <input type="hidden" id="radio_value_<?=$q['Id_q'] ?>" value="<?=($dataOne->jb == '-') ? '0' : explode(',', $dataOne->jb)[$no - 1] ?>" name="radio_value[]">                        
                            <div class="col">
                      <?php foreach(getIndikator($q['Id_q']) as $qm): ?>
                            <li>                         
                            <label class="d-block">
                                  <input type="radio" name="radio_<?=$qm['qm'] ?>" value="<?=$qm['Id_q'] ?>" <?=($dataOne->jb == '-') ? '' : ((explode(',', $dataOne->jb)[$no - 1] == $qm['Id_q']) ? "checked" : "") ?>  >            
                                  <?= $qm['ur'] ?>
                            </label>       
                           
                              <div class="col">
                              <div class="container text-center">
                              <div class="row row-cols-auto">
                               
                                  <div class="col"> <span><?=$qm['nl'] ?></span></div>
                                  <div class="col"><input type="range" id="range_<?=$qm['Id_q'] ?>" min="<?=$qm['nl'] ?>" max="<?=$qm['nmx'] ?>" value="<?=($dataOne->jb == '-') ? '0' : ((explode(',', $dataOne->jb)[$no - 1] != $qm['Id_q'] ) ? '0': explode(',', $dataOne->nljb)[$no - 1])?>" > </div>
                                  <div class="col"> <span><?=$qm['nmx'] ?></span></div>   
                               
                                                   
                              </div>
                            </div>  
                              </div>                
                          </li>
                          <?php endforeach; ?>
                          </div>

                            

                          <div class="col d-flex justify-content-center align-items-center">
                            <div>
                              <div>
                              <h4>Nilai </h4>
                              </div>
                              <div class="border border-secondary border-4 rounded text-center">
                
                                  <h1 id="nilai_<?=$q['Id_q'] ?>"><?=($dataOne->jb == '-') ? '0' : explode(',', $dataOne->nljb)[$no - 1] ?></h1>
                                  <input type="hidden" id="nilai_save_<?=$q['Id_q'] ?>" value="<?=($dataOne->jb == '-') ? '0' : explode(',', $dataOne->nljb)[$no - 1] ?>" class="nilai" name="nilai[]">      
                              </div>
                            </div>
                           
                           
                          </div>
                        </div>
                     
                        </ul>          
                          </div>
                          </div>
                  <?php endif; ?> 
               
              
              <?php endforeach; ?>
          
      
    </div>

    <div  class="position-fixed bottom-0 end-0 m-3">

        <div>
              <h5>Nilai Rata-rata: <span class="rata-nilai">0</span></h5>
              <input type="hidden" class="rata-nilai" value="0" name="rata-nilai">
        </div>

        <div>
          <!-- Tombol pertama -->
          <button type="button" id="btn-simpan" class="btn btn-primary ">
                Simpan
            </button>
            <!-- Tombol kedua -->
            <button type="button" id="btn-kembali" class="btn btn-secondary ">
                Kembali
            </button>
        </div>
      
    </div>
    </form>
    



 </section>



                    
<?= $this->endSection(); ?>
<?= $this->section("js"); ?>
<script>
    $(document).ready(function () {
    
      if ('<?= $dataOne->jb ?>'!= '-'){

        if(parseFloat(<?=array_sum(explode(',', $dataOne->nljb,3))?>) < 21 ){
          $('.not-required').hide();
        }else{
          $('.not-required').show();
        }

        let rangeAktif = '<?= $dataOne->jb ?>'.split(',')
      
        $('input[type="range"]').prop('disabled', true)
        $('input[type="range"]').each(function(i) {
         // console.log($(this).attr('id'))
          if(rangeAktif.includes($(this).attr('id').replace('range_', ''))){

          $('#'+$(this).attr('id')+'').prop('disabled', false)
         
          }
        })

      }else{
        $('.not-required').hide();
 
        $('input[type="range"]').prop('disabled', true);
      }
      
    

      getSumNilai()


     // $('input[type="range"]').prop('disabled', true);
          // Event listener untuk setiap radio button
    $('input[type="radio"]').on('change', function() {
        // Ambil grup dari elemen yang dipilih menggunakan atribut data-group
        var group = $(this).closest('[data-group]').data('group');
        // Nonaktifkan semua range dalam grup yang sama
        $('div[data-group="' + group + '"] input[type="range"]').prop('disabled', true);
        // Aktifkan hanya range yang sesuai dengan radio button yang dipilih  
        $('#range_'+$(this).val()+'').prop('disabled', false);
        $('div[data-group="' + group + '"] input[type="range"]').val(0)
        $('#radio_value_'+group+'').val($(this).val());
     
        // Menampilkan Nilai Range
        $('#nilai_'+group+'').text($('#range_'+$(this).val()+'').val())
        $('#nilai_save_'+group+'').val($('#range_'+$(this).val()+'').val())
        //logika menampilkan nilai quisioner 4-7
        cekQuiser()
        getSumNilai()
    }); 

    //  // Event listener untuk input range
     $('input[type="range"]').on('input', function() {
      // Ambil ID dari input range
      var rangeId = $(this).attr('id');
      var group = $(this).closest('[data-group]').data('group');
      // Temukan radio button terkait dengan range ini
      var relatedRadio = $('input[type="radio"][value="' + rangeId.replace('range_', '') + '"]');

      $('#nilai_'+group+'').text($(this).val())
      $('#nilai_save_'+group+'').val($(this).val())


      cekQuiser()
      getSumNilai()
      
    });

    $('#btn-simpan').click(function (e) { 
      e.preventDefault();
      let quis ='<?= $dataOne->jb ?>'.split(',').slice(0, 3);

      if(quis.includes('0')){
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Ada Quisioner yang belum diisi, silahkan isi terlebih dahulu",
       
        });
      }else{
        Swal.fire({
          title: "Apa anda yakin ingin menilai?",

          text: "aaaaaaa dengan skor " + $('.rata-nilai').val(),
         
          showCancelButton: true,
          confirmButtonText: "Save",
          
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            $('#form-store-quis').submit();
          } 
        });
      }

    });

    $('#btn-kembali').click(function (e) { 
      e.preventDefault();
     

      Swal.fire({
          title: "Apa anda yakin ingin Kembali?",
          text: "Data yang anda masukkan sebelumnya tidak akan tersimpan",   
          showCancelButton: true,
          confirmButtonText: "Save",
          
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            window.history.back();
          } 
        });
     

    });


    });


// menjumlahkan nilai
function getSumNilai(){
  let total = 0
          // Iterasi setiap elemen dengan kelas 'nilai'
          $('.nilai').each(function(i) {
                // Ambil nilai dan tambahkan ke total
                total += parseFloat($(this).val());                   
            });
  $('.rata-nilai').text(Math.round(total / $('.nilai').length)).val(Math.round(total / $('.nilai').length));
  return total
}


// cek quisioner untuk menampilkan 4-7
function cekQuiser(){

  let avgNilai = ((parseFloat($('#nilai_save_1').val()) + parseFloat($('#nilai_save_2').val())) + parseFloat($('#nilai_save_3').val())) / 3
      if(parseFloat(avgNilai) < 21){
          $('.not-required').hide();
          $('.not-required h1').text('0');
          $('.not-required input[type="hidden"]').val(0);
          $('.not-required input[type="radio"]').prop('checked', false);
          $('.not-required input[type="range"]').prop('disabled', true).val(0);
        }else{
          $('.not-required').show();
        }
}

</script>
<?= $this->endSection(); ?>


