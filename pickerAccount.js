$(document).ready(function()
{
  $('.accept-order').click(function()
  {
    $(this).parent().parent().fadeOut();
  });

  $('form').submit(function(e)
  {
    //e.preventDefault();

    $val1 = $('.picker-name').val();
    $val2 = $('.accept-order').val();

    $.ajax({
           url : 'insertJob.php', // give complete url here
           type : 'POST',
           data : {picker: $val1, order: $val2},/*'picker='+$('.picker-name').val()+'&order='+$('.accept-order').val(),*/
           success : function(msg){
               alert('success');
           }
       });
       return false;
  });
});
