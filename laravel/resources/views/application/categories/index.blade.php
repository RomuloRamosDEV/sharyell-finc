@extends('layouts.app')

@include('layouts.flash')

@section('content')

<main class="categorias_index">
    <div class="centre">
        <a href="{{route('categorias.create')}}">
            <div class="btn_create">Criar Categoria</div>
        </a>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-800 divide-y divide-gray-700">
                <thead class="bg-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-100 uppercase">
                            Categoria
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-100 uppercase">
                            Tipo
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-100 uppercase">
                            Cor
                        </th>
                        <th scope="col" class="px-6 py-3 text-sm font-medium tracking-wider text-left text-gray-100 uppercase">
                            Gerenciar
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-gray-900 divide-y divide-gray-700">
                    @foreach ($categorias as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-gray-200 text-md">{{$item->titulo}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-gray-200 text-md">{{$item->type}}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-200 btns">
                                <div class="square" style="background-color: {{$item->color_cor}};margin-right:6px"></div>
                                {{$item->color_titulo}}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium whitespace-nowrap" x-data="{deletePop: false}">
                            <div class="btns">
                                <a href="{{route('categorias.edit', $item->id)}}" class="btn_edit">Editar</a>
                                
                                <div class="btn_delete" x-on:click="deletePop = true">Excluir</div>

                                @include('application.categories.delete-popup')
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="pop_up_bg" style="display: none" x-show="deletePop"></div>
</main>

@endsection