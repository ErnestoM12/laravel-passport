<?php

namespace App\Http\Controllers;

use App\directorios;
use Illuminate\Http\Request;
use App\Http\Requests\createDirectoriosRequest;
use App\Http\Requests\updateDirectoriosRequest;

class directorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('txtBuscar')) {
            $directorios = directorios::where('nombre', 'like', '%' . $request->txtBuscar . '%')
                ->orWhere('telefono', $request->txtBuscar)
                ->where('userId', auth()->user()->id)
                ->get();
        } else {
            $directorios = directorios::where('userId', auth()->user()->id)->get();
        }

        return $directorios;
    }


    /**
     * cargar archivo
     *
     */
    private function cargarFoto($file)
    {

        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('fotografias'),  $fileName);
        return $fileName;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createDirectoriosRequest  $request)
    {

        $input = $request->all();

        if ($request->has('foto')) {
            $input['foto'] = $this->cargarFoto($request->foto);
        }

        $input['userId'] = auth()->user()->id;

        directorios::create($input);

        return response()->json([
            'res' => true,
        ], 200);
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return directorios::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateDirectoriosRequest $request, directorios $directorios)
    {

        //add method PUT
        $input = $request->all();
        if ($request->has('foto')) {
            $input['foto'] = $this->cargarFoto($request->foto);
        }
        $directorios->update($input);

        return response()->json([
            'res' => true,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        directorios::destroy($id);
        return response()->json([
            'res' => true,
        ], 200);
    }
}
