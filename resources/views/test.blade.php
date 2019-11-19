<h1>{{$card->name}}</h1>

<h2>Цены</h2>
    @foreach($category->subcategory as $subcategory)
        <h3>{{$subcategory->name}}</h3>
        @foreach($subcategory->input as $input)
            @foreach($card->prices as $price)
                @if($price->input_id == $input->id)
                    <p><b>{{$input->name}}: </b>{{$price->price}}</p>
                @endif
            @endforeach
        @endforeach
    @endforeach
<h2>Шаблоны</h2>
@foreach($card->temp_values as $val)
    <p><b>{{$val->template_id}} {{$val->template_name}}: </b>{{$val->value}}</p><br>
    @endforeach
