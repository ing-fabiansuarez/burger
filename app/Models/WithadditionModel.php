<?php

namespace App\Models;

use CodeIgniter\Model;

class WithadditionModel extends Model
{
    protected $table      = 'detailorder_has_product_additions';
    protected $primaryKey = 'detailorder_id_detailorder';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'detailorder_id_detailorder',
        'product_additions_id_product_additions',
        'price_more_additions'
    ];

    public function getAdditions($id_detailorder) //Retorna toda la informacion de Adiciones para ese detalle de orden
    {
        return ($this->db->table('detailorder_has_product_additions')
            ->select('*')
            ->join('product_additions', 'detailorder_has_product_additions.product_additions_id_product_additions = product_additions.id_product_additions')
            ->join('addition', '(product_additions.addition_id_addition = addition.id_addition)')
            ->where('detailorder_has_product_additions.detailorder_id_detailorder', $id_detailorder)
            ->get()->getResultArray());
    }
}
