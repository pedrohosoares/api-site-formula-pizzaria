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
                <nav class="woocommerce-breadcrumb"><a href="index.html">Home</a><span class="delimiter"><i class="po po-arrow-right-slider"></i></span>My Account</nav>
            </div>
            <div id="primary" class="content-area" style="width:100%;">
                <main id="main" class="site-main">
                    <div class="entry-content">
                        <div class="woocommerce">
                            <div class="customer-login-form">
                                <div class="u-columns col2-set" id="customer_login">
                                    <div class="u-column1 col-1" style="width: 49.99999%;float: left;">
                                        <h2>{{ __('Login / Cadastre-se') }}</h2>
                                        <form class="login">
                                            <p class="before-login-text">{{ __('Bem vindo, faça seu login abaixo:') }}</p>
                                            <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                <label for="username">{{ __('Username ou e-mail') }} 
                                                    <span class="required">*</span>
                                                </label>
                                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="">
                                            </p>
                                            <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
                                                <label for="password"> {{ __('Password') }} 
                                                    <span class="required">*</span>
                                                </label>
                                                <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password">
                                            </p>
                                            <p class="form-row">
                                                <input type="hidden" id="woocommerce-login-nonce" name="woocommerce-login-nonce" value="02aaeb6b10">
                                                <input type="hidden" name="_wp_http_referer" value="/pizzaro/my-account/">
                                                <input type="submit" class="woocommerce-Button button" name="login" value="Login">
                                            </p>
                                            <p class="woocommerce-LostPassword lost_password">
                                                <a href="#">{{ __('Perdeu a senha?') }}</a>
                                            </p>
                                            <div class="register-benefits">
                                                <h3>{{ __('Seja um usuário cadastrado da Fórmula Pizzaria') }}</h3>
                                                <ul>
                                                    <li>{{ __('Promoções exclusivas') }}</li>
                                                    <li>{{ __('Bônus nos pedidos') }}</li>
                                                    <li>{{ __('Vantagens e brindes') }}</li>
                                                </ul>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>
@include('components.mapa')
@include('layouts.footer')