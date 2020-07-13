<?php

	header("content-type:text/html; charset=UTF-8");
	include_once ("../lib/db_connect.php");
	$connect= dbconn();//DB컨넥트
	$member=member(); //회원정보
	
	if(!isset($member['user_id']))Error("로그인 후 이용해 주세요.");

	//$id = "";
	$user_id = $member['user_id']; //회원 USER_ID
	$name = $member['name']; //회원 이름
	$nick_name = $member['nick_name']; //닉네임
	$subject = "";
	$story = "";

	//if (isset($_POST['id']))	$id = $_POST['id']; //게시판 ID
	if (isset($_POST['subject']))	$subject = $_POST['subject']; //게시판 제목
	if (isset($_POST['story']))	$story = $_POST['story']; //게시판 내용
	 

	$regdate=date("YmdHis", time()); //날짜,시간
	$ip=getenv("REMOTE_ADDR"); //ip
	$level=isset($member['level']) ?  $member['level']:'3'; //회원 레벨 3=일반 2=관리자 1=최고관리자

	$action_type=isset($_POST['action_type']) ? $_POST['action_type'] :"insert";
 	
 	if($action_type=="update"){
 			
 		//수정일 경우		
 		$bno=$_POST['bno'];
		$query="UPDATE bbs1 SET subject=? , story=? WHERE bno=? and user_id=?";			
		$stmt = $connect->prepare($query);
		$stmt->bind_param("ssss", $subject, $story, $bno, $user_id);
		$action="수정";
		
 	}else{
 		//등록일 경우		
 		$query="insert into bbs1( user_id, `name`,`nick_name`,subject,story, `level`, regdate, ip)
                    values( ?, ?, ?,  ?, ?, ?, ?, ?)";			
		$stmt = $connect->prepare($query);
		$stmt->bind_param("ssssssss", $user_id, $name, $nick_name ,$subject, $story, $level, $regdate, $ip);
		$action="등록";	
 	}

    $result=$stmt->execute();
	$stmt->close();
	$connect->close();
	
	
	if($result){		
?>
	<script>
	window.alert('글 <?= $action ?> 되었습니다.');
	<?php 
		if($action_type=="update"){
			echo ("location.href='./detail.php?bno=".$bno."';");			
		}else{
			echo ("location.href='./list.php';");
		}
	?>	
	</script>
<?php		
	}else{
?>
	<script>
	window.alert('글<?= $action ?>에 실패 하였습니다.');
	location.href='./list.php';
	</script>


<?php
	}
?>

