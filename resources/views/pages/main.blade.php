@extends('layouts.header')
@section('content')

    <div class="flex justify-content-around w-100" style="margin-top: 30px">
        <a href="{{url('/category')}}"><button class="btn">Категории</button></a>
        <a href="{{url('/templates')}}"><button class="btn">Шаблоны</button></a>
        <a href="{{url('/cards')}}"><button class="btn">Карточки</button></a>
    </div>

@endsection
