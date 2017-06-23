<h2>Config</h2>

<!-- 
<h2>SiteSettings</h2>
<form action="<?=base_url();?>config/edit/">
    <fieldset>
        <div class="input-group vertical">
            site_title
            <input type="text" value="">
        </div>
    </fieldset>
</form>
-->


<h3>Category</h3>
<div class="row">
    <?php foreach ( $category as $c ) : ?>
        <?php if ( 1 != $c->id ) : ?>
        <a class="button primary" href="<?=base_url();?>index.php/config/category/<?=$c->id;?>/"><?=$c->category_name;?></a>
        <?php endif; ?>
    <?php endforeach; ?>

    <a class="button tertiary" href="<?=base_url();?>index.php/config/category/0/">新規追加</a>

</div>