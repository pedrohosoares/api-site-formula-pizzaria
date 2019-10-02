@if($pedido->origem_pedido != 'IFOOD')
<br />
<h1>{{ __('Descrição do Pedido') }}</h1>
<table class="table table-responsive">
    <thead>
        <tr>
            <th>{{ __('Item') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pedidos_sistema->ipi_pedidos_pizzas as $pizzas)
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
        @foreach($pedidos_sistema->ipi_pedidos_bebidas as $bebidas)
            <tr>
                <td>
                    {{ __('Quantidade: ') }} {{ $bebidas->quantidade }} - {{ $bebidas->ipi_bebidas_ipi_conteudo->ipi_bebida->bebida }} 
                    {{ $bebidas->ipi_bebidas_ipi_conteudo->ipi_conteudo->conteudo }}
                </td>
            </tr>    
        @endforeach
    </tbody>
</table>
@endif