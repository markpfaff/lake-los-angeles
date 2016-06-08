<?php
/* 
 * front-page.php
 */
?>
<?php get_header(); ?>
    <small class="small-label">front-page.php</small>
    
                <script>
                $(document).ready(function () {
                    
                    var clicked = false;
                    
                    // When menu link is clicked SlideshowStart will stop
                    $("li.menu-item a").click(function() {
                       clicked = true;
                    });
                    
                    
                    // When menu home link is clicked SlideshowStart will start
                    $("div.logo-desktop a").click(function() {
                       clicked = false;
                    });
                    
                    var SlideshowStart = function () {
                        

                        var slideshow = $("html");
                        var backgrounds = [
                            "url(<? echo esc_url( get_template_directory_uri() );?>/images/bk1-light.jpg)", 
                            "url(<? echo esc_url( get_template_directory_uri() );?>/images/bk1-dark.jpg)",
                            "url(<? echo esc_url( get_template_directory_uri() );?>/images/bk2-light.jpg)", 
                            "url(<? echo esc_url( get_template_directory_uri() );?>/images/bk2-dark.jpg)",
                            "url(<? echo esc_url( get_template_directory_uri() );?>/images/bk3-light.jpg)", 
                            "url(<? echo esc_url( get_template_directory_uri() );?>/images/bk3-dark.jpg)"];
                        var current = 0;

                        function nextBackground() {
                            if (clicked) return;
                            slideshow.css(
                                "background-image",
                                backgrounds[current = ++current % backgrounds.length]
                            );

                            if (backgrounds[current].endsWith("-light.jpg)")) {
                                $("ul#menu-main, div.logo-desktop").removeClass("dark").addClass("light");
                            }else{
                                $("ul#menu-main, div.logo-desktop").removeClass("light").addClass("dark");
                            }
                            setTimeout(nextBackground, 5000);
                        }

                        setTimeout(nextBackground, 5000);
                        slideshow.css("background-image", backgrounds[0]);
                    };

                    SlideshowStart();

                });
            </script>               

<?php get_footer(); ?>