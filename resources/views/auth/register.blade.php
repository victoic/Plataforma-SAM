@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrar</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 col-md-offset-1 control-label">Nome</label>

                            <div class="col-md-5">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 col-md-offset-1 control-label">Email</label>

                            <div class="col-md-5">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 col-md-offset-1 control-label">Senha</label>

                            <div class="col-md-5">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 col-md-offset-1 control-label">Confirme sua senha</label>

                            <div class="col-md-5">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('birth_date') ? ' has-error': '' }}">
                            <label class="col-md-4 col-md-offset-1 control-label">Data de nascimento</label>

                            <div class="col-md-3">
                                <input type="date" class="form-control" name="birth_date" maxlength="10">

                                @if ($errors->has('birth_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birth_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('teacher') ? ' has-error': '' }}">
                            <label class="col-md-4 col-md-offset-1 control-label">Sou professor(a)</label>

                            <div class="col-md-1">
                                <input type="checkbox" class="form-control" name="teacher" value=1>

                                @if ($errors->has('teacher'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('teacher') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScripts -->
@include('layouts.scripts')
<script type="text/javascript">
    $('#navbarLogin').click(function(e){
        window.location="{!! url('/login') !!}";
    });
    $('#navbarRegister').click(function(e){
        window.location="{!! url('/register') !!}";
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("input[name=birth_date]").keyup(function(){
            if ($(this).val().length == 2){
                $(this).val($(this).val() + "/");
            }else if ($(this).val().length == 5){
                $(this).val($(this).val() + "/");
            }
        });
    });
</script>
@endsection
