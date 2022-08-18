@extends('layouts.sidebar')

@section('content')
<div class="panel panel-sam">
    <div class="panel-heading row text-center">
        <h3><strong>Meus Aventureiros</strong></h3>
    </div>
    <div class="panel-body">
        <div class="col-md-6 col-md-offset-3">
            <p></p>
            <div class="input-group input-group-lg">
              <input type="text" class="form-control" id="studentCode" placeholder="Insira o código do aventureiro para adicioná-lo" aria-describedby="sizing-addon1">
              <span class="input-group-btn ">
                <button class="btn btn-default" type="button" id="addStudent"><i class="fa fa-user-plus" aria-hidden="true"></i></button>
              </span>
            </div>
            <div id="classAlerts" class="center-text">
                
            </div>
            <p></p>
        </div>
        @foreach ($user->myTeacher->students as $student)
        <div class="card libraryCard studentCard col-md-3" id="user-{!! $student->user->id !!}">
            <div class="libraryHeading libraryAdventures">
                <h3>{!! $student->user->name !!}</h3>
            </div>
            <div class="libraryBody">
                <p><strong class="blue">{!! $student->user->points !!}</strong> Pontos</p>
                <p>Se aventurando em <strong>{!! $student->adventure->name !!}</strong></p>
                <p>
                    <strong class="blue">{!! $student->num_activities_ended !!}</strong> atividades concluídas
                </p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@include("layouts.scripts")
<script type="text/javascript">
    $("#profile").removeClass("active");
    $("#adventure").removeClass("active");
    $("#library").removeClass("active");
    $("#classroom").addClass("active");
    $("#achievements").removeClass("active");
    $("#settings").removeClass("active");
    $("#contact").removeClass("active");

    $('#navbarHome').click(function(e){
        window.location="{!! url('/home') !!}";
    });

    $("#addStudent").click(function(e){
        $("#classAlerts").empty();
        var studentCode = $("#studentCode").val();
        if (studentCode != ""){
            $("#addStudent").addClass("disabled");
            $("#addStudent").html("<i class='fa fa-spinner fa-pulse fa-fw'></i><span class='sr-only'>Loading...</span>");
            studentCode = studentCode.split("-");
            if((studentCode[0] == "#UC") && (studentCode[1] > 0)){
                var data = {};
                data['idStudent'] = studentCode[1];
                data['idTeacher'] = {!! $user->myTeacher->id !!};
                addUser(data);
            }
        } else {
            $("#classAlerts").append("<div class='alert alert-danger' role='alert'>Código inválido</div>");
        }
    });

    function addUser(id){
        data = {};
        data['id'] = id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var type = "POST"; //for creating new resource
        $.ajax({
            type: type,
            url: "{!! route('users.addStudent') !!}",
            data: {data},
            success: function (response) {
                $("#addStudent").html("<i class='fa fa-user-plus' aria-hidden='true'></i>");
                $("#addStudent").removeClass("disabled");
                if (response[0]) {
                    window.location.replace("{{ url('/classroom') }}");
                } else {
                    $("#classAlerts").append("<div class='alert alert-danger' role='alert'>Código inválido</div>");
                }
            },
            error: function (response) {
                var errors = response.responseJSON;
                console.log(errors);
            }
        });
    }  

    $(".libraryCard").click(function(e){
        var id = $(this).prop('id');
        id = id.split('-');
        route = "{!! url('users/id') !!}";
        route = route.replace("id", id[1]);
        window.location.replace(route);
    });

</script>
@endsection