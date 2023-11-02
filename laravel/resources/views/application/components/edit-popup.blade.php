<div class="edit_popup" x-show="editPop" x-on:click.outside="editPop = false" style="display: none">
    <h1 class="title">Editar Meta</h1>

    <form class="forms" id="update_form{{$reg->id}}" action="{{route('metas.update', $reg->id)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="fields">
            <img class="closer" src="{{asset('img/layout/close.svg')}}" alt="fechar" x-on:click="editPop = false">
        
            <div class="number_live">
                <input class="input_number" type="text" placeholder="R$" name="goal_spend" 
                data-prefix="R$ " data-thousands="." data-decimal="," value="R$ {{ number_format($reg->goal_spend / 100, 2, ',', '.') }}">
            </div>

            <input type="date" name="month" class="date_input" value="{{$reg->month}}">
        </div>
        
        <button class="btn_create_negativo" type="submit" form="update_form{{$reg->id}}">Enviar</button>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script 
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" 
    integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>

<script>
    $(function() {
      $('.input_number').maskMoney();
    })
</script>