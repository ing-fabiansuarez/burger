<?php

namespace App\Models;

use CodeIgniter\Model;

class WhitoutingredientModel extends Model
{
    protected $table      = 'detailorder_hasnot_recipe';
    protected $primaryKey = 'detailorder_id_detailorder';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'detailorder_id_detailorder',
        'recipe_id_recipe',
        'discount_hasnot'
    ];

    public function getIngredients($id_detailorder)//Retorna toda la informacion de ingredientes que no deben ir en la  receta.
    {
        return ($this->db->table('detailorder_hasnot_recipe')
            ->select('*')
            ->join('recipe', 'detailorder_hasnot_recipe.recipe_id_recipe = recipe.id_recipe')
            ->join('ingredient', '(recipe.ingredient_id_ingredient = ingredient.id_ingredient)')
            ->where('detailorder_hasnot_recipe.detailorder_id_detailorder', $id_detailorder)
            ->get()->getResultArray());
    }
}
