<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<title>게시판  상세</title>
		<?php
			include_once ("../lib/db_connect.php");
			$connect = dbconn();
			$member = member();	
			if(!isset($_GET['bno']) || $_GET['bno']==''){
				Error("잘못 된 접근입니다.");
			}		
			$bno=$_GET['bno'];
			$query="select * from bbs1 where bno=$bno";
			$result=mysqli_query($connect, $query);
			$row_count=mysqli_num_rows($result);			
			if($row_count!=1){
				Error("잘못 된 접근입니다.");
			}
	
			$row=mysqli_fetch_array($result);
						
		?>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<style>
		input{
			background-color: #eee;
    		border: 0px;    		
		}	
		input:focus, textarea:focus { outline: none; }		
	</style>
	</head>
	<body>
	
			<table border='0' cellspacing='0' cellpadding='0' width='100%' height='100%' align='center' valign='top'>
				<tr>
					<td width='100%' height='70' align='left' valign='midole' bgcolor='#e89c05'> &nbsp; &nbsp; <a href='../index.php'><strong>[홈]</strong></a>
						&nbsp; &nbsp; &nbsp; <a href='./write.php'>[게시판 글쓰기]</strong></a>
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
				
					
				
						
							<table width="940"  style="padding:5px 0 5px 0; background:#eeeeee; height: 500px;">
								<tr>
									<td style="text-align: center">										
										<h2>[자유게시판 상세보기]</h2>
									</td>
								</tr>
														
								<tr>
									<td>
										<div style="margin-left: 100px">
										아이디 :									
										<input type='text' name='user_id' size='15' value='<?=$row['user_id'] ?>' readonly='readonly'>											
										</div>										
									</td>
								</tr>
											
								<tr>
									<td>
										<div style="margin-left: 100px">
										이&nbsp;&nbsp;&nbsp;름:
										<input type='text' name='name' size='15' value='<?=$row['name'] ?>' readonly='readonly'>
										닉네임:<input type='text' name='nick_name' size='15' value='<?= $row['nick_name']?>' readonly='readonly'>											
										</div>										
									</td>
								</tr>
						

								<tr>
									<td>
										<div style="margin-left: 100px">
										제목 :									
										<input type='text' name='subject' value="<?= $row['subject']?>" style="width:500px; height:30px;">											
										</div>										
									</td>
								</tr>											
										
								
								<tr>
									<td width='100%' height='420' align='center' valign='middle' >
									<textarea name='story' id="story" style="width:80%; height:400px;" readonly=""><?= $row['story']?></textarea>
									</td>
								</tr>

								<tr>
									<td width='100%'  align='center' valign='middle' >
										<form method="post" action="write.php" id="updateAction">
										<a href="list.php">목록</a>
										<?php
											if(isset($member['user_id'])){
												if($row['user_id']==$member['user_id']){
										?>										 
										 	<input type="hidden" name="bno" value="<?=$bno?>">
										 	<input type="hidden" name="action_type" value="update">
										 	<button type="submit" style="background: green; color: #fff">수정</button>
										 
										<?php	
												}
											}										
										?>
										</form>
									</td>
								</tr>
			</table>
	

		
		</td>
		</tr>
		</table>





	</body>
</html>

