@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Editar Exercício</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($exercise, ['route' => ['exercises.update', $exercise->id], 'method' => 'patch']) !!}

            @include('exercises.fields')

            {!! Form::close() !!}
        </div>
@endsection
