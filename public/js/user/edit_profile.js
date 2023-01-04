var Info = {
    GLOBAL: {
    },

    CONSTS: {},

    SELECTORS: {
        updateButton: ".info-footer>button",
        name: "input[name=name]",
        username: "input[name=username]",
        email: "input[name=email]",
        photo: "input[name=image]",
    },

    init: function () {
        Info.updateInfo();
    },

    updateInfo: function() {
        $(Info.SELECTORS.updateButton).on('click', function() {
            var id = window.userID;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/user/' + id.toString(),
                data: {
                    username : $(Info.SELECTORS.username).val(),
                    name : $(Info.SELECTORS.name).val(),
                    email : $(Info.SELECTORS.email).val(),
                    image : $(Info.SELECTORS.photo).val(),
                },
                success: function () {
                   
                },
                error :function( data ) {
                    if( data.status === 422 ) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function (key, value) {
                            // console.log(key+ " " +value);
                        $('#response').addClass("alert alert-danger");
                            if($.isPlainObject(value)) {
                                $.each(value, function (key, value) {                       
                                    console.log(key+ " " +value);
                                    $('#response').show().append(value+"<br/>");
                                });
                            }
                            else{
                                $('#response').show().append(value+"<br/>"); //this is my div with messages
                            }
                        });
                    }
                }
            })
        })
    },

};

$(document).ready(function () {
    Info.init();
});