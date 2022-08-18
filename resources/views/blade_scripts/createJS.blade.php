<script type="text/javascript">

	//levenshtein distance
	$(function() {
	    function reposition() {
	        var modal = $(this),
	            dialog = modal.find('.modal-dialog');
	        modal.css('display', 'block');
	        var top = $(document).scrollTop();
	        dialog.css("margin-top", Math.max(0, top+15));
	    }
	    // Reposition when a modal is shown
	    $('.modal').on('show.bs.modal', reposition);
	    // Reposition when the window is resized
	    $(window).on('resize', function() {
	        $('.modal:visible').each(reposition);
	    });
	});
	$(function(){
		$("#usedActivitiesCards").sortable({
			items: "> .libraryCard",
			start: function(e, ui){
				ui.item.addClass('noclick');
			}
		});
		$("#usedModulesCards").sortable({
			items: "> .libraryCard",
			start: function(e, ui){
				ui.item.addClass('noclick');
			}
		});
	})
	$(".addableCard").click(function(e){
		if ($(this).hasClass('noclick')) {
        	$(this).removeClass('noclick');
	    }
	    else {
			e.preventDefault();
			var card = $(this);
			addModalContent(card);
			if (card.parent().prop("id") == "searchActivitiesCards" || card.parent().prop("id") == "searchModulesCards"){
				$("#moveConfirm").html('Adicionar');
			} else {
				$("#moveConfirm").html('Remover');
			}
			$('#confirm').modal({ backdrop: 'static', keyboard: false })
			.one('click', '#moveConfirm', function() {
				moveCard(card);
			});
		}
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

    function moveCard(card, hide){
    	hide = typeof hide !== 'undefined' ? hide : false;
    	var parent = card.parent();
    	if (parent.prop("id") == "searchActivitiesCards"){
    		$(card).fadeOut("slow", function(){
    			card.detach();
    			$('#usedActivitiesCards').append(card);
    			$("#activitiesCardsWelcome").html("Não se esqueça de ordenar as Atividades as arrastando");
    			if (hide) {
		    		card.hide();
		    	} else {
    				card.show();
    			}
    		});
    	} else if (parent.prop("id") == "usedActivitiesCards") {
    		$(card).fadeOut("slow", function(){
    			card.detach();
    			$('#searchActivitiesCards').append(card);
    			if ($("#usedActivitiesCards").children().length == 0) {
		    		$("#modulesCardsWelcome").html("As atividades desse novo módulo aparecerão aqui");
		    	};
    			if (hide) {
		    		card.hide();
		    	} else {
    				card.show();
    			}
    		});
    	} else if (parent.prop("id") == "searchModulesCards") {
    		$(card).fadeOut("slow", function(){
    			card.detach();
    			$("#modulesCardsWelcome").html("Não se esqueça de ordenar os Módulos os arrastando");
    			$('#usedModulesCards').append(card);
    			if (hide) {
		    		card.hide();
		    	} else {
    				card.show();
    			}
    		});
    	} else if (parent.prop("id") == "usedModulesCards") {
    		$(card).fadeOut("slow", function(){
    			//card.detach();
    			$('#searchModulesCards').append(card);
    			if ($("#usedModulesCards").children().length == 0) {
		    		$("#modulesCardsWelcome").html("Os módulos que você selecionar aparecerão aqui");
		    	};
		    	if (hide) {
		    		card.hide();
		    	} else {
    				card.show();
    			}
    		});
    	}
    }

    function hideCardDelete(){
    	$(".addableCard").each(function(){
    		$(".deleteButton").hide();
    	})
    }

    $(document).ready(function() {
    	hideCardDelete();

    	$("#createdExercises").on("click", ".deleteButton", function(e){
    		var target = $(this);
    		var id = target.parent().parent().parent().parent().prop('id').split('-')[1];
    		target.parent().parent().parent().parent().remove();
    		$("#createdExercises").children().slice(id).each(function(){
    			$(this).find("h4").html("Questão ".concat($(this).prop('id').split('-')[1], "<small><a type='button' class='deleteButton' data-dismiss='modal'><i class='fa fa-trash' aria-hidden='true'></i></a></small>"));
    			$(this).prop('id', "exercise-".concat(parseInt($(this).prop('id').split('-')[1])-1));
    		})
    		$("#addExercise").show();
    	});

    	$("#createdExercises").on("click", "#addAlternative", function(e){
    		var idExercise = $(e.target).parent().parent().prop('id');
    		addAlternative(idExercise);
    	});

    	$(document).on("change", "select.exerciseType", function(e) {
    		var select = $(e.target);
    		var option = select.find(":selected"),
    		exerciseDiv = select.parent().parent();
    		select.parent().parent().find(".pull-right").show();
    		if (option.val() == 1) {
    			select.parent().parent().find(".pull-right").find("a").html('Adicionar Alternativa');
    			exerciseDiv.find("#"+exerciseDiv.prop('id')+"-createdAlternatives").children().each(function(e){
    				$(this).find("h4").html($(this).find("h4").html().replace("Resposta", "Alternativa"));
    				$(this).children().last().show();
    			});
    		} else if (option.val() == 2) {
    			select.parent().parent().find(".pull-right").find("a").html('Adicionar Resposta');
    			exerciseDiv.find("#"+exerciseDiv.prop('id')+"-createdAlternatives").children().each(function(e){
    				$(this).find("h4").html($(this).find("h4").html().replace("Alternativa", "Resposta"));
    				$(this).children().last().hide();
    			});
    		}
    	});

    	$(document).on("change", "select.moduleTopic", function(e) {
    		var select = $(e.target);
    		var option = select.find(":selected");

    		if (option.text() == select.children().first().text()) {
    			var granpaId = select.parent().parent().prop('id')
    			if (granpaId == 'createModules') {
    				$("#usedActivitiesCards").children().each(function(){
    					moveCard($(this), true);
    				});
    				$('#searchActivitiesCards').children('.addableCard').each(function () {
    					$(this).show();
    				});
    			} else if (granpaId == 'searchModules') {
    				$('#searchModulesCards').children('.addableCard').each(function () {
    					$(this).show();
    				});
    			}
    		} else {
    			var granpaId = select.parent().parent().prop('id')
    			if (granpaId == 'createModules') {
    				$('#searchActivitiesCards').children('.addableCard').each(function () {
    					if (option.text() == $(this).find(".libraryHeading").children().last().text()) {
    						$(this).show();
    					} else {
    						$(this).hide();
    					}
    				});
    				$("#usedActivitiesCards").children().each(function(){
    					if (option.text() != $(this).find(".libraryHeading").children().last().text()) {
		    				moveCard($(this), true);
		    			}
		    		});
    			} else if (granpaId == 'searchModules') {
    				$('#searchModulesCards').children('.addableCard').each(function () {
    					if (option.text() == $(this).find(".libraryCardInfo").children().last().text()) {
    						$(this).show();
    					} else {
    						$(this).hide();
    					}
    				});
    			}
    		}
    	});
});

$("#addExercise").click(function(e){
	addExercise();
});

function addExercise(){
	var id = $("#createdExercises").children().length;
	$("#createdExercises").append(  "<div class='row' id='exercise-".concat(id, "'>")+
		"<div class='col-sm-12'>"+
		"<h4>Questão ".concat((id+1), "<small><a type='button' class='deleteButton' data-dismiss='modal'><i class='fa fa-trash' aria-hidden='true'></i></a></small></h4>")+
		"</div>"+
		"<div class='form-group col-sm-6'>"+
		"<label for='stem'>Enunciado:</label>"+
		"<input type='text' name='stem' class='form-control'></input>"+
		"</div>"+
		"<div class='form-group col-sm-6'>"+
		"<label for='type'>Tipo:</label>"+
		"<select name='type' class='form-control exerciseType'>"+
		"<option value='1'>Múltipla Escolha</option>"+
		"<option value='2'>Escrita</option>"+
		"</select>"+
		"</div>"+
		"<div class='col-sm-12'>"+
		"<label>Você pode adicionar uma imagem a essa questão</label>"+
		"</div>"+
		"<div class='form-group col-sm-12'>"+
		"<div class='input-group'>"+
		"<label class='input-group-btn'>"+
		"<span class='btn btn-primary'>"+
		"Procurar Imagem <input type='file' name='file-".concat(id, "' accept='.jpeg,.png,.jpg' style='display: none; data'>")+
		"</span>"+
		"</label>"+
		"<input class='form-control' type='text' readonly='' placeholder='Nenhuma imagem selecionada'>"+
		"</div>"+
		"</div>"+
		"<div class='form-group col-sm-12'>"+
		"<label for='image_alt'>Texto da imagem</label>"+
		"<input type='text' name='image_alt' class='form-control' placeholder='Adicione um texto que será pronunciado quando a criança passar o mouse sobre a imagem'></input>"+
		"</div>"+
		"<div class='form-group col-md-3 pull-right'>"+
		"<a id='addAlternative' class='form-control btn btn-default'>Adicionar Alternativa</a>"+
		"</div>"+
		"<div class='col-md-1- col-md-offset-1' id='exercise-".concat(id, "-createdAlternatives'></div>")+
		"</div>");
	if (id == 9) {
		$("#addExercise").hide();
	}
}

$(document).on('change', ':file', function() {
	$("#exercisesAlerts").empty();
	var input = $(this),
		file = this.files[0],
		type = file.type;
	var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	if (type == "image/jpg" || type == "image/jpeg" || type == "image/png") {
		var textInput = input.parent().parent().parent().children().eq(1);
		var value = label;
		textInput.val(value);
	} else {
		input.val('');
		$("#exercisesAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> Um dos seus arquivos é de um formato não permitido</div></div>");
	}
	if (file.size > 1048576) {
		$("#exercisesAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> O tamanho da imagem é muito grande</div></div>");
	}
});

function addAlternative(idExercise){
	var x = idExercise,
	parentId = "#".concat(idExercise,"-createdAlternatives"),
	numAlternatives = $(parentId).children().length;
	var exerciseType = $(parentId).parent().find('select.exerciseType').find('option:selected').val();
	if(exerciseType == 1 && numAlternatives < 4){
		$(parentId).append(  "<div class='row' id='".concat(idExercise, "-alternative-", numAlternatives, "'>")+
			"<div class='col-sm-12'>"+
			"<h4>Alternativa ".concat((numAlternatives+1), "<small><a type='button' class='deleteButton' data-dismiss='modal'><i class='fa fa-trash' aria-hidden='true'></i></a></small></h4>")+
			"</div>"+
			"<div class='form-group col-sm-6'>"+
			"<label for='stem'>Texto:</label>"+
			"<input type='text' name='text' class='form-control'></input>"+
			"</div>"+
			"<div class='form-group col-sm-6'>"+
			"<label>"+
			"<input type='checkbox' name='right'> Esta alternativa é correta?"+
			"</label>"+
			"</div>"+
			"</div>");
	} else if (exerciseType == 2) {
		$(parentId).append(  "<div class='row' id='".concat(idExercise, "-alternative-", numAlternatives, "'>")+
			"<div class='col-sm-12'>"+
			"<h4>Resposta ".concat((numAlternatives+1), "<small><a type='button' class='deleteButton' data-dismiss='modal'><i class='fa fa-trash' aria-hidden='true'></i></a></small></h4>")+
			"</div>"+
			"<div class='form-group col-sm-6'>"+
			"<label for='stem'>Texto:</label>"+
			"<input type='text' name='text' class='form-control'></input>"+
			"</div>"+
			"<div class='form-group col-sm-6' hidden=true>"+
			"<label>"+
			"<input type='checkbox' name='right'> Esta alternativa é correta?"+
			"</label>"+
			"</div>"+
			"</div>");
	}
}

$("#addModule").click(function(e){
	var activitiesDiv = $("#usedActivitiesCards");
	if(countAlertsModule() == 0){
		$("#addModule").html("<i class='fa fa-spinner fa-pulse fa-fw'></i><span class='sr-only'>Loading...</span>");
        $("#addModule").addClass('disabled');
		var data = {},
			module = {},
			activities = [];
		var nameCreator = "{!! $user->name !!}"; 
		var topic = $("#topic").find("option[value='".concat($("#topic").val(),"']")).text();
		module['name'] = $("#nameModule").val();
		module['description'] = $("#descriptionModule").val();
		module['id_topic'] = $("#topic").val();
		module['id_creator'] = {!! $user->myTeacher->id !!};
		var order = 1;
		activitiesDiv.children().each(function(e){
			var activity = {};
			var id = $(this).prop('id');
			id = id.split('-');
			activity['id'] = id[1];
			activity['order'] = order;
			activities.push(activity);
			order+=1;
		});
		data['module'] = module;
		data['activities'] = activities;

		info = [];
		info['name'] = module['name'];
		info['topic'] = topic;
		info['description'] = module['description'];
		info['nameCreator'] = nameCreator;
		ajaxSend(data, "{!! route('modules.storeAjax') !!}", 2, info);
	}
})

function countAlertsModule(){
	$("#modulesAlerts").empty();
	var count = 0;
	if ($("#nameModule").val() == "") {
		$("#modulesAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> O Módulo precisa de um nome</div></div>");
		count+=1;
	}
	if ($("#descriptionModule").val() == "") {
		$("#modulesAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> O Módulo precisa de uma descrição. O que será ensinado nele?</div></div>");
		count+=1;
	}
	if ($("#topic").val() == "") {
		$("#modulesAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> Selecione um tópico</div></div>");
		count+=1;
	}
	if ($("#usedActivitiesCards").children().length < 3) {
		$("#modulesAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> Um Módulo precisa de no mínimo três Atividades</div></div>");
		count+=1;
	}
	return count;
}

$("#addActivityBtn").click(function(e) {
	var activitiesDiv = $("#createActivities");
	var exercisesDiv = $("#createdExercises");

	if(countAlertsActivity() == 0){
		$("#addActivityBtn").html("<i class='fa fa-spinner fa-pulse fa-fw'></i><span class='sr-only'>Loading...</span>");
        $("#addActivityBtn").addClass('disabled');
		var data = {},
			activity = {},
			exercises = [];

		var topic = $("#topic").find("option[value='".concat($("#topic").val(),"']")).text();
		var name = "{!! $user->name !!}";
		
		activity['description'] = activitiesDiv.eq(0).eq(0).find("input").val();
		activity['id_topic'] = $("#topic").val();
		activity['id_creator'] = {!! $user->myTeacher->id !!};

		exercisesDiv.children().each(function(e) {
			var exercise = {};
			exercise['stem'] = $(this).children().eq(1).find("input").val();
			exercise['type'] = $(this).children().eq(2).find("select").val();
			exercise['image_alt'] = $(this).children().eq(5).find("input").val();
			exercise['id_activity'] = 0;
			var file = $(this).children().eq(4).find(":file").get(0).files[0];
			var alternatives = [];
			var alternativesDiv = $("#".concat($(this).prop('id'), "-createdAlternatives"));
			$(alternativesDiv).children().each(function(e){
				var alternative = {};
				alternative['text'] = $(this).children().eq(1).find("input").val();
				alternative['right'] = $(this).children().eq(2).find("input").is(":checked");
				alternative['id_exercise'] = 0;
				alternatives.push(alternative);
			});
			exercise['alternatives'] = alternatives;
			exercises.push(exercise);
		});
		data["activity"] = activity;
		data["exercises"] = exercises;

		info = [];
		info['topic'] = topic;
		info['description'] = activity['description'];
		info['nameCreator'] = name;
		ajaxSend(data, "{!! route('activities.storeAjax') !!}", 3, info);
	}
});

function countAlertsActivity(){
	$("#exercisesAlerts").empty();
	var exercisesDiv = $("#createdExercises");
	var count = 0;
	if ($("#activityDescription").val() == "") {
		$("#exercisesAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> A Atividade precisa de uma descrição</div></div>");
		count+=1;
	};
	exercisesDiv.children().each(function(e) {
		if ($(this).find("select").find(":selected").val() == 1 ) {
			var exerciseDOMId = $(this).prop('id');
			var countCheckedAlternatives = 0;
			var alternativesDiv = $("#".concat(exerciseDOMId, "-createdAlternatives"));
			var exerciseId = $(this).prop('id').split("-");
			exerciseId = parseInt(exerciseId[1])+1;
			if (alternativesDiv.children().length < 2){
				$("#exercisesAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> Questão ".concat(exerciseId, " não pode ter menos de duas alternativas</div></div>"));
				count+=1;
			}
			alternativesDiv.children().each(function(f){
				if ($(this).find("input:checkbox").prop('checked')){
					countCheckedAlternatives+=1;
				}
			});
			if (countCheckedAlternatives == 0) {
				$("#exercisesAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> Questão ".concat(exerciseId, " precisa de uma alternativa marcada como correta</div></div>"));
				count+=1;
			}
			alternativesDiv.children().each(function(f){
				if ($(this).children().eq(1).find("input").val() == ""){
					var alternativeId = $(this).prop('id').split("-");
					alternativeId = parseInt(alternativeId[3]+1);
					$("#exercisesAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> Alternativa ".concat(alternativeId, " da atividade ", exerciseId, " precisa de um texto"));
					count+=1;
				}
			})
		} else if ($(this).find("select").find(":selected").val() == 2) {
			var exerciseDOMId = $(this).prop('id');
			var alternativesDiv = $("#".concat(exerciseDOMId, "-createdAlternatives"));
			if (alternativesDiv.children().length < 1){
				var exerciseId = $(this).prop('id').split("-");
				exerciseId = parseInt(exerciseId[1])+1;
				$("#exercisesAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> Questão ".concat(exerciseId, " não pode ter menos de duas alternativas</div></div>"));
				count+=1;
			}
			alternativesDiv.children().each(function(e){
				if ($(this).children().eq(1).find("input").val() == ""){
					var alternativeId = $(this).prop('id').split("-");
					alternativeId = parseInt(alternativeId[3]+1);
					$("#exercisesAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> Alternativa ".concat(alternativeId, " precisa de um texto"));
					count+=1;
				}
			})
		}
		if ($(this).children().eq(1).find("input").val() == ""){
			$("#exercisesAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> Questão ".concat(exerciseId, " precisa de um enunciado</div></div>"));
			count+=1;
		}
	});
	if(exercisesDiv.children().length < 5){
		$("#exercisesAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> Sua Atividade precisa de no mínimo 5 Questãos</div></div>");
		count+=1;
	}
	if ($("#topic").val() == "") {
		$("#exercisesAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> Selecione um tópico para o Módulo para criar Atividades</div></div>");
		count+=1;
	};
	return count;
}


function createActivityCard(topicName, description, creatorName, id){
	$("#usedActivitiesCards").append("<div class='card libraryCard col-md-3' id='activity-".concat(id, "'>")+
		"<div class='libraryHeading libraryActivities'>"+
		"<p>".concat(topicName , "</p>")+
		"</div>"+
		"<div class='libraryBody'>"+
		"<div class='libraryCardInfo'>"+
		"<p>".concat(description ,"</p>")+
		"<p>"+
		"Usada em 0 módulos"+
		"</p>"+
		"</div>"+
		"<div class='pull-left'>"+
		"<a class='deleteButton' href=''><i class='fa fa-trash' aria-hidden='true'></i></a>"+
		"</div>"+
		"<div class='libraryCardCreator pull-right'>"+
		"<p>Criada por <a href=''>".concat(creatorName ,"</a></p>")+
		"</div>"+
		"</div>"+
		"</div>");
	hideCardDelete();
}

//table 1 means a Adventure is being created, 2 means a module and 3 means a activity
function ajaxSend(data, url, table, info){
	data = JSON.stringify(data);
	var dataImg = {}
	var result;
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}
	});
    var type = "POST"; //for creating new resource
    $.ajax({
       	type: type,
        url: url,
        data: {data},
        success: function (response) {
        	info['id'] = response;
        	if (table == 1) {
        		window.location.replace("{{ url('/library') }}");
        	} else if (table == 2) {
        		$("#addModule").html('Criar Atividade');
				$("#addModule").removeClass('disabled');
        		postCreationModule(info);
        	} else if (table == 3) {
        		sendImage(response, info);
        	}
        },
        error: function (response) {
        	var errors = response.responseJSON;
        	console.log(errors);
        	window.location.replace("{{ url('/library') }}");
        }
    });
}

