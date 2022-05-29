$(document).ready(function(){

    // WHEN THE USER CLICK LIKE BUTTON
    $('.like-btn').on('click',function(){
        var post_id = $(this).data('id');
        $clicked_btn = $(this);

        if($clicked_btn.hasClass('far')){
            action = 'like';
        } else if($clicked_btn.hasClass('fas')){
            action = 'unlike';
        };
        $.ajax({
            url: './post.php',
            type: 'post',
            data: {
                'action': action,
                'post_id': post_id
            },
            success: function(data){
                res = JSON.parse(data);

                if(action == 'like'){
                    $clicked_btn.addClass('far');
                    $clicked_btn.removeClass('fas');
                }else if (action == 'unlike'){
                    $clicked_btn.addClass('fas');
                    $clicked_btn.removeClass('far');
                }
            }
        })
    });
});