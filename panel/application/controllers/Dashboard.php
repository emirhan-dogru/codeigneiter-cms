<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public $viewFolder = "";

	public function __construct()
	{
		parent::__construct();

		$this->viewFolder = "dashboard";

		if (!get_active_user()) {
			redirect(base_url('login'));
		}
	}

	public function index()
	{
		$data = new stdClass();
		$data->viewFolder = $this->viewFolder;
		$data->subViewFolder = "list";
		$this->load->view("{$data->viewFolder}/{$data->subViewFolder}/index", $data);
	}
}
