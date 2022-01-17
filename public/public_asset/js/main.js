$(document).ready(function() {
    loadMoreLimitCheck();
    loadMore();
    replyForm();
    formPreventDoubleClick();
    commentFormCheckboxAutoId();
});

function loadMore() {
    $('.loadmore').click(function() {
        var form = $(this).parents('form');
        var element = form.attr('data-element');
        var offset = Number(form.find('input[name="offset"]').val());
        var limit = Number(form.find('input[name="limit"]').val());
        var token = form.find('input[name="_token"]').val();
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: {
                _token: token,
                offset: offset,
                limit: limit,
            },
            beforeSend: function() {
                form.find('.spinner-border').css('display', 'inline-block');
                $(this).attr('disabled', true); // prevent double click
            },
            success: function(data) {
                $(element).append(data);
            },
            complete: function() {
                form.find('.spinner-border').css('display', 'none');
                // set new offset
                var newOffset = offset + limit;
                form.find('input[name="offset"]').val(newOffset);
                loadMoreLimitCheck();
                $(this).attr('disabled', false);
            }
        })
    });
}

function loadMoreLimitCheck() {
    var form = $('.loadmore-form');
    var offset = Number(form.find('input[name="offset"]').val());
    var total = Number(form.find('input[name="total"]').val());
    if (offset >= total) {
        form.hide();
    }
}

function replyForm() {
    // open reply form
    $('#post-comment').on('click', '.reply', function(event) {
        event.preventDefault();
        var thisReplyForm = $( $(this).attr('data-reply-form') );
        if (thisReplyForm.is(':hidden')) {
            thisReplyForm.show();
            
            // hide comment form
            $('#comment-form').hide(); 
            
            // hide other reply form
            var otherReplyForm = $('#post-comment .reply-form').not(thisReplyForm);
            otherReplyForm.each(function() {
                $(this).hide();  
            }); 
        }
    });

    // close reply form
    $('#post-comment').on('click', '.reply-form .cancel', function(event) {
        event.preventDefault();
        $(this).parents('.reply-form').hide();
        // show comment form
        if ($('#comment-form').is(':hidden')) {
            $('#comment-form').show();
        }
    });
}

function formPreventDoubleClick() {
    $('form').submit(function() {
        $(this).find('button[type="submit"]').attr('disabled', true);
        $(this).find('input[type="submit"]').attr('disabled', true);
    });
}

function commentFormCheckboxAutoId() {
    var checkboxes = $('#comment-form input[type="checkbox"], .reply-form input[type="checkbox"]');
    checkboxes.each(function(index) {
        var id = $(this).attr('name') + '_' + index;
        $(this).attr('id', id);
        $(this).next().attr('for', id); // label
    });
}
