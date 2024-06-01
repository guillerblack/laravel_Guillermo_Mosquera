<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CRUD Práctica SENA</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" >
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<style>
    body {
        background-color: #96ceff;
    }
</style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CRUD Práctica SENA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('empleados') }}">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('contacto') }}">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Tabla de Empleados del SENA</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-primary" onClick="add()" href="javascript:void(0)"> Crear Empleado</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="card-body">
        <table class="table table-bordered" id="ajax-crud-datatable">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Dirección</th>
                    <th>Creado en</th>
                    <th>Acción</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="employee-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="EmployeeForm" name="EmployeeForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese Nombre" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese Email" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Dirección</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese Dirección" required="">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10"><br/>
                        <button type="submit" class="btn btn-primary" id="btn-save">Guardar cambios</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready( function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#ajax-crud-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('mi-sena') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nombre', name: 'nombre' },
            { data: 'email', name: 'email' },
            { data: 'direccion', name: 'direccion' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false},
        ],
        order: [[0, 'desc']]
    });
});

function add(){
    $('#EmployeeForm').trigger("reset");
    $('#EmployeeModal').html("Agregar Empleado");
    $('#employee-modal').modal('show');
    $('#id').val('');
}

function editFunc(id){
    $.ajax({
        type:"POST",
        url: "{{ url('edit') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){
            $('#EmployeeModal').html("Editar Empleado");
            $('#employee-modal').modal('show');
            $('#id').val(res.id);
            $('#nombre').val(res.nombre);
            $('#direccion').val(res.direccion);
            $('#email').val(res.email);
        }
    });
}

function deleteFunc(id){
    if (confirm("¿Eliminar Registro?") == true) {
        var id = id;
        $.ajax({
            type:"POST",
            url: "{{ url('delete') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
                var oTable = $('#ajax-crud-datatable').dataTable();
                oTable.fnDraw(false);
            }
        });
    }
}

$('#EmployeeForm').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type:'POST',
        url: "{{ url('store') }}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
            $("#employee-modal").modal('hide');
            var oTable = $('#ajax-crud-datatable').dataTable();
            oTable.fnDraw(false);
            $("#btn-save").html('Enviar');
            $("#btn-save").attr("disabled", false);
        },
        error: function(data){
            console.log(data);
        }
    });
});
</script>
</body>
</html>
