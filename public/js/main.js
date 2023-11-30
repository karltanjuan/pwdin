(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.sticky-top').css('top', '0px');
        } else {
            $('.sticky-top').css('top', '-100px');
        }
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        items: 1,
        dots: true,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ]
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 24,
        dots: true,
        loop: true,
        nav : false,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });
    
})(jQuery);

// Toastr Options
toastr.options = {
    closeButton: false,
    debug: false,
    newestOnTop: false,
    progressBar: true,
    positionClass: 'toast-bottom-right',
    preventDuplicates: false,
    onclick: null,
    showDuration: '300',
    hideDuration: '1000',
    timeOut: '1000',
    extendedTimeOut: '1000',
    showEasing: 'swing',
    hideEasing: 'linear',
    showMethod: 'fadeIn',
    hideMethod: 'fadeOut'
};


var err_counter = 0;
function displayErrors(errors) {
    $('.err-msg').text('');
    $('.err-msg').siblings('input, select').removeClass('error');

    // loop all the error messages from backend to display on ui
    $.each(errors, function(field, messages) {
        var errMsgSelector = '.err-' + field;
        var inputSelector = '#' + field;
        $(errMsgSelector).text(messages[0]);
        $(inputSelector).addClass('error');
    });
}

var state1 = false;
var state2 = false;
var state3 = false;
var state4 = false;

let hide1 = $("#show1");
let hide2 = $("#show2");
let hide3 = $("#show3");
let hide4 = $("#show4");

function toggle1() {
  if (state1) {
    $("#new_password").attr("type", "password");
    hide1.css("color", "#D0CECE");
    hide1.removeClass("la-eye-slash").addClass("la-eye");
    state1 = false;
  } else {
    $("#new_password").attr("type", "text");
    hide1.css("color", "#1976D2");
    hide1.removeClass("la-eye").addClass("la-eye-slash");
    state1 = true;
  }
}

function toggle2() {
  if (state2) {
    $("#password_confirmation").attr("type", "password");
    hide2.css("color", "#D0CECE");
    hide2.removeClass("la-eye-slash").addClass("la-eye");
    state2 = false;
  } else {
    $("#password_confirmation").attr("type", "text");
    hide2.css("color", "#1976D2");
    hide2.removeClass("la-eye").addClass("la-eye-slash");
    state2 = true;
  }
}

function toggle3() {
    if (state3) {
      $("#password").attr("type", "password");
      hide3.css("color", "#D0CECE");
      hide3.removeClass("la-eye-slash").addClass("la-eye");
      state3 = false;
    } else {
      $("#password").attr("type", "text");
      hide3.css("color", "#1976D2");
      hide3.removeClass("la-eye").addClass("la-eye-slash");
      state3 = true;
    }
}

function toggle4() {
    if (state4) {
      $("#current_password").attr("type", "password");
      hide4.css("color", "#D0CECE");
      hide4.removeClass("la-eye-slash").addClass("la-eye");
      state4 = false;
    } else {
      $("#current_password").attr("type", "text");
      hide4.css("color", "#1976D2");
      hide4.removeClass("la-eye").addClass("la-eye-slash");
      state4 = true;
    }
}

    function check()
    {
        var input = document.getElementById("password").value;
        
        input=input.trim();
        document.getElementById("password").value=input;
        document.getElementById("count").innerText="Length : " + input.length;
        if(input.length>=8)
        {
            document.getElementById("check0").style.color="green";
        }
        else
        {
        document.getElementById("check0").style.color="red"; 
        }
        
        
        if(input.match(/[0-9]/i))
        {
            document.getElementById("check1").style.color="green";
        }
        else
        {
        document.getElementById("check1").style.color="red"; 
        }
        
        if(input.match(/[^A-Za-z0-9-' ']/i))
        {
            document.getElementById("check2").style.color="green";
        }
        else
        {
        document.getElementById("check2").style.color="red"; 
        }
        if(input.match(' '))
        {
            document.getElementById("check3").style.color="red";
        }
        else
        {
        document.getElementById("check3").style.color="green"; 
        }
        if(input.match(/[A-Z]/))
        {
            document.getElementById("check4").style.color="green";
        }
        else
        {
        document.getElementById("check4").style.color="red"; 
        }

        return errors;
    }