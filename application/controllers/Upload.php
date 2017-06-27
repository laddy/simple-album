<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends MY_Controller
{
    public function index()
    {
        $category = $this->Picture->get_category();

        $data = [
            'category'     => $category,
        ];

        $this->load->view('header');
        $this->load->view('upload', $data);
        $this->load->view('footer');
    }

    public function picture()
    {
        $post = $this->input->post();
        if ( empty($post['category']) ) {
            $post['category'] = $category_id;
        }
        $config = [
            'upload_path'     => $_SERVER['DOCUMENT_ROOT'].'/upload/'.$post['category'].'/',
            'allowed_types'   => 'gif|jpg|png',
            'encrypt_name'    => true,
        ];
        $this->load->library('upload', $config);

        // Upload失敗
        if ( !($this->upload->do_upload('pic')) )
        {
            $error = ['error' => $this->upload->display_errors()];
            $this->load->view('header');
            $this->load->view('upload', $error);
            $this->load->view('footer');
        }
        // Upload成功
        else
        {
            $this->Picture->insert_entry($this->upload->data(), $post);
            echo json_encode(['name' => $this->upload->data('client_name')]);
            exit();
            // $data = ['upload_data' => $this->upload->data()];
//            redirect(base_url().'category/'.$post['category']);
        }
    }

    public function ajax_upload($category_id = 1)
    {
        $this->picture($category_id);
        exit();
    }
}
