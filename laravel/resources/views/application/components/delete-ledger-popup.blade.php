<div class="delete_popup" x-show="deleteLedgerPop" x-on:click.outside="deleteLedgerPop = false" style="display: none">
    <h1 class="title">Tem certeza que deseja excluir esse registro?</h1>

    <div class="flexer">
        <div class="btn_back" x-on:click="deleteLedgerPop = false">
            Voltar
        </div>

        <form action="{{route('registros.destroy', $reg->id)}}" method="POST" id="delete_form{{$reg->id}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn_confirm" form="delete_form{{$reg->id}}">
                Deletar
            </button>
        </form>
    </div>
</div>