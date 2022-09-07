function submitEmailToMailingList(){
    let email = document.getElementById('mailingListEmail').value;
    $.post('lib/mailing_list_handler.php', {
      mailing_list_email: email
    },
    function(data, status){
      document.getElementById('moreTalk').innerHTML = data;
    });
  }