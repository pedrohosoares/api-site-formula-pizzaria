@if(isset($loja) and !empty($loja))
<div class="site-address">
    <ul class="address">
        <li>{{ $loja->nome }} - {{ __('Rua: ').$loja->endereco }} - {{ $loja->numero }} - {{ $loja->cidade }}/{{ $loja->estado }} </li>
        <li>{{ __('Cep: ').$loja->cep }}</li>
    </ul>
</div>
@endif