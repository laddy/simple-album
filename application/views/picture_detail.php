<h2>画像詳細</h2>

<h3>[<?=$pic->category_name;?>] <?=$pic->filename;?></h3>

<div class="row">
    <div class="col-md-6">
        <img src="<?=base_url();?>upload/<?=$pic->category;?>/<?=$pic->path;?>">
    </div>
    <div class="col-md-6">
        <form action="<?=base_url();?>index.php/picture/update/" method="post">
            <fieldset>
                
            <legend>画像詳細編集</legend>
            <div class="row responsive-label">
                <div class="col-sm-12 col-md-2">タイトル</div>
                <div class="col-sm-12 col-md">
                    <input type="text" name="filename" value="<?=$pic->filename;?>">
                </div>
            </div>
            <div class="row responsive-label">
                <div class="col-sm-12 col-md-2">コメント</div>
                <div class="col-sm-12 col-md">
                    <input type="text" name="comment" value="<?=$pic->comment;?>">
                </div>
            </div>
            <div class="row responsive-label">
                <div class="col-sm-12 col-md-2">カテゴリ</div>
                <div class="col-sm-12 col-md">
                    <select name="category_id">
                        <?php foreach ( $category as $c ) : ?>
                        <option value="<?=$c->id;?>" <?=($pic->category == $c->id) ? 'selected' : ''; ?>><?=$c->category_name;?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <p>更新日: <?=$pic->updated;?>
            <p>登録日: <?=$pic->created;?>

            <input type="hidden" name="id"           value="<?=$pic->id;?>">
            <input type="hidden" name="old_category" value="<?=$pic->category;?>">
            <input type="hidden" name="file_path"    value="<?=$pic->path;?>">

            <p><input type="submit" value="更新">

            </fieldset>
        </form>

        <form action="<?=base_url();?>index.php/picture/delete/" method="post">
            <div class="row responsive-label">
                <div class="col-sm-offset-10">
                    <input type="hidden" name="id"           value="<?=$pic->id;?>">
                    <input type="hidden" name="category_id"  value="<?=$pic->category;?>">
                    <input type="hidden" name="file_path"    value="<?=$pic->path;?>">
                    <p><input type="submit" value="削除">
                </div>
            </div>
        </form>
    </div>

</div>
