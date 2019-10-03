@if(!empty($enquete->ipi_enquete_perguntas))
<h2>{{ __('Diga sua opinião sobre nossos serviços e seja premiado.') }}</h2>
<hr />
@foreach($enquete->ipi_enquete_perguntas as $p)
<div class="panel panel-red">
    <div class="panel-heading">{{ __($p->pergunta) }}</div>
    <div class="panel-body" aberto="nao" style="display:none;cursor:pointer;">
        @foreach($p->ipi_enquete_respostas as $enquete)
        <div class="input-group">
            <input type="radio" name="cod_enquete_respostas[{{ $p->cod_enquete_perguntas }}]" value="{{ $enquete->cod_enquete_respostas }}" /> {{ ucfirst($enquete->resposta) }}
        </div>
        @if($enquete->justifica)
        <textarea placeholder="{{ __("Escreva um comentário ou observação sober o seu pedido") }}" name="{{ $p->cod_enquete_perguntas }}" class="form-control resposta"></textarea>
        @endif
        @endforeach
    </div>
</div>
@endforeach
<button class="btn btn-lg btn-success" id="responder">{{ __('Responder') }}</button>
@endif
<script>
    $(function() {

        let valoresFormulario = [];

        const pegaResposta = function() {
            $('div.panel-body').each(function(i, v) {
                let este = $(this).find('textarea');
                let name = $(este).attr('name');
                let valor = $(este).val();
                let radio = $(este).parent().find('input[type="radio"]:checked').val();
                valoresFormulario.push({
                    "campo": {
                        "cod_enquete_perguntas": name,
                        "justificativa": valor,
                        "cod_enquete_respostas": radio
                    }
                });
            });
        }

        $('button#responder').click(function() {
            pegaResposta();
            let este = this;
            $(este).attr('disabled', 'disabled');
            $(este).text('Salvando..');
            $.ajax({
                url: "{{ route('ajaxPesquisaPedido') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    cod_pedidos: "{{ $cod_pedido }}",
                    valoresFormulario
                },
                complete: function(r) {
                    $(este).removeAttr('disabled');
                    $(este).text('Cadastrado com sucesso!').delay(2000).text('Responder');
                }
            });
        });
    });
    
    $(function() {
        $('.panel-heading').click(function() {
            let aba = $(this).parent().find(".panel-body");
            if ($(aba).attr('aberto') == 'nao') {
                $(aba).fadeIn(300);
                $(aba).attr('aberto', 'sim');
            } else {
                $(aba).fadeOut(100);
                $(aba).attr('aberto', 'nao');
            }
        });
    });
</script>