<form action="" method='post' enctype="multipart/form-data" style='width: 90%; margin: 0 auto; display: none;' id='settingsBasicForm'>
  <h3 id="moreHeader">Basic Settings:</h3>
  <p>Use this form to update basic settings for your QR-Pay page.</p>
  <br>
  <label for="header"><h4>Header:</h4></label>
  <input type="text" class="form-control" value='<?=$my_config->header;?>' name='basic_settings_header'>
  <br>
  <label for="header_text"><h4>Header description</h4></label>
  <input type="text" name='basic_settings_text' class="form-control" value='<?=$my_config->header_text;?>'>
  <br>
  <label for="theme">Active theme:</label>
  <select name="basic_settings_theme" id="" class="form-control">
    <option value="default">default</option>
  </select>
  <br>
  <center><input type="submit" class="btn btn-primary btn-lg" value='Update Settings' name='basic_settings_submit'></center>
  <br><br>
</form>