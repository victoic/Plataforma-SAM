@extends('layouts.app')

@section('content')
    @include('teachers.show_fields')

    <div class="form-group">
           <a href="{!! route('teachers.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
