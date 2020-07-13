<?php
	header("Content-Type: application/json");
	include_once ("../lib/db_connect.php");
	$connect = dbconn();
	
	$user_id = "";
	$pw = "";
	
	if (isset($_POST['user_id']))	$user_id = $_POST['user_id'];	
	if (isset($_POST['pw']))	$pw = $_POST['pw'];	
	
	if(!$user_id)ErrorJson("아이디를 입력하세요.", 'user_id');
	if(!$pw)ErrorJson("비밀번호를 입력하세요.", 'pw');	
		
	// 나의 정보 데이터 가지고 오기!
	$query = "select * , count(*) as count from member where user_id='$user_id'";	
	$result=mysqli_query($connect, $query);			
	$row=mysqli_fetch_array($result);	


	if((int)$row['count']==0) ErrorJson("존재하지 않는 회원아이디 입니다.",'user_id');
	
	$pw = md5($pw);
	if($row['pw']!=$pw)ErrorJson("비밀번호가 같지 않습니다.",'pw');	
	
	mysqli_close($connect);
	

	
	$_SESSION['member'] = $row; //저장하기	
	$_SESSION['user_id']=$row['user_id'];
	$_SESSION['name']=$row['name'];
	
	setcookie("MEMBER", serialize($row), time() + 60 * 60 * 24, "/");

	$return_result=array("result"=>"success");	
	echo(json_encode($return_result));
	
?>

