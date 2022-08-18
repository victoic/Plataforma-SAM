@extends('layouts.sidebar')

@section('content')
<div class="panel panel-sam">
    <div class="panel-heading row text-center">
        <h3><strong>Biblioteca</strong></h3>
    </div>
    <div class="panel-body">
        <div class="col-xs-12">
            <div class="col-xs-3">
                <h3><strong>Aventuras</strong></h3>
            </div>
            <div class="col-xs-3 h3" role="group" >
                <a href="{!! route('adventures.create') !!}" type="button" class="btn btn-default"><i class="fa fa-plus" aria-hidden="true"></i></a>
                <a href="{!! route('adventures.index') !!}" type="button" class="btn btn-default"><i class="fa fa-search" aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="col-md-12">
            <h4><strong>Minhas Aventuras</strong></h4>
        </div>
        <div id="createdAdventures" class="col-md-12">
        @foreach ($user->myTeacher->createdAdventures as $adventure)
            @include('cards.adventureCard')
        @endforeach
        </div>
        <div class="col-md-12">
            <h4><strong>Aventuras Adicionadas</strong></h4>
        </div>
        <div id="createdAdventures" class="col-md-12">
        @foreach ($user->myTeacher->adventuresInLibrary as $adventure)
            @include('cards.adventureCard')
        @endforeach
        </div>
    </div>
    <div class="panel-body">
        <div class="col-xs-12">
            <div class="col-xs-3">
                <h3><strong>Meus Módulos</strong></h3>
            </div>
            <div class="col-xs-3 h3" role="group" >
                <a href="{!! route('modules.create') !!}" type="button" class="btn btn-default"><i class="fa fa-plus" aria-hidden="true"></i></a>
            </div>
        </div>
        <div id="createdModules" class="col-md-12">
        @foreach ($user->myTeacher->createdModules as $module)
            <div class="card libraryCard col-md-3">
            @include('cards.moduleCard')
            </div>
        @endforeach
        </div>
    </div>
    <div class="panel-body">
        <div class="col-xs-12">
            <div class="col-xs-3">
                <h3><strong>Minhas Atividades</strong></h3>
            </div>
            <div class="col-xs-3 h3" role="group" >
                <a href="{!! route('activities.create') !!}" type="button" class="btn btn-default"><i class="fa fa-plus" aria-hidden="true"></i></a>
            </div>
        </div> 
        <div id="createdActivities" class="col-md-12">
        @foreach ($user->myTeacher->createdActivities as $activity)
            <div class="card libraryCard col-md-3">
            @include('cards.activityCard')
            </div>
        @endforeach
        </div>
    </div>
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

    $('#navbarHome').click(function(e){
        window.location="{!! url('/home') !!}";
    });

    $(document).ready(function(){
        $("#createdAdventures").find(".deleteButton").remove();
        $("#createdActivities").find(".deleteButton").remove();
        $("#createdModules").find(".deleteButton").remove();
    })

    $(".deleteButton").click(function(e){
        var data = {};
        var idAdventure = $(this).parent().parent().parent().prop('id').split('-');
        idAdventure = idAdventure[1];
        data['idAdventure'] = idAdventure;
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "{!! route('users.removeAdventureFromLibrary') !!}",
            data: data,
            success: function (response) {
                window.location.replace("{!! url('/library') !!}");
            },
            error: function (response) {
                var errors = response.responseJSON;
                console.log(errors);
                window.location.replace("{!! url('/library') !!}");
            }
        });
    })
</script>
@endsection