function sendImage(idActivity, info){
	var i = 0;
	var imageIndexes = [];
	$("#createdExercises").children().each(function(){
		if ($(this).children().eq(4).find("input[type=text]").val() != ""){
			imageIndexes.push($(this).index());
		}
	});
	if (imageIndexes.length == 0) {
		$("#addActivityBtn").html('Criar Atividade');
		$("#addActivityBtn").removeClass('disabled');
		if (window.location.pathname == "/activities/create"){
			window.location.replace("{{ url('/library') }}");
		} else {
			postCreationActivity(info);
		}
	} else {
		var dataImg = {};
		dataImg['idActivity'] = idActivity;
		$("input[type=file]").simpleUpload("{!! route('activities.addImage') !!}", {
			name: 'file',
			allowedExts: ["jpg", "jpeg", "jpe", "png"],
			allowedTypes: ["image/pjpeg", "image/jpeg", "image/png", "image/x-png"],
			start: function(file){
				dataImg['indexExercise'] = imageIndexes[i];
				i+=1;
			},
			data: {dataImg},
			success: function(response){
				$("#addActivityBtn").html('Criar Atividade');
				$("#addActivityBtn").removeClass('disabled');
				if (window.location.pathname == "/activities/create"){
					window.location.replace("{{ url('/library') }}");
				} else {
					postCreationActivity(info);
				}
			},
			error: function(errors){
				console.log(errors);
			}
		});
	}
}
</script>