@extends('layouts.sidebar')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <h1 class="pull-left">Criar Nova Atividade</h1>
    </div>
</div>

@include('core-templates::common.errors')

<div class="row">
    {!! Form::open() !!}
    <!-- Topic Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('topic', 'Tópico:') !!}
        {!! Form::select('topic', $topics, null, array('class' => 'form-control')) !!}
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
                        <div class="col-md-2 col-xs-4">
                            <a class="form-control btn btn-primary" id="addActivityBtn">Criar Atividade</a>
                        </div>
                        <div class="col-md-3">
                            <a href="{!! route('activities.index') !!}" class="btn btn-default">Cancelar</a>
                        </div>
                        <div class="col-md-12" id="exercisesAlerts"></div>
                    </div>
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

    $('#navbarHome').click(function(e){
        window.location="{!! url('/home') !!}";
    });
</script>
@include("blade_scripts.createJS")
@endsection
