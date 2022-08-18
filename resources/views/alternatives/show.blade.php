@extends('layouts.app')

@section('content')
    @include('alternatives.show_fields')

    <div class="form-group">
           <a href="{!! route('alternatives.index') !!}" class="btn btn-default">Voltar</a>
    </div>
@endsection
