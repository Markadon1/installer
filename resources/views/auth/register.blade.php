@extends('layouts.header')

@section('auth')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Регистрация</div>

                    <div class="card-body">
                        <form method="POST" action="{{url('register/send')}}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" id="name_div" class="col-md-4 col-form-label text-md-right">Фамилия Имя</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Телефон</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="phone form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Подтвердить пароль</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="register_rules">
                            <p>Подтверждая регистрацию, Вы принимаете <span id="pay_reg">Условия использования Продуктов компании</span> и <span id="payback_reg">Политику возврата денежных средств</span></p>
                            </div>
                            <div class="rules_modal">
                                <div class="rules_modal_body">

                                </div>

                            </div>
                            <script>
                                $('#pay_reg').click(function () {
                                    var rule = 'pay';
                                    $('.rules_modal').css({"display":"block","transition":"1s"});
                                    $.ajax({
                                       type: "POST",
                                        headers: {
                                            'X-CSRF-token': $('meta[name="csrf-token"]').attr('content')
                                        },
                                       url: "/rules",
                                        data: {rule:rule},
                                        success:function (result) {
                                            $('.rules_modal_body').html(result)
                                        }
                                    });
                                });
                                $('#payback_reg').click(function () {
                                    var rule = 'payback';
                                    $('.rules_modal').css({"display":"block","transition":"1s"});
                                    $.ajax({
                                        type: "POST",
                                        headers: {
                                            'X-CSRF-token': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        url: "/rules",
                                        data: {rule:rule},
                                        success:function (result) {
                                            $('.rules_modal_body').html(result)
                                        }
                                    });
                                });
                            </script>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Зарегистрироваться
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
