@extends('layouts.app')

@section('content')
    @include('adventures.show_fields')

    <div class="form-group">
           <a href="{!! route('adventures.index') !!}" class="btn btn-default">Voltar</a>
    </div>
@endsection
