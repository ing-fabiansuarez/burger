<?php

namespace App\Models;

use CodeIgniter\Model;

class PrintModel extends Model
{
    protected $table      = 'print';
    protected $primaryKey = 'id_print';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_print',
        'order_id_order',
        'hour_print',
        'print_by_id_empoyee',
    ];
}
