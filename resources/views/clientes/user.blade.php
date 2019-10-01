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

    .loading {
        -webkit-animation: rotation 2s infinite linear;
        width: 20px;
        height: 20px;
        border: 2px dotted red;
        border-radius: 100%;
        z-index: 99999;
    }

    @-webkit-keyframes rotation {
        from {
            -webkit-transform: rotate(0deg);
        }

        to {
            -webkit-transform: rotate(359deg);
        }
    }
</style>
<div id="page" class="hfeed site">
    @include('clientes.layouts.menu_cliente')
    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
            <div class="pizzaro-breadcrumb">
                <nav class="woocommerce-breadcrumb">
                    <a href="index.html">Home</a>
                    <span class="delimiter"><i class="po po-arrow-right-slider"></i></span>
                    Pedidos
                </nav>
            </div>
            <div id="primary" class="content-area" style="width:100%;">
                <main id="main" class="site-main">
                    <div class="entry-content">
                        <h1>{{ __('Meus Pedidos') }} <span class="pull-right">123012 <i>pontos</i></span></h1>
                        <hr />
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>{{ __('Data do Pedido') }}</th>
                                    <th>{{ __('Pedido') }}</th>
                                    <th>{{ __('Valor') }}</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>20/06/2019 19:30</td>
                                    <td>PIZZA 35 CM (8 FATIAS) - MUSSARELA</td>
                                    <td>R$65,02</td>
                                    <td><button class="btn btn-primary">Repetir pedido</button></td>
                                    <td><button class="btn btn-success">Ver pedido completo</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>
@include('components.mapa')
@include('layouts.footer')