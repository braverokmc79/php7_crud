<?php
//에러 출력
error_reporting(E_ALL);
ini_set("display_errors", 1);

if ((function_exists('session_status') && session_status() !== PHP_SESSION_ACTIVE) || !session_id()) {
	session_start();//세션 시작
}
		 
function dbconn(){
	$host_name="localhost"; //호스트네임
	$db_user_id="wsj1";     //DB user id
	$db_name="wsj1";        //DB아이디
	$db_pw="wsj1";         //DB비번	
	//mysqli_connect([아이피], [아이디], [비밀번호], [DB명], [포트]);
	$connect = mysqli_connect($host_name,$db_user_id,$db_pw, $db_name,'3306') or die("연결에 실패 하였습니다....");
	return $connect;
}

//에러메시지 줄력
function Error($msg){
	echo "
	<script>
	window.alert('$msg');
	history.back(1);
	</script>
	";
	exit;  //위에 에러 메시지만 뛰운다.
}

//에러메시지 줄력
function ErrorJson($msg, $id){
	$result=array("result"=>"errorMsg", "msg"=>$msg, "id"=>$id);
	echo(json_encode($result));
	exit; 
}

function ErrorJsonMessage($msg){
	$result=array("result"=>"errorMsg", "msg"=>$msg);
	echo(json_encode($result));
	exit; 
}



function member(){
	global $connect;	
	$member="";
	if(isset($_SESSION["member"])){
		$member =$_SESSION["member"];	
	}
	 
	return $member;
}


?>