<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		echo view('header');
		echo view('areaAdm');
		echo view('footer');
	}
}
