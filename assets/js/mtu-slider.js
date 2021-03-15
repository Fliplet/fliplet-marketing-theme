window.mtuSlider = (function () {
  // Defaults
  var mtuOptions = {};
  var sliderContainerSelector = '.mtu-holder';
  var mtuSelector = '.mtu-slider';
  var sliderPartSelector = '.mtu-slider-part';
  var dragThumbSelector = '.mtu-slider-drag-thumb';
  var priceSelector = '.mtu-price';
  var priceHolderSelector = '.mtu-wrapper';
  var sliderElement;
  var sliderElementRect;
  var dragThumb;
  var dragThumbLastPosX = 0;
  var dragThumbHalfSize = 25 / 2;
  var isDragging = false;
  var sliderPartSize = 0;
  var sliderPartMargin = 1;
  var billingPeriod = 'month';
  var currency = '$';
  var selectedMTUs;
  var mc;

  function getPreviousSiblings(element) {
    var result = [];

    while (element = element.previousElementSibling) {
      result.push(element);
    }

    return result.reverse();
  }

  function getNextSiblings(element) {
    var result = [];

    while (element = element.nextElementSibling) {
      result.push(element);
    }

    return result;
  }

  function getDragThumbXPosition() {
    var elemRect = dragThumb.getBoundingClientRect();
    var positionX = elemRect.x - sliderElementRect.left;

    return positionX;
  }

  function updatePrice(value) {
    var priceElement = document.querySelector(mtuOptions.priceSelector || priceSelector);
    var priceHolderElement = document.querySelector(priceHolderSelector);

    if (!priceElement) {
      return;
    }

    // Show the default elements
    priceHolderElement.classList.remove('contact-sales');

    if (value > mtuOptions.steps[mtuOptions.steps.length - 1].value) {
      priceElement.innerHTML = 'Contact Sales';
      priceHolderElement.classList.add('contact-sales');

      return;
    }

    var steps = _.filter(mtuOptions.steps, function (step) {
      return step.value <= value
    });

    var highestStep = steps[steps.length - 1];

    value = highestStep.price;

    priceElement.innerHTML =
      currency + (value).toFixed(2) + '<div class="mtu-info">/' + billingPeriod + '</div>';
  }

  function generateDragLabel(value = {}) {
    var number = value.number || 0;
    var isAbovePlan = value.abovePlan

    var dragThumbLabel = document.createElement('div');
    dragThumbLabel.classList.add('mtu-thumb-label');

    var dragDivOne = document.createElement('div');
    var dragDivTwo = document.createElement('div');
    var dragtextOne = isAbovePlan ?
      document.createTextNode('more than') :
      document.createTextNode('up to');
    var dragtextTwo = document.createTextNode(' users');
    var dragValue = document.createElement('span');
    var dragValueText = document.createTextNode(number);

    dragDivOne.appendChild(dragtextOne);
    dragValue.appendChild(dragValueText);
    dragDivTwo.appendChild(dragValue);
    dragDivTwo.appendChild(dragtextTwo);

    dragThumbLabel.appendChild(dragDivOne);
    dragThumbLabel.appendChild(dragDivTwo);

    return dragThumbLabel;
  }

  function replaceDragThumbLabel(dragThumbLabel) {
    var dragThumb = document.querySelector(sliderContainerSelector + ' ' + dragThumbSelector);

    dragThumb.innerHTML = '';
    dragThumb.appendChild(dragThumbLabel);
  }

  function updateDragLabel(value) {
    var defaultNumber = mtuOptions.steps && mtuOptions.steps.length ?
      mtuOptions.steps[0].value :
      0;
    var number = value ? parseInt(value, 10) : '';
    var valueNumber = number || defaultNumber;
    var text = {
      number: valueNumber > mtuOptions.steps[mtuOptions.steps.length - 1].value ?
        mtuOptions.steps[mtuOptions.steps.length - 1].value :
        valueNumber,
      abovePlan: valueNumber > mtuOptions.steps[mtuOptions.steps.length - 1].value
    };
    var dragThumbLabel = generateDragLabel(text);

    selectedMTUs = valueNumber;

    replaceDragThumbLabel(dragThumbLabel);
    updatePrice(valueNumber);
  }

  function highlighSliderParts(element) {
    element.classList.add('highlighted');

    var previousElements = getPreviousSiblings(element);
    var nextElements = getNextSiblings(element);

    for (var i = 0; i < previousElements.length; i++) {
      previousElements[i].classList.add('highlighted');
    }

    for (var i = 0; i < nextElements.length; i++) {
      nextElements[i].classList.remove('highlighted');
    }
  }

  function processHighlightSliderParts() {
    var DragThumbXPosition = getDragThumbXPosition() + dragThumbHalfSize;
    var sliderNumber = Math.max(1, (Math.ceil(DragThumbXPosition / (sliderPartSize.width + 2))));
    var sliderPartSelected = document
      .querySelectorAll(sliderContainerSelector + ' ' + sliderPartSelector)[sliderNumber - 1];
    var value = sliderPartSelected.getAttribute('data-mtu');

    updateDragLabel(value);
    highlighSliderParts(sliderPartSelected);
  }

  function getSliderPartSizes() {
    var fullSliderPartSelector = mtuSelector + ' ' + sliderPartSelector;
    var element = document.querySelector(fullSliderPartSelector);

    return element.getBoundingClientRect();
  }

  function setDragThumbPosition(positionX) {
    var posX = positionX - dragThumbHalfSize;

    dragThumb.style.webkitTransform = 'translateX(' + posX + 'px)';
  }

  function snapToLastHighlighted() {
    var highlighted = document
      .querySelectorAll(sliderContainerSelector + ' ' + sliderPartSelector + '.highlighted');
    var lastHighlightedrect = highlighted[highlighted.length - 1].getBoundingClientRect();

    setDragThumbPosition(lastHighlightedrect.right - sliderElementRect.left);
  }

  function endDrag(skipSnap = false) {
    isDragging = false;

    dragThumb.classList.remove('dragging');

    if (skipSnap) {
      return;
    }

    snapToLastHighlighted();
  }

  function handlePress() {
    endDrag(true);
  }

  function handlePressUp() {
    endDrag();
  }

  function startDrag(elem) {
    isDragging = true;
    dragThumbLastPosX = getDragThumbXPosition();

    elem.classList.add('dragging');
  }

  function handleDrag(ev) {
    if (!isDragging) {
      startDrag(dragThumb);
    }

    var posX = ev.deltaX + (dragThumbLastPosX + dragThumbHalfSize);

    if (posX > 0 && posX < sliderElementRect.width) {
      setDragThumbPosition(posX);
    } else if (posX <= 0) {
      setDragThumbPosition(Math.max(posX, 0));
    } else if (posX >= (sliderElementRect.width - sliderPartMargin)) {
      setDragThumbPosition(sliderElementRect.width - sliderPartMargin);
    }

    processHighlightSliderParts();

    if (ev.isFinal) {
      endDrag();
    }
  }

  function destroyHammer() {
    if (!mc) {
      return;
    }

    mc.destroy();
  }

  function initHammer() {
    mc = new Hammer(sliderElement);

    mc.add(new Hammer.Pan({
      direction: Hammer.DIRECTION_ALL,
      threshold: 0
    }));
    mc.add(new Hammer.Press({
      time: 0
    }));

    mc.on('pan', handleDrag);
    mc.on('press', handlePress);
    mc.on('pressup', handlePressUp);
  }

  function attachHandlers() {
    initHammer();

    window.addEventListener('resize', function () {
      // Update slider parts size
      sliderPartSize = getSliderPartSizes();

      // Update drag area sizes
      sliderElementRect = sliderElement.getBoundingClientRect();

      snapToLastHighlighted();
    });

    var sliderPartsElements = document
      .querySelectorAll(sliderContainerSelector + ' ' + sliderPartSelector);

    for (var i = 0; i < sliderPartsElements.length; i++) {
      sliderPartsElements[i].addEventListener('click', function () {
        var elementRect = this.getBoundingClientRect();
        var value = this.getAttribute('data-mtu');

        updateDragLabel(value);
        highlighSliderParts(this);
        setDragThumbPosition(elementRect.left + elementRect.width - sliderElementRect.left);
      }, false);
    }
  }

  function generateSliderParts(element) {
    // Create slider wrapper
    var mtuSliderPartsWrapper = document.createElement('div');
    mtuSliderPartsWrapper.classList.add('mtu-slider-parts');

    // Loop through the steps to create markup
    mtuOptions.steps.forEach(function (step, index) {
      // Create the slider part
      var mtuSliderPart = document.createElement('div');
      mtuSliderPart.classList.add(index > 0 ?
        'mtu-slider-part' :
        'highlighted', 'mtu-slider-part');
      mtuSliderPart.setAttribute('data-mtu', step.value);

      // Create the slider part label
      var mtuSliderPartLabel = document.createElement('div');
      mtuSliderPartLabel.classList.add('mtu-slider-label');

      // Create step content
      // and give it some content
      var stepValue = document.createTextNode(step.value);

      // Add the step value to the slider part label
      mtuSliderPartLabel.appendChild(stepValue);

      // Add element to the slider part
      mtuSliderPart.appendChild(mtuSliderPartLabel);

      // Add element to the slider wrapper
      mtuSliderPartsWrapper.appendChild(mtuSliderPart);
    });

    // Adds one extra slider part
    var mtuSliderPart = document.createElement('div');
    mtuSliderPart.classList.add('mtu-slider-part');
    mtuSliderPart.setAttribute(
      'data-mtu',
      mtuOptions.steps[mtuOptions.steps.length - 1].value + 1
    );

    mtuSliderPartsWrapper.appendChild(mtuSliderPart);

    // Adds the wrapper to the Slider
    element.appendChild(mtuSliderPartsWrapper);
  }

  function generateDragThumb(element) {
    // Create drag wrapper
    var dragThumbWrapper = document.createElement('div');
    dragThumbWrapper.classList.add('mtu-slider-drag-thumb');

    // Create drag label
    var dragThumbLabel = generateDragLabel();

    dragThumbWrapper.appendChild(dragThumbLabel);

    element.appendChild(dragThumbWrapper);
  }

  function generateMarkup() {
    generateSliderParts(sliderElement);
    generateDragThumb(sliderElement)
  }

  function destroySliderElement() {
    destroyHammer();

    // Get slider element
    sliderElement = document.querySelector(mtuSelector);

    if (!sliderElement) {
      return;
    }

    // Make sure it's clean and also resets listeners
    sliderElement.innerHTML = '';
  }

  function setDefaults() {
    sliderContainerSelector = mtuOptions.sliderContainerSelector || sliderContainerSelector;
    billingPeriod = mtuOptions.billingPeriod || billingPeriod;
    currency = mtuOptions.currency || currency;
    priceHolderSelector = mtuOptions.priceHolderSelector || priceHolderSelector;
  }

  return {
    init: function (selector = mtuSelector, options = mtuOptions) {
      // Set defaults
      mtuSelector = selector;
      mtuOptions = options;

      setDefaults();

      // Required steps check
      if (!mtuOptions.steps || !mtuOptions.steps.length) {
        throw new Error('You need to specify the different steps for the slider.')
      }

      destroySliderElement();

      if (!sliderElement) {
        return;
      }

      // Get slider element sizes
      sliderElementRect = sliderElement.getBoundingClientRect();

      mtuOptions.steps = _.sortBy(mtuOptions.steps, ['value']);

      generateMarkup();

      dragThumb = document.querySelector(sliderContainerSelector + ' ' + dragThumbSelector);
      sliderPartSize = getSliderPartSizes();

      setDragThumbPosition(sliderPartSize.width);
      updateDragLabel();
      attachHandlers();
    },
    destroy: destroySliderElement,
    getMTUValue: function () {
      return selectedMTUs;
    }
  }
})();