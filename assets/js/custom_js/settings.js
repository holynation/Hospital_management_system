"use strict";

$(document).ready(function(){
	$("#settings_form").bootstrapValidator({
        fields: {
            system_title: {
                validators: {
                    notEmpty: {
                        message: 'The title is required'
                    }
                },
                required: true,
                minlength: 2
            }        }
    }).on('reset', function (event) {
        $('#settings_form').data('bootstrapValidator').resetForm();
    });

        $('#edit_user').bootstrapValidator({
        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: 'The username is required and cannot be empty'
                    }
                }
            },
            first_name: {
                validators: {
                    notEmpty: {
                        message: 'The field is required and cannot be empty'
                    }
                }
            },
            last_name: {
                validators: {
                    notEmpty: {
                        message: 'The field is required and cannot be empty'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required'
                    },
                    regexp: {
                        regexp: /^\S+@\S{1,}\.\S{1,}$/,
                        message: 'Please enter valid email format'
                    }
                }
            },
            phone_no: {
                validators: {
                    notEmpty: {
                        message: 'The number is required and cannot be empty'
                    },
                    regexp: {
                        regexp: /[2-9]{2}\d{8}/,
                        message: 'The phone number can only consist of numbers'
                    }
                }
            },
            current_password: {
                validators: {

                    notEmpty: {
                        message: 'Please provide a password'
                    }
                }
            },
            password: {
                validators: {

                    notEmpty: {
                        message: 'Please provide a password'
                    }
                }
            },
            confirm_password: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'password',
                        message: 'Please enter the password same as above'
                    }
                }
            }
        }
    }).on('reset', function (event) {
        $('#edit_user').data('bootstrapValidator').resetForm();
    });

});



