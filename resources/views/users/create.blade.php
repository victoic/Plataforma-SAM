@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="pull-left">Criar Novo Usuário</h1>
        </div>
    </div>

    @include('core-templates::common.errors')

    <div class="row">
        {!! Form::open(['route' => 'users.store']) !!}

            @include('users.fields')

        {!! Form::close() !!}
    </div>
@endsection
