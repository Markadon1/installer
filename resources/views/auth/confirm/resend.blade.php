@extends('layouts.verified')
@section('auth')
    <div class="col-6 confirm_container">
        <div class="confirm_header">
            @if(session()->has('message'))
                {{session('message')}}
            @endif
        </div>
        <div class="confirm_content">
            <div style="font-size: 15px">
                Если Вам не пришло письмо, или Вы указали неверную почту, Вы можете отправить письмо повторно
            </div>
            <form action="{{url('/register/resend')}}" method="GET" enctype="multipart/form-data" style="width: 60%">
                @csrf
                <div class="email_form">
                    <div>
                        <label for="email">E-mail</label>
                    </div>
                    <div>
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <input name="email" id="email" type="email" value="{{$user->email}}">
                    </div>

                </div>
                <div class="email_form_buttons">
                    <button type="submit" class="btn btn-success">Отправить ещё раз</button>
                    <button type="submit" class="btn btn-secondary" disabled>Далее</button>
                    Шаг 2 из 3
                </div>
            </form>
        </div>

    </div>
@endsection