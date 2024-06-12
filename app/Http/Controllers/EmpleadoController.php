<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use Datatables;
use Illuminate\Routing\Controller;

class EmpleadoController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Empleado::select('*'))
            ->addColumn('action', 'employee-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('empleado.index');
    }

    public function store(Request $request)
    {
        $empleadoId = $request->id;

        $empleado = Empleado::updateOrCreate(
            [
                'id' => $empleadoId
            ],
            [
                'nombre' => $request->nombre,
                'email' => $request->email,
                'direccion' => $request->direccion
            ]
        );

        return response()->json($empleado);
    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $empleado = Empleado::where($where)->first();

        return response()->json($empleado);
    }

    public function destroy(Request $request)
    {
        $empleado = Empleado::where('id', $request->id)->delete();

        return response()->json($empleado);
    }
}
