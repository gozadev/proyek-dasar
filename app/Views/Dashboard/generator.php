<?= $this->extend('Template/main_template'); ?>

<?= $this->section('content'); ?>
<form action="<?=base_url('generator/generate')?>" class="" method="post">
<section class="section">
            
  <div class="card">
     <div class="card-header">
        <h4 class="card-title">CRUD Generator</h4>
      </div>
      <div class="card-body row">
         
          <div class="col-4">
            <div>
              <label for="dbname">Database Name</label>
              <input type="text" class="form-control" id="dbname" readonly value="<?= $databaseName?>" >  
            </div>

            <div class="mt-3">
              <label for="dbname">Nama Controller dan Model</label>
              <input type="text" class="form-control" id="nmcm" name="nmcm" placeholder="Nama Controller dan Model" >  
            </div>
          </div>
          <div class="col-4">
            <div>
              <h6>Pilih Nama Tabel</h6>
              <fieldset class="form-group">
                <select class="form-select" id="gettables" name="table" >
                  <option value="">Silahkan Pilih</option>          
                </select>
              </fieldset>
            </div>  
            <div>
            <div class="form-group">
                      <label for="nmview">Nama View</label>
                      <small class="text-muted">contoh.<i>user atau buat folder User/ViewUser</i></small>
                      <input type="text " list="data-folder-view" class="form-control" id="nmview" name="nmview">
                        <?php 
                          // Path ke direktori 'view' dalam aplikasi CodeIgniter 4
                            $viewDirectory = APPPATH . 'Views/';

                            // Menggunakan scandir untuk mendapatkan daftar nama folder di dalam 'view'
                            $folders = array_filter(scandir($viewDirectory), function ($item) use ($viewDirectory) {
                                return is_dir($viewDirectory . $item) && !in_array($item, ['.', '..']);
                            });
                        ?>
                      <datalist id="data-folder-view">
                        <?php foreach($folders as $fd): ?>
                          <option value="<?=$fd?>/">
                        <?php endforeach ?>
                        
                      </datalist>
                    </div>
            </div>  
            
            
          </div>
          <div class="col-4">  
          <div> 
              <label for="primary-key">Primary Key</label>
              <input type="text" class="form-control" id="primary-key" name="primary-key" readonly>      
              <div>              
                <div class="mt-3">
                  <button class="btn btn-danger mt-3 btn-generate" type="button"> Generate</button>
                </div>
              </div>             
          </div>
        </div>

     <?= session()->getTempdata('item'); ?>

</section>

<section class="section">
            
  <div class="card">
     <div class="card-header">
        <h4 class="card-title">CRUD Generator</h4>
      </div>
      <div class="card-body field">
       
      
      </div>
  </div>
</section>
</form>
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
    <script>
      $(document).ready(function () {

       $.ajax({
                type: "post",
                url: '<?=base_url("generator/gettable")?>',
               
                dataType: "json",
                success: function (response) {
                  let htmltag = '<option value="">Silahkan Pilih</option>'
                  $('#gettables').attr('disabled', false);
                  $.each(response, function(k, v) {
                    htmltag += '<option value="'+v+'">'+v+'</option>'
                      
                  });
                  $('#gettables').html(htmltag)
                }
              });
          
     

        $('#gettables').change(function (e) { 
        
            if($("#gettables option:selected" ).text() != 'Silahkan Pilih'){
                $.ajax({
                  type: "post",
                  url: '<?=base_url("generator/getkeytable")?>',
                  data: {
                    gettable : $(this).val()
                  },
                  dataType: "json",
                  success: function (response) {
                     $('#primary-key').val(response)
                  }
                });
            }else{
              $('#primary-key').val("")
            }
            
          });


          $('.btn-generate').click(function (e) { 
              let dbname = $('#dbname').val();
              let tbname = $('#gettables').val();
              let primary = $('#primary-key').val();
              let nmcm = $('#nmcm').val();

              if(dbname === '' || tbname === ''|| primary === ''||nmcm === ''){
                  alert('kosong')
              }else{
                $.ajax({
                  type: "post",
                  url: '<?=base_url("generator/getfieldtable")?>',
                  data: {
                    tbname : tbname
                  },
                  dataType: "json",
                  success: function (response) {          
                    $('.field').html(response);
                  }
                });
              }
            
          });

          $(document).on('click', '.btn-remove', function(){  
            let id = $(this).data('id');
              $("."+id+"").remove();
          });


      });
    </script>
<?= $this->endSection(); ?>