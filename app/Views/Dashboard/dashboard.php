<?= $this->extend('Template/main_template'); ?>
<?= $this->section('css'); ?>

<style>


</style>

<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<section class="section">
            
    <div class="card">
        <div class="card-header">
        <h4 class="card-title">5 Step SIM-EPK</h4>
        </div>
        <div class="card-body row">
            <div class="col-12">
                <img src="<?=base_url('public/assets/static/images/dashboard/stepb.png')?>"  class="rounded  mx-auto d-block img-fluid" alt="...">
            </div>
           
       
               
        </div>
    </div>
</section>
<section class="section">
            
    <div class="card">
        <div class="card-header">
        <h4 class="card-title">Hasil kesimpulan</h4>
        </div>
        <div class="card-body row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <img src="<?=base_url('public/assets/static/images/dashboard/1.png')?>"  class="rounded mb-2 img-fluid" alt="...">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <img src="<?=base_url('public/assets/static/images/dashboard/2.png')?>" class="rounded mb-2 img-fluid" alt="...">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <img src="<?=base_url('public/assets/static/images/dashboard/3.png')?>" class="rounded mb-2 img-fluid " alt="...">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
                <img src="<?=base_url('public/assets/static/images/dashboard/4.png')?>"  class="rounded mb-2 img-fluid" alt="...">  
            </div>
       
               
        </div>
    </div>
</section>
<?= $this->endSection(); ?>
<?= $this->section('js'); ?>
<script>
 $(document).ready(function() {
 



});



</script>
<?= $this->endSection(); ?>
