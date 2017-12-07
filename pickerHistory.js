$(document).ready(function()
{
  $('.No').click(function()
  {
    if ($(this).hasClass('Yes'))
    {

    }
    else
    {
      $(this).removeClass('No');
      $(this).addClass('Yes');
      $(this).html('Yes');
      $(this).toggle();
      $(this).fadeIn('slow');
    }
  });

  $('form').submit(function(e)
  {
    e.preventDefault();

    var message = $(this).serialize();
    console.log(message);

    $.ajax({
           url : 'insertSignature.php', 
           type : 'POST',
           data : message,
           success : function(msg){
               //alert('success');
           }
       });
       return false;
  });
});
