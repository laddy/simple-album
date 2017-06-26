<div class="row">
    <?php foreach ( $category as $c ) : ?>
        <a class="button<?=($c->id == $category_num) ? ' primary' : '';?>" href="<?=base_url();?>category/<?=$c->id;?>/"><?=$c->category_name;?></a>
    <?php endforeach; ?>
</div>

<h2><?=$category_name;?></h2>

<div id="picture_list">
    <?php foreach ( $pic_list as $p ) : ?>
    <div class="item">
        <!-- <a class="gallery" href="<?=base_url();?>index.php/picture/detail/<?=$p->id;?>" data-lightbox="image_<?=$p->id;?>" data-title="<?=$p->filename;?>"> -->
        <a
            class="gallery"
            href="<?=base_url();?>upload/<?=$p->category;?>/<?=$p->path;?>"
            data-lightbox="image"
            data-title='<?=$p->filename;?> &lt;a href="<?=base_url();?>index.php/picture/detail/<?=$p->id;?>"&gt;Edit&lt;/a&gt;'
        >
            <img src="<?=base_url();?>upload/<?=$p->category;?>/<?=$p->path;?>">
        </a>
    </div>
    <?php endforeach; ?>
</div>

