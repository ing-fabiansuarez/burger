<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderHasPaymentMethodModel extends Model
{
    protected $table      = 'order_has_paymentmethod';
    protected $primaryKey = 'order_id_order';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'paymentmethod_id_paymentmethod',
        'order_id_order'
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
