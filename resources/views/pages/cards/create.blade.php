@extends('layouts.header')
@section('content')
    <form method="POST" action="{{url('cards/create')}}" enctype="multipart/form-data">
        @csrf
    <div class="flex-col w-100 main_container">
    <h2 class="w-100 text-center">Создание карточки</h2>
    <h3 class="w-100 text-center">Категория: "{{$category->name}}"</h3>
        <div class="flex w-100 justify-between">
        <h4 style="border: 1px solid #2d2c2d;">Тут будет добавление название карточки</h4>
        <h4 style="border: 1px solid #2d2c2d;">Тут будет добавление ЛОГО</h4>
        </div>
        <h4 class="w-100 text-center">Укажите стоимость</h4>
        <div class="flex justify-between flex-wrap w-100">
            @foreach($category->subcategory as $subcategory)
                <div class="flex justify-between flex-wrap w-45" style="border: 1px solid #2d2c2d; border-radius: 10px; margin-bottom: 20px;padding: 15px">
                    <h4 class="w-100 text-center">{{$subcategory->name}}</h4>
                    <input type="hidden" value="{{$subcategory->id}}" name="subcategory_id[]">
                    @foreach($subcategory->input as $input)
                        <div class="flex-col w-45">
                            <label style="height: 40px" for="sub_input_{{$input->id}}" >{{$input->name}}</label>
                            <input type="text" value="" style="margin-bottom: 10px" name="subcat_{{$subcategory->id}}_input_{{$input->id}}" id="sub_input_{{$input->id}}">
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="w-100 flex flex-wrap justify-between" style="margin-bottom: 10px">
            @foreach($category->templates as $template)
                <div class="flex-col align-center w-25">
                    <input type="hidden" name="template_id[]" value="{{$template->id}}">
                <h4>{{$template->name}}</h4>
                    <div class="flex-col">
                @foreach($template->inputs as $input)
                        @if($template->type == 'radio' or $template->type == 'checkbox')
                        <div style="margin-right: 10px">
                        <input type="hidden" name="template_input_id[]" value="{{$input->id}}">
                        <input type="{{$template->type}}" @if($template->type == 'radio')checked @endif value="{{$input->value}}" name="template_{{$template->type}}_{{$template->id}}@if($template->type == 'checkbox')[]@endif" id="input_id_{{$input->id}}">
                        <label for="input_id_{{$input->id}}">{{$input->name}}</label>
                        </div>
                        @endif
                @endforeach
                    </div>
                </div>
                @endforeach
        </div>
            <h4 class="w-25" style="border: 1px solid #2d2c2d;">Выбор города</h4>
            <h4 class="w-100 text-center" style="border: 1px solid #2d2c2d;">Календарь</h4>
        <input type="hidden" value="{{$category->id}}" name="category_id">
        <button class="btn btn-success w-50" style="margin: 20px auto">Создать</button>
    </div>
    </form>
@endsection
