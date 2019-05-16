<link href="css/animate_ls.css" rel="stylesheet" type="text/css" />
<script src="js/animate_ls.js"></script>

<div id="wrap_lichsu" class="clearfix">
	<div id="middle">
    	<div class="lacaphe"></div>
       	<div class="background"></div>
        <div class="conduong">
        </div>
        <div class="sonam">
        		<a class="1947 yr1992 tn-ls-year active"></a>
				<span class="slice"></span>     
        		<a class="1991 yr1996 tn-ls-year"></a>
				<span class="slice"></span>     
        		<a class="1999 yr1998 tn-ls-year"></a>
				<span class="slice"></span>     
            	<a class="2009 yr2001 tn-ls-year"></a>
				<span class="slice"></span>             
                <a class="2015 yr2002 tn-ls-year"></a>
        </div>
 	</div>
    <div class="consolichsu">
    	<div class="animate">
        	<div class="left_button"></div>
            <div class="cach"></div>
            <div class="conso"></div>
            <div class="cach"></div>
            <div class="right_button"></div>
        </div>
    </div>
    <div class="contents">
     	<div class="ct_scroll"> 
        	<?php for($i=0;$i<count($lichsu);$i++){?>
          	<div class="ct">  
            	<h3><?=$lichsu[$i]['ten_'.$lang]?></h3>
            	<p><?=$lichsu[$i]['mota_'.$lang]?></p>
             </div> 
			 <?php }?>
         </div>

    </div>

    <div class="cauchuyen" style="background-position: 4.5px 50%;"></div>
</div>
