<?php

namespace App\Models;

use CodeIgniter\Model;

class AdditionModel extends Model
{
    protected $table      = 'addition';
    protected $primaryKey = 'id_addition';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [];

}
