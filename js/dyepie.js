//$(function () {
//    'use strict';
//    
//    // Background Full Height
//    $('.most_views').height($(window).innerHeight());
//    $('.mostViewsTwo').height($(window).innerHeight());
//    
//    });
//// navbar fixed
//var navbar = document.getElementById("down_section"),
//    bestOffers = document.getElementById('best_offers'),
//    sticky = navbar.offsetTop;
//
//function myFunction() {
//  if (window.pageYOffset >= sticky) {
//    navbar.classList.add("sticky");
//    navbar.classList.remove("navbar_section");
//  } else {
//    navbar.classList.remove("sticky");
//    navbar.classList.add("navbar_section");}
//}
//
//window.onscroll = function() {myFunction()};

// init WOW.JS 
//wow = new WOW({
//boxClass:     'wow',      // default
//animateClass: 'animated', // default
//offset:       0,          // default
//mobile:       true,       // default
//live:         true        // default
//}
//)
//wow.init();

//// create hidden placeholder
//// use jQuery to add placeholder 
//$('#user_login').attr( 'placeholder', 'اسم البائع أو البريد' );
//$('#user_pass').attr( 'placeholder', 'كلمة المرور' );
//
//
//var placeHidden = document.getElementById('user_login');
//var hiddenPass = document.getElementById('user_pass');
//// create a new attribute and save placeholder to it
//// then clear , then get back onblur();
//placeHidden.onfocus = function() {
//    'use strict';
//    this.setAttribute('data-place', this.getAttribute('placeholder'));
//    this.setAttribute('placeholder', '')
//}
//
//placeHidden.onblur = function() {
//    'use strict';
//    this.setAttribute('placeholder', this.getAttribute('data-place'));
//    this.setAttribute('data-place', '')
//}
//// another easy way to create auto-hidden input
//hiddenPass.onfocus = function() {
//    'use strict';
//    this.setAttribute('placeholder', '')
//}
//
//hiddenPass.onblur = function () {
//    'use strict';
//    this.setAttribute('placeholder', 'كلمة المرور')
//}//// create hidden placeholder
//// use jQuery to add placeholder 
//$('#user_login').attr( 'placeholder', 'اسم البائع أو البريد' );
//$('#user_pass').attr( 'placeholder', 'كلمة المرور' );
//
//
//var placeHidden = document.getElementById('user_login');
//var hiddenPass = document.getElementById('user_pass');
//// create a new attribute and save placeholder to it
//// then clear , then get back onblur();
//placeHidden.onfocus = function() {
//    'use strict';
//    this.setAttribute('data-place', this.getAttribute('placeholder'));
//    this.setAttribute('placeholder', '')
//}
//
//placeHidden.onblur = function() {
//    'use strict';
//    this.setAttribute('placeholder', this.getAttribute('data-place'));
//    this.setAttribute('data-place', '')
//}
//// another easy way to create auto-hidden input
//hiddenPass.onfocus = function() {
//    'use strict';
//    this.setAttribute('placeholder', '')
//}
//
//hiddenPass.onblur = function () {
//    'use strict';
//    this.setAttribute('placeholder', 'كلمة المرور')
//}

$('.prod_one').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    dots: false,
    infinite: true,
    cssEase: 'linear',
    accessibility: true,
    adaptiveHeight: true,
    arrows: true,
    autoplay: false,
    nextArrow: $('.next_one')
});



$('.prod_two').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    dots: false,
    infinite: true,
    cssEase: 'linear',
    accessibility: true,
    adaptiveHeight: true,
    arrows: true,
    autoplay: false,
    nextArrow: $('.next_two'),
});

$('.prod_three').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    dots: false,
    infinite: true,
    cssEase: 'linear',
    accessibility: true,
    adaptiveHeight: true,
    arrows: true,
    autoplay: false,
    nextArrow: $('.next_three'),
});

$('.pop_profiles').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    dots: false,
    infinite: true,
    cssEase: 'linear',
    accessibility: true,
    adaptiveHeight: true,
    arrows: true,
    autoplay: false,
    nextArrow: $('.next_profile'),
    prevArrow: $('.prev_profile'),
});

