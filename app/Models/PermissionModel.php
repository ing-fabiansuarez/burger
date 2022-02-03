<?php

namespace App\Models;

use App\Entities\Employee;
use CodeIgniter\Model;

class PermissionModel extends Model
{
    protected $table      = 'employee_has_permission';
    protected $primaryKey = 'employee_id_employee';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'employee_id_employee', 
        'Permission_id_permission'
    ];

    public function hasPermission($permission, $cedula = null)
    {
        if ($cedula == null) {
            if (!$this->where('employee_id_employee', session()->cedula_employee)->where('Permission_id_permission', $permission)->where('active_permission', 1)->first()) {
                return false;
            } else {
                return true;
            }
        } else {
            if (!$this->where('employee_id_employee', $cedula)->where('Permission_id_permission', $permission)->where('active_permission', 1)->first()) {
                return false;
            } else {
                return true;
            }
        }
    }


}