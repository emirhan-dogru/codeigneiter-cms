<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

	public $viewFolder = "";

	public function __construct()
	{
		//CI_Controller kütüphanesindeki constractları da çalıştır
		parent::__construct();

		$this->viewFolder = "product";
	}

	public function index()
	{
		$data = new stdClass();
		$data->viewFolder = $this->viewFolder;
		$data->subViewFolder = "list";

		$this->load->view("{$data->viewFolder}/{$data->subViewFolder}/index", $data);
	}
}
