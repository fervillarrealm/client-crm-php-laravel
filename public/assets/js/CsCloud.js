var CsCloud = function () {

    function initialize(){
        
    }

    return {
        
        DisplayAjaxLoader: function (){
            $("#loader").show();
        },
        
        HideAjaxLoader: function (){
            $("#loader").hide();
        },
        
        ExecuteAjax: function (pagina, entJsonPropiedades, fnRegreso, fnError, async) {
            console.log(entJsonPropiedades);
            console.log(JSON.stringify(entJsonPropiedades));
            
            $.ajax({
                type: "POST",
                async: async,
                cache: false,
                url: pagina,
                data: JSON.stringify(entJsonPropiedades),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function (msg, status, metaData) {
                    if (msg.d) {
                        if (fnRegreso != "") {
                            var fn = eval(fnRegreso);
                            fn(msg.d);
                        }
                    }
                },
                failure: function (response) {
                    alert("Existe un problema con la página favor de intentarlo mas tarde");
                },
                error: function(jqXhr, json, errorThrown){// this are default for ajax errors 
                console.log(errorThrown);
                    var errors = jqXhr.responseJSON;
                    var errorsHtml = '';
                    $.each(errors['errors'], function (index, value) {
                        errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
                    });
                    //I use SweetAlert2 for this
                    swal({
                        title: "Error " + jqXhr.status + ': ' + errorThrown,// this will output "Error 422: Unprocessable Entity"
                        html: errorsHtml,
                        width: 'auto',
                        confirmButtonText: 'Try again',
                        cancelButtonText: 'Cancel',
                        confirmButtonClass: 'btn',
                        cancelButtonClass: 'cancel-class',
                        showCancelButton: true,
                        closeOnConfirm: true,
                        closeOnCancel: true,
                        type: 'error'
                    }, function(isConfirm) {
                        if (isConfirm) {
                             $('#openModal').click();//this is when the form is in a modal
                        }
                    });
                }
            });
        }
    };
}();