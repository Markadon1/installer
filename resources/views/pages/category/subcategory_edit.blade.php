<div class="flex align-center" style="margin-bottom: 10px">
<h4 style="margin-bottom: 0">Подкатегория</h4>
<input style="margin: 0 10px" type="text" value="{{$subcategory->name}}">
<button class="btn btn-success">Изменить</button>
</div>
<input type="hidden" value="{{$subcategory->id}}" id="subcat_id">
<h5>Существующие поля</h5>
<div class="" id="input_all_containers">
@foreach($subcategory->input as $input)
<div class="flex-col" id="input_container_{{$input->id}}">
    <p>{{$input->name}}</p>
    <div class="flex" style="margin-bottom: 10px">
        <button class="btn btn-secondary" id="edit_input_{{$input->id}}" style="margin-right: 10px">Изменить</button>
        <button class="btn btn-danger" id="delete_input_{{$input->id}}">Удалить</button>
    </div>
    <script>
        $('#edit_input_{{$input->id}}').click(function () {
            $.ajax({
                type: "GET",
                url: "/subcat-input_edit",
                data: {
                    id: "{{$input->id}}",
                },
                success:function (result) {
                    $('#input_container_{{$input->id}}').html(result)
                }
            })
        });
        $('#delete_input_{{$input->id}}').click(function () {
            $.ajax({
                type: "GET",
                url: "/subcat-input_delete",
                data: {
                    id: "{{$input->id}}",
                },
                success:function () {
                    $('#input_container_{{$input->id}}').hide();
                }
            })
        });
    </script>
</div>

@endforeach
</div>
<h5>Добавление поля</h5>
<div class="container_group flex-col " id="add_subcategory_block">
    <label class="cat_name_label" for="subcategory_input_name">Название поля</label>
    <input type="text" placeholder="Прим: Установка смесителя для ванны(без демонтажа)" id="subcategory_input_name" name="subcategory_input_name">
    <span class="input_error" id="subcategory_input_name_error">Данное поле не может быть пустым!</span>
    <input type="hidden" value="0" id="subcategory_input_id">
    <button class="btn btn-primary save_cat_btn" data-type_cat="subcategory_input" type="button" id="subcat_input_save_btn">Добавить</button>
</div>
<input type="hidden" value="{{$subcategory->id}}" id="subcat_id">
<script>
    $('#subcat_input_save_btn').click(function () {

        var name_input = $('#subcategory_input_name');
        var name = name_input.val();
        var id = $('#subcategory_input_id').val();
        var sub_id = $('#subcat_id').val();
        if(name === ''){
            $('#subcategory_input_name_error').css({"display":"block"});
            name_input.css({"border-color":"red"});
            return;
        }
        else{
            $('#subcategory_input_name_error').css({"display":"none"});
            name_input.css({"border-color":"#6c6b6c"});
        }
        $.ajax({
            type: "POST",
            url: "/subcat_input/create",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                name:name,
                id:id,
                sub_id:sub_id
            },
            success:function (result) {
                $('#input_all_containers').html(result);
                $('#subcategory_input_name').attr("value","");
            }
        })
    })
</script>
