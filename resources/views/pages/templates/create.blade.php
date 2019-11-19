@extends('layouts.header')
@section('content')
    <div class="flex-col w-100 main_container">
        @if($template == 'empty')
            <h2 class="w-100 text-center">Создание шаблона</h2>
            <div class="container_group flex-col">
                <label class="cat_name_label" for="template_name">Название шаблона</label>
                <input type="text" placeholder="Прим: Договор/Акт" id="template_name" name="template_name">
                <span class="input_error" id="template_name_error">Данное поле не может быть пустым!</span>
                <label class="cat_name_label" for="select_type">Тип шаблона</label>
                <select id="select_type">
                    <option value="select">Select</option>
                    <option value="checkbox">Checkbox</option>
                    <option value="radio">RadioButton</option>
                </select>
                <input type="hidden" value="0" id="template_id">
                <button class="btn btn-success save_cat_btn" data-type_cat="template" type="button" id="template_save_btn">Сохранить</button>
            </div>
        @else
            <h2 class="w-100 text-center">Изменение шаблона "{{$template->name}}"</h2>
            <div class="container_group flex-col">
                <label class="cat_name_label" for="template_name">Название шаблона</label>
                <input type="text" placeholder="Прим: Сантехника" value="{{$template->name}}" id="template_name" name="template_name">
                <input type="hidden" value="{{$template->id}}" id="template_id">
                <button class="btn btn-success save_cat_btn" type="button" id="save_category">Сохранить</button>
            </div>
        @endif

        <h2 class="w-100 sub_title  text-center">Создание/изменение пунктов</h2>
        <div class="flex justify-between">
            <div class="flex w-50">
                <div class="container_group flex-col " id="add_subcategory_block">
                    <label class="cat_name_label" for="temp_input_name">Название пункта</label>
                    <input type="text" placeholder="Прим: Да" id="temp_input_name" name="temp_input_name">
                    <span class="input_error" id="temp_input_name_error">Данное поле не может быть пустым!</span>
                    <input type="hidden" value="0" id="temp_input_id">
                    <button class="btn btn-success save_cat_btn" data-type_cat="temp_input" type="button" id="template_save_btn">Добавить</button>
                </div>

                <div class="" id="subcategory_settings">

                </div>
            </div>

            @if($template != 'empty')
                <div class="flex-col w-50" id="subcategory_container">
                    @foreach($template->inputs as $input)
                        <div id="subcategory_content_{{$input->id}}">
                            <p><b>Пункт "{{$input->name}}"</b></p>
                            <button type="button" id="edit_input_{{$input->id}}" class="btn btn-info" style="max-width: 200px; margin-bottom: 10px">Изменить</button>
                            <button type="button" id="delete_input_{{$input->id}}" class="btn btn-danger" style="max-width: 200px; margin-bottom: 10px">Удалить</button>
                        </div>
                        <script>
                            $('#edit_subcategory_{{$input->id}}').click(function () {

                                $.ajax({
                                    type: "GET",
                                    url: "/template_input_edit",
                                    data: {
                                        id: "{{$input->id}}"
                                    },
                                    success:function (result) {
                                        $('#subcategory_container').hide();
                                        $('#subcategory_items').css({"display":"flex"}).html(result);
                                    }
                                })

                            });
                            $('#delete_subcategory_{{$input->id}}').click(function () {
                                $.ajax({
                                    type: "GET",
                                    url: "/template_input_delete",
                                    data:{
                                        id: "{{$input->id}}"
                                    },
                                    success:function () {
                                        $('subcategory_content_{{$input->id}}').hide();
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

        $('#template_save_btn').click(function () {
            var route = this.dataset.type_cat;
            var name_input = $('#'+route+'_name');
            var name = name_input.val();
            var type = $('#select_type').val();
            var id = $('#template_id').val();
            var input_id = 'no';
            if(route === 'temp_input'){
                input_id =  $('#temp_input_id').val();
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
                    type: type,
                    id:id,
                    input_id:input_id
                },
                success:function (result) {
                    if(id === '0'){
                        $('.sub_title').css({"display":"block"});
                        $('#add_subcategory_block').css({"display":"flex"});
                        $('#category_id').attr("value",result);
                    }
                    else{
                        $('#subcategory_settings').html(result);
                    }
                }
            })
        });




    </script>
@endsection
