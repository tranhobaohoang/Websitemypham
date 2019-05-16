<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch ($act) {
    case "login":
        if (!empty($_POST))
            login();
        $template = "user/login";
        break;
    case "admin_edit":
        edit();
        $template = "user/admin_add";
        break;
    case "logout":
        logout();
        break;
    case "man":
        get_items();
        $template = "user/items";
        break;
    case "add":
        $template = "user/item_add";
        break;
    case "edit":
        get_item();
        $template = "user/item_add";
        break;
    case "save":
        save_item();
        break;
    case "delete":
        delete_item();
        break;
    default:
        $template = "index";
}

//////////////////
function get_items() {
    global $d, $items, $paging;

    $sql = "select * from #_user where role=1 order by username";
    $d->query($sql);
    $items = $d->result_array();

    $curPage = isset($_GET['curPage']) ? $_GET['curPage'] : 1;
    $url = "default.php?com=user&act=man";
    $maxR = 10;
    $maxP = 4;
    $paging = paging($items, $url, $curPage, $maxR, $maxP);
    $items = $paging['source'];
}

function get_item() {
    global $d, $item;
    $id = isset($_GET['id']) ? themdau($_GET['id']) : "";
    if (!$id)
        transfer("Không nhận được dữ liệu", "default.php?com=user&act=man");

    $sql = "select * from #_user where id='" . $id . "' and role=1";
    $d->query($sql);
    if ($d->num_rows() == 0)
        transfer("Dữ liệu không có thực", "default.php?com=user&act=man");
    $item = $d->fetch_array();
}

function save_item() {
    global $d;

    if (empty($_POST))
        transfer("Không nhận được dữ liệu", "default.php?com=user&act=man");
    $id = isset($_POST['id']) ? themdau($_POST['id']) : "";
    if ($id) { // cap nhat
        $id = themdau($_POST['id']);

        // kiem tra
        $d->reset();
        $d->setTable('user');
        $d->setWhere('id', $id);
        $d->select();
        if ($d->num_rows() > 0) {
            $row = $d->fetch_array();
            if ($row['role'] != 1)
                transfer("Bạn không có quyền trên tài khoản này.<br>Mọi thắc mắc xin liên hệ quản trị website.", "default.php?com=user&act=man");
        }


        $data['username'] = $_POST['username'];
        if ($_POST['password'] != "")
            $data['password'] = md5($_POST['password']);
        $data['email'] = $_POST['email'];
        $data['ten'] = $_POST['ten'];
        $data['sex'] = $_POST['sex'];
        $data['dienthoai'] = $_POST['dienthoai'];
        $data['nick_yahoo'] = $_POST['nick_yahoo'];
        $data['nick_skype'] = $_POST['nick_skype'];
        $data['diachi'] = $_POST['diachi'];
        $data['congty'] = $_POST['congty'];
        $data['country'] = $_POST['country'];
        $data['city'] = $_POST['city'];

        $d->reset();
        $d->setTable('user');
        $d->setWhere('id', $id);
        $d->setWhere('role', 1);
        if ($d->update($data))
            transfer("Dữ liệu đã được cập nhật", "default.php?com=user&act=man");
        else
            transfer("Cập nhật dữ liệu bị lỗi", "default.php?com=user&act=man");
    }else { // them moi
        // kiem tra ten trung
        $d->reset();
        $d->setTable('user');
        $d->setWhere('username', $_POST['username']);
        $d->select();
        if ($d->num_rows() > 0)
            transfer("Tên dăng nhập nay đã có.<br>Xin chọn tên khác.", "default.php?com=user&act=edit&id=" . $id);

        if ($_POST['password'] == "")
            transfer("Chưa nhập mật khẩu", "default.php?com=user&act=add");

        $data['username'] = $_POST['username'];
        $data['password'] = md5($_POST['password']);
        $data['email'] = $_POST['email'];
        $data['ten'] = $_POST['ten'];
        $data['sex'] = $_POST['sex'];
        $data['dienthoai'] = $_POST['dienthoai'];
        $data['nick_yahoo'] = $_POST['nick_yahoo'];
        $data['nick_skype'] = $_POST['nick_skype'];
        $data['diachi'] = $_POST['diachi'];
        $data['congty'] = $_POST['congty'];
        $data['country'] = $_POST['country'];
        $data['city'] = $_POST['city'];
        $data['role'] = 1;
        $data['com'] = "user";

        $d->setTable('user');
        if ($d->insert($data))
            transfer("Dữ liệu đã được lưu", "default.php?com=user&act=man");
        else
            transfer("Lưu dữ liệu bị lỗi", "default.php?com=user&act=man");
    }
}

