<h4>Пункт "{{$input->name}}"</h4>
<input type="hidden" value="{{$input->id}}" id="subcat_id">
<div class="container_group flex-col " id="add_subcategory_block">
    <label class="cat_name_label" for="subcategory_input_name">Название поля</label>
    <input type="text" placeholder="Прим: Установка смесителя для ванны(без демонтажа)" id="subcategory_input_name" name="subcategory_input_name">
    <span class="input_error" id="subcategory_input_name_error">Данное поле не может быть пустым!</span>
    <input type="hidden" value="0" id="subcategory_input_id">
    <button class="btn btn-primary save_cat_btn" data-type_cat="subcategory_input" type="button" id="subcat_input_save_btn">Добавить</button>
</div>
<div class="flex-col" id="subcat_input_group">

</div>

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
                $('#subcat_input_group').html(result);
                $('#subcategory_input_name').attr("value","");
            }
        })
    })
</script>
