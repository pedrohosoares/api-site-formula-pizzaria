@if($pedido->origem_pedido == 'IFOOD')

@else
<form>
    @foreach($pedido->ipi_pedidos_pizzas as $pizzas)
    <div class="row" id="tamanho">
        <div class="col-md-6">
            <label for="">
                {{ __('Tamanho: ') }}
            </label>
            <br />
            <select name="ipi_pedidos_pizzas[cod_tamanhos]" id="cod_tamanhos" class="form-control">
                <option value="{{ $pizzas->ipi_tamanho->cod_tamanhos }}">{{ $pizzas->ipi_tamanho->tamanho }}</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="">
                {{ __('Número de Frações: ') }}
            </label>
            <br />
            <input type="number" name="quant_fracao" min="1" value="{{ $pizzas->quant_fracao }}" max="2" class="form-control" />
        </div>
    </div>
    <br />
    <div class="row" id="tamanho">
        @foreach($pizzas->ipi_pedidos_fracos as $fracoes)
        <div class="col-md-6">
            <label for="">
                {{ __('Tipo: ') }}
            </label>
            <br />
            <select name="ipi_pedidos_fracos[cod_tamanhos]" id="cod_tamanhos" class="form-control">
                <option value="{{ $pizzas->ipi_tamanho->cod_tamanhos }}">{{ $pizzas->ipi_tamanho->tamanho }}</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="">
                {{ __('Número de Frações: ') }}
            </label>
            <br />
            <input type="number" name="quant_fracao" min="1" value="{{ $pizzas->quant_fracao }}" max="2" class="form-control" />
        </div>
        @endforeach
    </div>

    <tr>
        <td> {{ __('Tamanho: ') }} {{ $pizzas->ipi_tamanho->tamanho }} | {{ __('Quantidade de Sabores: ').$pizzas->quant_fracao }} </td>
    </tr>
    @foreach($pizzas->ipi_pedidos_fracos as $fracoes)
    <tr>
        <td style="padding-left:30px;">
            {{ $fracoes->ipi_pizza->pizza }} - {{ $fracoes->ipi_pizza->tipo }}
        </td>
    </tr>
    @endforeach
    @endforeach
    @foreach($pedido->ipi_pedidos_bebidas as $bebidas)
    <tr>
        <td>
            {{ __('Quantidade: ') }} {{ $bebidas->quantidade }} - {{ $bebidas->ipi_bebidas_ipi_conteudo->ipi_bebida->bebida }}
            {{ $bebidas->ipi_bebidas_ipi_conteudo->ipi_conteudo->conteudo }}
        </td>
    </tr>
    @endforeach
</form>
@endif