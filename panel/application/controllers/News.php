<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{

	public $viewFolder = "";

	public function __construct()
	{
		//CI_Controller kütüphanesindeki constractları da çalıştır
		parent::__construct();

		$this->viewFolder = "news";

		$this->load->model("news_model");

		if (!get_active_user()) {
			redirect(base_url('login'));
		}
	}

	public function index()
	{
		$data = new stdClass();
		$data->viewFolder = $this->viewFolder;
		$data->subViewFolder = "list";

		/* Veritabanından verilerin getirilmesi  */
		$data->newsData = $this->news_model->get_all([], 'rank ASC');

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
		$news_type = $this->input->post('news_type');

		if ($news_type == 'image') {
			if ($_FILES['img_url']['name'] == '') {
				$alert = ['text' => 'Resim seçmeniz gerekiyor!', 'type' => 'error'];
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("news/new_form"));
				die();
			}
		} else if ($news_type == 'video') {
			$this->form_validation->set_rules("video_url", "Video Url", "required|trim");
		}

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
			$insert = $this->news_model->add([
				"title" => $this->input->post("title"),
				"description" => $this->input->post("description"),
				"url" => seo($this->input->post("title")),
				"rank" => 0,
				"isActive" => 1,
				"createdAt" => date("Y-m-d H:i:s"),
			]);

			if ($insert) {
				$alert = ['text' => 'İşlem Başarılı', 'type' => 'success'];
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("product"));
			} else {
				$alert = ['text' => 'İşlem Başarısız', 'type' => 'error'];
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("product/new_form"));
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
		$data->product = $this->news_model->get(['id' => $id]);

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
			$data->product = $this->news_model->get(['id' => $id]);

			$this->load->view("{$data->viewFolder}/{$data->subViewFolder}/index", $data);
		} else {
			$update = $this->news_model->update(
				['id' => $id],
				[
					"title" => $this->input->post("title"),
					"description" => $this->input->post("description"),
					"url" => seo($this->input->post("title"))
				]
			);

			if ($update) {
				$alert = ['text' => 'Güncelleme İşlemi Başarılı', 'type' => 'success'];
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("product"));
			} else {
				$alert = ['text' => 'Güncelleme İşlemi Başarısız', 'type' => 'error'];
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("product/update"));
			}
		}
	}

	public function delete($id)
	{
		$delete = $this->news_model->delete(['id' => $id]);

		//todo alert sistemi eklenecek	
		if ($delete) {
			$alert = ['text' => 'Kayıt Başarıyla Silindi', 'type' => 'success'];
			$this->session->set_flashdata("alert", $alert);
			redirect(base_url('product'));
		} else {
			$alert = ['text' => 'Kayıt Silinemedi', 'type' => 'error'];
			$this->session->set_flashdata("alert", $alert);
			redirect(base_url('product'));
		}
	}

	public function isActiveSetter($id)
	{
		if (isset($id)) {
			$isActive = $this->input->post("data") == 'true' ? 1 : 0;

			$this->news_model->update(['id' => $id], ['isActive' => $isActive]);
		}
	}

	public function rankSetter()
	{
		$data = $this->input->post('data');
		parse_str($data, $order);

		$items = $order['order'];

		foreach ($items as $rank => $id) {
			$this->news_model->update(['id' => $id, 'rank !=' => $rank], ['rank' => $rank]);
		}
	}

	public function imageRankSetter()
	{
		$data = $this->input->post('data');
		parse_str($data, $order);

		$items = $order['order'];

		foreach ($items as $rank => $id) {
			$this->product_image_model->update(['id' => $id, 'rank !=' => $rank], ['rank' => $rank]);
		}
	}

	public function image_form($id)
	{
		$data = new stdClass();
		$data->viewFolder = $this->viewFolder;
		$data->subViewFolder = "image";
		$data->product = $this->news_model->get(['id' => $id]);
		$data->product_images = $this->product_image_model->get_all(['product_id' => $id], 'rank ASC');

		$this->load->view("{$data->viewFolder}/{$data->subViewFolder}/index", $data);
	}

	public function image_upload($id)
	{
		$filename = seo(pathinfo($_FILES['file']['name'], PATHINFO_FILENAME));
		$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

		$newFileName = $filename . '.' . $ext;
		$config = [
			"allowed_types" => "jpg|jpeg|png",
			"upload_path" => "uploads/$this->viewFolder/",
			"file_name" => $newFileName
		];




		$this->load->library("upload", $config);

		$upload = $this->upload->do_upload("file");

		if ($upload) {
			$upload_data['file_name'] = $this->upload->data("file_name");

			$this->product_image_model->add([
				'img_url' => $upload_data['file_name'],
				'rank' => 0,
				'isActive' => 1,
				'isCover' => 0,
				'createdAt' => date('Y-m-d H:i:s'),
				'product_id' => $id
			]);
		} else {
			echo 'işlem başarısız';
		}
	}

	public function refresh_image_list($id)
	{
		$data = new stdClass();
		$data->viewFolder = $this->viewFolder;
		$data->subViewFolder = "image";
		$data->product_images = $this->product_image_model->get_all(['product_id' => $id], 'rank ASC');

		$render = $this->load->view("{$data->viewFolder}/{$data->subViewFolder}/render_elements/image_list", $data, true);
		echo $render;
	}

	public function isCoverSetter($id, $parent_id)
	{
		if (isset($id) && isset($parent_id)) {
			$isCover = $this->input->post("data") == 'true' ? 1 : 0;

			$this->product_image_model->update(
				[
					'id' => $id,
					'product_id' => $parent_id
				],
				[
					'isCover' => $isCover
				]
			);

			//kapak yapılmayan kayıtlar
			$this->product_image_model->update(
				[
					'id !=' => $id,
					'product_id' => $parent_id
				],
				[
					'isCover' => 0
				]
			);

			$data = new stdClass();
			$data->viewFolder = $this->viewFolder;
			$data->subViewFolder = "image";
			$data->product_images = $this->product_image_model->get_all(['product_id' => $parent_id], 'rank ASC');

			$render = $this->load->view("{$data->viewFolder}/{$data->subViewFolder}/render_elements/image_list", $data, true);
			echo $render;
		}
	}

	public 	function imageisActiveSetter($id)
	{
		if (isset($id)) {
			$isActive = $this->input->post("data") == 'true' ? 1 : 0;

			$this->product_image_model->update(['id' => $id], ['isActive' => $isActive]);
		}
	}

	public function imageDelete($id, $parent_id)
	{
		$product = $this->product_image_model->get(['id' => $id]);
		$delete = $this->product_image_model->delete(['id' => $id]);

		//todo alert sistemi eklenecek	
		if ($delete) {
			$alert = ['text' => 'Resim Başarıyla Silindi', 'type' => 'success'];
			$this->session->set_flashdata("alert", $alert);
			unlink("uploads/$this->viewFolder/$product->img_url");
			redirect(base_url("product/image_form/$parent_id"));
		} else {
			$alert = ['text' => 'Resim Silinemedi', 'type' => 'error'];
			$this->session->set_flashdata("alert", $alert);
			redirect(base_url("product/image_form/$parent_id"));
		}
	}
}
