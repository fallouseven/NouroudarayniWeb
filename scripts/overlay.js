// create custom animation algorithm for jQuery called "drop"
$.easing.drop = function (x, t, b, c, d) {
    return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
};

// loading animation
$.tools.overlay.addEffect("drop", function(css, done) {
 
    // use Overlay API to gain access to crucial elements
    var conf = this.getConf(),
    overlay = this.getOverlay();
 
    // determine initial position for the overlay
    if (conf.fixed)  {
        css.position = 'fixed';
    } else {
        css.top += $(window).scrollTop();
        css.left += $(window).scrollLeft();
        css.position = 'absolute';
    }
 
    // position the overlay and show it
    overlay.css(css).show();
 
    // begin animating with our custom easing
    overlay.animate(
        { top: '+=55',  opacity: 1,  width: '+=20'}, 400, 'drop', done
    );
 
    /* closing animation */
}, function(done) {
    this.getOverlay().animate(
        {top:'-=55', opacity:0, width:'-=20'}, 300, 'drop',
        function() {
            $(this).hide();
            done.call();
        });
});