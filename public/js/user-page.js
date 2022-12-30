var Info = {
    GLOBAL: {
        indexCurrent: 1,
    },

    CONSTS: {
        
    },

    SELECTORS: {
        profileField: ".profile-field a",
        fieldInfo: ".field-information",
    },

    init: function () {
        Info.setUp();
        Info.changePage();
        // Info.renderPage();
    },

    setUp: function() {
        $(Info.SELECTORS.profileField + `[index=${Info.GLOBAL.indexCurrent}]`).addClass('active');
        // Info.renderPage();
    },

    // changeEvent: function() {
    //     $(Info.SELECTORS.profileField).on("click", function (event) {
    //         console.log(Info.GLOBAL.indexCurrent);
    //         event.preventDefault();
    //         // let selectItem = $(this).attr("index");
    //         // $(Info.SELECTORS.profileField + `[index=${Info.GLOBAL.indexCurrent}]`).removeClass('active');
    //         // $(Info.SELECTORS.profileField + `[index=${selectItem}]`).addClass('active');
    //         // Info.GLOBAL.indexCurrent = selectItem;
    //         // // Info.renderPage();
    //     })
    // },

    changePage: function() {
        $(Info.SELECTORS.profileField).on("click", function(event) {
            event.preventDefault();
            let selectItem = $(this).attr("index");
            $(Info.SELECTORS.profileField + `[index=${Info.GLOBAL.indexCurrent}]`).removeClass('active');
            $(Info.SELECTORS.profileField + `[index=${selectItem}]`).addClass('active');
            Info.GLOBAL.indexCurrent = selectItem;
            Info.renderPage();
            console.log(Info.GLOBAL.indexCurrent);
        })
    },

    renderPage: function() {
        var id = window.userID;
        
        if (Info.GLOBAL.indexCurrent == 1) {
            $.ajax({
                type: 'GET',
                url: '/user/information/' + id.toString(),
                success: function (response) {
                    $(Info.SELECTORS.fieldInfo).html(response)
                }
            })
        }
        if (Info.GLOBAL.indexCurrent == 2) {
            $.ajax({
                type: 'GET',
                url: '/user/avatar/' + id.toString(),
                success: function (response) {
                    $(Info.SELECTORS.fieldInfo).html(response)
                }
            })
        }
    },
};

$(document).ready(function () {
    Info.init();
});