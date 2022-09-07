var settingsBasicFormState = 0;         var settingsPaymentFormState = 0;   var settingsInfoFormState = 0;
  var settingsMailingListFormState = 0;   var settingsContactFormState = 0;   var settingsImagesFormState = 0;

function toggleSettingsBasicForm(){
  if(settingsBasicFormState === 0){
    //fade out other forms
    $('#settingsContactForm').fadeOut();
      settingsContactFormState = 0;
    $('#settingsPaymentForm').fadeOut();
      settingsPaymentFormState = 0;
    $('#settingsInfoForm').fadeOut();
      settingsInfoFormState = 0;
    $('#settingsMailingListForm').fadeOut();
      settingsMailingListFormState = 0;
    $('#settingsImagesForm').fadeOut();
      settingsImagesFormState = 0;

    //fade in selected form
    $('#settingsBasicForm').fadeIn();
    settingsBasicFormState = 1;
  }else{
    $('#settingsBasicForm').fadeOut();
    settingsBasicFormState = 0;
  }
}

function toggleSettingsContactForm(){
  if(settingsContactFormState === 0){
    //fade out other forms
    $('#settingsBasicForm').fadeOut();
      settingsBasicFormState = 0;
    $('#settingsPaymentForm').fadeOut();
      settingsPaymentFormState = 0;
    $('#settingsInfoForm').fadeOut();
      settingsInfoFormState = 0;
    $('#settingsMailingListForm').fadeOut();
      settingsMailingListFormState = 0;
    $('#settingsImagesForm').fadeOut();
      settingsImagesFormState = 0;

    //fade in the selected form
    $('#settingsContactForm').fadeIn();
    settingsContactFormState = 1;
  }else{
    $('#settingsContactForm').fadeOut();
    settingsContactFormState = 0;
  }
}

function toggleSettingsPaymentForm(){
  if(settingsPaymentFormState === 0){
    //fade out other forms
    $('#settingsBasicForm').fadeOut();
      settingsBasicFormState = 0;
    $('#settingsContactForm').fadeOut();
      settingsContactFormState = 0;
    $('#settingsInfoForm').fadeOut();
      settingsInfoFormState = 0;
    $('#settingsMailingListForm').fadeOut();
      settingsMailingListFormState = 0;
    $('#settingsImagesForm').fadeOut();
      settingsImagesFormState = 0;


    //fade in selected form
    $('#settingsPaymentForm').fadeIn();
    settingsPaymentFormState = 1;
  }else{
    $('#settingsPaymentForm').fadeOut();
    settingsPaymentFormState = 0;
  }
}

function toggleSettingsInfoForm(){
  if(settingsInfoFormState === 0){
    //fade out other forms
    $('#settingsBasicForm').fadeOut();
      settingsBasicFormState = 0;
    $('#settingsContactForm').fadeOut();
      settingsContactFormState = 0;
    $('#settingsPaymentForm').fadeOut();
      settingsPaymentFormState = 0;
    $('#settingsMailingListForm').fadeOut();
      settingsMailingListFormState = 0;
    $('#settingsImagesForm').fadeOut();
      settingsImagesFormState = 0;

    //fade in the selected form
    $('#settingsInfoForm').fadeIn();
    settingsInfoFormState = 1;
  }else{
    $('#settingsInfoForm').fadeOut();
    settingsInfoFormState = 0;
  }
}

function toggleSettingsMailingListForm(){
  if(settingsMailingListFormState === 0){
    //fade out other forms
    $('#settingsBasicForm').fadeOut();
      settingsBasicFormState = 0;
    $('#settingsContactForm').fadeOut();
      settingsContactFormState = 0;
    $('#settingsPaymentForm').fadeOut();
      settingsPaymentFormState = 0;
    $('#settingsInfoForm').fadeOut();
      settingsInfoFormState = 0;
    $('#settingsImagesForm').fadeOut();
      settingsImagesFormState = 0;

    //fade in the selected form
    $('#settingsMailingListForm').fadeIn();
    settingsMailingListFormState = 1;
  }else{
    $('#settingsMailingListForm').fadeOut();
    settingsMailingListFormState = 0;
  }
}

function toggleSettingsImagesForm(){
  if(settingsImagesFormState === 0){
  
  //fade out other forms
  $('#settingsBasicForm').fadeOut();
      settingsBasicFormState = 0;
  $('#settingsContactForm').fadeOut();
    settingsContactFormState = 0;
  $('#settingsPaymentForm').fadeOut();
    settingsPaymentFormState = 0;
  $('#settingsInfoForm').fadeOut();
    settingsInfoFormState = 0;
  $('#settingsMailingListForm').fadeOut();
    settingsMailingListFormState = 0;

    //fade in images form
    $('#settingsImagesForm').fadeIn();
      settingsImagesFormState = 1;
}else{
  $('#settingsImagesForm').fadeOut();
      settingsImagesFormState = 0;
}
}