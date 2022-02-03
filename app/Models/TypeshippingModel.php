<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeshippingModel extends Model
{
    protected $table      = 'typeshipping';
    protected $primaryKey = 'id_typeshipping';
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id_typeshipping' ,
        'name_typeshipping' 
    ];
}
