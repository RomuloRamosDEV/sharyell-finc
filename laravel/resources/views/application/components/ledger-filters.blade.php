<div class="filters_reg">
    <div class="centre">
        @if(request()->routeIs('registros-saida') or request()->routeIs('registros-pesquisa-saida'))
            <form action="{{route('registros-pesquisa-saida')}}" method="POST">
                @csrf
                <input type="date" class="date_input" name='start_date' style="height: 45px" required value="{{$start_date}}">
                <input type="date" class="date_input" name='end_date' style="height: 45px" required value="{{$end_date}}">

                <select name="category" class="input_text" style="height: 45px">
                    <option value="" selected disabled>Selecionar Categoria</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->titulo }}</option>
                    @endforeach
                </select>

                <select name="type" class="input_text input_limiter" style="height: 45px;">
                    <option value="" selected disabled>Selecionar Tipo</option>
                    <option value="livre">Gasto Livre</option>
                    <option value="fixo">Gasto Fixo</option>
                </select>

                <button type="submit" class="btn_search">
                    <img src="{{asset('img/layout/search-circle.svg')}}"  alt="lupa">
                </button>

                <a href="{{route('registros-saida')}}">
                    <div class="btn_clean" alt="limpar filtro">
                        <img src="{{asset('img/layout/close.svg')}}" alt="">
                    </div>
                </a>
            </form>
        @endif
    </div>
</div>