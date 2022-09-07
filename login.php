<?php
session_start();
ob_start();

require("data/config.php");
require("admin/data/objects/Config.php");
$my_config = new Config();

if(isset($_POST['login_submit'])){$my_config -> loginUser();}  
include("ui/header.html");?>
<body>
<div class="container">       
  <div class="row">    
      <div class="col-2"></div>
      <div class="col-8" id='content'>   
        <?php include("ui/forms/login.php");?>
      </div>      
      <div class="col-2"></div> 
  </div>
</div> 
   
<div class="row">
 <div class="col-12" id='footer'>
   <br><br>
   <h6 style="text-align: right;">©2022 <a href='https://dkvdev.com'>dkvdev.com</a>&nbsp; </h6>
  </div>
</div>
</body>
</html>