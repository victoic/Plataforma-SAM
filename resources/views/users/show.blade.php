@extends('layouts.sidebar')

@section('content')
@include('users.profile')


@include("layouts.scripts")
<script type="text/javascript">
	$("#profile").addClass("active");
	$("#adventure").removeClass("active");
	$("#library").removeClass("active");
	$("#achievements").removeClass("active");
	$("#settings").removeClass("active");
	$("#contact").removeClass("active");

	$('#navbarHome').click(function(e){
        window.location="{!! url('/home') !!}";
    });

	$(".unlockedAchievement").click(function(e){
		window.location.replace("{{ url('/achievements') }}");
	});
</script>
@endsection
