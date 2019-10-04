@if($pedido->origem_pedido == 'IFOOD')

@else

<form action="" method="">
    <div class="col-md-12">
        <div class="col-md-3">
            <div class="row">
                <label for="">Produto</label>
                <br>
                <select name="" id="" class="form-control">
                    <option value="">Pizza</option>
                    <option value="">Calzone</option>
                    <option value="">Fórmula Lanche</option>
                    <option value="">Bebida</option>
                    <option value="">Sobremesa</option>
                </select>
            </div>
            <div class="row">
                <label for="">Tamanho</label>
                <br>
                <select name="" id="" class="form-control">
                    <option value="">35 cm</option>
                </select>
            </div>
            <div class="row">
                <label for="">Borda</label>
                <br>
                <select name="" id="" class="form-control">
                    <option value="">Catupiry</option>
                </select>
            </div>
            <div class="row">
                <label for="">Sabor</label>
                <br>
                <select name="" id="" class="form-control">
                    <option value="">A moda</option>
                </select>
            </div>
            <div class="row">
                <label for="">Meio a meio?</label>
                <br>
                <select name="" id="" class="form-control">
                    <option value="">Sim</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-6" style="display: block;background: #000;height: 300px;background: -8% 58% url(http://sistema.formulapizzaria.com.br/formula/production/current/site/upload/pizzas/5_pizza_g.jpg);border-right: 5px solid #FFF;">

            </div>
            <div class="col-md-6" style="display: block;background: #000;height: 300px;background: 100% 58% url(http://sistema.formulapizzaria.com.br/formula/production/current/site/upload/pizzas/5_pizza_g.jpg);">

            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <label for="">Ingredientes</label>
                <br>
                <div>
                    <input type="checkbox"> Mussarela
                    <br />
                    <input type="checkbox"> Tomate
                    <br />
                    <input type="checkbox"> Presunto
                    <br />
                    <input type="checkbox"> Oregano
                </div>
            </div>
            <div class="row">
                <label for="">Adicionais</label>
                <br>
                <div>
                    <input type="checkbox"> Peperroni
                    <br />
                    <input type="checkbox"> Salaminho
                </div>
            </div>
        </div>
    </div>

</form>
@endif