<?php /* if($_SESSION['chat_facebook']==1) { ?>
<style>
	div.chat_facebook
	{
		position:fixed;
		right:-110px;
		bottom:-300px;
		width:250px;
		z-index:99999999999999;
	}
	div.tieude_chat {
		background: #ae1f24;
		color: #fff;
		width: 70%;
		padding: 10px 7px;
		font-size: 15px;
		cursor: pointer;
		font-family: robotobold;
		text-align: center;
	}
	@media screen and (max-width: 800px) {
		div.chat_facebook
		{
			position:fixed;
			right:-110px;
			bottom:-300px;
			width:250px;
			z-index:99999999999999;
		}
	}
</style>
<?php }else { ?>
<style>
	div.chat_facebook
	{
		position:fixed;
		right:0;
		bottom:0;
		width:250px;
		z-index:99999999999999;
	}
	div.tieude_chat
	{
		background: #ae1f24;
	    color: #fff;
	    width: 70%;
	    padding: 10px 7px;
	    font-size: 15px;
	    cursor: pointer;
	    font-family: robotobold;
	    text-align: center;
	}
	@media screen and (max-width: 800px) {
		div.chat_facebook
		{
			position:fixed;
			right:-110px;
			bottom:-300px;
			width:250px;
			z-index:99999999999999;
		}
	}
</style>
<?php } ?>
<div class="chat_facebook"><div class="tieude_chat">Facebook chat</div>
	<div class='fb-page chat-item' data-adapt-container-width='true' data-height='300' data-hide-cover='false' data-href='<?=$company['fanpage']?>' data-show-facepile='true' data-show-posts='false' data-small-header='false' data-tabs='messages' data-width='250'></div>
</div>

<script type="text/javascript">
	$(document).ready(function(e) {
        $('.tieude_chat').click(function(){
			if($('.chat_facebook').css('right')=='0px')
			{
				$('.chat_facebook').animate({bottom:-300},500).animate({right:-110},300);
			}
			else
			{
				$('.chat_facebook').animate({right:0},300).animate({bottom:0},500);
			}
			$.ajax({
				url:'ajax/tao_session.php',
				success:function(kq){
					console.log(kq);
				}
			});
		});
    });
</script>
*/?>
<div class="chat_facebook">
	<a href="javascript:" class="button_chat2">
		Facebook chat
	</a>
	<div class="contain_chatpopup2">
		
		 <div class="fb-page" data-tabs="messages" data-href="<?=$row_setting["facebook"]?>" data-width="250" data-height="290" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="false" data-show-posts="false"></div>
	</div><!--end contain chat popup-->
</div><!---->
<script>
	$(document).ready(function(){
		var this_height=$('.contain_chatpopup2').width();
		$('.chat_facebook').css({'bottom':-this_height});
		//$('.chat_popup').css({'right':0});
		$('.button_chat2').click(function(){
		//alert('asd');
		
		
		var this_button=$(this);
		
		if(!this_button.hasClass('move_button')){
			this_button.addClass('move_button');
			setTimeout(function(){
			/*if(this_button.hasClass('onlick')){
				$('.chat_popup2').css({'bottom':-this_height});
				this_button.removeClass('onlick')
				this_button.removeClass('move_button');
			}else{*/
				$('.chat_facebook').css({'bottom':0});
				this_button.addClass('onlick')
			//}
			},300);
		}else{
			
			$('.chat_facebook').css({'bottom':-this_height});
			setTimeout(function(){
				this_button.removeClass('onlick');
				this_button.removeClass('move_button');
			},400);
			
		}
		
		
			
			
			
		});
	});
</script>
<style>


.button_chat2{background:#3b5998;font-size:14px;color:#fff !important;padding:10px 10px;position:absolute;top:-34px;right:15px;border:1px solid #E9EAED;cursor:pointer;-webkit-transition:all 0.3s;-moz-transition:all 0.3s;-o-transition:all 0.3s;-ms-transition:all 0.3s;transition:all 0.3s;transition-timing-function:linear;}
.onclick{transition-delay:3s;}

.chat_facebook{position:fixed;right:0px;z-index:999;bottom:-30px;-webkit-transition:all 0.5s;-moz-transition:all 0.5s;-o-transition:all 0.5s;-ms-transition:all 0.5s;transition:all 0.5s;}
.contact{float:left;}

.button_chat2{position:absolute;top:-70px;}
.move_button{right:174px;top:-40px}

.contain_chatpopup2{width:290px;background:#fff;min-height:290px;}
.contain_chatpopup2 img{vertical-align:middle;}
</style>
