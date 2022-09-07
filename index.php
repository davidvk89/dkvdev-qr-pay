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
    <a href="admin/dashboard.php">
    <center><img id='homeBannerImage' src="images/<?=$config['banner'];?>" alt="" class="img-fluid" style="max-height: 500px;"></center>
    </a>
  </div>
</div>

<!--Content      -->
<div class="container">
  <div class="row">  
    <div class="col-12" id='content'>
      <h1 id="headerText"><?=$config['header'];?></h1>
      <br>
      <p id="headerDescription"><?=$config['header_text'];?></p>   
      <br>
    </div>
  </div>
      
  <div class="row">
      <div class="form-bg <?php if($config['info_state'] === 0){echo "col-md-12";}else{echo "col-md-6";} ?>">        
      <div id="paymentFormHeader">
            <h4 id='paymentFormHeaderContent'><i class="fa-solid fa-money-bill"></i> <i class="fa-brands fa-stripe"></i>  Betaal met QR-Pay</h4>
      </div>

        <form action="create-checkout-session.php" method="POST" id='custom-amount-form'>
          <h4 id='customFormHeader'>Kies een bedrag (&euro;):</h4>
            <input type="text" name="payment_amount" class="form-control" placeholder="bv: 7.50 of 10.00" id='custom-amount'>
            <br>
          <h4 id="customFormHeader">Extra:
            <input type="text" class="form-control" name="extra" placeholder="Extra vermeldingen">
            <br>
          <input type="submit" class="btn btn-info  btn-lg donate-button" id="payment_button" name='submit_payment' onclick="" value="Betalen">
        </form> 
      </div>
        

      <div class="col-md-6" id="infoHeader" style="<?php if($config['info_state'] === 0){echo "display: none;";}?>">
        <h4 id='infoHeaderContent'><i class="fa-solid fa-circle-info"></i> <?=$config['info_header'];?></h4>
        <br>
        <div id='infoSteps' style='width:95%; margin: 0 auto;'>
        <img src="images/<?=$config['info_image'];?>" alt="<?=$config['info_image_alt'];?>" class="img-responsive" style="max-height: 150px; float:right;">
        <br>
        
        <li id="infoStepOne"><?=$config['info_step_one'];?></li>
        <li id="infoStepTwo"><?=$config['info_step_two'];?></li>
        <li id="infoStepThree"><?=$config['info_step_three'];?></li>
        
        <center><a href="<?=$config['info_href'];?>"><button class="btn btn-info btn-lg" id='infoMore' style="margin: 2em;" ><?=$config['info_button_value'];?></button></a></center>
        </div>
      </div>
</div>

  <div style="<?php if($config['mailing_list_state'] === 0){echo"display: none;";}?>">
      <div class="col-12">
          <h4 id='moreHeader'><?=$config['mailing_list_header'];?></h4>
          <center><img src="images/<?=$config['mailing_list_image'];?>" alt="<?=$config['mailing_list_image_alt'];?>" class="img-fluid" style="max-height:180px; margin-top: 1em;"></center>
      </div>

      <div class="col-12">
            
            <p id='moreTalk' style='text-align: center;'><?=$config['mailing_list_text'];?></p>
            <form action="" method='post'>
              <input type="text" name='mailing_list_email' class='form-control' placeholder="mijn-email-adress@example.nl" id='mailingListEmail'>
              <br>
              </form>
              <center>
                <button class='btn btn-dark btn-lg' onclick="submitEmailToMailingList();"><?=$config['mailing_list_button'];?></button>
              </center>
              <br>
              <br>
            
        </div>
  </div>
</div>
      <center><img src="images/<?=$config['footer_image'];?>" alt="" class="img-fluid" style='max-height: 300px'></center>
    <footer>

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
