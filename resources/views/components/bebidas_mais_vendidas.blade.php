@if(!empty($bebidasMaisPedidas))
<div class="section-products">
    <h2 class="section-title" style="padding-top: 58px;">{{ __('Bebidas Mais Pedidas') }}</h2>
    <div class="columns-4">
        <ul class="products">
            @foreach($bebidasMaisPedidas as $bebida)
            <li class="product" style="height: 365px;">
                <div class="product-outer">
                    <div class="product-inner">
                        <div class="product-image-wrapper">
                            <a href="#"  class="fazer-pedido" onclick = "poeDadosJanelaModal(this)">
                                <img src="{{ env('IMG_BEBIDAS').$bebida[0]->foto_grande }}" class="img-responsive" alt="">
                            </a>
                        </div>
                        <div class="product-content-wrapper">
                            <a href="#" class="fazer-pedido" onclick = "poeDadosJanelaModal(this)">
                                <h3>{{ __($bebida[0]->bebida) }}</h3>
                                <div class="yith_wapo_groups_container">
                                    <div class="ywapo_group_container ywapo_group_container_radio form-row form-row-wide " data-requested="1" data-type="radio" data-id="1" data-condition="">
                                        <h3>
                                            <span>{{ __('Tamanhos') }}</span>
                                        </h3>
                                        @foreach($bebida as $tamanho)
                                        @if($tamanho->situacao == 'ATIVO')
                                        <div class="ywapo_input_container ywapo_input_container_radio">
                                            <span class="ywapo_label_tag_position_after">
                                                <span class="ywapo_option_label ywapo_label_position_after">{{ __($tamanho->conteudo) }}</span>
                                            </span>
                                            <span class="ywapo_label_price">
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">{{ __('R$') }}</span>{{ number_format($tamanho->preco,2) }}</span>
                                            </span>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                            <div class="hover-area">
                                <a rel="nofollow" href="#"  class="button fazer-pedido" onclick = "poeDadosJanelaModal(this)">
                                    {{ __('Add ao carrinho') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endif