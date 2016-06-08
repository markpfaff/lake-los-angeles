$(document).ready(function () {
    var slideshow = $('body.home');
    var backgrounds = [
        'url(images/bk1-light.png)', 
        'url(images/bk1-dark.png)',
        'url(images/bk2-light.png)', 
        'url(images/bk2-dark.png)',
        'url(images/bk3-light.png)', 
        'url(images/bk3-dark.png)'];
    var colorsClasses = ['light','dark'];
    var current = 0;

    function nextBackground() {
        slideshow.css(
            'background-image',
            backgrounds[current = ++current % backgrounds.length]
        );
        if (backgrounds[current].endsWith('-light.png)')) {
            $("nav").attr("class",colorsClasses[0]);
        }else{
            $("nav").attr("class",colorsClasses[1]);
        }
        setTimeout(nextBackground, 5000);
    }

    setTimeout(nextBackground, 5000);
    slideshow.css('background-image', backgrounds[0]);
    slideshow.css("color",colorsClasses[0]);
});



