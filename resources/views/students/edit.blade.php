@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Student</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($student, ['route' => ['students.update', $student->id], 'method' => 'patch']) !!}

            @include('students.fields')

            {!! Form::close() !!}
        </div>
@endsection
