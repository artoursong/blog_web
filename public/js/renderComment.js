var Comment = {
    GLOBAL: {},

    CONSTS: {},

    SELECTORS: {
        reply_form: ".reply-form",
        reply: ".comment .action .reply",
        reply_comment_button: ".reply-submit>button",
        comment: ".comment",
        text_comment: ".text-comment",
        add_comment_button: ".submit-comment>button",
        reply_comment: ".reply-comment"
    },

    init: function() {
        Comment.replyFunction();
        Comment.addComment();
        Comment.addReply();
    },

    checkExistsImage: function(path) {
        var http = new XMLHttpRequest();
        http.open('HEAD', path, false);
        http.send();
        if (http.status!=404) return true;
        return false;
    },


    replyFunction: function() {
        $(Comment.SELECTORS.reply).on("click", function(e) {
            e.preventDefault();
            let selectalt = $(this).attr("alt");
            let formSubmit = "<textarea class='reply-comment'>Your Comment</textarea>" 
                            + "<div class='reply-submit'>" 
                            + "<button class='reply-button' type='submit'>Comment</button> </div>";
            $(Comment.SELECTORS.reply_form + `[alt=${selectalt}]`).html(formSubmit);
        })
    },

    addComment: function() {
        $(Comment.SELECTORS.add_comment_button).on("click", function(e) {
            e.preventDefault();
            var host = 'http://' + window.location.host;

            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: 'comment/' + window.blog_id,
                data: {
                    comment : $(Comment.SELECTORS.text_comment).val()
                },
            })

            .done(function(response) {
                let html = "";

                imagePath = host + '/images/' + response[0].image_url,
                    
                html += '<div class="comment-parent comment-item">'
                        + '<div class= "d-flex">';

                if(Comment.checkExistsImage(imagePath)) html += '<img src="' + `${imagePath}`+ '" alt="">';
                else html += '<img src="http://127.0.0.1:8000/images/user.svg" alt="">';
                
                html += '<div class="comment-data d-flex">' 
                        + '<p class="user-comment">' + `${response[0].username}` + '</p>'
                        + '<p class="comment-text">' + `${response[0].content}` + '</p>'
                        + '</div>'
                        + '</div>'
                        + '<div class="action">'
                        + '<a class="like" href="">like</a>'
                        + '<a class="reply"' + `alt=${response[0].id}` +  '>reply</a>';
                if (response[0].user_id == window.auth_id) html += '<a href="">edit</a>'
                
                html += '</div>' + '<div class="reply-form"'+ `alt=${response[0].id}` + '></div>'
                        + '</div>';

                $(Comment.SELECTORS.comment).prepend(html)
            })
            .fail(function( xhr, status, errorThrown ) {
                if(errorThrown == 'Unauthorized') { 
                    window.location.href = "http://127.0.0.1:8000/login";
                }
                // alert( "Sorry, there was a problem!" );
                // console.log( "Error: " + errorThrown );
                // console.log( "Status: " + status );
                // console.dir( xhr );
            })
             
        })
    },

    addReply: function() {
        $(Comment.SELECTORS.reply_comment_button).on("click", function(e) {
            e.preventDefault();

            let comment_id = $(this).attr('alt');
            var host = 'http://' + window.location.host;

            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: 'replycomment/' + comment_id,
                data: {
                    comment: $(Comment.SELECTORS.reply_comment).val(),
                    user_id: window.auth_id,
                    blog_id: window.blog_id
                }
            })

            .done(function(response) {
                alert('ist okay');
            })

            .fail(function(xhr, status, errorThrown) {
                alert( "Sorry, there was a problem!" );
                console.log( "Error: " + errorThrown );
                console.log( "Status: " + status );
                console.dir( xhr );
            })
        })
    }

};

$(document).ready(function () {
    Comment.init();
})