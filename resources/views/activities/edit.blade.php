@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Editar Atividade</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($activity, ['route' => ['activities.update', $activity->id], 'method' => 'patch']) !!}

            @include('activities.fields')

            {!! Form::close() !!}
        </div>
@endsection
