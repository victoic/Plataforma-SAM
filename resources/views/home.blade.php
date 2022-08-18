@extends('layouts.sidebar')

@section('content')
<div class="panel-sam panel">
    <div class="panel-heading row">
        <div class="row">
            {!! Form::select('selectAdventure', $otherAdventures, null, array('class' => 'form-control')) !!}
        </div>
        <div class="col-sm-11 col-sm-offset-1">
            <h3><strong>{!! $adventure->name !!}</strong></h3>
            <p>
                {!! $doneActivities.' de '.$totalActivities.' atividades concluídas' !!}
            </p>
        </div>
    </div>
    <div class="panel-body">
        <div class="col-xs-12">
            <div class="col-xs-4 col-xs-offset-4">
                <h3 class="text-center readable">
                    {!! $user->name !!},
                    <small>
                        <strong>{!! $user->activeAchievement->name !!} nível </strong>
                    </small>
                    <strong class="blue">{!! floor($user->points/10)+1 !!}</strong>
                </h3>
            </div>
            <div class="col-xs-12 text-center">
                <img class="img-fluid" src="{!! url('/').'/images/achievements/'.$user->activeAchievement->icon !!}" height="100px">
            </div>
            <div class="col-xs-12">
                <div class="col-xs-5">
                    <p class="readable">Você tem <strong class="blue">{!! $user->points !!}</strong><strong> Pontos Mágicos!</strong> <br/><span>Continue se aventurando!</span></p>
                    <span class="readable nextLevel"><strong>Só faltam <span class="blue">{!! 10-($user->points%10) !!}</span> Pontos Mágicos para o próximo nível</strong></span>
                </div>
                <div class="col-xs-12">
                    <div class="progress readableBar">
                        <div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="50"
                        aria-valuemin="0" aria-valuemax="100" style="width:{!! (($user->points%10)/10)*100 !!}%">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-4 text-center">          
        @foreach ($adventure->modules as $module)
        <div class="collapsable">
            <button data-toggle="collapse" data-target="#module-{!! $module->id !!}-activities" class="btn btn-info btn-lg">{!! $module->name !!}</button>
            <div id="module-{!! $module->id !!}-activities" class="collapse in">
                @foreach ($module->activities as $iteratedActivity)
                @if ($currentModule->pivot->order > $module->pivot->order)
                <div class="activity completedActivity">
                    <img class="img-fluid" id={!! $iteratedActivity->id !!} src="{!! url('/').'/images/topics/'.$iteratedActivity->topic->name.'.png' !!}" height="70px">
                    <span class="fa-stack fa-lg blue">
                        <i class="fa fa-check-circle fa-stack-2x" aria-hidden="true"></i>
                    </span>
                    <p class="completedActivity activityTopic"> {!! $iteratedActivity->topic->name !!} </p>
                </div>
                @elseif ($currentModule->pivot->order == $module->pivot->order)
                @if ($iteratedActivity->pivot->order > $activity->pivot->order)
                <div class="activity">
                    <p class="lockedActivity">
                        <i class="fa fa-lock fa-5x" aria-hidden="true"></i>
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle-o fa-stack-2x" aria-hidden="true"></i>
                        </span>
                    </p>
                    <p class="activityTopic"> {!! $iteratedActivity->topic->name !!} </p>
                </div>
                @elseif ($iteratedActivity->pivot->order < $activity->pivot->order)
                <div class="activity completedActivity">
                    <img class="img-fluid" id={!! $iteratedActivity->id !!} src="{!! url('/').'/images/topics/'.$iteratedActivity->topic->name.'.png' !!}" height="70px">
                    <span class="fa-stack fa-lg blue">
                        <i class="fa fa-check-circle fa-stack-2x" aria-hidden="true"></i>
                    </span>
                    <p class="completedActivity activityTopic"> {!! $iteratedActivity->topic->name !!} </p>
                </div>
                @else
                <div class="activity unlockedActivity">
                    <img class="img-fluid" id={!! $iteratedActivity->id !!} src="{!! url('/').'/images/topics/'.$iteratedActivity->topic->name.'.png' !!}" height="70px">
                    <span class="fa-stack fa-lg blue">
                        <i class="fa fa-circle-o fa-stack-2x" aria-hidden="true"></i>
                    </span>
                    <p class="unlockedActivity activityTopic"> {!! $iteratedActivity->topic->name !!} </p>
                </div>
                @endif
                @else
                <div class="activity">
                    <p class="lockedActivity">
                        <i class="fa fa-lock fa-5x" aria-hidden="true"></i>
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle-o fa-stack-2x" aria-hidden="true"></i>
                        </span>
                    </p>
                    <p class="activityTopic"> {!! $iteratedActivity->topic->name !!} </p>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endforeach
    </div> -->
    <div id="board" class="col-xs-12 row-eq-height">

    </div>
