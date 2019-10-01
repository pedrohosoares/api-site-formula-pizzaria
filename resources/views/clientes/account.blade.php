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
                    Minha Conta
                </nav>
            </div>
            <div id="primary" class="content-area" style="width:100%;">
                <main id="main" class="site-main">
                    <div class="entry-content">
                        <h1>{{ __('Minha Conta') }} </h1>
                        <hr />
                        <form method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputEmail3" class="col-sm-2 control-label">{{ __('E-mail') }}</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="ipi_clientes[nome]" value="" class="form-control" id="inputEmail3" placeholder="{{ __('E-mail') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword3" class="col-sm-2 control-label">{{ __('Senha') }}</label>
                                    <div class="col-sm-10">
                                        <input type="password" value="" name="ipi_clientes[senha]" class="form-control" placeholder="{{ __('Senha') }}" />
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputEmail3" class="col-sm-2 control-label">{{ __('CPF') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="ipi_clientes[cpf]" value="" class="form-control" placeholder="{{ __('CPF') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword3" class="col-sm-2 control-label">{{ __('Celular') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="ipi_clientes[celular]" class="form-control" placeholder="{{ __('Celular') }}">
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputEmail3" class="col-sm-2 control-label">{{ __('Telefone') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="ipi_clientes[telefone_1]" value="" class="form-control" placeholder="{{ __('Telefone') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword3" class="col-sm-2 control-label">{{ __('Telefone Adicional') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="ipi_clientes[telefone_2]" class="form-control" placeholder="{{ __('Telefone') }}">
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputEmail3" class="col-sm-2 control-label">{{ __('Data Nascimento') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="ipi_clientes[cpf]" value="" class="form-control" placeholder="{{ __('Data Nascimento') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword3" class="col-sm-2 control-label">{{ __('Sexo') }}</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="ipi_clientes[sexo]">
                                            <option value="M">{{ __('Masculino') }}</option>
                                            <option value="F">{{ __('Feminino') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <h1>{{ __('Endereço') }}</h1>
                            <hr />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputEmail3" class="col-sm-2 control-label">{{ __('Rua') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="ipi_enderecos[endereco]" value="" class="form-control" placeholder="{{ __('Endereço') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword3" class="col-sm-2 control-label">{{ __('Número') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="ipi_enderecos[numero]" value="" class="form-control" placeholder="{{ __('Endereço') }}">
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputEmail3" class="col-sm-2 control-label">{{ __('Bairro') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="ipi_enderecos[bairro]" value="" class="form-control" placeholder="{{ __('Endereço') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail3" class="col-sm-2 control-label">{{ __('Cidade') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="ipi_enderecos[cidade]" value="" class="form-control" placeholder="{{ __('Cidade') }}">
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputEmail3" class="col-sm-2 control-label">{{ __('Cep') }}</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="ipi_enderecos[cep]" value="" class="form-control" placeholder="{{ __('Cep') }}">
                                    </div>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-lg btn-primary">
                                        {{ __('Cadastrar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </div>
</div>
@include('components.mapa')
@include('layouts.footer')