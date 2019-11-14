@extends('layouts.header')
@section('content')

<div class="flex-col w-100 main_container">
    @if($category == 'empty')
    <h2 class="w-100 text-center">Создание категории</h2>
        <div class="container_group flex-col">
            <label class="cat_name_label" for="category_name">Название категории</label>
            <input type="text" placeholder="Прим: Сантехника" id="category_name" name="category_name">
            <span class="input_error" id="category_name_error">Данное поле не может быть пустым!</span>
            <input type="hidden" value="0" id="category_id">
            <button class="btn btn-success save_cat_btn" data-type_cat="category" type="button" id="category_save_btn">Сохранить</button>
        </div>
    @else
        <h2 class="w-100 text-center">Изменение категории "{{$category->name}}"</h2>
        <div class="container_group flex-col">
            <label class="cat_name_label" for="category_name">Название категории</label>
            <input type="text" placeholder="Прим: Сантехника" value="{{$category->name}}" id="category_name" name="category_name">
            <input type="hidden" value="{{$category->id}}" id="category_id">
            <button class="btn btn-success save_cat_btn" type="button" id="save_category">Сохранить</button>
        </div>
    @endif

        <h2 class="w-100 sub_title  text-center">Создание/изменение подкатегорий</h2>
        <div class="flex justify-between">
            <div class="flex w-50">
                <div class="container_group flex-col " id="add_subcategory_block">
                    <label class="cat_name_label" for="subcategory_name">Название подкатегории</label>
                    <input type="text" placeholder="Прим: Установка смесителя" id="subcategory_name" name="subcategory_name">
                    <span class="input_error" id="subcategory_name_error">Данное поле не может быть пустым!</span>
                    <input type="hidden" value="0" id="subcategory_id">
                    <button class="btn btn-success save_cat_btn" data-type_cat="subcategory" type="button" id="category_save_btn">Добавить</button>
                </div>

                <div class="" id="subcategory_settings">

                </div>
            </div>

        @if($category != 'empty')
            <div class="flex-col w-50" id="subcategory_container">
        @foreach($category->subcategory as $subcategory)
            <div id="subcategory_content_{{$subcategory->id}}">
                <p><b>Подкатегория "{{$subcategory->name}}"</b></p>
                @foreach($subcategory->input as $input)
                    <p style="margin-left: 20px">{{$input->name}}</p>
                    @endforeach
                <button type="button" id="edit_subcategory_{{$subcategory->id}}" class="btn btn-info" style="max-width: 200px; margin-bottom: 10px">Изменить</button>
                <button type="button" id="delete_subcategory_{{$subcategory->id}}" class="btn btn-danger" style="max-width: 200px; margin-bottom: 10px">Удалить</button>
            </div>
            <script>
                $('#edit_subcategory_{{$subcategory->id}}').click(function () {

                    $.ajax({
                        type: "GET",
                        url: "/subcat_edit",
                        data: {
                            id: "{{$subcategory->id}}"
                        },
                        success:function (result) {
                            $('#subcategory_container').hide();
                            $('#subcategory_items').css({"display":"flex"}).html(result);
                        }
                    })

                });
                $('#delete_subcategory_{{$subcategory->id}}').click(function () {
                    $.ajax({
                        type: "GET",
                        url: "/subcat_delete",
                        data:{
                            id: "{{$subcategory->id}}"
                        },
                        success:function () {
                            $('subcategory_content_{{$subcategory->id}}').hide();
                        }
                    })
                });
            </script>
            @endforeach
            </div>
                <div class="flex-col w-50" style="display: none" id="subcategory_items"></div>
        @endif

        </div>
</div>

    <script>

        $('#category_save_btn').click(function () {
            var route = this.dataset.type_cat;
            var name_input = $('#'+route+'_name');
            var name = name_input.val();
            var id = $('#category_id').val();
            var sub_id = 'no';
            if(route === 'subcategory'){
                sub_id =  $('#subcategory_id').val();
            }
            if(name === ''){
                $('#'+route+'_name_error').css({"display":"block"});
                name_input.css({"border-color":"red"});
                return;
            }
            else{
                $('#'+route+'_name_error').css({"display":"none"});
                name_input.css({"border-color":"#6c6b6c"});
            }
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/"+route+"/create",
                data: {
                    name:name,
                    id:id,
                    sub_id:sub_id
                },
                success:function (result) {
                    if(id === '0'){
                        $('.sub_title').css({"display":"block"});
                        $('#add_subcategory_block').css({"display":"flex"});
                        $('#category_id').attr("value",result);
                    }
                    else{
                        $('#add_subcategory_block').css({"display":"none"});
                        $('#subcategory_settings').html(result);
                    }
                }
            })
        });




    </script>

@endsection
