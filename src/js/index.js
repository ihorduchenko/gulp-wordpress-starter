var $ = jQuery;
var ssHeader = $('#siteHeader');

// Replace original backgrounds on load
function bgReplaceImages() {
  var bgReplace = $('.bgReplace');
  bgReplace.each(function() {
    var origBg = $(this).data('orig-bg');
    if (origBg) {
      $(this).css('background-image', 'url(' + origBg + ')');
    }
  });
}

$(document).ajaxComplete(function() {

  // Replace original backgrounds on load
  bgReplaceImages();
});

$(document).ready(function() {
  if ('ontouchstart' in document.documentElement) {
    $('body').addClass('touch-device');
  } else {
    $('body').removeClass('touch-device');
  }

  // Replace original backgrounds on load
  bgReplaceImages();

  // Append megamenu to menu item
  (function() {
    var megamenu = $('.megaMenu');
    megamenu.each(function() {
      var id = $(this).attr('id');
      var parent = $('.megaMenuTrigger.' + id);
      var toDetatch = $(this).detach();
      parent.append(toDetatch);
    });
  }());

  // Show submenu on touch devices
  // (function() {
  //   var trigger = $('body.touch-device .megaMenuTrigger > a');
  //   trigger.on('click', function(e) {
  //     e.preventDefault();
  //     $(this).parent('.megaMenuTrigger').toggleClass('sub-open');
  //   });
  // }());

  // Toggle mobile nav drawer
  (function() {
    var navToggler = $('#navToggler');
    var drawerBackdrop = $('.nav-drawer--backdrop');
    navToggler.on('click', function() {
      ssHeader.toggleClass('mod-open');
      ssHeader.removeClass('cart-open');
    });
    drawerBackdrop.on('click', function() {
      ssHeader.toggleClass('mod-open');
      ssHeader.removeClass('cart-open');
    });
  }());

  // Toggle search box
  (function() {
    var searchToggle = $('.searchToggle');
    var searchToggleBackdrop = $('.search-box--backdrop');
    searchToggle.on('click', function() {
      ssHeader.toggleClass('search-open');
    });
    searchToggleBackdrop.on('click', function() {
      ssHeader.removeClass('search-open');
    });
  }());

  // Toggle cart drawer
  (function() {
    var cartDrawerToggler = $('#cartDrawerToggler');
    var cartDrawerClose = $('#cartDrawerClose');
    var cartDrawerBackdrop = $('.cart-drawer--backdrop');
    cartDrawerToggler.on('click', function() {
      ssHeader.toggleClass('cart-open');
      ssHeader.removeClass('mod-open');
    });
    cartDrawerBackdrop.on('click', function() {
      ssHeader.toggleClass('cart-open');
      ssHeader.removeClass('mod-open');
    });
    cartDrawerClose.on('click', function() {
      ssHeader.removeClass('cart-open');
      ssHeader.removeClass('mod-open');
    });
  }());

  // Toggle sub-menus & Add back-titles
  (function() {
    var subMenuOpener = $('.subMenuOpen');
    var subMenuClosure = $('.subMenuClose');
    subMenuOpener.each(function() {
      var subMenu = $(this).siblings('.sub-menu');
      var parent = $(this).parents('.menu-item');
      $(this).click(function(e) {
        e.preventDefault();
        subMenu.toggleClass('mod-open');
        parent.toggleClass('mod-open');
      });
    });
    subMenuClosure.each(function() {
      var title = $(this).parent('li').parent('.sub-menu').siblings('.subMenuOpen').text();
      var titleEl = $(this).find('.subMenuCloseTitle');
      var subMenu = $(this).parent('li').parent('.sub-menu');
      titleEl.html(title);
      $(this).on('click', function(e) {
        e.preventDefault();
        subMenu.removeClass('mod-open');
      });
    });
  }());

  // Sliders
  (function() {

    var productsSlider = new Swiper ('.productsSlider .swiper-container', {
      slidesPerView: 4,
      autoHeight: true,
      breakpoints: {
        1025: {
          slidesPerView: 3
        },
        768: {
          slidesPerView: 1.6
        }
      }
    });

    var productGallery = new Swiper ('.productGallery .swiper-container', {
      slidesPerView: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      }
    });

    // Media slider
    var mediaSlider = new Swiper ('.mediaSlider .swiper-container', {
      slidesPerView: 1,
      autoHeight: true,
      navigation: {
        nextEl: '.mediaSliderNext',
        prevEl: '.mediaSliderPrev'
      }
    });
    var mediaSliderCurrent = $('.mediaSliderCurrent');
    var mediaSliderTotal = $('.mediaSliderTotal');

    if ($('.mediaSlider').length) {
      mediaSliderTotal.html(mediaSlider.slides.length);
      mediaSlider.on('slideChange', function() {
        mediaSliderCurrent.html(mediaSlider.activeIndex + 1);
      });
    }
  }());

  // Bind attributes select to radiobuttons
  (function() {
    $(document).on('change', '.variation-radios input', function() {
      $('select[name="' + $(this).attr('name') + '"]').val($(this).val()).trigger('change');
    });
  }());

  // Ajaxify cart
  (function() {
    $(document).on('click', '.ajaxAddBtn:not(.disabled)', function(e) {

      var $thisbutton = $(this),
        $form = $thisbutton.parents('form.cart'),
        form_product_qty = $form.find('input[name=quantity]').val() || 1,
        form_product_id = $form.find('input[name=product_id]').val(),
        form_variation_id = $form.find('input[name=variation_id]').val() || 0,

        product_qty = $thisbutton.data('quantity') || form_product_qty,
        product_id = $thisbutton.data('product_id') || form_product_id,
        variation_id = $thisbutton.data('variation_id') || form_variation_id; 

      var data = {
        action: 'woocommerce_ajax_add_to_cart',
        product_id: product_id,
        product_sku: '',
        quantity: product_qty,
        variation_id: variation_id
      };

      e.preventDefault();

      $(document.body).trigger('adding_to_cart', [ $thisbutton, data ]);

      $.ajax({
        type: 'post',
        url: wc_add_to_cart_params.ajax_url,
        data: data,
        beforeSend: function() {
          $thisbutton.removeClass('active').addClass('loading');
        },
        complete: function() {
          $thisbutton.addClass('active').removeClass('loading');
          ssHeader.addClass('cart-open');
        },
        success: function(response) {
          if (response.error & response.product_url) {
            window.location = response.product_url;
            return;
          } else {
            $(document.body).trigger('added_to_cart', [ response.fragments, response.cart_hash, $thisbutton ]);
          }
        }
      });

      return false;
    });
  }());
});
