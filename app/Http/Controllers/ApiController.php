<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ApiResponses;

class ApiController extends Controller
{

    use ApiResponses;


    protected function loadIncludes(Request $request, $model)
    {
        // Definisci un elenco di relazioni valide, per esempio, definito nel modello stesso
        $validIncludes = $model->getIncludableRelations();

        $includes = $request->query('include');

        if ($includes) {
            // Converte la query in un array
            $includes = explode(',', $includes);

            // Filtra le relazioni valide
            $includes = array_filter($includes, function ($include) use ($validIncludes) {
                return in_array($include, $validIncludes);
            });

            // Carica le relazioni valide
            $model->load($includes);
        }

        return $model;
    }
}
