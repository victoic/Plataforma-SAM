@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="pull-left">Criar Nova Conquista</h1>
        </div>
    </div>

    @include('core-templates::common.errors')

    <div class="row">
        {!! Form::open(['route' => 'achievements.store', 'files' => true]) !!}

            @include('achievements.fields')

        {!! Form::close() !!}
    </div>
    @include("layouts.scripts")
    <script type="text/javascript">
        route = "{!! route('achievements.store') !!}";
        $("input:file").on('change', function() {
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
        $("form").submit(function(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            dataAchievement = {};
            dataAchievement['name'] = $("input[name=name]").val();
            dataAchievement['description'] = $("input[name=description]").val();
            dataAchievement['points'] = $("input[name=points]").val();
            e.preventDefault();
            $("input[type=file]").simpleUpload(route, {
                data: {dataAchievement},
                success: function(e){
                    window.location.replace("{{ route('achievements.index') }}");
                }
            })
        });
    </script>
@endsection
