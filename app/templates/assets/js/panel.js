PNL = {

    baseUrl: '',
    uploadUrl: '',

    init: function () {
        PNL.Events.init();
        PNL.Upload.init();
    },

    Events: {
        init: function () {
            PNL.Events.confirmDelete();
            PNL.Events.deleteFile();

            $(document).on('click', 'input[aria-required]', function () {
                $(".dene").trigger("click");
            });

            $(".tile").find("img").on("click", function () {

                for (instance in CKEDITOR.instances)
                    CKEDITOR.instances[instance].updateElement();

                $("input[aria-required]").val($(this).attr("src"));
            });

        },

        deleteFile: function () {
            $(".del").on("click", function () {
                var self = $(this), u = self.prevAll(":hidden").val();
                if (confirm("Silmek istediğinize emin misiniz?")) {
                    $.post(PNL.baseUrl + "deletefile", {url: u}, function (r) {
                        if (r.result) {
                            self.prevAll("img").addClass("dn");
                            self.prevAll("img").attr("src", "");
                            self.addClass("dn");
                        }
                        else
                            alert(r);
                    }, "json");

                }
                return false;
            });
        },

        confirmDelete: function () {
            $("a.delete").on("click", function () {
                if (confirm("Silmek istediğinize emin misiniz?")) {
                    location.href = $(this).data("href");
                }
                return false;
            });
        }
    },

    Upload: {

        init: function () {
            PNL.Upload.uploadFile();
        },

        uploadFile: function () {

            $("#big_image_file").uploadify({
                height: 30,
                swf: '/templates/assets/uploadify/uploadify.swf',
                uploader: '/templates/assets/uploadify/uploadify.php',
                width: 120,
                'buttonText': 'Görsel Seç',
                'fileTypeExts': '*.jpg;*.bmp;*.png',
                'fileTypeDesc': 'Görseller (.jpg,.bmp,.png)',
                'fileSizeLimit': '10MB',
                'multi': false,
                'onUploadError': function (file, errorCode, errorMsg, errorString) {
                    alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
                },
                'onUploadSuccess': function (file, data, response) {
                    var hid = $("input[name=big_image]"), i = hid.next("img"), btn = hid.nextAll("button");
                    hid.val(data);
                    i.attr("src", PNL.uploadUrl + 'templates/uploads/' + data);
                    i.removeClass("dn");
                    btn.removeClass("dn");
                }
            });

            $("#small_image_file").uploadify({
                height: 30,
                swf: '/templates/assets/uploadify/uploadify.swf',
                uploader: '/templates/assets/uploadify/uploadify.php',
                width: 120,
                'buttonText': 'Görsel Seç',
                'fileTypeExts': '*.jpg;*.bmp;*.png',
                'fileTypeDesc': 'Görseller (.jpg,.bmp,.png)',
                'fileSizeLimit': '10MB',
                'multi': false,
                'onUploadError': function (file, errorCode, errorMsg, errorString) {
                    alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
                },
                'onUploadSuccess': function (file, data, response) {
                    var hid = $("input[name=small_image]"), i = hid.next("img"), btn = hid.nextAll("button");
                    hid.val(data);
                    i.attr("src", PNL.uploadUrl + 'templates/uploads/' + data);
                    i.removeClass("dn");
                    btn.removeClass("dn");
                }
            });
        }
    }
};

$(document).ready(function () {
    PNL.init();
});

