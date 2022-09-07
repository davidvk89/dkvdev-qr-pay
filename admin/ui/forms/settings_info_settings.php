<form action="" method='post' enctype="multipart/form-data" style='width: 90%; margin: 0 auto; display: none;' id='settingsInfoForm'>
<br>
<h3 id="moreHeader">Info Settings:</h3>
<p>Enable or disable the info widget and manage it's values.</p>
<br>
<label for="state"><h4>Widget state:</h4></label>
<select name="info_settings_state" id="" class="form-control">
    <?php 
    if($config['info_state'] === 1){
        echo "<option value='1'>Enabled</option>" . "<option value='0'>Disabled</option>";
    }else{
        echo "<option value='0'>Disabled</option>" . "<option value='1'>Enabled</option>" ;
    }?>
</select>
<br>
<label for="header"><h4>Header:</h4></label>
<input type="text" name='info_settings_header' class="form-control" value='<?=$my_config->info_header;?>'>
<br>
<label for="step_one"><h4>Step One:</h4></label>
<input type="text" name='info_step_one' class="form-control" value='<?=$my_config->info_step_one;?>'>
<br>
<label for="step_two"><h4>Step Two:</h4></label>
<input type="text" name='info_step_two' class="form-control" value='<?=$my_config->info_step_two;?>'>
<br>
<label for="step_three"><h4>Step Three:</h4></label>
<input type="text" name='info_step_three' class="form-control" value='<?=$my_config->info_step_three;?>'>
<br>
<label for="info_button">Info button value:</label>
<input type="text" name='info_button_value' class="form-control" value="<?=$my_config->info_button_value;?>">
<br>
<label for="href">Button link:</label>
<input type="text" name='info_href' class="form-control" value='<?=$my_config->info_href;?>'>
<br>
<center><input type="submit" class="btn btn-primary btn-lg" value='update info settings' name='info_settings_submit'></center>
<br><br>
</form>