<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Portafolio;
use Livewire\WithPagination;
use DB;

class WelcomeController extends Controller{
    //lo mismo que esta en la parte de portafoliocontroller, pero con unas ligeras modificaciones
    public function index(request $request){
        $cantidadPorPagina = $request->input('cantidad', 10); // Obtiene el valor seleccionado o usa 10 por defecto
        $search_value = $request->input('search_value', ''); // Obtener el valor de búsqueda o usar una cadena vacía por defecto

        $file= DB::table('portafolio')
        ->where(function ($query) use ($search_value) {
            $query->where('nombre', 'like', '%' . $search_value . '%')
                ->orWhere('ubicacion', 'like', '%' . $search_value . '%');
        })
        ->orderByRaw(
            'CAST(SUBSTRING_INDEX(SUBSTRING_INDEX(ubicacion, "-", 2), "-", -1) AS UNSIGNED), ' .
            'SUBSTRING_INDEX(SUBSTRING_INDEX(ubicacion, "-", 3), "-", -1), ' .
            'CAST(SUBSTRING_INDEX(ubicacion, "-", -1) AS UNSIGNED)'
        )
        ->paginate($cantidadPorPagina);
        return view('welcome')->with('file',$file)->with('search_value', $search_value);;//regresa a la vista de bienvenida
    }
}