// product taxonomy normal slider

  $('.normal_top5').slick({
    slidesPerRow: 1,
    rows: 2,
    slidesToShow: 4,
    slidesToScroll: 1,
    //autoplay: true,
    autoplaySpeed: 2000,
    adaptiveHeight: true,
    arrows: true,

    responsive: [
        {
      breakpoint: 1068,
          settings: {
          initialSlide: 0,
          infinite: true,
          slidesToShow: 3,
          slidesToScroll: 1,
        }
      },
        {
      breakpoint: 768,
          settings: {
          initialSlide: 0,
          infinite: true,
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      },
          {
      breakpoint: 480,
          settings: {
          initialSlide: 0,
          infinite: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          }
      },]
  });


  $('.single_prod_slider').slick({
    slidesPerRow: 1,
    slidesToShow: 1,
    slidesToScroll: 1,
    //autoplay: true,
    autoplaySpeed: 2000,
    adaptiveHeight: true,
    arrows: true,
    nextArrow: $('.next_single'),
    prevArrow: $('.prev_single'),

    responsive: [
        {
      breakpoint: 1068,
          settings: {
          initialSlide: 0,
          infinite: true,
          slidesToShow: 3,
          slidesToScroll: 1,
        }
      },
        {
      breakpoint: 768,
          settings: {
          initialSlide: 0,
          infinite: true,
          slidesToShow: 1,
          slidesToScroll: 1,
        }
      },
          {
      breakpoint: 480,
          settings: {
          initialSlide: 0,
          infinite: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          }
      },]
  });

// customize log in page
$('#user_login').attr( 'placeholder', 'Username' );
$('#user_pass').attr( 'placeholder', 'Password' );

$('#rememberme').attr( 'data-toggle', 'toggle' );
$('#rememberme').attr( 'data-on', '<i class="fas fa-thumbs-up"></i> YES' );
$('#rememberme').attr( 'data-off', '<i class="fas fa-thumbs-down dislike"> </i>  NO' );
$('.login-remember').append('<div class="login_register_social"></div>');
$('.login_register_social').append('<i class="fab fa-facebook login_register_icon"></i>');
$('.login_register_social').append('<i class="fab fa-twitter login_register_icon"></i>');
$('.login_register_social').append('<i class="fab fa-google login_register_icon"></i>');
$("#loginform").addClass("loginform_class");
$("#user_login").attr({"required": "required"});
$("#user_pass").attr({"required": "required"});



// ajax

// $(window).scroll(function() {
//     if ($(window).scrollTop() == $(document).height() - $(window).height()) {
//         var data = {
//             'action': 'load_posts_by_ajax',
//             'page': page,
//             'security': '<?php echo wp_create_nonce("load_more_posts"); ?>'
//         };
 
//         $.post(ajaxurl, data, function(response) {
//             $('.my-posts').append(response);
//             page++;

//         });
//     }
// });

// sticky right adv
// When the user scrolls the page, execute myFunction 
// window.onscroll = function() {myFunction()};

// // Get the header
// var header = document.getElementById("adv_hold");

// // Get the offset position of the navbar
// var sticky = header.offsetTop / 2.5;

// // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
// function myFunction() {
//   if (window.pageYOffset > sticky) {
//     header.classList.add("stick");
//   } else {
//     header.classList.remove("stick");
//   }
// }


jQuery(document).ready(function() {
 
    jQuery("#primaryPostForm").validate();
 
});


// set file uploader for add product page
$(document).on('change','.up', function(){
        var names = [];
        var length = $(this).get(0).files.length;
            for (var i = 0; i < $(this).get(0).files.length; ++i) {
                names.push($(this).get(0).files[i].name);
            }
            // $("input[name=file]").val(names);
            if(length>2){
                var fileName = names.join(', ');
                $(this).closest('.add_upload').find('.form-control').attr("value",length+" files selected");
            }
            else{
                $(this).closest('.add_upload').find('.form-control').attr("value",names);
            }
    });