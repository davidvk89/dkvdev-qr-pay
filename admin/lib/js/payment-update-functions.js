const paymentID = document.getElementById('paymentsID').name;
$.post("lib/paymentsUpdateHandler.php",
{
  id: paymentID
  
},
function(data, status){
  console.log("Data: " + data + "\nStatus: " + status);
  document.getElementById('paymentWindow').innerHTML = data;
})

setInterval(function () {
$.post("lib/paymentsUpdateHandler.php",
{
  id: paymentID
  
},
function(data, status){
  //DEBUG: console.log("Data: " + data + "\nStatus: " + status);
  document.getElementById('paymentWindow').innerHTML = data;
})
}, 10000);