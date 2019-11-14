<div style="margin-bottom: 15px">
<input type="text" value="{{$input->name}}" id="input_edit_name_{{$input->id}}" style="min-width: 400px">
<button class="btn btn-success" id="edit_input_confirm_{{$input->id}}">Изменить</button>
</div>
<script>
    $('#edit_input_confirm_{{$input->id}}').click(function () {
        var name = $('#input_edit_name_{{$input->id}}').val();
        $.ajax({
            type: "GET",
            url: "/edit_input_confirm",
            data:{
                id: "{{$input->id}}",
                name: name
            },
            success: function (result) {
                $('#input_container_{{$input->id}}').html(result)
            }
        })
    });
</script>
