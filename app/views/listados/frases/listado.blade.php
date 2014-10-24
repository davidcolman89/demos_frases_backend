@extends('master')
@section('contenido')
<style>
#table-listado-frases {
    margin-top: 50px;
}
</style>
<div class="row">
    <div class="col-xs-12 col-sm-9 col-md-12">
        <h1>Frases</h1>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-9 col-md-12">
        <table id="table-listado-frases" class="display table table-bordered table-striped table-responsive">
        <thead>
        <tr>
            <th>Autor</th>
            <th>Frase</th>
        </tr>
        </thead>
        <tbody>
        @foreach($frases as $frase)
        <tr>
            <td>{{$frase->autor}}</td>
            <td>{{$frase->texto}}</td>
        </tr>
        @endforeach
        </tbody>
        </table>
    </div>
</div>
@stop
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("#table-listado-frases").dataTable({
            "bProcessing" : true,
            "language": {"url": "//cdn.datatables.net/plug-ins/380cb78f450/i18n/Spanish.json"},
            "lengthMenu" : [
                [5,10,20,-1],
                [5,10,20,"Todas"]
            ]
        });
    });
</script>
@stop