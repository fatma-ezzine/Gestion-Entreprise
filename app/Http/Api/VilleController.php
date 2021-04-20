<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ville;
use \Debugbar;

class VilleController extends Controller
{

    public function index(Request $request)
    {
        $theSelectedGouvernorat= array_filter($request->form, function ($field) {
            return $field['name'] == 'gouvernorat';
            });
            Debugbar::info($theSelectedGouvernorat);
            // then we extract the value of the country filed
            $theSelectedGouvernorat = array_values($theSelectedGouvernorat)[0]['value'];
            // this is the search input of the select2
            $searchTerm = $request->input('q');
            if ($searchTerm) {
            // then we get only the towns of that country by adding a clause
            // of the search area and the country on the query
            $results = Ville::where('gouvernorat_id', $theSelectedGouvernorat)
            ->where('nom', 'LIKE', '%'.$searchTerm.'%')->paginate(10);
            } else {
            // if the user didn't type anything in the search area we add only the
            // clause of the country
            $results = Ville::where('gouvernorat_id', $theSelectedGouvernorat)->paginate(10);
            }

        return $results;
    }

}
?>
