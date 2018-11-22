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



});

/*
  $("#etc").click(function(){
      $(".content").css("display", "none");
      $(".main-procesoBTN").removeClass("current");
      $("#progenitoras-cont").fadeToggle();
      $(this).addClass("current");
      return false;
  });*/