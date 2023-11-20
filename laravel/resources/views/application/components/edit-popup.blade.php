<div class="edit_popup" x-show="editPop" x-on:click.outside="editPop = false" style="display: none">
    <h1 class="title">Editar Meta</h1>

    <form class="forms" id="update_form{{$reg->id}}" action="{{route('metas.update', $reg->id)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="fields">
            <img class="closer" src="{{asset('img/layout/close.svg')}}" alt="fechar" x-on:click="editPop = false">
        
            <div class="number_live">
                <input class="input_number" type="text" placeholder="R$" name="goal_spend" 
                data-prefix="R$ " data-thousands="." data-decimal="," value="{{ number_format($reg->goal_spend / 100, 2, ',', '.') }}">
            </div>

            <input type="date" name="month" class="date_input" value="{{$reg->month}}">
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