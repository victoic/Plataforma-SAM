@extends('layouts.sidebar')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Configurações</div>

    <div class="panel-body">
        Bem vindo!
    </div>
</div>
@include("layouts.scripts")
<script type="text/javascript">
    $("#profile").removeClass("active");
    $("#adventure").removeClass("active");
    $("#library").removeClass("active");
    $("#classroom").removeClass("active");
    $("#achievements").removeClass("active");
    $("#settings").addClass("active");
    $("#contact").removeClass("active");
</script>
@endsection