var menuOpened= 0;
function inputHandler() {
    var v = $(this).val();
    $("#priceShow").val(v);
}

function priceChanged() {
    var mn = parseInt(document.getElementById("min_max_range").min);
    var mx = parseInt(document.getElementById("min_max_range").max);
    var vl = parseInt(document.getElementById("priceShow").value);
    if (vl >= mn && vl <= mx) {
        document.getElementById("min_max_range").value = vl
    }
}

$(function() {


    $(".is-mobile-nav .dropdown-inner, .is-mobile-nav  .back-prev-menu") . click ( function () {
        $(".dropdown-menu") . toggleClass('displayit');
        return false;
    });

    if ($("#min_max_range").length) {
        document.getElementById("min_max_range").addEventListener("input", inputHandler);
        document.getElementById("priceShow").addEventListener("change", priceChanged);
        document.getElementById("priceShow").addEventListener("keyup", priceChanged);
    }


    if ($("#myTab").length) {
        $('#myTab a').on('click', function(e) {
            $(this).tab('show')
            var _tab = $(this).attr('aria-controls')
            $(".home-tab").hide('fast');
            $(".home-tab#" + _tab).show('slow');
            e.preventDefault()
        });
        $('#myTab li:first-child a').trigger('click')
    }

    $(".sellBackBtn").click(function() {
        $("#reasonDiv").slideToggle('fast');
        return false;
    });

    $("#sortSelect").change(function() {
        var _module = $(this).data('module');
        var _v = $(this).val();
        location.href = base_url + _module + "/" + _v + "/0";
    });


    $(".activeProduct").change(function() {
        var id = $(this).val();
        var state = $(this).prop('checked');
        console.log(state);
        $.ajax({
            url: base_url + 'ajax/updateActiveState',
            method: 'POST',
            data: "id=" + id + "&currentstate=" + state,
            success: function(ret) {
                //alert(ret);
            }
        })
    });

    $("#SKU").change(function() {
        var sku = $(this).val();
        $.ajax({
            url: base_url + 'ajax/getSKUvalues',
            method: 'POST',
            data: "sku=" + sku,
            success: function(ret) {
                var minMax = /([0-9]{1,})\,([0-9]{1,})/.test(ret);
                if (minMax) {
                    minMax = ret.split(",");
                    var _min = minMax[0];
                    var _max = minMax[1];
                    $("#minMax").html('<span class="fa fa-signal"></span> يتراوح سعر المنتج بين   <span style="color:green">' +
                        _min + '</span> و  <span style="color:darkred">' + _max +
                        '</span> ');
                } else {
                    $("#minMax").html();
                }
            }
        })
    });


    $(".add_to_wishlist,.add_to_wishlist2").click(function() {
        var _id = $(this).data('productid');
        console.log(_id);
        $.ajax({
            url: base_url + 'ajax/add2WishList/' + _id,
            method: 'GET',
            success: function(ret) {
                if (ret != 1) {
                    alert(ret);
                } else {
                    flashMsgs('تمت إضافة المنتج إلى المفضلة');
                }
            }
        });
        return false;
    });


    $(".compare").click(function() {
        var _id = $(this).data('product_id');
        $.ajax({
            url: base_url + 'ajax/add2compare/' + _id,
            method: 'GET',
            success: function(ret) {
                if (ret != 1) {
                    alert(ret);
                } else {
                    flashMsgs('تمت إضافة المنتج إلى المقارنة');
                }
            }
        });
        return false;
    });


    $("#balance_req_toggle").click(function() {
        $("#balance_req_div").slideToggle('fast');
        return false;
    });


    $("#price,#cat").change(function() {
        if ($("#discount").val()) return;
        if ($("#price").val() == '') return;
        price = parseFloat($("#price").val());
        var p = $("#cat option:selected").data('percent');
        var n = parseFloat((p / price) * 100).toFixed(2);
        $("#priceSum").html("- نسبة الموقع : " + n + " جنيه " + "<small class='text-danger'>(" + p + "%)</small>");
    });


    $("#discount").change(function() {
        price = parseFloat($("#discount").val());
        var p = $("#cat option:selected").data('percent');
        var n = parseFloat((p / price) * 100).toFixed(2);
        $("#priceSum").html("- نسبة الموقع : " + n + " جنيه " + "<small class='text-danger'>(" + p + "%)</small>");
    });

    updateCartPrice();
    $("#sortProducts").change(function() {
        var _sort = $(this).val();
        console.log(_sort);
    });

    $(".price_rating_2 a").mouseover(function() {
        var _rate = $(this).data('value'),
            text_add = '';
        switch (_rate) {
            case 20:
                text_add = "سئ جدا";
                break;
            case 40:
                text_add = "سئ ";
                break;
            case 60:
                text_add = "متوسط";
                break;
            case 80:
                text_add = "ممتاز";
                break;
            case 100:
                text_add = "رائع";
                break;
        }
        $("#rating_span").html('تقييمك : ' + _rate + "% - " + text_add);
    });

    $(".price_rating_2 a").click(function() {
        var _rate = $(this).data('value');
        $("#rate_value").val(_rate);
        $(".price_rating_2 a i").css('color', '');
        for (i = 20; i <= _rate; i += 20) {
            $(".price_rating_2 a[data-value=" + i + "] i").css('color', '#d21a0f');
        }
        return false;
    });

    $("#makeComment").click(function() {
        var _rate = $("#rate_value").val(),
            _comment = $("#comment").val(),
            _prod = $("#product").val();

        if (_rate) {
            if (_comment && _comment.length < 10) {
                $("#commentHints").html('التعليق يجب أن يتجاوز 10 حروف');
                removeFlashText('commentHints');
            } else {
                $.ajax({
                    url: base_url + 'ajax/comment',
                    method: 'POST',
                    data: "rate=" + _rate + "&comment=" + _comment + "&product=" + _prod,
                    success: function(ret) {
                        if (ret == 1) {
                            $("#commentHints").html('<span style="color:darkgreen">تمت اضافة التقييم</span>');
                            removeFlashText('commentHints');
                        } else {
                            alert(ret);
                        }
                    }
                })
            }
        } else {
            $("#commentHints").html('<span style="color:red">عفواً لم تقم بعمل تقييم</span>');
            removeFlashText('commentHints');
        }
    });

    $(".add2cartBtn").click(function() {
        var _id = $(this).data('id');
        $.ajax({
            url: base_url + "ajax/updateCartCount/" + _id + "/" + ($("#singleCount").val() ?
                $("#singleCount").val() :
                1),
            success: function(ret) {
                updateCartPrice();
                if (ret != 1) {
                    alert(ret);
                } else {
                    flashMsgs('تمت إضافة المنتج إلى السلة');
                }
            }
        });
        return false;
    });


    $('.payment-accordion-toggle').click(function() {
        var _method = $(this).data('paymethod');
        $("#paymethod").val(_method);
    });

});


