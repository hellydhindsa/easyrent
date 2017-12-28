! function($) {
    $(document).ready(function() {
        //         Dropzone.autoDiscover = false;

        //            Dropzone.options.uploadFile = {
        //                maxFiles: 4,
        //                maxFilesize: 1,
        //                
        //                accept: function(file, done) {
        //    console.log("uploaded");
        //    done();
        //  },
        //              init: function() {
        //                this.on("success", function(file, responseText) {
        //                 //   alert(responseText);
        //               //  file.previewTemplate.appendChild(document.createTextNode(responseText));
        //                });
        //                
        //                this.on("sending", function(file) {
        //                    $("#tmp-path").html('<input type="hidden" name="path" value="'+file.fullPath+'" />')
        //                });      
        //          
        //              },
        //               acceptedFiles: "image/*"
        //    
        //  
        //            }; 

        //            var myDropzone = new Dropzone("#uploadFile", { 
        //                url: "upload.php"
        //            });               

        $window = $(window);
        var isMobile = {
            Android: function() {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function() {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };
        testMobile = isMobile.any();
        if (testMobile == null && $('.parallax .bg') != undefined) {
            $('.parallax .bg').parallax("50%", 0.3);
        }
        (function() {
            var mainnav = $('.noo-header');
            var elmHeight = $('.top-header').outerHeight(true);
            if (mainnav.length) {
                var elmHeight = $('.top-header').outerHeight(true);
                $(window).scroll(function() {
                    var scrolltop = $(window).scrollTop();
                    if (scrolltop > elmHeight) {
                        if (!mainnav.hasClass('affix')) {
                            mainnav.addClass('affix');
                        }
                    } else {
                        mainnav.removeClass('affix');
                    }
                })
            }
        })();
        (function() {
            $('.main-navigation .dropdown').on({
                mouseenter: function() {
                    $(this).addClass('open');
                },
                mouseleave: function() {
                    $(this).removeClass('open');
                }
            });
            $('.main-navigation .dropdown-submenu').on({
                mouseenter: function() {
                    $(this).addClass('open');
                },
                mouseleave: function() {
                    $(this).removeClass('open');
                }
            });
        })();
        (function() {
            if ($('[data-toggle="tooltip"]').length) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        })();
        (function() {
            if ($('#noo-slider-1 .sliders').length) {
                $('#noo-slider-1 .sliders').carouFredSel({
                    infinite: true,
                    circular: true,
                    responsive: true,
                    debug: false,
                    scroll: {
                        items: 1,
                        duration: 600,
                        pauseOnHover: "resume",
                        fx: "scroll"
                    },
                    auto: {
                        timeoutDuration: 3000,
                        progress: {
                            bar: "#noo-slider-1-timer"
                        },
                        play: true
                    },
                    pagination: {
                        container: "#noo-slider-1-pagination"
                    },
                    prev: {
                        button: "#noo-slider-1-prev"
                    },
                    next: {
                        button: "#noo-slider-1-next"
                    },
                    swipe: {
                        onTouch: true,
                        onMouse: true
                    }
                });
            }
        })();
        (function() {
            if ($('#noo-slider-2 .sliders').length) {
                $('#noo-slider-2 .sliders').carouFredSel({
                    infinite: true,
                    circular: true,
                    responsive: true,
                    debug: false,
                    items: {
                        start: 0
                    },
                    scroll: {
                        items: 1,
                        duration: 600,
                        fx: "fade"
                    },
                    auto: {
                        timeoutDuration: 3000,
                        play: true
                    },
                    pagination: {
                        container: "#noo-slider-2-pagination"
                    },
                    swipe: {
                        onTouch: true,
                        onMouse: true
                    }
                });
            }
        })();
        (function() {
            if ($('#noo-slider-3 .sliders').length) {
                $('#noo-slider-3 .sliders').carouFredSel({
                    infinite: true,
                    circular: true,
                    responsive: true,
                    debug: false,
                    items: {
                        start: 0
                    },
                    scroll: {
                        items: 1,
                        duration: 600,
                        pauseOnHover: "resume",
                        fx: "scroll"
                    },
                    auto: {
                        timeoutDuration: 3000,
                        play: true
                    },
                    swipe: {
                        onTouch: true,
                        onMouse: true
                    }
                });
            }
        })();
        (function() {
            if ($('#noo-slider-4 .sliders').length) {
                $('#noo-slider-4 .sliders').carouFredSel({
                    infinite: true,
                    circular: true,
                    responsive: true,
                    debug: false,
                    items: {
                        start: "random"
                    },
                    scroll: {
                        items: 1,
                        duration: 600,
                        pauseOnHover: "resume",
                        fx: "scroll"
                    },
                    auto: {
                        timeoutDuration: 3000,
                        progress: {
                            bar: "#noo-slider-4-timer"
                        },
                        play: true
                    },
                    pagination: {
                        container: "#noo-slider-4-pagination"
                    },
                    swipe: {
                        onTouch: true,
                        onMouse: true
                    }
                });
            }
        })();
        (function() {
            if ($('#noo-slider-5 .sliders').length) {
                $('#noo-slider-5 .sliders').carouFredSel({
                    infinite: true,
                    circular: true,
                    responsive: true,
                    debug: false,
                    items: {
                        start: 0
                    },
                    scroll: {
                        items: 1,
                        duration: 600,
                        pauseOnHover: "resume",
                        fx: "scroll"
                    },
                    auto: {
                        timeoutDuration: 3000,
                        play: false
                    },
                    prev: {
                        button: "#noo-slider-5-prev"
                    },
                    next: {
                        button: "#noo-slider-5-next"
                    },
                    swipe: {
                        onTouch: true,
                        onMouse: true
                    }
                });
            }
        })();
        (function() {
            if ($('.gprice-slider-range').length) {
                $(".gprice-slider-range").noUiSlider({
                    start: [200, 11000000],
                    range: {
                        'min': 200,
                        'max': 11000000
                    },
                    step: 1,
                    format: wNumb({
                        decimals: 0,
                        thousand: '.',
                        prefix: '&#36;'
                    }),
                    connect: true
                });
                $(".gprice-slider-range").Link('lower').to('-inline-<div class="tooltip"></div>', function(value) {
                    $(this).html('<span>' + value + '</span>');
                });
                $(".gprice-slider-range").Link('upper').to('-inline-<div class="tooltip"></div>', function(value) {
                    $(this).html('<span>' + value + '</span>');
                });
            }
        })();
        (function() {
            if ($('.garea-slider-range').length) {
                $(".garea-slider-range").noUiSlider({
                    start: [200, 11000000],
                    range: {
                        'min': 200,
                        'max': 11000000
                    },
                    step: 1,
                    format: wNumb({
                        decimals: 0,
                        thousand: '.',
                        prefix: '&#36;'
                    }),
                    connect: true
                });
                $(".garea-slider-range").Link('lower').to('-inline-<div class="tooltip"></div>', function(value) {
                    $(this).html('<span>' + value + '</span>');
                });
                $(".garea-slider-range").Link('upper').to('-inline-<div class="tooltip"></div>', function(value) {
                    $(this).html('<span>' + value + '</span>');
                });
            }
        })();
        (function() {
            if ($('.datepicker').length) {
                $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',
                    autoclose: true,
                    todayHighlight: true
                });
            }
        })();
        (function() {
            if ($('.animatedParent').length) {
                $('.animatedParent').appear(function() {
                    var ele = $(this).find('.animated');
                    var parent = $(this);
                    ele.addClass('go');
                });
            }
        })();
        (function() {
            if ($('#jplayer-audio-1').length) {
                $("#jplayer-audio-1").jPlayer({
                    ready: function() {
                        $(this).jPlayer("setMedia", {
                            title: "Bubble",
                            m4a: "http://www.jplayer.org/audio/m4a/Miaow-07-Bubble.m4a",
                            oga: "http://www.jplayer.org/audio/ogg/Miaow-07-Bubble.ogg"
                        });
                    },
                    cssSelectorAncestor: "#jplayer-interface-audio-1",
                    swfPath: "/js",
                    supplied: "m4a, oga"
                });
            }
        })();
        (function() {
            if ($('#jplayer-video-1').length) {
                $('#jplayer-video-1').jPlayer({
                    ready: function() {
                        $(this).jPlayer('setMedia', {
                            m4v: 'http://www.jplayer.org/video/m4v/Big_Buck_Bunny_Trailer.m4v'
                        })
                    },
                    size: {
                        width: '100%',
                        height: '100%'
                    },
                    swfPath: '../js/jplayer',
                    cssSelectorAncestor: '#jplayer-interface-video-1',
                    supplied: 'm4v,'
                });
            }
        })();
        (function() {
            if ($('#noo-accordion-1').length) {
                $('#noo-accordion-1 .panel-title a').attr('data-parent', '#noo-accordion-1');
                $('#noo-accordion-1 .noo-accordion-tab:eq(0)').addClass('in');
                $('#noo-accordion-1').on('show.bs.collapse', function(e) {
                    $(e.target).prev('.panel-heading').addClass('active');
                });
                $('#noo-accordion-1').on('hide.bs.collapse', function(e) {
                    $(e.target).prev('.panel-heading').removeClass('active');
                });
                $('#noo-accordion-1 .in').prev('.panel-heading').addClass('active');
            }
        })();
        (function() {
            if ($('#noo-accordion-2').length) {
                $('#noo-accordion-2 .panel-title a').attr('data-parent', '#noo-accordion-2');
                $('#noo-accordion-2 .noo-accordion-tab:eq(0)').addClass('in');
                $('#noo-accordion-2').on('show.bs.collapse', function(e) {
                    $(e.target).prev('.panel-heading').addClass('active');
                });
                $('#noo-accordion-2').on('hide.bs.collapse', function(e) {
                    $(e.target).prev('.panel-heading').removeClass('active');
                });
                $('#noo-accordion-2 .in').prev('.panel-heading').addClass('active');
            }
        })();
        (function() {
            if ($('#noo-tabs-1').length) {
                $('#noo-tabs-1 a:eq(0)').tab('show');
            }
        })();
        (function() {
            if ($('#noo-tabs-2').length) {
                $('#noo-tabs-2 a:eq(0)').tab('show');
            }
        })();
        (function() {
            if ($('.noo-counter').length) {
                $('.noo-counter').appear(function() {
                    $this = jQuery(this);
                    $this.parent().css('opacity', '1');
                    var $max = parseFloat($this.text());
                    $this.countTo({
                        from: 0,
                        to: $max,
                        speed: 1500,
                        refreshInterval: 100
                    });
                });
            }
        })();
        (function() {
            if ($('.s-prop-desc textarea').length) {
                $('.s-prop-desc textarea').wysihtml5({
                    "font-styles": false,
                    "blockquote": false,
                    "emphasis": true,
                    "lists": true,
                    "html": false,
                    "link": true,
                    "image": true,
                    "color": false
                });
            }
        })();
        (function() {
            if ($('.checkbox-label').length) {
                $('.checkbox-label').on("click", function() {
                    if ($('#recurring_payment').is(':checked')) {
                        $('.recurring_time').show();
                    } else {
                        $('.recurring_time').hide();
                    }
                });
            }
        })();
        (function() {
            $('.back-to-top').on("click", function(event) {
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: 0
                }, 'slow');
                return false;
            });
        })();
    });
}(jQuery);