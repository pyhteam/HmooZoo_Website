<?php
// XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0369962642 | https://www.facebook.com/pyhteam.mssen

// error_reporting(0);
if (!isset($_SESSION)) {
    session_start();
}
date_default_timezone_set('Asia/Ho_Chi_Minh');
$database    = 'db_hmoozoo';
$username    = 'root';
$password    = '';
$host        = 'localhost';

$conn = new mysqli($host, $username, $password, $database);
mysqli_set_charset($conn, 'UTF8');
if ($conn->connect_error) {
    die("Lỗi kết nối database. Vui lòng thử lại !");
}
    
    // XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0369962642 | https://www.facebook.com/pyhteam.mssen