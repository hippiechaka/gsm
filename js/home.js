$(document).ready(function(){
  
  $("#slide-kenburns").owlCarousel({
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
        navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"]
        // afterAction: afterAction,
        // onResized: matchHeight1
  });






  $("#slide-mision-vision").owlCarousel({
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

$("#quienes-somos").owlCarousel({
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        items:1,
        nav:true,
        navigation: true,
        controls:true,
        autoplay : false,
        pagination: true,
        //stopOnHover: true,
        //lazyLoad: true,
        //addClassActive: true,
        loop:true,
        navText: ["<i class='fas fa-angle-left' aria-hidden='true'></i>", "<i class='fas fa-angle-right' aria-hidden='true'></i>"]
        // afterAction: afterAction,
        // onResized: matchHeight1
  });





$("#clientesGrid").owlCarousel({
 
      navigation : true, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      nav: true,
      controls: true,
      items : 5,
      itemsMobile : true,
      loop:true,
      autoplay: true,
      autoplayTimeout: 3000,
      autoplayHoverPause: true,
      responsiveClass:true,
      responsive:{
          0:{
              items:1,
              nav:true
          },
          600:{
              items:2,
              nav:true
          },
          1000:{
              items:4,
              nav:true,
              loop:true
          }
      },
      navText: ["<i class='fas fa-angle-left' aria-hidden='true'></i>", "<i class='fas fa-angle-right' aria-hidden='true'></i>"]
 
  });

  //matchHeight1();
});

/*
function matchHeight1(){
  $('#sidebar-initial').matchHeight({
    target: $('#slide-kenburns')
  });
}
*/
/*
function changeClass(slide){

    setTimeout(function(){

         $("#slide-kenburns .owl-item").each(function(){
          if ($(this).index() === slide){
            $(this).addClass("active");
          } else{
           $(this).removeClass("active");
          }
        });

    },500);
  }

function afterAction(){
  changeClass(this.owl.currentItem);
}
*/