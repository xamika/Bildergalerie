/**
 * Created by jajaj on 18.05.2016.
 */

$(document).on("ready", function() {
    $("#images").fileinput({
        uploadUrl: "../php/upload.php", // server upload action
        uploadAsync: true,
        maxFileCount: 10,
        uploadExtraData: function() {
            return {
                galery_id: $("#galery_id").val(),
            };
        },
    });
});