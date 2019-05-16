$(document).ready(function() {
    var windowW = $(window).width();
    if (windowW <= 1280) {
        windowW = 1280;
    }
    var backgroundPositionX = (windowW - 1440) / 2;
    var backgroundPositionXCc = backgroundPositionX + 50;
    $(".ct_scroll").css({
        'width': windowW * 10
    });
    $('.content .ct_scroll .ct').css({
        'width': windowW,
        'margin-right': -(backgroundPositionX * 2)
    });
    $(".background").css('background-position', backgroundPositionX);
    $(".cauchuyen").css({
        'background-position': backgroundPositionXCc
    });
    var page = new Array('.1992', '.1996', '.1998', '.2001', '.2002', '.2005', '.2006', '.2007', '.2009');
    var indexCurrent = 0;
    $(".1992").click(function() {
        indexCurrent = 0;
        var backgroundPositionX_1992 = backgroundPositionX - 0;
        $(".background").stop().animate({
            'background-position': backgroundPositionX_1992
        }, 800)
        $(".cauchuyen").stop().animate({
            'background-position': backgroundPositionXCc
        }, 1600);
        $(".ct_scroll").stop().animate({
            'left': '0px'
        }, 1200);
        $(".conso").animate({
            'background-position': '0px'
        }, 500);
        $(".lacaphe").stop().animate({
            'left': '-1420px'
        }, 0).animate({
            'left': '1420px'
        }, 1200);
        $('.sonam .tn-ls-year').each(function() {
            $(this).removeClass('active');
        });
        $('.sonam .yr1992').addClass('active');
    });
	$(".1996").click(function() {
        indexCurrent = 0;
        var backgroundPositionX_1996 = backgroundPositionX - 1440;
        $(".background").stop().animate({
            'background-position': backgroundPositionX_1996
        }, 800)
        $(".cauchuyen").stop().animate({
            'background-position': (backgroundPositionXCc - 1893)
        }, 1600);
        $(".ct_scroll").stop().animate({
            'left': -1440
        }, 1200);
        $(".conso").animate({
            'background-position': '-331px'
        }, 500);
        animateLacaphe(1, indexCurrent);
        $('.sonam .tn-ls-year').each(function() {
            $(this).removeClass('active');
        });
        $('.sonam .yr1996').addClass('active');
		indexCurrent = 1;
    });
    $(".1998").click(function() {
        var backgroundPositionX_1998 = backgroundPositionX - 2880;
        $(".background").stop().animate({
            'background-position': backgroundPositionX_1998
        }, 800);
        $(".cauchuyen").stop().animate({
            'background-position': (backgroundPositionXCc - 3786)
        }, 1600);
        $(".ct_scroll").stop().animate({
            'left': -1440 * 2
        }, 1200);
        $(".conso").stop().animate({
            'background-position': '-662px'
        }, 500);
        animateLacaphe(2, indexCurrent);
        $('.sonam .tn-ls-year').each(function() {
            $(this).removeClass('active');
        });
        $('.sonam .yr1998').addClass('active');
        indexCurrent = 2;
    });
    $(".2001").click(function() {
        var backgroundPositionX_2001 = backgroundPositionX - 4320;
        $(".background").stop().animate({
            'background-position': backgroundPositionX_2001
        }, 800);
        $(".cauchuyen").stop().animate({
            'background-position': (backgroundPositionXCc - 5679)
        }, 1600);
        $(".conso").stop().animate({
            'background-position': '-993px'
        }, 500);
        $(".ct_scroll").stop().animate({
            'left': -1440 * 3
        }, 1200);
        animateLacaphe(3, indexCurrent);
        $('.sonam .tn-ls-year').each(function() {
            $(this).removeClass('active');
        });
        $('.sonam .yr2001').addClass('active');
        indexCurrent = 3;
    });
    $(".2002").click(function() {
        var backgroundPositionX_2002 = backgroundPositionX - 5760;
        $(".background").stop().animate({
            'background-position': backgroundPositionX_2002
        }, 800);
        $(".cauchuyen").stop().animate({
            'background-position': (backgroundPositionXCc - 7572)
        }, 1600);
        $(".conso").stop().animate({
            'background-position': '-1324px'
        }, 500);
        $(".ct_scroll").stop().animate({
            'left': -1440 * 4
        }, 1200);
        animateLacaphe(4, indexCurrent);
        $('.sonam .tn-ls-year').each(function() {
            $(this).removeClass('active');
        });
        $('.sonam .yr2002').addClass('active');
        indexCurrent = 4;
    });
    $(".2005").click(function() {
        var backgroundPositionX_2005 = backgroundPositionX - 7200;
        $(".background").stop().animate({
            'background-position': backgroundPositionX_2005
        }, 800);
        $(".cauchuyen").stop().animate({
            'background-position': (backgroundPositionXCc - 9465)
        }, 1600);
        $(".conso").stop().animate({
            'background-position': '-1655px'
        }, 500);
        $(".ct_scroll").stop().animate({
            'left': -1440 * 5
        }, 1200);
        animateLacaphe(5, indexCurrent);
        $('.sonam .tn-ls-year').each(function() {
            $(this).removeClass('active');
        });
        $('.sonam .yr2005').addClass('active');
        indexCurrent = 5;
    });
	$(".2006").click(function() {
        var backgroundPositionX_2006 = backgroundPositionX - 8640;
        $(".background").stop().animate({
            'background-position': backgroundPositionX_2006
        }, 800);
        $(".cauchuyen").stop().animate({
            'background-position': (backgroundPositionXCc - 11358)
        }, 1600);
        $(".conso").stop().animate({
            'background-position': '-1986px'
        }, 500);
        $(".ct_scroll").stop().animate({
            'left': -1440 * 6
        }, 1200);
        animateLacaphe(6, indexCurrent);
        $('.sonam .tn-ls-year').each(function() {
            $(this).removeClass('active');
        });
        $('.sonam .yr2006').addClass('active');
        indexCurrent = 6;
    });
    $(".2007").click(function() {
        var backgroundPositionX_2007 = backgroundPositionX - 10080;
        $(".background").stop().animate({
            'background-position': backgroundPositionX_2007
        }, 800);
        $(".cauchuyen").stop().animate({
            'background-position': (backgroundPositionXCc - 13251)
        }, 1600);
        $(".conso").stop().animate({
            'background-position': '-2317px'
        }, 500);
        $(".ct_scroll").stop().animate({
            'left': -1440 * 7
        }, 1200);
        animateLacaphe(7, indexCurrent);
        $('.sonam .tn-ls-year').each(function() {
            $(this).removeClass('active');
        });
        $('.sonam .yr2007').addClass('active');
        indexCurrent = 7;
    });
    $(".2009").click(function() {
        var backgroundPositionX_2009 = backgroundPositionX - 11520;
        $(".background").stop().animate({
            'background-position': backgroundPositionX_2009
        }, 800);
        $(".cauchuyen").stop().animate({
            'background-position': (backgroundPositionXCc - 15144)
        }, 1600);
        $(".conso").stop().animate({
            'background-position': '-2648px'
        }, 500);
        $(".ct_scroll").stop().animate({
            'left': -1440 * 8
        }, 1200);
        $(".lacaphe").stop().animate({
            'left': '-1420px'
        }, 1200).animate({
            'left': '1420px'
        }, 0);
        $('.sonam .tn-ls-year').each(function() {
            $(this).removeClass('active');
        });
        $('.sonam .yr2009').addClass('active');
        indexCurrent = 8;
    });
    $('.left_button').click(function() {
        if (indexCurrent == 0) {
            return;
        } else {
            var pageIndex = page[indexCurrent - 1];
            $(pageIndex).click();
        }
    });
    $('.right_button').click(function() {
        if (indexCurrent == 8) {
            return;
        } else {
            var pageIndex = page[indexCurrent + 1];
            $(pageIndex).click();
        }
    });

    function animateLacaphe(_index, _indexCurrent) {
        if (_index == _indexCurrent) {
            return;
        }
        if (_index > _indexCurrent) {
            $(".lacaphe").stop().animate({
                'left': '1420px'
            }, 0).animate({
                'left': '-1420px'
            }, 1200);
        } else {
            $(".lacaphe").stop().animate({
                'left': '-1420px'
            }, 0).animate({
                'left': '1420px'
            }, 1200);
        }
    }
});