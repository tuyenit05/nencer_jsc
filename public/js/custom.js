/** 
* Using jQuery here
*/
$(document).ready(function () {
    /**
     *  Using jQuery validate
     * 
     * Validate for Login form
     */
    $('#login_form').validate({
        rules: {
            'email': {
                'required': true
            },
            'password': {
                'required': true,
                'minlength': 3
            }
        },
        messages: {
            'email': {
                'required': 'Bạn hãy nhập email!'
            },
            'password': {
                'required': 'Bạn hãy nhập mật khẩu',
                'minlength': 'Mật khẩu phải nhiều hơn 3 kí tự.'
            }
        },
        submitHandler: function (form) {
            // Submit data to server
            form.submit();
        }
    });
    /**
    *  Using jQuery validate
    * 
    * Validate for Create Receipts form
    */
    $('#form_create_receipts').validate({
        rules: {
            'receipt_name': {
                'required': true,
                'minlength': 3,
                'maxlength': 255
            },
            'delivery_date': {
                'required': true
            },
            'image': {
                'required': true,
                'accept': "image/jpg,image/jpeg"
            }
        },
        messages: {
            'receipt_name': {
                'required': 'bạn hãy nhập tên đơn hàng.',
                'minlength': 'Tên đơn hàng phải nhiều hơn 3 kí tự.',
                'maxlength': 'Tên đơn hàng phải ít hơn 255 kí tự.'
            },
            'delivery_date': {
                'required': 'Bạn hãy chọn ngày giao hàng.'
            },
            'image': {
                'required': 'Bạn hãy tải hình ảnh hóa đơn.',
                'accept': 'Định dạng hình ảnh hóa đơn không đúng.'
            }
        },
        submitHandler: function (form) {
            // Submit data to server
            form.submit();
        }
    });
    /**
     *  Using jQuery validate
     * 
     * Validate for Create Receipts form
     */
    $('#storage-form').validate({
        rules: {
            'name': {
                'required': true,
            },
            'cost': {
                'required': true
            },
        },
        messages: {
            'name': {
                'required': 'bạn hãy nhập tên kho.',
            },
            'cost': {
                'required': 'Kho phải có giá duy trì.'
            },
        },
        submitHandler: function (form) {
            // Submit data to server
            form.submit();
        }
    });
    /**
     *  Using jQuery validate
     * 
     * Validate for Create employee.
     */
    $('#storage-form').validate({
        rules: {
            'email': {
                'required': true,
                'maxlength':29
            },
            'password': {
                'required': true,
                'minlength': 8,
                'maxlength': 29
            }
        },
        messages: {
            'email': {
                'required': 'bạn hãy nhập email.',
                'maxlength': 'Email không quá 29 kí tự.'
            },
            'password': {
                'required': 'Bạn hãy nhập mật khẩu.',
                'minlength': 'Mật khẩu phải nhiều hơn 8 kí tự.',
                'maxlength': 'Mật khẩu phải ít hơn 29 kí tự.'
            },
        },
        submitHandler: function (form) {
            // Submit data to server
            form.submit();
        }
    });
    /**
     *  Using jQuery validate
     * 
     * Validate for edited employee.
     */
    $('#employee_edit_form').validate({
        rules: {
            'password': {
                'required': true,
                'minlength': 8,
                'maxlength': 29
            }
        },
        messages: {
            'password': {
                'required': 'Bạn hãy nhập mật khẩu.',
                'minlength': 'Mật khẩu phải nhiều hơn 8 kí tự.',
                'maxlength': 'Mật khẩu phải ít hơn 29 kí tự.'
            },
        },
        submitHandler: function (form) {
            // Submit data to server
            form.submit();
        }
    });  
    

})