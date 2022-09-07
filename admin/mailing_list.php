<?php
session_start();
ob_start();


require("data/config.php");
if($_SESSION['access'] !== 'admin'){
  header('Location: ../login.php');
}

include("ui/header.html"); //HTML head.
                                      ?>
<body>
<?php include "ui/navbar.html";?>

<div class="row">
    <h1 id='infoHeaderContent'>Mailing List</h1>
    <p>All email adresses that are actively signed up to your newsletter.</p>

    <h3>My mailing list:</h3>
    <div class="table-responsive">
  <table class="table">
    <thead>
        <th>Email:</th>
        <th>Sign up date:</th>
    </thead>
    <tbody>
        <?php   displayMailingListTable($company_mailing_list);  ?>
    </tbody>
  </table>
</div>

</div>
<?php include('ui/footer.php');?>

</body>
</html>

