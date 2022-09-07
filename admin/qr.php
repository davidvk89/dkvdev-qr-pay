<?php
session_start();
ob_start();


require("data/config.php");
if($_SESSION['access'] !== 'admin'){
  header('Location: ../login.php');
}

include("ui/header.html"); //HTML head.
                                      ?>
<body>


<?php
include "ui/navbar.html";?>

<div class="row">
  <h1 id='infoHeaderContent'>QR code:</h1>
  <div class="col-sm-2 col-md-4"></div>
  <div class="col-sm-8 col-md-4">
    <h3 id="moreHeader">Page QR:</h3>
    
    <center><div class="img-fluid" id='qrcode' style='margin: 0 auto;'></center>
    
    <p style="text-align: center; "><a href="../index.php"><?="$domain";?></a></p>
    <p class='text-white bg-success' style='text-align: justify: padding: 12px;'>Print this QR code and have costumers scan it to visit your payment page.</p>
    <p class='text-black bg-warning' style='text-align: justify; padding: 12px;'>Right click the QR code and select Save image as, rename it to a name of your choosing.
              <br> Or select "Open image in new tab" and print directly from your browser!</p></div>
    
    <!-- <h3 id="moreHeader">Generate a payment QR:</h3> -->

  </div>
  <div class="col-sm-2 col-md-4"></div>
  

  
</div>
<?php include('ui/footer.php');?>

<?php 
if(isset($_SESSION['lang'])){
  $language = $_SESSION['lang'];

  switch($language){
      case "ENG";
      echo "<script>translateENG();</script>";
      break;
      
      case "NL";
      echo "<script>translateNL();</script>";
      break;
      
      case "FR";
      echo "<script>translateFR();</script>";
      break;
      }
} ?>
</body>
</html>

<div id="qrcode"></div>
<script type="text/javascript">
new QRCode(document.getElementById("qrcode"), "<?=$domain;?>");
</script>