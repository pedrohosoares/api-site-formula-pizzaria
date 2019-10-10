@if($pedido->origem_pedido == 'IFOOD')

@else
<style>
    .image {
        -webkit-animation: spin 2s linear infinite;
        -moz-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-moz-keyframes spin {
        100% {
            -moz-transform: rotate(360deg);
        }
    }

    @-webkit-keyframes spin {
        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    .salgados {
        display: none;
    }

    .preload {
        width: 100%;
        display: block;
        padding-top: 20px;
        height: 100%;
        display: block;
    }

    .imgPizza {
        display: block;
        background: #FFF;
        height: 300px;
    }

    .imgDireita {
        border-right: 5px solid #FFF;
    }

    .imgEsquerda {
        background-position-x: 100% !important;
        background-position-y: 0% !important;
    }

    div.conjuntoQuantidade {
        display: block;
        width: 336px;
        height: 54px;
        float: left;
    }

    .imgOutros {
        display: block !important;
        background-repeat: no-repeat !important;
        height: 300px !important;
        background-size: 300px !important;
        background-position: center !important;
    }

    .adicionadoAoCarrinho {
        position: fixed;
        right: 0;
        width: 225px;
        background: #FFF;
        height: 50px;
        border-radius: 0px 0px 0px 10px;
        padding: 10px;
        color: #000;
        font-family: sans-serif;
        font-weight: 600;
        top: -1px;
        z-index: 99999;
        box-shadow: #666 0px 0px 5px;
    }

    @media (max-width:662px) {
        button.comprar {
            width: 95%;
            position: fixed;
            bottom: 4px;
            z-index: 9;
        }
    }
</style>
<div class="preload">
    <img src="<?php echo asset('img'); ?>/preloader-3.gif" style="text-align: center;margin: auto;width:140px;">
    <p style="text-align:center;color: #000;font-weight: 600;">{{ __('Carregando..') }}</p>
</div>

<form action="" method="" id="formEscolhe" style="display:none;">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <label for="">{{ __('Produto') }}</label>
                    <br>
                    <select name="produto" id="" class="form-control">
                        <option value="salgado">{{ __('Salgados') }}</option>
                        <option value="sobremesa">{{ __('Sobremesas') }}</option>
                        <option value="bebida">{{ __('Bebidas') }}</option>
                    </select>
                </div>
                <div class="row salgados">
                    <label for="">{{ __('Tamanhos / Tipos') }}</label>
                    <br>
                    <select name="cod_tamanhos" id="" class="form-control">
                        <option value="" json="{}">{{ __('Selecione') }}</option>
                        @foreach($tamanhos as $i=>$v)
                        <option value="{{ $v->cod_tamanhos }}" json="{{ json_encode($v,true) }}">{{ $v->tamanho }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row bebidas" style="display:none;">
                    <label for="">{{ __('Bebidas') }}</label>
                    <br>
                    <select name="cod_bebidas_ipi_conteudos_bebida" id="" class="form-control">
                        <option value="" json="{}">{{ __('Selecione') }}</option>
                        @foreach($bebidas as $b)
                        <option value="{{ $b->cod_bebidas_ipi_conteudos }}" json="{{ json_encode($b,true) }}">{{ $b->bebida.' '.$b->conteudo.' - '.__('R$').$b->preco }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row sobremesas" style="display:none;">
                    <label for="">{{ __('Sobremesas') }}</label>
                    <br>
                    <select name="cod_bebidas_ipi_conteudos_sobremesas" id="" class="form-control">
                        <option value="" json="{}">{{ __('Selecione') }}</option>
                        @foreach($sobremesas as $b)
                        <option value="{{ $b->cod_bebidas_ipi_conteudos }}" json="{{ json_encode($b,true) }}">{{ $b->bebida.' '.$b->conteudo.' - '.__('R$').$b->preco }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row" style="display:none;">
                    <label for="">{{ __('Tipo de massa') }}</label>
                    <br>
                    <select name="cod_tipo_massas" id="" class="form-control">
                        <option value="" json="{}">{{ __('Selecione') }}</option>
                        @foreach($tipo_massa as $i=>$v)
                        <option value="{{ $v->cod_tipo_massa }}" json="{{ json_encode($v,true) }}">{{ $v->tipo_massa }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row salgados">
                    <label for="">{{ __('Borda') }}</label>
                    <br>
                    <select name="cod_bordas" id="" class="form-control">
                        <option value="0" json="{}">{{ __('Normal') }}</option>
                        @foreach($borda as $i=>$v)
                        <option value="{{ $v->cod_bordas }}" json="{{ json_encode($v,true) }}">{{ $v->borda }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row salgados">
                    <label for="">{{ __('Meio a Meio?') }}</label>
                    <br>
                    <select name="cod_fracoes" id="" class="form-control">
                        <option value="1">{{ __('Não') }}</option>
                        <option value="2">{{ __('Sim') }}</option>
                    </select>
                </div>
                <div class="row salgados">
                    <label for="">{{ __('Sabor') }}</label>
                    <br />
                    <select name="cod_pizzas_1" id="" class="form-control">
                        <option value="" json="{}">{{ __('Selecione o tamanho') }}</option>
                    </select>
                </div>
                <div class="row salgados hide">
                    <label for="">{{ __('Corte') }}</label>
                    <br>
                    <select name="cod_opcoes_corte" id="" class="form-control">
                        <option value="">{{ __('Selecione') }}</option>
                        <?php
                        $select = "";
                        ?>
                        @foreach($opcoes_corte as $i=>$v)
                        @if($v->cod_opcoes_corte == 2)
                        <?php
                        $select = "selected";
                        ?>
                        @else
                        <?php
                        $select = "";
                        ?>
                        @endif
                        <option <?php echo $select; ?> value="{{ $v->cod_opcoes_corte }}">{{ $v->opcao_corte }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-6 imgPizza imgDireita">
                </div>
                <div class="col-md-6 imgPizza imgEsquerda">
                </div>
                <div class="col-md-12 imgOutros hide">
                </div>
            </div>
            <div class="col-md-3 hide fracao2">
                <div class="row salgados">
                    <label for="">{{ __('Sabor (2° Fração)') }}</label>
                    <br>
                    <select name="cod_pizzas_2" id="" class="form-control">
                        <option value="" json="{}">{{ __('Selecione o tamanho') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row salgados col-md-7">
                    <label for="">{{ __('Sabor 1 - Ingredientes') }}</label>
                    <br>
                    <div id="ingredientes">
                        <input type="checkbox"> {{ __('Selecione a Pizza') }}
                    </div>
                </div>
                <div class="row salgados col-md-7 hide fracao2">
                    <label for="">{{ __('Sabor 2 - Ingredientes') }}</label>
                    <br>
                    <div id="ingredientes2">
                        <input type="checkbox"> {{ __('Selecione a Pizza') }}
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-12 row">
                <div class="conjuntoQuantidade" style=""><label class="form-check-label nomeIngrediente" for="inlineCheckbox1">{{ __('Quantidade') }}</label>
                    <div class="form-check form-check-inline addIngrediente" style="margin-left: 88px;">
                        <span class="plus addQuantidade">+</span>
                        <input type="text" value="1" json='{"quantidade":1}' id="quantidadePedido" class="form-check-input input-addingredientes" />
                        <span class="minus diminuiQuantidade">-</span>
                    </div>
                </div>
                <br>
                <br>
                <button class="btn btn-success comprar col-md-2" style="width:144px;">
                    <span class="fa fa-shopping-cart"></span> {{ __('Add ao Carrinho') }}
                </button>
                <button style="margin-left:10px;width:135px;" class="btn btn-primary finalizarPedido col-md-2">
                    {{ __('Finalizar pedido!') }}
                </button>
            </div>
        </div>
        <br />
        <div class="row salgados">
            <label for="" style="cursor:pointer;" id="clickAdicionais">{{ __('Adicionais - Clique para abrir') }}</label>
            <hr />
            <div id="adicionais">

            </div>
        </div>
    </div>

</form>
<div class="adicionadoAoCarrinho" style="display:none;">
    <div>
        <span style="float:left;">{{ __('Adicionado ao carrinho') }}</span>
        <span class="fa fa-check" style=" float: right; top: 7px; position: fixed; font-size: 29px; "></span>
    </div>
</div>
@endif
<script>
    $(function() {


        let somePreloader = 0;
        let dadosBorda;
        let dadosPizzas;
        let dadosBebidas;
        let dadosAdicionais;
        let precoTotal = 0;
        let cookiePedidos;
        let dadosPedidos = '';
        let valida;
        valida = false;


        const fecharAba = $('span#fecharAba');
        const abrirRevisao = $('span#abrirRevisao');
        const pedidos = $('div#pedidos');
        const revisePedidos = $('div#revisePedidos');
        const finalizarPedido = $('button.finalizarPedido');
        const btnComprar = $('button.comprar');


        const formEscolhe = $('form#formEscolhe');
        const preload = $('div.preload');
        const imgDireita = $('div.imgDireita');
        const imgEsquerda = $('div.imgEsquerda');
        const adicionadoAoCarrinho = $('.adicionadoAoCarrinho');
        const addQuantidade = $('.addQuantidade');
        const diminuiQuantidade = $('.diminuiQuantidade');
        const quantidadePedido = $('input#quantidadePedido');
        const divAdicionais = $('div#adicionais');
        const divingredientes = $('div#ingredientes');
        const divingredientes2 = $('div#ingredientes2');
        const clickAdicionais = $('label#clickAdicionais');
        const imgPizza = $('div.imgPizza');
        const tamanhos = $('select[name="cod_tamanhos"]');
        const borda = $('select[name="cod_bordas"]');
        const corte = $('select[name="cod_pocoes_corte"]');
        const pizzas = $('select[name="cod_pizzas_1"]');
        const pizzas2 = $('select[name="cod_pizzas_2"]');
        const salgados = $('div.salgados');
        const bebidas = $('div.bebidas');
        const sobremesas = $('div.sobremesas');
        const cod_fracoes = $('select[name="cod_fracoes"]');
        const conteudo_sobremesas = $('select[name="cod_bebidas_ipi_conteudos_sobremesas"]');
        const conteudo_bebidas = $('select[name="cod_bebidas_ipi_conteudos_bebida"]');
        const imgOutros = $('div.imgOutros');
        const imgSalgado = "{{ env('IMG_SALGADO') }}";
        const imgBebidas = "{{ env('IMG_BEBIDAS') }}";
        const selectProduto = $('select[name="produto"]');


        let cookies = [];
        let dadosIngredientes;
        let dadosTamanhos;
        let dadosCorte;
        let cod_tamanhos;
        let codPizza;
        let codPizza2;
        let codPizzaria = "{{ $pedido->cod_pizzarias }}";
        let produto;


        const sumirPreLoader = function() {
            let intervaloPreload = setInterval(() => {
                if (somePreloader >= 3) {
                    preload.fadeOut();
                    formEscolhe.fadeIn();
                    clearInterval(intervaloPreload);
                }
            }, 1000);
        }

        const selecionaImagemOpcaoBebida = function() {
            let json = JSON.parse(conteudo_bebidas.find('option:selected').attr('json'));
            imgOutros.attr("style", 'background: url(' + imgBebidas + json.foto_grande + ')');
        }

        const selecionaImagemOpcaoSobremesa = function() {
            let json = JSON.parse(conteudo_sobremesas.find('option:selected').attr('json'));
            imgOutros.attr("style", 'background: url(' + imgBebidas + json.foto_grande + ')');
        }

        const selecionaImagemPizza = function() {
            let json = JSON.parse(pizzas.find('option:selected').attr('json'));
            if (cod_fracoes.val() == 2) {
                let json2 = JSON.parse(pizzas2.find('option:selected').attr('json'));
                imgDireita.attr("style", 'background: url(' + imgSalgado + json.foto_grande + ')');
                imgEsquerda.attr("style", 'background: url(' + imgSalgado + json2.foto_grande + ')');
            } else {
                imgDireita.attr("style", 'background: url(' + imgSalgado + json.foto_grande + ')');
                imgEsquerda.attr("style", 'background: url(' + imgSalgado + json.foto_grande + ')');
            }
        }

        const escondeExibeSalgado = function() {
            salgados.fadeIn();
            bebidas.fadeOut();
            sobremesas.fadeOut();
            imgOutros.attr('style', 'display:none;height:0px !important;');
            selecionaImagemPizza()
        }

        const escondeExibe = function(produto) {
            if (produto == 'salgado') {
                escondeExibeSalgado();
            }
            if (produto == 'sobremesa') {
                salgados.fadeOut();
                bebidas.fadeOut();
                sobremesas.fadeIn();
                imgOutros.attr('style', 'display:none;');
                imgDireita.attr('style', 'display:none;');
                imgEsquerda.attr('style', 'display:none;');
                selecionaImagemOpcaoSobremesa();
            }
            if (produto == 'bebida') {
                salgados.fadeOut();
                bebidas.fadeIn();
                sobremesas.fadeOut();
                imgOutros.attr('style', 'display:none;');
                imgDireita.attr('style', 'display:none;');
                imgEsquerda.attr('style', 'display:none;');
                selecionaImagemOpcaoBebida();
            }
        }

        const pegaTodasBordas = function(cod_pizzarias) {
            $.ajax({
                url: "{{ URL::to('/').'/api/'.'pegatodasbordas' }}/" + cod_pizzarias,
                dataType: "JSON",
                type: "GET",
                complete: function(r) {
                    dadosBorda = r.responseJSON;
                    somePreloader++;
                }
            });
        }
        pegaTodasBordas(codPizzaria);

        const pegaTodasPizzas = function(cod_pizzarias) {
            $.ajax({
                url: "{{ URL::to('/').'/api/'.'pegatodaspizzas' }}/" + cod_pizzarias,
                dataType: "JSON",
                type: "GET",
                complete: function(r) {
                    dadosPizzas = r.responseJSON;
                    somePreloader++;
                }
            });
        }
        pegaTodasPizzas(codPizzaria);

        const pegaTodasBebidas = function(cod_pizzarias) {
            $.ajax({
                url: "{{ URL::to('/').'/api/'.'pegatodasbebidas' }}/" + cod_pizzarias,
                dataType: "JSON",
                type: "GET",
                complete: function(r) {
                    dadosBebidas = r.responseJSON;
                    somePreloader++;
                }
            });
        }

        pegaTodasBebidas(codPizzaria);

        const filtraBorda = function(dadosBorda, cod_tamanhos) {

            //Filtra borda pelo tamanho 

            let filtroBorda = dadosBorda.filter((v, i) => {
                return v.cod_tamanhos === Number.parseInt(cod_tamanhos);
            });
            let option = "";

            //Insere dados  
            let json = {
                "cod_bordas": "0",
                "borda": "Padrão",
                "cod_ingredientes": "",
                "preco": 0.00,
                "cod_tamanhos": cod_tamanhos
            };
            option += "<option json='" + JSON.stringify(json) + "' value='0'>Padrão - {{ __('R$') }}" + "0.00</option>"
            filtroBorda.forEach((v, i) => {
                option += "<option json='" + JSON.stringify(v) + "' value='" + v.cod_bordas + "'>" + v.borda + " - {{ __('R$') }}" + v.preco + "</option>"
            });

            //Insere ou oculta bordas caso não exista
            if (option.length > 0) {
                borda.html(option);
                borda.parent().fadeIn();
            } else {
                borda.parent().fadeOut();
            }
        }


        borda.change(function(e) {
            let json = JSON.parse($('select[name="cod_bordas"] option:selected').attr('json'));
            let preco = Number.parseFloat(json.preco);
            let precoTotalAtual = Number.parseFloat($('span.valorTotal').text());
            precoTotal += (preco + precoTotalAtual);
            $('span.valorTotal').html(precoTotal.toFixed(2));
        });

        selectProduto.change(function(e) {
            e.preventDefault();
            produto = $(this).val();
            escondeExibe(produto);
        });



        const aumentaDiminuiQuantidade = function(valor) {
            $(valor).click(function() {
                let este = this;
                let valor;
                let json = JSON.parse($(este).parent().find('input').attr('json'));
                console.log(json);
                valor = Number.parseInt($(este).parent().find('input').val());
                if ($(este).attr('class').indexOf('plus') > -1) {
                    valor = valor + 1;
                }
                if ($(este).attr('class').indexOf('minus') > -1) {
                    valor = valor - 1;
                    if (valor < 0) {
                        valor = 0;
                    }
                }
                json.quantidade = valor;
                $(este).parent().find('input').val(valor).attr('json', JSON.stringify(json));
            });
        }


        //CARREGA ADICIONAIS


        const getAdicionais = function(cod_pizzarias, cod_tamanhos) {
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
                            response += "<input type='text' json='" + JSON.stringify(v) + "' preco='" + v.preco + "' nome='" + v.ingrediente + "' cod_ingredientes='" + v.cod_ingredientes + "' name='ipi_ingredientes[" + v.cod_ingredientes + "]' value='0' class='form-check-input input-addingredientes'>";
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

                    divAdicionais.hide().html(response).fadeIn();
                    mudaAdicionais();
                    aumentaDiminuiQuantidade('span.plus');
                    aumentaDiminuiQuantidade('span.minus');
                }
            });
        }


        const getIngredientes = function(cod_pizzarias, cod_tamanho, cod_pizza) {
            $.ajax({
                url: "{{ URL::to('/').'/api/'.'buscaIngredientes' }}/" + cod_pizzarias + '/' + cod_tamanho + '/' + cod_pizza,
                dataType: "JSON",
                type: "GET",
                complete: function(r) {

                    dadosIngredientes = r.responseJSON;
                    let ingredientes = '';
                    dadosIngredientes.forEach((v) => {
                        ingredientes += "<input type='checkbox' checked='checked' name='cod_ingredientes[" + v.cod_ingredientes + "]' json='" + JSON.stringify(v) + "' value='" + v.cod_ingredientes + "' />" + v.ingrediente + "<br />";
                    });
                    divingredientes.html(ingredientes);

                }
            });
        }

        const getIngredientes2 = function(cod_pizzarias, cod_tamanho, cod_pizza) {
            $.ajax({
                url: "{{ URL::to('/').'/api/'.'buscaIngredientes' }}/" + cod_pizzarias + '/' + cod_tamanho + '/' + cod_pizza,
                dataType: "JSON",
                type: "GET",
                complete: function(r) {

                    dadosIngredientes = r.responseJSON;
                    let ingredientes = '';
                    dadosIngredientes.forEach((v) => {
                        ingredientes += "<input type='checkbox' checked='checked' name='cod_ingredientes[" + v.cod_ingredientes + "]' json='" + JSON.stringify(v) + "' value='" + v.cod_ingredientes + "' />" + v.ingrediente + "<br />";
                    });
                    divingredientes2.html(ingredientes);

                }
            });
        }

        const carregaPizzasImagemIngredienteAdicionais = function(cod_pizzas) {
            codPizza = cod_pizzas;
            let json = JSON.parse($('select[name="cod_pizzas_1"] option:selected').attr('json'));
            imgOutros.addClass('hide');
            //Se for uma fração, muda as duas imagens
            if (cod_fracoes.val() == 1) {
                imgEsquerda.attr('style', "background:url(" + imgSalgado + json.foto_grande + ')');
                imgDireita.attr('style', "background:url(" + imgSalgado + json.foto_grande + ')');
            } else {
                //Se for duas frações, muda a da esquerda
                imgDireita.attr('style', "background:url(" + imgSalgado + json.foto_grande + ')');
            }

            divAdicionais.fadeOut().html('<i>Carregando..</i>').fadeIn();
            $('div#ingredientes').fadeOut().html('<i>Carregando..</i>').fadeIn();
            getIngredientes(codPizzaria, cod_tamanhos, codPizza);
            getAdicionais(codPizzaria, cod_tamanhos);
        }

        const filtraPizzasPorTamanho = function(cod_tamanhos) {

            cod_tamanhos = Number.parseInt(cod_tamanhos);

            let pizzasFiltradas = dadosPizzas.filter((v) => {
                return v.cod_tamanhos === cod_tamanhos;
            });

            let opcoesPizzas = "";
            pizzasFiltradas.forEach((v) => {
                opcoesPizzas += "<option value='" + v.cod_pizzas + "' json='" + JSON.stringify(v) + "'>" + v.pizza + "</option>";
            });

            pizzas.html(opcoesPizzas);
            opcoesPizzas += "<option value='' json='{}'>{{ __('Selecione um sabor') }}</option>";
            pizzas2.html(opcoesPizzas);

            carregaPizzasImagemIngredienteAdicionais(pizzasFiltradas[0].cod_pizzas);

        }

        const resetaDados = function() {
            tamanhos.val('');
            borda.val();
            cod_fracoes.val('');
            pizzas.val('');
            pizzas2.val('');
            quantidadePedido.val('');
            conteudo_sobremesas.val('');
            conteudo_bebidas.val('');
        }


        const mudaAdicionais = function() {
            divAdicionais.find('input[type="text"]').on('keyup', function(e) {
                let este = this;
                let json = JSON.parse($(this).attr('json'));
                json.quantidade = $(este).val();
                $(este).attr('json', JSON.stringify(json));
            });
        }


        const salvarCookies = function() {

            let ingredientesSabor1 = divingredientes.find('input[type="checkbox"]:checked');
            let ingredientesSabor2 = divingredientes2.find('input[type="checkbox"]:checked');
            let ingredientesSabor1JSON = [];
            let ingredientesSabor2JSON = [];
            let adicionaisJSON = [];

            if (ingredientesSabor1.length > 0) {
                ingredientesSabor1.each(function(i, v) {
                    ingredientesSabor1JSON.push($(v).attr('json'));
                });
            }

            if (ingredientesSabor2.length > 0) {
                ingredientesSabor2.each(function(i, v) {
                    ingredientesSabor2JSON.push($(v).attr('json'));
                });
            }

            divAdicionais.find('input[type="text"]').each(function(i, v) {
                adicionaisJSON.push($(v).attr('JSON'));
            });

            let dados = {
                "bebidas": [
                    JSON.parse(conteudo_bebidas.find('option:selected').attr('json')),
                    {
                        "quantidade": quantidadePedido.val()
                    }
                ],
                "sobremesas": [
                    JSON.parse(conteudo_sobremesas.find('option:selected').attr('json')),
                    {
                        "quantidade": quantidadePedido.val()
                    }
                ],
                "salgados": {
                    "quantidade": quantidadePedido.val(),
                    "cod_tamanhos": tamanhos.val(),
                    "bordas": borda.find('option:selected').attr('json') == undefined ? {} : JSON.parse(borda.find('option:selected').attr('json')),
                    "cod_fracoes": cod_fracoes.val(),
                    "sabores": [
                        [{
                                "dados": pizzas.find('option:selected').attr('json') == undefined ? {} : JSON.parse(pizzas.find('option:selected').attr('json'))
                            },
                            {
                                "ingredientes": ingredientesSabor1JSON
                            }
                        ],
                        [{
                                "dados": JSON.parse(pizzas2.find('option:selected').attr('json'))
                            },
                            {
                                "ingredientes": ingredientesSabor2JSON
                            }
                        ]
                    ],
                    "adicionais": adicionaisJSON
                }
            };

            cookies.push(dados);
            document.cookie = "item=" + JSON.stringify(cookies);

            resetaDados();
        }

        tamanhos.change(function(e) {
            e.preventDefault();
            cod_tamanhos = $(this).val();
            divAdicionais.fadeOut().html('').fadeIn();
            filtraPizzasPorTamanho(cod_tamanhos);
            filtraBorda(dadosBorda, cod_tamanhos);

        });

        pizzas.change(function(e) {
            e.preventDefault();
            codPizza = $(this).val();
            carregaPizzasImagemIngredienteAdicionais(codPizza);
        });

        pizzas2.change(function(e) {
            e.preventDefault();
            codPizza2 = $(this).val();
            let json = JSON.parse($('select[name="cod_pizzas_2"] option:selected').attr('json'));
            imgOutros.addClass('hide');
            imgEsquerda.attr('style', 'background:url(' + imgSalgado + json.foto_grande + ')');
            $('div#ingredientes2').fadeOut().html('<i>Carregando..</i>').fadeIn();
            getIngredientes2(codPizzaria, cod_tamanhos, codPizza2);
        });

        cod_fracoes.change(function(e) {
            e.preventDefault();
            let este = this;
            if ($(este).val() == '2') {
                $('div.fracao2').removeClass('hide');
            } else {
                //Esconde segunda fracao
                $('div.fracao2').addClass('hide');
                //Iguala imagem
                let style = imgDireita.attr('style');
                imgEsquerda.attr('style', style);
            }
        });

        conteudo_sobremesas.change(function(e) {
            e.preventDefault();
            let json = JSON.parse($('select[name="cod_bebidas_ipi_conteudos_sobremesas"] option:selected').attr('json'));
            imgPizza.fadeOut();
            imgOutros.attr('style', 'background:url(' + imgBebidas + json.foto_grande + ')');
            imgOutros.removeClass('hide').fadeIn();
        });

        conteudo_bebidas.change(function(e) {
            e.preventDefault();
            let json = JSON.parse($('select[name="cod_bebidas_ipi_conteudos_bebida"] option:selected').attr('json'));
            imgPizza.fadeOut();
            imgOutros.attr('style', 'background:url(' + imgBebidas + json.foto_grande + ')');
            imgOutros.removeClass('hide').fadeIn();
        });


        const leCookie = function() {

            cookiePedidos = document.cookie.split(";");
            cookiePedidos = cookiePedidos[0].split("item=");
            cookiePedidos = JSON.parse(cookiePedidos[1]);
            cookiePedidos = cookiePedidos[0];

            for (let i in cookiePedidos) {
                dadosPedidos += "<h5 style='text-transform: capitalize;'>" + i + "</h5>";

                if (i == 'salgados') {
                    if (cookiePedidos[i].quantidade > 0) {
                        if (Object.keys(cookiePedidos[i])[0] == 'quantidade') {
                            if (cookiePedidos[i].quantidade != undefined) {
                                dadosPedidos += "<h6>Quantidade: " + cookiePedidos[i].quantidade + "</h6>";
                            }
                        }
                        if (Object.keys(cookiePedidos[i])[3] == 'cod_fracoes') {
                            if (cookiePedidos[i].cod_fracoes != undefined) {
                                dadosPedidos += "<h6>Qntd Frações: " + cookiePedidos[i].cod_fracoes + "</h6>";
                            }
                        }
                        if (Object.keys(cookiePedidos[i])[2] == 'bordas') {
                            if (cookiePedidos[i].bordas.borda != undefined) {
                                dadosPedidos += "<h6>Bordas: " + cookiePedidos[i].bordas.borda + "</h6>";
                            }
                        }
                        if (Object.keys(cookiePedidos[i])[2] == 'sabores') {
                            if ($(cookiePedidos[i][0].sabores[0][0]).length > 0) {
                                dadosPedidos += "<h6>Bordas: " + cookiePedidos[i].bordas.borda + "</h6>";
                            }
                        }
                    }
                } else {
                    if (cookiePedidos[i][1].quantidade > 0) {
                        dadosPedidos += "<h6>Quantidade: " + cookiePedidos[i][1].quantidade + "</h6>";
                        dadosPedidos += "<h6> - " + cookiePedidos[i][0].bebida + " " + cookiePedidos[i][0].conteudo + " - {{ __('R$') }}" + cookiePedidos[i][0].preco + "</h6>";
                    }
                }
                pedidos.html(dadosPedidos);
                dadosPedidos = '';
            }
        }

        const clicarComprar = function() {
            $(btnComprar).click(function(e) {
                e.preventDefault();
                if (validacaoCarrinho()) {
                    $(this).attr('disabled', 'disabled');
                    salvarCookies();
                    $(this).removeAttr('disabled');
                    adicionadoAoCarrinho.fadeIn(300).delay(2300).fadeOut(200);
                }
            });
        }

        const validacaoCarrinho = function() {

            let possuiItens = (Number.parseInt($(quantidadePedido).val()) > 0);

            if (selectProduto.val() == 'salgado') {
                if (tamanhos.val() != "" && borda.val() != "" && pizzas.val() != "" && possuiItens) {
                    valida = true;
                }
            } else if (selectProduto.val() == 'sobremesa' && possuiItens) {
                if (conteudo_sobremesas.val() != "") {
                    valida = true;
                }
            } else if (selectProduto.val() == 'bebida' && possuiItens) {
                if (conteudo_bebidas.val() != "") {
                    valida = true;
                }
            }

            if (valida == false) {
                $('div.alert.alert-danger').text("{{ __('Você precisa selecionar algum item') }}").fadeIn(300);
                $([document.documentElement, document.body]).animate({
                    scrollTop: $('#alerta-danger').offset().top
                }, 330);
            } else {
                $('div.alert.alert-danger').text("{{ __('Você precisa selecionar algum item') }}").fadeOut(100);
            }
            return valida;
        }

        finalizarPedido.click(function(e) {
            e.preventDefault();
            let este = this;
            leCookie();
            revisePedidos.modal('show');
        });

        const fechaAbreRevisao = function(e) {
            leCookie();
        }

        fecharAba.click(fechaAbreRevisao);
        abrirRevisao.click(fechaAbreRevisao);


        clicarComprar();
        escondeExibeSalgado();
        aumentaDiminuiQuantidade('.addQuantidade');
        aumentaDiminuiQuantidade('.diminuiQuantidade');
        sumirPreLoader();

    });
</script>