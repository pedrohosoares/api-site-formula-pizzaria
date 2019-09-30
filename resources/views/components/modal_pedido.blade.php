<style>
    input[type='radio'] {
        width: 23px;
        height: 23px;
        display: block;
        float: left;
        margin-right: 10px;
        margin-top: 1px;
    }
</style>
<div class="modal modalFazerPedido" tabindex="-1" role="dialog">
    <div class="modal-dialog modalFazerPedido" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row" style="margin-left:5px">
                    <h2 class="modal-title pull-left">{{ __('Pizza A Moda') }}</h2>
                    <button style="margin-right: 10px;" type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row" style="margin-left:5px">
                    <p>{{ __('Mussarela, presunto, azeitona preta, oregano, molho de tomate e cebola.') }}</p>
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
                <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">{{ __('Finalizar Pedido') }}{{ __(' R$') }}
                    <span>0.00</span>
                </button>
                <div class="input-group" style="float: right;margin-left: 20px;">
                    <span style="float: left;margin-right: 10px;font-size:20px;margin-top: 7px;">{{ __('Qntd: ') }} </span>
                    <i style="float: left;margin-right:10px; font-size: 37px; cursor: pointer; " class="glyphicon glyphicon-minus"></i>
                    <input type="text" class="form-control" value="1" style="text-align:center;width: 63px;margin-right:10px;height: 48px;font-size: 29px;padding-right: 2px;padding-left: 2px;">
                    <i class="glyphicon glyphicon-plus" style=" font-size: 37px; cursor: pointer; "></i>
                </div>
            </div>
        </div>
    </div>
</div>