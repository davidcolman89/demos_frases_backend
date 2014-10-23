@extends('master')
@section('contenido')
{{ Form::model(isset($frase)? $frase : null,$formData, array('role' => 'form')) }}
<div class="row">
    <div class="form-group col-md-5">
        {{ Form::label('autor', 'Autor') }}
        {{ Form::text('autor',null,array('class' => 'form-control')); }}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-12">
        {{ Form::label('texto', 'Frase') }}
        {{ Form::textarea('texto',null,array('class' => 'form-control')); }}
    </div>
</div>
<div class="row">
    <div class="form-group col-md-5">
        {{ Form::button('Guardar', array('type' => 'submit', 'class' => 'btn btn-primary')); }}
    </div>
</div>
{{ Form::close() }}
@stop
