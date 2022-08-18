var mistakes = 0,
livesTotal = 5,
lives = 5,
acertos = 0;
var timeStart = 0,
timeFinish = 0,
isSpeaking = false;
$('input').click(function (e){
 $('#submit').removeClass('disabled');
 $('#submit').removeClass('btn-default');
 $('#submit').addClass('btn-proceed');
});
window.scrollTo(0,document.body.scrollHeight);
// Demaru-levensthein Distance
var levDist = function(s, t) {
  var d = []; //2d matrix
  // Step 1
  var n = s.length;
  var m = t.length;
  if (n == 0) return m;
  if (m == 0) return n;
  //Create an array of arrays in javascript (a descending loop is quicker)
  for (var i = n; i >= 0; i--) d[i] = [];
  // Step 2
for (var i = n; i >= 0; i--) d[i][0] = i;
  for (var j = m; j >= 0; j--) d[0][j] = j;
  // Step 3
for (var i = 1; i <= n; i++) {
  var s_i = s.charAt(i - 1);
      // Step 4
      for (var j = 1; j <= m; j++) {
          //Check the jagged ld total so far
          if (i == j && d[i][j] > 4) return n;
          var t_j = t.charAt(j - 1);
          var cost = (s_i == t_j) ? 0 : 1; // Step 5
          //Calculate the minimum
          var mi = d[i - 1][j] + 1;
          var b = d[i][j - 1] + 1;
          var c = d[i - 1][j - 1] + cost;
          if (b < mi) mi = b;
          if (c < mi) mi = c;
          d[i][j] = mi; // Step 6
          //Damerau transposition
          if (i > 2 && j > 2 && s_i == t.charAt(j - 2) && s.charAt(i - 2) == t_j) {
            d[i][j] = Math.min(d[i][j], d[i - 2][j - 2] + cost);
          }
        }
      }
  // Step 7
  return d[n][m];
}
      function drawHearts(){
       $('#lives').empty();
       for (var i = 0; i < livesTotal; i++) {
        if (i<lives){
         $('#lives').append('<i class="fa fa-heart" aria-hidden="true"></i>');
       } else {
         $('#lives').append('<i class="fa fa-heart-o" aria-hidden="true"></i>');

       }
     };
   }

   function resetIsSpeaking(){
    isSpeaking = false;
  }

  $("h3.stem").mouseenter(function(e){
    if (!isSpeaking) {
      isSpeaking = true;
      responsiveVoice.speak($(this).text(), "Brazilian Portuguese Female", {rate:0.8, onend: resetIsSpeaking});
    }
  });
  $("h3.stem").click(function(e){
    if (!isSpeaking) {
      responsiveVoice.speak($(this).text(), "Brazilian Portuguese Female", {rate:0.8, onend: resetIsSpeaking});
    }
  });
  $("small").mouseenter(function(e){
    if (!isSpeaking) {
      isSpeaking = true;
      responsiveVoice.speak($(this).parent().text(), "Brazilian Portuguese Female", {rate:0.8, onend: resetIsSpeaking});
    }
  });
  $("small").mouseenter(function(e){
    if (!isSpeaking) {
      responsiveVoice.speak($(this).parent().text(), "Brazilian Portuguese Female", {rate:0.8, onend: resetIsSpeaking});
    }
  });
  $('img').click(function(e){
    if (!isSpeaking) {
      isSpeaking = true;
      responsiveVoice.speak($(this).prop('alt'), "Brazilian Portuguese Female", {rate:0.8, onend: resetIsSpeaking});
    }
  });
  $("label").click(function(e){
    if (!isSpeaking) {
      isSpeaking = true;
      responsiveVoice.speak($(this).text(), "Brazilian Portuguese Female", {rate:0.8, onend: resetIsSpeaking});
    }
  });
  $("label").mouseenter(function(e){
    if (!isSpeaking) {
      isSpeaking = true;
      responsiveVoice.speak($(this).text(), "Brazilian Portuguese Female", {rate:0.8, onend: resetIsSpeaking});
    }
  });

  function drawEnemyHearts(){
   $('#enemyLives').empty();
   for (var i = 0; i < exercisesList.length; i++) {
    if (i >= acertos){
     $('#enemyLives').append('<i class="fa fa-heart" aria-hidden="true"></i>');
   } else {
     $('#enemyLives').append('<i class="fa fa-heart-o" aria-hidden="true"></i>');

   }
 };
}

function nextExercise(){
  $('#submit').addClass('disabled');
  $('#submit').addClass('btn-default');
  $('#submit').removeClass('btn-proceed');
  var exerciseDiv = $("#exercises > .well-lg:visible");
  var index = exerciseDiv.index();
  if (exerciseDiv.index() != $("#exercises").children().length-1) { 
    var nextExercise = $("#exercises").children().eq(index+1);
    exerciseDiv.hide();
    shuffleAlternatives(nextExercise.children().find("ul"));
    nextExercise.show();
    exerciseDiv.detach();
    $("#exercises").append(exerciseDiv);
  } else {
    var nextExercise = exerciseDiv;
    shuffleAlternatives(nextExercise.children().find("ul"));
    exerciseDiv.hide();
    exerciseDiv.show();
  }
}

$(document).ready(function (){
 drawHearts();
 drawEnemyHearts();
 $('#exercises').children('.well-lg').each(function () {
  $(this).hide();
});
 $('#exercise-'+exercisesList[0].id).show();
 timeStart = new Date();
});

