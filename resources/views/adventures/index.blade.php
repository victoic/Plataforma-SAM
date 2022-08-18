@extends('layouts.sidebar')

@section('content')
<div class="panel panel-sam">
    <div class="panel-heading row text-center">
        <h3><strong>Aventuras</strong></h3>
    </div>
    <div id="adventureCards" class="panel-body">
        @foreach ($adventures as $adventure)
        	@include('cards.adventureCard')
        @endforeach
    </div>
</div>
<!-- Modal -->
<div id="adventureModal" class="modal fade" role="dialog">
	<div hidden="true" id="idAdventure"></div>
  	<div class="modal-dialog">
	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>
	      <div class="modal-body">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
</div>
@include('layouts.scripts')
<script type="text/javascript">
	var adventures = {!! $adventures !!};
	
	$('#navbarHome').click(function(e){
        window.location="{!! url('/home') !!}";
    });

	$(document).ready(function(e){
		$("#adventureCards").find(".deleteButton").remove();
	});

	$(".libraryCard").click(function(e){
		var adventure = undefined;
		var id = $(this).prop('id').split('-');
		id = id[1];

		for (var i = 0; i < adventures.length; i++) {
			if (adventures[i].id == id){
				adventure = adventures[i];
				break;
			}
		}
		if (adventure != undefined) {
			$("#adventureModal").find(".modal-header").empty();
			$("#adventureModal").find(".modal-body").empty();
			$("#adventureModal").find(".modal-footer").empty();
			$("#idAdventure").html(adventure.id);
			$("#adventureModal").find(".modal-header").append("<div'><h3>".concat(adventure.name, "<small class='star'> ", createStarsString(adventure.rating), "</small></h4></div>"));
			$("#adventureModal").find(".modal-body").append("<div><p>Descrição: ".concat(adventure.description,"</p></div><div><h3>Módulos dessa Aventura</h3></div>"));
			if (adventure.modules !== undefined) {
				var string = "<div id='modules' role='tablist' aria-multiselectable='true'>";
				for (var i = 0; i < adventure.modules.length; i++) {
					var module = adventure.modules[i];
					string+="<div class='panel'>"+
								"<div role='tab' id='headingModule-"+module.id+"'>"+
									"<h4>"+
										"<a data-toggle='collapse' data-parent='#modules' href='#module-"+module.id+"' aria-expanded='true' aria-controls='#module-"+module.id+"'>"+module.name+"</a>"+
									"</h4>"+
								"</div>"+
							"<div id='module-"+module.id+"' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingModule-"+module.id+"'><div id='module"+module.id+"-activities' role='tablist' aria-multiselectable='true'><p>Atividades desse Módulo</p>";
					for (var j = 0; j < module.activities.length; j++) {
						var activity = module.activities[j]
						string+="<div class='panel'>"+
									"<div role='tab' id='headingModule-"+module.id+"-Activity-"+activity.id+"'>"+
										"<h4>"+
											"<a data-toggle='collapse' data-parent='#module"+module.id+"-activities' href='#module-"+module.id+"-Activity-"+activity.id+"' aria-expanded='true' aria-controls='#module-"+module.id+"-Activity-"+activity.id+"'>"+activity.topic.name+"</a>"+
										"</h4>"+
									"</div>"+
									"<div id='module-"+module.id+"-Activity-"+activity.id+"' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingModule-"+module.id+"-Activity-"+activity.id+"'>";
						string+="<p>"+activity.description+"</p>";
						for (var k = 0; k < activity.exercises.length; k++) {
							var exercise = activity.exercises[k];
							var type;
							if (exercise.type == 1) {
								type = "Múltipla Escolha";
							} else if (exercise.type == 2) {
								type = "Escrita";
							}
							string+="<blockquote><p>"+exercise.stem+"</p><footer>"+type+"</footer></blockquote>";
						}
						string+="</div></div>"
					}
					string+="</div></div></div>";
				}
				string+="</div>";
				$("#adventureModal").find(".modal-body").append(string);
				if (adventure.teachers[0] != undefined) {
					$("#adventureModal").find(".modal-footer").append("<i class='fa fa-check blue' aria-hidden='true'></i> Você já possui essa Aventura");
				} else {
					$("#adventureModal").find(".modal-footer").append("<button id='confirmAdd' type='button' class='btn btn-default' data-dismiss='modal'>Adcicionar</button>");
				}
				$("#adventureModal").find(".modal-footer").append("<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>");
			}

			$("#adventureModal").modal();
		}
	});

	$("#adventureModal").on("click", "#confirmAdd", function(e){
		route = "{!! route('users.addAdventureToLibrary') !!}";
		var data = {};
		data['idAdventure'] = $("#idAdventure").html();
		$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
		$.ajax({
	       	type: "POST",
	        url: route,
	        data: data,
	        success: function (response) {
	        	window.location.replace("{!! route('adventures.index') !!}");
	        },
	        error: function (response) {
	        	var errors = response.responseJSON;
	        	console.log(errors);
	        	window.location.replace("{!! url('/library') !!}");
	        }
    	});
	});

	function createStarsString (rating) {
		var fullStars = Math.floor(rating);
		var halfStar = 0;
		if (rating - fullStars >= 0.7){
			fullStars+=1;
		} else if (rating - fullStars > 0.3){
			halfStar = 1;
		}
		var stars = "";
		for (var j = 1; j <= 5; j++) {
			if (fullStars >= j){
				stars = stars.concat("<i class='fa fa-star' aria-hidden='true'></i>");
			} else if (halfStar > 0) {
				stars = stars.concat("<i class='fa fa-star-half-o' aria-hidden='true'></i>");
			} else {
				stars = stars.concat("<i class='fa fa-star-o' aria-hidden='true'></i>");
			}
		}
		return stars;
	}
</script>
@endsection

