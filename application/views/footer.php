<footer>
    <p> &copy; Simple Album <a href="https://github.com/laddy/simple-album">Github</a>
</footer>

<script src="<?=base_url();?>js/jquery-3.2.1.slim.min.js"></script>
<script src="<?=base_url();?>js/lightbox-plus-jquery.min.js"></script>
<script src="<?=base_url();?>js/masonry.pkgd.min.js"></script>
<script>
$(function(){
    $('#picture_list').masonry({
        itemSelector : '.item', 
        isFitWidth   : true
    });

/*
    lightbox.option({
      'albumLabel': "image %1 of %2 ",
    })
*/
});
</script>
</body>
</html>