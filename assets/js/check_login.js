function IsNumeric(sText)
{
    var ValidChars = "0123456789";
    var IsNumber = true;
    var Char;

    for (i = 0; i < sText.length && IsNumber == true; i++)
    {
        Char = sText.charAt(i);
        if (ValidChars.indexOf(Char) == -1)
        {
            IsNumber = false;
        }
    }
    return IsNumber;
}
function check_email(email)
{
    emailRegExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/;
    return emailRegExp.test(email);
}

function validEmail(email){
	emailRegExp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$/;
    return emailRegExp.test(email);
}
	
function finishAjax(parent, id, response) {
    $('#' + parent).hide();
    $('#' + id).html(unescape(response));
    $('#' + id).fadeIn();
}
;
function finishAjax1(id, response) {
    $('#emailLoading').hide();
    $('#' + id).html(unescape(response));
    $('#' + id).fadeIn();
}
function finishAjax3(id, response) {
    $('#RegLoading').hide();
    $('#' + id).html(unescape(response));
    $('#' + id).fadeIn();
}
function fillme(name,id) {
        $("#tendoanhnghiep").val(name);
		$("#id_dn").val(id);
        $(".load_dn").html('');
		$.ajax({
			type: "POST",
			url: "ajax/check.php",
			data: {username:name, act: 'checkdoanhnghiep'},
			success:function(data){
				var kh = $.parseJSON(data);
				$("#sodt").val(kh.dienthoai);
				$("#ngaysinh").val(kh.date);
				$("#email").val(kh.email);
				
				$("#province").html(kh.load_province);
				$("#district").html(kh.load_district);
				$("#nganhnghe").html(kh.load_nganhnghe);
				$("#diachi").val(kh.diachi);
				$('#tenResult_tv').fadeOut();
				setTimeout("finishAjax('tenLoading_tv','tenResult_tv', '" + escape(kh.thongbao) + "')", 400);
				//console.log(kh);
			}
		});
    }
$(document).ready(function () {
	$('#tenLoading_tv').hide()
//Kiem tra user thành viên
    $('#usernameLoading').hide();
    $('#username').blur(function () {
		if($('#username').val()!=''){
			$('#usernameLoading').show();
			$.post("ajax/check.php", {
				act: "checkuser_tv",
				username: $('#username').val()
			}, function (response) {
				$('#usernameResult').fadeOut();
				setTimeout("finishAjax('usernameLoading','usernameResult', '" + escape(response) + "')", 400);
			});
		}else{
			$('#usernameLoading').show();
			setTimeout("finishAjax('usernameLoading','usernameResult', 'Bạn chưa nhập tài khoản')", 400);
		}
        return false;
    });
//Kiem tra mật khẩu
    $('#matkhauLoading_tv').hide();
    $('#matkhau_tv').blur(function () {
        $('#matkhauLoading_tv').show();
		if($('#matkhau_tv').val()!=''){
			$.post("ajax/check.php", {
				act: "checkpass_tv",
				matkhau: $('#matkhau_tv').val()
			}, function (response) {
				$('#matkhauResult_tv').fadeOut();
				setTimeout("finishAjax('matkhauLoading_tv','matkhauResult_tv', '" + escape(response) + "')", 400);
			});
        }else{
			setTimeout("finishAjax('matkhauLoading_tv','matkhauResult_tv', 'Bạn chưa nhập mật khẩu')", 400);
		}
    });

//Kiem tra nhập lại mật khẩu
    $('#golaimatkhauLoading_tv').hide();
    $('#golaimatkhau_tv').blur(function () {
        $('#golaimatkhauLoading_tv').show();
		if($('#golaimatkhau_tv').val()!=''){
			$.post("ajax/check.php", {
				act: "checkrepass_tv",
				pass:$('#matkhau_tv').val(),
				repass: $('#golaimatkhau_tv').val()
			}, function (response) {
				$('#golaimatkhauResult_tv').fadeOut();
				setTimeout("finishAjax('golaimatkhauLoading_tv','golaimatkhauResult_tv', '" + escape(response) + "')", 400);
			});
		}else{
			setTimeout("finishAjax('golaimatkhauLoading_tv','golaimatkhauResult_tv', 'Bạn chưa nhập lại mật khẩu')", 400);
		}
        return false;
    });
    $('#RegLoading').hide();
//Kiem tra email
    $('#emailLoading').hide();
    $('#email').blur(function () {
		
		$('#emailLoading').show();
		$.post("ajax/check.php", {
			email: $('#email').val(),
			act:"checkemail",
		}, function (response) {
			$('#emailResult').fadeOut();
			setTimeout("finishAjax1('emailResult', '" + escape(response) + "')", 400);
		});
		return false;
		
    });

    $('#capt').blur(function () {
        $('#capcharLoading').show();
		if($('#capt').val()==''){
			setTimeout("finishAjax('capcharLoading','capcharResult', 'Bạn chưa nhập mã bảo vệ!')", 400);
		} else {
			$('#capcharLoading, #capcharResult').hide();
		}
    });
});


