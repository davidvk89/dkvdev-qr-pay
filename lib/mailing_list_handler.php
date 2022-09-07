<?php

require('../vendor/autoload.php');
require('functions.php');
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

date_default_timezone_set('UTC');
$servername = $_ENV['servername'];
$db_username = $_ENV['db_username'];
$db_password = $_ENV['db_password'];
$db_database = $_ENV['database_name'];
$table = $_ENV['company_mailing_list'];
$email = $_POST['mailing_list_email'];
// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $db_database);
// ANTI SQL INJECTION
$email = mysqli_real_escape_string($conn, $email);
$table = mysqli_real_escape_string($conn, $table);

// need to be Encrypted
$simple_string = $email;
// Store the cipher method
$ciphering = "AES-128-CTR";
// Use OpenSSl Encryption method
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
// Non-NULL Initialization Vector for encryption
$encryption_iv = '1234567891011121';
// Store the encryption key
$encryption_key = $_ENV['encryption_key'];
// Use openssl_encrypt() function to encrypt the data
$encryption = openssl_encrypt($simple_string, $ciphering,
			$encryption_key, $options, $encryption_iv);

$validEmailAdress = isEmailAdress($email);  //checks the submitted string for a @ and .
$valid = verifyEmail($table, $encryption);

if($valid){
    addEmailToList($table, $encryption);
}else{
    emailExists();
}

?>