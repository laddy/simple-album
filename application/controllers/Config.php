<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends MY_Controller
{
    public function index()
    {
        $category = $this->Picture->get_category();

        $data = [
            'category' => $category
        ];

        $this->load->view('header');
        $this->load->view('config', $data);
        $this->load->view('footer');
    }


    public function category($category_num = '')
    {
        if ( !empty($category_num) )
        {
            $cate = $this->Picture->get_category($category_num);
            $data = [
                'category_name' => $cate->category_name,
                'category_id'   => $cate->id,
            ];
        }
        else
        {
            $data = [
                'category_name' => '新規追加',
                'category_id'   => '',
            ];
        }

        $this->load->view('header');
        $this->load->view('config_category', $data);
        $this->load->view('footer');
    }

    public function category_update()
    {
        $p = $this->input->post();
        $this->Config->upsert($p['id'], $p['category_name']);
        redirect('/config/');
        return true;
    }

    public function category_delete()
    {
        $this->Config->delete($this->input->post('id'));
        redirect('/config/');
        return true;
    }
}
