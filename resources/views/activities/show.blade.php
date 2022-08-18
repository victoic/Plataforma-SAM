@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<h2>{!! $activity->topic->name !!}</h2>
		<div class="col-md-3 col-md-offset-3 col-xs-6 text-center battleDiv">
			<p>{!! $user->name !!}</p>
			<span id="lives"></span>
			@if (!empty($user->activeAchievement))
			<p id="userAvatar">
				<img src="{!! url('/').'/images/achievements/'.$user->activeAchievement->icon !!}" class="img-fluid" alt="{!! $user->name !!}">
			</p>
			@endif
		</div>
		<div class="col-md-3 col-xs-6 text-center battleDiv">
			<p>{!! $monster->name !!}</p>
			<span id="enemyLives"></span>
			<p id="enemyAvatar">
				<img src="{!! url('/').'/images/monsters/'.$monster->icon !!}" height="60px" class="img-fluid" alt="{!! $monster->name !!}">
			</p>
		</div>
	</div>
	<div id="exercises">
		@foreach ($activity->exercises as $exercise)
		<div class="well-lg" id='exercise-{!! $exercise->id !!}'>
			<div class="row text-center">
				<div class="col-md-12">
					<h3 class="stem">{!! $exercise->stem!!} <small><i class="fa fa-volume-up" aria-hidden="true"></i></small></h3>
				</div>
				@if (!empty($exercise->image1))
				<div class="col-md-12">
					<img src="{!! url('/').'/images/exercises/'.$exercise->image1 !!}" class="img-fluid" height="200px" alt="{!! $exercise->image1_alt !!}"> 
				</div>
				@endif
			</div>				
			<div class="row">
				@if ($exercise->type == 1)
				@include('activities.types.choices')
				@elseif ($exercise->type == 2)
				@include('activities.types.type')
				@endif
			</div>
		</div>
		@endforeach

	</div>
	<div class="form-group">
		<a href="{!! url('home') !!}" class="btn btn-default btn-lg">Recuar</a>
		<a class="btn btn-default btn-lg pull-right disabled" id="submit"><i class="fa fa-gavel" aria-hidden="true"></i><strong> Atacar!</strong></a>
	</div>
</div>

<!-- Modal -->
<div id="achievementModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Parabéns!</h4>
			</div>
			<div class="modal-body">

				<div id="points" class="text-center">

				</div>
				<p id="newAchievements">Você desbloqueou novas Cartinhas de Classe:</p>
				<div id="achievementCards" class="col-md-12">

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
			</div>
		</div>

	</div>
</div>
<div id="gameOver" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Parabéns!</h4>
			</div>
			<div class="modal-body">
				<p>Você desbloqueou novas Cartinhas de Classe:</p>
			</div>
			<div id="footerDefeat" class="modal-footer">
				<button id="gameContinue" type="button" class="btn btn-default" data-dismiss="modal">Continuar</button>
				<button id="gameDefeat" type="button" class="btn btn-default" data-dismiss="modal">Recuar</button>
			</div>
			<div id="footerVictory" class="modal-footer">
				<button id="gameVictory" type="button" class="btn btn-default" data-dismiss="modal">Continuar</button>
			</div>
		</div>
	</div>
</div>
@include("layouts.scripts")
<script type="text/javascript">
	var exercisesList = {!! json_encode($activity->exercises) !!};
	var home = "{!! url('home') !!}";
	var imagesAchievements = "{!! url('/') !!}/images/achievements/";
	var route = "{!! route('users.unlockActivity') !!}";
	var routeDefeat = "{!! route('students.setMistakes') !!}";
	var user = {!! auth()->user() !!};
	var idActivity = {!! $activity->id !!};
	var idModule = {!! $idModule !!};
	var achievements = {!! $achievements !!};
	var hit = new Audio("{!! url('/').'/sounds/hit.mp3' !!}");
	var victory = new Audio("{!! url('/').'/sounds/victory.wav' !!}");
	var defeat = new Audio("{!! url('/').'/sounds/defeat.wav' !!}");
	var levelup = new Audio("{!! url('/').'/sounds/levelup.wav' !!}");

	$('#navbarHome').click(function(e){
        window.location="{!! url('/home') !!}";
    });
</script>
{!! Html::script('js/activities.js') !!}
@endsection
