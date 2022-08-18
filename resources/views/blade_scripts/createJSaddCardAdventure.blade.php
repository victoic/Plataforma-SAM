<script type="text/javascript">
    function countAdventureAlerts() {
        $("#adventuresAlerts").empty();
        var count = 0;
        if ($("#name").val() == "") {
            $("#adventuresAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> A Aventura precisa de um nome</div></div>");
            count+=1;
        }
        if ($("#description").val() == "") {
            $("#adventuresAlerts").append("<div class='col-md-12'><div class='alert alert-danger' role='alert'><strong>Opa!</strong> A Aventura precisa de uma descrição. O que será ensinado nele?</div></div>");
            count+=1;
        }
        return count;
    }

    $("#addAdventureBtn").click(function(e){
        var modulesDiv = $("#usedModulesCards");
        if (countAdventureAlerts() == 0) {
            $("#addAdventureBtn").html("<i class='fa fa-spinner fa-pulse fa-fw'></i><span class='sr-only'>Loading...</span>");
            $("#addAdventureBtn").addClass('disabled');
            var data = {},
                adventure = {},
                modules = [];
            adventure['name'] = $("#name").val();
            adventure['description'] = $("#description").val();
            adventure['story'] = $("#message").val();
            adventure['id_creator'] = {!! $user->myTeacher->id !!};
            var order = 1;
            modulesDiv.children().each(function(e){
                var module = {};
                var id = $(this).prop('id');
                id = id.split('-');
                module['id'] = id[1];
                module['order'] = order;
                modules.push(module);
                order+=1;
            });
            data['adventure'] = adventure;
            data['modules'] = modules;

            var idAdventure = ajaxSend(data, "{!! route('adventures.storeAjax') !!}", 1);
        }
    });

	//isModule = 0 means isActivity
    function generateModalContent(set, isModule) {
    	if (isModule){
    		$("#confirm").find(".modal-header").append("<div'><h3>".concat(set.name, "<small class='star'> ", createStarsString(set.rating), "</small></h4></div>"));
    	} else {
    		$("#confirm").find(".modal-header").append("<div'><h3>".concat(set.topic.name, "<small class='star'> ", createStarsString(set.rating), "</h4></div>"));
    	}
    	$("#confirm").find(".modal-body").append("<div><p>Descrição: ".concat(set.description,"</p></div>"));
    	var stringH3;
    	if (isModule){
    		stringH3 = "Atividades desse Módulo";
    	} else {
    		$("#confirm").find(".modal-body").append("<div><p>Estória: ".concat(set.story,"</p></div>"));
    		stringH3 = "Exercícios dessa atividade";
    	}
    	
        $("#confirm").find(".modal-body").append("<div class='row'><div><h3>".concat(stringH3, "</h3></div>"));
        if (set.exercises !== undefined) {
            for (var i = 0; i < set.exercises.length; i++) {
                var type = 
                    (set.exercises[i].type == 1) ? "Múltipla escolha" : ((set.exercises[i].type == 2) ? "Escrita" : "Agrupar");
                $("#confirm").find(".modal-body").append("<blockquote><p>".concat(set.exercises[i].stem, "</p><footer>", type, "</footer></blockquote>"));
            };
            

        } else if (set.activities !== undefined) {
            for (var i = 0; i < set.activities.length; i++) {
                $("#confirm").find(".modal-body").append("<blockquote><p>".concat(set.topic.name, "  ", createStarsString(set.activities[i].rating), "</p><footer>", set.activities[i].description, "</footer><footer> Criado por ", set.creator.user.name, "</footer></blockquote>"));
            };
                
        }
        $("#confirm").find(".modal-body").append("<div class='pull-right'><p>Criada por: ".concat(set.creator.user.name,"</p></div></div>"));
    }

	function addModalContent(card){
		var id = card.prop('id').split('-');
		$("#confirm").find(".modal-header").empty();
		$("#confirm").find(".modal-body").empty();
		if(id[0] == 'module') {
			var modules = {!! json_encode($modules) !!};
			var module;
			for (var i = 0; i < modules.length; i++) {
				if (modules[i].id == id[1]){
					module = modules[i];
				}
			}
			generateModalContent(module, true);

		} else if (id[0] == 'activity') {
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

    function postCreationModule(info) {
        createModuleCard(info['name'], info['topic'], info['description'], info['nameCreator'], info['id']);
        $("#nameModule").val("");
        $("#descriptionModule").val("");
        $("#usedActivities").children().find(".addableCard").each(function(e){
            moveCard($(this));
        });
        $('.nav-tabs a[href="#usedModules"]').tab('show');
    }

    function createModuleCard(name, topicName, description, nameCreator, id){
    $("#usedModulesCards").append("<div class='card libraryCard col-md-3' id='activity-".concat(id, "'>")+
        "<div class='libraryHeading libraryActivities'>"+
        "<p>".concat(name , "</p>")+
        "</div>"+
        "<div class='libraryBody'>"+
        "<div class='libraryCardInfo'>"+
        "<p>".concat(description ,"</p>")+
        "<p>"+
        "Usada em 0 aventuras"+
        "</p>"+
        "<p>".concat(topicName)+
        "</p>"+
        "</div>"+
        "<div class='pull-left'>"+
        "<a class='deleteButton' href=''><i class='fa fa-trash' aria-hidden='true'></i></a>"+
        "</div>"+
        "<div class='libraryCardCreator pull-right'>"+
        "<p>Criada por <a href=''>".concat(nameCreator ,"</a></p>")+
        "</div>"+
        "</div>"+
        "</div>");
    hideCardDelete();
}
</script>