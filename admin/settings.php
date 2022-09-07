<?php
session_start();
ob_start();


require("data/config.php");
if($_SESSION['access'] !== 'admin'){
  header('Location: ../login.php');
}
require('data/objects/Config.php');
$my_config = new Config();
  // $my_config form handlers to execute on form submits.
if(isset($_POST['basic_settings_submit'])){$my_config->updateBasicSettings();}
if(isset($_POST['contact_form_submit'])){$my_config->updateContactSettings();}
if(isset($_POST['submit_payment_settings'])){$my_config->updatePaymentSettings();}
if(isset($_POST['info_settings_submit'])){$my_config->updateInfoSettings();}

include("ui/header.html"); //HTML head.
?>
<body>
<?php
include "ui/navbar.html";?>

<div class="row">

<h1 id="moreHeader">QR-Pay Settings</h1>
<div class="col-md-4">
<p><a href="#" onclick='toggleSettingsBasicForm();'>Basic settings</a></p>
<p><a href="#" onclick="toggleSettingsContactForm();">Contact Settings</a></p>
<p><a href="#" onclick='toggleSettingsPaymentForm();'>Payment settings</a></p>
<p><a href="#" onclick='toggleSettingsInfoForm();'>Info settings</a></p>
<p><a href="#" onclick='toggleSettingsMailingListForm();'>Mailing list settings</a></p>
<p><a href="#" onclick='toggleSettingsImagesForm();'>Images</a></p>
</div>
<div class="col-md-7">
  <center>
  <?php 
  require('ui/forms/settings_basic_settings.php');
  require('ui/forms/settings_contact_settings.php');
  require('ui/forms/settings_payment_settings.php');
  require('ui/forms/settings_info_settings.php');
  require('ui/forms/settings_mailing_list.php');
      // image updating form handlers
  if(isset($_POST['submit_mailing_list_settings'])){$my_config->updateMailingListSettings();}
  if(isset($_POST['submit_banner_image'])){updateBannerImage();}
  if(isset($_POST['submit_info_image'])){updateInfoImage();}
  if(isset($_POST['submit_mailing_list_image'])){updateMailingListImage();}
  if(isset($_POST['submit_footer_image'])){updateFooterImage();}

  require('ui/forms/settings_images.php');  ?>
  </center>
</div>
<div class="col-md-1"></div>
  <?php include('ui/footer.php');?>
</body>
</html>

<script src="ui/js/view-functions.js"></script>