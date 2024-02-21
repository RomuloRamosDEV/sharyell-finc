@extends('layouts.app')

@include('layouts.flash')

@section('content')

<main class="previsoes_edit">
    <a href="{{route('previsoes-index')}}" class="a_back">
        <div class="btn_back">voltar</div>
    </a>
    
    <div class="mob_centre">
        <form action="{{route('previsoes-update', $previsao->id)}}" method="POST">
            @csrf
            @method('PATCH')

            <div class="line">
                <label for="category_id">Categoria</label>
                
                <select class="select_default" id="category_id" name="category_id" required>
                    <option value="" selected disabled>Categoria</option>
                    @foreach ($categories as $cat)    
                    <option value="{{$cat->id}}" @if($cat->id == $previsao->category_id) selected @endif>{{$cat->titulo}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="line">
                <label for="">Valor da Previsão</label>
                
                <div class="number_live">
                    <input class="input_number" type="text" placeholder="R$" name="top_value" 
                    data-prefix="R$ " data-thousands="." data-decimal="," required value="{{$previsao->top_value}}">
                </div>
            </div>

            <input type="submit" class="btn_update" value="Alterar">
        </form>
    </div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script 
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" 
    integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" 
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>

<script>
    $(document).ready(function(){
        $('.input_number').mask('000.000.000.000.000,00', {reverse: true});
    });
</script>

@endsection