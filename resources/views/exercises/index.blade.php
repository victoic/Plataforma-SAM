@extends('layouts.app')

@section('content')
        <h1 class="pull-left">Exercícios</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('exercises.create') !!}">Adicionar Novo</a>

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        @include('exercises.table')
        
@endsection
