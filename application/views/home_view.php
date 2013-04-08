<?php 

$this->load->helper('html');

$data['NoAnswer'] = array(
		'name'        => 'main_choice',
		'id'          => 'rbtnNoAnswer',
		'value'       => 'rbtnNoAnswer',
		'checked'     => FALSE,
);

$data['VM'] = array(
		'name'        => 'sub_1',
		'id'          => 'VoiceMail',
		'value'       => 'rbtnVoiceMail',
		'checked'     => FALSE,
);

$data['Answer'] = array(
		'name'        => 'main_choice',
		'id'          => 'Answer',
		'value'       => 'rbtnAnswer',
		'checked'     => FALSE,
);

$data['Positive'] = array(
		'name'        => 'sub_2',
		'id'          => 'rbtnPositive',
		'value'       => 'rbtnPositive',
		'checked'     => FALSE,
);

$data['Neutral'] = array(
		'name'        => 'sub_2',
		'id'          => 'rbtnNeutral',
		'value'       => 'rbtnNeutral',
		'checked'     => FALSE,
);

$data['Negative'] = array(
		'name'        => 'sub_2',
		'id'          => 'rbtnNegative',
		'value'       => 'rbtnNegative',
		'checked'     => FALSE,
);

$data['WrongNumber'] = array(
		'name'        => 'sub_2',
		'id'          => 'rbtnWrongNumber',
		'value'       => 'rbtnWrongNumber',
		'checked'     => FALSE,
);

$data['Help'] = array(
		'name'        => 'sub_2',
		'id'          => 'rbtnHelp',
		'value'       => 'rbtnHelp',
		'checked'     => FALSE,
);

$data['Other'] = array(
		'name'        => 'sub_2',
		'id'          => 'rbtnOther',
		'value'       => 'rbtnOther',
		'checked'     => FALSE,
);

$data['Comment'] = array(
		'name'        => 'txtComment',
		'id'          => 'txtComment',
		'value'       => 'Enter Comment...',
		'cols'        => '37',
		'rows'		  => '8',
);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<title>Phone Banking Home Page</title>
<link rel="stylesheet" href="http://stollsoftware.com/css/reset.css" type="text/css" />
<link rel="stylesheet" href="http://stollsoftware.com/css/text.css" type="text/css" />
<link rel="stylesheet" href="http://stollsoftware.com/css/960.css" type="text/css" />
<script src="http://code.jquery.com/jquery-1.8.2.min.js" type="text/javascript"></script>
<style type="text/css">

label.number
{
    color: #404CC9;
}

label.link
{
    color: #404CC9;
    text-decoration:underline;
    cursor: hand; 
    cursor: pointer;
}

a, a:visited
{
	color: #404CC9;
}

p.error
{
	color: red;
	font-weight: bold;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
	$('#txtComment').focus(function() {
		if ($('#txtComment').val() == 'Enter Comment...') {
			$('#txtComment').val('');
        }
	  });
	$('#txtComment').blur(function() {
		if ($('#txtComment').val() == '') {
			$('#txtComment').val('Enter Comment...');
        }
	  });
	$('#Answer').click(function() {
		  $('#VoiceMail').prop('checked', false);
	  });
	  $('#rbtnPositive').click(function() {
		  $('#Answer').prop('checked', true);
		  $('#VoiceMail').prop('checked', false);
	  });
	  $('#rbtnNeutral').click(function() {
		  $('#Answer').prop('checked', true);
		  $('#VoiceMail').prop('checked', false);
	  });
	  $('#rbtnNegative').click(function() {
		  $('#Answer').prop('checked', true);
		  $('#VoiceMail').prop('checked', false);
	  });
	  $('#rbtnWrongNumber').click(function() {
		  $('#Answer').prop('checked', true);
		  $('#VoiceMail').prop('checked', false);
	  });
	  $('#rbtnHelp').click(function() {
		  $('#Answer').prop('checked', true);
		  $('#VoiceMail').prop('checked', false);
	  });
	  $('#rbtnOther').click(function() {
		  $('#Answer').prop('checked', true);
		  $('#VoiceMail').prop('checked', false);
	  });
	  $('#VoiceMail').click(function() {
		  $('#rbtnNoAnswer').prop('checked', true);
		  $('#rbtnPositive').prop('checked', false);
		  $('#rbtnNeutral').prop('checked', false);
		  $('#rbtnNegative').prop('checked', false);
		  $('#rbtnWrongNumber').prop('checked', false);
		  $('#rbtnHelp').prop('checked', false);
		  $('#rbtnOther').prop('checked', false);
	  });
	  $('#rbtnNoAnswer').click(function() {
		  $('#rbtnPositive').prop('checked', false);
		  $('#rbtnNeutral').prop('checked', false);
		  $('#rbtnNegative').prop('checked', false);
		  $('#rbtnWrongNumber').prop('checked', false);
		  $('#rbtnHelp').prop('checked', false);
		  $('#rbtnOther').prop('checked', false);
	  });
	  $('#lblHide').click(function() {
		  $('#instructions').hide();
		  $('#lblShow').text('Show Instructions');
		  
	  });
	  $('#lblShow').click(function() {
		  if ($('#lblShow').text() == 'Show Instructions') {
			  	$('#instructions').show();
				$('#lblShow').text('Hide Instructions');
	        }
		  else {
			  	$('#instructions').hide();
				$('#lblShow').text('Show Instructions');
		  }
			  
	  });
	});
</script>

</head>

