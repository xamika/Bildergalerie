<!--
- Für den Fileupload wurde das jQuery Plugin bootstrap-fileinput verwendet
- Quelle: http://plugins.krajee.com/file-input
-->
<link href="../bower_components/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<!-- canvas-to-blob.min.js is only needed if you wish to resize images before upload.
     This must be loaded before fileinput.min.js -->
<script src="../bower_components/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
<script src="../bower_components/bootstrap-fileinput/js/fileinput.min.js"></script>
<!-- optionally if you need translation for your language then include
    locale file as mentioned below -->
<script src="../bower_components/bootstrap-fileinput/js/fileinput_locale_de.js"></script>


<h2>Fotoalbum erstellen</h2>

<input id="galery_id" name="galery_id" type="hidden" value="<?php echo getRequestParam('galery_id') ?>">
<input id="images" name="images[]" type="file" class="file-loading" accept="image/*" multiple>
<br>
<a href="index.php?id=galery&galery_id=<?php echo getValue('galery_id'); ?>" class="btn btn-primary">Weiter</a>

<script src="../js/add_images.js"></script>