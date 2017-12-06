$(document).ready(function()
{
  var index = 0;
  changeImage();

  function changeImage()
  {
    var i;
    const $images = $('.mySlides');

    for (var i = 0; i < $images.length; i++)
    {
      $images.eq(i).hide();
    }

    index++;

    if (index > $images.length)
    {
      index = 1;
    }
    $images.eq(index - 1).css("display", "block");
    setTimeout(changeImage, 2000);
  }
});
