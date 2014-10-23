@extends('master')
@section('contenido')
<div class="row">
    <div class="col-md-12">
        <table id="table-listado-frases" class="table table-bordered table-striped">
            <tr>
                <th>#</th>
                <th>Autor</th>
                <th>Frase</th>
            </tr>
            @foreach($frases as $frase)
            <tr>
                <td>{{$frase->id}}</td>
                <td>{{$frase->autor}}</td>
                <td>{{$frase->texto}}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@stop
@section('scripts')
<script type="text/javascript">
    $(function(){
        $("#table-listado-frases").dataTable();
    });
</script>
@stop