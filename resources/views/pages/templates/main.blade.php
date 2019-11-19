@extends('layouts.header')
@section('content')
    <div class="flex justify-end w-100 create_container">
        <a href="{{url('/templates/create')}}"><button type="button" class="btn">Добавить шаблон</button></a>
    </div>
    <div class="flex-col">
    @foreach($templates as $template)
        <a href="{{url('templates/create?id='.$template->id)}}">{{$template->name}}</a>
        @endforeach
        </div>
@endsection
