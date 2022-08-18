@extends('layouts.sidebar')
@section('content')
<h3>Classes</h3>
<div class="panel-body" id="achievements">
    @foreach($achievements as $achievement)
    @if ($achievement->id != 26)
    <div class="col-md-3 card libraryCard" id="achievement-{!! $achievement->id !!}" >
        @include('cards.achievementCard')
    </div>
    @endif
    @endforeach
</div>
<div id="dialog-confirm" hidden="true" title="Confirmação">
  <p>Deseja trocar de classe?</p>
</div>
@include('layouts.scripts')
<script type="text/javascript">
    $("#profile").removeClass("active");
    $("#adventure").removeClass("active");
    $("#library").removeClass("active");
    $("#classroom").removeClass("active");
    $("#achievements").addClass("active");
    $("#settings").removeClass("active");
    $("#contact").removeClass("active");

    $('#navbarHome').click(function(e){
        window.location="{!! url('/home') !!}";
    });
    
    var userAchievements = {!! $userAchievements !!};
    var achievements = {!! $achievements !!};
    var activeAchievement = {!! $user->activeAchievement->id !!};
    $(document).ready(function(e){
        $(".libraryCard").each(function(){
            var card = $(this)
            var id = $(this).prop('id');
            id = id.split('-');
            var userHas = false;
            for (var i = 0; i < userAchievements.length; i++) {
                if (userAchievements[i].id == id[1]) {
                    userHas = true;
                }
                
            }
            if (id[1] == activeAchievement) {
                card.addClass("activeAchievement");
            }
            if(userHas){
                card.addClass("unlockedAchievement");
            } else {
                card.addClass("lockedAchievement");
                card.find("img").addClass("lockedImg");
            }
        });

        $(".unlockedAchievement").click(function(){
            var newActive = $(this);
            var id = $(this).prop('id');
            id = id.split('-');
            id = id[1];
            if (id != activeAchievement){
                var type = "POST";
                var url  = "{!! url('user/changeActiveAchievement') !!}";
                $($.find("div.activeAchievement")[0]).removeClass("activeAchievement")
                newActive.addClass("activeAchievement");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: type,
                    url: url,
                    data: {'id': id},
                    error: function (response) {
                        var errors = response.responseJSON;
                        console.log(errors);
                    }
                });
                activeAchievement = id;
            }
        });
    });
</script>
@endsection