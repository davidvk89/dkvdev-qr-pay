const paymentID = document.getElementById('paymentsID').name;
$.post("lib/paymentsUpdateHandler.php",
{
  id: paymentID
},
function(data, status){
  document.getElementById('paymentWindow').innerHTML = data;
});
