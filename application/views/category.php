<h2><?=$category_name;?></h2>

<label for="modal-toggle">Show modal</label>
<input id="modal-toggle" type="checkbox"/>
<div class="modal">
  <div class="card">
    <label for="modal-toggle" class="close"></label>
    <h3 class="section">Modal</h3>
    <p class="section">This is a modal window!</p>
  </div>
</div>


<div class="row">
    <?php foreach ( $category as $c ) : ?>
        <a class="button<?=($c->id == $category_num) ? ' primary' : '';?>" href="<?=base_url();?>category/<?=$c->id;?>/"><?=$c->category_name;?></a>
    <?php endforeach; ?>
</div>


<div id="picture_list">
    <?php foreach ( $pic_list as $p ) : ?>
    <div class="item">
        <a class="gallery" href="<?=base_url();?>index.php/picture/detail/<?=$p->id;?>">
            <img src="<?=base_url();?>upload/<?=$p->category;?>/<?=$p->path;?>">
        </a>
    </div>
    <?php endforeach; ?>
</div>

