@extends('layouts.header')
@section('content')
    <div class="flex-col">
        <p>Выберите категорию</p>
                @foreach($categories as $category)
                    <a href="{{url('cards/create?id='.$category->id.'&category='.$category->name)}}">{{$category->name}}</a>
                @endforeach
    </div>
@endsection