function checkType1(idExercise) {
  return $('input[name=alternative]:checked').val() == 1;
}
function checkType2(idExercise) {
  var exercise;
  for (var i = 0; i < exercisesList.length; i++) {
    if (exercisesList[i].id == idExercise) {
      exercise = exercisesList[i];
    }
  };
  var input = $('input[name=input]').val().toLowerCase();
  for (var i=0; i < exercise.alternatives.length; i++) {      
    if(exercise.alternatives[i].text.toLowerCase().length > 2 && levDist(exercise.alternatives[i].text.toLowerCase(), input.toLowerCase()) <= 2) {
      return true;
    } else if(exercise.alternatives[i].text.toLowerCase().length <= 2 && levDist(exercise.alternatives[i].text.toLowerCase(), input.toLowerCase()) == 0) {
      return true;
    }
  }
  return false;

}
$('#submit').click(function(e) {
  $("#userAvatar").removeClass('shake');
  $("#userAvatar").removeClass('movePlayer');
  $("#enemyAvatar").removeClass('shake');
  $("#enemyAvatar").removeClass('moveEnemy');
  var correct,
  exercise,
  exerciseDiv = $("#exercises > div:visible");
  var id = exerciseDiv.prop('id');
  id = id.split('-');
  for (var i = 0; i < exercisesList.length; i++) {
    if (exercisesList[i].id == id[1]){
      exercise = exercisesList[i];
      break;
    }
  };
  if (exercise.type == 1) {
    correct = checkType1(exercise.id);
  } else if (exercise.type == 2) {
    correct = checkType2(exercise.id);
  }
  if (correct){
    $("#userAvatar").addClass('movePlayer');
    $("#enemyAvatar").addClass('shake');
    acertos+=1;
    drawEnemyHearts();
    if (acertos == $("#exercises").children().length) {
      timeFinish = new Date();
      victory.play();
      var modal = $("#gameOver");
      modal.find('h4').html('Parabéns!');
      modal.find('p').html('Você derrotou o monstro e agora o caminho está livre!\nContinue com sua aventura!');
      modal.find('#footerDefeat').hide();
      modal.find('#footerVictory').show();
      modal.modal();
      responsiveVoice.speak(modal.find('p').html(), "Brazilian Portuguese Female");
      return;
    } else {
      hit.play();
    }
    nextExercise();
  } else {
    lives-=1;
    mistakes+=1;
    drawHearts();
    $("#enemyAvatar").addClass('moveEnemy');
    $("#userAvatar").addClass('shake');
    if (lives == 0) {
      timeFinish = new Date();
      defeat.play();
      data = {};
      data['mistakes'] = mistakes;
      data['idActivity'] = idActivity;
      data['idModule'] = idModule;
      data['time'] = (timeFinish - timeStart)/1000;
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      $.ajax({
        type: "POST",
        url: routeDefeat,
        data: data,
        success: function (response) {
          var modal = $("#gameOver");
          modal.find('h4').html('Oops!');
          modal.find('p').html('Não foi dessa vez, mas não desista!\nLevante e tente de novo!');
          modal.find('#footerDefeat').show();
          modal.find('#footerVictory').hide();
          modal.modal();
          responsiveVoice.speak(modal.find('p').html(), "Brazilian Portuguese Female");
        },
        error: function (response) {
          var errors = response.responseJSON;
          console.log(errors);
        }
      });
    } else {
      hit.play();
    }
    nextExercise();
  }
});

function shuffleAlternatives(parent) {
  var children = parent.children();
  while (children.length) {
    parent.append(children.splice(Math.floor(Math.random() *  children.length), 1));
  }
}

function unlockNext() {
  var data = {};
  data['idUser'] = user.id;
  data['idActivity'] = idActivity;
  data['idModule'] = idModule;
  data['mistakes'] = mistakes;
  data['time'] = (timeFinish - timeStart)/1000;
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
  });
    var type = "POST"; //for creating new resource
    $.ajax({
      type: type,
      url: route,
      data: data,
      success: function (response) {
        var pointsText = (response[0] == 1)? "Ponto Mágico":"Pontos Mágicos";
        $("#points").append("<p> Você ganhou </p> <h2><strong class='blue'>"+response[0]+"</strong></h2> <p><strong> "+pointsText+" </strong></p>");
        if (response.length > 1) {
          $("#newAchievements").show();
          $("#achievementCards").empty();
          for (var i = 1; i < achievements.length; i++) {
            var id = achievements[i].id;
            if(response.indexOf(id) != -1) {
              $("#achievementCards").append("<div class='col-md-4 card libraryCard'>"+"<div class='libraryHeading libraryModules'>"+"<p>"+achievements[i].name+"</p>"+"</div>"+"<div class='libraryBody'>"+"<div class='libraryCardInfo'>"+"<div class='col-md-12 text-center'>"+"<img src='"+imagesAchievements+achievements[i].icon+"' class='img-fluid m-x-auto d-block' alt='"+achievements[i].description+"'>"+"</div>"+"<div class='col-md-12 text-center'>"+"<p>"+achievements[i].description+"</p>"+"</div>"+"</div>"+"</div>"+"</div>");
              levelup.play();
              responsiveVoice.speak($("#achievementCards").parent().find('p').html(), "Brazilian Portuguese Female");
            }
          }
        } else {
          $('#newAchievements').hide();
        }
        $("#achievementModal").modal();
      },
      error: function (response) {
        var errors = response.responseJSON;
        console.log(errors);
      }
    });
  }

  $("#achievementModal").on("hidden.bs.modal", function () {
    window.location.replace(home);
  })

  $("#gameContinue").click(function(e){
    window.location.replace(window.location.href);
  });

  $("#gameDefeat").click(function(e){
    window.location.replace(home);
  });

  $("#gameVictory").click(function(e){
    unlockNext();
  });