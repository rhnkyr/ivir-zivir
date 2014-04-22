/*$.validator.addMethod("check", function(value, element) {
 var the_list_array = $("#some_form .super_item:checked");
 return the_list_array.length > 0;
 }, "* Please check at least one check box");*/

var FormValidation = function () {


    return {
        //main function to initiate the module

        url: "",

        init: function () {

            FormValidation.admin();
            FormValidation.content();
        },

        admin: function () {

            var adminForm = $("#admin_form");
            var adminError = $('.alert-error', adminForm);


            adminForm.validate({
                errorElement: 'span', //default input error message container
                errorClass  : 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore      : "",
                rules       : {
                    user_name: {
                        minlength: 2,
                        required : true
                    },
                    password : {
                        minlength: 6,
                        required : true
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    adminError.show();
                    App.scrollTo(adminError, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.help-inline').removeClass('ok'); // display OK icon
                    $(element)
                        .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change dony by hightlight
                    $(element)
                        .closest('.control-group').removeClass('error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                        .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
                },

                submitHandler: function (form) {
                    var u = FormValidation.url + "addadmin";
                    $.post(u, adminForm.serialize(), function (r) {
                        if (r.return) {
                            location.href = FormValidation.url + "adlist";
                        }
                    }, "json");
                }
            });
        },

        content: function () {
            var contentForm = $("#content_form");
            var contentError = $('.alert-error', contentForm);


            contentForm.validate({
                errorElement: 'span', //default input error message container
                errorClass  : 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore      : "",
                rules       : {
                    title: {
                        required: true
                    },
                    location    : {
                        required: true
                    },
                    big_image : {
                        required: true
                    },
                    small_image : {
                        required: true
                    },
                    link : {
                        required: true
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    contentError.show();
                    App.scrollTo(contentError, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.help-inline').removeClass('ok'); // display OK icon
                    $(element)
                        .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change dony by hightlight
                    $(element)
                        .closest('.control-group').removeClass('error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                        .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
                },

                submitHandler: function (form) {
                    var u = FormValidation.url + "addcontent";
                    $.post(u, contentForm.serialize(), function (r) {
                        if (r.result) {
                            location.href = FormValidation.url + "conlist";
                        }
                    }, "json");
                }
            });
        }
    };

}();