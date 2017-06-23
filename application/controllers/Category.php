<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller
{
    public function index($category_num = '')
    {
        $category = $this->Picture->get_category();

        // カテゴリ内ピクチャー取得
        if ( !empty($category_num) )
        {
            $lastest_pic   = $this->Picture->get_category_entries($category_num);
            $cate_obj      = $this->Picture->get_category($category_num);
            $category_name = $cate_obj->category_name;
        }
        // トップページ用新着順取得
        else
        {
            $lastest_pic   = $this->Picture->get_last_entries();
            $category_name = '新着';
        }

        $data = [
            'category'      => $category,
            'pic_list'      => $lastest_pic,
            'category_num'  => $category_num,
            'category_name' => $category_name,
        ];

        $this->load->view('header');
        $this->load->view('category', $data);
        $this->load->view('footer');
    }
}
