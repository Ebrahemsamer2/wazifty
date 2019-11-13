$(function () {
    $("#tabs").tabs();

    if ($('.owl-trusted').length) {
        $('.owl-trusted').owlCarousel({
            loop: true,
            nav: false,
            dots: true,
            items: 4,
            margin: 30,
            autoplay: false,
            smartSpeed: 700,
            autoplayTimeout: 6000,
            responsive: {
                0: {
                    items: 1,
                    margin: 0
                },
                460: {
                    items: 2,
                    margin: 0
                },
                576: {
                    items: 3,
                    margin: 20
                },
                992: {
                    items: 4,
                    margin: 30
                }
            }
        });
    }
    if ($('.owl-testimonials').length) {
        $('.owl-testimonials').owlCarousel({
            loop: true,
            nav: false,
            dots: true,
            items: 1,
            margin: 30,
            autoplay: false,
            smartSpeed: 700,
            autoplayTimeout: 6000,
            responsive: {
                0: {
                    items: 1,
                    margin: 0
                },
                460: {
                    items: 1,
                    margin: 0
                },
                576: {
                    items: 1,
                    margin: 20
                },
                992: {
                    items: 1,
                    margin: 30
                }
            }
        });
    }








    // Adding comment using ajax

    $("#addcommentform").on("submit", function(e) {
        e.preventDefault();

        let comment = $("#addcommentform textarea[name='comment']").val();
        let slug = $("#addcommentform input[name='slug']").val();

        if(comment.length > 500) {
            $("#comment-error").css('display', 'block');
            return false;
        }   

        let data = $(this).serialize();
        $.ajax({
            url: "/blog/post/"+slug,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            dataType: 'json',
            success: function(data) {
                $("#comments").prepend(data.success);
                $("#addcommentform")[0].reset();
            },
            fail: function(data) {
                $("#comments").appent(data.fail);
                $("#addcommentform")[0].reset();
            }
        });
    });

    // Delete Comment by ajax calls

    $(document).on("submit",".deletecomment", function(e) {
        e.preventDefault();

        let slug = $(".deletecomment input[name='slug']").val();
        let data = $(this).serialize();
        $.ajax({
            url: '/blog/post/'+slug,
            method: "Delete",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            dataType: 'json',
            success: function(data) {
                $(".comment"+data.success).remove();
            },

        });
    });

    //  Updating Comment using ajax

    $(".updatecommentform").on("submit", function(e) {
        e.preventDefault();

        let comment = $(".updatecommentform textarea[name='comment']").val();
        let slug = $(".updatecommentform input[name='slug']").val();
        let comment_id = $(".updatecommentform input[name='comment_id']").val();

        if(comment.length > 500) {
            $("#edit-comment-error").css('display', 'block');
            return false;
        }   

        let data = $(this).serialize();
        $.ajax({
            url: "/blog/post/"+slug,
            method: "PATCH",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            dataType: 'json',
            success: function(data) {
                $("p.c"+data.id+"").text(data.success);
                $(".updatecommentform")[0].reset();
                $(".comment"+data.id).next(".modal").modal('hide');
            }
        });
    });


    $("#contact").on("submit", function(e) {

        e.preventDefault();
        let data = $(this).serialize();
        $.ajax({
            url: '/blog/contact',
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            dataType: 'json',
            success: function(data) {
                $("#contactform_output").html(data.success);
                $("#contact")[0].reset();
            },
        });

    });

});

// Page loading animation
$(window).on('load', function () {
    if ($('.cover').length) {
        $('.cover').parallax({
            imageSrc: $('.cover').data('image'),
            zIndex: '1'
        });
    }

    $("#preloader").animate({
        'opacity': '0'
    }, 600, function () {
        setTimeout(function () {
            $("#preloader").css("visibility", "hidden").fadeOut();
        }, 300);
    });
});

$(window).scroll(function () {
    var scroll = $(window).scrollTop();
    var box = $('.header-text').height();
    var header = $('header').height();

    if (scroll >= box - header) {
        $("header").addClass("background-header");
    } else {
        $("header").removeClass("background-header");
    }
});


