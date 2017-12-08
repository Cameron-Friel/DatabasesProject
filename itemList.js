
//THIS FILE CALLS AJAX TO POST TO PHP
$(document).ready(function()
{

  $('form').submit(function(e)
  {
    e.preventDefault();

    var message = $(this).serialize();

    console.log(message);

    $.ajax({
           url : 'addToCart.php',
           type : 'POST',
           data : message,
           success : function(msg){
               //alert('success');
           }
       });
       return false;
  });
});