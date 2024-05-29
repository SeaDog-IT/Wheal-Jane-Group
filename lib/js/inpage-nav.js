var $j = jQuery.noConflict();
$j.fn.isInViewport = function() {
  var elementTop = $j(this).offset().top;
  var elementBottom = elementTop + $j(this).outerHeight();

  var viewportTop = $j(window).scrollTop() - 300;
  var viewportBottom = viewportTop + $j(window).height();

  return elementBottom > viewportTop && elementTop < viewportBottom;
};

$j(window).on('resize scroll', function() {
  $j('.inpage-section').each(function() {
      var activeColor = $j(this).attr('id');
    if ($j(this).isInViewport()) {
      $j('.nav-' + activeColor).addClass('active-link');
    } else {
      $j('.nav-' + activeColor).removeClass('active-link');
    }
  });
});