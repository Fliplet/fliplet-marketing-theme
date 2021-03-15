$(function () {
  function changeCalculatorStatus(activeTab) {
    $('.pricing-calculator-section-holder')[activeTab === 'enterprise'
      ? 'addClass'
      : 'removeClass'
    ]('hidden');
  }

  function calculateElementsHeight() {
    var titleHeights = [];
    var infoHeights = [];

    $('.pricing-tab.animated .plan-column').each(function () {
      var titleHeight = $(this).find('.plan-title-wrapper h3').outerHeight();
      var subTitleHeight = $(this).find('.plan-title-wrapper p').outerHeight();
      var infoHeight = $(this).find('.plan-info-users p').outerHeight();

      titleHeights.push(titleHeight + subTitleHeight);
      infoHeights.push(infoHeight);
    });

    var maxTitleHeight = Math.max.apply(Math, titleHeights);
    var maxInfoHeight = Math.max.apply(Math, infoHeights);

    $('.pricing-tab.animated .plan-title-wrapper').css('height', maxTitleHeight);
    $('.pricing-tab.animated .plan-info-users').css('height', maxInfoHeight);
  }

  function initiateSlider(activeTab) {
    var steps;
    var sliderContainerSelector = '.pricing-tab';
    var sliderSelector = '.mtu-slider';
    var priceHolderSelector = '.mtu-wrapper';
    var priceSelector = '.mtu-price';

    switch (activeTab) {
      case 'public':
        sliderContainerSelector = '.public-plan-tab';
        sliderSelector = '.public-plan-tab .mtu-slider';
        priceHolderSelector = '.public-plan-tab .mtu-wrapper';
        priceSelector = '.public-plan-tab .mtu-price';
        steps = [{
            value: 100,
            price: 9.99
          },
          {
            value: 300,
            price: 29.99
          },
          {
            value: 500,
            price: 49.99
          },
          {
            value: 1000,
            price: 99.99
          },
          {
            value: 5000,
            price: 499.99
          }
        ];
        break;
      case 'private':
        sliderContainerSelector = '.private-plan-tab';
        sliderSelector = '.private-plan-tab .mtu-slider';
        priceHolderSelector = '.private-plan-tab .mtu-wrapper';
        priceSelector = '.private-plan-tab .mtu-price';
        steps = [{
            value: 5,
            price: 12.50
          },
          {
            value: 15,
            price: 37.50
          },
          {
            value: 25,
            price: 62.50
          },
          {
            value: 50,
            price: 124.99
          },
          {
            value: 250,
            price: 624.99
          }
        ];
        break;
      case 'private-plus':
        sliderContainerSelector = '.private-plus-plan-tab';
        sliderSelector = '.private-plus-plan-tab .mtu-slider';
        priceHolderSelector = '.private-plus-plan-tab .mtu-wrapper';
        priceSelector = '.private-plus-plan-tab .mtu-price';
        steps = [{
            value: 5,
            price: 29.99
          },
          {
            value: 15,
            price: 89.99
          },
          {
            value: 25,
            price: 149.99
          },
          {
            value: 50,
            price: 299.99
          },
          {
            value: 250,
            price: 1499.99
          }
        ];
        break;
      default:
    }

    // Start slider
    mtuSlider.init(sliderSelector, {
      sliderContainerSelector: sliderContainerSelector,
      priceHolderSelector: priceHolderSelector,
      priceSelector: priceSelector,
      steps: steps,
      currency: '$',
      billingPeriod: 'month'
    });
  }

  function attachHandlers() {
    $(window).on('resize', _.debounce(calculateElementsHeight, 100));

    $(document).on('click', '.pricing-tab-btn[data-tab]', function () {
      var activeTab = $(this).data('tab');

      // Handle tabs states
      $('.pricing-tab-wrapper .pricing-tab-btn').removeClass('active');
      $('.pricing-tab-wrapper .pricing-tab-btn[data-tab="' + activeTab + '"]').addClass('active');

      // Handle tabs' content states
      $('.pricing-tab-wrapper .pricing-tab').removeClass('animated fadeIn');
      $('.pricing-tab-wrapper .pricing-tab[data-tab="' + activeTab + '"]').addClass('animated fadeIn');

      // Calculate element height
      calculateElementsHeight();

      changeCalculatorStatus(activeTab);
    })
    .on('click', '.pricing-tab-btn[data-calculator-tab]', function () {
      var activeTab = $(this).data('calculator-tab');

      // Handle tabs states
      $('.pricing-calculator-wrapper .pricing-tab-btn').removeClass('active');
      $('.pricing-calculator-wrapper .pricing-tab-btn[data-calculator-tab="' + activeTab + '"]')
        .addClass('active');

      // Handle tabs' content states
      $('.pricing-calculator-wrapper .pricing-tab').removeClass('animated fadeIn');
      $('.pricing-calculator-wrapper .pricing-tab[data-calculator-tab="' + activeTab + '"]')
        .addClass('animated fadeIn');

      initiateSlider(activeTab);
    })
    .on('click', '.pricing-grid-title-holder', function () {
      $(this).toggleClass('active');

      $(this).next('.pricing-title-tooltip').css('height', $(this).hasClass('active')
        ? $(this).next('.pricing-title-tooltip').find('p').outerHeight()
        : 0)
    });
  }

  attachHandlers();
  calculateElementsHeight();
  initiateSlider('public');
});