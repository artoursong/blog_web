var Comment = {
    GLOBAL: {},

    CONSTS: {},

    SELECTORS: {
        reply_form: ".reply-form",
        reply: ".comment .action .reply",
        reply_submit: ".reply-button",
        comment: ".comment",
        text_comment: ".text-comment",
        add_comment_button: ".submit-comment>button"
    },

    init: function() {
        Comment.replyFunction();
        Comment.addComment();
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
                            + "<div class='submit-comment reply-submit'>" 
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
                success: function(response) {
                    let html = "";

                    imagePath = host + '/images/' + response.image_url;
                        
                    html += '<div class="comment-parent comment-item">'
                            + '<div class= "d-flex">';

                    if(Comment.checkExistsImage(imagePath)) html += '<img src="' + `${imagePath}`+ '" alt="">';
                    else html += '<img src="http://127.0.0.1:8000/images/user.svg" alt="">';
                    
                    html += '<div class="comment-data d-flex">' 
                            + '<p class="user-comment">' + `${response.username}` + '</p>'
                            + '<p class="comment-text">' + `${response.content}` + '</p>'
                            + '</div>'
                            + '</div>'
                            + '<div class="action">'
                            + '<a class="like" href="">like</a>'
                            + '<a class="reply"' + `alt=${response.id}` +  '>reply</a>';
                    if (item.user_id == window.auth_id) html += '<a href="">edit</a>'
                    
                    html += '</div>' + '<div class="reply-form"'+ `alt=${response.id}` + '></div>'
                            + '</div>';

                    $(Comment.SELECTORS.comment).append(html)
                },
            })
        })
    }

    // replySubmit:function() {
    //     $(Comment.SELECTORS.reply_submit).on("click", function(e) {
    //         e.preventDefault();
            
    //         $.ajax({
    //             url: ""
    //         })
    //     }) 
    // }

    // renderComment: function() {
    //     var host = 'http://' + window.location.host;
    //     var blog_id = window.blog_id;
    //     var auth_id = window.auth_id;
    //     $.ajax({
    //         type: 'GET',
    //         url: 'loadcomment/' + blog_id.toString(),
    //         success: function (response) {
    //             let html = "";
    //             response.forEach(myFunction = (item, index, arr) => { 
    //                 if(((item.comments_parents).split(".").length - 1) == 0) {
    //                     imagePath = host + '/images/' + item.image_url;
                        
    //                     html += '<div class="comment-parent comment-item">'
    //                             + '<div class= "d-flex">';

    //                     if(Comment.checkExistsImage(imagePath)) html += '<img src="' + `${imagePath}`+ '" alt="">';
    //                     else html += '<img src="http://127.0.0.1:8000/images/user.svg" alt="">';
                        
    //                     html += '<div class="comment-data d-flex">' 
    //                             + '<p class="user-comment">' + `${item.username}` + '</p>'
    //                             + '<p class="comment-text">' + `${item.content}` + '</p>'
    //                             + '</div>'
    //                             + '</div>'
    //                             + '<div class="action">'
    //                             + '<a class="like" href="">like</a>'
    //                             + '<a class="reply"' + `alt=${item.id}` +  '>reply</a>';
    //                     if (item.user_id == auth_id) {
    //                         html += '<a href="">edit</a>'
    //                     }
                        
    //                     html += '</div>' + '<div class="reply-form"'+ `alt=${item.id}` + '></div>'
    //                             + '</div>'
    //                 }
    //                 else if(((item.comments_parents).split(".").length - 1) == 1) {
    //                     html += '<div class="comment-child comment-item">'
    //                             + '<div class= "d-flex">'
    //                     if(Comment.checkExistsImage(imagePath)) html += '<img src="' + `${imagePath}`+ '" alt="">';
    //                     else html += '<img src="http://127.0.0.1:8000/images/user.svg" alt="">';
                                
    //                     html += '<div class="comment-data d-flex">' 
    //                             + '<p class="user-comment">' + `${item.username}` + '</p>'
    //                             + '<p class="comment-text">' + `${item.content}` + '</p>'
    //                             + '</div>'
    //                             + '</div>'
    //                             + '<div class="action">'
    //                             + '<a class="like" href="">like</a>'
    //                             + '<a class="reply"' + `alt=${item.id}` + '>reply</a>'
                                
    //                     if (item.user_id == auth_id) {
    //                         html += '<a href="">edit</a>' 
    //                                 + '</div>'
    //                     }
                        
    //                     html += '<div class="reply-form"'+ `alt=${item.id}` + '></div>'
    //                             + '</div>'
    //                 }
    //                 else {
    //                     html += '<div class="comment-last-child comment-item">'
    //                             + '<div class= "d-flex">'
    //                     if(Comment.checkExistsImage(imagePath)) html += '<img src="' + `${imagePath}`+ '" alt="">';
    //                     else html += '<img src="http://127.0.0.1:8000/images/user.svg" alt="">';
                               
    //                     html += '<div class="comment-data d-flex">' 
    //                             + '<p class="user-comment">' + `${item.username}` + '</p>'
    //                             + '<p class="comment-text">' + `${item.content}` + '</p>'
    //                             + '</div>'
    //                             + '</div>'
    //                             + '<div class="action">'
    //                             + '<a class="like" href="">like</a>'
    //                             + '<a class="reply"' + `alt=${item.id}` + '>reply</a>'
    //                     if (item.user_id == auth_id) {
    //                         html += '<a href="">edit</a>' 
    //                                 + '</div>'
    //                     }
                        
    //                     html += '<div class="reply-form"'+ `alt=${item.id}` + '></div>'
    //                             + '</div>'
    //                 }
    //             });
    //             $(Comment.SELECTORS.comment).html(html)
    //         },renderComment: function() {
    //     var host = 'http://' + window.location.host;
    //     var blog_id = window.blog_id;
    //     var auth_id = window.auth_id;
    //     $.ajax({
    //         type: 'GET',
    //         url: 'loadcomment/' + blog_id.toString(),
    //         success: function (response) {
    //             let html = "";
    //             response.forEach(myFunction = (item, index, arr) => { 
    //                 if(((item.comments_parents).split(".").length - 1) == 0) {
    //                     imagePath = host + '/images/' + item.image_url;
                        
    //                     html += '<div class="comment-parent comment-item">'
    //                             + '<div class= "d-flex">';

    //                     if(Comment.checkExistsImage(imagePath)) html += '<img src="' + `${imagePath}`+ '" alt="">';
    //                     else html += '<img src="http://127.0.0.1:8000/images/user.svg" alt="">';
                        
    //                     html += '<div class="comment-data d-flex">' 
    //                             + '<p class="user-comment">' + `${item.username}` + '</p>'
    //                             + '<p class="comment-text">' + `${item.content}` + '</p>'
    //                             + '</div>'
    //                             + '</div>'
    //                             + '<div class="action">'
    //                             + '<a class="like" href="">like</a>'
    //                             + '<a class="reply"' + `alt=${item.id}` +  '>reply</a>';
    //                     if (item.user_id == auth_id) {
    //                         html += '<a href="">edit</a>'
    //                     }
                        
    //                     html += '</div>' + '<div class="reply-form"'+ `alt=${item.id}` + '></div>'
    //                             + '</div>'
    //                 }
    //                 else if(((item.comments_parents).split(".").length - 1) == 1) {
    //                     html += '<div class="comment-child comment-item">'
    //                             + '<div class= "d-flex">'
    //                     if(Comment.checkExistsImage(imagePath)) html += '<img src="' + `${imagePath}`+ '" alt="">';
    //                     else html += '<img src="http://127.0.0.1:8000/images/user.svg" alt="">';
                                
    //                     html += '<div class="comment-data d-flex">' 
    //                             + '<p class="user-comment">' + `${item.username}` + '</p>'
    //                             + '<p class="comment-text">' + `${item.content}` + '</p>'
    //                             + '</div>'
    //                             + '</div>'
    //                             + '<div class="action">'
    //                             + '<a class="like" href="">like</a>'
    //                             + '<a class="reply"' + `alt=${item.id}` + '>reply</a>'
                                
    //                     if (item.user_id == auth_id) {
    //                         html += '<a href="">edit</a>' 
    //                                 + '</div>'
    //                     }
                        
    //                     html += '<div class="reply-form"'+ `alt=${item.id}` + '></div>'
    //                             + '</div>'
    //                 }
    //                 else {
    //                     html += '<div class="comment-last-child comment-item">'
    //                             + '<div class= "d-flex">'
    //                     if(Comment.checkExistsImage(imagePath)) html += '<img src="' + `${imagePath}`+ '" alt="">';
    //                     else html += '<img src="http://127.0.0.1:8000/images/user.svg" alt="">';
                               
    //                     html += '<div class="comment-data d-flex">' 
    //                             + '<p class="user-comment">' + `${item.username}` + '</p>'
    //                             + '<p class="comment-text">' + `${item.content}` + '</p>'
    //                             + '</div>'
    //                             + '</div>'
    //                             + '<div class="action">'
    //                             + '<a class="like" href="">like</a>'
    //                             + '<a class="reply"' + `alt=${item.id}` + '>reply</a>'
    //                     if (item.user_id == auth_id) {
    //                         html += '<a href="">edit</a>' 
    //                                 + '</div>'
    //                     }
                        
    //                     html += '<div class="reply-form"'+ `alt=${item.id}` + '></div>'
    //                             + '</div>'
    //                 }
    //             });
    //             $(Comment.SELECTORS.comment).html(html)
    //         },
    //     })
    // },
    //     })
    // },
};

$(document).ready(function () {
    Comment.init();
})