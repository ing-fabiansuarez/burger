<?php

namespace App\Models;

use CodeIgniter\Model;

class DomicilioModel extends Model
{
    protected $table      = 'domicilio';
    protected $primaryKey = 'id_domicilio';
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id_domicilio',
        'address_domicilio',
        'neighborhood_domicilio',
        'domiciliary_id_domiciliary',
        'price_domicilio',
        'whatsapp_domicilio',
        'observation_domicilio'
    ];
}
