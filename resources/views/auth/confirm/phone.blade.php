@extends('layouts.verified')
@section('auth')
    <div class="col-6 confirm_container">
        <div class="confirm_header">
            @if(session()->has('message'))
                {{session('message')}}
            @endif
        </div>
        <div class="confirm_content">

            <div class="email_form">
                <div>
                    <label style="padding: 10px 0;">E-mail:</label>
                </div>
                <div>
                    <label class="email_success">{{$user->email}}</label>
                </div>
                <div>
                    <label style="padding: 10px 0;color: green;">Подтверждён</label>
                </div>
            </div>
            <div style="font-size: 15px">
                На Ваш телефон отправлено сообщение с кодом подтверждения. Введите его в поле ниже.
            </div>
            <form action="{{url("register/{$user->token}/confirm_phone")}}" method="POST" enctype="multipart/form-data" style="width: 60%">
                @csrf
                <div class="email_form">
                    <div>
                        <label for="phone">Код подтверждения</label>
                    </div>
                    <div>
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <input name="phone" id="phone" type="text" value="" required>
                    </div>
                </div>
                <div class="email_form_buttons">
                    <button type="submit" class="btn btn-secondary">Подтвердить</button>
                    Шаг 3 из 3
                </div>
            </form>
            <div class="email_form_buttons">
                <form action="{{url("register/{$user->token}/confirm_phone/resend")}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <button type="submit" class="btn btn-success">Отправить код ещё раз</button>
                </form>
            </div>

        </div>

    </div>
@endsection