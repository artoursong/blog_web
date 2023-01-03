var Info = {
    GLOBAL: {},

    CONSTS: {
        
    },

    SELECTORS: {
        profileField: ".profile-field a",
        fieldInfo: ".field-information",
    },

    init: function () {
        Info.setUp();
        
        Info.changePage();
    },

    setUp: function() {
        $(Info.SELECTORS.profileField + `[index=1]`).addClass('active');
        Info.renderPage();
    },

    renderPage: function() {
        var id = window.userID;
        $.ajax({
            type: 'GET',
            url: '/user/information/' + id.toString(),
            success: function (response) {
                $(Info.SELECTORS.fieldInfo).html(response)
            }
        })
    },

    changePage: function() {
        $(Info.SELECTORS.profileField).on("click", function(event) {
            event.preventDefault();
            let selectItem = $(this).attr("index");
            $(Info.SELECTORS.profileField + `[index=${Info.GLOBAL.indexCurrent}]`).removeClass('active');
            $(Info.SELECTORS.profileField + `[index=${selectItem}]`).addClass('active');
            Info.GLOBAL.indexCurrent = selectItem;
            Info.renderPage();
        })
    },

};

$(document).ready(function () {
    Info.init();
});