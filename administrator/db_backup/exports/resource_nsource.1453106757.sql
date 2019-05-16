#----------------------------------------
# Backup Web Database 
# Version 1.0 by Gaconlonton  
# http://nina.vn  
# DATABASE:  resource_nsource
# Date/Time:  Monday 18th  January 2016 15:45:57
#----------------------------------------

DROP TABLE IF EXISTS table_giasearch;
CREATE TABLE `table_giasearch` (  `id` int(11) NOT NULL AUTO_INCREMENT,  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,  `giatu` int(11) NOT NULL,  `giaden` int(11) NOT NULL,  PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
INSERT INTO table_giasearch VALUES ('1','Dưới 500 ngàn','0','500000'), ('2','Từ 500 đến 1 triệu','500000','1000000'), ('3','Từ 1 triệu đến 2 triệu','1000000','2000000'), ('4','Từ 2 triệu đến 4 triệu','2000000','4000000'), ('5','Từ 2 triệu đến 4 triệu','2000000','4000000'), ('6','Từ 4 triệu đến 8 triệu','4000000','8000000'), ('7','Từ 8 triệu đến 10 triệu','8000000','10000000'), ('8','Trên 10 triệu','10000000','2147483647');
