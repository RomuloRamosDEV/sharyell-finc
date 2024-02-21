<div class="forms">
    <div class="line">
        <label for="titulo">Nome:</label>
        <input class="input_text" type="text" 
        wire:model='inputTitulo' 
        wire:ignore id="titulo" 
        placeholder="Digite aqui"
        @if(request()->routeIs('categorias.edit')) value="{{$inputTitulo}}" @endif required>
    </div>
    
    <div class="line">
        <label for="type">Tipo</label>
        <select class="select_default" wire:model='inputType' wire:ignore id="type" required>
            <option value="0" disabled selected>Selecione um tipo</option>
            <option value="saida" @if(request()->routeIs('categorias.edit') && $categoria->type == 'saida') selected @endif>Saída</option>
            <option value="entrada" @if(request()->routeIs('categorias.edit') && $categoria->type == 'entrada') selected @endif>Entrada</option>
        </select>
    </div>

    <div class="line">
        @if(isset($cor))
        <div class="square" style="background-color: {{$cor->color}}"></div>
        @endif
        
        <label for="color">Cor</label>
        <select class="select_default" wire:model='inputColor' id="color" wire:change='changeColor'>
            <option value="0" disabled selected>Selecione uma Cor</option>
            @foreach ($colors as $color)
                <option value="{{$color->id}}" @if(request()->routeIs('categorias.edit') && $categoria->color == $color->id) selected @endif>
                    {{$color->titulo}}
                </option>
            @endforeach
        </select>
    </div>

    @if(isset($message))
    <div class="message">{{$message}}</div>
    @endif
    
    @if(!isset($categoria))
        <div class="btn_update" wire:click="store" wire:loading.attr="disabled">
            <span wire:loading.remove>Criar</span>
            <span wire:loading>Carregando...</span>
        </div>
    @else
        <div class="btn_update" wire:click="update" wire:loading.attr="disabled">
            <span wire:loading.remove>Alterar</span>
            <span wire:loading>Carregando...</span>
        </div>
    @endif
    
</div>
