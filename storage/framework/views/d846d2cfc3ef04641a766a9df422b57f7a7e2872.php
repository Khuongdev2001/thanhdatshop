<script src="https://cdn.tiny.cloud/1/vbzkm84qcbxrq5hsachp4rnckre9eor9ynuypftf4ue9e8g3/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#post_content,#product_content,#product_description,#page_content',
        /* without images_upload_url set, Upload tab won't show up*/
        images_upload_url: '/fadfds',
        language:'vi',
        language_url:"<?php echo e(asset('source/admin/tiny_mce/langs/vi.js')); ?>",
        contextmenu:false,
        plugins: [
        'autolink lists link image lineheight table media toc textcolor',
        ],
        menubar:"file edit view insert format tools table help",
        toolbar: 'toc| undo redo | bold italic underline strikethrough | fontsizeselect fontselect| forecolor backcolor | image media link | alignleft aligncenter alignright alignjustify '+'|table| removeformat',
        content_style: '',
        /* we override default upload handler to simulate successful upload*/
        images_upload_handler: function(blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '<?php echo e(route("admin.editor.upload.image")); ?>');
            xhr.upload.onprogress = function(e) {
                progress(e.loaded / e.total * 100);
            };
            xhr.responseType = 'json';
            xhr.onload = function() {
                if (xhr.status === 403) {
                    failure('HTTP Error: ' + xhr.status, { remove: true });
                    return;
                }
                if (xhr.status < 200 || xhr.status >= 300) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                success(this.response.url);
            };

            xhr.onerror = function() {
                failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };
            formData = new FormData();
            formData.append("_token", $("meta[name='csrf-token']").attr("content"));
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        },
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
</script>
<?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/admin/include/tinyEditor.blade.php ENDPATH**/ ?>