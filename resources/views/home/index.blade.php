@include('layouts.header')

<style>
    h1.lateral:before{
        border-top:1px solid #666;
        width:10px;
        height: 1px;
    }
    h1.lateral:after{
        border-top:1px solid #666;
        width:10px;
        height: 1px;
    }
    .secondary-navigation ul.menu>li>a,
    .secondary-navigation ul.nav-menu>li>a {
        color: #2c2c2c;
    }

    .owl-carousel-home:after {
        content: "";
        display: block;
        position: absolute;
        width: 8%;
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: 0;
        pointer-events: none;
        background: url() no-repeat center 50%;
        background-size: 100% auto;
    }

    .secondary-navigation ul.menu>li>a:hover,
    .secondary-navigation ul.menu>li>a:focus,
    .secondary-navigation ul.nav-menu>li>a:hover,
    .secondary-navigation ul.nav-menu>li>a:focus {
        color: #C00A27;
    }

    .owl-carousel .owl-item img {
        border-radius: 5px;
    }

    .owl-item {
        -webkit-backface-visibility: hidden;
        -webkit-transform: translate(0) scale(1.0, 1.0);
    }

    .item {
        opacity: 0.4;
        transition: .4s ease all;
        transform: scale(.6);
    }

    .item img {
        display: block;
        min-width: 100%;
        width: auto;
        height: auto;
    }

    .active .item {
        display: block;
        width: 100%;
    }

    ul.menu-cima {}

    ul.menu-cima li {
        padding-top: 5px;
        margin-top: -38px !important;
        margin-bottom: -45px !important;
    }

    ul.menu-cima li a {
        color: #2c2c2c !important;
        font-weight: 600;
    }

    ul.menu-cima li a.font13 {
        font-size: 12px;
        font-weight: 100;
    }
</style>
<div id="page" class="hfeed site">
    @include('layouts.topo_menu_abaixo')
    <div class="owl-carousel owl-theme" style="padding-left: 86px; padding-right: 79px; ">
        @foreach($combos as $combo)
        <div style=" border: 1px solid #ccc; border-radius: 12px; margin: 10px; ">
            <a href="{{ route('combos').'/'.Str::slug($combo->nome_combo) }}" rel="{{ $combo->nome_combo }} - {{ $combo->descricao_combo }}">
                <img src="{{ env('COMBO_IMG').'1_combo_p.png' }}" alt="{{ $combo->nome_combo }} - {{ $combo->descricao_combo }}" />
                <h2 class="text-center" style="font-size:20px;color:#C00A27;">{{ $combo->nome_combo }}</h2>
            </a>
        </div>
        @endforeach
        <div style=" border: 1px solid #ccc; border-radius: 12px; margin: 10px; ">
            <a href="" rel="">
                <img src="https://acconstorage.blob.core.windows.net/acconpictures/15646056504555553664649235772-1080p.jpg" alt="" />
            </a>
        </div>
        <div style=" border: 1px solid #ccc; border-radius: 12px; margin: 10px; ">
            <a href="" rel="">
                <img src="https://acconstorage.blob.core.windows.net/acconpictures/15651211424929539796054857055-1080p.jpg" alt="" />
            </a>
        </div>
        <div style=" border: 1px solid #ccc; border-radius: 12px; margin: 10px; ">
            <a href="" rel="">
                <img src="https://acconstorage.blob.core.windows.net/acconpictures/15646054715067314308291534108-1080p.jpg" alt="" />
            </a>
        </div>

    </div>
    <div style="margin-top:50px;padding-left: 56px;padding-right: 40px;">
        <div id="primary">
            <h1 class="lateral" style=" text-align: center; color: #2c2c2c; ">Pizzas mais pedidas</h1>
            <main id="main" class="site-main">
                <div class="columns-3">
                    <ul class="products">
                        @foreach($pizzas as $pizza)
                        <li class="product first">
                            <div class="product-outer">
                                <div class="product-inner">
                                    <div class="product-image-wrapper">
                                        <a href="single-product-v1.html" class="woocommerce-LoopProduct-link">
                                            <img src="{{ env('IMG_SALGADO').$pizza['foto_grande'] }}" class="img-responsive" alt="">
                                        </a>
                                    </div>
                                    <div class="product-content-wrapper">
                                        <a href="single-product-v1.html" class="woocommerce-LoopProduct-link">
                                            <h3>{{ __($pizza['pizza']) }}</h3>
                                            <div itemprop="description">
                                                <p style="max-height: none;" class="ingredientes">

                                                </p>
                                            </div>
                                            <div class="yith_wapo_groups_container">
                                                <div class="ywapo_group_container ywapo_group_container_radio form-row form-row-wide " data-requested="1" data-type="radio" data-id="1" data-condition="">
                                                    <h3>
                                                        <span>Tamanhos</span>
                                                    </h3>
                                                    @foreach($pizza['tamanhos'] as $tamanho)
                                                    <div class="ywapo_input_container ywapo_input_container_radio">
                                                        <span class="ywapo_label_tag_position_after">
                                                            <span class="ywapo_option_label ywapo_label_position_after">{{ __($tamanho['tamanho']) }}</span>
                                                        </span>
                                                        <span class="ywapo_label_price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">{{ __('R$') }}</span>{{ number_format($tamanho['preco'],2) }}</span>
                                                        </span>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </a>
                                        <div class="hover-area">
                                            <a rel="nofollow" href="single-product-v1.html" data-quantity="1" data-product_id="51" data-product_sku="" class="button product_type_simple add_to_cart_button ajax_add_to_cart">
                                                {{ __('Add ao carrinho') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.product-outer -->
                        </li>
                        @endforeach
                        <!-- /.products -->
                    </ul>
                </div>
                <nav class="woocommerce-pagination">
                    <ul class="page-numbers">
                        <li>
                            <span class="page-numbers current">1</span>
                        </li>
                        <li>
                            <a class="page-numbers" href="#">2</a>
                        </li>
                        <li>
                            <a class="page-numbers" href="#">3</a>
                        </li>
                        <li>
                            <a class="next page-numbers" href="#">Carregar mais &nbsp;&nbsp;&nbsp;→</a>
                        </li>
                    </ul>
                </nav>
            </main>
        </div>
    </div>
</div>
@include('layouts.footer')