@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col-sm-12">
                <h1 class="pull-left">Edit Topic</h1>
            </div>
        </div>

        @include('core-templates::common.errors')

        <div class="row">
            {!! Form::model($topic, ['route' => ['topics.update', $topic->id], 'method' => 'patch']) !!}

            @include('topics.fields')

            {!! Form::close() !!}
        </div>
@endsection
