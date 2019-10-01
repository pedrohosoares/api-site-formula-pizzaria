<style>
    .pizzaro-secondary-navigation {
        margin-top: -35px;
    }

    .header-phone-numbers .intro-text {
        color: #FFCB08;
    }

    ul.menu li.menu-item a.cinza {
        color: #2c2c2c;
    }

    .po.po-menu-icon {
        font-size: 50px;
    }

    .font13 {
        font-size: 13px;
    }

    .branco {
        color: #2c2c2c;
    }

    ul.products li.product,
    .products .owl-item>.product {
        height: 500px;
        margin-top: 38px;
    }
</style>
<header id="masthead" class="site-header header-v1" style="background-image: none;margin-top: -29px;height: 120px;width:100%;">
    <div class="col-full">
        <a class="skip-link screen-reader-text" href="#site-navigation">{{ __('Sair para navegação') }}</a>
        <a class="skip-link screen-reader-text" href="#content">{{ __('Sair para conteúdo') }}</a>

        <div class="header-wrap">
            <div class="site-branding">
                <a href="{{ URL::to('/') }}" class="custom-logo-link" rel="home">
                    <img src="{{ asset('img/formula_pizzaria_delivery.jpg') }}" class="">
                </a>
            </div>
            <nav id="site-navigation" class="main-navigation" aria-label="Primary Navigation" style=" width: 100%; ">
                <button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false">
                    <span class="close-icon">
                        <i class="po po-close-delete"></i>
                    </span>
                    <span class="menu-icon">
                        <i class="po po-menu-icon"></i>
                    </span>
                    <span class=" screen-reader-text">{{ __('Menu') }}</span>
                </button>
                <div class="primary-navigation" style="text-align:right;">
                    <ul id="menu-main-menu" class="menu nav-menu" aria-expanded="false">
                        <li class="menu-item">
                            <a href="cart.html">
                                <i class="po po-scooter" style="font-size: 28px;margin-top: -5px;"></i>
                                <span>{{ __('Meus Pedidos') }}</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('accounts') }}">
                                <i class="fa fa-user" style=" font-size: 21px; "></i>
                                <span>{{ __('Minha conta') }}</span>
                            </a>
                        </li>
                        <li class="menu-item"><a href="store-locator.html">{{ __('Contato') }}</a></li>
                    </ul>
                </div>
                <div class="handheld-navigation">
                    <span class="phm-close">{{ __('Fechar') }}</span>
                    <ul class="menu">
                        <li class="menu-item "><a href="shop-grid-3-column.html"><i class="po po-pizza"></i>Pizza</a></li>
                        <li class="menu-item "><a href="shop-grid-3-column.html"><i class="po po-burger"></i>Sanduíches</a></li>
                        <li class="menu-item "><a href="shop-grid-3-column.html"><i class="po po-drinks"></i>Bebidas</a></li>
                        <li class="menu-item "><a href="shop-grid-3-column.html"><i class="po po-wraps"></i>Combos</a></li>
                        <li class="menu-item "><a href="shop-grid-3-column.html"><i class="po po-fries"></i>Sobremesas</a></li>
                    </ul>
                </div>
            </nav>
        </div>

    </div>
</header>