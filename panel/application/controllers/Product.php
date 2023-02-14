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

		$this->load->model("product_model");
	}

	public function index()
	{
		$data = new stdClass();
		$data->viewFolder = $this->viewFolder;
		$data->subViewFolder = "list";

		/* Veritabanından verilerin getirilmesi  */
		$data->products = $this->product_model->get_all();

		$this->load->view("{$data->viewFolder}/{$data->subViewFolder}/index", $data);
	}

	public function new_form()
	{
		$data = new stdClass();
		$data->viewFolder = $this->viewFolder;
		$data->subViewFolder = "add";

		$this->load->view("{$data->viewFolder}/{$data->subViewFolder}/index", $data);
	}

	public function save()
	{
		$this->load->library("form_validation");

		//kurallar yazılır
		$this->form_validation->set_rules("title", "Başlık", "required|trim");

		$this->form_validation->set_message([
			'required' => "{field} alanını girmelisiniz",
		]);

		//form validation çalıştırılır
		$validate = $this->form_validation->run();

		if (!$validate) {
			// echo validation_errors();

			$data = new stdClass();
			$data->viewFolder = $this->viewFolder;
			$data->subViewFolder = "add";
			$data->form_error = true;

			$this->load->view("{$data->viewFolder}/{$data->subViewFolder}/index", $data);
		} else {
			$insert = $this->product_model->add([
				"title" => $this->input->post("title"),
				"description" => $this->input->post("description"),
				"url" => seo($this->input->post("title")),
				"rank" => 0,
				"isActive" => 1,
				"createdAt" => date("Y-m-d H:i:s"),
			]);

			//todo alert sistemi eklenecek
			if ($insert) {
				redirect(base_url("product"));
			} else {
				redirect(base_url("product/add"));
			}
		}




		//başarılı ise

		//kayıt işlemi başlar

		//başarısız ise

		//hata ekranda gösterilir
	}

	public function update_form($id)
	{
		$data = new stdClass();
		$data->viewFolder = $this->viewFolder;
		$data->subViewFolder = "update";

		/* Veritabanından verilerin getirilmesi  */
		$data->product = $this->product_model->get(['id' => $id]);

		$this->load->view("{$data->viewFolder}/{$data->subViewFolder}/index", $data);
	}

	public function update($id)
	{
		$this->load->library("form_validation");

		$this->form_validation->set_rules("title", "Başlık", "required|trim");

		$this->form_validation->set_message([
			'required' => "{field} alanını girmelisiniz",
		]);

		$validate = $this->form_validation->run();

		if (!$validate) {

			$data = new stdClass();
			$data->viewFolder = $this->viewFolder;
			$data->subViewFolder = "update";
			$data->form_error = true;
			$data->product = $this->product_model->get(['id' => $id]);

			$this->load->view("{$data->viewFolder}/{$data->subViewFolder}/index", $data);
		} else {
			$update = $this->product_model->update(
				['id' => $id],
				[
					"title" => $this->input->post("title"),
					"description" => $this->input->post("description"),
					"url" => seo($this->input->post("title"))
				]
			);

			//todo alert sistemi eklenecek
			if ($update) {
				redirect(base_url("product"));
			} else {
				redirect(base_url("product/update"));
			}
		}
	}

	public function delete($id)
	{
		$delete = $this->product_model->delete(['id' => $id]);

		//todo alert sistemi eklenecek
		if ($delete) {
			redirect(base_url('product'));
		} else {
			redirect(base_url('product'));
		}
	}
}
