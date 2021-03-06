
CREATE TABLE `counter` (
  `id` int(11) NOT NULL,
  `tm` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL DEFAULT '0.0.0.0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




CREATE TABLE `table_about` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_vi` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `keywords_vi` varchar(1024) DEFAULT NULL,
  `keywords_en` varchar(1024) DEFAULT NULL,
  `description_vi` varchar(1024) DEFAULT NULL,
  `description_en` varchar(1024) DEFAULT NULL,
  `ten_jp` varchar(225) DEFAULT NULL,
  `tenkhongdau` varchar(255) DEFAULT NULL,
  `mota_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `noidung_vi` text,
  `noidung_en` text,
  `photo` varchar(100) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `stt` int(10) UNSIGNED DEFAULT '1',
  `hienthi` tinyint(1) DEFAULT '1',
  `ngaytao` int(11) DEFAULT '0',
  `ngaysua` int(11) DEFAULT '0',
  `title_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `description_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `mota_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `mota_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `noidung_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `keywords_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `ten_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `luotxem` int(11) DEFAULT NULL,
  `h1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `h2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `h3` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `noibat` int(11) DEFAULT NULL,
  `top` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_background` (
  `id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `repeatbg` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `hienthi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_comment` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noidung` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `danhgia` varchar(11) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_sp` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `com` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `taikhoan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tienich` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_parent` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `dienthoai` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hoten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `ten` varchar(255) NOT NULL,
  `diachi` varchar(255) NOT NULL,
  `dienthoai` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tieude` varchar(255) NOT NULL,
  `noidung` text NOT NULL,
  `ghichu` text NOT NULL,
  `view` int(10) NOT NULL,
  `hienthi` tinyint(1) NOT NULL DEFAULT '1',
  `ngaytao` int(11) NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thumb` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tensp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `soluong` int(11) NOT NULL,
  `alltien` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


CREATE TABLE `table_couple` (
  `id` int(11) NOT NULL,
  `hienthi` int(11) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `ngaysua` int(11) NOT NULL,
  `couple_code` varchar(255) NOT NULL,
  `gia_vi` int(11) NOT NULL DEFAULT '0',
  `gia_en` int(11) NOT NULL DEFAULT '0',
  `gia_ge` int(11) NOT NULL DEFAULT '0',
  `lansd` int(11) NOT NULL,
  `dadung` int(11) NOT NULL,
  `thoigian` int(11) NOT NULL,
  `vothoihan` tinyint(1) NOT NULL DEFAULT '0',
  `loai` int(11) NOT NULL,
  `gtri` int(11) NOT NULL,
  `khuvuc` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_dhct` (
  `id` int(11) NOT NULL,
  `id_dh` int(11) DEFAULT NULL,
  `id_sp` int(11) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `color` int(11) DEFAULT NULL,
  `ngaytao` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_district` (
  `districtid` varchar(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `provinceid` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





CREATE TABLE `table_dknhantin` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `ten_en` varchar(255) NOT NULL,
  `tenkhongdau` varchar(255) NOT NULL,
  `stt` int(11) NOT NULL,
  `hienthi` int(11) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `ngaysua` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_doitac` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_photo` int(10) DEFAULT NULL,
  `footer` int(1) DEFAULT NULL,
  `height` int(10) DEFAULT NULL,
  `photo` varchar(225) DEFAULT NULL,
  `vitri` int(5) DEFAULT NULL,
  `thumb` varchar(225) DEFAULT NULL,
  `ten_vi` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mota` text,
  `id_cat` int(10) UNSIGNED DEFAULT NULL,
  `stt` int(10) UNSIGNED DEFAULT '1',
  `hienthi` tinyint(1) DEFAULT '1',
  `com` varchar(30) DEFAULT NULL,
  `ten_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `noidung_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `noidung_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `title_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `keywords_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `description_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `description_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tenkhongdau` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_jp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `table_donhang` (
  `id` int(11) NOT NULL,
  `madonhang` varchar(20) DEFAULT NULL,
  `hoten` varchar(255) DEFAULT NULL,
  `dienthoai` varchar(255) DEFAULT NULL,
  `diachi` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `httt` int(11) DEFAULT NULL,
  `tonggia` int(11) DEFAULT NULL,
  `noidung` text,
  `ghichu` text,
  `donhang` text,
  `ngaytao` int(11) DEFAULT NULL,
  `trangthai` int(11) DEFAULT NULL,
  `noinhan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaithanhtoan` int(11) DEFAULT NULL,
  `dienthoainhan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tennhan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_dangnhap` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_footer` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten` varchar(225) DEFAULT NULL,
  `mota` text,
  `noidung_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `noidung_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `photo` varchar(100) DEFAULT NULL,
  `stt` int(10) UNSIGNED DEFAULT '1',
  `hienthi` tinyint(1) DEFAULT '1',
  `ngaytao` int(11) DEFAULT '0',
  `ngaysua` int(11) DEFAULT '0',
  `noidung_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `chinhanh_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `chinhanh_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `table_giaden` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_item` int(11) NOT NULL,
  `tinnoibat` int(12) NOT NULL,
  `ten_vi` varchar(225) NOT NULL,
  `ten_en` varchar(255) NOT NULL,
  `tenkhongdau` varchar(255) NOT NULL,
  `title_vi` varchar(255) NOT NULL,
  `keywords_vi` varchar(1024) NOT NULL,
  `description_vi` varchar(1024) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `keywords_en` varchar(1024) NOT NULL,
  `description_en` varchar(1024) NOT NULL,
  `mota_vi` text NOT NULL,
  `mota_en` text NOT NULL,
  `noidung_vi` text NOT NULL,
  `noidung_en` text NOT NULL,
  `loaitin` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hienthi` tinyint(1) NOT NULL DEFAULT '1',
  `ngaytao` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ngaysua` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `luotxem` int(11) NOT NULL,
  `mota_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noidung_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gia` int(11) NOT NULL,
  `giaden` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `table_giasearch` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tenkhongdau` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `giatu` int(11) NOT NULL,
  `giaden` int(11) NOT NULL,
  `stt` int(11) NOT NULL,
  `hienthi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



CREATE TABLE `table_giatu` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_item` int(11) NOT NULL,
  `tinnoibat` int(12) NOT NULL,
  `ten_vi` varchar(225) NOT NULL,
  `ten_en` varchar(255) NOT NULL,
  `tenkhongdau` varchar(255) NOT NULL,
  `title_vi` varchar(255) NOT NULL,
  `keywords_vi` varchar(1024) NOT NULL,
  `description_vi` varchar(1024) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `keywords_en` varchar(1024) NOT NULL,
  `description_en` varchar(1024) NOT NULL,
  `mota_vi` text NOT NULL,
  `mota_en` text NOT NULL,
  `noidung_vi` text NOT NULL,
  `noidung_en` text NOT NULL,
  `loaitin` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hienthi` tinyint(1) NOT NULL DEFAULT '1',
  `ngaytao` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ngaysua` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `luotxem` int(11) NOT NULL,
  `mota_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noidung_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gia` int(11) NOT NULL,
  `giaden` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_hinhanh` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_item` int(11) NOT NULL,
  `noibat` int(12) NOT NULL,
  `ten_vi` varchar(225) NOT NULL,
  `ten_en` varchar(255) NOT NULL,
  `tenkhongdau` varchar(255) NOT NULL,
  `title_vi` varchar(255) NOT NULL,
  `keywords_vi` varchar(1024) NOT NULL,
  `description_vi` varchar(1024) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `keywords_en` varchar(1024) NOT NULL,
  `description_en` varchar(1024) NOT NULL,
  `mota_vi` text NOT NULL,
  `mota_en` text NOT NULL,
  `noidung_vi` text NOT NULL,
  `noidung_en` text NOT NULL,
  `loaitin` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hienthi` tinyint(1) NOT NULL DEFAULT '1',
  `ngaytao` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `ngaysua` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `luotxem` int(11) NOT NULL,
  `chon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_jp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `h1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `h2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `h3` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `table_hinhanh_hinhanh` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_photo` int(11) NOT NULL,
  `id_item` int(10) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `photo` varchar(225) NOT NULL,
  `thumb` varchar(225) NOT NULL,
  `thumb1` varchar(255) NOT NULL,
  `ten_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mota` varchar(1024) NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hienthi` tinyint(1) NOT NULL DEFAULT '1',
  `com` varchar(255) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `ngaysua` int(11) NOT NULL,
  `noidung` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tenkhongdau` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chon` int(11) NOT NULL,
  `ten_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_jp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noidung_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noidung_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noidung_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `table_httt` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `table_icon` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_vi` varchar(225) DEFAULT NULL,
  `ten_en` varchar(225) DEFAULT NULL,
  `ten_ci` text,
  `stt` int(10) UNSIGNED DEFAULT '1',
  `hienthi` tinyint(1) DEFAULT '1',
  `url` varchar(250) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `thumb` varchar(100) DEFAULT NULL,
  `com` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_lienhe` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten` varchar(225) NOT NULL,
  `mota` text NOT NULL,
  `noidung_vi` text NOT NULL,
  `noidung_en` text NOT NULL,
  `photo` varchar(100) NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hienthi` tinyint(1) NOT NULL DEFAULT '1',
  `ngaytao` int(11) NOT NULL DEFAULT '0',
  `ngaysua` int(11) NOT NULL DEFAULT '0',
  `noidung_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `table_link` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_vi` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `keywords_vi` varchar(1024) NOT NULL,
  `keywords_en` varchar(1024) NOT NULL,
  `description_vi` varchar(1024) NOT NULL,
  `description_en` varchar(1024) NOT NULL,
  `ten_jp` varchar(225) NOT NULL,
  `tenkhongdau` varchar(255) NOT NULL,
  `mota_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noidung_vi` text NOT NULL,
  `noidung_en` text NOT NULL,
  `photo` varchar(100) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hienthi` tinyint(1) NOT NULL DEFAULT '1',
  `ngaytao` int(11) NOT NULL DEFAULT '0',
  `ngaysua` int(11) NOT NULL DEFAULT '0',
  `title_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mota_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mota_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noidung_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `luotxem` int(11) NOT NULL,
  `com` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------



CREATE TABLE `table_member` (
  `id` int(11) NOT NULL,
  `noibat` int(11) DEFAULT NULL,
  `ten_vi` varchar(255) DEFAULT NULL,
  `ten_en` varchar(255) DEFAULT NULL,
  `tenkhongdau` varchar(255) DEFAULT NULL,
  `title_vi` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `keywords_en` varchar(1024) DEFAULT NULL,
  `keywords_vi` varchar(1024) DEFAULT NULL,
  `description_vi` varchar(1024) DEFAULT NULL,
  `description_en` varchar(1024) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `stt` int(11) DEFAULT NULL,
  `hienthi` int(11) DEFAULT NULL,
  `ngaytao` int(11) DEFAULT NULL,
  `ngaysua` int(11) DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `title_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `keywords_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `description_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `com` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `hinhxacthuc` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dienthoai` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `diachi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mst` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `nganhnghe` int(11) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngayhoatdong` int(11) DEFAULT NULL,
  `dinhmucgia` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` int(11) DEFAULT NULL,
  `district` int(11) DEFAULT NULL,
  `trangthai` int(11) DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `gioitinh` int(11) DEFAULT NULL,
  `ngaysinh` int(11) DEFAULT NULL,
  `old_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `view` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT '0',
  `luot_rate` int(11) DEFAULT '0',
  `work` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `student` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `hometown` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `hometown_pro` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `hometown_dis` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `toado` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_news` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_item` int(11) DEFAULT NULL,
  `tinnoibat` int(12) DEFAULT NULL,
  `ten_vi` varchar(225) DEFAULT NULL,
  `ten_en` varchar(255) DEFAULT NULL,
  `tenkhongdau` varchar(255) DEFAULT NULL,
  `title_vi` varchar(255) DEFAULT NULL,
  `keywords_vi` varchar(1024) DEFAULT NULL,
  `description_vi` varchar(1024) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `keywords_en` varchar(1024) DEFAULT NULL,
  `description_en` varchar(1024) DEFAULT NULL,
  `mota_vi` text,
  `mota_en` text,
  `noidung_vi` text,
  `noidung_en` text,
  `loaitin` varchar(50) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `stt` int(10) UNSIGNED DEFAULT '1',
  `hienthi` tinyint(1) DEFAULT '1',
  `ngaytao` int(10) UNSIGNED DEFAULT '0',
  `ngaysua` int(10) UNSIGNED DEFAULT '0',
  `luotxem` int(11) DEFAULT NULL,
  `mota_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `noidung_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `title_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `keywords_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `description_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `ten_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `h2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `h3` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `gia` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_news_hinhanh` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_photo` int(11) NOT NULL,
  `id_item` int(10) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `photo` varchar(225) NOT NULL,
  `thumb` varchar(225) NOT NULL,
  `thumb1` varchar(255) NOT NULL,
  `ten_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mota` varchar(1024) NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hienthi` tinyint(1) NOT NULL DEFAULT '1',
  `com` varchar(255) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `ngaysua` int(11) NOT NULL,
  `noidung` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tenkhongdau` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chon` int(11) NOT NULL,
  `ten_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_jp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noidung_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noidung_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noidung_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noibat` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `table_news_item` (
  `id` int(11) NOT NULL,
  `ten_vi` varchar(255) NOT NULL,
  `tenkhongdau` varchar(255) NOT NULL,
  `stt` int(11) NOT NULL,
  `hienthi` int(11) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `ngaysua` int(11) NOT NULL,
  `ten_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_jp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_jp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `h1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `h2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `h3` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gia` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_online` (
  `id` int(10) UNSIGNED NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `time` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_photo` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo_vi` varchar(225) NOT NULL,
  `photo_en` varchar(255) NOT NULL,
  `thumb` varchar(225) NOT NULL,
  `ten` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mota` text NOT NULL,
  `id_cat` int(10) UNSIGNED NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hienthi` tinyint(1) NOT NULL DEFAULT '1',
  `com` varchar(30) NOT NULL,
  `photo_jp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `photo_ft` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_place_city` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `tenkhongdau` varchar(255) NOT NULL,
  `stt` int(11) NOT NULL,
  `hienthi` int(11) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `ngaysua` int(11) NOT NULL,
  `phiship` int(11) NOT NULL,
  `ten_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_place_dist` (
  `id` int(11) NOT NULL,
  `id_city` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `tenkhongdau` varchar(255) NOT NULL,
  `stt` int(11) NOT NULL,
  `hienthi` int(11) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `ngaysua` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_place_street` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_city` int(11) NOT NULL,
  `id_dist` int(10) NOT NULL,
  `ten` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tenkhongdau` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `stt` int(2) NOT NULL,
  `hienthi` int(2) NOT NULL,
  `ngaysua` int(10) NOT NULL,
  `ngaytao` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;




CREATE TABLE `table_prices` (
  `id` int(11) NOT NULL,
  `ten_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tenkhongdau` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hienthi` int(11) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `stt` int(11) NOT NULL,
  `diachidk` int(11) NOT NULL,
  `diachinhanthu` int(11) NOT NULL,
  `kvtiepkhach` int(11) NOT NULL,
  `letan` int(11) NOT NULL,
  `internet` int(11) NOT NULL,
  `nuocuong` int(11) NOT NULL,
  `bao` int(11) NOT NULL,
  `bangten` int(11) NOT NULL,
  `sofax` int(11) NOT NULL,
  `cafe` int(11) NOT NULL,
  `phonghop` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thutucdkkd` int(11) NOT NULL,
  `thutucdkkd1` int(11) NOT NULL,
  `thutucdkkd2` int(11) NOT NULL,
  `domain` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` int(11) NOT NULL,
  `dienthoai` int(11) NOT NULL,
  `gia` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------


CREATE TABLE `table_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_list` int(11) DEFAULT NULL,
  `id_item` int(10) DEFAULT NULL,
  `id_cat` int(11) DEFAULT NULL,
  `noibat` int(11) DEFAULT NULL,
  `spbc` int(11) DEFAULT NULL,
  `photo` varchar(225) DEFAULT NULL,
  `thumb` varchar(225) DEFAULT NULL,
  `ten_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_en` varchar(255) DEFAULT NULL,
  `masp` varchar(255) DEFAULT NULL,
  `tenkhongdau` varchar(255) DEFAULT NULL,
  `gia` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `giakm` int(11) DEFAULT '0',
  `noidung_vi` text,
  `noidung_en` text,
  `title_vi` varchar(255) DEFAULT NULL,
  `keywords_vi` varchar(1024) DEFAULT NULL,
  `description_vi` varchar(1024) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `keywords_en` varchar(1024) DEFAULT NULL,
  `description_en` varchar(1024) DEFAULT NULL,
  `stt` int(10) UNSIGNED DEFAULT '1',
  `hienthi` tinyint(1) DEFAULT '1',
  `ngaytao` int(11) DEFAULT NULL,
  `ngaysua` int(11) DEFAULT NULL,
  `luotxem` int(11) DEFAULT NULL,
  `ten_jp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `noidung_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `com` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `spkm` int(11) DEFAULT NULL,
  `list_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `option_search` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `luot_rate` int(11) DEFAULT NULL,
  `video` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_video` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_jp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `description_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `mota_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `mota_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `mota_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `h1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `h2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `h3` varchar(255) CHARACTER SET utf8 COLLATE utf8_icelandic_ci DEFAULT NULL,
  `tag_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tag_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tag_slug_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tag_slug_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `is_noindex` int(11) DEFAULT NULL,
  `bedroom` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `toilet` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dientich` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dung_tich` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dong_sp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `thuong_hieu` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `noi_sx` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `table_product_color` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_item` int(10) NOT NULL,
  `ten` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hienthi` tinyint(1) NOT NULL DEFAULT '1',
  `com` varchar(255) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `ngaysua` int(11) NOT NULL,
  `color` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_product_hinhanh` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_photo` int(11) NOT NULL,
  `id_item` int(10) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `photo` varchar(225) NOT NULL,
  `thumb` varchar(225) NOT NULL,
  `thumb1` varchar(255) NOT NULL,
  `ten` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mota` varchar(1024) NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hienthi` tinyint(1) NOT NULL DEFAULT '1',
  `com` varchar(255) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `ngaysua` int(11) NOT NULL,
  `vitri` int(11) NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `table_product_list` (
  `id` int(11) NOT NULL,
  `noibat` int(11) DEFAULT NULL,
  `ten_vi` varchar(255) DEFAULT NULL,
  `ten_en` varchar(255) DEFAULT NULL,
  `tenkhongdau` varchar(255) DEFAULT NULL,
  `title_vi` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `keywords_en` varchar(1024) DEFAULT NULL,
  `keywords_vi` varchar(1024) DEFAULT NULL,
  `description_vi` varchar(1024) DEFAULT NULL,
  `description_en` varchar(1024) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `stt` int(11) DEFAULT NULL,
  `hienthi` int(11) DEFAULT NULL,
  `ngaytao` int(11) DEFAULT NULL,
  `ngaysua` int(11) DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `title_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `keywords_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `description_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `com` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `set_level` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `avata` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `h1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `h2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `h3` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `noidung_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `noidung_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `noidung_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `is_noindex` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_product_size` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_item` int(10) NOT NULL,
  `ten` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hienthi` tinyint(1) NOT NULL DEFAULT '1',
  `com` varchar(255) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `ngaysua` int(11) NOT NULL,
  `gia` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `table_product_tab` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_photo` int(11) NOT NULL,
  `id_item` int(10) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `photo` varchar(225) NOT NULL,
  `thumb` varchar(225) NOT NULL,
  `thumb1` varchar(255) NOT NULL,
  `ten_vi` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mota` varchar(1024) NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hienthi` tinyint(1) NOT NULL DEFAULT '1',
  `com` varchar(255) NOT NULL,
  `ngaytao` int(11) NOT NULL,
  `ngaysua` int(11) NOT NULL,
  `vitri` int(11) NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noidung_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noidung_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `table_province` (
  `provinceid` varchar(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_quangcao` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(225) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `alt_img` varchar(255) NOT NULL,
  `ten` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mota` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hienthi` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_search` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_list` int(11) NOT NULL,
  `stt` int(11) NOT NULL,
  `hienthi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `table_search_item` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_list` int(11) NOT NULL,
  `stt` int(11) NOT NULL,
  `hienthi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_setting` (
  `id` int(10) NOT NULL,
  `title_vi` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `keywords_vi` varchar(1024) DEFAULT NULL,
  `keywords_en` varchar(1024) DEFAULT NULL,
  `description_vi` varchar(1024) DEFAULT NULL,
  `description_en` varchar(1024) DEFAULT NULL,
  `giupdochiase` int(11) DEFAULT NULL,
  `ten_vi` varchar(255) DEFAULT NULL,
  `ten_en` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dienthoai_vi` varchar(255) DEFAULT NULL,
  `dienthoai_en` varchar(255) DEFAULT NULL,
  `fax_vi` varchar(255) DEFAULT NULL,
  `fax_en` varchar(255) DEFAULT NULL,
  `diachi_vi` varchar(255) DEFAULT NULL,
  `diachi_en` varchar(255) DEFAULT NULL,
  `slogan_vi` varchar(1024) DEFAULT NULL,
  `slogan_en` varchar(1024) DEFAULT NULL,
  `hotline` varchar(255) DEFAULT NULL,
  `toado` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `google` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `slogan_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `ten_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `dienthoai_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `fax_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `title_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `diachi_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `keywords_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `description_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h1_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h1_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h1_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h2_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h2_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h2_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h3_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h3_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h3_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h4_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h4_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h4_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h5_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h5_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h5_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h6_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h6_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h6_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `gg` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `livechat` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `map` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `fav` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `hotline1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_hl1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_hl2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mienbac` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `miennam` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `duphong` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `luuy1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `luuy2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tuvan` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mst` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_slider` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(225) DEFAULT NULL,
  `ten` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `mota` text,
  `link` varchar(255) DEFAULT NULL,
  `stt` int(10) UNSIGNED DEFAULT '1',
  `hienthi` tinyint(1) DEFAULT '1',
  `sale` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `button` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `length_vi` int(11) NOT NULL,
  `slug_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `stt` int(11) NOT NULL,
  `length_en` int(11) NOT NULL,
  `hienthi` int(11) NOT NULL,
  `slug_en` varchar(255) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------



CREATE TABLE `table_thuonghieu` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_photo` int(10) NOT NULL,
  `footer` int(1) NOT NULL,
  `height` int(10) NOT NULL,
  `photo` varchar(225) NOT NULL,
  `vitri` int(5) NOT NULL,
  `thumb` varchar(225) NOT NULL,
  `ten_vi` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mota` text NOT NULL,
  `id_cat` int(10) UNSIGNED NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hienthi` tinyint(1) NOT NULL DEFAULT '1',
  `com` varchar(30) NOT NULL,
  `ten_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noidung_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noidung_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `keywords_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tenkhongdau` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_jp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------



CREATE TABLE `table_time` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_vi` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `keywords_vi` varchar(1024) DEFAULT NULL,
  `keywords_en` varchar(1024) DEFAULT NULL,
  `description_vi` varchar(1024) DEFAULT NULL,
  `description_en` varchar(1024) DEFAULT NULL,
  `ten` varchar(225) DEFAULT NULL,
  `tenkhongdau` varchar(255) DEFAULT NULL,
  `mota_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `noidung_vi` text,
  `noidung_en` text,
  `photo` varchar(100) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `stt` int(10) UNSIGNED DEFAULT '1',
  `hienthi` tinyint(1) DEFAULT '1',
  `ngaytao` int(11) DEFAULT '0',
  `ngaysua` int(11) DEFAULT '0',
  `title_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `description_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `mota_en` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `mota_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `noidung_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `keywords_jp` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `h1` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `h2` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `h3` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_jp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `video` varchar(1024) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_tinhtrang` (
  `id` int(11) NOT NULL,
  `trangthai` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



CREATE TABLE `table_toado` (
  `id` int(10) UNSIGNED NOT NULL,
  `tenkhongdau` varchar(255) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `stt` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `hienthi` tinyint(1) NOT NULL DEFAULT '1',
  `ngaytao` int(11) NOT NULL DEFAULT '0',
  `ngaysua` int(11) NOT NULL DEFAULT '0',
  `ten_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ten_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `toado` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idc` int(11) NOT NULL,
  `diachi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `noidung_vi` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `table_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(225) DEFAULT NULL,
  `password` varchar(225) DEFAULT NULL,
  `ten` varchar(225) DEFAULT NULL,
  `dienthoai` varchar(225) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `diachi` varchar(225) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT '0',
  `nick_yahoo` varchar(225) DEFAULT NULL,
  `nick_skype` varchar(225) DEFAULT NULL,
  `congty` varchar(225) DEFAULT NULL,
  `country` varchar(225) DEFAULT NULL,
  `city` varchar(225) DEFAULT NULL,
  `role` tinyint(3) UNSIGNED DEFAULT '1',
  `hienthi` tinyint(1) DEFAULT '1',
  `com` varchar(225) DEFAULT 'user',
  `ngaysinh` int(11) DEFAULT NULL,
  `ngaydangky` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




CREATE TABLE `table_video` (
  `id` int(11) NOT NULL,
  `ten_vi` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tenkhongdau` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `stt` int(11) DEFAULT NULL,
  `hienthi` int(11) DEFAULT NULL,
  `ngaytao` int(11) DEFAULT NULL,
  `ngaysua` int(11) DEFAULT NULL,
  `ten_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ten_jp` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `noibat` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `table_yahoo` (
  `id` int(10) UNSIGNED NOT NULL,
  `ten_vi` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `linhvuc` int(3) NOT NULL,
  `mota` varchar(255) CHARACTER SET utf8 NOT NULL,
  `loai` int(11) NOT NULL,
  `yahoo` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `skype` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `dienthoai` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `stt` int(3) NOT NULL,
  `hienthi` int(2) NOT NULL,
  `ngaytao` int(10) NOT NULL,
  `ngaysua` int(10) NOT NULL,
  `ten_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


CREATE TABLE `user_online` (
  `session` char(100) NOT NULL DEFAULT '',
  `time` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_about`
--
ALTER TABLE `table_about`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_background`
--
ALTER TABLE `table_background`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_comment`
--
ALTER TABLE `table_comment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_contact`
--
ALTER TABLE `table_contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_couple`
--
ALTER TABLE `table_couple`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_dhct`
--
ALTER TABLE `table_dhct`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_district`
--
ALTER TABLE `table_district`
  ADD PRIMARY KEY (`districtid`),
  ADD KEY `provinceid` (`provinceid`);

--
-- Chỉ mục cho bảng `table_dknhantin`
--
ALTER TABLE `table_dknhantin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_doitac`
--
ALTER TABLE `table_doitac`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_donhang`
--
ALTER TABLE `table_donhang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_footer`
--
ALTER TABLE `table_footer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_giaden`
--
ALTER TABLE `table_giaden`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_giasearch`
--
ALTER TABLE `table_giasearch`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_giatu`
--
ALTER TABLE `table_giatu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_hinhanh`
--
ALTER TABLE `table_hinhanh`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_hinhanh_hinhanh`
--
ALTER TABLE `table_hinhanh_hinhanh`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_icon`
--
ALTER TABLE `table_icon`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_lienhe`
--
ALTER TABLE `table_lienhe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_link`
--
ALTER TABLE `table_link`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_member`
--
ALTER TABLE `table_member`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_news`
--
ALTER TABLE `table_news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_news_hinhanh`
--
ALTER TABLE `table_news_hinhanh`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_news_item`
--
ALTER TABLE `table_news_item`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_online`
--
ALTER TABLE `table_online`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_photo`
--
ALTER TABLE `table_photo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_place_city`
--
ALTER TABLE `table_place_city`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_place_dist`
--
ALTER TABLE `table_place_dist`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_place_street`
--
ALTER TABLE `table_place_street`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_place_ward`
--
ALTER TABLE `table_place_ward`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_prices`
--
ALTER TABLE `table_prices`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_product`
--
ALTER TABLE `table_product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_product_color`
--
ALTER TABLE `table_product_color`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_product_hinhanh`
--
ALTER TABLE `table_product_hinhanh`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_product_list`
--
ALTER TABLE `table_product_list`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_product_size`
--
ALTER TABLE `table_product_size`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_product_tab`
--
ALTER TABLE `table_product_tab`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_province`
--
ALTER TABLE `table_province`
  ADD PRIMARY KEY (`provinceid`);

--
-- Chỉ mục cho bảng `table_quangcao`
--
ALTER TABLE `table_quangcao`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_search`
--
ALTER TABLE `table_search`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_search_item`
--
ALTER TABLE `table_search_item`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_setting`
--
ALTER TABLE `table_setting`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_slider`
--
ALTER TABLE `table_slider`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_tag`
--
ALTER TABLE `table_tag`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_thuonghieu`
--
ALTER TABLE `table_thuonghieu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_time`
--
ALTER TABLE `table_time`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_tinhtrang`
--
ALTER TABLE `table_tinhtrang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_toado`
--
ALTER TABLE `table_toado`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_video`
--
ALTER TABLE `table_video`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `table_yahoo`
--
ALTER TABLE `table_yahoo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `counter`
--
ALTER TABLE `counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9055;
--
-- AUTO_INCREMENT cho bảng `table_about`
--
ALTER TABLE `table_about`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT cho bảng `table_background`
--
ALTER TABLE `table_background`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `table_comment`
--
ALTER TABLE `table_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT cho bảng `table_contact`
--
ALTER TABLE `table_contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT cho bảng `table_couple`
--
ALTER TABLE `table_couple`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT cho bảng `table_dhct`
--
ALTER TABLE `table_dhct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT cho bảng `table_dknhantin`
--
ALTER TABLE `table_dknhantin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT cho bảng `table_doitac`
--
ALTER TABLE `table_doitac`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `table_donhang`
--
ALTER TABLE `table_donhang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT cho bảng `table_footer`
--
ALTER TABLE `table_footer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT cho bảng `table_giaden`
--
ALTER TABLE `table_giaden`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `table_giasearch`
--
ALTER TABLE `table_giasearch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT cho bảng `table_giatu`
--
ALTER TABLE `table_giatu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT cho bảng `table_hinhanh`
--
ALTER TABLE `table_hinhanh`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `table_hinhanh_hinhanh`
--
ALTER TABLE `table_hinhanh_hinhanh`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `table_icon`
--
ALTER TABLE `table_icon`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT cho bảng `table_lienhe`
--
ALTER TABLE `table_lienhe`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT cho bảng `table_link`
--
ALTER TABLE `table_link`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `table_member`
--
ALTER TABLE `table_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT cho bảng `table_news`
--
ALTER TABLE `table_news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `table_news_hinhanh`
--
ALTER TABLE `table_news_hinhanh`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT cho bảng `table_news_item`
--
ALTER TABLE `table_news_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT cho bảng `table_online`
--
ALTER TABLE `table_online`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53484;
--
-- AUTO_INCREMENT cho bảng `table_photo`
--
ALTER TABLE `table_photo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT cho bảng `table_place_city`
--
ALTER TABLE `table_place_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT cho bảng `table_place_dist`
--
ALTER TABLE `table_place_dist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=705;
--
-- AUTO_INCREMENT cho bảng `table_place_street`
--
ALTER TABLE `table_place_street`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19804;
--
-- AUTO_INCREMENT cho bảng `table_place_ward`
--
ALTER TABLE `table_place_ward`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10855;
--
-- AUTO_INCREMENT cho bảng `table_prices`
--
ALTER TABLE `table_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `table_product`
--
ALTER TABLE `table_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=553;
--
-- AUTO_INCREMENT cho bảng `table_product_color`
--
ALTER TABLE `table_product_color`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `table_product_hinhanh`
--
ALTER TABLE `table_product_hinhanh`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT cho bảng `table_product_list`
--
ALTER TABLE `table_product_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT cho bảng `table_product_size`
--
ALTER TABLE `table_product_size`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT cho bảng `table_product_tab`
--
ALTER TABLE `table_product_tab`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT cho bảng `table_quangcao`
--
ALTER TABLE `table_quangcao`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT cho bảng `table_search`
--
ALTER TABLE `table_search`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT cho bảng `table_search_item`
--
ALTER TABLE `table_search_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT cho bảng `table_setting`
--
ALTER TABLE `table_setting`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT cho bảng `table_slider`
--
ALTER TABLE `table_slider`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT cho bảng `table_tag`
--
ALTER TABLE `table_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `table_thuonghieu`
--
ALTER TABLE `table_thuonghieu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `table_time`
--
ALTER TABLE `table_time`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT cho bảng `table_tinhtrang`
--
ALTER TABLE `table_tinhtrang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT cho bảng `table_toado`
--
ALTER TABLE `table_toado`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `table_user`
--
ALTER TABLE `table_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT cho bảng `table_video`
--
ALTER TABLE `table_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT cho bảng `table_yahoo`
--
ALTER TABLE `table_yahoo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
