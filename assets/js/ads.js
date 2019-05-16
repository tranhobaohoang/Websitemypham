function FloatTopDiv()
	{
		startX = ((document.body.clientWidth)/2) + 505, startY = 20;
		var ns = (navigator.appName.indexOf("Netscape") != -1);
		var d = document;
			
		if (document.body.clientWidth < 1024) document.getElementById("divAdRight").style.display  = 'none';

		
		function ml(id)
		{
			var el=d.getElementById?d.getElementById(id):d.all?d.all[id]:d.layers[id];
			if(d.layers)el.style=el;
			el.sP=function(x,y){this.style.left=x;this.style.top=y;};
			el.x = startX;
			el.y = startY;
			return el;
		}
		
		window.stayTopLeft=function()
		{
		
			if (document.body.clientWidth < 1024)
			{
				document.getElementById("divAdRight").style.display  = 'none';
			}
			
			else
			{
				document.getElementById("divAdRight").style.display  = 'block';
			if (document.documentElement && document.documentElement.scrollTop)
				var pY = ns ? pageYOffset : document.documentElement.scrollTop;
			else if (document.body)
				var pY = ns ? pageYOffset : document.body.scrollTop;

			if (document.body.scrollTop > 20){startY = 20} else {startY = 20};

			if (document.body.clientWidth >= 1024)
			{
				ftlObj.x = ((document.body.clientWidth)/2) + 505;ftlObj.y += (pY + startY - ftlObj.y)/10;ftlObj.sP(ftlObj.x, ftlObj.y);
			}
			else
			{
			
			
			ftlObj.x  = startX;
			ftlObj.y += (pY + startY - ftlObj.y)/10;
			ftlObj.sP(ftlObj.x, ftlObj.y);
			}
			}
			setTimeout("stayTopLeft()", 1);
		}
		
		ftlObj = ml("divAdRight");
		stayTopLeft();
		
	}
function FloatTopDiv2()
	{
		startX2 = (document.body.clientWidth-1010)/2 - 1150, startY2 = 20;
		var ns2 = (navigator.appName.indexOf("Netscape") != -1);
		var d2 = document;
			
		if (document.body.clientWidth < 1024) document.getElementById("divAdLeft").style.display  = 'none';

		
		function ml2(id)
		{
			var el2=d2.getElementById?d2.getElementById(id):d2.all?d2.all[id]:d2.layers[id];
			if(d2.layers)el2.style=el2;
			el2.sP=function(x,y){this.style.left=x;this.style.top=y;};
			el2.x = startX2;
			el2.y = startY2;
			return el2;
		}
		
		window.stayTopLeft2=function()
		{
			if (document.body.clientWidth < 1024)
			{
				document.getElementById("divAdLeft").style.display  = 'none';
			}
			else
			{
				document.getElementById("divAdLeft").style.display  = 'block';
			if (document.documentElement && document.documentElement.scrollTop)
				var pY2 = ns2 ? pageYOffset : document.documentElement.scrollTop;
			else if (document.body)
				var pY2 = ns2 ? pageYOffset : document.body.scrollTop;

			if (document.body.scrollTop > 20){startY2 = 20} else {startY2 = 20};

			if (document.body.clientWidth >= 1024)
			{
				ftlObj2.x =  (document.body.clientWidth-1010)/2 - 170;ftlObj2.y += (pY2 + startY2 - ftlObj2.y)/10;	ftlObj2.sP(ftlObj2.x, ftlObj2.y);
			}
			else
			{			
			

			
			ftlObj2.x  = startX2;
			ftlObj2.y += (pY2 + startY2 - ftlObj2.y)/10;
			ftlObj2.sP(ftlObj2.x, ftlObj2.y);
			}
			}
			setTimeout("stayTopLeft2()", 1);
		}
		
		ftlObj2 = ml2("divAdLeft");
		stayTopLeft2();
		
	}


	function ShowAdDiv()
	{
		var objAdDivLeft  = document.getElementById("divAdLeft");
		var objAdDivRight = document.getElementById("divAdRight");
		if (document.body.clientWidth < 1024)
		{
			objAdDivLeft.style.display  = 'none';
			objAdDivRight.style.display = 'none';
		}
		
		else
		{
			objAdDivLeft.style.left  = (document.body.clientWidth-1010)/2 - 20;
			objAdDivRight.style.left = ((document.body.clientWidth)/2) + 505;
		}
		FloatTopDiv();
		FloatTopDiv2();
	}
ShowAdDiv();