<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ville;

class VilleController extends Controller
{

    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $form = collect($request->input('form'))->pluck('value', 'name');

        $options = Ville::query();

        // if no gouvernorat has been selected, show no options
        if (! $form['gouvernorat_id']) {
            return [];
        }

        // if a gouvernorat has been selected, only show villes in that gouvernorat
        if ($form['gouvernorat_id']) {
            $options = $options->where('gouvernorat_id', $form['gouvernorat_id']);
        }

        if ($search_term) {
            $results = $options->where('nom', 'LIKE', '%'.$search_term.'%')->paginate(10);
        } else {
            $results = $options->paginate(10);
        }

        return $results;
    }

}
?>
