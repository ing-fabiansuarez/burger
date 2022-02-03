<?php

namespace App\Models;


use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table      = 'employee';
    protected $primaryKey = 'id_employee';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_employee',
        'name_employee',
        'surname_employee',
        'image_employee',
        'datecreate_employee'
    ];

    public function getEmployeeLogin(string $column, string $value)
    {
        return $this->where($column, $value)->where('active_employee',1)
            ->get()->getFirstRow();
        //return $this->where($column,$value)->first();
    }
}
