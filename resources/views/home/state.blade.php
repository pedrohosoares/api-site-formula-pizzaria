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
    @include('layouts.menu_formula')
    <div style="margin-top:50px;padding-left: 56px;padding-right: 40px;">
        <div id="primary">
            <h1 class="titulo text-center">
                @if(!empty($estado))
                {{ __('Fórmula Pizzaria no estado de ').$estado }}
                @else
                {{ __('Conheça todas unidades da Fórmula Pizzaria') }}
                @endif
            </h1>
            <main id="main" class="site-main">
                <div class="columns-3">
                    <ul class="products">
                        @foreach($pizzas as $pizzaria)
                        <li class="product first lojas">
                            <div class="product-outer">
                                <div class="product-inner">
                                    <div class="product-image-wrapper">
                                        <a href="{{ URL::to('/')}}/lojas/{{ $pizzaria->estado }}/{{ $pizzaria->slug }}" rel="Fórmula Pizzaria {{ $pizzaria->nome }}" class="woocommerce-LoopProduct-link">
                                            <figure class="logo-formula-pizzarias">
                                                @if(!empty($pizzaria->foto_pequena))
                                                <img src="{{ env('IMG_PIZZARIAS').$pizzaria->foto_pequena }}" class="img-responsive" alt="">
                                                @else
                                                <img src="{{ asset('img/formula_pizzaria_delivery.jpg') }}" class="img-responsive" alt="">
                                                @endif
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="product-content-wrapper">
                                        <a href="{{ URL::to('/')}}/lojas/{{ $pizzaria->estado }}/{{ $pizzaria->slug }}" rel="Fórmula Pizzaria {{ $pizzaria->nome }}" class="woocommerce-LoopProduct-link">
                                            <h3>{{ __($pizzaria->nome) }}</h3>
                                            <div class="yith_wapo_groups_container">
                                                <div class="ywapo_group_container ywapo_group_container_radio form-row form-row-wide " data-requested="1" data-type="radio" data-id="1" data-condition="">
                                                    <p>
                                                        Telefone: {{ $pizzaria->telefone_1 }}<br />
                                                        Cidade: {{ $pizzaria->cidade.' '.$pizzaria->numero.' '.$pizzaria->complemento }}<br />
                                                        Bairro: {{ $pizzaria->bairro }}<br />
                                                        Cep: {{ $pizzaria->cep }}<br />
                                                        @if(!empty($pizzaria->horario_inicial) and !empty($pizzaria->horario_final))
                                                        Horário: {{ $pizzaria->horario_inicial }} até {{ $pizzaria->horario_final }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.product-outer -->
                        </li>
                        @endforeach
                    </ul>
                </div>
            </main>
        </div>
    </div>
</div>
@include('layouts.footer')