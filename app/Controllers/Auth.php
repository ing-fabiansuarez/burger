<?php

namespace App\Controllers;

use App\Models\EmployeeModel;
use App\Models\PermissionEmployeeModel;
use App\Models\PermissionModel;

class Auth extends BaseController
{
    //--------------------------------------------------------------------
    public function login()
    {
        if (!session()->is_logged) {
            return view('auth/login');
        } else {
            return redirect()->route('home_system');
        }
    }

    public function signin()
    {
        if (!$this->validate([
            'user' => 'required|numeric',
            'password' => 'required'
        ])) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }
        $user = trim($this->request->getPost('user'));
        $password = trim($this->request->getPost('password'));
        $modelEmployee = new EmployeeModel();
        if (!$employee = $modelEmployee->getEmployeeLogin('id_employee', $user)) { 
            return redirect()->back()->with('msg', ['body' => 'Este usuario no se encuentra registrado en el sistema o esta deshabilitado'])->withInput();
        }
        if (md5($password) != $employee->password_employee) {
            return redirect()->back()->with('msg', ['body' => 'Credeciales invalidas para ' . $employee->name_employee])->withInput();
        }
        $mdlPermission = new PermissionModel();
        if ($mdlPermission->hasPermission(1, $employee->id_employee)) {
            session()->set([
                'cedula_employee' => $employee->id_employee,
                'name_employee' => $employee->name_employee,
                'date_start_employee' => $employee->datecreate_employee,
                'image_employee' => $employee->image_employee,
                'is_logged' => true
            ]);
            return redirect()->route('home_system');
        } else {
            return redirect()->back()->with('msg', ['body' => $employee->name_employee . ', lo sentimos tu no tienes permiso de ingresar al Sistema de producción'])->withInput();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->route('login');
    }
}
