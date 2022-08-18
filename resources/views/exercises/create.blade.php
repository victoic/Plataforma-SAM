@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="pull-left">Criar Novo Exercício</h1>
        </div>
    </div>

    @include('core-templates::common.errors')

    <div class="row">
        {!! Form::open(['route' => 'exercises.store']) !!}

            @include('exercises.fields')

        {!! Form::close() !!}
    </div>
    @include("layouts.scripts")
    <script type="text/javascript">
        $("#profile").removeClass("active");
        $("#adventure").removeClass("active");
        $("#library").addClass("active");
        $("#classroom").removeClass("active");
        $("#achievements").removeClass("active");
        $("#settings").removeClass("active");
        $("#contact").removeClass("active");
    </script>
    @include("createJS")
@endsection
