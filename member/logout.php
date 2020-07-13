<?php 
header("content-type:text/html; charset=UTF-8");
 
if ((function_exists('session_status') && session_status() !== PHP_SESSION_ACTIVE) || !session_id()) {
	session_start();//세션 시작
}
 setcookie("COOKIES","",0,"/"); //쿠키 지우기
 session_destroy();
 ?>
 
 <script>
 window.alert('로그아웃 되었습니다.');
 location.href='../index.php';
 </script>