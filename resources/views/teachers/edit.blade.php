@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Teacher</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($teacher, ['route' => ['teachers.update', $teacher->id], 'method' => 'patch']) !!}

            @include('teachers.fields')

            {!! Form::close() !!}
        </div>
@endsection
