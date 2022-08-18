@extends('layouts.app')

@section('content')
    @include('exercises.show_fields')

    <div class="form-group">
           <a href="{!! route('exercises.index') !!}" class="btn btn-default">Voltar</a>
    </div>
@endsection
