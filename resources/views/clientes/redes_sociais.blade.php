<div class="row">
    <?php
    $dados = false;
    ?>
    @foreach($redes_sociais as $rede)
        <?php
        $dados = true;
        ?>
    @endforeach
    @if($dados)
    @foreach($redes_sociais as $rede)
    <div class="col-md-4">
        <label for="inputEmail3" class="col-sm-12 control-label">{{ ucfirst($rede->nome_site) }}</label>
        <div class="col-sm-10">
            <input type="text" name="ipi_clientes_redes_sociais[{{ $rede->nome_site }}][url_cliente_site]" value="{{ $rede->url_cliente_site }}" class="form-control" placeholder="{{ __('Informe o link') }}" />
            <input type="hidden" name="ipi_clientes_redes_sociais[{{ $rede->nome_site }}][nome_site]" value="{{ $rede->nome_site }}" class="form-control" />
            <input type="hidden" name="ipi_clientes_redes_sociais[{{ $rede->nome_site }}][cod_clientes_redes_sociais]" value="{{ $rede->cod_clientes_redes_sociais }}" class="form-control" />
        </div>
    </div>
    @endforeach
    @else
    <div class="col-md-4">
        <label for="inputEmail3" class="col-sm-12 control-label">{{ __('Facebook') }}</label>
        <div class="col-sm-10">
            <input type="text" name="ipi_clientes_redes_sociais[facebook][url_cliente_site]" value="" class="form-control" placeholder="{{ __('Informe o link') }}" />
            <input type="hidden" name="ipi_clientes_redes_sociais[facebook][nome_site]" value="facebook" class="form-control" />
            <input type="hidden" name="ipi_clientes_redes_sociais[facebook][cod_clientes_redes_sociais]" value="" class="form-control" />
        </div>
    </div>
    <div class="col-md-4">
        <label for="inputEmail3" class="col-sm-12 control-label">{{ __('Instagram') }}</label>
        <div class="col-sm-10">
            <input type="text" name="ipi_clientes_redes_sociais[instagram][url_cliente_site]" value="" class="form-control" placeholder="{{ __('Informe o link') }}">
            <input type="hidden" name="ipi_clientes_redes_sociais[instagram][nome_site]" value="instagram" class="form-control" />
            <input type="hidden" name="ipi_clientes_redes_sociais[instagram][cod_clientes_redes_sociais]" value="" class="form-control" />
        </div>
    </div>
    <div class="col-md-4">
        <label for="inputEmail3" class="col-sm-12 control-label">{{ __('WhatsApp') }}</label>
        <div class="col-sm-10">
            <input type="text" name="ipi_clientes_redes_sociais[whatsapp][url_cliente_site]" value="" class="form-control" placeholder="{{ __('Informe o número') }}" />
            <input type="hidden" name="ipi_clientes_redes_sociais[whatsapp][nome_site]" value="whatsapp" class="form-control" />
            <input type="hidden" name="ipi_clientes_redes_sociais[whatsapp][cod_clientes_redes_sociais]" value="" class="form-control" />
        </div>
    </div>
    @endif
</div>
<br />