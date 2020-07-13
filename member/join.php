<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=uft-8" />
		<title>회원가입</title>
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	</head>
	<body>
	
			<table border='0' cellspacing='0' cellpadding='0' width='100%' height='100%' align='center' valign='top'>
				<tr>
					<td width='100%' height='70' align='left' valign='midole' bgcolor='#e89c05'> &nbsp; &nbsp; <a href='../index.php'><strong>[홈]</strong></a></td>
				</tr>
				<tr>
					<td width='100%' height='100%' align='center' valign='top'>
				
				
				
						<form action='join_post.php' name='member' method='post' id="memberForm">
							<table width="940"  style="padding:5px 0 5px 0; background:#eeeeee; height: 500px;">
								<tr height="2" >
									<td colspan="2" style="text-align: center">										
										<h2>[회원가입]</h2>
									</td>
								</tr>
								<tr>
									<th> 회원아이디:</th>
									<td>
									<input type='text' name='user_id' 	size='10'>
									</td>
								</tr>
								<tr>
									<th>이름:</th>
									<td>
									<input type='text' name='name' size='10'>
									닉네임:
									<input type='text' name='nick_name' size='10'>
									</td>
								</tr>
								<tr>
									<th>생년월일:</th>
									<td>
									<input type='text' name='birth' size='10'>
										&nbsp; &nbsp; &nbsp;
										성별:
		
										<input type='radio' name='sex' checked="true" value="male">
										남자&nbsp; &nbsp;
										<input type='radio' name='sex' value="female">
										여자
									</td>
								</tr>
								<tr>
									<th>연락처:</th>
									<td>
									<input type='text' name='tel' size='10'>
									</td>
								</tr>
								<tr>
									<th>이메일:</th>
									<td>
									<input type='text' name='email' size='10'>
									</td>
								</tr>
								<tr>
									<th>비밀번호:</th>
									<td>
									<input type='password' name='pw' size='10'>
								</tr>
								
							<tr>
								<th>주소:</th>
								<td>
								<input type='text' name='addr_1' size='15'>
								&nbsp &nbsp; 상세주소
								<input type='text' name='addr_2' size='15'>
								</td>
							</tr>

							<tr>
								<td colspan="2" align="center">
								<input type="button" value="회원가입" onclick="memberJoin();"  style="cursor: pointer">
								<input type="reset" value="취소" style="cursor: pointer">
								</td>
							</tr>
			
			
					</td>
			</tr>
			</table>
		</form>

		
		</td>
		</tr>
		</table>


<script>
function memberJoin(){
	var sendData=$("#memberForm").serialize();
	
	$.ajax({
		type:"POST",
		url:"join_post.php",
		data:sendData,
		dataType:"json",
		success : function(data, status, xhr) { 
			console.log("success");
			console.log(data); 
			if(data.result=="errorMsg"){
				alert(data.msg);
				$("input[name="+data.id+"]").focus();
				return;
			}
			if(data.result=="success"){
				alert(data.msg);
				location.href="login.php";
			}
			
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log("error"); 
			console.log(jqXHR.responseText); 
		}	
	});
}	
</script>


	</body>
</html>