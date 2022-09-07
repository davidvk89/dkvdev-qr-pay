<form action="" method='post' enctype="multipart/form-data" style='width: 90%; margin: 0 auto; display: none;' id='settingsPaymentForm'>
    <br>
    <h3 id="moreHeader">Payment Settings:</h3>
      <p>Use this form to update your payment settings for QR-Pay.</p>
    <br>
    <label for=""><h4>Minimum payment amount:</h4></label>
            <select name="minimal_amount" id="" class="form-control">
    <?php
            for ($i = 1; $i <= 99; $i++) {
                echo "<option value='$i'>$i EUR</option>";
            }
    ?>
    </select>
    <br>
    <input type="submit" name="submit_payment_settings" class='btn btn-primary btn-lg' value="update payment settings">
    <br><br>
</form>