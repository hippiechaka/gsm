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
  if ($("#googleMap").length>0){
    var myCenter=new google.maps.LatLng(20.706083,-103.371875);

    function initialize()
    {
    var mapProp = {
      center:myCenter,
      zoom:18,
      mapTypeId:google.maps.MapTypeId.HYBRID,
      scrollwheel: false 
      };

    var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
  }
  if ($("#grid-gallery").length>0){
      new CBPGridGallery( document.getElementById( 'grid-gallery' ) );


      $("#grid-gallery").lightGallery({selector:'.imglg',download:false,thumbnail:false,appendSubHtmlTo:''}); 
   
  }
});


/*
  var controller = new ScrollMagic.Controller({globalSceneOptions: {triggerHook: "onEnter", duration: "200%"}});
  new ScrollMagic.Scene({triggerElement: ".parallaxParent"})
    .setTween(".parallaxParent > div.bg-parallax", {y: "80%", ease: Linear.easeNone})
    // .addIndicators()
    .addTo(controller);

  var controller = new ScrollMagic.Controller({globalSceneOptions: {triggerHook: "onEnter", duration: "200%"}});
  new ScrollMagic.Scene({triggerElement: ".parallaxParent2"})
    .setTween(".parallaxParent2 > div.bg-parallax2", {y: "40%", ease: Linear.easeNone})
    // .addIndicators()
    .addTo(controller);
*/

});

/*
  $("#etc").click(function(){
      $(".content").css("display", "none");
      $(".main-procesoBTN").removeClass("current");
      $("#progenitoras-cont").fadeToggle();
      $(this).addClass("current");
      return false;
  });*/