<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentMethodModel extends Model
{
    protected $table      = 'paymentmethod';
    protected $primaryKey = 'id_paymentmethod';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [];
}
