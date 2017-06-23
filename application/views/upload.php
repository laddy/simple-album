<?=!empty($error) ? $error : '';?>
<form action="<?=base_url();?>index.php/upload/picture" method="post" enctype='multipart/form-data'>
    <fieldset>
        <legend>画像投稿</legend>

        <div class="input-group vertical">
            <input type="file" id="file-input" name="pic">
            <label for="file-input" class="button">Upload file...</label>

            category:
            <select name="category">
                <?php foreach ( $category as $c ) : ?>
                    <option value="<?=$c->id;?>"><?=$c->category_name;?></option>
                <?php endforeach; ?>
            </select>

            コメント:
            <input type="text" name="comment">
        </div>

        <div class="input-group">
            <input type="submit">
        </div>

    </fieldset>
</form>

