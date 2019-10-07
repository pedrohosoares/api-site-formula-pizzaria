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

    .imgEsquerda{
        background-position-x: 100% !important;
        background-position-y: 0% !important;
    }

</style>

<div class="preload">
    <img src="<?php echo asset('img'); ?>/preloader-3.gif" style="text-align: center;margin: auto;width:140px;">
    <p style="text-align:center;color: #000;font-weight: 600;">Carregando..</p>
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
                        <option value="">{{ __('Selecione') }}</option>
                        @foreach($tamanhos as $i=>$v)
                        <option value="{{ $v->cod_tamanhos }}">{{ $v->tamanho }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row bebidas">
                    <label for="">{{ __('Bebidas') }}</label>
                    <br>
                    <select name="cod_bebidas_ipi_conteudos" id="" class="form-control">
                        <option value="">{{ __('Selecione') }}</option>
                        @foreach($tamanhos as $i=>$v)
                        <option value="{{ $v->cod_bebidas_ipi_conteudos }}">{{ $v->bebida }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row" style="display:none;">
                    <label for="">{{ __('Tipo de massa') }}</label>
                    <br>
                    <select name="cod_tipo_massas" id="" class="form-control">
                        <option value="">{{ __('Selecione') }}</option>
                        @foreach($tipo_massa as $i=>$v)
                        <option value="{{ $v->cod_tipo_massa }}">{{ $v->tipo_massa }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row salgados">
                    <label for="">Borda</label>
                    <br>
                    <select name="cod_bordas" id="" class="form-control">
                        <option value="0">{{ __('Normal') }}</option>
                        @foreach($borda as $i=>$v)
                        <option value="{{ $v->cod_bordas }}">{{ $v->borda }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row salgados">
                    <label for="">Sabor</label>
                    <br>
                    <select name="cod_pizzas" id="" class="form-control">
                        <option value="">{{ __('Selecione o tamanho') }}</option>
                    </select>
                </div>
                <div class="row salgados">
                    <label for="">{{ __('Meio a Meio?') }}</label>
                    <br>
                    <select name="cod_fracoes" id="" class="form-control">
                        <option value="2">{{ __('Não') }}</option>
                        <option value="1">{{ __('Sim') }}</option>
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
            </div>
            <div class="col-md-3">
                <div class="row salgados">
                    <label for="">Ingredientes</label>
                    <br>
                    <div id="ingredientes">
                        <input type="checkbox"> {{ __('Selecione a Pizza') }}
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="row salgados">
            <label for="">{{ __('Adicionais') }}</label>
            <br>
            <div id="adicionais">

            </div>
        </div>
        <br />
        <div class="row">
            <h2>{{ __('Valor total: ') }} {{ __('R$') }}<span class="valorTotal">0,00</span></h2>
        </div>
    </div>

</form>
@endif
<script>
    $(function() {

        let formEscolhe = $('form#formEscolhe');
        let preload = $('div.preload');
        let somePreloader = 0;
        let dadosBorda;
        let dadosPizzas;
        let dadosBebidas;
        let dadosAdicionais;
        let imgDireita = $('div.imgDireita');
        let imgEsquerda = $('div.imgEsquerda');

        const divAdicionais = $('div#adicionais');
        const divingredientes = $('div#ingredientes');

        let dadosIngredientes;
        let dadosTamanhos;
        let dadosCorte;
        let cod_tamanhos;
        let codPizza;
        let codPizzaria = "{{ $pedido->cod_pizzarias }}";
        let produto;
        let tamanhos = $('select[name="cod_tamanhos"]');
        let borda = $('select[name="cod_bordas"]');
        let corte = $('select[name="cod_pocoes_corte"]');
        let pizzas = $('select[name="cod_pizzas"]');


        const sumirPreLoader = function() {
            let intervaloPreload = setInterval(() => {
                if (somePreloader >= 3) {
                    preload.fadeOut();
                    formEscolhe.fadeIn();
                    clearInterval(intervaloPreload);
                }
            }, 1000);
        }


        const escondeExibe = function(produto) {

            if (produto == 'salgado') {
                $('div.salgados').fadeIn();
                $('div.bebidas').fadeOut();
            }
            if (produto == 'sobremesa') {
                $('div.salgados').fadeOut();
                $('div.bebidas').fadeOut();
            }
            if (produto == 'bebida') {
                $('div.salgados').fadeOut();
                $('div.bebidas').fadeIn();
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
                $('select[name="cod_bordas"]').html(option);
                $('select[name="cod_bordas"]').parent().fadeIn();
            } else {
                $('select[name="cod_bordas"]').parent().fadeOut();
            }
        }

        $('select[name="produto"]').change(function(e) {
            e.preventDefault();
            produto = $(this).val();
            escondeExibe(produto);
        });

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

        const filtraIngredientesAdicionais = function(cod_pizza) {
            console.log(dadosIngredientes);
        }

        const filtraPizzasPorTamanho = function(cod_tamanhos) {
            
            cod_tamanhos = Number.parseInt(cod_tamanhos);
            
            let pizzasFiltradas = dadosPizzas.filter((v) => {
                return v.cod_tamanhos === cod_tamanhos;
            });
            
            let opcoesPizzas = '';
            pizzasFiltradas.forEach((v) => {
                opcoesPizzas += "<option value='" + v.cod_pizzas + "' json='" + JSON.stringify(v) + "'>" + v.pizza + "</option>";
            });

            $('select[name="cod_pizzas"]').html(opcoesPizzas);
            filtraIngredientesAdicionais(pizzasFiltradas[0].cod_pizzas);
        }

        $('select[name="cod_tamanhos"]').change(function(e) {
            e.preventDefault();
            cod_tamanhos = $(this).val();
            filtraPizzasPorTamanho(cod_tamanhos);
            filtraBorda(dadosBorda, cod_tamanhos);
            
        });

        $('select[name="cod_pizzas"]').change(function(e) {
            e.preventDefault();
            codPizza = $(this).val();
            let json = JSON.parse($('select[name="cod_pizzas"] option:selected').attr('json'));
            console.log(json);
            imgDireita.attr('style','background:url({{ env('IMG_SALGADO') }}'+json.foto_grande+')');
            imgEsquerda.attr('style','background:url({{ env('IMG_SALGADO') }}'+json.foto_grande+')');
            getIngredientes(codPizzaria, cod_tamanhos, codPizza);
        })


        sumirPreLoader();

    });
</script>