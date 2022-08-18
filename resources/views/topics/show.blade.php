@extends('layouts.app')

@section('content')
    @include('topics.show_fields')

    <div class="form-group">
           <a href="{!! route('topics.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
