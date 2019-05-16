<div class="callme">
	<a href="tel:<?=$row_setting["hotline"]?>">
		<div class="bounce">
			<i class="fa fa-phone"></i>
		</div>
		<span><?=$row_setting["hotline"]?></span>
	</a>
</div>
<a href="tel:<?=$row_setting["hotline"]?>" class="suntory-alo-phone suntory-alo-green" id="suntory-alo-phoneIcon" style="left: 0px; bottom: 0px;">
	<div class="suntory-alo-ph-circle"></div>
	<div class="suntory-alo-ph-circle-fill"></div>
	<div class="suntory-alo-ph-img-circle"><img src="http://dienlanh779.com/images/phone.png" alt="phone"></div>
</a>
<style>
	.suntory-alo-phone {
		background-color: transparent;
		cursor: pointer;
		height: 120px;
		position: fixed;
		transition: visibility 0.5s ease 0s;
		width: 120px;
		z-index: 200000 !important;
	}
	.suntory-alo-ph-circle {
		animation: 1.2s ease-in-out 0s normal none infinite running suntory-alo-circle-anim;
		background-color: transparent;
		border: 2px solid rgba(30, 30, 30, 0.4);
		border-radius: 100%;
		height: 100px;
		left: 0px;
		opacity: 0.1;
		position: absolute;
		top: 0px;
		transform-origin: 50% 50% 0;
		transition: all 0.5s ease 0s;
		width: 100px;
	}
	.suntory-alo-ph-circle-fill {
		animation: 2.3s ease-in-out 0s normal none infinite running suntory-alo-circle-fill-anim;
		border: 2px solid transparent;
		border-radius: 100%;
		height: 70px;
		left: 15px;
		position: absolute;
		top: 15px;
		transform-origin: 50% 50% 0;
		transition: all 0.5s ease 0s;
		width: 70px;
	}
	.suntory-alo-ph-img-circle {
		/* animation: 1s ease-in-out 0s normal none infinite running suntory-alo-circle-img-anim; */
		border: 2px solid transparent;
		border-radius: 100%;
		height: 50px;
		left: 25px;
		opacity: 1;
		position: absolute;
		top: 25px;
		transform-origin: 50% 50% 0;
		width: 50px;
		border:3px solid #fff000;
	}
	.suntory-alo-phone.suntory-alo-hover, .suntory-alo-phone:hover {
		opacity: 1;
	}
	.suntory-alo-phone.suntory-alo-active .suntory-alo-ph-circle {
		animation: 1.1s ease-in-out 0s normal none infinite running suntory-alo-circle-anim !important;
	}
	.suntory-alo-phone.suntory-alo-static .suntory-alo-ph-circle {
		animation: 2.2s ease-in-out 0s normal none infinite running suntory-alo-circle-anim !important;
	}
	.suntory-alo-phone.suntory-alo-hover .suntory-alo-ph-circle, .suntory-alo-phone:hover .suntory-alo-ph-circle {
		border-color: #00aff2;
		opacity: 0.5;
	}
	.suntory-alo-phone.suntory-alo-green.suntory-alo-hover .suntory-alo-ph-circle, .suntory-alo-phone.suntory-alo-green:hover .suntory-alo-ph-circle {
		border-color: #f00;
		opacity: 1;
	}
	.suntory-alo-phone.suntory-alo-green .suntory-alo-ph-circle {
		border-color: #fff000;
		opacity: 1;
	}
	.suntory-alo-phone.suntory-alo-hover .suntory-alo-ph-circle-fill, .suntory-alo-phone:hover .suntory-alo-ph-circle-fill {
		background-color: rgba(0, 175, 242, 0.9);
	}
	.suntory-alo-phone.suntory-alo-green.suntory-alo-hover .suntory-alo-ph-circle-fill, .suntory-alo-phone.suntory-alo-green:hover .suntory-alo-ph-circle-fill {
		background-color: #02A6E8;
	}
	.suntory-alo-phone.suntory-alo-green .suntory-alo-ph-circle-fill {
		background-color: #02A6E8;
	}

	.suntory-alo-phone.suntory-alo-hover .suntory-alo-ph-img-circle, .suntory-alo-phone:hover .suntory-alo-ph-img-circle {
		background-color: #00aff2;
	}
	.suntory-alo-phone.suntory-alo-green.suntory-alo-hover .suntory-alo-ph-img-circle, .suntory-alo-phone.suntory-alo-green:hover .suntory-alo-ph-img-circle {
		background-color: #02A6E8;
	}
	.suntory-alo-phone.suntory-alo-green .suntory-alo-ph-img-circle {
		background-color: #02A6E8;
	}
	@keyframes suntory-alo-circle-anim {
		0% {
			opacity: 0.1;
			transform: rotate(0deg) scale(0.5) skew(1deg);
		}
		30% {
			opacity: 0.5;
			transform: rotate(0deg) scale(0.7) skew(1deg);
		}
		100% {
			opacity: 0.6;
			transform: rotate(0deg) scale(1) skew(1deg);
		}
	}

	@keyframes suntory-alo-circle-img-anim {
		0% {
			transform: rotate(0deg) scale(1) skew(1deg);
		}
		10% {
			transform: rotate(-25deg) scale(1) skew(1deg);
		}
		20% {
			transform: rotate(25deg) scale(1) skew(1deg);
		}
		30% {
			transform: rotate(-25deg) scale(1) skew(1deg);
		}
		40% {
			transform: rotate(25deg) scale(1) skew(1deg);
		}
		50% {
			transform: rotate(0deg) scale(1) skew(1deg);
		}
		100% {
			transform: rotate(0deg) scale(1) skew(1deg);
		}
	}
	@keyframes suntory-alo-circle-fill-anim {
		0% {
			opacity: 0.2;
			transform: rotate(0deg) scale(0.7) skew(1deg);
		}
		50% {
			opacity: 0.2;
			transform: rotate(0deg) scale(1) skew(1deg);
		}
		100% {
			opacity: 0.2;
			transform: rotate(0deg) scale(0.7) skew(1deg);
		}
	}
	.suntory-alo-ph-img-circle img {
    animation: 1s ease-in-out 0s normal none infinite running suntory-alo-circle-img-anim;
    font-size: 30px;
    line-height: 39px;

    color: #fff;
	    margin-top: 10px;
    margin-left: 10px;
}

	/*=================== End phone ring ===============*/
	@keyframes suntory-alo-ring-ring {
		0% {
			transform: rotate(0deg) scale(1) skew(1deg);
		}
		10% {
			transform: rotate(-25deg) scale(1) skew(1deg);
		}
		20% {
			transform: rotate(25deg) scale(1) skew(1deg);
		}
		30% {
			transform: rotate(-25deg) scale(1) skew(1deg);
		}
		40% {
			transform: rotate(25deg) scale(1) skew(1deg);
		}
		50% {
			transform: rotate(0deg) scale(1) skew(1deg);
		}
		100% {
			transform: rotate(0deg) scale(1) skew(1deg);
		}
	}
</style>