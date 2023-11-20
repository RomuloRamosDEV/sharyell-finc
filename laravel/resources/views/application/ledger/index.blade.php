@extends('layouts.app')

@include('layouts.flash')

@section('content')

@include('application.components.subheader')

<main class="metas">
    <div class="center">
        <h1 class="title">Metas de Gasto</h1>
        
        <div class="father">
            <div class="card">
                <div class="goal">
                    <div class="upper">Meta</div>
                    <div class="down"></div>
                </div>

                <div class="month">
                    <div class="upper">Mês</div>
                    <div class="down"></div>
                </div>

                <div class="manage">
                    <div class="upper">Gerenciar</div>
                    <div class="down"></div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection