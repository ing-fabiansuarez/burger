<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('admin/contents/view_home');
	}
	
	//--------------------------------------------------------------------
	public function welcome()
	{
		return view('welcome_message');
	}
}
