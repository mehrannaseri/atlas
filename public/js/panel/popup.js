/* A simple bit of Jquery 2.0 to pop up a  window, and close it on clicking of an element with class "popup-close", pressing escape, or clicking outside the window */

$(document).ready(function(){

    /* define variables for popup */
    /*----------------------------*/
    var fadeInTime = 600; //time in ms
    var fadeOutTime = 600; //time in ms
    var popupWindow = $('.popup-window'); //jquery selector of window

    /* define simple fade functions */
    /*------------------------------*/

    function fadein(el) {
        $(el).fadeIn(fadeInTime);
    }
    function fadeout(el) {
        $(el).fadeOut(fadeOutTime);
    }

    /* open #popup-window on click of .popup-trigger */
    /*-----------------------------------------------*/

    $('.popup-trigger').on('click touchend', function(){
        fadein(popupWindow);
    })

    /* close #popup-window on click of .popup-close */
    /*----------------------------------------------*/

    $('.popup-close').on('click touchend', function() {
        fadeout(popupWindow);
    });

    /* close #popup-window on click a anywhere outside the window	*/
    /*------------------------------------------------------------*/
    $(document).on('mouseup', function(e) {
        if (!popupWindow.is(e.target) // target not container...
            && popupWindow.has(e.target).length === 0) // ... nor descendant of container
        {
            fadeout(popupWindow);
        }
    });

    /* close #popup-window on pressing ESC	*/
    /*------------------------------------------------------------*/
    $(document).on('keyup', function(e) {
        if (e.keyCode == 27) { // (escape key)
            fadeout(popupWindow);
        }
    });

})