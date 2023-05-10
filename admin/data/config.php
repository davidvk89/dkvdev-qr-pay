<?php
require('vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable('./../');
$dotenv->load();

$servername = $_ENV['servername'];
$db_username = $_ENV['db_username'];
$db_password = $_ENV['db_password'];
$db_name = $_ENV['database_name'];

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $db_name);


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

require("../lib/functions.php");
require('lib/controller-functions.php');

//load config
$query ="SELECT * FROM $company_config WHERE id = 1 ";
$fetch_config_stmt = $conn -> prepare($query);
$fetch_config_stmt -> execute();
$config_data = $fetch_config_stmt -> get_result();
$fetch_config_stmt -> close();

$config = mysqli_fetch_assoc($config_data);
?>