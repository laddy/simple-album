<footer>
    <p> &copy; Simple Album <a href="https://github.com/laddy/simple-album">Github</a>
</footer>


<script src="<?=base_url();?>js/jquery-3.2.1.slim.min.js"></script>
<script src="<?=base_url();?>js/lightbox-plus-jquery.min.js"></script>
<script src="<?=base_url();?>js/masonry.pkgd.min.js"></script>
<script src="//unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>

<script src="<?=base_url();?>js/jquery.ui.widget.js"></script>
<script src="<?=base_url();?>js/jquery.iframe-transport.js"></script>
<script src="<?=base_url();?>js/jquery.fileupload.js"></script>

<script>
$(function(){
    $(".lazy").imagesLoaded( function(){
        $('#picture_list').masonry({
            itemSelector : '.item', 
            isFitWidth   : true
        });
    });


    var url = '<?=base_url();?>index.php/upload/picture/';
    $('#fileupload').fileupload({
        url: url + $('select[name=category]').val(),
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result, function (index, file) {
                $('#uploaded_files').append('<p>Upload完了: '+file+'</p>');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress').attr('value', progress);
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>


</body>
</html>