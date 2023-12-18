<?php
// Mulai session
session_start();

// Hapus semua data session
session_unset();

// Hapus session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Hancurkan session
session_destroy();

// Redirect ke halaman login atau halaman utama
header("Location:login.php");
exit();
