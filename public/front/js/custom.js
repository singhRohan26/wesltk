function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#imageUpload").change(function() {
    readURL(this);
});

// Fixed Header Start

    $(window).scroll(function () {
    
        if ($(window).scrollTop() >= 1) {
            $('.header').addClass('fixedHeader');
        } else {
            $('.header').removeClass('fixedHeader');
        }
    });
  
  // Fixed Header End

    $().ready(function(){
        $('.slick-carousel').slick({
        autoplay: true,
        autoplaySpeed: 1000,
        arrows: false,
        centerPadding: "0px",
        dots: false,
        slidesToShow: 4,
        infinite: true
        });
    });

  // Sidebar Start

    $('.navbar-toggler').click(function () {
        if ($(this).parents('.navbar').find('.navbar-collapse').hasClass('show')) {
            $('.navbar-expand-md .navbar-collapse').css('left', '-250px');
        } else {
            $('.navbar-expand-md .navbar-collapse').css('left', '0px');
        }
    });
  
  // Sidebar End

  // Navbar Button Style Start

    $(document).ready(function(){
        $('.navbar-toggler').click(function(){
            if($(this).hasClass('active'))
            {
                $(this).removeClass('active')
            }
            else{
                $(this).addClass('active')
            }
        });
    });
  
  // Navbar Button Style End
$(document).on('click','.rating ul li',function(){
	$(this).children('.starnew').hide();
	$(this).children('.starshow').show();
});
//$(document).on('click','.rating ul li',function(){
//	$(this).children('.starshow').hide();
//	$(this).children('.starnew').show();
//});

(function() {
  // Display the images to be uploaded.
  var multiPhotoDisplay;

  $('#photos').on('change', function(e) {
    return multiPhotoDisplay(this);
  });

  this.readURL = function(input) {
    var reader;
    
    // Read the contents of the image file to be uploaded and display it.

    if (input.files && input.files[0]) {
      reader = new FileReader();
      reader.onload = function(e) {
        var $preview;
        $('.image_to_upload').attr('src', e.target.result);
        $preview = $('.preview');
        if ($preview.hasClass('hide')) {
          return $preview.toggleClass('hide');
        }
      };
      return reader.readAsDataURL(input.files[0]);
    }
  };

  multiPhotoDisplay = function(input) {
    var file, i, len, reader, ref;
    
    // Read the contents of the image file to be uploaded and display it.

    if (input.files && input.files[0]) {
      ref = input.files;
      for (i = 0, len = ref.length; i < len; i++) {
        file = ref[i];
        reader = new FileReader();
        reader.onload = function(e) {
          var image_html;
          image_html = `<li><a class="th" href="${e.target.result}"><img width="75" src="${e.target.result}"></a></li>`;
          $('#photos_clearing').append(image_html);
          if ($('.pics-label.hide').length !== 0) {
            $('.pics-label').toggle('hide').removeClass('hide');
          }
          return $(document).foundation('reflow');
        };
        reader.readAsDataURL(file);
      }
      window.post_files = input.files;
      if (window.post_files !== void 0) {
        return input.files = $.merge(window.post_files, input.files);
      }
    }
  };

}).call(this);


$(document).on('click','.afterloginBtn',function(){
	$('.profileChanges').slideDown();
});
document.addEventListener("mousedown", function (event) {
    if (event.target.closest(".profileChanges ,.afterloginBtn"))
        return;
    $('.profileChanges').slideUp();
});
$(document).on('click','.skinShow' ,function(){
	$('.skinCare').slideDown();
		$(this).children('span').css("transform",'rotate(90deg)')
});
$(document).on('click','.skinShow.active' ,function(){
	$('.skinCare').slideUp();
		$(this).children('span').css("transform",'rotate(0deg)')
});
$(document).on('click','.interset input,.interset span',function(){
	$('.interset ul').slideDown();
});
$(document).on('click','.interset ul li',function(){
	var x = $(this).text();
	$('.interset input').attr('value',x);
		$('.interset ul').slideUp();
});
$(document).on('click','.faqContent a',function(){
	$(this).addClass('active');
	$(this).children('span').css("transform",'rotate(180deg)')
	$(this).siblings('p').slideDown();
});
$(document).on('click','.faqContent a.active',function(){
	$(this).removeClass('active');
	$(this).children('span').css("transform",'rotate(0deg)')
	$(this).siblings('p').slideUp();
});
$(document).on('click','.profileOrders ul li a',function(){
	$('.profileOrders ul li a').removeClass('active');
	$(this).addClass('active');
});
$(document).on('click','.showDrop',function(){
	$(this).addClass('dropRotate');
		$(this).children('img').css("transform",'rotate(0deg)');
	$(this).parents('.orderProcess').siblings('.AllorderDetail').slideDown();
});
$(document).on('click','.dropRotate',function(){
	$('.dropRotate').removeClass('dropRotate');
	$(this).children('img').css("transform",'rotate(180deg)');
		$(this).parents('.orderProcess').siblings('.AllorderDetail').slideUp();
});
$(document).on('click','.radio.radio2 label',function(){
	
	if($(this).hasClass('active')){
			$('.accountDetail').show();
		$('.accountDetail').slideDown();
	}
});
$(document).on('click','.productDet a',function(){
	$('.addProduct.addProduct2 input').attr('value',0);
});
$(document).on('click','.dropValue li',function(){
	var x = $(this).text();
	$('.reviewWay p span').text(x);
});
$(document).on('click','.reviewWay p span,.reviewWay p span b',function(){
	$('.dropValue').slideDown();
});
$(document).on('click','.dropValue li',function(){
	$('.dropValue').slideUp();
});
//add to cart code start
$(document).on('click','.addProduct .productAdd',function(){
	$(this).siblings('.addProduct .minus_btn,.plus_btn').show();
});
$(".plus_btn").click(function () {
    var $n = $(this).parent(".vaulebox").find(".qty");
    $n.val(Number($n.val()) + 1);
});

