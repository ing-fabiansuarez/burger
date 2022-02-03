<?php

namespace App\Controllers;

use App\Models\DomiciliaryModel;
use App\Models\DomicilioModel;
use Exception;

class Domiciliary extends BaseController
{
	public function viewCreateDomiciliary()
	{
		$mdl = new DomiciliaryModel();
		$mdlDomicilio = new DomicilioModel();
		$domiciliaries = $mdl->findAll();

		$info = array();

		foreach ($domiciliaries as $domiciliary) {
			$quantity_domis = count($mdlDomicilio->where('domiciliary_id_domiciliary', $domiciliary['id_domiciliary'])->findAll());
			$newArray = array_merge($domiciliary, ['quantity' => $quantity_domis]);
			array_push($info, $newArray);
		}

		return view('admin/contents/domiciliary/view_domiciliary', [
			'domiciliaries' => $info
		]);
	}

	public function createDomiciliary()
	{
		if (!$this->validate(
			[
				'cedula_domiciliary' => 'required|is_natural',
				'name_domiciliary' => 'required|alpha_space',
				'surname_domiciliary' => 'required|alpha_space',
				'date_domiciliary' => 'required'
			],
			[   // Errors
				'cedula_domiciliary' => [
					'required' => 'La cedula es requerida!',
					'is_natural' => 'La cedula debe contener solo números naturales.'
				],
				'name_domiciliary' => [
					'required' => 'Los nombres son requeridos!',
					'alpha_space' => 'Solo son permitidos caracteres alfanumericos y espacios.'
				],
				'surname_domiciliary' => [
					'required' => 'Los apellidos son requeridos!',
					'alpha_space' => 'Solo son permitidos caracteres alfanumericos y espacios.'
				],
				'date_domiciliary' => [
					'required' => 'La fecha de inicio es requerida!',
				]
			]

		)) {
			return redirect()->back()->with('validate_form_domiciliary', $this->validator->getErrors())->withInput();
		}

		$cedula = $this->request->getPostGet('cedula_domiciliary');
		$name= $this->request->getPostGet('name_domiciliary');
		$surname = $this->request->getPostGet('surname_domiciliary');
		$date =  $this->request->getPostGet('date_domiciliary');

		$mdlDomiciliary = new DomiciliaryModel();

		if (empty($mdlDomiciliary->find($cedula))) {
			try {
				$mdlDomiciliary->insert([
					'id_domiciliary' => $cedula,
					'name_domiciliary' => $name,
					'surname_domiciliary' => $surname,
					'datestart_domiciliary'=> $date
				]);
				return redirect()->back()->with('msg', [
					'title' => 'En hora buena!',
					'body' => 'Se creo exitosamente el Domiciliario.'
				]);
			} catch (Exception $e) {
				return redirect()->back()->with('error', [
					'title' => 'Alerta!',
					'body' => 'Ocurrio un error con el modelo, al tratar de insertar El cliente. <br>Excepción capturada:' .  $e->getMessage()
				])->withInput();
			}
		} else {
			return redirect()->back()->with('error', [
				'title' => 'Alerta!',
				'body' => 'El Domiciliarios ya existe, revise el número de cedula',
			])->withInput();
		}
	}
}
