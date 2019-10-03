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

    .notaFiscal {
        font-size: 43px;
    }
</style>
<div id="page" class="hfeed site">
    @include('clientes.layouts.menu_cliente')
    <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
            <div class="pizzaro-breadcrumb">
                <nav class="woocommerce-breadcrumb">
                    <a href="{{ route('clientes') }}">Home</a>
                    <span class="delimiter"><i class="po po-arrow-right-slider"></i></span>
                    Pedidos
                </nav>
            </div>
            <div id="primary" class="content-area" style="width:100%;">
                <main id="main" class="site-main">
                    <div class="entry-content">
                        <h1>{{ __('Meus Pedidos') }} <span class="pull-right">123012 <i>{{ __('pontos') }}</i></span></h1>
                        <hr />
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>{{ __('Data do Pedido') }}</th>
                                    <th>{{ __('Valor') }}</th>
                                    <th></th>
                                    <th></th>
                                    <th class="text-center">{{ __('Nota Fiscal') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($pedidos))
                                @foreach($pedidos as $pedido)
                                <tr>
                                    <td>{{ date('d/m/Y H:i:s',strtotime($pedido->data_hora_pedido)) }}</td>
                                    <td>{{ __('R$') }}{{ $pedido->valor_total }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-primary" href="{{ route('refazer-pedido',$pedido->cod_pedidos) }}">{{ __('Repetir pedido') }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-success" href="{{ route('pedido-completo',$pedido->cod_pedidos) }}">{{ __('Ver pedido completo') }}</a>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $nota = json_decode($pedido->arquivo_json, true);
                                        ?>
                                        @if($nota['status'] == 'autorizado')
                                        <a href="http://api.focusnfe.com.br{{ $nota['caminho_xml_nota_fiscal'] }}" target="_blank">
                                            <i class="fa fa-qrcode notaFiscal"></i>
                                        </a>
                                        @else
                                        {{ __('Não disponível para download') }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5">{{ __('Nenhum pedido encontrado') }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $pedidos->links() }}
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>
@include('components.mapa')
@include('layouts.footer')