<h2><strong><?=$category_name;?></strong> 編集中</h2>

<form action="<?=base_url();?>index.php/config/category_update/" method="post">
    <input type="hidden" name="id" value="<?=$category_id;?>">
    <input type="text" name="category_name" value="<?=!empty($category_id) ? $category_name : '';?>">
    <input type="submit" class="button" value="更新">
</form>


<?php if ( !empty($category_id) ) : ?>
<form action="<?=base_url();?>index.php/config/category_delete/" method="post">
    <input type="hidden" name="id" value="<?=$category_id;?>">
    <input type="submit" class="button" value="削除">
</form>
<?php endif; ?>

