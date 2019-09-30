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
<header id="masthead" class="site-header header-v1" style="background-image: none;margin-top: -29px;height: 172px;width:100%;">
    <div class="col-full">
        <a class="skip-link screen-reader-text" href="#site-navigation">{{ __('Sair para navegação') }}</a>
        <a class="skip-link screen-reader-text" href="#content">{{ __('Sair para conteúdo') }}</a>

        @include('components/menu_loja')
    </div>
</header>