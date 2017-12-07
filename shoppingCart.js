$(document).ready(function()
{

  $('form').submit(function(e)
  {
    e.preventDefault();

    var message = $(this).serialize();

    console.log(message);

    $.ajax({
           url : 'removeCart.php', // give complete url here
           type : 'POST',
           data : message,
           success : function(msg){
               //alert('success');
           }
       });
       return false;
  });
});