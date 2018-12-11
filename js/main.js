$(document).ready(function() {

/* ScrollNavigation  */

  $(function() {
      $('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          $(this).parent('li').parent('ul').parent('li').removeClass('open'); // oculta menu despues de hacer click
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html, body').animate({
              scrollTop: (target.offset().top *1) - ($("#mainMenu").height()*1)
            }, 1000, 'easeInOutExpo');
            return false;
          }
        }
      });
    });    

$("#main-slideshow").owlCarousel({
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        items:1,
        nav:true,
        navigation: true,
        controls:true,
        autoplay : true,
        pagination: true,
        stopOnHover: true,
        //lazyLoad: true,
        //addClassActive: true,
        loop:true,
        navText: ["<i class='fas fa-angle-left' aria-hidden='true'></i>", "<i class='fas fa-angle-right' aria-hidden='true'></i>"]
        // afterAction: afterAction,
        // onResized: matchHeight1
  });

  /* para cerrar el navbar al click */
  $('.mainMenuBtn').on('click', function(){
      if ( $( '.navbar-collapse' ).hasClass('in') ) {
          $('.navbar-toggle').click();
      }
  });
  $('.navbar-brand').on('click', function(){
      if ( $( '.navbar-collapse' ).hasClass('in') ) {
          $('.navbar-toggle').click();
      }
  }); 

/* Parallax */

$(function(){
  if ($(".parallax-window").length>0){
    $('.parallax-window').parallax();
    $('.parallax-window-min').parallax();
  }
});

var controller = new ScrollMagic.Controller();
var tween = TweenMax.staggerFromTo("#penal", 1, {left: -1280}, {left: 0, ease: Power4.easeOut}, 1.6180);
var scene = new ScrollMagic.Scene({triggerElement: "#img-penal"})
        .setTween(tween)
        .addTo(controller);

var controller = new ScrollMagic.Controller();
var tween = TweenMax.staggerFromTo("#civil", 1, {right: -1280}, {right: 0, ease: Power4.easeOut}, 1.6180);
var scene = new ScrollMagic.Scene({triggerElement: "#img-civil"})
        .setTween(tween)
        .addTo(controller);

var controller = new ScrollMagic.Controller();
var tween = TweenMax.staggerFromTo("#corporativo", 1, {left: -1280}, {left: 0, ease: Power4.easeOut}, 1.6180);
var scene = new ScrollMagic.Scene({triggerElement: "#img-corporativo"})
        .setTween(tween)
        .addTo(controller);

var controller = new ScrollMagic.Controller();
var tween = TweenMax.staggerFromTo("#familiar", 1, {right: -1280}, {right: 0, ease: Power4.easeOut}, 1.6180);
var scene = new ScrollMagic.Scene({triggerElement: "#img-familiar"})
        .setTween(tween)
        .addTo(controller);

var controller = new ScrollMagic.Controller();
var tween = TweenMax.staggerFromTo("#sucesiones", 1, {left: -1280}, {left: 0, ease: Power4.easeOut}, 1.6180);
var scene = new ScrollMagic.Scene({triggerElement: "#img-sucesiones"})
        .setTween(tween)
        .addTo(controller);

var controller = new ScrollMagic.Controller();
var tween = TweenMax.staggerFromTo("#mercantil", 1, {right: -1280}, {right: 0, ease: Power4.easeOut}, 1.6180);
var scene = new ScrollMagic.Scene({triggerElement: "#img-mercantil"})
        .setTween(tween)
        .addTo(controller);

var controller = new ScrollMagic.Controller();
var tween = TweenMax.staggerFromTo("#laboral", 1, {left: -1280}, {left: 0, ease: Power4.easeOut}, 1.6180);
var scene = new ScrollMagic.Scene({triggerElement: "#img-laboral"})
        .setTween(tween)
        .addTo(controller);

var controller = new ScrollMagic.Controller();
var tween = TweenMax.staggerFromTo("#amparo", 1, {right: -1280}, {right: 0, ease: Power4.easeOut}, 1.6180);
var scene = new ScrollMagic.Scene({triggerElement: "#img-amparo"})
        .setTween(tween)
        .addTo(controller);

});

/*
  $("#etc").click(function(){
      $(".content").css("display", "none");
      $(".main-procesoBTN").removeClass("current");
      $("#progenitoras-cont").fadeToggle();
      $(this).addClass("current");
      return false;
  });*/