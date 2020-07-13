<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html: charset=utf-8" />
<link type='text/css' href='./lib/m_style.css' rel='stylesheet'>
<title>홈페이지</title>
</head>
<body>
<?php
	include_once ("./lib/db_connect.php");
	$connect = dbconn();
	$member=member();  //회원정보
?>
<table border='0' width='100%' height='100%' align='center'
		cellspacing='0' cellpadding='0'>
		<tr>
			<td width='100%' height='100%' align='center'>
				<table border='0' width='100%' height='100%' align='center' cellspacing='0' cellpadding='0'>
					
					<tr>
						<td width='100%' height='80' align='center' bgcolor='#764300'>							
							<font color='#ffffff'> <strong>[홈페이지 상단입니다]</strong></font>
						</td>						
					</tr>
					
					
					<tr>
						<td width='100%' height='50' align='right'>
							<?php
								if(isset($member['user_id'])){
										echo $member['name'] . "(" . $member['user_id'] . ")님 환영합니다.";	
								}else{
											
								?>
								<a href="./member/join.php"><strong>[회원가입]</strong></a> &nbsp; &nbsp;
															&nbsp; <a href="./member/login.php"><strong>[로그인]</strong></a>
								<?php
								}
								?> 
								
								&nbsp; &nbsp;
								<?php 
									if(isset($member['user_id'])){
								?>
								<a href="./member/logout.php"><strong>[로그아웃]</strong></a>
								<?php
									}
							?>
 						</td>
					</tr>
					
					<tr>
						<td width='100%' height='30' align='left' valign='top'bgcolor='#452403'>&nbsp; &nbsp; &nbsp; &nbsp;
							<a href='./board/list.php'><font color='ffffff'>[자유게시판]</font></a>
							<a href='./temp/create_table.php' style="float:right"><font color='ffffff'>[테이블 생성]</font></a>							
						</td>
					</tr>					
					<tr>
						<td width='100%' height='500' align='center' bgcolor='#ffffff'>홈페이지
							메인입니다.</td>
					</tr>
					
					<tr>
						<td width='100%' height='100%' align='center' bgcolor='#ffffff'>&nbsp;</td>

					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>