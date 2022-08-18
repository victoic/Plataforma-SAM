@extends('layouts.app')

@section('content')
    @include('contacts.show_fields')

    <div class="form-group">
           <a href="{!! route('contacts.index') !!}" class="btn btn-default">Back</a>
    </div>
@endsection
