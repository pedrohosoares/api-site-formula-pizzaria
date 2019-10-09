<style>
    .revisarPedido {
        right: 0;
        box-shadow: #666 0px 0px 10px;
        width: 225px;
        height: 100%;
        position: fixed;
        z-index: 999999;
        top: 0;
        background: #FFF;
        padding: 15px;
    }

    #idFechar {
        float: right;
        cursor: pointer;
    }
</style>
<div class="revisarPedido" style="display:none;">
    <h3>{{ __('Revisão') }} <span class="fa fa-close pull-right" id="fecharAba"></span></h3>
    <hr />
</div>
<script>
    $(function() {

        const revisarPedido = $('div.revisarPedido');
        const fecharAba = $('span#fecharAba');
        const abrirRevisao = $('span#abrirRevisao');

        let cookiePedidos;

        const leCookie = function() {
            cookiePedidos = document.cookie.split(";");
            cookiePedidos = cookiePedidos[0].split("item=");
            cookiePedidos = JSON.parse(cookiePedidos[1]);
            cookiePedidos.forEach(function(pedido,indice){
                for(let item in pedido){
                    console.log(pedido[item]);
                }
            });
            
        }

        const fechaAbreRevisao = function(e) {
            revisarPedido.animate({
                width: 'toggle'
            }, 350);
            leCookie();
        }
        fecharAba.click(fechaAbreRevisao);
        abrirRevisao.click(fechaAbreRevisao);
    });
</script>