function re_capcha()
{
	document.getElementById('vimg').src = "./captcha_image.php";
}
function check()
{
    var frm = document.formdktv;
    $('#RegLoading').show();
	if (frm.ten.value == '')
    {
        alert("Bạn chưa điền họ tên.");
        frm.ten.focus();
        $('#RegLoading').hide();
        return false;
    }
	if (frm.username.value == '')
    {
        alert("Bạn chưa nhập tài khoản.");
        frm.matkhau_tv.focus();
        $('#RegLoading').hide();
        return false;
    }
    if (frm.matkhau_tv.value == '')
    {
        alert("Bạn chưa nhập mật khẩu.");
        frm.matkhau_tv.focus();
        $('#RegLoading').hide();
        return false;
    }
    if (frm.golaimatkhau_tv.value == '')
    {
        alert("Bạn chưa nhập lại mật khẩu");
        frm.golaimatkhau_tv.focus();
        $('#RegLoading').hide();
        return false;
    }
    if (!validEmail(frm.email.value)) {
        alert('Vui lòng nhập đúng địa chỉ email');
        frm.email.focus();
        $('#RegLoading').hide();
        return false;
    }
	if (frm.capt.value == '')
    {
        alert("Bạn chưa nhập mã bảo vệ");
        frm.capt.focus();
        $('#RegLoading').hide();
        return false;
    }
	var currentLocation = window.location;
    $.post("ajax/user.php", {
        username: $('#username').val(),
        matkhau: $('#matkhau_tv').val(),
        golaimatkhau: $('#golaimatkhau_tv').val(),
        ten: $('#ten').val(),
        email: $('#email').val(),
		capt: $('#capt').val(),
        act: 'reg'
    }, function (response) {
		$k=$.parseJSON(response);
        $('#RegResult').fadeOut();
        setTimeout("finishAjax3('RegResult', '" + escape($k.thongbao) + "')", 400);
		if($k.id==1){
			setTimeout(function(){
				location.href=base_url+"/dang-nhap.html";
			}, 3000);
		}
		
    });
}
function check_kh()
{
    var frm = document.formdkkh;
	console.log(frm.sodt.value);
    $('#RegLoading').show();
	if (!validEmail(frm.email_kh.value)) {
        alert('Vui lòng nhập đúng địa chỉ email');
        frm.email_kh.focus();
        $('#RegLoading').hide();
        return false;
    }
	if (frm.ten.value == '')
    {
        alert("Bạn chưa điền họ tên.");
        frm.ten.focus();
        $('#RegLoading').hide();
        return false;
    }
	
    if (frm.sodt.value == '')
    {
        alert("Bạn chưa nhập số điện thoại.");
        frm.sodt.focus();
        $('#RegLoading').hide();
        return false;
    }
	if (!IsNumeric(frm.sodt.value))
    {
        alert("Số điện thoại không đúng.");
        frm.sodt.focus();
        $('#RegLoading').hide();
        return false;
    }
    if (frm.diachi.value == '')
    {
        alert("Bạn chưa nhập địa chỉ");
        frm.diachi.focus();
        $('#RegLoading').hide();
        return false;
    }
    
	var currentLocation = window.location;
    $.post("ajax/user.php", {
        // username: $('#username_tv').val(),
        dienthoai: $('#sodt').val(),
        diachi: $('#diachi').val(),
        ten: $('#ten').val(),
        email: $('#email_kh').val(),
		khoahoc: $('#khoahoc').val(),
        act: 'reg_khoahoc'
    }, function (response) {
		$k=$.parseJSON(response);
        $('#RegResult').fadeOut();
        setTimeout("finishAjax3('RegResult', '" + escape($k.thongbao) + "')", 400);
		if($k.id==1){
			setTimeout(function(){
				location.href=$k.url;
			}, 3000);
		}
		
    });
}

