<div class="delete_popup" x-show="deletePop" x-on:click.outside="deletePop = false" style="display: none">
    <h1 class="title">Tem certeza que deseja excluir esse registro?</h1>

    <div class="flexer">
        <div class="btn_back" x-on:click="deletePop = false">
            Voltar
        </div>

        <form action="{{route('categorias.destroy', $item->id)}}" method="POST" id="delete_form{{$item->id}}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn_confirm" form="delete_form{{$item->id}}">
                Deletar
            </button>
        </form>
    </div>
</div>