(function () {
"use strict";
var x, ngay, y, thang;
x = new Date().getDay();
y = new Date().getMonth();

(function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('hgtien1').innerHTML =
    h + " : " + m + " : " + s;
    var t = setTimeout(startTime, 500);
})()
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

switch(x) { 

  case 0: ngay = "CHỦ NHẬT" ;  break;
  case 1: ngay = "THỨ HAI"  ;  break;
  case 2: ngay = "THỨ BA"   ;  break;
  case 3: ngay = "THỨ TƯ"   ;  break;
  case 4: ngay = "THỨ NĂM"  ;  break;
  case 5: ngay = "THỨ SÁU"  ;  break;
  case 6: ngay = "THỨ BẢY"  ;  break;
  default: ngay = "KHÔNG XÁC ĐỊNH";
}
debugger;
switch(y) {

  case 0: thang = "01" ; break;
  case 1: thang = "02" ; break;
  case 2: thang = "03" ; break;
  case 3: thang = "04" ; break;
  case 4: thang = "05" ; break;
  case 5: thang = "06" ; break;
  case 6: thang = "07" ; break;
  case 7: thang = "08" ; break;
  case 8: thang = "09" ; break;
  case 9: thang = "10" ; break;
  case 10: thang = "11" ; break;
  case 11: thang = "12" ; break;
  default: thang = "SAI";
}
debugger;
document.getElementById("hgtien").innerHTML = ngay + " " + new Date().getDate() + "/" + thang + "/" + new Date().getFullYear();
})()