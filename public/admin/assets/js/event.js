var Event = function () {
  this.__construct = function () {
    this.commonForm();
    this.deleteItem();
    this.editProfile();
    this.blockuser();
    this.updateUserStatus();
    this.changeStatus();
    this.dashboardFilter();
    this.sendNotificationSubmit();
  };
    
    this.commonForm = function(){
        $(document).on('submit', '#common-form', function(e){   
              e.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            $.post(url, postdata, function (out) {
                $(".form-group > .error").remove();
                if (out.result === 0) {
                    var a = 1;
                    for (var i in out.errors) {
                        $("#" + i).parents(".form-group").append('<span class="error text-danger">' + out.errors[i] + '</span>');
                        if(a == 1){
                            $("#" + i).focus();
                        }
                        a++;
                    }
                }
                if (out.result === -1) {
                    var message = '<button type="button" class="btn close" data-dismiss="alert" aria-label="Close"></button>';
                    $(".error_msg").removeClass('alert-warning alert-success admin_chk_suc').addClass('alert alert-danger alert-dismissable admin_chk_dng').show();
                    $(".error_msg").html(message + out.msg);
                    $(".error_msg").fadeOut(2000);
                }
                if (out.result === 1) {
                    var message = '<button type="button" class="btn close" data-dismiss="alert" aria-label="Close"></button>';
                    $(".error_msg").removeClass('alert-danger alert-danger admin_chk_dng').addClass('alert alert-success alert-dismissable admin_chk_suc').show();
                    $(".error_msg").html(message + out.msg);
                    $(".error_msg").fadeOut(2000);
                    window.setTimeout(function () {
                        window.location.href = out.url;
                    }, 1000);
                }
            });
        })
    }
    
    this.deleteItem = function(){
        $(document).on('click', '.delete-item', function(e){
            e.preventDefault();
            var url = $(this).attr("href");
            swal({
                title: "Do you really want to Delete?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.post(url, '', function (out) {
                        if (out.result === 1) {
                            window.location.href = out.url;
                        }
                    });
                }
            });
        });
    };
    this.editProfile = function(){
        $(document).on('submit', '#common-image-form, #editProfile', function(evt){
            evt.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type:"post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: true,
                success:function(out){
                     $('.loaddata').fadeOut();
                    $(".form-group > .error").remove();
                    if (out.result === 0) {
                        for (var i in out.errors) {
                            $("#" + i).parents(".form-group").append('<span class="error">' + out.errors[i] + '</span>');
                            $("#" + i).focus();
                        }
                    }
                    if (out.result === -1) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        $(".error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                        $(".error_msg").html(message + out.msg);
                        $(".error_msg").fadeOut(2000);
                    }
                    if (out.result === 1) {
                        var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                        $(".error_msg").removeClass('alert-warning alert-danger').addClass('alert alert-success alert-dismissable').show();
                        $(".error_msg").html(message + out.msg);
                        $(".error_msg").fadeOut(5000);
                        window.setTimeout(function () {
                        window.location.href = out.url;
                    }, 3000);
                    }
                }
             });

        });

    }

     this.blockuser = function(){
        $(document).on('change', '.seller_status',function (e){
            e.preventDefault();
            let name = $(this).val();
            let url = $(this).data('url');
            $.post(url, {name: name}, function (out) {
                if(out.result === 1){
                   swal(out.msg);
                }
                if(out.result === -1){
                    swal(out.msg);
                }
            });
        });   
     }

     this.updateUserStatus = function(){
        $(document).on('click', '.updateUserStatus',function (e){
            e.preventDefault();
            let url = $(this).attr('href');
            $.post(url, function (out) {
                if(out.result === 1){
                   swal(out.msg);
                    window.setTimeout(function () {
                        window.location.href = out.url;
                    }, 1000);
                }
            });
        });   
     }


this.changeStatus = function(){
    $(document).on('change', '#change_order_status', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        var status = $(this).val();
        $.post(url, {status : status}, function(out){
            if(out.result == 1){
                swal(out.msg, "", "success");
                window.location.href = out.url;
            }if(out.result == -1){
                swal({
                    title: out.msg,
                    icon: "warning",
                    dangerMode: true,
                    closeOnClickOutside: false,
                }).then(function () {
                    
                });
            }
        })    
    })
}
this.dashboardFilter = function(){
    $(document).on('change', '#filter_days', function(){
        var days = $(this).val();
        var url = $(this).data('url');
        $.post(url, {days : days}, function(res){
            $("#content_dashboard_wrapper").html(res.content_wrapper);
        })
    })
}
    this.sendNotificationSubmit = function () {
        $(document).on('click', '.notify', function (evt) {
            evt.preventDefault();
            if ($('.users_id:checked').length > 0) {
                var url = $(this).attr('href');
                var user_id = [];
                $.each($(".users_id:checked"), function () {
                    user_id.push($(this).val());
                });
                $.post(url, {user_id: user_id}, function (out) {
                    if (out.result === 1) {
                        $('#send-notification-wrapper').html(out.notification_wrapper);
                        $('#notificationModal').modal('show');
                    }
                });
            } else {
                alert('Please select a user to send notification');
            }
        });

        $(document).on('click', '.check', function () {
            if ($(this).prop("checked") === true) {
                $(".users_id").prop("checked", true);
            } else if ($(this).prop("checked") === false) {
                $(".users_id").prop("checked", false);
            }
        });

        $(document).on('submit', '#send-notification', function (evt) {
            evt.preventDefault();
            var url = $(this).attr("action");
            var postdata = $(this).serialize();
            $.post(url, postdata, function (out) {
                $(".loader").fadeOut("slow");
                $(".form-group > .text-danger").remove();
                if (out.result === 0) {
                    for (var i in out.errors) {
                        $("#" + i).parents(".form-group").append('<span class="text-danger">' + out.errors[i] + '</span>');
                    }
                }
                if (out.result === 1) {
                    var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                    $(".error_msg").removeClass('alert-danger alert-danger').addClass('alert alert-success alert-dismissable').show();
                    $(".error_msg").html(message + out.msg);
                    $(".error_msg").fadeOut(2000);
                    $('#notificationModal').modal('hide');
                }
            });
        });
    };
  
  this.__construct();
};
var obj = new Event();