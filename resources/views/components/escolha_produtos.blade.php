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
    @include('components.combos')
    <div style="margin-top:50px;padding-left: 56px;padding-right: 40px;">
        <div id="primary">
            <main id="main" class="site-main">
                @foreach($tipo as $menu)
                    <h1 class="lateral" style=" text-align: center; color: #2c2c2c; ">{{ __($menu->tipo_pizza) }}</h1>
                @endforeach
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

<script>
    const itens = document.querySelectorAll('div.product-inner');
    itens.forEach((v) => {
        v.onclick = (e) {
            e.preventDefault();
            console.log(teste);
        }
    });
</script>
@include('layouts.footer')