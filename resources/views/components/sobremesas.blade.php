<div class="columns-4">
    <ul class="products">
        @foreach($sobremesas as $sobremesa)
        <li class="product" style="height: 592px;">
            <div class="product-outer">
                <div class="product-inner">
                    <div class="product-image-wrapper">
                        <a href="#" class="woocommerce-LoopProduct-link">
                            <img src="{{ env('IMG_BEBIDAS').$sobremesa[0]->foto_grande }}" class="img-responsive" alt="">
                        </a>
                    </div>
                    <div class="product-content-wrapper">
                        <a href="#" class="woocommerce-LoopProduct-link">
                            <h3>{{ __($sobremesa[0]->bebida) }}</h3>
                            <div class="yith_wapo_groups_container">
                                <div class="ywapo_group_container ywapo_group_container_radio form-row form-row-wide " data-requested="1" data-type="radio" data-id="1" data-condition="">
                                    <h3>
                                        <span>{{ __('Tamanhos') }}</span>
                                    </h3>
                                    @foreach($sobremesa as $tamanho)
                                        <div class="ywapo_input_container ywapo_input_container_radio">
                                            <span class="ywapo_label_tag_position_after">
                                                <span class="ywapo_option_label ywapo_label_position_after">{{ __($tamanho->conteudo) }}</span>
                                            </span>
                                            <span class="ywapo_label_price">
                                                <span class="woocommerce-Price-amount amount">
                                                    <span class="woocommerce-Price-currencySymbol">{{ __('R$') }}</span>{{ number_format($tamanho->preco,2) }}</span>
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                        <div class="hover-area">
                            <a rel="nofollow" href="single-product-v1.html" data-quantity="1" data-product_id="51" data-product_sku="" class="button product_type_simple add_to_cart_button ajax_add_to_cart">
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