function removeFlashText(commentHints) {
    setTimeout(function() { $("#" + commentHints).html(''); }, 1500)
}



function updateCartPrice() {
    $.ajax({
        url: base_url + "ajax/updateCartPrices",
        cache: false,
        success: function(ret) {
            ret = $.parseJSON(ret);
            // console.log(ret);
            if (ret[1] == 0) {
                $("#cartTotal").html('<div class="text-center text-muted">السلة  فارغة</div>');
                $('.cart-button').hide('fast');
            } else {
                $("#cartTotal,.n-item").html(ret[1]);
                $("#cart-content").html(ret[0])
                $(".cart-prices").html(ret['price']);
                $('.cart-button').show('slow');
            }
            // $("#cart_qty_top").html(ret[1] + " منتج ")
        }
    });
}

function delCart(_id) {
    $.ajax({
        url: base_url + "ajax/delCart/" + _id,
        async: true,
        success: function(ret) { updateCartPrice(); if (ret != 1) alert(ret); }
    });
    $(".cartRow_" + _id).remove();
}


function flashMsgs(msg) {
    if ($("#flashMsg").html()) {
        $("#flashMsg").remove();
    }

    $('body').append('<div id="flashMsg">' + msg + '</div>');
    setTimeout(function() {
        $("#flashMsg").fadeOut('fast', function() {
            $("#flashMsg").remove();
        });
    }, 1000);
}



$(function() {
    $(window).scroll(function() {
        if ($(window).scrollTop() > 180) {
            $('.header-container').addClass('header-fixed')
        } else {
            $('.header-container').removeClass('header-fixed')
        }
    })


    $(".plus-minus-btns .minus").click(function() {
        var x = parseInt($("#singleCount").val())
        if (x - 1 > 0) $("#singleCount").val(x - 1);
    })

    $(".plus-minus-btns .plus").click(function() {
        var x = parseInt($("#singleCount").val())
        var max = parseInt($("#singleCount").data('max'));
        if (x + 1 <= max) $("#singleCount").val(x + 1);
    })

    $("#singleCount").change(function() {
        var x = parseInt($(this).val());
        var max = parseInt($(this).data('max'));
        // if (x > 1) $("#singleCount").val(1);
        // if (x <= max) $("#singleCount").val(max);
    })


    $(".responsive-menu")  . click (function () {
        if( menuOpened == 0 ) {
            menuOpened = 1;
            $(".menu-mobile") . addClass('opened');
        }else{
            menuOpened = 0;
            $(".menu-mobile") . removeClass('opened');
        }
    })


    // if( $(".menu-mobile").length ) {
        $(".menu-mobile").onSwipe(function(results){
            // console.log(results);
            if(results.right == true) {
                menuOpened = 0;
                $(".menu-mobile") . removeClass('opened');
            }
        });
    // }
})