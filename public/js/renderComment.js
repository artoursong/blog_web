var Comment = {
    GLOBAL: {},

    CONSTS: {},

    SELECTORS: {
        reply_form: ".reply-form",
        reply: ".comment .action .reply",
        reply_comment_button: ".reply-submit>button",
        comment: ".comment",
        comment_parent: ".comment-parent",
        text_comment: ".text-comment",
        add_comment_button: ".submit-comment>button",
        reply_comment: ".reply-comment",
        comment_item: ".comment .comment-item",
        like: ".comment .action .like",
        like_count: ".like-count",
        action: ".comment .action",
        delete: ".comment .action .delete",
        edit: ".comment .action .edit",
        update_comment_button: ".update-submit>button",
        update_comment: ".update-comment",
        comment_text: ".comment-text",
        like_count: ".like-count"
    },

    init: function() {
        Comment.replyFunction();
        Comment.checkAuthLike();
        Comment.addComment();
        Comment.addReply();
        Comment.likeComment();
        Comment.deleteComment();
        Comment.updateForm();
        Comment.updateComment();
    },

    checkExistsImage: function(path) {
        var http = new XMLHttpRequest();
        http.open('HEAD', path, false);
        http.send();
        if (http.status!=404) return true;
        return false;
    },

    checkAuthLike: function() {
        $.ajax({
            type: 'GET',
            url: 'checklike/' + window.blog_id,
        })

        .done(function(response) {
            if (response != "") {
                response.forEach(function(item, index) {
                    $(Comment.SELECTORS.like + `[alt=${item.id_object}]`).addClass("liked");
                })
            }
        })

        .fail(function(xhr, status, errorThrown) {
            alert( "Sorry, there was a problem!" );
            console.log( "Error: " + errorThrown );
            console.log( "Status: " + status );
            console.dir( xhr );
        })
    },

    replyFunction: function() {
        $(Comment.SELECTORS.reply).on("click", function(e) {
            e.preventDefault();
            let selectalt = $(this).attr("alt");
            let formSubmit = '<textarea class="reply-comment">Your Comment</textarea>' 
                            + '<div class="reply-submit">' 
                            + '<button class="reply-button" type="submit"' + `alt=${selectalt}` + '>Comment</button> </div>';
            $(Comment.SELECTORS.reply_form + `[alt=${selectalt}]`).html(formSubmit);
        })
    },

    updateForm: function() {
        $(Comment.SELECTORS.edit).on("click", function(e) {
            e.preventDefault();
            let selectalt = $(this).attr("alt");
            let formSubmit = '<textarea class="update-comment"></textarea>' 
                            + '<div class="update-submit">' 
                            + '<button class="update-button" type="submit"' + `alt=${selectalt}` + '>Update</button> </div>';
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
                    
                html += '<div class="comment-parent comment-item"' + `alt=${response[0].id}` + '">'
                        + '<div class= "d-flex">';

                if(Comment.checkExistsImage(imagePath)) html += '<img src="' + `${imagePath}`+ '" alt="">';
                else html += '<img src="http://127.0.0.1:8000/images/user.svg" alt="">';
                
                html += '<div class="comment-data d-flex">' 
                        + '<p class="user-comment">' + `${response[0].username}` + '</p>'
                        + '<p class="comment-text">' + `${response[0].content}` + '</p>'
                        + '</div>'
                        + '</div>'
                        + '<div class="action">'
                        + '<a class="like"' + `alt=${response[0].id}` +  '>like</a>'
                        + '<a class="reply"' + `alt=${response[0].id}` +  '>reply</a>';
                if (response[0].user_id == window.auth_id) html += '<a href="">edit</a>'
                html += '<a class="delete"' + `alt=${response[0].id}` +  '>delete</a>'
                        + '<div>'
                        + '<span class="like-count" alt="' + `${response[0].id}` + '">' + `${response[0].like_sum}`+ '</span>'
                        + '<i class="fa-solid fa-thumbs-up"></i>'
                        + '</div>'
                html += '</div>' + '<div class="reply-form"'+ `alt=${response[0].id}` + '></div>'
                        + '</div>';

                $(Comment.SELECTORS.comment).prepend(html);

                Comment.likeComment();
                Comment.replyFunction();
                Comment.deleteComment();
                Comment.addReply();
            })
            .fail(function( xhr, status, errorThrown ) {
                if(errorThrown == 'Unauthorized') { 
                    window.location.href = "http://127.0.0.1:8000/login";
                }
            })
             
        })

        
    },

    addReply: function() {
        $(Comment.SELECTORS.comment_item).on("click", Comment.SELECTORS.reply_comment_button, function(e) {
            e.preventDefault();

            let comment_id = $(this).attr('alt');
            var host = 'http://' + window.location.host;

            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: 'replycomment/' + comment_id,
                data: {
                    content: $(Comment.SELECTORS.reply_comment).val(),
                    user_id: window.auth_id,
                    blog_id: window.blog_id
                }
            })

            .done(function(response) {
                let html = "";
                imagePath = host + '/images/' + response[0].image_url;

                html += '<div class="comment-child comment-item"' + `alt=${response[0].id}` + '">'
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
                        + '<a class="delete"' + `alt=${response[0].id}` +  '>delete</a>';
                if (response[0].user_id == window.auth_id) html += '<a href="">edit</a>'
                
                html += '</div>' + '<div class="reply-form"'+ `alt=${response[0].id}` + '></div>'
                        + '</div>';

                $(Comment.SELECTORS.comment_parent + `[alt=${comment_id}]`).append(html);

                $(Comment.SELECTORS.reply_form + `[alt=${comment_id}]`).remove();

                Comment.deleteComment();
                Comment.likeComment();
                
            })

            .fail(function(xhr, status, errorThrown) {
                alert( "Sorry, there was a problem!" );
                console.log( "Error: " + errorThrown );
                console.log( "Status: " + status );
                console.dir( xhr );
            })
        })
    },

    likeComment: function() {
        $(Comment.SELECTORS.like).on("click", function(e) {
            e.preventDefault();

            let comment_id = $(this).attr('alt');

            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: 'likecomment/' + comment_id,
                data: {},
            })

            .done(function(response) {
                if($(Comment.SELECTORS.like + `[alt=${response.id}]`).hasClass('liked')) $(Comment.SELECTORS.like + `[alt=${response.id}]`).removeClass('liked')
                else $(Comment.SELECTORS.like + `[alt=${response.id}]`).addClass("liked")

                $(Comment.SELECTORS.like_count + `[alt=${response.id}]`).text(response.like_sum);
            })

            .fail(function(xhr, status, errorThrown) {
                if(errorThrown == 'Unauthorized') { 
                    window.location.href = "http://127.0.0.1:8000/login";
                }
            })
        })
    },

    deleteComment: function() {
        $(Comment.SELECTORS.delete).on('click', function() {
            if(confirm("Are you sure about that")) {

                $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
    
                $.ajax({
                    type: 'POST',
                    url: 'deletecomment/' + $(this).attr('alt'),
                    data: {
                        id_blog : window.blog_id,
                    },
                })

                .done(function(response){
                    let html = "";
                    console.log(response);
                    $.each(response, function(index, item) {
                        $(Comment.SELECTORS.comment_item + `[alt=${item.id}]`).remove();
                    })
                    alert("done !");
                })

                .fail(function(xhr, status, errorThrown) {
                    alert( "Sorry, there was a problem!" );
                    console.log( "Error: " + errorThrown );
                    console.log( "Status: " + status );
                    console.dir( xhr );
                })
            }
            else {
                alert("denied !");
            }
        })
    },

    updateComment: function() {
        $(Comment.SELECTORS.comment_item).on("click", Comment.SELECTORS.update_comment_button, function(e) {
            e.preventDefault();

            let id_select = $(this).attr('alt');

            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: 'updatecomment/' + $(this).attr('alt'),
                data: {
                    blog_id : window.blog_id,
                    content: $(Comment.SELECTORS.update_comment).val(),
                },
            })

            .done(function(response) {
                $(Comment.SELECTORS.comment_item + `[alt=${id_select}]`).attr("alt", response.id)
                $(Comment.SELECTORS.comment_text + `[alt=${id_select}]`).attr("alt", response.id)
                $(Comment.SELECTORS.action + `[alt=${id_select}]`).attr("alt", response.id)
                $(Comment.SELECTORS.like + `[alt=${id_select}]`).attr("alt", response.id)
                $(Comment.SELECTORS.reply + `[alt=${id_select}]`).attr("alt", response.id)
                $(Comment.SELECTORS.edit + `[alt=${id_select}]`).attr("alt", response.id)
                $(Comment.SELECTORS.delete + `[alt=${id_select}]`).attr("alt", response.id)
                $(Comment.SELECTORS.reply_form + `[alt=${id_select}]`).attr("alt", response.id)
                $(Comment.SELECTORS.like_count + `[alt=${id_select}]`).attr("alt", response.id)
                $(Comment.SELECTORS.comment_text + `[alt=${response.id}]`).text(response.content)
                $(Comment.SELECTORS.reply_form + `[alt=${response.id}]`).remove();
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