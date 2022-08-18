@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="pull-left">Criar Nova Alternativa</h1>
        </div>
    </div>

    @include('core-templates::common.errors')

    <div class="row">
        {!! Form::open(['route' => 'alternatives.store']) !!}

            @include('alternatives.fields')

        {!! Form::close() !!}
    </div>
@endsection
