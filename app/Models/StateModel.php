<?php

namespace App\Models;

use CodeIgniter\Model;

class StateModel extends Model
{
    protected $table      = 'state';
    protected $primaryKey = 'id_state';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

  
}
