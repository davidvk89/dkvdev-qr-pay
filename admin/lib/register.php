<?php

function checkAccountsDatabase()   {    //checks the database for availability of required tables.
    global $conn;
    $query = "SELECT * FROM accounts WHERE ACCOUNT_ID = 1 ";
    $result = mysqli_query($conn, $query);
      if($result){return true;}else{return false;}
  }

function isAccountNameAvailable($username){   //checks if the account name is already in use
  global $conn;
  $username = mysqli_real_escape_string($conn, $username);
  $query = "SELECT ACCOUNT_NAME FROM accounts WHERE ACCOUNT_NAME = '$username' ";
  $result = mysqli_query($conn, $query);
  $result = mysqli_num_rows($result);
  
  if($result === 0){return true;}else{return false;}
  }

function createAccountsTable(){       //creates the required table for account storage.
    global $conn;
    $query ="CREATE TABLE `accounts` ( `ACCOUNT_ID` INT(11) NOT NULL AUTO_INCREMENT , `ACCOUNT_NAME` VARCHAR(255) NOT NULL , `ACCOUNT_EMAIL` VARCHAR(255) NOT NULL , `ACCOUNT_PASSWORD` VARCHAR(255) NOT NULL , `ACCOUNT_API_KEY` VARCHAR(255) NOT NULL , `ACCOUNT_CURRENCY` INT(11) NOT NULL, `ACCOUNT_CHECKOUTS` INT(11) NOT NULL , `ACCOUNT_VIEWS` INT(11) NOT NULL , `API_STATUS` INT(11) NOT NULL, `IDEAL_ENABLED` INT(11) NOT NULL , PRIMARY KEY (`ACCOUNT_ID`)) ENGINE = InnoDB; ";
    $result = mysqli_query($conn, $query);
}

