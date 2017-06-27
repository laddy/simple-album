<?=!empty($error) ? $error : '';?>

<div class="row">
    <div class="col-md-6">
        <form action="<?=base_url();?>index.php/upload/picture" method="post" enctype='multipart/form-data'>
            <fieldset>
                <legend>画像投稿</legend>

                <div class="input-group vertical">
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <input id="fileupload" type="file" name="pic" multiple>
                        <label for="fileupload" class="button">Select files...</label>
                    </span>

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
    </div>

    <div class="col-md-6">
        <progress id="progress" max="100"></progress>
        <div id="uploaded_files"></div>
    </div>
</div>

