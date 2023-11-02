@extends('layouts.app')

@include('layouts.flash')

@section('content')

<div class="mainLedger">
    <div class="centre">
        <h2>Registros</h2>

        <h1>Saídas</h1>

        <div class="areaMenu">
            @foreach ($registros as $registro)
            <div class="lineLedger">
                <div class="line">
                    <span>Categoria</span>
                    {{$registro->categoria}}
                </div>

                <div class="line">
                    <span>Nome do Estabelecimento</span>
                    {{$registro->descricao}}
                </div>

                <div class="line">
                    <span>Valor</span>
                    R$ {{ number_format($registro->value/ 100, 2, ',', '.')}}
                </div>

                <div class="line">
                    <span>Data</span>
                    {{ date('d/m/Y', strtotime($registro->date)) }}
                </div>

                <div class="line">
                    <span>Recorrente</span>
                    @if ($registro->remember == 0)
                    Não
                    @elseif ($registro->remember == 1)
                    Sim
                    @endif
                </div>

                <div class="line">
                    <span>Gerenciar</span>
                    <form action="{{ route('registros.destroy', $registro->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{ route('registros.edit', $registro->id ) }}" class="btn_edit">
                                <i class="bi bi-pencil-fill me-2"></i>Editar
                            </a>
                            <button type="submit" class="btn_delete"><i class="bi bi-trash-fill me-2"></i>Excluir</button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection