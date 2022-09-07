<?php
class Config{
//constructor
function __construct() {
    $this->getConfigValues();
    //basic options
    $this->setHeader(); $this->setHeaderText(); $this->setBanner(); $this->setThemeName();
    $this->setFooterImage(); $this->setFooterImageAlt();
    //payment options
    $this->setMinimalPaymentAmount();
    //contact options
    $this->setContactHeader(); $this->setContactEmail();$this->setContactPhone(); $this->setContactAdress();
    //info(widget) options
    $this->setInfoHeader(); $this->setInfoStepOne(); $this->setInfoStepTwo(); $this->setInfoStepThree();
    $this->setInfoImage(); $this->setInfoImageAlt();
    $this->setInfoButtonValue(); $this->setInfoHref();
    //Mailing list options
    $this->setMailingListState(); $this->setMailingListHeader(); $this->setMailingListText();
     $this->setMailingListButton(); $this->setMailingListImage(); $this->setMailingListImageAlt();
  }

//get methods
function getConfigValues(){
    global $conn;
    global $company_config;
    
    $query ="SELECT * FROM $company_config WHERE id = 1 ";
    $fetch_config_stmt = $conn -> prepare($query);
    $fetch_config_stmt -> execute();
    $config_data = $fetch_config_stmt -> get_result();
    $fetch_config_stmt -> close();
    $config = mysqli_fetch_assoc($config_data);
  
    $this -> configSettings = $config;
    
  }

//set methods
function setHeader(){
  $this->header = $this->configSettings['header'];
}

function setHeaderText(){
  $this->header_text = $this->configSettings['header_text'];
}

function setMinimalPaymentAmount(){
  $this->minimal_payment_amount = $this->configSettings['minimal_payment_amount'];
}

function setContactHeader(){
  $this->contact_header = $this->configSettings['contact_header'];
}

function setContactEmail(){
  $this->contact_email = $this->configSettings['contact_email'];
}

function setContactPhone(){
  $this->contact_phone = $this->configSettings['contact_phone'];
}

function setContactAdress(){
  $this->contact_adress = $this->configSettings['contact_adress'];
}

function setThemeName(){
    $this->theme = $this->configSettings['theme_name'];
}

function setBanner(){
    $this->banner = $this->configSettings['banner'];
}

function setInfoState(){
    $this->info_state = $this->configSettings['info_state'];
}

function setInfoHeader(){
    $this->info_header = $this->configSettings['info_header'];
}

function setInfoStepOne(){
    $this->info_step_one = $this->configSettings['info_step_one'];
}

function setInfoStepTwo(){
    $this->info_step_two = $this->configSettings['info_step_two'];
}

function setInfoStepThree(){
    $this->info_step_three = $this->configSettings['info_step_three'];
}

function setInfoImage(){
    $this->info_image = $this->configSettings['info_image'];
}

function setInfoImageAlt(){
    $this->info_image_alt = $this->configSettings['info_image_alt'];
}

function setInfoButtonValue(){
    $this->info_button_value = $this->configSettings['info_button_value'];
}

function setInfoHref(){
    $this->info_href = $this->configSettings['info_href'];
}

function setMailingListState(){
    $this->mailing_list_state = $this->configSettings['mailing_list_state'];
}

function setMailingListHeader(){
    $this->mailing_list_header = $this->configSettings['mailing_list_header'];
}

function setMailingListText(){
    $this->mailing_list_text = $this->configSettings['mailing_list_text'];
}

function setMailingListButton(){
    $this->mailing_list_button = $this->configSettings['mailing_list_button'];
}

function setMailingListImage(){
    $this->mailing_list_image = $this->configSettings['mailing_list_image'];
}

function setMailingListImageAlt(){
    $this->mailing_list_image_alt = $this->configSettings['mailing_list_image_alt'];
}

function setFooterImage(){
    $this->footer_image = $this->configSettings['footer_image'];
}

function setFooterImageAlt(){
    $this->footer_image_alt = $this->configSettings['footer_image_alt'];
}

//CRUD functions
function updateBasicSettings(){

  global $conn; global $company_config;

    $header = $_POST['basic_settings_header'];
    $text = $_POST['basic_settings_text'];
    $theme = $_POST['basic_settings_theme'];

      $stmt = $conn -> prepare("UPDATE $company_config SET header = ?, header_text = ?, theme_name = ? WHERE id = 1 ");
      $stmt -> bind_param('sss', $header, $text, $theme);
      $stmt ->execute();
      $stmt -> close();

        header("Location: settings.php");
}

function updateContactSettings(){
    
  global $conn;   global $company_config;

    $contact_header = $_POST['contact_header'];
    $contact_email = $_POST['contact_email'];
    $contact_phone = $_POST['contact_phone'];
    $contact_adress = $_POST['contact_adress'];

    $query = "UPDATE $company_config SET contact_header = ?, contact_email = ?, contact_phone = ?, contact_adress = ? WHERE id = 1 ";

      $stmt = $conn -> prepare($query);
      $stmt -> bind_param('ssss', $contact_header, $contact_email, $contact_phone, $contact_adress);;
      $stmt -> execute();
      $stmt-> close();

        header("Location: settings.php");
}

function updatePaymentSettings(){

  global $conn;   global $company_config;

  $minimum_payment_amount = $_POST['minimal_amount'];

  $query = "UPDATE $company_config SET minimal_payment_amount = ? WHERE id = 1 ";

    $stmt = $conn -> prepare($query);
    $stmt ->bind_param('i', $minimum_payment_amount);
    $stmt -> execute();
    $stmt -> close();

      header("Location: settings.php");
}

function updateInfoSettings(){
  global $conn;    global $company_config;

  $info_state = $_POST['info_settings_state'];
  $header = $_POST['info_settings_header'];
  $step_one = $_POST['info_step_one'];
  $step_two = $_POST['info_step_two'];
  $step_three = $_POST['info_step_three'];
  $button_value = $_POST['info_button_value'];
  $info_href = $_POST['info_href'];

  $query = "UPDATE $company_config SET info_state = ?, info_header = ?, info_step_one = ?, info_step_two = ?, info_step_three = ?, info_button_value = ?, info_href = ? WHERE id = 1 ";
  $stmt = $conn ->prepare($query);
  $stmt -> bind_param("issssss", $info_state, $header, $step_one, $step_two, $step_three, $button_value, $info_href);
  $stmt -> execute();
  $stmt -> close();
  
    header("Location: settings.php");
}

function updateMailingListSettings(){
  
  global $conn;   global $company_config;

  $mailing_list_state = $_POST['mailing_list_settings_state'];
  $mailing_list_header = $_POST['mailing_list_header'];
  $mailing_list_text = $_POST['mailing_list_text'];
  $mailing_list_button = $_POST['mailing_list_button'];

    $query = "UPDATE $company_config SET mailing_list_state = ?, mailing_list_header = ?, mailing_list_text = ?, mailing_list_button = ? WHERE id = 1 ";
    $stmt = $conn -> prepare($query);
    $stmt -> bind_param("isss", $mailing_list_state, $mailing_list_header, $mailing_list_text, $mailing_list_button);
    $stmt -> execute();
    $stmt -> close();

      header("Location: settings.php");

}

function loginUser(){
  global $conn;   global $company_users;

    $username = $_POST['account_name'];
    $password = $_POST['account_password'];

    $query = "SELECT * FROM $company_users WHERE user_id = 1";
    $result = mysqli_query($conn, $query);

    $query_data = mysqli_fetch_assoc($result);

    $verified = password_verify($password, $query_data['password']);
      if($verified){
        $_SESSION['access'] = "admin";
        header("Location: admin/dashboard.php");
      
      }else{
        echo "<p>Your login information does not match.. please try again or contact a system administrator.</p>";
      }
}

}

?>