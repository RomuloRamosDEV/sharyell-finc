@extends('layouts.app')

@include('layouts.flash')

@section('content')

<main class="videos_index">
    <div class="centre">
        <div class="card">
            <div class="video">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/SuyIig8AVrQ" 
                    title="Tutorial Básico do Horizon Financy" frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                </iframe>
            </div>
            
            <h3 class="title">1 - Primeiro Acesso</h3>
        </div>
    </div>
</main>

@endsection