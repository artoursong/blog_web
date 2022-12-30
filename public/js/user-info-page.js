
var Info = {
    GLOBAL: {},

    CONSTS: {},

    SELECTORS: {
        fieldInfo: ".field-information",
        changeInfoButton: ".information-page .info-footer>button",
        name: "input[name=name]",
        username: "input[name=username]",
        email: "input[name=email]"
    },

    init: function () {
        Info.updateInfo();
    },

    updateInfo: function() {
        $(Info.SELECTORS.changeInfoButton).on('click', function() {
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
                },
                success: function (response) {
                    $(Info.SELECTORS.fieldInfo).html(response);
                }
            })
        })
    }
};

$(document).ready(function () {
    Info.init();
});