@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Editar Alternativa</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($alternative, ['route' => ['alternatives.update', $alternative->id], 'method' => 'patch']) !!}

            @include('alternatives.fields')

            {!! Form::close() !!}
        </div>
@endsection
