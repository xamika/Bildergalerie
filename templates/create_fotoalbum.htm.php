
<link href="bower_components/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<!-- canvas-to-blob.min.js is only needed if you wish to resize images before upload.
     This must be loaded before fileinput.min.js -->
<script src="bower_components/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
<script src="bower_components/bootstrap-fileinput/js/fileinput.min.js"></script>
<!-- optionally if you need translation for your language then include
    locale file as mentioned below -->
<script src="bower_components/bootstrap-fileinput/js/fileinput_locale_de.js"></script>

<h2>Fotoalbum erstellen</h2>

<input id="input-id" type="file" class="file" data-preview-file-type="text" >


<script>
    // initialize with defaults
    $("#input-id").fileinput();

    // with plugin options
    $("#input-id").fileinput({'showUpload':false, 'previewFileType':'any'});
</script>