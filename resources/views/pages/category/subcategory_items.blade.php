@foreach($subcategory->input as $input)
    <div class="flex-col" id="input_container_{{$input->id}}">
        <p>{{$input->name}}</p>
        <div class="flex" style="margin-bottom: 10px">
            <button class="btn btn-secondary" id="edit_input_{{$input->id}}" style="margin-right: 10px">Изменить</button>
            <button class="btn btn-danger">Удалить</button>
        </div>
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
    </script>
@endforeach
