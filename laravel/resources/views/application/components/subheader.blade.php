<div class="full">
    <div class="center">
        <div class="options">
            @if(request()->routeIs('metas*'))
                <a href="{{route('metas-saida')}}">
                    <div @if(request()->routeIs('metas-saida')) class="button red_line active" @else class="button red_line" @endif>
                        Saída
                    </div>
                </a>
            
                <a href="{{route('metas-entrada')}}">
                    <div @if(request()->routeIs('metas-entrada')) class="button active" @else class="button" @endif>
                        Entrada
                    </div>
                </a>
            @endif

            {{-- CRIAR OS LINKS DO LEDGER AQUI --}}
            @if(request()->routeIs('ledger.*'))
            @endif
        </div>
    </div>
</div>