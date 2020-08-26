var Event = function () {
  this.__construct = function () {
    this.commonForm();
    this.commonSurveyForm();
    this.deleteItem();
    this.editProfile();
    this.blockuser();
    this.changeCity();
    this.logOut();
    this.addToCart();
    this.addToCartBtn();
    this.addToCartByNowBtn();
    this.addQty();
    this.cartWrappper();
    this.orderConfirm();
    this.orderPlace();
    this.searchWrapper();
    this.searchBrandWrapper();
    this.addMoreCerti();
    this.cuisineWrapper();
    this.searchRestaurant();
    this.clickCuisineWrapper();
    this.restaurantVegType();
    this.serachProduct();
};

this.commonForm = function(){
    $(document).on('submit', '#common-form, .common-image-form', function(e){   
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
this.commonSurveyForm = function(){
    $(document).on('submit', '.common-form', function(e){   
      e.preventDefault();
      var url = $(this).attr("action");
      var postdata = $(this).serialize();
      $(".error").remove();
      $.post(url, postdata, function (out) {
        if (out.result === 0) {
            var a = 1;
            for (var i in out.errors) {
                if($("#" + i).attr('type') == 'radio'){
                    $("#" + i).parents(".srveyChekbox").after('<span class="error text-danger">' + out.errors[i] + '</span>');
                }else{
                    if($("#" + i).parents('div').hasClass("formoption")){
                        $("#" + i).parents(".formoption").after('<span class="error text-danger erro_msg_chk">' + out.errors[i] + '</span>');    
                    }else{
                        $("#" + i).parents(".comment_dscp, .expire_date, .form-group").append('<span class="error text-danger erro_msg_chk">' + out.errors[i] + '</span>');    
                    }
                    if(a == 1){
                        $("#" + i).focus();
                    }
                    a++;
                }
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
                $("#error_msg").removeClass('alert-warning alert-success').addClass('alert alert-danger alert-dismissable').show();
                $("#error_msg").html(message + out.msg);
                $("#error_msg").fadeOut(2000);
            }
            if (out.result === 1) {
                var message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                $("#error_msg").removeClass('alert-warning alert-danger').addClass('alert alert-success alert-dismissable').show();
                $("#error_msg").html(message + out.msg);
                $("#error_msg").fadeOut(5000);
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


this.changeCity = function(){
    $(document).on('change', '#state',function (e){
        e.preventDefault();
        let state_name = $(this).val();
        let url = $(this).data('url');
        $.post(url, {state_name: state_name}, function (out) {
            $("#city").html(out.content_wrapper)
        });
    });   
}
this.logOut = function(){
    $(document).on('click', '.signOut_fnl',function (e){
        e.preventDefault();
        var url = $(this).attr("href");
        swal({
            title: "Do you really want to Logout?",
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
}
this.addToCart = function(){
    $(document).on('click', '.addProduct .vaulebox .productAdd',function (e){
        e.preventDefault();
        var this_data = $(this);
        var url = $(this).data("url");
        var qty_val = $(this).parent(".vaulebox").find(".qty").val();
        var qty = Number($(this).parent(".vaulebox").find(".qty").val())+1;
        $.post(url, {qty : qty}, function(out){
            if (out.result === 1) {
                swal({
                    title: "Product Added to Cart",
                    icon: "success",
                    closeOnClickOutside: false,
                }).then(function () {
                    $(qty_val).val(qty);
                    // var url = $("#conent_cart_wrapper").data('url');
                    // $.post(url, function(out){
                    //     $("#conent_cart_wrapper").html(out.content_wrapper)
                    // })
                    $(this_data).parents('.vaulebox').find('.minus_btn').css('display', 'block');
                    $(this_data).parents('.vaulebox').find('.plus_btn').css('display', 'block');
                    $(this_data).parents('.vaulebox').find('.qty').css('display', 'block');
                    $(this_data).parents('.vaulebox').find('.productAdd').css('display', 'none');
                    $(this_data).parents('.categoriesInner').find('.bookNowbox').css('display', 'block');
                });
            }  if (out.result === -1) {
                swal({
                    title: out.msg,
                    icon: "warning",
                    dangerMode: true,
                    closeOnClickOutside: false,
                }).then(function () {
                    var url = $("#conent_cart_wrapper").data('url');
                    $.post(url, function(out){
                        $("#conent_cart_wrapper").html(out.content_wrapper)
                    })
                });
            }
        })
    });
}
this.addToCartBtn = function(){
    $(document).on('click', '.add_to_cart_chk',function (e){
        e.preventDefault();
        var this_data = $(this).parents('.productbuy').siblings('.productAdd').find('.pr_add_chk');
        var url = $(this_data).data("url");
        var qty_val = $(this_data).parent(".vaulebox").find(".qty");
        var qty = Number($(this_data).parent(".vaulebox").find(".qty").val())+1;
        $.post(url, {qty : qty}, function(out){
            if (out.result === 1) {
                swal({
                    title: "Product Added to Cart",
                    icon: "success",
                    closeOnClickOutside: false,
                }).then(function () {
                    qty_val.val(qty);
                    var url = $("#conent_cart_wrapper").data('url');
                    $.post(url, function(out){
                        $("#conent_cart_wrapper").html(out.content_wrapper)
                    })
                    $(this_data).parents('.vaulebox').find('.minus_btn').css('display', 'block');
                    $(this_data).parents('.vaulebox').find('.qty').css('display', 'block');
                    $(this_data).parents('.vaulebox').find('.productAdd').css('display', 'none');
                    $(this_data).parents('.categoriesInner').find('.bookNowbox').css('display', 'block');
                });
            }  if (out.result === -1) {
                swal({
                    title: out.msg,
                    icon: "warning",
                    dangerMode: true,
                    closeOnClickOutside: false,
                }).then(function () {
                    var url = $("#conent_cart_wrapper").data('url');
                    $.post(url, function(out){
                        $("#conent_cart_wrapper").html(out.content_wrapper)
                    })
                });
            }
        })
    });
}
this.addToCartByNowBtn = function(){
    $(document).on('click', '.by_now_chk',function (e){
        e.preventDefault();
        var this_data = $(this).parents('.productbuy').siblings('.productAdd').find('.pr_add_chk');
        var url = $(this_data).data("url");
        var qty_val = $(this_data).parent(".vaulebox").find(".qty");
        var qty = Number($(this_data).parent(".vaulebox").find(".qty").val())+1;
        $.post(url, {qty : qty, by_now : 'by_now'}, function(out){
            if (out.result === 1) {
                window.location.href = out.url;
            }  if (out.result === -1) {
                swal({
                    title: out.msg,
                    icon: "warning",
                    dangerMode: true,
                    closeOnClickOutside: false,
                }).then(function () {
                    var url = $("#conent_cart_wrapper").data('url');
                    $.post(url, function(out){
                        $("#conent_cart_wrapper").html(out.content_wrapper)
                    })
                });
            }
        })
    });
}

this.addQty = function(){

$(document).on('click', '.plus_btn', function () {
    var this_data = $(this);
    var url = $(this).parent(".vaulebox").find(".productAdd").data('url');
    var qty = $(this).parent(".vaulebox").find(".qty");
    var qty1 = Number(qty.val()) + 1;
    $.post(url, {qty : qty1}, function(out){
        if (out.result === 1) {
            swal({
                title: "Product Added to Cart",
                icon: "success",
                closeOnClickOutside: false,
            }).then(function () {
                qty.val(Number(qty.val()) + 1);
                var url = $("#conent_cart_wrapper").data('url');
                $.post(url, function(out){
                    $("#conent_cart_wrapper").html(out.content_wrapper)
                })
                $(this_data).parents('.vaulebox').find('.minus_btn').css('display', 'block');
                $(this_data).parents('.vaulebox').find('.plus_btn').css('display', 'block');
                $(this_data).parents('.vaulebox').find('.qty').css('display', 'block');
                $(this_data).parents('.vaulebox').find('.productAdd').css('display', 'none');
                $(this_data).parents('.categoriesInner').find('.bookNowbox').css('display', 'block');
            });
        }  if (out.result === -1) {
            swal({
                title: out.msg,
                icon: "warning",
                dangerMode: true,
                closeOnClickOutside: false,
            }).then(function () {
                var url = $("#conent_cart_wrapper").data('url');
                $.post(url, function(out){
                    $("#conent_cart_wrapper").html(out.content_wrapper)
                })
            });
        }
    })

});
$(document).on('click', '.minus_btn', function () {
    var this_data = $(this);
    var url = $(this).parent(".vaulebox").find(".productAdd").data('url');
    var qty = $(this).parent(".vaulebox").find(".qty");
    var qty1 = Number(qty.val()) - 1;
    $.post(url, {qty : qty1, minus : "minus"}, function(out){
        if (out.result === 1) {
            if(Number(qty.val()) > 0){
                qty.val(Number(qty.val()) - 1);
                var url = $("#conent_cart_wrapper").data('url');
                $.post(url, function(out){
                    $("#conent_cart_wrapper").html(out.content_wrapper)
                })
                if(qty1 == 0){
                    $(this_data).parents('.vaulebox').find('.minus_btn').css('display', 'none');
                    $(this_data).parents('.vaulebox').find('.plus_btn').css('display', 'none');
                    $(this_data).parents('.vaulebox').find('.qty').css('display', 'none');
                    $(this_data).parents('.vaulebox').find('.productAdd').css('display', 'block');
                    $(this_data).parents('.categoriesInner').find('.bookNowbox').css('display', 'none');
                }
            }
        }  if (out.result === -1) {
            swal({
                title: out.msg,
                icon: "warning",
                dangerMode: true,
                closeOnClickOutside: false,
            }).then(function () {
                var url = $("#conent_cart_wrapper").data('url');
                $.post(url, function(out){
                    $("#conent_cart_wrapper").html(out.content_wrapper)
                })
            });
        }
    })
    
});
}

this.cartWrappper = function (){
    var url = $("#conent_cart_wrapper").data('url');
    $.post(url, function(out){
        $("#conent_cart_wrapper").html(out.content_wrapper)
    })
}
this.orderConfirm = function (){
    $(document).on('click', '.placeOdbtn .orderConfirm', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        var remark = $("#remark").val();
        $.post(url, {remark : remark}, function(out){
            if(out.result == 1){
                window.location.href = out.url;
            }
        })    
    })
}
this.orderPlace = function (){
    $(document).on('click', '.order_place_sub', function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $.post(url, function(out){
            if(out.result == 1){
                swal("Your Order Placed Successfully!!", "", "success");
                window.location.href = out.url;
            }
        })    
    })
}

this.searchWrapper = function (){
    $(document).on('submit', '#content_search', function(e){
        e.preventDefault();
        var url = $('.directPage.active').attr('href');
        if(url){
            window.location.href = url;
        }
    })
    $(document).on('keyup', '.search_chk', function(){
        var url = $(this).data('url');
        var search_val = $(this).val();
        if(search_val == ''){
            $('.searchtool').slideUp();
        }else{
            $('.searchtool').slideDown();
            $.post(url, {search_val : search_val}, function(res){
                $(".searchtool").html(res.content_wrapper)
            })
        }
    })
}
this.searchBrandWrapper = function (){
    $(document).on('keyup', '#search_brand_wrapper', function(){
        var url = $(this).data('url');
        var search_val = $(this).val();
        $.post(url, {search_val : search_val}, function(res){
            $("#brand_category_wrapper").html(res.content_wrapper)
        })
    })
}
this.addMoreCerti = function (){
    $(document).on('click', '.add_more_certi', function(){
        $(".as_chk").clone().insertAfter("div.as_chk:last");
    })
}

// restaurant-filter
this.cuisineWrapper = function (){
    var url = $(".restaurant-wrapper").data('url');
    var checked_val = [];
    $(".list-menu-res").each(function(){
        if($(this).children('input').prop('checked') == true){
            checked_val.push($(this).children('input').val());
        }
    })
    var data_id = $(".resturantMenu ul li a.active").data('id');
    $.post(url, {checked_val : checked_val, data_id : data_id}, function(res){
        $(".restaurant-wrapper").html(res.wrapper);
        $(".resturaRightHead .restHeadd h2 span").text(res.count_wrapper);
    })
}
this.searchRestaurant = function (){
    $(document).on('keyup', '.search-restaurant', function(){
        var url = $(this).data('url');
        var key_search = $(this).val();
        var checked_val = [];
        $(".list-menu-res").children('label').removeClass('active')
        $(".list-menu-res").each(function(){
            if($(this).children('input').prop('checked') == true){
                checked_val.push($(this).children('input').val());
                $(this).children('label').addClass('active')
            }
        })
        var data_id = $(".resturantMenu ul li a.active").data('id');
        $.post(url, {checked_val : checked_val, data_id : data_id, key_search : key_search}, function(res){
            $(".restaurant-wrapper").html(res.wrapper);
            $(".resturaRightHead .restHeadd h2 span").text(res.count_wrapper);
        })
    })
}
this.clickCuisineWrapper = function (){
    $(document).on('click', '.list-menu-res input', function(){
        var url = $(".restaurant-wrapper").data('url');
        var checked_val = [];
        $(".list-menu-res").children('label').removeClass('active')
        $(".list-menu-res").each(function(){
            if($(this).children('input').prop('checked') == true){
                checked_val.push($(this).children('input').val());
                $(this).children('label').addClass('active')
            }
        })
        var data_id = $(".resturantMenu ul li a.active").data('id');
        $.post(url, {checked_val : checked_val, data_id : data_id}, function(res){
            $(".restaurant-wrapper").html(res.wrapper);
            $(".resturaRightHead .restHeadd h2 span").text(res.count_wrapper);
        })
    })
    $(document).on('click', '.resturantMenu ul li a', function(){
        var url = $(".restaurant-wrapper").data('url');
        var checked_val = [];
        $(".resturantMenu ul li a").removeClass('active')
        $(".list-menu-res").each(function(){
            if($(this).children('input').prop('checked') == true){
                checked_val.push($(this).children('input').val());
            }
        })
        $(this).addClass('active');
        var data_id = $(".resturantMenu ul li a.active").data('id');
        $.post(url, {checked_val : checked_val, data_id : data_id}, function(res){
            $(".restaurant-wrapper").html(res.wrapper);
            $(".resturaRightHead .restHeadd h2 span").text(res.count_wrapper);
        })
    })
}
this.restaurantVegType = function (){
    //bydefault
    var url = $(".res_menu_type ul li a.active").data('url');
    var veg_type = [];
    $(".restaurant_veg_type").children('label').removeClass('active')
    $(".restaurant_veg_type").each(function(){
        if($(this).children('input').prop('checked') == true){
            veg_type.push($(this).children('input').val());
            $(this).children('label').addClass('active')
        }
    })
    var cat_type = [];
    $(".restaurant_cat_type").children('label').removeClass('active')
    $(".restaurant_cat_type").each(function(){
        if($(this).children('input').prop('checked') == true){
            cat_type.push($(this).children('input').val());
            $(this).children('label').addClass('active')
        }
    })
    var data_id = $(".resturantMenu ul li a.active").data('id');
    $.post(url, {veg_type : veg_type, cat_type : cat_type, data_id : data_id}, function(res){
        $(".product-wrapper"+data_id).html(res.wrapper);
    })

    //veg-non-veg
    $(document).on('click', '.restaurant_veg_type input', function(){
        var url = $(".res_menu_type ul li a.active").data('url');
        var veg_type = [];
        $(".restaurant_veg_type").children('label').removeClass('active')
        $(".restaurant_veg_type").each(function(){
            if($(this).children('input').prop('checked') == true){
                veg_type.push($(this).children('input').val());
                $(this).children('label').addClass('active')
            }
        })
        var cat_type = [];
        $(".restaurant_cat_type").children('label').removeClass('active')
        $(".restaurant_cat_type").each(function(){
            if($(this).children('input').prop('checked') == true){
                cat_type.push($(this).children('input').val());
                $(this).children('label').addClass('active')
            }
        })
        var data_id = $(".resturantMenu ul li a.active").data('id');
        $.post(url, {veg_type : veg_type, cat_type : cat_type, data_id : data_id}, function(res){
            $(".product-wrapper"+data_id).html(res.wrapper);
        })
    })
    
    //category filter
    $(document).on('click', '.restaurant_cat_type input', function(){
        var url = $(".res_menu_type ul li a.active").data('url');
        var veg_type = [];
        $(".restaurant_veg_type").children('label').removeClass('active')
        $(".restaurant_veg_type").each(function(){
            if($(this).children('input').prop('checked') == true){
                veg_type.push($(this).children('input').val());
                $(this).children('label').addClass('active')
            }
        })
        var cat_type = [];
        $(".restaurant_cat_type").children('label').removeClass('active')
        $(".restaurant_cat_type").each(function(){
            if($(this).children('input').prop('checked') == true){
                cat_type.push($(this).children('input').val());
                $(this).children('label').addClass('active')
            }
        })
        var data_id = $(".resturantMenu ul li a.active").data('id');
        $.post(url, {veg_type : veg_type, cat_type : cat_type, data_id : data_id}, function(res){
            $(".product-wrapper"+data_id).html(res.wrapper);
        })
    })
    
    
    $(document).on('click', '.resturantMenu ul li a', function(){
        $(".searchFood.searchFood3.searchFood2").show();
        if($(this).data('id') != '1'){
            $(".searchFood.searchFood3.searchFood2").hide();
        }
        $(".resturentData").removeClass('active');
        if($(this).data('id') == '1'){
            $(".resturentData.view1").addClass('active');
        }else if($(this).data('id') == '2'){
            $(".resturentData.view2").addClass('active');
        }else if($(this).data('id') == '3'){
            $(".resturentData.view3").addClass('active');
        }
        var url = $(".res_menu_type ul li a.active").data('url');
        var veg_type = [];
        $(".restaurant_veg_type").children('label').removeClass('active')
        $(".restaurant_veg_type").each(function(){
            if($(this).children('input').prop('checked') == true){
                veg_type.push($(this).children('input').val());
                $(this).children('label').addClass('active')
            }
        })
        var cat_type = [];
        $(".restaurant_cat_type").children('label').removeClass('active')
        $(".restaurant_cat_type").each(function(){
            if($(this).children('input').prop('checked') == true){
                cat_type.push($(this).children('input').val());
                $(this).children('label').addClass('active')
            }
        })
        var data_id = $(".resturantMenu ul li a.active").data('id');
        $.post(url, {veg_type : veg_type, cat_type : cat_type, data_id : data_id}, function(res){
            $(".product-wrapper"+data_id).html(res.wrapper);
        })
    })
}
this.serachProduct = function (){
    $(document).on('keyup', '.serach-product', function(){
        var url = $(this).data('url');
        var key_search = $(this).val();
        var veg_type = [];
        $(".restaurant_veg_type").children('label').removeClass('active')
        $(".restaurant_veg_type").each(function(){
            if($(this).children('input').prop('checked') == true){
                veg_type.push($(this).children('input').val());
                $(this).children('label').addClass('active')
            }
        })
        var cat_type = [];
        $(".restaurant_cat_type").children('label').removeClass('active')
        $(".restaurant_cat_type").each(function(){
            if($(this).children('input').prop('checked') == true){
                cat_type.push($(this).children('input').val());
                $(this).children('label').addClass('active')
            }
        })
        var data_id = $(".resturantMenu ul li a.active").data('id');
        $.post(url, {veg_type : veg_type, cat_type : cat_type, data_id : data_id, key_search : key_search}, function(res){
            $(".product-wrapper"+data_id).html(res.wrapper);
        })
    })
}
this.__construct();
};
var obj = new Event();