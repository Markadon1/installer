@extends('layouts.header')
@section('content')
    <div class="flex justify-end w-100 create_container">
        <a href="{{url('/cards/change')}}"><button type="button" class="btn">Добавить карточку</button></a>
    </div>
    <div class="flex-col">
{{--        @foreach($categories as $category)--}}
{{--            <a href="{{url('cards/create?id='.$category->id)}}">{{$category->name}}</a>--}}
{{--        @endforeach--}}
    </div>
@endsection
