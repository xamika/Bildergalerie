/**
 * Created by jajaj on 18.05.2016.
 * Für den Fileupload wurde das jQuery Plugin bootstrap-fileinput verwendet
 * Quelle: http://plugins.krajee.com/file-input
 */

$(document).on("ready", function() {
    $("#images").fileinput({
        language: "de",
        uploadUrl: "../php/upload.php", // server upload action
        uploadAsync: true,
        maxFileCount: 100,
        allowedFileExtensions: ['jpg'],
        uploadExtraData: function() {
            return {
                galery_id: $("#galery_id").val(),
            };
        }
    });
});