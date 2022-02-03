<?php

namespace App\Models;

use App\Entities\Order;
use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'order';
    protected $primaryKey = 'id_order';
    protected $returnType     = Order::class;
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id_order',
        'typeshipping_id_typeshipping',
        'darlyturn_order',
        'turnmachine_order',
        'observations_order',
        'date_order',
        'hour_order',
        'consecutive_order',
        'employee_id_employee',
        'domicilio_id_domicilio',
        'client_id_client',
        'state_id_state'
    ]; 
}
