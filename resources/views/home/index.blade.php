@include('layouts.header')

<style>
    h1.lateral:before {
        border-top: 1px solid #666;
        width: 10px;
        height: 1px;
    }

    h1.lateral:after {
        border-top: 1px solid #666;
        width: 10px;
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
    <div style="margin-top:50px;padding-left: 56px;padding-right: 40px;">
        <div id="primary">
            <main id="main" class="site-main">
                <div class="section-products">
                    <h2 class="section-title" style="padding-top: 58px;">{{ __('Monte seu Combo') }}</h2>
                    @include('components.combos')
                </div>
                <div class="section-products">
                    <h2 class="section-title" style="padding-top: 58px;">{{ __('Pizzas mais pedidas') }}</h2>
                    @include('components.pizzas_mais_pedidas')
                </div>
                <div class="section-products">
                    <h2 class="section-title" style="padding-top: 58px;">{{ __('Bebidas Mais Pedidas') }}</h2>
                    @include('components.bebidas_mais_vendidas')
                </div>
                <div class="section-products">
                    <h2 class="section-title" style="padding-top: 58px;">{{ __('Sobremesas mais Pedidas') }}</h2>
                    @include('components.sobremesas')
                </div>
            </main>
        </div>
    </div>
</div>
<div class="modal">
    <div>
        <h2>Título</h2>
    </div>
    <div> assa </div>
</div>
<div class="fundoModal"></div>
@include('components.mapa')
@include('layouts.footer')