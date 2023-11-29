@extends('layouts.app')

@include('layouts.flash')

@section('content')

@include('application.components.subheader')

<main class="metas">
    <div class="center">
        <h1 class="title">Metas de Entrada (Em desenvolvimento, favor aguardar)</h1>
        
        {{-- <div class="father">
            @foreach ($registros as $reg)
                @if(isset($reg->goal_spend))
                    <div class="card">
                        <div class="month">
                            <div class="upper">Mês</div>
                            <div class="down">{{ date('m/Y', strtotime($reg->month)) }}</div>
                        </div>

                        <div class="goal">
                            <div class="upper">Meta</div>
                            <div class="down">R$ {{ number_format($reg->goal_spend / 100, 2, ',', '.') }}</div>
                        </div>

                        <div class="manage" x-data="{deletePop: false, editPop: false}">
                            <div class="upper">Gerenciar</div>
                            <div class="down">

                                <button class="btn_edit" x-on:click="editPop = true">Editar</button>

                                @include('application.components.edit-popup')

                                <div class="btn_delete" x-on:click="deletePop = true">Excluir</div>

                                <div class="pop_up_bg" style="display:none" x-show="deletePop"></div>
                                
                                @include('application.components.delete-popup')
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div> --}}
    </div>
</main>

@endsection