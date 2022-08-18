@extends('layouts.app')

@section('content')
    @include('modules.show_fields')

    <div class="form-group">
           <a href="{!! route('modules.index') !!}" class="btn btn-default">Voltar</a>
    </div>
@endsection