</div>
</div>
@include("layouts.scripts")
<script type="text/javascript">
    var modules = {!! $adventure->modules !!};
    var currentModule = {!! $currentModule !!};
    var currentActivity = {!! $activity !!};
    var listActivities = [];
    var indexCurrentActivity;
    var windowWidth;
    var rightUp = true, leftUp = true;

    $("#profile").removeClass("active");
    $("#adventure").addClass("active");
    $("#library").removeClass("active");
    $("#classroom").removeClass("active");
    $("#achievements").removeClass("active");
    $("#settings").removeClass("active");
    $("#contact").removeClass("active");

    $('#navbarHome').click(function(e){
        window.location="{!! url('/home') !!}";
    });

    $(document).ready(function(e){
        windowWidth = $(window).width();
        generateBoard();
    });

    function orderList(){
        for (var i = 0; i < modules.length; i++) {
            for (var j = 0; j < modules[i].activities.length; j++) {
                var activity = [];
                activity[0] = i;
                activity[1] = j;
                if (modules[i].id == currentModule.id && modules[i].activities[j].id == currentActivity.id) {
                    activity[2] = true;
                    indexCurrentActivity = listActivities.length;
                } else {
                    activity[2] = false;
                }
                listActivities.push(activity);
            }
        }
    }

    //rightCurve is a curve that comes from the left to the right
    function selectBoardParts(){
        windowWidth = $(window).width();
        $("#board").empty();
        var rowSize = (windowWidth > 992)? 4 : 2; 
        var initIndex = 0, i = 0, asc = true; 
        var endIndex = initIndex + rowSize;
        while(true){
            if (i == listActivities.length) {break;}
            if (rowSize == 4) {
                var divClass, bgImg;
                if (i != 0 && ((i%4 == 0 && asc)||(i%4 == 3 && !asc))) {
                    bgImg = "<img class='boardTile img-responsive' src='{!! url('/').'/images/paths/path3.png' !!}'>";
                    if (rightUp) {
                        divClass = "rightCurveUp";
                    } else {
                        divClass = "rightCurveDown";
                    }
                    rightUp = !rightUp;
                } else if ((i%4 == 0 && !asc)||(i%4 == 3 && asc)) {
                    bgImg = "<img class='boardTile img-responsive' src='{!! url('/').'/images/paths/path3.png' !!}'>";
                    if (leftUp) {
                        divClass = "leftCurveUp";
                    } else {
                        divClass = "leftCurveDown";
                    }
                    leftUp = !leftUp;
                } else {
                    bgImg = "<img class='boardTile img-responsive' height='256px' src='{!! url('/').'/images/paths/path2.png' !!}'>";
                    divClass = "straight";
                }
                drawBoard(i, bgImg, divClass, asc);
            } else {
                if (i != 0 && ((i%2 == 0 && asc) || (i%2 == 1 && !asc))) {
                    bgImg = "<img class='boardTile img-responsive' src='{!! url('/').'/images/paths/path3.png' !!}'>";
                    if (rightUp) {
                        divClass = "rightCurveUp";
                    } else {
                        divClass = "rightCurveDown";
                    }
                    rightUp = !rightUp;
                } else if ((i%2 == 1 && asc) || (i%2 == 0 && !asc)) {
                    bgImg = "<img class='boardTile img-responsive' src='{!! url('/').'/images/paths/path3.png' !!}'>";
                    if (leftUp) {
                        divClass = "leftCurveUp";
                    } else {
                        divClass = "leftCurveDown";
                    }
                    leftUp = !leftUp;
                }
                drawBoard(i, bgImg, divClass, asc);
            }
            i = (asc)? i+1 : i-1;
            if ((i < initIndex && asc == false) || (i == endIndex && asc == true)) {
                asc = !asc;
                initIndex = endIndex;
                endIndex = (initIndex+rowSize > listActivities.length) ? listActivities.length : initIndex + rowSize;
                i = (asc || initIndex == endIndex) ? initIndex : endIndex-1;
            }
        }
    }

    function drawBoard(i, bgImg, divClass, asc){
        if (i == 0){
            bgImg = "<img class='boardTile img-responsive' src='{!! url('/').'/images/paths/path1.png' !!}'>";
            divClass = "start";
        } else if (i == listActivities.length-1) {
            if ((i%4 == 0 && windowWidth > 992) || (i%2 == 0 && windowWidth <= 992)) {
                bgImg = "<img class='boardTile img-responsive' src='{!! url('/').'/images/paths/path4.png' !!}'>";
            } else {
                bgImg = "<img class='boardTile img-responsive' src='{!! url('/').'/images/paths/path1.png' !!}'>";
                divClass = (asc) ? "rightEnd" : "leftEnd";
            }
        } 

        if (i > indexCurrentActivity) {
            if (windowWidth > 992) {
                bgImg+= "<img class='boardCircleLocked img-responsive' height='160px' src='{!! url('/').'/images/paths/circleLocked.png' !!}'>";
            } else {
                bgImg+= "<img class='boardCircleLocked img-responsive' height='80px' src='{!! url('/').'/images/paths/circleLocked.png' !!}'>";
            }
        } else {
            if (windowWidth > 992) {
                bgImg+= "<img class='boardCircle img-responsive' height='160px' src='{!! url('/').'/images/paths/circle.png' !!}'>";

            } else {
                bgImg+= "<img class='boardCircle img-responsive' height='80px' src='{!! url('/').'/images/paths/circle.png' !!}'>";
            }
        }

        if (listActivities[i][2] == true) {
            bgImg+= "<img class='boardPlayer img-responsive text-board-clickable' height='256px' src='{!! url('/').'/images/achievements/'.$user->activeAchievement->icon !!}'>";
        }

        if (i == indexCurrentActivity) {
            bgImg+="<div class='row text-center text-board text-board-clickable'>";
            bgImg+="<p></p>";
        } else {
            if (i < indexCurrentActivity) {
                bgImg+="<div class='row text-center text-board text-board-numbers text-board-clickable'>";
            } else {
                bgImg+="<div class='row text-center text-board text-board-numbers'>";
            }
            bgImg+="<h3 class='unselectable'>"+(i+1)+"</h3>";
        }
        bgImg+="<div class='row col-xs-6 col-xs-offset-3 readable'><p class='unselectable'><strong>"+modules[listActivities[i][0]].activities[listActivities[i][1]].topic.name+"</strong></p></div> </div>";
        $("#board").append("<div id='module-"+modules[listActivities[i][0]].id+"-activity-"+modules[listActivities[i][0]].activities[listActivities[i][1]].id+"' class='col-xs-6 col-md-3 "+divClass+"'> <div class='dummy'> </div>"+bgImg+" </div>");
    }

    function generateBoard(){
        orderList();
        selectBoardParts();
    }

    $( window ).resize(function() {
        if ((windowWidth <= 992 && $(window).width() > 992) || (windowWidth > 992 && $(window).width() <= 992)) {
            rightUp = leftUp = true;
            selectBoardParts();
        }
    });

    $('img').mouseenter(function(e){
        responsiveVoice.speak($(this).parent().find('.activityTopic').text(), "Brazilian Portuguese Female", {rate:1});
    });

    $(document). ready(function(e){
        $(".boardCircle").click(function(e){
            var id = $(this).parent().prop('id').split('-');
            startActivity(id[3], id[1]);
        });
        $(".boarPlayer").click(function(e){
            var id = $(this).parent().prop('id').split('-');
            startActivity(id[3], id[1]);
        });
        $(".text-board-clickable").click(function(e){
            var id = $(this).parent().prop('id').split('-');
            startActivity(id[3], id[1]);
        });
    })
    
    $(document).on("mouseenter", ".readable", function(e){
        responsiveVoice.speak($(this).text(), "Brazilian Portuguese Female", {rate:0.8});
    });
    $('.readableBar').mouseenter(function(e){
        responsiveVoice.speak($(this).parent().find('.nextLevel').first().text(), "Brazilian Portuguese Female", {rate:0.8});
    });

    $('div.unlockedActivity > img').click(function(e){
        var id = e.target.id;
        var idModule = $(this).parent().parent().prop('id');
        idModule = idModule.split('-');
        startActivity(id, idModule[1]);
    });

    $('div.completedActivity > img').click(function(e){
        var id = e.target.id;
        var idModule = $(this).parent().parent().prop('id');
        idModule = idModule.split('-');
        startActivity(id, idModule[1]);
    });

    function startActivity(id, idModule){
        var url = "{!! route('activities.show', [':id', ':idModule']) !!}";
        url = url.replace(':id', id);
        url = url.replace(':idModule', idModule);
        window.location.replace(url);
    }

    $('select[name=selectAdventure]').on('change', function(e){
        var confirmChange = confirm('Tem certeza que quer mudar de aventura?\nMudar de aventura fará você perder todo o progresso na aventura atual.');
        if (confirmChange) {
            var option = $(this).find(":selected");
            var val = option.val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            var type = "POST"; //for creating new resource
            $.ajax({
                type: type,
                url: "{!! route('students.changeAdventure') !!}",
                data: {val},
                success: function (response) {
                    window.location.replace("{{ url('/home') }}");
                },
                error: function (response) {
                    var errors = response.responseJSON;
                    console.log(errors);
                    window.location.replace("{{ url('/home') }}");
                }
            });
        } else {
            window.location.replace("{{ url('/home') }}");
        }
    });
</script>
@endsection
