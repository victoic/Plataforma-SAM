<div class="row">
	<div class="col-md-2 text-xs-center text-center center-block img-profile">
		@if (!empty($user->activeAchievement))
			<img src="{!! url('/').'/images/achievements/'.$user->activeAchievement->icon !!}" height="120px" class="img-fluid">
		@endif
	</div>
	<div class="col-md-10">
		<h2> {!! $user->name !!}
			@if ($user->teacher)
			<small class="star">
				<span class="fa-stack fa-lg">
					<i class="fa fa-circle-thin fa-stack-2x"></i>
					<i class="fa fa-graduation-cap fa-stack-1x"></i>
				</span>
			</small>
			@else
			,
            <small>
                <strong>{!! $user->activeAchievement->name !!} nível </strong>
            </small>
            <strong class="blue">{!! floor($user->points/10)+1 !!}</strong>
			@endif
		</h2>
		<p>
		@if ($user->teacher)
		Mestre de Calabouços desde de <strong class="blue">{!! $user->created_at->format('d/m/Y') !!}</strong></p>
		@else
		Aventureiro desde de <strong class="blue">{!! $user->created_at->format('d/m/Y') !!}</strong></p>
		<p><strong class="blue">{!! number_format($user->active_time/3600, 0) !!} horas</strong> se aventurando</p>
		@endif
		
	</div>
	@if (!($user->teacher))
	<div class="col-md-10">
		<p>Tem <strong class="blue">{!! $user->points !!}</strong><strong> Pontos Mágicos</strong></p>
	</div>
	<div class="col-md-3 col-md-offset-2">
		<strong>
		<p>Se aventurando atualmente em:</p>
		<p>No Módulo: </p>
		<p>Estudando: </p>
		</strong>
	</div>
	<div class="col-md-6">
		<p><strong>{!! $user->myStudent->adventure->name !!}</strong></p>
		<p><strong>{!! $user->myStudent->module->name !!}</strong></p>
		<p><strong>{!! $user->myStudent->activity->topic->name !!}</strong></strong></p>
	</div>
	@if (isset($user->myStudent->activitiesDone[0]))
	<div class="col-md-3 col-md-offset-2">
		<p>Minhas maiores dificuldades são:</p>
	</div>
	<div class="col-md-6">
		<p>o módulo <strong>{!! $user->myStudent->modulesDone[0]->name !!}</strong> e</p>
		<p> a atividade sobre <strong>{!! $user->myStudent->activitiesDone[0]->topic->name.':' !!}</strong> {!! $user->myStudent->activitiesDone[0]->description !!}</p>
	</div>
	<div class="col-md-6 col-md-offset-2 text-center">
		<p>Devíamos trabalhar nisso.</p>
	</div>
	@endif
	<div class="col-md-6 col-md-offset-2 well text-center usercode">
		@if (!empty($user->myStudent->teacher))
		<p>Meu professor se chama <strong>{!! $user->myStudent->teacher->user->name !!}</strong></p>
		@else
		<p>Sou seu aluno? Me adicione à sua turma com este código:</p>
		<p><strong>#UC-{!! $user->myStudent->id !!}</strong></p>
		@endif
	</div>
	@else
	<div class="col-md-3 col-md-offset-2">
		<p>Alunos:</p>
	</div>
	<div class="col-md-6">
		<p><strong>{!! count($user->myStudents) !!}</strong></p>
	</div>
	@endif
	@if ($user->teacher)
	<div class="col-md-12">
		<h3>Minhas Aventuras</h3>
		@if (!empty($user->myTeacher->createdAdventures))
		@foreach ($user->myTeacher->createdAdventures as $adventure)
			@include('cards.adventureCard')
		@endforeach
		@endif
	</div>
	<div class="col-md-12">
		<h3>Meus Módulos</h3>
		@if (!empty($user->myTeacher->createdModules))
		@foreach ($user->myTeacher->createdModules as $module)
			<div class="card libraryCard col-md-3">
			@include('cards.moduleCard')
			</div>
		@endforeach
		@endif
	</div>
	<div class="col-md-12">
		<h3>Minhas Atividades</h3>
		@if (!empty($user->myTeacher->createdActivities))
		@foreach ($user->myTeacher->createdActivities as $activity)
			<div class="card libraryCard col-md-3">
			@include('cards.activityCard')
			</div>
		@endforeach
		@endif
	</div>
	@else
	<div class="col-md-12">
		<h3>Classes Desbloqueadas</h3>
		@if (!empty($user->achievements))
		@foreach ($user->achievements as $achievement)
			<div class="col-md-3 card libraryCard unlockedAchievement" id="achievement-{!! $achievement->id !!}" >
            @include('cards.achievementCard')
        	</div>
		@endforeach
		@endif
	</div>
	@endif
</div>