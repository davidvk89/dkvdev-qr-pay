<?php
session_start();
ob_start();

require('data/config.php');   //this file holds all critical data and configuration settings
require('ui/header.html');
?>

<body>           
<!--Call to Action            -->
<div class="row">        
  <div class="col-12" id="banner">  
    <a href="index.php">
    <center><img id='homeBannerImage' src="images/<?=$config['banner'];?>" alt="" class="img-fluid" style="max-height: 500px;"></center>
    </a>
  </div>
</div>

<!--Content      -->
<div class="container">
  <div class="row">    
    <div class="col-2"></div>
    <div class="col-8" id='content'>
      <h1>Betaling geslaagd!</h1>
    
        </div>
    </div>
    <div class="col-2"></div>
</div>
</div>

    <footer>
<div class="container">
		<div class="row">

	
			<div class="col-xs-12" class='footerContactInfo'>
			<br><br>
			<h4><?=$config['contact_header'];?></h4>    
			<span id='footerContactInfo'><?=$config['contact_email'];?></span><br>
			<span id='footerContactInfo'><?=$config['contact_phone'];?></span><br>
			<span id='footerContactInfo'><?=$config['contact_adress'];?></span><br>
			</div>
      </div>
			<div class="col-12" class='copyright'>
				<br><br>
        <p>&copy <?= date("Y");?><a href="https://www.dkvdev.com" id='copyrightLink'>dkvdev.com</a></p>
			</div>
		</div>
	</div>
	</footer>

    
</body>
</html>
