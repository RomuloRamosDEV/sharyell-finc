<div @if(request()->routeIs('registros-entrada') or request()->routeIs('registros-pesquisa-entrada')) class="edit_ledger_popup green" 
    @else class="edit_ledger_popup" @endif x-show="editLedgerPop" x-on:click.outside="editLedgerPop = false" style="display: none">
    
    <h1 class="title">Editar Registro</h1>

    <form class="forms" id="update_form{{$reg->id}}" action="{{route('registros.update', $reg->id)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="fields">
            <img class="closer" src="{{asset('img/layout/close.svg')}}" alt="fechar" x-on:click="editLedgerPop = false">

            <div class="object">
                <label for="cat">Categoria</label>

                <select name="cat_title" class="input_text" required id="cat">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $reg->cat_id == $category->id ? 'selected' : '' }}>{{ $category->titulo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="object">
                <label for="descricao">Descrição</label>
                <input type="text" name="descricao" class="input_text" required value="{{$reg->descricao}}" id="descricao">
            </div>
        
            <div class="object">
                <label for="value">Valor</label>

                <div class="number_live">
                    <input class="input_number" type="text" placeholder="R$" name="value" 
                    data-prefix="R$ " data-thousands="." data-decimal="," value="{{ number_format($reg->value / 100, 2, ',', '.') }}" 
                    id="value">
                </div>
            </div>

            <div class="object">
                <label for="date">Data</label>
                <input type="date" name="date" class="date_input" value="{{$reg->date}}">
            </div>

            <div class="object">
                <label for="type">Tipo</label>
                <select name="type" class="input_text" style="height: 45px;" id="type">
                    @if ($reg->type == 'livre')
                        <option value="livre" style="text-transform:uppercase;" selected>LIVRE</option>
                        <option value="fixo" style="text-transform:uppercase;">FIXO</option>
                    @else
                        <option value="fixo" style="text-transform:uppercase;" selected>FIXO</option>
                        <option value="livre" style="text-transform:uppercase;">LIVRE</option>
                    @endif
                </select>
            </div>
        </div>
        
        <button class="btn_create_negativo" type="submit" form="update_form{{$reg->id}}">Enviar</button>
    </form>
</div>

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