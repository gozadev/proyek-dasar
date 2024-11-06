<?= $this->extend('Template/main_template'); ?>

<?= $this->section('css'); ?>


<?= $this->endSection(); ?>

<?= $this->section('title-content'); ?>
<h3>Maintenance Mode</h3>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
     <!-- Basic Horizontal form layout section start -->
     <section id="basic-horizontal-layouts">
            <div class="row match-height">
              <div class="col-md-6 col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Set Mode Maintenance</h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      <form class="form form-horizontal" id="form-data-pribadi" >
                        <div class="form-body">
                          <div class="row">
                          
                          <div class="col-md-4">
                              <label for="first-name-horizontal">Mode Maintenance</label>
                            </div>
                            <div class="col-md-8 form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="switchmm" name="mm" value="ON" <?=$mode?>>
                                <label class="form-check-label" id="sts-label-mm" for="switchmm"></label>
                            </div>
                            <div class="col-md-12 mt-3 mb-3">
                              <label for="first-name-horizontal"><b> IP Address yang bisa akses aplikasi dengan mode maintenance contoh "192.168.1.1, 127.0.0.1"</b></label>
                            </div>
                            <div class="col-md-4">
                              <label for="first-name-horizontal">IP Address</label>
                            </div>
                            <div class="col-md-8 form-group">
                              <input type="text" class="form-control"name="ip" placeholder="IP ADDRESS" id="ipaddress" value="<?= $ip?>"/>
                            </div>
                            <div class="col-md-4">
                              
                            </div>
                            <div class="col-md-8 form-group">
                              <button type="button" class="btn btn-danger btn-sm" id="btn-daftar-ip">Daftarkan IP</button>
                            </div>
                  
                         
                   
                  
                          
                         
                            </form>
                           
                          </div>
                        </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Log aktivitas user </h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                 
                        <div class="form-body">
                          <div class="row data-log"  style="max-height: 400px; overflow-y: auto;">
                           
                          
                         
                       
                          
                            
                          

                          </div>
                        </div>
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- // Basic Horizontal form layout section end -->
<?= $this->endSection(); ?>

<?= $this->section('js'); ?>
<script>
   $(document).ready(function () {

        conn.onmessage = function(e) {
          // $('.data-log').append('<div class="alert alert-info" role="alert"> '+e.data+' </div>');
         
          if(e.data.includes("[USER]")){
           
              let infoClass = '';
            if(e.data.includes("login ke aplikasi")){
              infoClass = 'success'
            }else if(e.data.includes("mencoba login")){
              infoClass = 'warning'
            }
            else if(e.data.includes("berusaha login")){
              infoClass = 'danger'
            } else if(e.data.includes("logout")){
              infoClass = 'success'
            }
          
              // Data yang sudah ada dalam elemen target
                  let existingData = $('.data-log').html();

                  // Data baru yang akan ditambahkan
                  let newData = '<div class="alert alert-'+infoClass+'" role="alert">'+e.data+'. </div>';

                  // Gabungkan data baru dengan data yang sudah ada, sehingga data baru akan muncul di bagian atas
                  let updatedData = newData + existingData;

                  // Ganti isi elemen target dengan isi yang baru
                  $('.data-log').html(updatedData);
          
          }

        }

    
  
        if($('#switchmm').is(':checked')){
            $('#sts-label-mm').text('Aplikasi Sekarang dalam mode maintenance');
        }else{
            $('#sts-label-mm').text('Aplikasi Sekarang tidak dalam mode maintenance');
        }

        $('#switchmm').click(function() {
            // Menggunakan .prop() atau .is() untuk mendapatkan nilai checkbox saat diklik
            let isChecked = $(this).prop('checked');
            let status ='';
           // console.log(isChecked); // Output: true jika dicentang, false jika tidak dicentang

            if(isChecked){
                $('#sts-label-mm').text('Aplikasi Sekarang dalam mode maintenance');
                status = 'Y'
            }else{
                $('#sts-label-mm').text('Aplikasi Sekarang tidak dalam mode maintenance');
                status = 'T'
            }


            $.ajax({
                type: "post",
                url: '<?=base_url("maintenance/setmode")?>',
                data: {
                    status : status,
                    action : 'cmm' //change mode maintenance
                },success:function(res){
                    if(res =='berhasil'){
                        Toastify({text: "Mode pengguna berhasil diperbaharui", duration: 4000,style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                        },}).showToast();
                    }else{
                        Toastify({text: "Mode pengguna Gagal diperbaharui", duration: 4000,style: {
                           
                            background: "linear-gradient(to right, #b00000, #f5b0b0)",
                        },}).showToast();
                    }
                }
               
            });


        });

        $('#btn-daftar-ip').click(function() {
          
            $.ajax({
                type: "post",
                url: '<?=base_url("maintenance/setmode")?>',
                data: {
                    ip : $('#ipaddress').val(),
                    action : 'ip'
                },success:function(res){
                    if(res =='berhasil'){
                        Toastify({text: "Mode pengguna berhasil diperbaharui", duration: 4000,style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                        },}).showToast();
                    }else{
                        Toastify({text: "Mode pengguna Gagal diperbaharui", duration: 4000,style: {
                           
                            background: "linear-gradient(to right, #b00000, #f5b0b0)",
                        },}).showToast();
                    }
                }
               
            });
        });
   });
</script>
<?= $this->endSection(); ?>