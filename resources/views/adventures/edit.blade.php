@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Editar Aventura</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($adventure, ['route' => ['adventures.update', $adventure->id], 'method' => 'patch']) !!}

            @include('adventures.fields')

            {!! Form::close() !!}
        </div>
@endsection
