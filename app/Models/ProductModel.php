<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'product';
    protected $primaryKey = 'id_product';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [];

    public function getInfoProductsListOrder($list_order) //este metodo solo se utiliza para el array del carrito q esta cargado en la session
    {
        //--- declaracion de modelos
        $mdlIngredient = new IngredientModel();
        $mdlAddtions = new AdditionModel();

        $arrayresult = array();
        foreach ($list_order as $item) {
            $consultamdl = array();
            $consultamdl = $this->find($item['product']);

            //-- consulta de los ingredientes que no van
            $without_ingredients = array();
            foreach ($item['whitout_ingredients'] as $without) {
                array_push($without_ingredients, $mdlIngredient->find($without));
            }

            // consulta de las adiciones para los item de pedido
            $with_additions = array();
            foreach ($item['whit_additions'] as $addition) {
                array_push($with_additions, $mdlAddtions->find($addition));
            }

            //agrega la informacion al array de item y despues de resultado
            $consultamdl = array_merge($consultamdl, [
                'whitout_ingredients' => $without_ingredients,
                'whit_additions'=>$with_additions,
                'quantity' => $item['quantity'],
                'id_list_order' => $item['id']
            ]);
            array_push($arrayresult, $consultamdl);
        }
        return $arrayresult;
    }  
}
