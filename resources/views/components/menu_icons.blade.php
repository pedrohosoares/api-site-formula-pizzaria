@if(!empty($loja) and isset($loja))
<div class="pizzaro-secondary-navigation" id="iconesItens">
    <nav class="secondary-navigation" aria-label="Secondary Navigation" style="/* border-bottom: 4px dotted; */">
        <ul class="menu iconesMenu">
            <li class="menu-item ">
                <a href="{{ URL::to('/').'/lojas/'.$storeState.'/'.$storeName.'/mais-pedidas' }}">
                    <i class="po po-pizza"></i>{{ __('Mais Pedidas') }}
                </a>
            </li>
            <li class="menu-item ">
                <a href="{{ URL::to('/').'/lojas/'.$storeState.'/'.$storeName.'/pizzas' }}">
                    <i class="po po-pizza"></i>{{ __('Pizza') }}
                </a>
            </li>
            <li class="menu-item ">
                <a href="{{ URL::to('/').'/lojas/'.$storeState.'/'.$storeName.'/sanduiches' }}">
                    <i class="po po-burger"></i>{{ __('Sanduíches') }}
                </a>
            </li>
            <li class="menu-item ">
                <a href="{{ URL::to('/').'/lojas/'.$storeState.'/'.$storeName.'/calzone' }}">
                    <i class="po po-burger"></i>{{ __('Calzones') }}
                </a>
            </li>
            <li class="menu-item ">
                <a href="{{ URL::to('/').'/lojas/'.$storeState.'/'.$storeName.'/bebidas' }}">
                    <i class="po po-drinks"></i>{{ __('Bebidas') }}
                </a>
            </li>
            <li class="menu-item ">
                <a href="{{ URL::to('/').'/lojas/'.$storeState.'/'.$storeName.'/combos' }}">
                    <i class="po po-wraps"></i>{{ __('Combos') }}
                </a>
            </li>
            <li class="menu-item ">
                <a href="{{ URL::to('/').'/lojas/'.$storeState.'/'.$storeName.'/sobremesas' }}">
                    <i class="po po-fries"></i>{{ __('Sobremesas') }}
                </a>
            </li>
            <li class="menu-item">
                <form id="buscar">
                    <input type="text" placeholder="{{ __('O que você quer comer?') }}" class="form-control" style="width: 200px;float: left;">
                    <i class="po po-search" style=" float: right; margin-top: 7px; margin-left: 10px; cursor: pointer; "></i>
                </form>
            </li>
        </ul>
    </nav>
</div>
@endif