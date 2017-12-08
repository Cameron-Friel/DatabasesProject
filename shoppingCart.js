$(document).ready(function()
{
  $('check').submit(function(e)
  {
    e.preventDefault();

    var message = $(this).serialize();

    console.log(message);
    //this ajax call posts what was in the forum when the button is hit
    $.ajax({
           url : 'checkout.php', // give complete url here
           type : 'POST',
           data : message,
           success : function(msg){
               //alert('success');
           }
       });
      location.reload();
      return false;
  });
  $('form').submit(function(e)
  {
    e.preventDefault();

    var message = $(this).serialize();

    console.log(message);
    //this ajax call posts what was in the forum when the button is hit
    $.ajax({
           url : 'removeCart.php', // give complete url here
           type : 'POST',
           data : message,
           success : function(msg){
               //alert('success');
           }
       });
      location.reload();
      return false;
  });
});