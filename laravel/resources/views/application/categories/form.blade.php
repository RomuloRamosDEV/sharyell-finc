@extends('layouts.app')

@include('layouts.flash')

@section('content')

<main class="previsoes_form">
    <div class="centre">
        <a href="{{route('categorias.index')}}" class="a_back">
            <div class="btn_back">voltar</div>
        </a>
    </div>
    
    @if(request()->routeIs('categorias.edit'))
        <livewire:categories.select-box :categoria="$categoria">
    @else
        <livewire:categories.select-box>
    @endif
</main>


@endsection