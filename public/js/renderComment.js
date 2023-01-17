var Comment = {
    GLOBAL: {},

    CONSTS: {},

    SELECTORS: {
        reply_form: ".reply-form",
        reply_button: ".action .reply",
        reply_submit: ".reply-button"
    },

    init: function() {
        Comment.renderComment();
        Comment.replyFunction();
    },

    renderComment: function() {
        blog_id = window.blog_id;
        $.ajax({
            type: 'GET',
            url: 'loadcomment/' + blog_id.toString(),
            success: function (response) {
                
            }
        })
    },

    replyFunction: function() {
        $(Comment.SELECTORS.reply_button).on("click", function(e) {
            e.preventDefault();
            let selectalt = $(this).attr("alt");
            let formSubmit =    "<textarea class='reply-comment'>Your Comment</textarea> <div class='submit-comment reply-submit'> <button class='reply-button' type='submit'>Comment</button> </div>";
            $(Comment.SELECTORS.reply_form + `[alt=${selectalt}]`).html(formSubmit);
        })
    },

    replySubmit:function() {
        $(Comment.SELECTORS.reply_button).on("click", function(e) {
            e.preventDefault();
            
            $.ajax({
                url: ""
            })
        }) 
    }
    


};

$(document).ready(function () {
    Comment.init();
})