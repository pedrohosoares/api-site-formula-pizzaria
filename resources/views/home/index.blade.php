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
    <div style="margin-top:50px;padding-left: 56px;padding-right: 40px;">
        <div id="primary">
            <main id="main" class="site-main">
                @include('components.bebidas')
                @include('components.pizzas')
                @include('components.combos')
                @include('components.pizzas_mais_pedidas')
                @include('components.bebidas_mais_vendidas')
                @include('components.sobremesas')
            </main>
        </div>
    </div>
</div>
@include('components.modal_pedido')
<script>
    const pegaBordas = function(cod_tamanho) {
        $.ajax({
            'method': "GET",
            'url': "<?php echo URL::to('/'); ?>" + '/api/ajaxBordas/' + cod_tamanho + '/' + <?php echo $cod_pizzarias; ?>,
            'data': {
                _token: csrf_token
            },
            'dataType': "JSON",
            complete: function(r) {
                if (r.responseJSON[0]) {
                    let borda;
                    borda = '';
                    r.responseJSON.forEach(function(v) {
                        borda += '<div class="form-check form-check-inline">';
                        borda += '<input class="form-check-input" type="radio" name="ipi_pedidos_bordas[cod_bordas]" value="' + v.cod_bordas + '">';
                        borda += '<label class="form-check-label" for="inlineCheckbox1">' + v.borda + ' <i>R$' + v.preco + '</i></label>';
                        borda += '</div>';
                        $('div#bordas div.col-sm-9').html(borda);
                    });
                }
            }
        });
    }

    const poeIngredientesDaPizza = function(cod_pizzas){
        //Continuar ajax
    }

    //JSON de dados para motar tela de pedido
    const poeDadosJanelaModal = function(elemento) {
        let json = JSON.parse($(elemento).parents('li').attr('json'));
        $('div.modal-dialog h2#tituloPedido').text(json[0].pizza);
        let tamanho;
        tamanho = '';
        poeIngredientesDaPizza(json[0].cod_pizzas);
        json.forEach(function(v) {
            tamanho += '<div class="form-check form-check-inline">';
            tamanho += '<input class="form-check-input" type="radio" name="ipi_pedidos_pizzas[cod_tamanhos]" value="' + v.cod_tamanhos + '">';
            tamanho += '<label class="form-check-label" for="inlineCheckbox1">' + v.tamanho + ' <i>R$' + v.preco + '</i></label>';
            tamanho += '</div>';
            $('div#tamanhos div.col-sm-9').html(tamanho);
        });

        let tamanhos = $('input[name="ipi_pedidos_pizzas[cod_tamanhos]"]');
        $(tamanhos).click(function(e) {
            let cod_tamanhos = $(this).val();
            pegaBordas(cod_tamanhos);
        });

    }

    $('.fazer-pedido').click(function(e) {
        e.preventDefault();
        $('.modalFazerPedido').modal('show');
    });
</script>
@include('components.mapa')
@include('layouts.footer')