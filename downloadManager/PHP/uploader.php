

<div class="row justify-content-between align-items-center py-3 border-bottom mb-4">
<h3>Upload files to yours Download Manager 🚀</h3>

<a class="btn btn-primary btn-sm" href="<?php echo DOMAIN_ADMIN; ?>configure-plugin/downloadManager">Button settings</a>
</div>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.css">

<style>
    .dropzone {
        background: white;
        border-radius: 5px;
        border: 2px dashed rgb(0, 135, 247);
        border-image: none;
        width: 100%;
        margin-left: auto;
        margin-right: auto;
        margin: 50px 0;
    }
</style>

<form method="POST" action="#" class="dropzone" id="myDropzone">
    <input type="hidden" id="jstokenCSRF" name="tokenCSRF" value="<?php echo $tokenCSRF; ?>">
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
<script>
    function normalizeFileName(fileName) {
        fileName = fileName.replace(/[^a-zA-Z0-9.]/g, '-');
        return fileName;
    }

    Dropzone.options.myDropzone = {
        transformFile: function(file, done) {
            var newName = normalizeFileName(file.name);
            file.name = newName;
            done(file);
        },

        accept: function(file, done) {
            // Wyklucz niebezpieczne typy plików
            var excludedFileTypes = ['text/html', 'application/javascript', 'text/css', 'application/x-php', 'application/x-executable'];

            if (excludedFileTypes.includes(file.type)) {
                done("Nieakceptowany typ pliku.");
                return;
            }

            done();
        },


        init: function() {
            this.on("complete", function(file) {
                if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {}
            });
        }
    };
</script>

<script type='text/javascript' src='https://storage.ko-fi.com/cdn/widget/Widget_2.js'></script><script type='text/javascript'>kofiwidget2.init('you like it? Buy me coffe', '#e02828', 'I3I2RHQZS');kofiwidget2.draw();</script> 