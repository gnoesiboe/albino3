/**
 * @type {Object}
 */
var smoothAnchor = (function() {

  /**
   * Initiates the event listeners for this object
   */
  var initEventListeners = function() {
    $('a').click(onLinkClick);
  };

  /**
   * Gets called when a link is clicked
   */
  var onLinkClick = function() {
    var href = $(this).attr('href');

    if (typeof href === 'undefined') {
      return true;
    }

    if (isAnchorLink(href) === false) {
      return true;
    }

    var $el = $(href);

    if ($el.length === 0) {
      return true;
    }

    $('html, body').animate({
      scrollTop: $el.offset().top
    }, 500, function() {
      location.anchor = href;
    });

    return true;
  };

  /**
   * @param {String} href
   * @returns {Boolean}
   */
  var isAnchorLink = function(href) {
    return href.match(/^#/) !== null;
  };

  // return public interface
  return {

    /**
     * Initiates this functionality
     */
    init: function() {
      initEventListeners();
    }
  }
})();

/**
 * @type {Object}
 */
var externalLinks = (function() {
  return {
    init: function() {
      $('a[rel="external"]').each(function() {
        $(this).attr('target', '_blank');
      });
    }
  }
})();

$(document).ready(function() {
  smoothAnchor.init();
  externalLinks.init();

  $('.jcarousel').jcarousel();

  $('.jcarousel-control-prev')
    .on('jcarouselcontrol:active', function () {
      $(this).removeClass('inactive');
    })
    .on('jcarouselcontrol:inactive', function () {
      $(this).addClass('inactive');
    })
    .jcarouselControl({
      target: '-=1'
    });

  $('.jcarousel-control-next')
    .on('jcarouselcontrol:active', function () {
      $(this).removeClass('inactive');
    })
    .on('jcarouselcontrol:inactive', function () {
      $(this).addClass('inactive');
    })
    .jcarouselControl({
      target: '+=1'
    });

  $('.jcarousel-pagination')
    .on('jcarouselpagination:active', 'a', function () {
      $(this).addClass('active');
    })
    .on('jcarouselpagination:inactive', 'a', function () {
      $(this).removeClass('active');
    })
    .jcarouselPagination();
});