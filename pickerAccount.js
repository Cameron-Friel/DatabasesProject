$(document).ready(function()
{
  var clicked;

  $('.accept-order').click(function()
  {
    $(this).parent().parent().fadeOut();
  });

  $('form').submit(function(e)
  {
    e.preventDefault();

    var message = $(this).serialize();

    console.log(message);

    $.ajax({
           url : 'insertJob.php', // give complete url here
           type : 'POST',
           data : message,
           success : function(msg){
               //alert('success');
           }
       });
       return false;
  });
});
