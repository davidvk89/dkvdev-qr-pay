<form action="" method='post' enctype="multipart/form-data" style='width: 90%; margin: 0 auto; display: none;' id='settingsContactForm'>
<h3 id="moreHeader">Contact Settings</h3>
<p>Manage your contact information.</p>
<label for="header"><h4>Header:</h4></label>
<input type="text" name='contact_header' class="form-control" value="<?=$my_config->contact_header;?>">
<br>
<label for="email"><h4>Email:</h4></label>
<input type="text" name='contact_email' class="form-control" value="<?=$my_config->contact_email;?>">
<br>
<label for="phone"><h4>Phone:</h4></label>
<input type="text" name="contact_phone" class="form-control" value="<?=$my_config->contact_phone;?>">
<br>
<label for=""><h4>Adress:</h4></label>
<input type="text" name="contact_adress" class="form-control" value="<?=$my_config->contact_adress;?>">
<br>
<input type="submit" name="contact_form_submit" class="btn btn-lg btn-primary" value='update contact information'>
<br><br>

</form>