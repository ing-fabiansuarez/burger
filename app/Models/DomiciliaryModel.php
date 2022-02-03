<?php

namespace App\Models;

use CodeIgniter\Model;

class DomiciliaryModel extends Model
{
    protected $table      = 'domiciliary';
    protected $primaryKey = 'id_domiciliary';
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id_domiciliary' ,
        'name_domiciliary' ,
        'surname_domiciliary',
        'datestart_domiciliary'
    ];
}
