@extends('layouts.app')

@include('layouts.flash')

@section('content')

<div class="main_dashboard">
    <div class="dashboard_external">
        <livewire:dashboard.index>
    </div>
</div>

@endsection
