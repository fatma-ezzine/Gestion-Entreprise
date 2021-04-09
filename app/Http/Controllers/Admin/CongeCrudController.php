<?php

namespace App\Http\Controllers\Admin;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CongeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CongeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CongeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Conge::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/conge');
        CRUD::setEntityNameStrings('', 'conges');
        $this->crud->enableExportButtons();

    }

    public function fetchTypeConge(){
        return $this->fetch(TypeConge::class);
        $this->crud->enableExportButtons();
    }

    public function valider() {
        $details = [
            'title' => ' Maison du web',
            'body' =>' Votre Congé  a été validé '
         ];

         Mail::to($this->email)->send(new TestMail($details));


    }

    public function refuser() {
        $details = [
            'title' => ' Maison du web',
            'body' =>' Votre Congé  a été refusé '
         ];

         Mail::to($this->email)->send(new TestMail($details));


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
       CRUD::addColumn(['label' => 'Type',
       'name' => 'typeConge',
       'type' => 'relationship',
       'attribute'=>'type',
       'entity'=>'typeConge',
       'wrapper' =>[
           'href'=> function($crud, $column, $entry, $related_key){
               return backpack_url('typeconge/'.$related_key.'/show');
           },
           'target'=>'_blank'
       ],
       ]);

       CRUD::addColumn(['label'=> 'Employés',
       'name' => 'salarie',
       'type' => 'relationship',
       'attribute'=>'nom',
       ]);
       CRUD::addColumn([
        'label'=>'Email',
        'name' => 'email',
        'type' => 'text'
        ]);
       CRUD::addColumn(['label'=> 'Nombre de jours',
       'name' => 'nombre_jours',
       'type' => 'number',
       ]);
         CRUD::addColumn(['label'=> 'Nature',
         'name' => 'nature',
         'type' => 'enum'
         ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
        $this->crud->addButtonFromView('line', 'Refuser', 'refuser', 'beginning');
        $this->crud->addButtonFromView('line', 'Valider', 'valider', 'beginning');

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CongeRequest::class);

        //CRUD::setFromDb(); // fields
        CRUD::addField(['label' => 'Type ',
                'name' => 'typeConge',
                'type' => 'relationship',
                'attribute'=>'type',
                'inline_create'=>['entity' => 'typeconge'],
                'ajax'=>(true),
                'minimum_input_length'=>0,
                ]);

                    CRUD::addField(['label'=> 'Employés',
                            'name' => 'salarie',
                            'type' => 'select',
                            'attribute'=> 'nom'
                    ]);
                    CRUD::addField([
                        'label'=>'Email',
                        'name' => 'email',
                        'type' => 'text',
                        'attribute'=> 'email'
                        ]);
                    CRUD::addField(['label'=> 'Nombre de jours',
                    'name' => 'nombre_jours',
                    'type' => 'number',
                    'suffix'=>'Jours',
                    ]);
                       CRUD::addField(['label'=> 'Nature de congé',
                        'name' => 'nature',
                        'type' => 'select_from_array',
                        'options'=>['payé'=>'Payé', 'non payé'=>'Non payé'],
                        'attribute'=> 'nature'
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
