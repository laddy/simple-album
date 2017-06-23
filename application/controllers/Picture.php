<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Picture extends MY_Controller
{
    public function detail($pic_id = '')
    {
        if ( empty($pic_id) ) {
            redirect(base_url());
        }

        // ピクチャーデータ取得
        $pic_data = $this->Picture->get_entry($pic_id);
        $category = $this->Picture->get_category();
        if ( empty($pic_data) ) {
            redirect(base_url());
        }

        $data = [
            'category' => $category,
            'pic'      => $pic_data,
        ];

        $this->load->view('header');
        $this->load->view('picture_detail', $data);
        $this->load->view('footer');
    }

    public function update()
    {
        $this->Picture->update_entry($this->input->post());
        redirect('picture/detail/'.$this->input->post('id'));
        return true;
    }


    public function delete()
    {
        $this->Picture->delete_entry($this->input->post());
        redirect('category/'.$this->input->post('category_id'));
        return true;
    }
}