<body style="background-color: #DDDEDE;">
<div style="background-color: #404CC9; border-bottom: solid 2px black; color: white;">
	<div class="container_16">
	<br />
	<h1>Mitch Richards - State Representive - MO 47th District</h1>
	<h2>Phone From Home</h2>
	</div>
</div>

<div class="container_16">
<div class="grid_16" style="text-align: right;">
<p>Welcome <?php echo $user_name ?>! <?php echo nbs(2) ?> <label class="link" id="lblShow">Show Instructions</label> | <?php echo anchor('logout', 'Logout', 'title="Logout"'); ?></p>
<?php echo $error ?>
</div>
<div class="clear"></div>
<div id="instructions" class="grid_8" <?php if(!$instructions){ echo 'style="Display: None;"'; }?> >
<b style="font-size: 20px;">Instructions</b> <label class="link" id="lblHide">(Click Here to Hide)</label>
<p>
Below this section, on the left, you will see your next phone number to call and a list of all names/family members associated with that number. Next to it is a script to follow when making the call. Below the script are some of Mitch's positions so you can confirm if asked.
</p>
<p>
After completing the call there is a <b>Call Results</b> section on the right side of the page. 
Please check the option that best describes the result of the call (i.e. Positive / Confirmed Voter, Neutral / Undecided, Negative / Do not call again, Left a voicemail, No Answer,  etc). 
There is also room to leave a 255 character comment. After filling out this section, click the <b>Save and Next</b> button to save the result and load the next number.
</p>
<p>
Please remember to be polite, courteous, and professional while on calls. There is no need to spend time arguing with or trying to persuade people who are strongly against us. Thank them for their time and move on to the next caller.
</p>
<p>
If you have any issues, questions, and/or suggestions, please contact Phil Stoll at <a href="mailto:philstoll@gmail.com" target="_blank" >philstoll@gmail.com</a>.
</p>
<hr />
</div>
<div class="clear"></div>

<div class="grid_4">
	<b>Caller Info</b> 
	<div style="font-size: 20px;"><label class="number" id="lblPhone" ><?php echo '(' . substr($phone_number, 0, 3) . ') ' . substr($phone_number, 3, 3) . '-' . substr($phone_number, 6, 4) ; ?></label></div>   
<br />
	<?php foreach ($callers as $caller):?>

	<?php echo $caller->FirstName . ' ' . $caller->LastName . br(1);?>
			
	<?php endforeach;?>
	
</div>

<div class="grid_7">
	<b>Script</b>
	<p>
		Hi. My name is <?php echo $user_name ?> and I'm a volunteer with Mitch Richards' campaign for MO State Representative in the 47th district. Is [voter] home?
	</p>
	<p>
		[If YES] I know how busy we all are, but November is approaching and this election is crucial. May I have 2 minutes of your time?
	</p>
	<ul>
		<li>Mitch has spent years passionately fighting for limited government, economic freedom, civil liberties, and property rights.</li>
		<li>Our State is simply not creating enough jobs. 1 in 6 Missourians is on government aid.</li>
		<li>As a small business owner, Mitch Richards knows what it takes to survive in this economy. He
wants to cut income taxes, ease regulations on businesses, and get unnecessary government out
of the way.</li>
		<li>Together we can confront the challenges our state faces.</li>
	</ul>
	<p>
		[Hard ask] Can we count on your support on election day?
	</p>
	<p>
		[If YES] Thank you for your support. Would you like to volunteer?
	</p>
	<p>
		[If UNDECIDED/NO] Thank you for your time. If you have questions, you can learn more about Mitch at MitchRichards.com
	</p>
	<b>If asked Mitch is:</b>
	<ul>
		<li>Pro-Life</li>
		<li>Pro Second Amendment</li>
		<li>Pro Free Market</li>
		<li>Learn more about Mitch at <a href="http://mitchrichards.com" target="_blank">MitchRichards.com</a></li>
	</ul>
	
</div>
<!-- end .grid_5 -->

<div class="grid_5">
	<b>Call Results</b><br /> 
	<?php echo form_open('home') ?>
	
	<?php echo form_radio($data['NoAnswer']) . ' ' . form_label('No Answer / No voter home', 'lblNoAnswer') . br(1); ?>
	<?php echo nbs(8) . form_radio($data['VM']) . ' ' . form_label('Left Voicemail', 'lblVM') . br(2); ?>
	<?php echo form_radio($data['Answer']) . ' ' . form_label('Answered', 'lblAnswer') . br(1); ?>
	<?php echo nbs(8) . form_radio($data['Positive']) . ' ' . form_label('Positive', 'lblPositive') . br(1); ?>
	<?php echo nbs(8) . form_radio($data['Neutral']) . ' ' . form_label('Neutral', 'lblNeutral') . br(1); ?>
	<?php echo nbs(8) . form_radio($data['Negative']) . ' ' . form_label('Negative / Do not call again', 'lblNegative') . br(1); ?>
	<?php echo nbs(8) . form_radio($data['WrongNumber']) . ' ' . form_label('Wrong Number', 'lblWrongNumber') . br(1); ?>
	<?php echo nbs(8) . form_radio($data['Help']) . ' ' . form_label('Wants to help campaign', 'lblHelp') . br(1); ?>
	<?php echo nbs(8) . form_radio($data['Other']) . ' ' . form_label('Other', 'lblOther') . br(2); ?>
	<?php echo form_textarea($data['Comment']); ?>
	
	<?php echo form_submit('btnSave', 'Save and Next') ?>
	
	<?php echo form_hidden('hddnPhoneId', $phone_id) ?>
	<?php echo form_close() ?>
</div>
<!-- end .grid_4 -->





</div>
</body>
</html>