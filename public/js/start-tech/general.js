$(function(){



    $('.flexslider').flexslider({
//        animation: "slide"
    });




    $(".navbar li").removeClass("active")
    $(".navbar li").on("click" , function() {
        this.addClass("active");
    });




    $(".navbar").hover(function() {
            $(this).stop().animate({opacity: 1,color:"purple"}, 'slow');

        },
        function() {
            $(this).stop().animate({opacity: 0.7}, 'slow');
        });







    /*plug for navigation special images*/
    var button = document.getElementById('cn-button'),
        wrapper = document.getElementById('cn-wrapper'),
        overlay = document.getElementById('cn-overlay');

    //open and close menu when the button is clicked
    var open = false;
    button.addEventListener('click', handler, false);
    wrapper.addEventListener('click', cnhandle, false);

    function cnhandle(e){
        e.stopPropagation();
    }

    function handler(e){
        if (!e) var e = window.event;
        e.stopPropagation();//so that it doesn't trigger click event on document

        if(!open){
            openNav();
        }
        else{
            closeNav();
        }
    }
    function openNav(){
        open = true;
        button.innerHTML = "-";
        classie.add(overlay, 'on-overlay');
        classie.add(wrapper, 'opened-nav');
    }
    function closeNav(){
        open = false;
        button.innerHTML = "+";
        classie.remove(overlay, 'on-overlay');
        classie.remove(wrapper, 'opened-nav');
    }
    document.addEventListener('click', closeNav);
    /**********/













    /* when page loads animate the about section by default */
    //move($('#about'),2000,2);

    $('#menu > a').mouseover(
        function(){
            var $this = $(this);
            move($this,800,1);
        }
    );

    /*
     function to animate / show one circle.
     speed is the time it takes to show the circle
     turns is the turns the circle gives around the big circle
     */
    function move($elem,speed,turns){
        var id = $elem.attr('id');
        var $circle = $('#circle_'+id);

        /* if hover the same one nothing happens */
        if($circle.css('opacity')==1)
            return;

        /* change the image */
        $('#image_'+id).stop(true,true)
            .fadeIn(650)
            .siblings()
            .not(this)
            .fadeOut(650);

        /*
         if there's a circle already, then let's remove it:
         either animate it in a circular movement or just fading
         out, depending on the current position of it
         */
        $('#content .circle').each(function(i){
            var $theCircle = $(this);
            if($theCircle.css('opacity')==1)
                $theCircle.stop()
                    .animate({
                        path : new $.path.arc({
                            center  : [409,359],
                            radius  : 257,
                            start   : 65,
                            end     : -110,
                            dir : -1
                        }),
                        opacity: '0'
                    },1500);
            else
                $theCircle.stop()
                    .animate({opacity: '0'},200);
        });

        /* make the circle appear in a circular movement */
        var end = 65 - 360 * (turns-1);
        $circle.stop()
            .animate({
                path : new $.path.arc({
                    center  : [409,359],
                    radius  : 257,
                    start   : 180,
                    end     : end,
                    dir     : -1
                }),
                opacity: '1'
            },speed);
    }




    var button = document.getElementById('cn-button'),
        wrapper = document.getElementById('cn-wrapper'),
        overlay = document.getElementById('cn-overlay');

    //open and close menu when the button is clicked
    var open = false;
    button.addEventListener('click', handler, false);
    button.addEventListener('focus', handler, false);
    wrapper.addEventListener('click', cnhandle, false);

    function cnhandle(e){
        e.stopPropagation();
    }

    function handler(e){
        if (!e) var e = window.event;
        e.stopPropagation();//so that it doesn't trigger click event on document

        if(!open){
            openNav();
        }
        else{
            closeNav();
        }
    }
    function openNav(){
        open = true;
        button.innerHTML = "-";
        classie.add(overlay, 'on-overlay');
        classie.add(wrapper, 'opened-nav');
    }
    function closeNav(){
        open = false;
        button.innerHTML = "+";
        classie.remove(overlay, 'on-overlay');
        classie.remove(wrapper, 'opened-nav');
    }
    document.addEventListener('click', closeNav);






//    var button = document.getElementById('cn-button'),
//        wrapper = document.getElementById('cn-wrapper');
//
//    //open and close menu when the button is clicked
//    var open = false;
//    button.addEventListener('click', handler, false);
//    button.addEventListener('focus', handler, false);
//
//    function handler(){
//        if(!open){
//            this.innerHTML = "Close";
//            classie.add(wrapper, 'opened-nav');
//        }
//        else{
//            this.innerHTML = "Menu";
//            classie.remove(wrapper, 'opened-nav');
//        }
//        open = !open;
//    }
//    function closeWrapper(){
//        classie.remove(wrapper, 'opened-nav');
//    }








//    var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel" //FF doesn't recognize mousewheel as of FF3.x
//    $(document).bind(mousewheelevt, function(e){
//
//        var evt = window.event || e //equalize event object
//        evt = evt.originalEvent ? evt.originalEvent : evt; //convert to originalEvent if possible
//        var delta = evt.detail ? evt.detail*(-40) : evt.wheelDelta //check for detail first, because it is used by Opera and FF
//
//
//
//
//        $navBarOriginalWidth=$(".navbar").width();
//        console.log($navBarOriginalWidth);
//
//
//        if(delta > 0) {
//
//
//
//            if ($(".navbar").width()>760)
//            {
//                $('.navbar').animate({width:'100%'},'slow');
//                $(".navbar").animate({width: "+=1"},0);
//
//            }
//            else{
//                $(".navbar").animate({width: "+=10"},0);
//
//            }
//        }
//        else{
//            $(".navbar").animate({width: "-=10"},0);
//            if ($(".navbar").width()<160)
//            {
//                $(".navbar").width(160);
//            }
//        }
//    });


});