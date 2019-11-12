@extends('layouts.header')
@section('content')

  <div class="flex justify-end w-100 create_container">
      <a href="{{url('/category/create')}}"><button type="button" class="btn">Добавить категорию</button></a>
  </div>
    <div class="flex-col">
        @foreach($categories as $category)
            <a href="{{url('category/create?id='.$category->id)}}">{{$category->name}}</a>
        @endforeach
    </div>
@endsection
