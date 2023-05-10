<?php
require('vendor/autoload.php');
require('lib/functions.php');
$dotenv = Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

$servername = $_ENV['servername'];
$db_username = $_ENV['db_username'];
$db_password = $_ENV['db_password'];
$database_name = $_ENV['database_name'];
// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $database_name);


//THESE VARIABLES DEFINE THE TABLES THAT ARE MADE AND ITS VALUES!!!
    // change these values per use to the company that you want to generate a page for.
    $company = $_ENV['company'];
    $company_email = $_ENV['company_email'];
    $company_config = $_ENV['company_config'];
    $company_users = $_ENV['company_users'];
    $company_payments = $_ENV['company_payments'];
    $company_mailing_list = $_ENV['company_mailing_list'];
    $company_username = $_ENV['company_username'];
    $company_password = password_hash($_ENV['company_password'], PASSWORD_DEFAULT);
    $stripe_api = $_ENV['stripe_api'];
    $webhook_secret = $_ENV['webhook_secret'];
    $domain = $_ENV['domain'];
    $page_title = $_ENV['page_title'];
    
//INSTALLATION START

$db_table_name_verification = tableExists($company_config); //checks the db for the company it's configuration table

if(!$db_table_name_verification){   //executes when: no data is found -> creates the database table
 //echo "creating database ..!<br>"; 
 
 $query = "CREATE TABLE  $company_config (id INT(11) NOT NULL AUTO_INCREMENT , header VARCHAR(255) NOT NULL , header_text TEXT NOT NULL , minimal_payment_amount VARCHAR(2) NOT NULL , contact_header VARCHAR(255) NOT NULL , contact_email VARCHAR(255) NOT NULL , contact_phone VARCHAR(255) NOT NULL , contact_adress VARCHAR(255) NOT NULL , theme_name VARCHAR(255) NOT NULL , banner VARCHAR(255) NOT NULL,info_state INT (1) NULL, info_header VARCHAR(255) NULL, info_step_one VARCHAR(255) NULL, info_step_two VARCHAR(255) NULL, info_step_three VARCHAR(255) NULL, info_image VARCHAR(255) NULL, info_image_alt VARCHAR(255) NULL, info_button_value VARCHAR(255) NULL, info_href VARCHAR(255) NULL, mailing_list_state INT(1) NULL, mailing_list_header VARCHAR(255) NULL, mailing_list_text VARCHAR(255) NULL, mailing_list_button VARCHAR(255) NULL, mailing_list_image VARCHAR (255) NULL, mailing_list_image_alt VARCHAR(255) NULL, footer_image VARCHAR(255) null, footer_image_alt VARCHAR(255) NULL, PRIMARY KEY (id) ) ";
 $create_config_db = mysqli_query($conn, $query);
  
 if(!$create_config_db){sql_error();}
 
//TO-DO: ADD NEW INFO AND MAILING LIST VALUES TO DEFAULT INSERT.
 $query = "INSERT INTO $company_config (header, header_text, minimal_payment_amount, contact_header, contact_email, contact_phone, contact_adress, theme_name, banner, info_state, info_header, info_step_one, info_step_two, info_step_three, info_image, info_image_alt, info_button_value, info_href,mailing_list_state, mailing_list_header, mailing_list_text, mailing_list_button, mailing_list_image, mailing_list_image_alt, footer_image, footer_image_alt) VALUES ('$company', 'Betaal veilig en snel met iDEAL, bancontact of credit card!', '2', 'contact', '$company_email', 'xx xxx xxx xxx', 'Wageningen', 'default', 'dkvdevOnlinePayments.png', 1, 'Hoe het werkt:', 'Vul een bedrag in -> druk op Betalen', 'Selecteer je betalingsmethode', 'Voer de betaling uit', 'howitworksImage.png', 'Geld uitwisseling', 'Meer info', 'https://dkvdev.com/', 1, 'Nieuwsbrief', 'Op de hoogte blijven? Schrijf je in voor de nieuwsbrief!', 'aanmelden', 'rocketman.png', 'rocket man', 'letstalk.png', 'Mensen aan het vergaderen' ) ";
 $result = mysqli_query($conn, $query);
 
 if(!$result){
     sql_error();
 }

 //echo "Database created and inserted default values! <br>";
}else{        //database already exists -> does nothing
 //echo "config already exists!.<br>";
}

$db_table_name_verification = tableExists($company_users);  //checks the db for the user table for this company  
if(!$db_table_name_verification){     //executes when no result is found -> create table
    //echo "User table was not found.. creating!<br>";
    
    $query = "CREATE TABLE $company_users ( user_id INT(11) NOT NULL AUTO_INCREMENT , username VARCHAR(255) NOT NULL , password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY (user_id)) ";
    $create_users_db = mysqli_query($conn, $query);

 if(!$create_users_db){
     sql_error();
 }else{
     //echo "users table created!<br>";

     $query = "INSERT INTO $company_users (username, password, email) VALUES('$company_username' ,'$company_password' ,'$company_email' ) ";
     $create_users_db_insert_query = mysqli_query($conn, $query);
 if(!$create_users_db_insert_query){
     sql_error();
 }else{
     //echo "User created!<br>";
 }
 }

}else{  //table exists -> do nothing.
    //echo "user table was found! <br>";
}

$db_table_name_verification = tableExists($company_payments);    //check for payments table
if(!$db_table_name_verification){  //table was not found -> create payments table
    //echo "payments table was not found .. creating!<br>";
    $query = "CREATE TABLE $company_payments ( payment_id INT(11) NOT NULL AUTO_INCREMENT , payment_amount VARCHAR(255) NOT NULL , payment_data VARCHAR(255) NOT NULL, payment_status VARCHAR(255) NOT NULL, payment_time VARCHAR(255) NOT NULL, stripe_id VARCHAR(255) NOT NULL, PRIMARY KEY (payment_id)) ";
    $create_payment_db = mysqli_query($conn, $query);
 if(!$create_payment_db){
     sql_error();
 }else{
     //echo "payments table created!<br>";
 }
}else{
    //echo "payments table was found!<br>";  //table exists -> do nothing
}

$db_mailing_list_verification = tableExists($company_mailing_list);
if(!$db_mailing_list_verification){
    $query = "CREATE TABLE `dkvdev_mailing_list` ( `sub_id` INT(11) NOT NULL AUTO_INCREMENT , `email` VARCHAR(255) NOT NULL , `date` VARCHAR(255) NOT NULL , `state` INT(1) NOT NULL , PRIMARY KEY (`sub_id`)) ";
    $create_mailing_list_db = mysqli_query($conn, $query);
    if(!$create_mailing_list_db){
        sql_error();
    }
}

//INSTALLATION END

//start config
$query ="SELECT * FROM $company_config WHERE id = 1 ";
$fetch_config_stmt = $conn -> prepare($query);
$fetch_config_stmt -> execute();
$config_data = $fetch_config_stmt -> get_result();
$fetch_config_stmt -> close();

$config = mysqli_fetch_assoc($config_data);

//GET handlers
if(isset($_GET['status'])){   //cancels a payment if its conditions are met.
    if($_GET['status'] ==='cancelled')
    $cancelled_payment_id =mysqli_real_escape_string($conn, $_SESSION['payment_tracker']);
    $query = "UPDATE $company_payments SET payment_status = 'Mislukt' WHERE stripe_id = '$cancelled_payment_id' ";
    $cancelled_payment_query = mysqli_query($conn, $query);
    if(!$cancelled_payment_query){
      sql_error();
    }
  }
?>