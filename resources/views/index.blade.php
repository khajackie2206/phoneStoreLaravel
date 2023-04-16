<!doctype html>
<html class="no-js" lang="zxx">

<!-- index28:48-->

<head>
    @include('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">

{{--
<link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css"> --}}

</head>

<body>
    @include('sweetalert::alert')
    <!-- Begin Body Wrapper -->
    <div class="body-wrapper">
        <!-- Begin Header Area -->
        @include('header')
        <!-- Header Area End Here -->


        @yield('content')


        @include('footer')

        @yield('scripts')
    </div>

    <!-- Quick View | Modal Area End Here -->
    <!-- jQuery-V1.12.4 -->
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <!-- Popper js -->
    <script src="{{ asset('js/vendor/popper.min.js') }}"></script>
    <!-- Bootstrap V4.1.3 Fremwork js -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Ajax Mail js -->
    <script src="{{ asset('js/ajax-mail.min.js') }}"></script>
    <!-- Meanmenu js -->
    <script src="{{ asset('js/jquery.meanmenu.min.js') }}"></script>
    <!-- Wow.min js -->
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <!-- Slick Carousel js -->
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <!-- Owl Carousel-2 js -->
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <!-- Magnific popup js -->
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Isotope js -->
    <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
    <!-- Imagesloaded js -->
    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    <!-- Mixitup js -->
    <script src="{{ asset('js/jquery.mixitup.min.js') }}"></script>
    <!-- Countdown -->
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <!-- Counterup -->
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <!-- Waypoints -->
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <!-- Barrating -->
    <script src="{{ asset('js/jquery.barrating.min.js') }}"></script>
    <!-- Jquery-ui -->
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <!-- Venobox -->
    <script src="{{ asset('js/venobox.min.js') }}"></script>
    <!-- Nice Select js -->
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <!-- ScrollUp js -->
    <script src="{{ asset('js/scrollUp.min.js') }}"></script>
    <!-- Main/Activator js -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/product.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.js"
        integrity="sha512-1mDhG//LAjM3pLXCJyaA+4c+h5qmMoTc7IuJyuNNPaakrWT9rVTxICK4tIizf7YwJsXgDC2JP74PGCc7qxLAHw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var botmanWidget = {
                                title:'Admin',
                                introMessage: 'Chào bạn! Tôi có thể giúp gì cho bạn?',
                                mainColor:'#c02026',
                                aboutText:'',
                                bubbleBackground:'#c02026',
                                headerTextColor: '#fff',
                                };
    </script>

    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
    {{-- <script>
        window.addEventListener('load', function() {
        // Do we have a #scroll in the URL hash?
        if(window.location.hash && /#scroll/.test(window.location.hash)) {
            // Scroll to the #scroll value
            window.scrollTo(0, window.location.hash.replace('#scroll=', ''));
        }

        // Get all <a> elements with data-remember-position attribute
        var links = document.querySelectorAll('a[data-remember-position]');

        if(links.length) {
            // Loop through the found links
            for(var i = 0; i < links.length; i++) {
                // Listen for clicks
                links[i].addEventListener('click', function(e) {
                    // Prevent normal redirection
                    e.preventDefault();

                    // Redirect manually but put the current scroll value at the end
                    window.location = this.href + '?scroll=' + window.scrollY;
                });
            }
        }
    });
    </script> --}}
</body>

<!-- index30:23-->

</html>
