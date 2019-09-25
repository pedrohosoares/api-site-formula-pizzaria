<footer id="colophon" class="site-footer footer-v1">
    <div class="col-full">
        <div class="footer-social-icons">
            <span class="social-icon-text">Follow us</span>
            <ul class="social-icons list-unstyled">
                <li><a class="fa fa-facebook" href="https://transvelo.github.io/pizzaro-html/blog-grid.html#"></a></li>
                <li><a class="fa fa-twitter" href="https://transvelo.github.io/pizzaro-html/blog-grid.html#"></a></li>
                <li><a class="fa fa-instagram" href="https://transvelo.github.io/pizzaro-html/blog-grid.html#"></a></li>
                <li><a class="fa fa-youtube" href="https://transvelo.github.io/pizzaro-html/blog-grid.html#"></a></li>
                <li><a class="fa fa-dribbble" href="https://transvelo.github.io/pizzaro-html/blog-grid.html#"></a></li>
            </ul>
        </div>
        <div class="footer-logo">
            <a href="https://transvelo.github.io/pizzaro-html/index.html" class="custom-logo-link" rel="home">
                <img src="{{ asset('img/formula_pizzaria_delivery.jpg') }}" />
            </a>
        </div>
        <div class="site-address">
            <ul class="address">
                <li>Pizzaro Restaurant</li>
                <li>901-947 South Drive, Houston, TX 77057, USA</li>
                <li>Telephone: +1 555 1234</li>
                <li>Fax: +1 555 4444</li>
            </ul>
        </div>
        <div class="site-info">
            <p class="copyright">Copyright © 2017 Pizzaro Template. All rights reserved.</p>
        </div>
        <!-- .site-info --> <a role="button" class="footer-action-btn" data-toggle="collapse" href="https://transvelo.github.io/pizzaro-html/blog-grid.html#footer-map-collapse"><i class="po po-map-marker"></i>Find us on Map</a>
        <div class="pizzaro-handheld-footer-bar">
            <ul class="columns-3">
                <li class="my-account">
                    <a href="https://transvelo.github.io/pizzaro-html/login-and-register.html">My Account</a>
                </li>
                <li class="search">
                    <a href="https://transvelo.github.io/pizzaro-html/blog-grid.html">Search</a>
                    <div class="site-search">
                        <div class="widget woocommerce widget_product_search">
                            <form role="search" method="get" class="woocommerce-product-search">
                                <label class="screen-reader-text" for="woocommerce-product-search-field">Search
                                    for:</label>
                                <input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="Search Products…" value="" name="s" title="Search for:">
                                <input type="submit" value="Search">
                                <input type="hidden" name="post_type" value="product">
                            </form>
                        </div>
                    </div>
                </li>
                <li class="cart">
                    <a class="footer-cart-contents" href="https://transvelo.github.io/pizzaro-html/cart.html" title="View your shopping cart">
                        <span class="count">2</span>
                    </a>
                </li>
            </ul>
        </div>
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