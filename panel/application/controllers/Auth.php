<?php

class Auth extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {

        parent::__construct();

        $this->viewFolder = "users";

        $this->load->model("user_model");
        $this->load->library('form_validation');
    }

    public function login()
    {

        if (get_active_user()) {
            redirect(base_url());
        }

        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "login";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function do_login()
    {
        $this->form_validation->set_rules("email", "E-posta", "required|trim");
        $this->form_validation->set_rules("password", "Şifre", "required|trim");

        $this->form_validation->set_message(
            array(
                "required"    => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );

        if (!$this->form_validation->run()) {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "login";
            $viewData->form_error = true;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        } else {
            $user = $this->user_model->get(['email' => $this->input->post('email'), 'password' => md5($this->input->post('password')), 'isActive' => '1']);

            if (!$user) {

                $alert = ['text' => 'Giriş Bilgileri Hatalı', 'type' => 'error'];

                $this->session->set_flashdata('alert', $alert);


                redirect(base_url('login'));
            } else {
                $this->session->set_userdata('user', $user);

                $alert = ['text' => 'Giriş Başarılı', 'type' => 'success'];

                $this->session->set_flashdata('alert', $alert);


                redirect(base_url());
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('user');
        redirect(base_url('login'));
    }
}
