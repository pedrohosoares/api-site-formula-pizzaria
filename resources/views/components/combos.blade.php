<div class="owl-carousel owl-theme" style="padding-left: 86px; padding-right: 79px; ">
    @foreach($combos as $combo)
    <div style=" border: 1px solid #ccc; border-radius: 12px; margin: 10px; ">
        <a href="{{ route('combos').'/'.Str::slug($combo->nome_combo) }}" rel="{{ $combo->nome_combo }} - {{ $combo->descricao_combo }}">
            <img src="{{ env('COMBO_IMG').'1_combo_p.png' }}" alt="{{ $combo->nome_combo }} - {{ $combo->descricao_combo }}" />
            <h2 class="text-center" style="font-size:20px;color:#C00A27;">{{ $combo->nome_combo }}</h2>
        </a>
    </div>
    @endforeach
    <div style=" border: 1px solid #ccc; border-radius: 12px; margin: 10px; ">
        <a href="" rel="">
            <img src="https://acconstorage.blob.core.windows.net/acconpictures/15646056504555553664649235772-1080p.jpg" alt="" />
        </a>
    </div>
    <div style=" border: 1px solid #ccc; border-radius: 12px; margin: 10px; ">
        <a href="" rel="">
            <img src="https://acconstorage.blob.core.windows.net/acconpictures/15651211424929539796054857055-1080p.jpg" alt="" />
        </a>
    </div>
    <div style=" border: 1px solid #ccc; border-radius: 12px; margin: 10px; ">
        <a href="" rel="">
            <img src="https://acconstorage.blob.core.windows.net/acconpictures/15646054715067314308291534108-1080p.jpg" alt="" />
        </a>
    </div>
</div>