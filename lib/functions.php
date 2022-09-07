<?php
//config functions
function tableExists($table_name){
    global $conn;

    $query = "SELECT * FROM $table_name ";
    $result = mysqli_query($conn, $query);

        if($result){
            return TRUE;
        }else{
            return FALSE;
        }
}

function sql_error(){
  global $conn;
 
  die('query failed : ' . mysqli_error($conn));
}

//


//mailing list functions
function isEmailAdress($email){
    $hasat = strpos($email ,'@');
    if(!$hasat){die('this is not a valid email adress');}
    $hasdot = strpos($email, ".");
    if(!$hasdot){die('this is not valid email adress');}
}

function verifyEmail($table, $email){     //verify email adress is not in use.
global $conn;
    $query = "SELECT sub_id FROM $table WHERE email = '$email' ";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);  //When count is not 0 a result has been found and registration must cancel!
        if($count === 0){return TRUE;        }else{return FALSE;}
}

function addEmailToList($table, $email){
global $conn;
  $date = date("d.m.y");
  $state = 1;

    $query = "INSERT INTO $table (email, date, state) VALUES(?, ?, ?) ";
    $stmt = $conn -> prepare($query);
    $stmt -> bind_param('ssi', $email, $date, $state);
    $stmt-> execute();
    $stmt -> close();

      echo 'You have subscribed to the newsletter!';
}

function emailExists(){
    echo "That email is already registered.";
}

?>