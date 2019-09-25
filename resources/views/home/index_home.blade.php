@include('layouts.header')

<style>
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
    <div class="owl-carousel sliderHome owl-theme owl-loaded" style=" margin-top: -73px; padding-left: 86px; padding-right: 79px; ">
        <div class="owl-stage-outer">
            <div class="owl-stage">
                <div class="owl-item">
                    <a href="" rel="">
                        <img class="img-responsive" src="{{ asset('img/pizza-do-alto-formula-pizzaria.jpg') }}" alt="" style=" width: 99%; margin: auto; border-radius: 10px; ">
                    </a>
                </div>
            </div>
        </div>
        <div class="owl-dots">
            <div class="owl-dot active"><span></span></div>
        </div>
    </div>
    <div style="margin-top:50px;padding-left: 56px;padding-right: 40px;">
        <div id="primary">
            <main id="main" class="site-main">
                <div class="columns-3">
                    <ul class="products">
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
<div class="modal">
    <div>
        <h2>Título</h2>
    </div>
    <div> assa </div>
</div>
<div class="fundoModal"></div>

<script>
    const itens = document.querySelectorAll('div.product-inner a');
    itens.forEach((v)=>{
        v.onclick = (e){
            e.preventDefault();
            console.log(teste);
        }
    });
</script>
@include('layouts.footer')