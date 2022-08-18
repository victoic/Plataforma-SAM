@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Conquista</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($achievement, ['route' => ['achievements.update', $achievement->id], 'method' => 'patch']) !!}

            @include('achievements.fields')

            {!! Form::close() !!}
        </div>
@endsection
