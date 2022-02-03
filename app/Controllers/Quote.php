<?php

namespace App\Controllers;

use App\Models\PermissionModel;

class Quote extends BaseController
{
	//--------------------------------------------------------------------
	public function viewMeat()
	{
		$mdlPermission = new PermissionModel();

		//si tiene permiso de update
		//si es link
		//si esta pendiente
		if ($mdlPermission->hasPermission(2)) {
			if (!$num_burgers = $this->request->getGet('number_burger')) {
				$num_burgers = null;
			}
			return view('admin/contents/quote/view_quote_meat', [
				'num_burgers' => $num_burgers
			]);
		}else{
			return view('permission/donthavepermission');
		}
	}
}
