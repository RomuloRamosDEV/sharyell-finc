<div class="center" x-data="{modalCreate: false}">
    <h1 class="title">Previsões e Planejamento</h1>
    
    <div class="btn_create" x-on:click="modalCreate = true" wire:click='modaller'>Novo Planejamento</div>

    <div class="external">
        @foreach ($previsoes as $previsao)  
        <div class="card_previsao">
            <div class="category">
                <p class="cat">{{$previsao->categoria}}</p>

                <p class="total_value">R$ {{ number_format($previsao->top_value / 100, 2, ',', '.') }}</p>
            </div>

            <div class="percentage">
                <div class="bar_box">
                    @if ($previsao->percent <= 20.10)
                        <div class="bar" style="width: {{$previsao->percent}}%;background-color: #5ab65f"></div>
                    @elseif($previsao->percent <= 69.00)
                        <div class="bar" style="width: {{$previsao->percent}}%;background-color: #5ab65f"></div>
                        <div class="percent" style="width:{{$previsao->percent}}%">{{$previsao->percent}}%</div>
                    @elseif($previsao->percent >= 69.01 and $previsao->percent <= 99.99)
                        <div class="bar" style="width: {{$previsao->percent}}%;background-color: #61958E"></div>
                        <div class="percent" style="width:{{$previsao->percent}}%">{{$previsao->percent}}%</div>
                    @elseif($previsao->percent == 100.00)
                        <div class="bar" style="width: {{$previsao->percent}}%;background-color: darkred"></div>
                        <div class="percent" style="width:{{$previsao->percent}}%">{{$previsao->percent}}%</div>
                    @endif
                </div>
            </div>

            <div class="value">
                <p>Valor Gasto:</p>
                <p>R$ {{ number_format($previsao->value_now / 100, 2, ',', '.') }}</p>
            </div>

            <div class="btns">
                <a href="{{route('previsoes-edit', $previsao->id)}}">
                    <div class="btn_edit">
                        Editar
                    </div>
                </a>
                
                <div class="btn_delete" wire:click='destroy({{$previsao->id}})'>Excluir</div>
            </div>
        </div>
        @endforeach
    </div>

    @if($modal == true)
    <div class="new_popup_bg" style="display: none" x-show="modalCreate">
        <div class="new_popup" x-on:click.outside="modalCreate = false">
            <h2 class="pop_title">Adicionar novo Planejamento:</h2>
            
            <div class="fields">
                <img class="closer" src="{{asset('img/layout/close.svg')}}" alt="fechar" x-on:click="modalCreate = false">
            
                <div class="line">
                    <label for="category_id">Categoria</label>
                    
                    <select class="select_default" id="category_id" wire:model='catInput' required>
                        <option value="0" selected disabled>Categoria</option>
                        @foreach ($categories as $cat)    
                        <option value="{{$cat->id}}">{{$cat->titulo}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="line">
                    <label for="">Valor da Previsão</label>
                    
                    <div class="number_live">
                        <input class="input_number" type="text" placeholder="R$" wire:model='valueInput' 
                        data-prefix="R$ " data-thousands="." data-decimal="," required>
                    </div>
                </div>
            </div>

            @if(isset($message))
            <p class="message">{{$message}}</p>
            @endif

            <button class="btn_create_negativo" style="margin-top: 25px" 
            wire:click='store'>Criar</button>
        </div>
    </div>
    @endif
</div>