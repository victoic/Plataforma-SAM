@extends('layouts.app')

@section('content')
    @include('achievements.show_fields')

    <div class="form-group">
           <a href="{!! route('achievements.index') !!}" class="btn btn-default">Voltar</a>
    </div>
@endsection
