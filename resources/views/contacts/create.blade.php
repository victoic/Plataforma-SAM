@extends('layouts.sidebar')

@section('content')
    <div class="col-md-7 col-md-offset-2">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="pull-left">Fale conosco</h1>
        </div>
    </div>
    @include('core-templates::common.errors')
    <div class="row">
        {!! Form::open(['route' => 'contacts.store']) !!}

            @include('contacts.fields')

        {!! Form::close() !!}
    </div>
    </div>
@include("layouts.scripts")
<script type="text/javascript">
    $("#profile").removeClass("active");
    $("#adventure").removeClass("active");
    $("#library").removeClass("active");
    $("#classroom").removeClass("active");
    $("#achievements").removeClass("active");
    $("#settings").removeClass("active");
    $("#contact").addClass("active");

    $('#navbarHome').click(function(e){
        window.location="{!! url('/home') !!}";
    });
</script>
@endsection
