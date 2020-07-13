<?php
	header("Content-Type: application/json");
	include_once ("../lib/db_connect.php");
	$connect = dbconn();
	$member=member(); //회원정보
	
	if(!isset($member['user_id']))ErrorJson("잘못된 접근입니다");

	$user_id = $member['user_id'];
	$bno = isset($_POST['bno']) ? $_POST['bno']:'';
	$writer = isset($_POST['writer']) ? $_POST['writer']:'';

	if(!$bno)ErrorJsonMessage("잘못된 접근입니다".$bno." : ".$writer);
	if(!$writer)ErrorJsonMessage("잘못된 접근입니다");
	if($user_id!=$writer)ErrorJsonMessage("잘못된 접근입니다");


	$stmt = $connect->prepare("delete from bbs1 where bno=?");
	$stmt->bind_param("s", $bno);
	if($stmt->execute()){
		$return_result=array("result"=>"success", "msg"=>"삭제 처리 되었습니다.");
		echo(json_encode($return_result));		
	}else{
		$return_result=array("result"=>"failed", "msg"=>"삭제 처리 오류");
		echo(json_encode($return_result));
	}	
	$stmt->close();
	$connect->close();
	
	

?>

