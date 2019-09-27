<footer id="colophon" class="site-footer footer-v1">
    <div class="col-full">
        @include('components/redes_sociais')
        <div class="footer-logo">
            <a href="{{ URL::to('/') }}" class="custom-logo-link" rel="home">
                <img src="{{ asset('img/formula_pizzaria_delivery.jpg') }}" />
            </a>
        </div>
        @include('components/enderecos')
        <div class="site-info">
            <p class="copyright">Copyright © 2014 Fórmula Pizzaria. {{ __('Todos direitos reservados.') }}</p>
        </div>
        <a role="button" class="footer-action-btn" data-toggle="collapse" href="{{ URL::to('/').'lojas' }}">
            <i class="po po-map-marker"></i>
            {{ __('Veja aonde estamos') }}
        </a>
    </div>
    <!-- .col-full -->
</footer>
<!-- #colophon -->
</div>
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/tether.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/social.share.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/scripts.min.js') }}"></script>
<!-- For demo purposes – can be removed on production -->
<script src="{{ asset('js/switchstylesheet.js') }}"></script>
<!-- For demo purposes – can be removed on production : End -->

<script>
    $(document).ready(function() {
        $('.owl-carousel').owlCarousel();
    });
    $('.sliderHome').owlCarousel({
        stagePadding: 0,
        items: 1,
        loop: true,
        margin: 0,
        singleItem: true,
        nav: true,
        navText: [
            "<i class='fa fa-caret-left'></i>",
            "<i class='fa fa-caret-right'></i>"
        ],
        dots: true
    });
</script>

</body>

</html>