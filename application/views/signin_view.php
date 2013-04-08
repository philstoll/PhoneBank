<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Phone From Home - Sign In</title>
<link rel="stylesheet" href="http://stollsoftware.com/css/reset.css" />
<link rel="stylesheet" href="http://stollsoftware.com/css/text.css" />
<link rel="stylesheet" href="http://stollsoftware.com/css/960.css" />
</head>

<body style="background-color: #DDDEDE;">
<div style="background-color: #404CC9; border-bottom: solid 2px black; color: white;">
	<div class="container_16">
	<br />
	<h1>Mitch Richards - State Representive - MO 47th District</h1>
	<h2>Phone From Home</h2>
	</div>
</div>
<br />
<div class="container_12">
<div class="grid_12">
<h3>Phone From Home Sign In</h3>
</div>
<div class="clear"></div>
<div class="grid_1">
<b>Username:</b><br />
<b>Password:</b>
</div>
<?php echo form_open('signin') ?>
<div class="grid_3">
<?php echo form_input('txtUsername') ?> <br />
<?php echo form_password('txtPassword') ?>
</div>
<div class="clear"></div>
<div class="grid_4 prefix_1">
<?php echo validation_errors(); ?>

<?php echo form_submit('btnSignIn', 'Sign in') ?>
</div>
</div><!-- End .container_16 -->





<?php echo form_close() ?>

</body>
</html>