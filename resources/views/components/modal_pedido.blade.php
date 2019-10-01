<style>
    input[type='radio'] {
        width: 23px;
        height: 23px;
        display: block;
        float: left;
        margin-right: 10px;
        margin-top: 1px;
    }

    .modalFazerPedido {
        z-index: 99999;
    }
</style>
<div class="modal modalFazerPedido" tabindex="-1" role="dialog">
    <div class="modal-dialog modalFazerPedido" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row" style="margin-left:5px">
                    <h2 class="modal-title pull-left" id="tituloPedido">{{ __('Pizza A Moda') }}</h2>
                    <button style="margin-right: 10px;" type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row" style="margin-left:5px" id="ingredientePedido">
                    <p id="ingrediente"></p>
                </div>
            </div>
            <div class="modal-body" style=" overflow-y: scroll; max-height: 275px;">
                <form>
                    @include('modal.tamanhos')
                    <hr />
                    @include('modal.bordas')
                    <hr />
                    @include('modal.adicionais')
                    <hr />
                    @include('modal.observacao')
                </form>
            </div>
            <div class="modal-footer">
                <button style="margin-right:10px;" type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">{{ __('Finalizar Pedido') }}{{ __(' R$') }}
                    <span id="valorTotal">0.00</span>
                </button>
                <div class="conjuntoQuantidade" style="float: right;width: 114px;">
                    <div class="form-check form-check-inline addIngrediente">
                        <span class="plus qntdPedidoPlus">+</span>
                        <input type="text" name="quantidade" value="0" class="form-check-input input-addingredientes">
                        <span class="minus qntdPedidoMinus" style="margin-left: 5px;">-</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>