function finishAjax_login(id, response) {
    $('#LoginLoading').hide();
    $('#' + id).html(unescape(response));
    $('#' + id).fadeIn();
}
;
function finishAjax_reset(id, response) {
    $('#ResetLoading').hide();
    $('#' + id).html(unescape(response));
    $('#' + id).fadeIn();
}
;

function login_check()
{
	var currentLocation = window.location;
    var frm = document.dangnhap;
    $('#LoginLoading').show();
    if (frm.login_username.value == '')
    {
        alert("Bạn chưa điền tên đăng nhập.");
        frm.login_username.focus();
        $('#LoginLoading').hide();
        return false;
    }
    if (frm.login_matkhau.value == '')
    {
        alert("Bạn chưa điền mật khẩu.");
        frm.login_matkhau.focus();
        $('#LoginLoading').hide();
        return false;
    }



    $.post("ajax/user.php", {
        username: $('#login_username').val(),
        matkhau: $('#login_matkhau').val(),
        act: 'login'
    }, function (response) {
		$k=$.parseJSON(response);
        $('#LoginResult').fadeOut();
        setTimeout("finishAjax_login('LoginResult', '" + escape($k.thongbao) + "')", 400);
		if($k.id==1){
			setTimeout(function(){
				location.href=base_url+"/quan-ly-ca-nhan.html";
			}, 3000);
		}
    });
}
function login_check_gv()
{
	var currentLocation = window.location;
    var frm = document.dangnhap;
    $('#LoginLoading').show();
    if (frm.login_username.value == '')
    {
        alert("Bạn chưa điền tên đăng nhập.");
        frm.login_username.focus();
        $('#LoginLoading').hide();
        return false;
    }
    if (frm.login_matkhau.value == '')
    {
        alert("Bạn chưa điền mật khẩu.");
        frm.login_matkhau.focus();
        $('#LoginLoading').hide();
        return false;
    }



    $.post("ajax/user.php", {
        username: $('#login_username').val(),
        matkhau: $('#login_matkhau').val(),
        act: 'login_gv'
    }, function (response) {
		$k=$.parseJSON(response);
        $('#LoginResult').fadeOut();
        setTimeout("finishAjax_login('LoginResult', '" + escape($k.thongbao) + "')", 400);
		if($k.id==1){
			setTimeout(function(){
				location.href=base_url+"/thong-tin-giao-vien.html";
			}, 3000);
		}
    });
}
function reset_check()
{
    var frm = document.resetpass;
    $('#ResetLoading').show();
    if (!validEmail(frm.email_reset.value)) {
        alert('Vui lòng nhập đúng địa chỉ email');
        frm.email_reset.focus();
        $('#ResetLoading').hide();
        return false;
    }
	if (frm.username_reset.value == '')
    {
        alert("Bạn chưa điền username.");
        frm.username_reset.focus();
        $('#ResetLoading').hide();
        return false;
    }
    if (frm.capt_reset.value == '')
    {
        alert("Bạn chưa điền mã bảo vệ.");
        frm.capt_reset.focus();
        $('#ResetLoading').hide();
        return false;
    }


    $.post("ajax/user.php", {
        email: $('#email_reset').val(),
        username: $('#username_reset').val(),
        capt: $('#capt_reset').val(),
        act: 'lostpw'
    }, function (response) {
		$k=$.parseJSON(response);
        $('#ResetResult').fadeOut();
        setTimeout("finishAjax_reset('ResetResult', '" + escape($k.msg) + "')", 400);
		if($k.stt==1){
			setTimeout(function(){
				location.href=base_url+"/trang-chu.html";
			}, 3000);
		}else{
			return false;
		}
    });
}
function dologin(evt) {
    // IE					// Netscape/Firefox/Opera
    var key;
    if (evt.keyCode == 13 || evt.which == 13) {
        login_check();
    }
}
function finishAjax_tt(id, response) {
    $('#RegLoading').hide();
    $('#' + id).html(unescape(response));
    $('#' + id).fadeIn();
}
$(document).ready(function () {
    $('#RegLoading').hide();
});