function delete_item() {
    global $d;

    if (isset($_GET['id'])) {
        $id = themdau($_GET['id']);

        // kiem tra
        $d->reset();
        $d->setTable('user');
        $d->setWhere('id', $id);
        $d->select();
        if ($d->num_rows() > 0) {
            $row = $d->fetch_array();
            if ($row['role'] != 1)
                transfer("Bạn không có quyền trên tài khoản này.<br>Mọi thắc mắc xin liên hệ quản trị website.", "default.php?com=user&act=man");
        }

        // xoa item
        $sql = "delete from #_user where id='" . $id . "'";
        if ($d->query($sql))
            transfer("Dữ liệu đã được xóa", "default.php?com=user&act=man");
        else
            transfer("Xóa dữ liệu bị lỗi", "default.php?com=user&act=man");
    } else
        transfer("Không nhận được dữ liệu", "default.php?com=user&act=man");
}

///////////////////////
function edit() {
    global $d, $item, $login_name,$config;

    if (!empty($_POST)) {
        $sql = "select * from #_user where username!='" . $_SESSION['login']['username'] . "' and username='" . $_POST['username'] . "' and role=3";
        $d->query($sql);
        if ($d->num_rows() > 0)
            transfer("Tên đăng nhập này đã có", "default.php?com=user&act=edit");

        $sql = "select * from #_user where username='" . $_SESSION['login']['username'] . "'";
        $d->query($sql);
        if ($d->num_rows() == 1) {
            $row = $d->fetch_array();
            if ($row['password'] != md5(md5("@Ibrand".$_POST['oldpassword'].$config["salt"])))
                transfer("Mật khẩu không chính xác", "default.php?com=user&act=edit");
        }else {
            die('Hệ thống bị lỗi. Xin liên hệ với admin. <br>Cám ơn.');
        }

        $data['username'] = $_POST['username'];
        if ($_POST['new_pass'] != "")
            $data['password'] = md5(md5("@Ibrand".$_POST['new_pass'].$config["salt"]));
        $data['ten'] = $_POST['ten'];
        $data['email'] = $_POST['email'];
        $data['nick_yahoo'] = $_POST['nick_yahoo'];
        $data['nick_skype'] = $_POST['nick_skype'];
        $data['dienthoai'] = $_POST['dienthoai'];

        $d->reset();
        $d->setTable('user');
        $d->setWhere('username', $_SESSION['login']['username']);
        if ($d->update($data)) {
            session_unset();
            transfer("Dữ liệu đã được lưu.", "default.php");
        }
    }

    $sql = "select * from #_user where username='" . $_SESSION['login']['username'] . "'";
    $d->query($sql);
    if ($d->num_rows() == 1) {
        $item = $d->fetch_array();
    }
}

function login() {
    global $d, $login_name;

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "select * from #_user where username='" . $username . "'";
    $d->query($sql);
    if ($d->num_rows() == 1) {
        $row = $d->fetch_array();
        if (($row['password'] == md5($password)) && ($row['role'] == 3)) {
            $_SESSION[$login_name] = true;
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['login']['username'] = $username;
            transfer("Đăng nhập thành công", "default.php");
        }
    }
    transfer("Tên đăng nhập, mật khẩu không chính xác", "default.php?com=user&act=login");
}

function logout() {
    global $login_name;
    $_SESSION[$login_name] = false;
    transfer("Đăng xuất thành công", "default.php?com=user&act=login");
}

?>