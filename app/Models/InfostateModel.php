<?php

namespace App\Models;


use CodeIgniter\Model;

class InfostateModel extends Model
{
    protected $table      = 'infostates';
    protected $primaryKey = 'id_infostates';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_infostates',
        'state_id_state',
        'order_id_order',
        'dateupdate_infostate'
    ];
}
