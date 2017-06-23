<?php
/**
 * 投稿したPictureデータに関するモデル
 */

class Picture_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * IDに該当するカテゴリを1件取得
     * @param  int $id t_image.id
     * @return obj     t_image data
     */
    public function get_entry($id = 0)
    {
        if ( empty($id) ) {
            return false;
        }
        $query = $this->db
            ->select(['t_image.*, t_category.category_name'])
            ->join('t_category', 't_image.category = t_category.id')
            ->get_where('t_image', ['t_image.id'=>$id]);
        return $query->row();
    }


    /**
     * 新着データ取得
     * @return object
     */
    public function get_last_entries($limit = 50)
    {
        $query = $this->db->order_by('created', 'DESC')->get('t_image', $limit);
        return $query->result();
    }

    /**
     * カテゴリデータ取得
     * @param  int $category_num [カテゴリナンバー]
     * @return int Object
     */
    public function get_category_entries($category_num = '')
    {
        $query = $this->db
            ->where('category', $category_num)
            ->order_by('created', 'DESC')
            ->get('t_image');

        return $query->result();
    }

    /**
     * CategoryList 取得
     * 引数がない場合には全取得
     * あった場合には該当するIDのデータを取得する
     *
     * @param  int $[name] [<description>]
     * @return Object DBから取得したカテゴリリストのリスト
     */
    public function get_category($category_id = 0)
    {
        if ( 0 == $category_id OR empty($category_id) )
        {
            $query = $this->db->order_by('id', 'DESC')->get('t_category');
            return $query->result();
        }
        else
        {
            // IDに該当するカテゴリを1件取得
            $query = $this->db->get_where('t_category', ['id'=>$category_id], 1);
            return $query->row();
        }
    }


    /**
     * Insert Entry
     * @return [type] [description]
     */
    public function insert_entry($data = '', $post = '')
    {
        $this->category = $post['category'];
        $this->filename = $data['client_name'];
        $this->path     = $data['file_name'];
        $this->comment  = $post['comment'];
        $this->created  = date('Y-m-d H:i:s');
        $this->updated  = date('Y-m-d H:i:s');

        $this->db->insert('t_image', $this);
    }




    /**
     * [画像情報更新]
     * @return [type] [description]
     */
    public function update_entry($post = [])
    {
        if ( 0 == count($post) ) {
            return false;
        }

        // カテゴリ変更のため画像ファイル移動
        if ( $post['old_category'] != $post['category_id'] )
        {
            if ( !(is_dir($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $post['category_id'])) ) {
                mkdir( $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $post['category_id'] );
            }
            if ( file_exists($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $post['old_category'] . '/' . $post['file_path']) )
            {
                rename(
                    $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $post['old_category'] . '/' . $post['file_path'],
                    $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $post['category_id']  . '/' . $post['file_path']
                );
            }
        }

        $data = [
            'filename' => $post['filename'],
            'comment'  => $post['comment'],
            'category' => $post['category_id'],
            'updated'  => date('Y-m-d H:i:s'),
        ];
        $this->db->update('t_image', $data, ['id' => $post['id']]);

        return true;
    }


    /**
     * [登録イメージ削除]
     * @param  string $id [description]
     * @return [type]     [description]
     */
    public function delete_entry($post = [])
    {
        if ( 0 == count($post) ) {
            return false;
        }

        // ファイルを消す
        if ( file_exists($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $post['category_id'] . '/' . $post['file_path']) ) {
            unlink($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $post['category_id'] . '/' . $post['file_path']);
        }

        // イメージデータをDBから消す
        $this->db->delete('t_image', ['id' => $this->input->post('id')]);
        return true;
    }
}

