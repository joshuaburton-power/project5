<?php
/*
 * project 4
 * J.Burton-Power
 * 10/10/14
 * 
 */
?>
<html>
    <head> 
        <link rel="icon" type="image/png" href="browserlogo.ico"/>
        <script type='text/javascript' src='jquery/jquery.min.js'></script>
        <script type='text/javascript' src='jquery/jquery.ui.min.js'></script>
        <script type='text/javascript' src='project4.js'></script>
        <link href='jquery/css/smoothness/jquery-ui.css' rel='stylesheet'/>
        <link tyle='text/css' href='css/style.css' rel='stylesheet'/>
        <link href="../project4/project4.css" rel="stylesheet" type="text/css"/>
        <title>Drive Computing </title>
        <script type='text/javascript'>
            $(function() {
                /**
                 * for each menu element, on mouseenter,
                 * we enlarge the image, and show both sdt_active span and
                 * sdt_wrap span. If the element has a sub menu (sdt_box),
                 * then we slide it - if the element is the last one in the menu
                 * we slide it to the left, otherwise to the right
                 */
                $('#sdt_menu > li').bind('mouseenter', function() {
                    var $elem = $(this);
                    $elem.find('img')
                            .stop(true)
                            .animate({
                                'width': '170px',
                                'height': '170px',
                                'left': '0px'
                            }, 400, 'easeOutBack')
                            .andSelf()
                            .find('.sdt_wrap')
                            .stop(true)
                            .animate({'top': '140px'}, 500, 'easeOutBack')
                            .andSelf()
                            .find('.sdt_active')
                            .stop(true)
                            .animate({'height': '170px'}, 300, function() {
                                var $sub_menu = $elem.find('.sdt_box');
                                if ($sub_menu.length) {
                                    var left = '170px';
                                    if ($elem.parent().children().length == $elem.index() + 1)
                                        left = '-170px';
                                    $sub_menu.show().animate({'left': left}, 200);
                                }
                            });
                }).bind('mouseleave', function() {
                    var $elem = $(this);
                    var $sub_menu = $elem.find('.sdt_box');
                    if ($sub_menu.length)
                        $sub_menu.hide().css('left', '0px');

                    $elem.find('.sdt_active')
                            .stop(true)
                            .animate({'height': '0px'}, 300)
                            .andSelf().find('img')
                            .stop(true)
                            .animate({
                                'width': '0px',
                                'height': '0px',
                                'left': '85px'}, 400)
                            .andSelf()
                            .find('.sdt_wrap')
                            .stop(true)
                            .animate({'top': '25px'}, 500);
                });
            });


            jQuery.easing['jswing'] = jQuery.easing['swing'];

            jQuery.extend(jQuery.easing,
                    {
                        def: 'easeOutQuad',
                        swing: function(x, t, b, c, d) {
                            //alert(jQuery.easing.default);
                            return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
                        },
                        easeInQuad: function(x, t, b, c, d) {
                            return c * (t /= d) * t + b;
                        },
                        easeOutQuad: function(x, t, b, c, d) {
                            return -c * (t /= d) * (t - 2) + b;
                        },
                        easeInOutQuad: function(x, t, b, c, d) {
                            if ((t /= d / 2) < 1)
                                return c / 2 * t * t + b;
                            return -c / 2 * ((--t) * (t - 2) - 1) + b;
                        },
                        easeInCubic: function(x, t, b, c, d) {
                            return c * (t /= d) * t * t + b;
                        },
                        easeOutCubic: function(x, t, b, c, d) {
                            return c * ((t = t / d - 1) * t * t + 1) + b;
                        },
                        easeInOutCubic: function(x, t, b, c, d) {
                            if ((t /= d / 2) < 1)
                                return c / 2 * t * t * t + b;
                            return c / 2 * ((t -= 2) * t * t + 2) + b;
                        },
                        easeInQuart: function(x, t, b, c, d) {
                            return c * (t /= d) * t * t * t + b;
                        },
                        easeOutQuart: function(x, t, b, c, d) {
                            return -c * ((t = t / d - 1) * t * t * t - 1) + b;
                        },
                        easeInOutQuart: function(x, t, b, c, d) {
                            if ((t /= d / 2) < 1)
                                return c / 2 * t * t * t * t + b;
                            return -c / 2 * ((t -= 2) * t * t * t - 2) + b;
                        },
                        easeInQuint: function(x, t, b, c, d) {
                            return c * (t /= d) * t * t * t * t + b;
                        },
                        easeOutQuint: function(x, t, b, c, d) {
                            return c * ((t = t / d - 1) * t * t * t * t + 1) + b;
                        },
                        easeInOutQuint: function(x, t, b, c, d) {
                            if ((t /= d / 2) < 1)
                                return c / 2 * t * t * t * t * t + b;
                            return c / 2 * ((t -= 2) * t * t * t * t + 2) + b;
                        },
                        easeInSine: function(x, t, b, c, d) {
                            return -c * Math.cos(t / d * (Math.PI / 2)) + c + b;
                        },
                        easeOutSine: function(x, t, b, c, d) {
                            return c * Math.sin(t / d * (Math.PI / 2)) + b;
                        },
                        easeInOutSine: function(x, t, b, c, d) {
                            return -c / 2 * (Math.cos(Math.PI * t / d) - 1) + b;
                        },
                        easeInExpo: function(x, t, b, c, d) {
                            return (t == 0) ? b : c * Math.pow(2, 10 * (t / d - 1)) + b;
                        },
                        easeOutExpo: function(x, t, b, c, d) {
                            return (t == d) ? b + c : c * (-Math.pow(2, -10 * t / d) + 1) + b;
                        },
                        easeInOutExpo: function(x, t, b, c, d) {
                            if (t == 0)
                                return b;
                            if (t == d)
                                return b + c;
                            if ((t /= d / 2) < 1)
                                return c / 2 * Math.pow(2, 10 * (t - 1)) + b;
                            return c / 2 * (-Math.pow(2, -10 * --t) + 2) + b;
                        },
                        easeInCirc: function(x, t, b, c, d) {
                            return -c * (Math.sqrt(1 - (t /= d) * t) - 1) + b;
                        },
                        easeOutCirc: function(x, t, b, c, d) {
                            return c * Math.sqrt(1 - (t = t / d - 1) * t) + b;
                        },
                        easeInOutCirc: function(x, t, b, c, d) {
                            if ((t /= d / 2) < 1)
                                return -c / 2 * (Math.sqrt(1 - t * t) - 1) + b;
                            return c / 2 * (Math.sqrt(1 - (t -= 2) * t) + 1) + b;
                        },
                        easeInElastic: function(x, t, b, c, d) {
                            var s = 1.70158;
                            var p = 0;
                            var a = c;
                            if (t == 0)
                                return b;
                            if ((t /= d) == 1)
                                return b + c;
                            if (!p)
                                p = d * .3;
                            if (a < Math.abs(c)) {
                                a = c;
                                var s = p / 4;
                            }
                            else
                                var s = p / (2 * Math.PI) * Math.asin(c / a);
                            return -(a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p)) + b;
                        },
                        easeOutElastic: function(x, t, b, c, d) {
                            var s = 1.70158;
                            var p = 0;
                            var a = c;
                            if (t == 0)
                                return b;
                            if ((t /= d) == 1)
                                return b + c;
                            if (!p)
                                p = d * .3;
                            if (a < Math.abs(c)) {
                                a = c;
                                var s = p / 4;
                            }
                            else
                                var s = p / (2 * Math.PI) * Math.asin(c / a);
                            return a * Math.pow(2, -10 * t) * Math.sin((t * d - s) * (2 * Math.PI) / p) + c + b;
                        },
                        easeInOutElastic: function(x, t, b, c, d) {
                            var s = 1.70158;
                            var p = 0;
                            var a = c;
                            if (t == 0)
                                return b;
                            if ((t /= d / 2) == 2)
                                return b + c;
                            if (!p)
                                p = d * (.3 * 1.5);
                            if (a < Math.abs(c)) {
                                a = c;
                                var s = p / 4;
                            }
                            else
                                var s = p / (2 * Math.PI) * Math.asin(c / a);
                            if (t < 1)
                                return -.5 * (a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p)) + b;
                            return a * Math.pow(2, -10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p) * .5 + c + b;
                        },
                        easeInBack: function(x, t, b, c, d, s) {
                            if (s == undefined)
                                s = 1.70158;
                            return c * (t /= d) * t * ((s + 1) * t - s) + b;
                        },
                        easeOutBack: function(x, t, b, c, d, s) {
                            if (s == undefined)
                                s = 1.70158;
                            return c * ((t = t / d - 1) * t * ((s + 1) * t + s) + 1) + b;
                        },
                        easeInOutBack: function(x, t, b, c, d, s) {
                            if (s == undefined)
                                s = 1.70158;
                            if ((t /= d / 2) < 1)
                                return c / 2 * (t * t * (((s *= (1.525)) + 1) * t - s)) + b;
                            return c / 2 * ((t -= 2) * t * (((s *= (1.525)) + 1) * t + s) + 2) + b;
                        },
                        easeInBounce: function(x, t, b, c, d) {
                            return c - jQuery.easing.easeOutBounce(x, d - t, 0, c, d) + b;
                        },
                        easeOutBounce: function(x, t, b, c, d) {
                            if ((t /= d) < (1 / 2.75)) {
                                return c * (7.5625 * t * t) + b;
                            } else if (t < (2 / 2.75)) {
                                return c * (7.5625 * (t -= (1.5 / 2.75)) * t + .75) + b;
                            } else if (t < (2.5 / 2.75)) {
                                return c * (7.5625 * (t -= (2.25 / 2.75)) * t + .9375) + b;
                            } else {
                                return c * (7.5625 * (t -= (2.625 / 2.75)) * t + .984375) + b;
                            }
                        },
                        easeInOutBounce: function(x, t, b, c, d) {
                            if (t < d / 2)
                                return jQuery.easing.easeInBounce(x, t * 2, 0, c, d) * .5 + b;
                            return jQuery.easing.easeOutBounce(x, t * 2 - d, 0, c, d) * .5 + c * .5 + b;
                        }
                    });
        </script>
    </head>
    <body>
        <div class="content">

            <ul id="sdt_menu" class="sdt_menu">
                <li>
                    <a href="#">
                            <!--<img src="images/admin.jpg" alt=""/>-->
                        <span class="sdt_active"></span>
                        <span class="sdt_wrap">
                            <span class="sdt_link">home</span>
                            <span class="sdt_descr">home of website</span>
                        </span>
                    </a>
                    <div class="sdt_box">
                        <br>
                        <br>
                        <Br>
                        <br>
                        <a href="../project4/homePage.php">home</a>
                        <a href="#"></a>
                        <a href="#"></a>
                    </div>
                </li>
                <li>
                    <a href="#">
                            <!--<img src="images/apple.jpg" alt=""/>-->
                        <span class="sdt_active"></span>
                        <span class="sdt_wrap">
                            <span class="sdt_link">admin</span>
                            <span class="sdt_descr">maintences</span>
                        </span>
                    </a>
                    <div class="sdt_box">
                        <br><br><br>
                        <a href="../project4/jobRoll.php">job role</a>
                        <a href="#"></a>
                    </div>
                </li>
                <li>
                    <a href="#">
                            <!--<img src="images/3.jpg" alt=""/>-->
                        <span class="sdt_active"></span>
                        <span class="sdt_wrap">
                            <span class="sdt_link">Finance</span>
                            <span class="sdt_descr">Handling</span>
                        </span>
                    </a>
                    <div class="sdt_box">
                        <br><br><br><br>
                        <a href="#">Profits</a>
                        <a href="#"></a>
                    </div>
                </li>
                <li>
                    <a href="#">
                            <!--<img src="images/4.jpg" alt=""/>-->
                        <span class="sdt_active"></span>
                        <span class="sdt_wrap">
                            <span class="sdt_link">Suppliers</span>
                            <span class="sdt_descr">Purchasing/Sales</span>
                        </span>
                    </a>
                    <div class="sdt_box">
                        <br><br><br>
                        <a href="#">Amend/Create</a>

                    </div>
                </li>
                <li>
                    <a href="#">
                            <!--<img src="images/5.jpg" alt=""/>-->
                        <span class="sdt_active"></span>
                        <span class="sdt_wrap">
                            <span class="sdt_link">...</span>
                            <span class="sdt_descr">...</span>
                        </span>
                    </a>
                </li>

            </ul>
        </div>
    </body>
</html>