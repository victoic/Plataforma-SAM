@extends('layouts.app')

@section('content')
    @include('students.show_fields')

    <div class="form-group">
           <a href="{!! route('students.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
