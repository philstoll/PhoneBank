<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Phone From Home - First Time Sign In</title>
<link rel="stylesheet" href="http://stollsoftware.com/css/reset.css" />
<link rel="stylesheet" href="http://stollsoftware.com/css/text.css" />
<link rel="stylesheet" href="http://stollsoftware.com/css/960.css" />
<style>
ul.noindent
{
    list-style-type: none;
    margin: 0;
	padding: 0;
}

ul.noindent li {
list-type: none;
margin: 0;
padding: 2px 0 2px 0;
text-align: right;
}

ul.noindent2
{
    list-style-type: none;
    margin: 0;
	padding: 0;
}

ul.noindent2 li {
list-type: none;
margin: 0;
padding: 0;
}
</style>
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
<h3>First Time Sign In</h3>
<p>Please enter your name and change from the default password.</p>
</div>
<div class="clear"></div>
<div class="grid_2">
<ul class="noindent">
	<li>First Name:</li>
	<li>Last Name:</li>
	<li>New Password:</li>
	<li>Confirm Password:</li>
</ul>
</div>
<?php echo form_open('credentials') ?>
<div class="grid_3">
<ul class="noindent2">
	<li><input type="text" name="txtFirstName" value="<?php echo set_value('txtFirstName'); ?>" /></li>
	<li><input type="text" name="txtLastName" value="<?php echo set_value('txtLastName'); ?>" /></li>
	<li><?php echo form_password('txtPassword') ?></li>
	<li><?php echo form_password('txtConfirmPassword') ?></li>
</ul>

</div>
<div class="clear"></div>
<div class="grid_4 prefix_2">
<?php echo validation_errors(' ', '<br />'); ?>
<?php echo form_hidden('hddnUserId', $userid) ?>

<?php echo form_submit('btnSubmit', 'Submit') ?>
</div>
</div><!-- End .container_16 -->





<?php echo form_close() ?>

</body>
</html>