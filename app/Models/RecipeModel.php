<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model
{
    protected $table      = 'recipe';
    protected $primaryKey = 'id_recipe';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [];

    public function getIngredientsOfProduct( $product)
    {
        return $this->db->table('recipe r')
            ->select('*')
            ->join('ingredient i', 'i.id_ingredient = r.ingredient_id_ingredient')
            ->where("r.product_id_product", $product)
            ->get()->getResultArray();
    }
}
