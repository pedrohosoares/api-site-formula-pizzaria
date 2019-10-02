@if($pedido->origem_pedido == 'IFOOD')
<br />
<h1>{{ __('Descrição do Pedido') }}</h1>
<table class="table table-responsive">
    <thead>
        <tr>
            <th>{{ __('Item') }}</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $pedidoJSON = str_replace("\n",'',$pedido->pedido_ifood_json);
        $pedidoJSON = json_decode($pedidoJSON,true);
        ?>
        @foreach($pedidoJSON['order']['items'] as $itens)
        <tr>
            <td colspan="2">{{ __('Qntd:') }} {{ $itens['quantity'] }} - {{ $itens['name'] }} - {{ $itens['addition'] }}</td>
        </tr>
        @if(!empty($itens['subItems']) and isset($itens['subItems']))
        @foreach($itens['subItems'] as $subitems)
        <tr>
            <td style="padding-left:30px;">
                {{ __('Qntd: ') }}
                {{ $subitems['quantity'] }} -
                {{ $subitems['name'] }} -
                {{ $subitems['addition'] }}
            </td>
        </tr>
        @endforeach
        @endif
        @endforeach
    </tbody>
</table>
@endif