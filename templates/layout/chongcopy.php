<!-- Cam clich chuot phai -->

<script type="text/javascript">
	var message="Ðây là bản quyền thuộc về <?=$company['ten']?>";
	function clickIE() {
		if (document.all) {(message);return false;}
	}
	function clickNS(e) {
		if (document.layers||(document.getElementById&&!document.all)) {
			if (e.which==2||e.which==3) {alert(message);return false;}}}
			if (document.layers) {document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;document.onselectstart=clickIE}document.oncontextmenu=new Function("return false")
		</script>
		<script type="text/javascript">
			function disableselect(e){
				return false 
			}
			function reEnable(){ 
				return true 
			} 
//if IE4+
document.onselectstart=new Function ("return false")
//if NS6
if (window.sidebar){
	document.onmousedown=disableselect 
	document.onclick=reEnable
} 
</script>

<!-- Cam clich chuot phai -->

<!-- Cam f12 và ctrl + shift + i -->
<script>
	$(document).keydown(function(event){
		if(event.keyCode==123){
			return false;
		}
		else if(event.ctrlKey && event.shiftKey && event.keyCode==73){        
		return false;  //Prevent from ctrl+shift+i
		}
	});
</script>

<!-- Cam f12 và ctrl + shift + i -->
