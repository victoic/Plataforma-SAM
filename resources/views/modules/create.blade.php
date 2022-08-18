@extends('layouts.sidebar')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h1 class="pull-left">Criar Novo Modulo</h1>
    </div>
</div>

@include('core-templates::common.errors')

<div class="row">
    {!! Form::open() !!}

    <div id="createModules" class="tab-pane">
            @include('modules.fields')
            <div class="row nested-2">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active"><a href="#usedActivities" data-toggle="tab">Atividades Escolhidos</a></li>
                    <li role="presentation"><a href="#searchActivities" data-toggle="tab">Buscar Atividades</a></li>
                    <li role="presentation"><a href="#createActivities" data-toggle="tab">Criar Atividade</a></li>
                </ul>
            </div>
            <div class="panel-body well">
                <section class="tab-content">
                    <div id="usedActivities" class="tab-pane active">
                        <div class="row center-block text-center">
                            <p class="lead">As atividades desse novo módulo aparecerão aqui</p>
                        </div>
                        <div class="col-md-12" id="usedActivitiesCards"></div>
                    </div>
                    <div id="searchActivities" class="tab-pane">
                        <!-- Topic Field -->
                        <div class="form-group col-xs-12">
                            <p><strong>Buscando atividades do mesmo tópico que o módulo</strong></p>
                        </div>
                        <div class="col-md-12" id="searchActivitiesCards">
                            @foreach ($activities as $activity)
                            <div id={!! "activity-".$activity->id !!} class="addableCard card libraryCard col-md-3">
                                @include('cards.activityCard')
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div id="createActivities" class="tab-pane">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                {!! Form::label('activityDescription', 'Descrição:') !!}
                                {!! Form::text('activityDescription', null,
                                    ['class' => 'form-control',
                                    'placeholder'=>'Descrição da Atividade']) !!}
                            </div>
                            <div class="col-md-12"></div>
                            <div class="col-md-3 pull-right">
                                <a id="addExercise" class="form-control btn btn-default">Adicionar Questão</a>
                            </div>
                        </div>
                        <div id="createdExercises">
                            
                        </div>
                        <div class="col-md-3">
                            <a class="form-control btn btn-primary" id="addActivityBtn">Criar Atividade</a>
                        </div>
                        <div class="col-md-12" id="exercisesAlerts"></div>
                    </div>
                </section>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <a class="form-control btn btn-primary" id="addModule">Criar Módulo</a>
                </div>
                <div class="col-md-12" id="modulesAlerts"></div>
            </div>
        </div>

    {!! Form::close() !!}
</div>
<div id="confirm" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary" id="moveConfirm">Adicionar</button>
                <button type="button" data-dismiss="modal" class="btn">Cancelar</button>
            </div>
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
</script>
@include("blade_scripts.createJS")
@include("blade_scripts.createJSaddCardModule")
@endsection
