<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SalarieRequest;
use App\Models\Gouvernorat;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SalarieCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SalarieCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;



    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Salarie::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/salarie');
        CRUD::setEntityNameStrings('', 'salaries');
        $this->crud->enableExportButtons();

    }
   public function fetchVille(){
        return $this->fetch(Ville::class);
    }
    public function fetchGouvernorat(){
        return $this->fetch(Gouvernorat::class);
    }
    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
       // CRUD::setFromDb(); // columns
       CRUD::addColumn([
        'label'=>'Nom & Prénom',
        'name' => 'nom',
        'type' => 'text'
        ]);

            CRUD::addColumn([
                'label'=>'CIN',
                'name' => 'cin',
                'type' => 'text'
                ]);
                CRUD::addColumn([
                    'label'=>'Diplome',
                    'name' => 'diplome',
                    'type' => 'text'

                    ]);
                CRUD::addColumn([
                    'label'=>'Gouvernorat',
                    'name' => 'gouvernorat',
                    'type' => 'relationship',
                    'attribute'=>'nom',
                    'entity'=>'gouvernorat'
                    ]);
                    CRUD::addColumn([
                        'label'=>'Ville',
                        'name' => 'ville',
                        'type' => 'relationship',
                        'attribute'=>'nom',
                        'entity'=>'ville'
                        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(SalarieRequest::class);

       // CRUD::setFromDb(); // fields
        CRUD::addField([
            'label'=>'Nom & Prénom',
            'name' => 'nom',
            'type' => 'text'
            ]);


                CRUD::addField([
                    'label'=>'CIN',
                    'name' => 'cin',
                    'type' => 'text'
                    ]);
                    CRUD::addField([
                        'label'=>'Diplome',
                        'name' => 'diplome',
                        'type' => 'text'
                        ]);
                      /* CRUD::field('gouvernorat')
                            ->ajax(true)
                            ->minimum_input_length(0)
                            ->attribute('gouvernorat');
                            CRUD::field('ville')
                            ->ajax(true)
                            ->minimum_input_length(0)
                            ->data_source(url("api/ville"))
                            ->method('POST')
                            ->dependencies(['gouvernorat'])
                            ->include_all_form_fields(true);

                         /*  CRUD::addField([
                            'label'=>'Gouvernorat',
                            'name' => 'gouvernorat',
                            'type' => 'select',
                            'attribute'=>'nom'
                            ]);
                        CRUD::addField([
                                'label'=>'Ville',
                                'name' => 'ville',
                                'type' => 'select',
                                'attribute'=>'nom'
                                ]);*/
                                $this->crud->addField([    // SELECT2
                                    'label'         => 'Gouvernorat',
                                    'type'          => 'select',
                                    'name'          => 'gouvernorat_id',
                                    'entity'        => 'gouvernorat',
                                    'attribute'     => 'nom',
                                ]);
                                $this->crud->addField([ // select2_from_ajax: 1-n relationship
                                    'label'                => "Ville", // Table column heading
                                    'type'                 => 'select2_from_ajax',
                                    'name'                 => 'ville_id', // the column that contains the ID of that connected entity;
                                    'entity'               => 'ville', // the method that defines the relationship in your Model
                                    'attribute'            => 'nom', // foreign key attribute that is shown to user
                                    'data_source'          => url('api/ville'), // url to controller search function (with /{id} should return model)
                                    'placeholder'          => 'Select an element',
                                    'minimum_input_length' => 0, // minimum characters to type before querying results
                                    'dependencies'         => ['gouvernorat_id'], // when a dependency changes, this select2 is reset to null
                                    //'method'                    => ‘GET’, // optional - HTTP method to use for the AJAX call (GET, POST)
                                ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
