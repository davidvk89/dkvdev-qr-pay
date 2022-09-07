<?php
session_start();
ob_start();
require("data/config.php");
if($_SESSION['access'] !== 'admin'){
  header('Location: ../login.php');
}

include("ui/header.html"); //HTML head. ?>

<body>
<?php include "ui/navbar.html";?>
<div class="row">
  <form action="">
    <input id='paymentsID' type="text" name='<?=$company_payments;?>' style='display:none;'>
  </form>

  <div class="col-12" id="paymentFormHeader">
      <h1>Betalingen:</h1>
  </div>

    <div class="row" padding: 12px; id='paymentWindow'></div> 
  </div> 
  
<?php include('ui/footer.php');?>
</body>
</html>

<script src="lib/js/payment-update-functions.js"></script>