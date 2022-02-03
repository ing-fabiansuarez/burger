<?php

namespace App\Models;

use CodeIgniter\Model;

class AdditionproductModel extends Model
{
    protected $table      = 'product_additions';
    protected $primaryKey = 'id_product_additions';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        
    ];

    public function getAdditionsOfProduct($product)
    {
        return $this->db->table('product_additions')
            ->select('*')
            ->join('addition', 'addition.id_addition = product_additions.addition_id_addition')
            ->where("product_additions.product_id_product", $product)
            ->get()->getResultArray();
    }
}
