(function ($) {
  $.fn.autoScroll = function (options) {
    var defaults = {
      speed: 50,
      direction: 'up'
    };
    var settings = $.extend({}, defaults, options);

    return this.each(function () {
      var $this = $(this);
      var $ul = $this.find('ul');
      var $li = $ul.find('li');

      $ul.css({ position: 'absolute', top: 0 });

      var liHeight = $li.first().outerHeight(true);
      var ulHeight = $ul.outerHeight();

      $ul.append($ul.html());

      var scrolling = true;

      var scroll = function () {
        if (scrolling) {
          var top = parseInt($ul.css('top')) - 1;
          $ul.css('top', top);

          if (Math.abs(top) >= ulHeight) {
            $ul.css('top', 0);
          }
        }
      };

      var intervalId = setInterval(scroll, settings.speed);

      $this.hover(
        function () { scrolling = false; },
        function () { scrolling = true; }
      );
    });
  };
})(jQuery);

// Initialize the auto-scrolling
$(document).ready(function () {
  $('#ticker01').autoScroll();
});


let classAdded = false;

window.addEventListener('scroll', function () {
  const element = document.getElementById('myElement');
  const classToAdd = 'bg-megenta';

  if (window.scrollY > 0 && !classAdded) {
    element.classList.add(classToAdd);
    classAdded = true;
  } else if (window.scrollY === 0 && classAdded) {
    element.classList.remove(classToAdd);
    classAdded = false;
  }
});
