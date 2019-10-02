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
                    <a href="{{ route('user') }}">{{ __('Pedidos') }}</a>
                    <span class="delimiter"><i class="po po-arrow-right-slider"></i></span>
                    {{ __('Pedido N°') }} {{ $cod_pedido }}
                </nav>
            </div>
            <div id="primary" class="content-area" style="width:100%;">
                <main id="main" class="site-main">
                    <div class="entry-content">
                        <h1>
                            {{ __('Meu Pedido') }} - {{ $cod_pedido }}
                            <span style="float:right;">
                                <a class="btn btn-success" href="{{ route('refazer-pedido',$cod_pedido) }}">{{ __('Refazer Pedido') }}</a>
                            </span>
                        </h1>
                        <hr />
                        @include('clientes/pedido_ifood')
                        @include('clientes/pedido_sistema')
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>{{ __('Campo') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($pedido))
                                <tr>
                                    <td>{{ __('Código do Pedido') }}</td>
                                    <td>{{ $pedido->cod_pedidos }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Data e Hora do Pedido') }}</td>
                                    <td>{{ date('d/m/Y H:i:s',strtotime($pedido->data_hora_pedido)) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Valor total') }}</td>
                                    <td>{{ __('R$') }}{{ $pedido->valor_total }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Nome do cliente') }}</td>
                                    <td>{{ $pedido->nome_cliente }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Endereço') }}</td>
                                    <td>{{ $pedido->endereco }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Complemento') }}</td>
                                    <td>{{ $pedido->complemento }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Edifício') }}</td>
                                    <td>{{ $pedido->edificio }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Bairro') }}</td>
                                    <td>{{ $pedido->bairro }}</td>
                                </tr>
                                <tr>
                                    <td>{{ __('Estado') }}</td>
                                    <td>{{ $pedido->cidade }}</td>
                                </tr>
                                @if($pedido->arquivo_json['status'] == 'autorizado')
                                <tr>
                                    <td>{{ __('CUPOM FISCAL') }}</td>
                                    <td>
                                        <a href="http://api.focusnfe.com.br{{ $pedido->arquivo_json['caminho_xml_nota_fiscal'] }}" target="_blank">
                                            <i class="fa fa-qrcode notaFiscal"></i>
                                        </a>
                                        <a href="http://api.focusnfe.com.br{{ $pedido->arquivo_json['caminho_danfe'] }}" target="_blank">
                                            {{ __('DANFE') }}
                                        </a>
                                    </td>
                                </tr>
                                @endif
                                @else
                                <tr>
                                    <td colspan="2">{{ __('Nenhum dado foi encontrado') }}</td>
                                </tr>
                                @endif
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