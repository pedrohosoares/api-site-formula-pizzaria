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
        <a role="button" class="footer-action-btn" href="{{ URL::to('/').'/'.'lojas' }}">
            <i class="po po-map-marker"></i>
            {{ __('Veja aonde estamos') }}
        </a>
    </div>
</footer>
</div>
<script type="text/javascript" src="{{ asset('js/tether.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/social.share.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/scripts.min.js') }}"></script>
<script src="{{ asset('js/switchstylesheet.js') }}"></script>

<script>
    //Carrousel de itens dos combos
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


    //Arrasta menu para baixo no desktop

    $(window).scroll(function(e) {
        if ($(this).scrollTop() >= 120) {
            $('div.pizzaro-secondary-navigation').attr('style', 'position:fixed;box-shadow: 0px -3px 10px;background: #FFF;top:0;margin-top:-20px;');
            $('header#masthead').attr('style','width:85%;')
        } else {
            $('div.pizzaro-secondary-navigation').attr('style', 'background: #FFF;');
            $('header#masthead').attr('style','')
        }
    });
</script>

</body>

</html>