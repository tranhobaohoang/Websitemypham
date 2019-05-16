// JavaScript Document
function numberFormat(num, ext) {
        ext = (!ext) ? '  VNĐ' : ext;
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ext;
    }
function textboxChange(tb, f, sb)
{
    if (!f)
    {
        if (tb.value == "")
        {
            tb.value = sb;
        }
    }
    else
    {
        if (tb.value == sb)
        {
            tb.value = "";
        }
    }
}
function change_alias(alias)
{
	var str = alias;
	str= str.toLowerCase(); 
	str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ  |ặ|ẳ|ẵ/g,"a"); 
	str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e"); 
	str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i"); 
	str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ  |ợ|ở|ỡ/g,"o"); 
	str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u"); 
	str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y"); 
	str= str.replace(/đ/g,"d"); 
	str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-");
	/* tìm và thay thế các kí tự đặc biệt trong chuỗi sang kí tự - */
	str= str.replace(/-+-/g,"-"); //thay thế 2- thành 1-
	str= str.replace(/^\-+|\-+$/g,""); 
	//cắt bỏ ký tự - ở đầu và cuối chuỗi 
	return str;
}
function smoothScrolling() { /*-------------------------------------------------*/
/* =  smooth scroll in chrome
	/*-------------------------------------------------*/
  try {
    $.browserSelector();
    // Adds window smooth scroll on chrome.
    if ($("html").hasClass("chrome")) {
      $.smoothScroll();
    }
  } catch (err) {

  }

}
function doEnter(evt) {
    // IE					// Netscape/Firefox/Opera
    var key;
    if (evt.keyCode == 13 || evt.which == 13) {
        onSearch(evt);
    }
}
function onSearch(evt) {

    var keyword = document.getElementById("keyword").value;
    location.href = "tim-kiem.html/keyword=" + change_alias(keyword) ;
        loadPage(document.location);
}
$(document).ready(function () {
	smoothScrolling();
    $("#cssmenu").menumaker({
        title: "Menu",
        format: "multitoggle"
    });
    $(".small-screen").find("ul li").each(function () {
        if ($(this).hasClass("line")) {
            $(this).remove();
        }
        if ($(this).find('a transitionAll').hasClass("icon_menu")) {
            $(this).remove();
        }
    });
})
$(document).ready(function (e) {
	$("#cssmenu > ul > li > a").click(function(){
		$rel=$(this).attr("rel");
		if($rel!=''){
			$offset=$("#"+$rel).offset().top - $("header").height();//Loi Undefined TOP : bo them the span vao the a la xong
			$('html, body').animate({scrollTop:$offset},800);
			return false;
		}
	})
    $('.icon_search').click(function () {
        if ($('.box_search').hasClass("abc")) {
            $('.box_search').removeClass("abc");
            $('.box_search').hide();
        }
        else {
            $('.box_search').addClass("abc");
            $('.box_search').fadeIn();
        }

    })
	$('a.xem_video').click(function(){
		var link_viveo = $(this).attr('href');
		$('body').append('<div class="login-popup"><div class="close-popup"></div><iframe width="700px" height="400px" src="https://www.youtube.com/embed/'+link_viveo+'?rel=0" frameborder="0" allowfullscreen></iframe></div>');
		$('.login-popup').fadeIn(300);
					
		var chieucao = $('.login-popup').height() / 2;
		var chieurong = $('.login-popup').width() /2;
		$('.login-popup').css({'margin-top':-chieucao,'margin-left':-chieurong});
		$('body').append('<div id="baophu"></div>');
		$('#baophu').fadeIn(300);
		
		$('#baophu, .close-popup').click(function(){
			$('#baophu, .login-popup').fadeOut(300, function(){
				$('#baophu').remove();
				$('.login-popup').remove();
			});			
		});
		return false;
		
	});
	$(".box_carts .close").click(function(){
		$(".box_carts").fadeOut();
	})
});

