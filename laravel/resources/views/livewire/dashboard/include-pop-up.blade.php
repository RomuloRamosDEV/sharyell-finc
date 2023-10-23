<div class="pop_up_earn">
    <select id="">
        <option value="" selected disabled>Categoria</option>
        @foreach ($categories as $cat)    
        <option value="{{$cat->id}}">{{$cat->titulo}}</option>
        @endforeach
    </select>

    <input type="text">

    <input type="number" placeholder="R$ 00,00">

    <input type="date">
</div>