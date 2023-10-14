<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Portafolio;
use Illuminate\Support\Facades\Validator;
use DB;
class PortafolioController extends Controller{
    //Parte del portafolio.index, donde se muestran todos los resultados de la Base de Datos(BD)
    public function index(Request $request){
        $search_value = $request->search_value;
        $cantidadPorPagina = $request->input('cantidad', 10); // Obtiene el valor seleccionado o usa 10 por defecto

        $portafolio = DB::table('portafolio')
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

        return view('portafolio.index')->with('portafolio', $portafolio)->with('search_value', $search_value);
        }




    //se añade a la base de datos, pero todo esto funciona gracias a la vista de create
    public function create(){
    return view('portafolio.create');
    }
    //store almacena los datos que se requieren en la base de datos
    public function store(Request $request){
    $requestData = $request->all();
    $data = [
        "nombre"=> $request->nombre,
        "descripcion" => $request->descripcion,
        "ubicacion" =>$request->ubicacion,
    ];
    if(!empty($request->pdf)){
        //subir imagen
    // Subir el PDF al sistema de almacenamiento
    $pdfPath = $request->file('pdf')->store('pdf', 'public');

    // Almacenar la ruta del PDF en la base de datos
    $data = array_merge($data, ["pdf" => $pdfPath]);
    }
    $request->validate([
        'ubicacion' => 'required|unique:ubicacion',
        'ubicacion' => 'required|formato',
        Rule::unique('portafolio'),
    ]);
            // Verificar si la clave ya existe, resaltan los siguientes mensajes
            $existingRecord = Portafolio::where('ubicacion', $request->input('ubicacion'))->first();

            if ($existingRecord) {
                return redirect()->back()->with('error', 'ya existe esa ubicacion, agrega otra que no exista');
            }
    Portafolio::create($requestData);
    return redirect('/')->with('success', 'Archivo PDF cargado correctamente.');
    }


    public function edit(string $id){

    }


    public function update(Request $request, string $id){

    }




    public function destroy(Request $request, $id){
            // Lógica para eliminar el registro
            $portafolio = Portafolio::find($id);
            if (!$portafolio) {
                return redirect()->back()->with('error', 'El registro no se encontró o ya ha sido eliminado.');
            }
            $portafolio->delete();
            // Establecer un mensaje de sesión para mostrar la alerta
            return redirect()->route('portafolio.index')->with('success', 'Archivo eliminado correctamente.');
    }
}
