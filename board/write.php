<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<title>게시판 글쓰기</title>
		<?php
			include_once ("../lib/db_connect.php");
			$connect = dbconn();
			$member = member();
			if(!isset($member['user_id'])){
				Error("로그인 후 이용해 주세요.");
			}
			
			//수정일경우
			$action_type=isset($_POST['action_type']) ? $_POST['action_type'] :"insert";
			if($action_type=="update"){
				$bno=$_POST['bno'];
				$action="수정";
				
				$query="select * from bbs1 where bno=$bno";
				$result=mysqli_query($connect, $query);
				$update_board=mysqli_fetch_array($result);
								
			}else{
					
				$action="등록";
			} 
		?>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	</head>
	<body>
	
			<table border='0' cellspacing='0' cellpadding='0' width='100%' height='100%' align='center' valign='top'>
				<tr>
					<td width='100%' height='70' align='left' valign='midole' bgcolor='#e89c05'> &nbsp; &nbsp; <a href='../index.php'><strong>[홈]</strong></a>
						&nbsp; &nbsp; &nbsp; <a href='./list.php'><strong>[게시판 목록]</strong></a>
						
						<div style="float: right">
						<?php
								if(isset($member['user_id'])){
										echo $member['name'] . "(" . $member['user_id'] . ")님 환영합니다.";	
								}else{
											
								?>
								<a href="../member/join.php"><strong>[회원가입]</strong></a> &nbsp; &nbsp;
															&nbsp; <a href="../member/login.php"><strong>[로그인]</strong></a>
								<?php
								}
								?> 
								
								&nbsp; &nbsp;
								<?php 
									if(isset($member['user_id'])){
								?>
								<a href="../member/logout.php"><strong>[로그아웃]</strong></a>
								<?php
									}
							?>
						</div>
						
					</td>
				</tr>
				<tr>
					<td width='100%' height='100%' align='center' valign='top'>
				
				
				
						<form action='write_post.php' name='member' method='post' id="bbsWriteForm">
							<table width="940"  style="padding:5px 0 5px 0; background:#eeeeee; height: 500px;">
								<tr>
									<td style="text-align: center">										
										<h2>[자유게시판 글 <?= $action?>]</h2>
									</td>
								</tr>
							
							
								<tr>
									<td>
										<div style="margin-left: 100px">
										아이디 :									
										<input type='text' name='user_id' size='15' value='<?=$member['user_id'] ?>' readonly='readonly'>											
										</div>										
									</td>
								</tr>
											
								<tr>
									<td>
										<div style="margin-left: 100px">
										이&nbsp;&nbsp;&nbsp;름:
										<input type='text' name='name' size='15' value='<?=$member['name'] ?>' readonly='readonly'>
										닉네임:<input type='text' name='nick_name' size='15' value='<?= $member['nick_name']?>' readonly='readonly'>											
										</div>										
									</td>
								</tr>
						

								<tr>
									<td>
										<div style="margin-left: 100px">
										제목 :									
										<input type='text' name='subject' id="subject" style="width:500px; height:30px;" value="<?= isset($update_board['subject'])? $update_board['subject']: ''?>">	
																				
										</div>										
									</td>
								</tr>											
										
								
								<tr>
									<td width='100%' height='420' align='center' valign='middle' >
									<textarea name='story' id="story" style="width:80%; height:400px;"><?= isset($update_board['story'])? $update_board['story']: ''?></textarea>
									</td>
								</tr>

								<tr>
									<td width='100%'  align='center' valign='middle' >
										<input type="hidden" name="action_type" value="<?= $action_type?>">
										<input type="hidden" name="bno" value="<?= isset($bno)? $bno: ''?>">										
										<button type="button" onclick="bbsWrite()"><?= $action?></button>
									</td>
								</tr>
			</table>
		</form>

		
		</td>
		</tr>
		</table>


<script>
function bbsWrite(){
	var subject=$("#subject").val();
	var story=$("#story").val();
	
	
	if($.trim(subject).length==0){
		alert("제목을 입력해 주세요.");
		$("#subject").focus();
		return ;
	}
	
	if($.trim(story).length==0){
		alert("내용을 입력해 주세요.");
		$("#story").focus();
		return ;
	}
	$("#bbsWriteForm").submit();
}	
</script>


	</body>
</html>

