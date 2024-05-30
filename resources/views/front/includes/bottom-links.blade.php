<a id="button" class="scroll_top_btn" style="opacity: 1;"><img src="{{ asset('public/front/images/scroll_top.svg')}}"></a>
<script src="{{ asset('public/front/js/jquery.min.js')}}"></script> 
<script src="{{ asset('public/front/js/bootstrap.bundle.min.js')}}"></script>
<!--<script src="{{ asset('public/front/js/swiper.min.js')}}"></script>-->
<script src="{{ asset('public/front/js/aos.js')}}"></script>

<script type="text/javascript" src="https://scrollmagic.io/assets/js/lib/greensock/TweenMax.min.js"></script>
<script type="text/javascript" src="https://scrollmagic.io/scrollmagic/uncompressed/ScrollMagic.js"></script>
<script type="text/javascript" src="https://scrollmagic.io/scrollmagic/uncompressed/plugins/animation.gsap.js"></script>
<script type="text/javascript" src="{{ asset('public/front/js/toastr.min.js')}}"></script>
<script src="{{ asset('public/front/js/jquery.validate.min.js')}}"></script>
<script src="{{ asset('public/front/js/validation.js')}}"></script>

<script src="{{ asset('public/front/js/select2.min.js')}}"></script>
<script src="{{ asset('public/front/js/coustom.js')}}"></script>
<script src="{{ asset('public/front/js/jquery.sticky.js')}}"></script>
<script src="{{ asset('public/front/js/swiper-bundle.min.js')}}"></script>
<!--<script src="{{ asset('public/front/js/nouislider.js')}}"></script>-->
<script src="https://js.stripe.com/v3/"></script>
<script src="{{ asset('public/front/js/main.js')}}"></script>

<script>
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,ar', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
  }
</script>
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script>
    AOS.init({
        duration: 1200,
    });
</script>
<script>
    window.addEventListener("resize", function() {
        "use strict";
    });
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.dropdown-menu').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        })
        if (window.innerWidth < 992) {
            document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown) {
                everydropdown.addEventListener('hidden.bs.dropdown', function() {
                    this.querySelectorAll('.submenu')
                        .forEach(function(everysubmenu) {
                            everysubmenu
                                .style
                                .display =
                                'none';
                        });
                })
            });
            document.querySelectorAll('.dropdown-menu a').forEach(function(element) {
                element.addEventListener('click', function(e) {
                    let nextEl = this.nextElementSibling;
                    if (nextEl && nextEl.classList
                        .contains('submenu')) {
                        e.preventDefault();
                        console.log(nextEl);
                        if (nextEl.style.display ==
                            'block') {
                            nextEl.style.display =
                                'none';
                        } else {
                            nextEl.style.display =
                                'block';
                        }
                    }
                });
            })
        }
    });
         
</script>
<script>
    function auto_tab_input() {
        $(".code-inputs .form-control").keyup(function() {
            if (this.value.length == this.maxLength) {
                $(this).nextAll(".code-inputs .form-control:enabled:first").focus();
            }
        });
    }

    function auto_backspace() {
        $(".code-inputs .form-control").keyup(function(e) {
            if (e.keyCode == 8) {
                if ($(this).prev().length > 0) {
                    $(this).prev("input").focus();
                }
            }
        });
    }

    $(document).ready(function() {
        auto_tab_input();
        auto_backspace();
    });
</script>
<script>
    @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('message') }}");
    @endif
  
    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("{{ session('error') }}");
    @endif
  
    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.info("{{ session('info') }}");
    @endif
  
    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.warning("{{ session('warning') }}");
    @endif
  </script>