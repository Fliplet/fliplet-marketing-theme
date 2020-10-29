$(function() {
  var screenChangeHeight = $(window).height();

  //initialize swiper when document ready
  var mySwiper = new Swiper('.swiper-container', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    speed: 400,
    grabCursor: true,
    centeredSlides: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    slidesPerView: 'auto',
    keyboard: {
      enabled: true,
    },
  });

  // Currency Swticher
  var $pounds = $('.price-in-pounds'),
    $euros = $('.price-in-euros'),
    $dollars = $('.price-in-dollars');

  function attachHandlers() {
    // learn more scroll down click
    $('.learn-more').click(function () {
      console.log("learn more clicked");
      $("html, body").animate({
        scrollTop: screenChangeHeight
      }, 500, "swing");
      return false;
    });

    // toggle opening the hamburger menu
    $('.menu-hamburger').on('click', function () {
      if ($('.menu-hamburger').hasClass('active')) {
        $('html').css({
          'overflow': 'auto'
        });
        $('.menu-hamburger').removeClass('active');
        $('.menu-overlay').removeClass('active');
        $('body').removeClass('active');
        $("#content.band").removeClass("disabled");
      } else {
        $('html').css({
          'overflow': 'hidden'
        });
        $('.menu-hamburger').addClass('active');
        $('.menu-overlay').addClass('active');
        $('body').addClass('active');
        $("#content.band").addClass("disabled");
      }
    });

    // Attach click listener to all cta and menu links
    $('.cta, .menu-item a, .nav-item a').on('click', function (e) {
      var label = ($(this).parent().hasClass('menu-item')) ? $(this).prop('title') : $(this).prop('id');
      window._gaq.push(['_trackEvent', 'Call To Action', 'Click Through', label]);
    });



    // Add classes `ga-event` to anything to track click events
    // Use data-event-category|action|label|value to set the attributes for the event
    // data-event-category and data-event-action attributes are required
    // data-event-value must be a number
    $(document).on('click', '.ga-event', function () {
      var category = $(this).attr('data-event-category');
      var action = $(this).attr('data-event-action');
      var label = $(this).attr('data-event-label');
      var value = $(this).attr('data-event-value');

      // Ensures category and action are both defined
      if (typeof category === 'string' && typeof action === 'string') {

        if (typeof label === 'string' && typeof value === 'string' && typeof parseInt(value, 10) === 'number') {
          window._gaq.push(['_trackEvent', category, action, label, parseInt(value, 10)]);
        } else if (typeof label === 'string') {
          window._gaq.push(['_trackEvent', category, action, label]);
        } else {
          window._gaq.push(['_trackEvent', category, action]);
        }

      }
    });
    $('#sales').on('click', function () {
      window._gaq.push(['_trackEvent', 'App Types', 'Sales Click', 'Sales']);
    });
    $('#events').on('click', function () {
      window._gaq.push(['_trackEvent', 'App Types', 'Events Click', 'Events']);
    });
    $('#reporting').on('click', function () {
      window._gaq.push(['_trackEvent', 'App Types', 'Reporting Click', 'Reporting']);
    });
    $('#projects').on('click', function () {
      window._gaq.push(['_trackEvent', 'App Types', 'Projects Click', 'Projects']);
    });
    $('#training').on('click', function () {
      window._gaq.push(['_trackEvent', 'App Types', 'Training Click', 'Training']);
    });
    $('#communication').on('click', function () {
      window._gaq.push(['_trackEvent', 'App Types', 'Communication Click', 'Communication']);
    });

    $('.subscribe-btn').on('click', function () {
      $('.subscribe-wrapper').addClass('pull-down');
    });

    $('.close-box').on('click', function () {
      $(this).parents('.subscribe-wrapper').removeClass('pull-down');
    });

    $(document).mouseup(function (e) {
      var container = $('.subscribe-box');

      if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.parents('.subscribe-wrapper').removeClass('pull-down');
      }
    });

    // Search bar
    $('#searchTrigger').click(
      function () {
        $('#searchField input[type=search]').toggleClass('expanded');
      }
    );
  }

  function addResponsiveWrapperToIframes() {
    $('iframe').each(function () {
      var hasSource = $(this).attr('src');
      var isGravityFormIframe = $(this).is('[id*="gform"]');

      if ($(this).parent('.embed-responsive').length || !hasSource || isGravityFormIframe) {
        return;
      }

      $(this).wrap('<div class="embed-responsive embed-responsive-16by9"></div>');
    });
  }

  if (Modernizr.backdropfilter) {
    // supported
    $('body').addClass('backdropfilter');
  }

  if ($('body').hasClass('geoip-country-GB') && $('body').hasClass('geoip-continent-EU')) {
    $dollars.removeClass('activeCurrency');
    $euros.removeClass('activeCurrency');
    $pounds.addClass('activeCurrency');
  } else if ($('body').hasClass('geoip-continent-EU')) {
    $pounds.removeClass('activeCurrency');
    $dollars.removeClass('activeCurrency');
    $euros.addClass('activeCurrency');
  } else {
    $pounds.removeClass('activeCurrency');
    $euros.removeClass('activeCurrency');
    $dollars.addClass('activeCurrency');
  }

  attachHandlers();
  addResponsiveWrapperToIframes();
});
