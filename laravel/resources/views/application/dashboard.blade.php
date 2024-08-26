@extends('layouts.app')

@include('layouts.flash')

@section('content')

<div class="main_dashboard">
    <div class="dashboard_external">
        <livewire:dashboard.index>
    </div>

    @if($user->first_access == 1)
        <div class="first_access_general">
            <div class="popup">
                <h1>Bem-vindo ao Horizon Experience</h1>
                <p>Para começar, assista o vídeo abaixo para entender como funciona.</p>
                <div class="video">
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/SuyIig8AVrQ" 
                        title="Tutorial Básico do Horizon Financy" frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe>
                </div>

                <a href="{{ route('first-access', $user->id) }}" class="btn_create">Concluir</a>
            </div>
            
            
        </div>
    @endif
</div>

@endsection
