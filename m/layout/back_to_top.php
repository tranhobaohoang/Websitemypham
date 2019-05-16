<!--Nut Back-->
<style type="text/css">       
        #toptop {
			z-index: 99999;
			padding: 15px;
			background-color: white;
			border: 1px solid #CCC;
			position: fixed;
			background: transparent url(assets/images/arrow_up.png) no-repeat top left;
			background-position: 50% 50%;
			width: 20px;
			height: 20px;
			bottom: 20px;
			opacity: 0.7;
			left: 30px;
			white-space: nowrap;
			cursor: pointer;
			border-radius: 3px 3px 0 0;	
        }
</style>
<script type="text/javascript">
        $(document).ready(function() {
            $('body').append('<div id="toptop"></div>');
           $(window).scroll(function() {
            if($(window).scrollTop() != 0) {
                $('#toptop').fadeIn();
            } else {
                $('#toptop').fadeOut();
            }
           });
           $('#toptop').click(function() {
            $('html, body').animate({scrollTop:0},800);
           });
        });
     </script>
<!--Nut Back-->