<?php

if (!defined('_source'))
    die("Error");

$act = (isset($_REQUEST['act'])) ? addslashes($_REQUEST['act']) : "";

switch ($act) {
    case "login":
        if (!empty($_POST))
            login();
        break;


    default:
        $template = "index";
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
            $_SESSION['login']['username'] = $username;
            transfer("Đăng nhập thành công", "index.php");
        }
    }
    transfer("Tên đăng nhập, mật khẩu không chính xác", "index.php?com=user&act=login");
}

function logout() {
    global $login_name;
    $_SESSION[$login_name] = false;
    transfer("Đăng xuất thành công", "index.php?com=user&act=login");
}

?>