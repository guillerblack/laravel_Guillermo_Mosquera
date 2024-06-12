@extends('layouts.app')

@section('titulo', 'Listado de cursos')

@section('contenido')
<br>
<h3 class="text-center">Listado de Cursos Disponibles</h3>
<br>
<div class="pull-right mb-2">
    <a class="btn btn-primary" onClick="add()" href="cursos/create"> Crear Curso</a>
    <a class="btn btn-primary" onClick="add()" href="mi-sena"> crear empleados</a>

</div>

<br>
<div class="row">
    @foreach ($course as $cursito)
    <div class="col-sm">
        <div class="card" style="width: 18rem;">
            <img style="height: 200px; width:250px; margin:20px" src="{{ Storage::url($cursito->imagen) }}" class="card-img-top mx-auto d-block" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{$cursito->nombre}}</h5>
              <p class="card-text">{{$cursito->descripcion}}</p>
              <a href="/cursos/{{$cursito->id}}" class="btn btn-success">Ver detalles</a>
                @include('cursos.eliminar', ['cursito' => $cursito])

            </div>
        </div>
    </div>
    @endforeach
</div> {{--cierro el div row--}}

@endsection