function IsNumeric(sText)
{
    var ValidChars = "0123456789";
    var IsNumber = true;
    var Char;

    for (i = 0; i < sText.length && IsNumber == true; i++)
    {
        Char = sText.charAt(i);
        if (ValidChars.indexOf(Char) == -1)
        {
            IsNumber = false;
        }
    }
    return IsNumber;
}

function check_info()
{
    var frm = document.forminfo;
    $('#RegLoading').show();


    if (frm.sodt.value == '')
    {
        alert("Bạn chưa điền số điện thoại.");
        frm.sodt.focus();
        $('#RegLoading').hide();
        return false;
    }
    if (frm.ten.value == '')
    {
        alert("Bạn chưa điền tên.");
        frm.ten.focus();
        $('#RegLoading').hide();
        return false;
    }
    if (frm.diachi.value == '')
    {
        alert("Bạn chưa điền địa chỉ.");
        frm.diachi.focus();
        $('#RegLoading').hide();
        return false;
    }
    if (frm.capt_tt.value == '')
    {
        alert("Bạn chưa điền mã bảo vệ.");
        frm.capt_tt.focus();
        $('#RegLoading').hide();
        return false;
    }



    if (!IsNumeric(frm.sodt.value))
    {
        alert("Vui lòng nhập đúng số điện thoại.");
        frm.sodt.focus();
        $('#RegLoading').hide();
        return false;
    }


    $.post("ajax/user.php", {
        ten: $('#ten').val(),
        sex: $('input[name="sex"]:checked').val(),
        ngaysinh: $('#ngaysinh').val(),
        sodt: $('#sodt').val(),
        diachi: $('#diachi').val(),
        capt: $('#capt_tt').val(),
        act: 'info'
    }, function (response) {
        $('#RegResult').fadeOut();
        setTimeout("finishAjax_tt('RegResult', '" + escape(response) + "')", 400);
    });
}
/* function finishAjax3(id, response) {
    $('#PWLoading').hide();
    $('#' + id).html(unescape(response));
    $('#' + id).fadeIn();
} */
$(document).ready(function () {
    $('#PWLoading').hide();
});

function check_doipass()
{
    var frm = document.formdoipass;
    $('#PWLoading').show();

    if (frm.matkhau.value == '')
    {
        alert("Bạn chưa điền mật khẩu.");
        frm.matkhau.focus();
        $('#PWLoading').hide();
        return false;
    }
    if (frm.matkhaumoi.value == '')
    {
        alert("Bạn chưa điền mật khẩu mới.");
        frm.matkhaumoi.focus();
        $('#PWLoading').hide();
        return false;
    }
    if (frm.golaimatkhau.value == '')
    {
        alert("Bạn chưa điền lại mật khẩu mới.");
        frm.golaimatkhau.focus();
        $('#PWLoading').hide();
        return false;
    }

    if (frm.capt.value == '')
    {
        alert("Bạn chưa điền mã bảo vệ.");
        frm.capt.focus();
        $('#PWLoading').hide();
        return false;
    }

    $.post("ajax/user.php", {
        matkhau: frm.matkhau.value,
        matkhaumoi: $('#matkhaumoi').val(),
        golaimatkhau: frm.golaimatkhau.value,
        capt: frm.capt.value,
        act: 'doimatkhau'
    }, function (response) {
        $('#PWResult').fadeOut();
        setTimeout("finishAjax3('PWResult', '" + escape(response) + "')", 400);
    }
    );
}
function logout() {
	$.ajax({
		type:'post',
		url:"ajax/user.php",
		data:{act:'logout'},
		success:function(data){
			alert("Đăng xuất thành công!");
			setTimeout(function(){location.href=base_url;}, 1000);
		}
	})
	return false;
}
function changePass(id) {
	var matkhauCu = $("#matkhau_cu").val();
	var matkhauMoi = $("#matkhau_moi").val();
	var golaimatkhauMoi = $("#golaimatkhau_moi").val();
	$.ajax({
		type:'post',
		url:"ajax/user.php",
		data:{act:'doimatkhau', matkhauCu:matkhauCu, matkhauMoi:matkhauMoi, golaimatkhauMoi:golaimatkhauMoi,id:id},
		success:function(data){
			var myObj = JSON.parse(data);
			$('#RegResult').fadeOut();
			setTimeout("finishAjax3('RegResult', '" + escape(myObj.thongbao) + "')", 400);
			if(myObj.tt==1){
				setTimeout(function(){
					location.href=base_url;
				}, 2000);
			}
		}
	});
	return false;
}