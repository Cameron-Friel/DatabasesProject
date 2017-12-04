$(document).ready(function()
{
  $('.accept-order').click(function()
  {
    $(this).parent().parent().fadeOut();
  });

  $('form').submit(function(e)
  {
    //e.preventDefault();

    $.ajax({
           url : 'bin/insertJob.php', // give complete url here
           type : 'POST',
           data : 'picker='+$('.picker-name').val()+'&order='+$('.accept-order').val(),
           success : function(msg){
               alert('success');
           }
       });
       //return false;
  });
});
