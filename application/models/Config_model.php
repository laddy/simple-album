<?php
/**
 * 投稿したPictureデータに関するモデル
 */

class Config_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function upsert($id = '', $name = '')
    {
        if ( empty($name) ) {
            return false;
        }

        $data = ['category_name' => $name];

        // insert
        if ( empty($id) )
        {
            $this->db->insert('t_category', $data);
            mkdir( $_SERVER['DOCUMENT_ROOT'].'/upload/'.$this->db->insert_id() );
        }
        // update
        else
        {
            $this->db->update('t_category', $data, ['id' => $id]);
        }

        return true;
    }


    public function delete($id = '')
    {
        if ( empty($id) ) {
            return false;
        }
        // カテゴリに属するファイル移動
        $map = directory_map('./upload/'.$id, 1);
        foreach ( $map as $q )
        {
            rename(
                $_SERVER['DOCUMENT_ROOT'].'/upload/'.$id.'/'.$q,
                $_SERVER['DOCUMENT_ROOT'].'/upload/1/'.$q
            );
        }
        rmdir($_SERVER['DOCUMENT_ROOT'].'/upload/'.$id);

        // カテゴリをデータベースから消す
        $this->db->delete('t_category', ['id' => $id]);

        // 消されたカテゴリに属していたデータをその他へ移動
        $data = [
            'category' => 1, // その他
            'updated'  => date('Y-m-d H:i:s'),
        ];
        $this->db->update('t_image', $data, ['category' => $id]);
        return true;
    }

}