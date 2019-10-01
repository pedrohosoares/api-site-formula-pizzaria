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
    const valores = {
        "bebidas": [
            {
                "cod_bebidas": "",
                "cod_bebidas_ipi_conteudos": "",
                "nome": "",
                "preco": ""
            }
        ],
        "combos": [{
            "cod_combos": "",
            "nome": "",
            "preco": ""
        }],
        "tamanho": {
            "cod_tamanhos": "",
            "tamanho": "",
            "preco": 0.00
        },
        "borda": {
            "cod_bordas": "",
            "borda": "",
            "preco": 0.00
        },
        "adicionais": [],
        "quantidade": 1
    };

    const quantidadePadrao = function() {
        $('input[name="quantidade"]').val(valores.quantidade);
    }

    quantidadePadrao();

    const mudaQuantidadeItens = function() {
        $('span.qntdPedidoPlus,span.qntdPedidoMinus').click(function() {
            let este = $(this).parent().find('input[name="quantidade"]').val();
            valores.quantidade = Number.parseInt(este);
        });
    }

    mudaQuantidadeItens();



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
                        borda += '<input class="form-check-input" required type="radio" borda="' + v.borda + '" preco="' + v.preco + '" name="ipi_pedidos_bordas[cod_bordas]" value="' + v.cod_bordas + '">';
                        borda += '<label class="form-check-label" for="inlineCheckbox1">' + v.borda + ' R$<i>' + v.preco + '</i></label>';
                        borda += '</div>';
                        $('div#bordas div.col-sm-9').hide().html(borda).fadeIn(400);
                    });
                    //COLOCA DADOS DE ESCOLHA
                    salvaBorda();
                }
            }
        });
    }

    const poeIngredientesDaPizza = function(cod_pizzas) {
        $.ajax({
            'method': "GET",
            'url': "<?php echo URL::to('/'); ?>" + '/api/ajaxIngredientes/' + cod_pizzas,
            'data': {
                _token: csrf_token
            },
            'dataType': "JSON",
            complete: function(r) {
                if (r.responseJSON[0]) {
                    let ingrediente;
                    ingrediente = '';
                    r.responseJSON.forEach(function(v) {
                        if (v.ingrediente.includes('Massa') == 0 && v.ingrediente.includes('Lacre') == 0 && v.ingrediente.includes('Caixa') == 0) {
                            ingrediente += v.ingrediente + ',';
                        }
                    });
                    ingrediente = ingrediente.substring(0, ingrediente.length - 1) + '.';
                    $('p#ingrediente').hide().html(ingrediente).fadeIn(400);
                }
            }
        });
    }

    //SOMA TOTAL DO VALOR
    const somaValorTotal = function() {

        let valorPedido;
        valorPedido = 0.00;


        for (e in valores) {

            if (e == 'adicionais' && valores[e].length == undefined) {
                valores[e].forEach(function(adicional) {
                    valorPedido += Number.parseFloat(adicional.preco);
                });
            }

            if (e == 'borda' && valores[e].length == undefined) {
                valorPedido += Number.parseFloat(valores[e].preco);
            }

            if (e == 'tamanho' && valores[e].length == undefined) {
                valorPedido += Number.parseFloat(valores[e].preco);
            }
            if (e == 'quantidade' && valores[e].length == undefined) {
                valorPedido = valorPedido * Number.parseInt(valores[e]);
            }

        };

        valorPedido = valorPedido.toFixed(2);

        $('button span#valorTotal').text(valorPedido);

    }


    //INCREMENTA OU DIMINUI INGREDIENTE

    const salvaIngrediente = function(dados) {

        let cod_ingrediente = $(dados).attr('cod_ingredientes');
        let preco = $(dados).attr('preco');
        let nome = $(dados).attr('nome');
        let quantidade = $(dados).val();

        if (valores.adicionais.length == 0) {

            valores.adicionais.push({
                "nome": nome,
                "preco": preco,
                "quantidade": quantidade,
                "cod_ingredientes": cod_ingrediente
            });

        } else {

            valores.adicionais.forEach(function(v, i) {

                //SE NÃO EXISTIR
                if (v.nome == undefined) {

                    valores.adicionais.push({
                        "nome": nome,
                        "preco": preco,
                        "quantidade": quantidade,
                        "cod_ingredientes": cod_ingrediente
                    });

                } else {
                    //SE EXISTIR
                    if (v.nome == nome) {
                        valores.adicionais[i].nome = nome;
                        valores.adicionais[i].preco = preco;
                        valores.adicionais[i].cod_ingredientes = cod_ingrediente;
                        valores.adicionais[i].quantidade = quantidade;
                    } else {

                        valores.adicionais.push({
                            "nome": nome,
                            "preco": preco,
                            "quantidade": quantidade,
                            "cod_ingredientes": cod_ingrediente
                        });

                    }

                }
            });
        }

        //SOMA VALORES
        somaValorTotal();
    }

    const plusIngrediente = function() {
        $('span.plus').mousedown(function(e) {
            e.preventDefault();
            let este = this;
            let valor;
            valor = $(este).parent().find('input.input-addingredientes').val();
            valor = Number.parseInt(valor);

            let dados = $(este).parent().find('input.input-addingredientes');
            //SALVA ADICIONAIS
            salvaIngrediente(dados);

            if (valor == NaN || valor < 0) {
                valor = 0;
            } else {
                valor = valor + 1;
            }
            $(este).parent().find('input.input-addingredientes').val(valor);
        });
    }

    const minusIngrediente = function() {
        $('span.minus').mousedown(function(e) {
            e.preventDefault();
            let este = this;
            let valor;
            valor = $(este).parent().find('input.input-addingredientes').val();
            valor = Number.parseInt(valor);
            if (valor == NaN || valor < 1) {
                valor = 0;
            } else {
                valor = valor - 1;
            }

            let dados = $(este).parent().find('input.input-addingredientes');
            //SALVA ADICIONAIS
            salvaIngrediente(dados);

            $(este).parent().find('input.input-addingredientes').val(valor);
        });
    }


    //CARREGA ADICIONAIS

    const adicionais = function(cod_pizzarias, cod_tamanhos) {
        $.ajax({
            'method': "GET",
            'url': "<?php echo URL::to('/'); ?>" + '/api/ajaxIngredientesAdicionais/' + cod_pizzarias + '/' + cod_tamanhos,
            'data': {
                _token: csrf_token
            },
            'dataType': "JSON",
            complete: function(r) {
                let response;
                response = '';
                if (r.responseJSON.length > 0) {
                    r.responseJSON.forEach(function(v) {
                        response += '<div class="conjuntoQuantidade">';
                        response += '<div class="form-check form-check-inline addIngrediente">';
                        response += '<span class="plus">+</span>';
                        response += '<input type="text" preco="' + v.preco + '" nome="' + v.ingrediente + '" cod_ingredientes="' + v.cod_ingredientes + '" name="ipi_ingredientes[' + v.cod_ingredientes + ']" value="0" class="form-check-input input-addingredientes">';
                        response += '<span class="minus">-</span>';
                        response += '</div>';
                        response += '<label class="form-check-label nomeIngrediente" for="inlineCheckbox1"> ' + v.ingrediente + ' <span>';
                        response += 'R$<i>' + v.preco + '</i>';
                        response += '</span>';
                        response += '</label>';
                        response += '</div>';
                    });
                } else {
                    response = "<i>Não sugerimos nenhum adicionais para esse pedido! ;)</i>";
                }
                $('div#adicionais').hide().html(response).fadeIn(400);

                plusIngrediente();
                minusIngrediente();
            }
        });
    }

    const salvaBorda = function() {
        $('input[name="ipi_pedidos_bordas[cod_bordas]"]').click(function(e) {
            valores.borda.cod_bordas = $(this).val();
            valores.borda.borda = $(this).attr('borda');
            valores.borda.preco = $(this).attr('preco');

            //SOMA VALORES
            somaValorTotal();

        });
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
            tamanho += '<input class="form-check-input" required type="radio" name="ipi_pedidos_pizzas[cod_tamanhos]" tamanho="' + v.tamanho + '" preco="' + v.preco + '" value="' + v.cod_tamanhos + '">';
            tamanho += '<label class="form-check-label" for="inlineCheckbox1">' + v.tamanho + ' R$<i>' + v.preco + '</i></label>';
            tamanho += '</div>';
            $('div#tamanhos div.col-sm-9').hide().html(tamanho).fadeIn(400);
        });

        let tamanhos = $('input[name="ipi_pedidos_pizzas[cod_tamanhos]"]');

        $(tamanhos).click(function(e) {

            let cod_tamanhos = $(this).val();

            //COLOCA DADOS DE ESCOLHA
            valores.tamanho.cod_tamanhos = cod_tamanhos;
            valores.tamanho.preco = $(this).attr('preco');
            valores.tamanho.tamanho = $(this).attr('tamanho');
            
            //pegaBordas(cod_tamanhos);
            adicionais(<?php echo $cod_pizzarias; ?>, cod_tamanhos);

            //SOMA VALORES
            somaValorTotal();

        });

    }

    $('.fazer-pedido').click(function(e) {
        e.preventDefault();
        $('.modalFazerPedido').modal('show');
    });
</script>
@include('components.mapa')
@include('layouts.footer')