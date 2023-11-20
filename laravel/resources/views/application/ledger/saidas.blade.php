@extends('layouts.app')

@include('layouts.flash')

@section('content')

@include('application.components.subheader')

<main class="registros">
    <div class="center">
        @include('application.components.ledger-filters')

        @if(request()->routeIs('registros-saida'))
            <h1 class="title">Todos os Registros de Saídas</h1>
        @else
            <h1 class="title">Pesquisa para Registros de Saídas</h1>
        @endif
        
        @if(request()->routeIs('registros-pesquisa-saida'))
        @else
            {{ $registros->links() }}
        @endif

        <div class="father">
            @foreach ($registros as $reg)
                <div class="card">
                    <div class="category">
                        <div class="upper">Categoria</div>
                        <div class="down">{{$reg->cat_titulo}}</div>
                    </div>

                    <div class="card_title">
                        <div class="upper">Descrição</div>
                        <div class="down">{{$reg->descricao}}</div>
                    </div>

                    <div class="value">
                        <div class="upper">Valor</div>
                        <div class="down">R$ {{ number_format($reg->value / 100, 2, ',', '.') }}</div>
                    </div>

                    <div class="month">
                        <div class="upper">Data</div>
                        <div class="down">{{ date('d/m/Y', strtotime($reg->date)) }}</div>
                    </div>

                    <div class="type">
                        <div class="upper">Tipo</div>
                        <div class="down">{{$reg->type}}</div>
                    </div>

                    <div class="manage" x-data="{deleteLedgerPop: false, editLedgerPop: false}">
                        <div class="upper">Gerenciar</div>
                        <div class="down">

                            <button class="btn_edit" x-on:click="editLedgerPop = true">Editar</button>

                            @include('application.components.edit-ledger-popup')

                            <div class="btn_delete" x-on:click="deleteLedgerPop = true">Excluir</div>

                            <div class="pop_up_bg" style="display:none" x-show="deleteLedgerPop"></div>
                            
                            @include('application.components.delete-ledger-popup')
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(request()->routeIs('registros-pesquisa-saida'))
        @else
            {{ $registros->links() }}
        @endif
    </div>
</main>

@endsection