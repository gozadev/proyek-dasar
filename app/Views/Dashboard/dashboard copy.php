<?= $this->extend('Template/main_template'); ?>
<?= $this->section('css'); ?>

<style>

  #register_form fieldset:not(:first-of-type) {
    display: none;
  }
</style>

</style>

<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<section class="section">
            
    <div class="card">
        <div class="card-header">
        <h4 class="card-title">Dashboard</h4>
        </div>
        <div class="card-body">
        <div class="container">
	<h2>Example: Multi Step Form using jQuery, Bootstrap and PHP</h2>		
	<div class="progress">
	<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
	</div>
	
	<form id="register_form" novalidate action="form_action.php"  method="post">	
	<fieldset>
	
	<h2>Step 1: Add Account Details</h2>
	<div class="form-group">
	<label for="email">Email address*</label>
	<input type="email" class="form-control" required id="email" name="email" placeholder="Email">
	</div>
	<div class="form-group">
	<label for="password">Password*</label>
	<input type="password" class="form-control" name="password" id="password" placeholder="Password">
	</div>
	<input type="button" class="next-form btn btn-info" value="Next" />
	</fieldset>	
	<fieldset>
	
	<h2> Step 2: Add Personal Details</h2>
	<div class="form-group">
	<label for="first_name">First Name</label>
	<input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name">
	</div>
	<div class="form-group">
	<label for="last_name">Last Name</label>
	<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name">
	</div>
	<input type="button" name="previous" class="previous-form btn btn-default" value="Previous" />
	<input type="button" name="next" class="next-form btn btn-info" value="Next" />
	</fieldset>
	
	<fieldset>
	<h2>Step 3: Add Contact Information</h2>
	<div class="form-group">
	<label for="mobile">Mobile*</label>
	<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number">
	</div>
	<div class="form-group">
	<label for="address">Address</label>
	<textarea  class="form-control" name="address" placeholder="Communication Address"></textarea>
	</div>
	<input type="button" name="previous" class="previous-form btn btn-default" value="Previous" />
	<input type="submit" name="submit" class="submit btn btn-success" value="Submit" />
	</fieldset>
	</form>
		

</div>	
         
           
        </div>
    </div>
</section>
                  <?= $this->endSection(); ?>
                  <?= $this->section('js'); ?>
<script>
 $(document).ready(function() {
  var form_count = 2; // Tentukan langkah yang ingin ditampilkan (misalnya langkah ke-3)
  var total_forms = $("fieldset").length;

  // Sembunyikan semua fieldset
  $("fieldset").hide();

  // Tampilkan hanya fieldset dengan indeks sesuai form_count
  $("fieldset:eq(" + (form_count - 1) + ")").show();

  setProgressBarValue(form_count);

  $(".next-form").click(function() {
    var current_form = $(this).parent();
    var next_form = current_form.next("fieldset");

    // Validasi untuk memastikan tidak melebihi jumlah total fieldset
    if (next_form.length > 0) {
      current_form.hide();
      next_form.show();
      form_count++;
      setProgressBarValue(form_count);
    }
  });

  $(".previous-form").click(function() {
    var current_form = $(this).parent();
    var prev_form = current_form.prev("fieldset");

    // Validasi untuk memastikan tidak kurang dari 1
    if (prev_form.length > 0) {
      current_form.hide();
      prev_form.show();
      form_count--;
      setProgressBarValue(form_count);
    }
  });

  function setProgressBarValue(value) {
    var percent = parseFloat(100 / total_forms) * value;
    percent = percent.toFixed();
    $(".progress-bar")
      .css("width", percent + "%")
      .html(percent + "%");
  }

  // Handle form submit and validation
  $("#register_form").submit(function(event) {
    var error_message = '';
    if (!$("#email").val()) {
      error_message += "Please Fill Email Address";
    }
    if (!$("#password").val()) {
      error_message += "<br>Please Fill Password";
    }
    if (!$("#mobile").val()) {
      error_message += "<br>Please Fill Mobile Number";
    }
    // Display error if any else submit form
    if (error_message) {
      $('.alert-success').removeClass('hide').html(error_message);
      return false;
    } else {
      return true;
    }
  });
});



</script>
<?= $this->endSection(); ?>