//check comment
function form_step1($obj,$id){
	$($obj).parents(".danhgia").animate({height:"0"},function(){
		$("#"+$id).animate({height:$("#"+$id).data("height")});
		$("#result_comment").hide();
		
	})
	
}
function form_step2($obj,$id){
	$("#comment").animate({height:"0"},function(){
		$("."+$id).animate({height:$("."+$id).data("height")});
		
	})
	
}
function form_step3($obj,$id){
	$("#comment").animate({height:"0"},function(){
		$("."+$id).animate({height:$("."+$id).data("height")});
		
	})
	
}
function comment_check()
{
    var frm = document.frm_config;
    if (frm.hoten.value == '')
    {
        alert("Bạn chưa nhập họ tên.");
        frm.hoten.focus();
        return false;
    }
    if (!validEmail(frm.email.value)) {
        alert('Vui lòng nhập đúng địa chỉ email');
        frm.email.focus();
        $('#RegLoading').hide();
        return false;
    }
	var currentLocation = window.location;
    $.post("ajax/xuly.php", {
        hoten: frm.hoten.value,
        noidung: frm.noidung.value,
        email: frm.email.value,
		rating: $('#rating-input').val(),
		id_sp: $('#id_sp').val(),
        dienthoai: $('#dienthoai').val(),
        act: 'comment',
    }, function (response) {
		$k=$.parseJSON(response);
		if($k.id==1){
			$("#result_comment").html($k.thongbao);
			$("#result_comment").fadeIn(500);
			frm.reset();
			//form_step3("boqua","danhgia");
		}else{
			$(".result_comment1").html($k.thongbao);
			$(".result_comment1").fadeIn(500);
		}
		
    });
}
$().ready(function(){
	checkLimit();
	$(".box_content_answer").each(function(){
		$obj=$(this);
		checkLimit1($obj);
		$obj.find("#page-nav1").click(function(){
			$root=$(this).parent(".box_content_answer");
			$.ajax({
				data:$root.find("#formanswer").serialize(),
				type:"post",
				dataType:'json',
				success:function(data){
					$root.find("#current1").val(data.current);
					$root.find(".content_answer").append(data.source);
					checkLimit1($root);
					remove_answer();
				}
			})
				return false;
		})
	})
	
	$("#page-nav").click(function(){
		$.ajax({
			data:$("#formx").serialize(),
			type:"post",
			dataType:'json',
			success:function(data){
				$("#current").val(data.current);
				$(".box_result_comment").append(data.source);
				checkLimit();
			}
		})
			return false;
	})
	
	$(".answer .traloi").click(function(){
		$root=$(this).parents(".answer");
		$root.find("#frm_answer").show(500);
	})
	$(".answer .views").click(function(){
		$root=$(this).parents(".answer");
		if($(this).hasClass("active")){
			$(this).removeClass("active");
			$(this).text("Xem trả lời");
			$root.find(".box_content_answer").hide(500);
		}else{
			$(this).addClass("active");
			$(this).text("Thu gọn");
			$root.find(".box_content_answer").show(500);
		}
		
	})
	$("#frm_answer .btn-danger").click(function(){
		$(this).parents("#frm_answer").hide(500);
	})
	$("#frm_answer").submit(function(){
		$obj=$(this);
		$root=$(this).parents(".answer");
		$.ajax({
			url:"ajax/xuly.php",
			data:$("#frm_answer").serialize(),
			type:"POST",
			success: function(data) { 
				$k=$.parseJSON(data);
				if($k.stt==1){
					//$root.find(".content_answer").prepend($k.kq);
					$root.find(".content_answer").append($k.kq);
					$obj.hide(500);
					//remove_answer();
					$root.find(".views").addClass("active");
					$root.find(".views").val("Thu gọn");
					$root.find(".box_content_answer").show(500);
					$obj.reset();
				}else{
					alert("Trả lời thất bại. Bạn vui lòng thử lại")
				}
				
			} 
		})
		return false;
	})
})
function checkLimit(){
	$tt = parseInt($("#total").val());
	$cr = parseInt($("#current").val());
	
	if($cr < $tt){
		
		$("#page-nav").removeClass("hide").find("a").html("Xem thêm "+($tt-$cr)+" bình luận <span class='caret'></span>");
	}else{
		$("#page-nav").addClass("hide");
	}


}
function checkLimit1(){
	$tt = parseInt($obj.find("#total1").val());
	$cr = parseInt($obj.find("#current1").val());
	
	if($cr < $tt){
		
		$obj.find("#page-nav1").removeClass("hide").find("a").html("Xem thêm "+($tt-$cr)+" trả lời <span class='caret'></span>");
	}else{
		$obj.find("#page-nav1").addClass("hide");
	}
}
function initAjax(options){
  var defaults = { 
    url:      '', 
    type:    'post', 
	data:null,
    dataType:  'html', 
    error:  function(e){console.log(e)},
	success:function(){return false;},
	beforeSend:function(){},
  }; 

  // Overwrite default options 
  // with user provided ones 
  // and merge them into "options". 
  var options = $.extend({}, defaults, options); 
	$.ajax({
		url:options.url,
		data:options.data,
		success:options.success,
		error:options.error,
		type:options.type,
		dataType:options.dataType,
		
	})
	

}
$(document).ready(function(){
	$(".video_lq").change(function() {
        var a = "https://www.youtube.com/embed/" + $(this).val();
        return $(".viewvideo iframe").attr("src", a), !1
    });
	$('#iview').iView({
		pauseTime: 7000,
		pauseOnHover: false,
		directionNav: false,
		directionNavHide: false,
		directionNavHoverOpacity: 1,
		controlNav: false,
		nextLabel: "Nächste",
		previousLabel: "Vorherige",
		playLabel: "Spielen",
		pauseLabel: "Pause",
		timer: "false",
		timerPadding: 3,
		timerColor: "#0F0"
	});
	$(".item_question").click(function(){
		if($(this).hasClass("active")){
			$(this).removeClass("active");
			$(".item_question").find(".cont").slideUp();
		}else{
			$(".item_question").removeClass("active");
			$(this).addClass("active");
			$(".item_question").find(".cont").slideUp();
			$(this).find(".cont").slideDown();
		}
	})
	$("#buy-now").click(function(){
		$id=$(this).data("id");
		addtocart1($id,1);
	})
	$('#info_deals #tab_content li a').click(function(){
		$rel=$(this).attr("rel");
		//$('#info_deals .content_tab').height("0");
		//$($rel).height($($rel).data("height"));
		$('#info_deals #tab_content li').removeClass("selected");
		$('#info_deals .content_tab').removeClass("selected");
		$(this).parents("li").addClass("selected");
		$($rel).addClass("selected");
	})
	$('#select_tab').change(function(){
		$rel=$(this).val();
		$('#info_deals #tab_content li').removeClass("selected");
		$('#info_deals .content_tab').removeClass("selected");
		$(this).parents("li").addClass("selected");
		$($rel).addClass("selected");
	})
	$(".danhmuc li").hover(function(){
		$(this).find("ul").slideDown(500);
	},function(){
		$(this).find("ul").slideUp(500);
	})
	$(window).scroll(function(){
		var scrollTop  = $(window).scrollTop();
		if(scrollTop > 35){
			$('header').addClass('fixed');
			$("#main").css({"margin-top":$("header").height()});
			$(".mid-header").css({"padding":"0","background-color":"rgba(255,255,255,0.9)"});
		}else{
			$('header').removeClass('fixed');
			$("#main").css({"margin-top":"0px"});
			$(".mid-header").css({"padding":"15px 0","background-color":"white"});
		}
	});
	$("#li-dmsp").mouseenter(function(){
		$("#menu-dmsp").fadeIn();
	});
	$("#menu-dmsp").mouseleave(function(){
		$(this).fadeOut();
	});
	$("#li-km").mouseenter(function(){
		$("#menu-km").fadeIn();
	});
	$("#menu-km").mouseleave(function(){
		$(this).fadeOut();
	});
	/* $('.content_product img,.container_mid .content img').css({"max-width":"100%","height":"auto"}); //responsive img cho bai viet chi tiet */
	$(".spkm-owl").owlCarousel({
		loop:true,
		margin:0,
		responsive:{
			0:{
				items:1,
			},
			600:{
				items:2,
			},
			800:{
				items:3,
			},
			1000:{
				items:3,
			},
			1200:{
				items:3,
			}
		},
		nav:true,
		autoplay: true,
		navText: true,
		dots: false,
		scrollPerPage: 1,
		slideSpeed: 500,
		autoplayTimeout:5000,
		autoplayHoverPause:true
	});
	$(".spkm-tablink-1").click(function() {
		$(".spkm-tabcontent").removeClass("spkm-turn-on");
		$(".spkm-tabcontent-1").addClass("spkm-turn-on");
		$(".spkm-tablink").removeClass("active");
		$(this).addClass("active");
	});
	$(".spkm-tablink-2").click(function() {
		$(".spkm-tabcontent").removeClass("spkm-turn-on");
		$(".spkm-tabcontent-2").addClass("spkm-turn-on");
		$(".spkm-tablink").removeClass("active");
		$(this).addClass("active");
	});
	$(".sp-owl").owlCarousel({
		loop:true,
		margin:0,
		responsive:{
			0:{
				items:1,
			},
			600:{
				items:2,
			},
			800:{
				items:3,
			},
			1000:{
				items:3,
			},
			1200:{
				items:3,
			}
		},
		nav:true,
		autoplay: true,
		navText: true,
		dots: false,
		scrollPerPage: 1,
		slideSpeed: 500,
		autoplayTimeout:5000,
		autoplayHoverPause:true
	});
	$(".sp-trai .sp-tablink:first-child").addClass("active");
	$(".sp-phai .sp-tabcontent:first-child").addClass("spkm-turn-on");
	$(".owl-tintuc").owlCarousel({
		loop:true,
		margin:20,
		responsive:{
			0:{
				items:1,
			},
			600:{
				items:2,
			},
			800:{
				items:3,
			},
			1000:{
				items:4,
			},
			1200:{
				items:4,
			}
		},
		nav:true,
		autoplay: true,
		navText: true,
		dots: false,
		scrollPerPage: 1,
		slideSpeed: 500,
		autoplayTimeout:5000,
		autoplayHoverPause:true
	});
	$(".owl-ykien").owlCarousel({
		loop:true,
		margin:0,
		responsive:{
			0:{
				items:1,
			},
			600:{
				items:1,
			},
			800:{
				items:1,
			},
			1000:{
				items:1,
			},
			1200:{
				items:1,
			}
		},
		nav:true,
		autoplay: true,
		navText: true,
		dots: false,
		scrollPerPage: 1,
		slideSpeed: 500,
		autoplayTimeout:5000,
		autoplayHoverPause:true
	});
	$(".owl-spct").owlCarousel({
		loop:true,
		margin:0,
		responsive:{
			0:{
				items:2,
			},
			600:{
				items:2,
			},
			800:{
				items:3,
			},
			1000:{
				items:3,
			},
			1200:{
				items:3,
			}
		},
		nav:true,
		autoplay: true,
		navText: true,
		dots: false,
		scrollPerPage: 1,
		slideSpeed: 500,
		autoplayTimeout:5000,
		autoplayHoverPause:true
	});
	$(".numbers-row").append('<div class="inc button">-</div><div class="dec button">+</div>');
	$(".button").on("click", function() {
    var $button = $(this);
    var oldValue = $button.parent().find("input").val();
    if ($button.text() == "+") {
		var newVal = parseFloat(oldValue) + 1;
  	} else {
	   // Don't allow decrementing below zero
		if (oldValue > 0) {
        var newVal = parseFloat(oldValue) - 1;
	    } else {
        newVal = 0;
		}
	}
    $button.parent().find("input").val(newVal);
	});
	$(".nut-mua").click(function() {
		var id = $(this).data("id");
		loadToCart(id,1);
	});
	$(".nut-them").click(function() {
		var id = $(this).data("id");
		addtocart(id,1);
	});
	$(".spct-mua").click(function() {
		var id = $(this).data("id");
		var sl = $("#french-hens").val();
		loadToCart(id,sl);
	});
	$(".spct-them").click(function() {
		var id = $(this).data("id");
		var sl = $("#french-hens").val();
		addtocart(id,sl);
	});
	$(".checkbox_search").click(function() {
		var checkValue = $(this).val();
		if(checkValue==3) {
			$(".ht-thanhtoan-bao").fadeIn();
		} else {
			$(".ht-thanhtoan-bao").fadeOut();
		}
	});
	$('.httt-tab').click(function(){
		var rel=$(this).attr("rel");
		$('.httt-tab').removeClass("active");
		$('.ht-thanhtoan-nd').css({"display":"none"});
		$(this).addClass("active");
		$(rel).fadeIn();
	});
	$("#thanhtoan-div").click(function() {
		swal({
            title: "THÔNG BÁO ĐẶT HÀNG",
            text: "Freeship toàn quốc, KH sẽ nhận hàng trong vòng 8 tiếng đối với các quân nội thành TP.HCM, 12 tiếng đối với các quận vùng ven, 48 tiếng đối với khu vực phía nam và 72 tiếng đối với khu vực phía Bắc",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Đồng ý",
            cancelButtonText: "Hủy",
            closeOnConfirm: false,
            closeOnCancel: false},
			function (isConfirm) {
	            if (isConfirm) {
	            	if(checkThanhToan()) {
	            		swal("THÔNG BÁO", "Vui Lòng Điền Đầy Đủ Thông Tin", "warning");
	            	} else {
	            		swal("THÔNG BÁO", "Đặt Hàng Thành Công", "success");
	                	setTimeout(function() {
						$("#thanhtoan-btn").click();
						}, 1500);
	            	}
	            } else {
	                swal("THÔNG BÁO", "Đã Hủy", "error");
            }
        });
	});
})

function loadToCart(id,sl){
	$.ajax({
		type:'post',
		url:"gio-hang",
		data:{id:id,sl:sl,act:'add'},
		success:function(data){
			location.href = "gio-hang.html";
		}
	})
	return false;
}

function addtocart(id,sl){
	$.ajax({
		type:'post',
		url:"gio-hang",
		data:{id:id,sl:sl,act:'add'},
		success:function(data){
			var myObj = JSON.parse(data);
			$("#cart-number").html(myObj.num);
			swal({
				position: 'top-end',
				type: 'success',
				title: 'Bạn đã thêm vào giỏ hàng thành công'
			});
		}
	})
	return false;
}

function updateCartNum(){
	$.get("index.php",{ajax:"number"},function(data){
		
		$("#cart-number").html(data);
	});
}

function checkThanhToan() {
	if($("#hoten").val()=="") {
		return true;
	}
	if($("#diachi").val()=="") {
		return true;
	}
	if($("#dienthoai").val()=="") {
		return true;
	}
	if($("#email").val()=="") {
		return true;
	}
	return false;
}