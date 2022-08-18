@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="pull-left">Criar Novo Tópico</h1>
        </div>
    </div>

    @include('core-templates::common.errors')

    <div class="row">
        {!! Form::open(['route' => 'topics.store']) !!}

            @include('topics.fields')

        {!! Form::close() !!}
    </div>
@endsection
