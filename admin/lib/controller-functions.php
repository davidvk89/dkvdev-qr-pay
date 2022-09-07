<?php
    // update image settings functions for admin/settings.php
//--------------------------------------------------------------------------------------------------------------------------------------------------------\\
//update image queries
$update_banner_query                = "UPDATE $company_config SET banner = ? WHERE id = 1 ";
$update_info_image_query            = "UPDATE $company_config SET info_image = ? WHERE id = 1 ";
$update_mailing_list_image_query    = "UPDATE $company_config SET mailing_list_image = ? WHERE id = 1 ";
$update_footer_image_query          = "UPDATE $company_config SET footer_image = ? WHERE id = 1 ";

function updateBannerImage(){
    global $conn; global $update_banner_query;

     //DEBUG: echo"<h1>Executing banner upload</h1>";
      //banner image upload function
      $image_name = $_FILES['banner_image']['name'];
      $image_tmp = $_FILES['banner_image']['tmp_name'];
  
      if(empty($image_name)){
        echo "No file was selected..";
      }else{
  
        if(move_uploaded_file($image_tmp, "../images/$image_name")){
          $upd_banner_stmt = $conn ->prepare($update_banner_query);
          $upd_banner_stmt -> bind_param('s', $image_name);
          $upd_banner_stmt -> execute();
          $upd_banner_stmt -> close();
              echo "Banner image uploaded and updated!";
        }else{
          echo "cannot upload this image";
       }
  
         header("Location: settings.php");
      }
}

function updateInfoImage(){
    global $conn; global $update_info_image_query;

     //debug:    echo "<h1>Update Info Image executing..";
     $image_name = $_FILES['info_image']['name'];
     $image_tmp = $_FILES['info_image']['tmp_name'];
 
 if(empty($image_name)){
     echo "No file was selected..";
 }else{
 
     if(move_uploaded_file($image_tmp ,"../images/$image_name")){
         $upd_info_image_stmt = $conn ->prepare($update_info_image_query);
         $upd_info_image_stmt -> bind_param('s', $image_name);
         $upd_info_image_stmt -> execute();
         $upd_info_image_stmt -> close();
             echo "Info image uploaded and updated!";
     }else{
         echo "cannot upload this image";
     }
 }
}

function updateMailingListImage(){
    global $conn; global $update_mailing_list_image_query;

    //DEBUG: echo "<h1>Executing mailing list image update</h1>";
    //mailing list image upload function
    $image_name = $_FILES['mailing_list_image']['name'];
    $image_tmp = $_FILES['mailing_list_image']['tmp_name'];
  if(empty($image_name)){
    echo "No file was selected..";
  }else{
    if(move_uploaded_file($image_tmp ,"../images/$image_name")){
        $upd_mailing_list_image_stmt = $conn ->prepare($update_mailing_list_image_query);
        $upd_mailing_list_image_stmt -> bind_param('s', $image_name);
        $upd_mailing_list_image_stmt -> execute();
        $upd_mailing_list_image_stmt -> close();
            echo "Mailing list image uploaded and updated!";
    }else{
        echo "cannot upload this image";
    }
  }
}

function updateFooterImage(){
    global $conn; global $update_footer_image_query;

    //DEBUG: echo "<h1>Executing submit footer image</h1>";
    //footer image upload function
    $image_name = $_FILES['footer_image']['name'];
    $image_tmp = $_FILES['footer_image']['tmp_name'];
   
  if(empty($image_name)){
    echo "No file was selected..";
  }else{
    if(move_uploaded_file($image_tmp ,"../images/$image_name")){
        $upd_footer_image_stmt = $conn ->prepare($update_footer_image_query);
        $upd_footer_image_stmt -> bind_param('s', $image_name);
        $upd_footer_image_stmt -> execute();
        $upd_footer_image_stmt -> close();
            echo "Footer image uploaded and updated!";
    }else{
        echo "cannot upload this image";
    }
  }
}
//--------------------------------------------------------------------------------------------------------------------------------------------------------\\
function displayMailingListTable($company_mailing_list){
 global $conn;

// Store the cipher method
$ciphering = "AES-128-CTR";
// Use OpenSSl Encryption method
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
// Non-NULL Initialization Vector for encryption
$decryption_iv = '1234567891011121';
// Store the decryption key
$decryption_key = $_ENV['encryption_key'];

$query = "SELECT * FROM $company_mailing_list ";
$result = mysqli_query($conn, $query);

while($mailing_list = mysqli_fetch_assoc($result)){
    $email = $mailing_list['email'];
    $date = $mailing_list['date'];
    $state = $mailing_list['state'];

// Use openssl_decrypt() function to decrypt the data
$decryption=openssl_decrypt ($email, $ciphering, $decryption_key, $options, $decryption_iv);

    if($state == 1){
        $state = "subscribed";
    }else{
        $state = "unsubscribed";
    }

// Display the decrypted string
echo "<tr><td>" . $decryption . "</td><td>" . $date . "</td><td>" . $state . "</td></tr>";

}
}
?>