$(".minus_btn").click(function () {
    var $n = $(this).parent(".vaulebox").find(".qty");
    var amount = Number($n.val());
    if (amount > 0) {
        $n.val(amount - 1);
    }
});
//add to cart code end
$(document).ready(function () {
    $('.productAdd').click(function () {
        $(this).parents('.vaulebox').find('.minus_btn').css('display', 'block');
        $(this).parents('.vaulebox').find('.qty').css('display', 'block');
        $(this).parents('.vaulebox').find('.productAdd').css('display', 'none');
        $(this).parents('.categoriesInner').find('.bookNowbox').css('display', 'block');
    });
});

$(document).on('click','.resturantMenu ul li a', function(){
	$('.resturantMenu ul li a').removeClass('active');
	$(this).addClass('active');
});
$(document).on('click','.resturantMenu ul li a' ,function(){
	var id =$(this).data('id');
	$(".resturentData.resturentData2").removeClass('active');
	$(".view"+id).addClass('active');
});
$(document).on('click','.resturantMenu ul li a' ,function(){
	var id =$(this).data('id');
	$(".menuDetail ").removeClass('active');
	$(".menu"+id).addClass('active');
});
$(document).on('click','.profileOrders ul li a' ,function(){
	var id =$(this).data('id');
	$(".profileAll12").removeClass('active');
	$(".profile"+id).addClass('active');
});
$(document).on('click','.profileOrders ul li a' ,function(){
	var id =$(this).data('id');
	$(".faqRight").removeClass('active');
	$(".faq"+id).addClass('active');
});
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 1) {
        $(".header").addClass("fixedHeader");
    }
	else{
	 $(".header").removeClass("fixedHeader");	
	}
})


$(document).on('click', '.radio label', function () {
	$('.radio label').removeClass('active');
	$(this).addClass('active');
});
$('.counter').counterUp({
	delay: 10,
	time: 2000
});
$('.counter').addClass('animated fadeInDownBig');
$('h3').addClass('animated fadeIn');

$(document).on('click', '.foodAllservice', function () {
	$('.foodAllservice').removeClass('active');
	$(this).addClass('active');

});
$('a.topArrow').click(function () {
	$('html, body').animate({
		scrollTop: 0
	}, 1000);
	return false;
});
/*
Reference: http://jsfiddle.net/BB3JK/47/
*/

$('select').each(function () {
	var $this = $(this),
		numberOfOptions = $(this).children('option').length;

	$this.addClass('select-hidden');
	$this.wrap('<div class="select"></div>');
	$this.after('<div class="select-styled"></div>');

	var $styledSelect = $this.next('div.select-styled');
	$styledSelect.text($this.children('option').eq(0).text());

	var $list = $('<ul />', {
		'class': 'select-options'
	}).insertAfter($styledSelect);

	for (var i = 0; i < numberOfOptions; i++) {
		$('<li />', {
			text: $this.children('option').eq(i).text(),
			rel: $this.children('option').eq(i).val()
		}).appendTo($list);
	}

	var $listItems = $list.children('li');

	$styledSelect.click(function (e) {
		e.stopPropagation();
		$('div.select-styled.active').not(this).each(function () {
			$(this).removeClass('active').next('ul.select-options').hide();
		});
		$(this).toggleClass('active').next('ul.select-options').toggle();
	});

	$listItems.click(function (e) {
		e.stopPropagation();
		$styledSelect.text($(this).text()).removeClass('active');
		$this.val($(this).attr('rel'));
		$list.hide();
		//console.log($this.val());
	});

	$(document).click(function () {
		$styledSelect.removeClass('active');
		$list.hide();
	});

});



