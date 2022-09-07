<form action="" method='post' enctype="multipart/form-data" style='width: 90%; margin: 0 auto; display: none;' id='settingsMailingListForm'>
<h3 id="moreHeader">Mailing list Settings:</h3>
<p>Enable or disable the sign up widget. Or manage the text values for your application!</p>
<label for="state"><h4>Widget state:</h4></label>
<select name="mailing_list_settings_state" id="" class="form-control">
    <?php 
    if($config['mailing_list_state'] === 1){
        echo "<option value='1'>Enabled</option>" . "<option value='0'>Disabled</option>";
    }else{
        echo "<option value='0'>Disabled</option>" . "<option value='1'>Enabled</option>" ;
    }?>
</select>
<br>
<label for="header"><h4>Header:</h4></label>
<input type="text" name='mailing_list_header' class="form-control" value="<?=$my_config->mailing_list_header;?>">
<br>
<label for="header_text"><h4>Description:</h4></label>
<input type="text" name="mailing_list_text" class="form-control" value="<?=$my_config->mailing_list_text;?>">
<br>
<label for="button_value"><h4>Button value:</h4></label>
<input type="text" name='mailing_list_button' class="form-control" value="<?=$my_config->mailing_list_button;?>">
<br>
<input type="submit" name="submit_mailing_list_settings" class="btn btn-primary btn-lg" value='update mailing list settings'>
</form>