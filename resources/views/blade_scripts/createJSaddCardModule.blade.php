<script type="text/javascript">
	//isModule = 0 means isActivity
    function generateModalContent(set, isModule) {
    	if (isModule){
    		$("#confirm").find(".modal-header").append("<div'><h3>".concat(set.name, "<small class='star'> ", createStarsString(set.rating), "</small></h4></div>"));
    	} else {
    		$("#confirm").find(".modal-header").append("<div'><h3>".concat(set.topic.name, "<small class='star'> ", createStarsString(set.rating), "</h4></div>"));
    	}
    	$("#confirm").find(".modal-body").append("<div><p>Descrição: ".concat(set.description,"</p></div>"));
    	var subset;
    	var stringH3;
    	if (isModule){
    		var subset = {!! json_encode($activities) !!};
    		stringH3 = "Atividades desse Módulo";
    	} else {
    		var subset = {!! json_encode($exercises) !!};
    		$("#confirm").find(".modal-body").append("<div><p>Estória: ".concat(set.story,"</p></div>"));
    		stringH3 = "Exercícios dessa atividade";
    	}
    	
    	$("#confirm").find(".modal-body").append("<div class='row'><div><h3>".concat(stringH3, "</h3></div>"));
    	for (var j = 0; j < subset.length; j++) {
    		if (subset[j].id_activity !== undefined && set.id == subset[j].id_activity) {
    			var type = 
    			(subset[j].type == 1) ? "Múltipla escolha" : ((subset[j].type == 2) ? "Escrita" : "Agrupar");
    			$("#confirm").find(".modal-body").append("<blockquote><p>".concat(subset[j].stem, "</p><footer>", type, "</footer></blockquote>"));

    		} else if (subset[j] !== undefined) {
    			if (subset[j].id_module == set.id) {
    				$("#confirm").find(".modal-body").append("<blockquote><p>".concat(subset[j].topic.name, "  ", createStarsString(subset[j].rating), "</p><footer>", subset[j].description, "</footer><footer> Criado por ", subset[j].creator.user.name, "</footer></blockquote>"));
    			};

    		}
    	};
    	$("#confirm").find(".modal-body").append("<div class='pull-right'><p>Criada por: ".concat(set.creator.user.name,"</p></div></div>"));

    }
	function addModalContent(card){
		var id = card.prop('id').split('-');
		$("#confirm").find(".modal-header").empty();
		$("#confirm").find(".modal-body").empty();
		if (id[0] == 'activity') {
			var activities = {!! json_encode($activities) !!};
			var activity;
			for (var i = 0; i < activities.length; i++) {
				if (activities[i].id == id[1]){
					activity = activities[i];
				}
			}
			generateModalContent(activity, false);
		}
	}

    function postCreationActivity(info) {
        createActivityCard(info['topic'], info['description'], info['nameCreator'], info['id']);
        $("#activityDescription").val("");
        $("#createdExercises").empty();
        $('.nav-tabs a[href="#usedActivities"]').tab('show');
    }

    function postCreationModule() {
        window.location.replace("{{ url('/library') }}");
    }
</script>