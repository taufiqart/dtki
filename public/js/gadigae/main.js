$(document).ready(function () {
  
    $("#slider-hero").owlCarousel({
       loop:true,
        nav:true,
        items:1,
     
        navText:[
            "<i class='fas fa-angle-left'></i>",  
            "<i class='fas fa-angle-right'></i>"     
        ],
        navContainer:"#slider-hero-nav",
    });



    $("#tenaga-pendidik-slider").owlCarousel({
        loop:true,
         nav:true,
         items:3,
         margin:15,
         navText:[
             "<i class='fas fa-angle-left'></i>",  
             "<i class='fas fa-angle-right'></i>"     
         ],
         navContainer:"#slider-tools-1",
     });

     $("#galeri-slider").owlCarousel({
        loop:true,
         nav:true,
         items:4,
         margin:15,
         navText:[
             "<i class='fas fa-angle-left'></i>",  
             "<i class='fas fa-angle-right'></i>"     
         ],
         navContainer:"#slider-tools-3",
     });


});
