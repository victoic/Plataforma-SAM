@extends('layouts.app')

@section('content')
<div class="row vertical-center whitePanel">
    <div class="col-md-12 vertical-center">
        <div class="col-md-3 col-md-offset-1 text-center">
            <img src="{!! url('/').'/images/'.'SAM.png' !!}" height="150em">
        </div>
        <div class="col-md-6">
            <h1>Conheça o Sam</h1>
            <p class="text-justify">
                Sam, o Sistema de auxílio à matemática, foi criado com o objetivo de ajudar crianças portadoras de Síndrome de Down no aprendizado da matemática. Criando um ambiente divertido para o aprendizado das crianças e disponibilizando ferramentas auxiliares para seus professores.
                <div class="col-md-12 text-center">
                    <a class="btn btn-proceed btn-lg" href="/register" role="button">Vamos lá!</a>
                </div>
            </p>
        </div>
    </div>
</div>
<div class="row vertical-center bluePanel">
    <div class="col-md-12 vertical-center">
        <div class="col-md-3 col-md-offset-1 text-center">
            <i class="fa fa-gamepad fa-5x" aria-hidden="true"></i>
        </div>
        <div class="col-md-6">
            <h1>Jogue</h1>
            <p class="text-justify">
                No Sam, aprendizado são aventuras. A cada passo de uma aventura, a criança combaterá monstros e receberá recompensas!
            </p>
        </div>
    </div>
</div>
<div class="row vertical-center whitePanel">
    <div class="col-md-12 vertical-center">
        <div class="col-md-3 col-md-offset-1 text-center">
            <i class="fa fa-share-alt fa-5x" aria-hidden="true"></i>
        </div>
        <div class="col-md-6">
            <h1>Colabore</h1>
            <p class="text-justify">
                O Sam disponibiliza recursos para criação e compartilhamente de conteúdo personalizado. Você pode criar suas próprias aventuras e atividades, assim como utilizar as criações de outros professores!
            </p>
        </div>
    </div>
</div>
<div class="row vertical-center bluePanel">
    <div class="col-md-12 vertical-center">
        <div class="col-md-3 col-md-offset-1 text-center">
           <i class="fa fa-info fa-5x" aria-hidden="true"></i>
        </div>
        <div class="col-md-6">
            <h1>Créditos</h1>
            <p >
                Pelas imagens utilizadas:
            </p>
            <p><a href="https://www.linkedin.com/in/victor-lundgren-b2823ab0">Victor Lundgren</a></p>
            <p><a href="http://www.freepik.com">Freepik</a></p>
            <p><a href="http://boultim.deviantart.com">boultim</a></p>
        </div>
    </div>
</div>
@include('layouts.scripts')
<script type="text/javascript">
    $('#navbarLogin').click(function(e){
        window.location="{!! url('/login') !!}";
    });
    $('#navbarRegister').click(function(e){
        window.location="{!! url('/register') !!}";
    });
    $('#navbarHome').click(function(e){
        window.location="{!! url('/home') !!}";
    });
</script>
@endsection
