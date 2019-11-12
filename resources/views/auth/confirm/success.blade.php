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
            <div class="email_form">
                <div>
                    <label style="padding: 10px 0;">Телефон:</label>
                </div>
                <div>
                    <label class="email_success">{{$user->phone}}</label>
                </div>
                <div>
                    <label style="padding: 10px 0;color: green;">Подтверждён</label>
                </div>
            </div>
            <div class="email_form_buttons_success">
                <form action="{{url('/register/success')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <button type="submit" class="btn btn-primary">Далее</button>
                </form>

            </div>
        </div>

    </div>
@endsection