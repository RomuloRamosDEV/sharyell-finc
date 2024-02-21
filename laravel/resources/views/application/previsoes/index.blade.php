@extends('layouts.app')

@include('layouts.flash')

@section('content')

<main class="previsoes">
    <livewire:prevision.index>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script 
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" 
    integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" 
    crossorigin="anonymous" referrerpolicy="no-referrer">
</script>

<script>
    $(document).ready(function(){
        $('.input_number').mask('000.000.000.000.000,00', {reverse: true});
    });
</script>

@endsection