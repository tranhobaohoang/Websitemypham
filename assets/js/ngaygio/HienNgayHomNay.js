var mydate = new Date();
var year = mydate.getYear();
if (year < 1000)
    year += 1900;
var m = mydate.getMinutes();
var h = mydate.getHours();
var s = mydate.getSeconds();
var day = mydate.getDay();
var month = mydate.getMonth();
var daym = mydate.getDate();
if (daym < 10)
    daym = "0" + daym;
if (m < 10)
    m = "0" + m;
if (s < 10)
    s = "0" + s;
var dayarray = new Array(lang_config.chunhat, lang_config.thu2, lang_config.thu3, lang_config.thu4, lang_config.thu5, lang_config.thu6, lang_config.thu7);
var montharray = new Array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
document.write(h + ':' + m + ':' + s + ',' + dayarray[day] + "," + lang_config.ngay + daym + "/" + montharray[month] + "/" + year + "");