function createAccount($account_name, $account_email, $password_hash, $API_KEY, $checkouts, $views, $API_status, $ideal_enabled, $currency){ 
  global $conn;
      $query = "INSERT INTO accounts (ACCOUNT_NAME, ACCOUNT_EMAIL, ACCOUNT_PASSWORD, ACCOUNT_API_KEY, ACCOUNT_CHECKOUTS, ACCOUNT_VIEWS, API_STATUS, IDEAL_ENABLED, ACCOUNT_CURRENCY) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) ";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("ssssiiiii", $account_name, $account_email, $password_hash, $API_KEY, $checkouts, $views, $API_status, $ideal_enabled, $currency);
      $stmt->execute();
      $stmt->close();
   }

   function paymentPage_checkDatabase(){
    global $conn;
    
    $query = "SELECT * FROM payments_page_configuration WHERE page_id = 1 ";
    $result = mysqli_query($conn, $query);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
    function paymentPage_createDatabase(){
        global $conn;
    
        $query = "CREATE TABLE `payments_page_configuration` ( `page_id` INT(11) NOT NULL , `page_layout` INT(11) NOT NULL DEFAULT '1' , `page_font` VARCHAR(255) NULL DEFAULT NULL , `font_color` VARCHAR(255) NULL DEFAULT '#000000' , `page_title` VARCHAR(255) NULL DEFAULT 'Donations & Payments' , `page_header_font` VARCHAR(255) NULL DEFAULT NULL , `page_font_size` VARCHAR(255) NULL DEFAULT NULL , `page_background` VARCHAR(255) NULL DEFAULT NULL , `page_banner` VARCHAR(255) NULL DEFAULT NULL ,  `banner_status` INT(11) NOT NULL DEFAULT '0' ,`page_subject` VARCHAR(255) NULL DEFAULT NULL , `page_description` TEXT NULL DEFAULT NULL , `button_1` INT(11) NOT NULL DEFAULT '100' ,`button_1_status` INT(11) NOT NULL DEFAULT '1' , `button_2` INT(11) NOT NULL DEFAULT '200' , `button_2_status` INT(11) NOT NULL DEFAULT '1' , `button_3` INT(11) NOT NULL DEFAULT '500' , `button_3_status` INT(11) NOT NULL DEFAULT '1' , `button_4` INT(11) NOT NULL DEFAULT '1000' , `button_4_status` INT(11) NOT NULL DEFAULT '1' , `button_5` INT(11) NOT NULL DEFAULT '2000' ,`button_5_status` INT(11) NOT NULL DEFAULT '1' , `button_6` INT(11) NOT NULL DEFAULT '5000' , `button_6_status` INT(11) NOT NULL DEFAULT '1' , `custom_payment_button` INT(11) NOT NULL DEFAULT '50' , `custom_payment_button_status` INT(11) NOT NULL DEFAULT '1' , UNIQUE `page_id` (`page_id`)) ENGINE = InnoDB ";
        $result = mysqli_query($conn, $query);
        if(!$result){die("create table FAILED: " . mysqli_error($conn));}else{echo "created table!";}
        
        $query = "INSERT INTO payments_page_configuration (page_id) VALUES ( 1 ) ";
        $result = mysqli_query($conn, $query);
        if(!$result){die("default data insert failed FAILED: " . mysqli_error($conn));}else{echo "inserted data";}
    
    }

    function createPage($account_name){
      global $conn;
      $query = "SELECT ACCOUNT_ID FROM accounts WHERE ACCOUNT_NAME = ? ";
      $stmt = $conn -> prepare($query);
        $stmt -> bind_param("s",$account_name );
        $stmt -> execute();
      $result = mysqli_stmt_get_result($stmt);
        $stmt -> close();
      $data = mysqli_fetch_array($result);
      $db_id = $data['ACCOUNT_ID'];

      $query = "INSERT INTO payments_page_configuration (page_id) VALUES (?) ";
      $stmt2 = $conn -> prepare($query);
        $stmt2 -> bind_param("i", $db_id);
        $stmt2 -> execute();
        $stmt2 ->close();     
        
    }

 if(isset($_POST['register_submit'])){ 

    //check if the database table exists and create it if it doesnt
    $testAccountsTable = checkAccountsDatabase(); if(!$testAccountsTable){createAccountsTable();}
    $testPaymentsTable = paymentPage_checkDatabase(); if(!$testPaymentsTable){paymentPage_createDatabase();}

    
    //DATA collection
    $account_name = $_POST['account_name'];       //capture form data
    $account_email = $_POST['account_email'];
    $account_password = $_POST['account_password'];
    
    $API_KEY = "DEFAULT_UNSET";                   //additional (required) data for accounts table
    $checkouts = 0;
    $views = 0;
    $API_status = 0;
    $ideal_enabled = 0;
    $currency = 0;
   
    //hash password
    $password_hash = password_hash($account_password, PASSWORD_DEFAULT);

    // encrypt email
    $simple_string = $account_email;
    // Storingthe cipher method 
    $ciphering = "AES-128-CTR";
    // Using OpenSSl Encryption method 
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options   = 0;
    // Non-NULL Initialization Vector for encryption 
    $encryption_iv = '1234567891011121';
    // Storing the encryption key 
    $encryption_key = "Business-Secret-Change-This-ASAP";
    // Using openssl_encrypt() function to encrypt the data 
    $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
    $account_email = $encryption;

    // Encrypt account name
    $simple_string = $account_name;
    $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
    $account_name = $encryption;



    //validate the account name
    $test = isAccountNameAvailable($account_name);
    if($test){

    //Insert data into database 
    createAccount($account_name, $account_email, $password_hash, $API_KEY, $checkouts, $views, $API_status, $ideal_enabled, $currency);
    createPage($account_name);
    //get account id
    $query = "SELECT ACCOUNT_ID FROM accounts WHERE ACCOUNT_NAME = ? ";
    $get_acc_id_stmt = $conn ->prepare($query);
    $get_acc_id_stmt -> bind_param("s", $account_name);
    $get_acc_id_stmt -> execute();
    $acc_id_result = mysqli_stmt_get_result($get_acc_id_stmt);
    $acc_id_data = mysqli_fetch_array($acc_id_result);
    $account_id = $acc_id_data['ACCOUNT_ID'];

    if(mkdir("images/user/$account_id")){

      //Login user
      $_SESSION['username'] = $account_name;
      //redirect user to dashboard
      header("Location: admin/dashboard.php");
    }
  }
   
  if(!$test){
  switch($_SESSION['lang']){
      case "ENG";
      echo "Account name is already taken.";
      break;
        
      case "NL";
      echo "Account naam is al in gebruik.";
      break;
      
      case "FR";
      echo "Le nom de compte est déjà utilisé";
    }  
    
  }
 }
 

 ?>