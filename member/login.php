<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=uft-8" />
		<title>로그인 페이지</title>
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	</head>
	<body>
	
			<table border='0' cellspacing='0' cellpadding='0' width='100%' height='100%' align='center' valign='top'>
				<tr>
					<td width='100%' height='70' align='left' valign='midole' bgcolor='#e89c05'> &nbsp; &nbsp; <a href='../index.php'><strong>[홈]</strong></a></td>
				</tr>
				<tr>
					<td width='100%' height='100%' align='center' valign='top'>
				
						<form action='login_post.php' name='member' method='post' id="memberForm">
							<table width="940"  style="padding:5px 0 5px 0; background:#eeeeee; height: 300px;">
								<tr height="2" >
									<td colspan="2" style="text-align: center">										
										<h2>[로그인]</h2>
									</td>
								</tr>
								<tr>
									<th> 회원아이디:</th>
									<td>
									<input type='text' name='user_id' 	size='10'>
									</td>
								</tr>
							
								<tr>
									<th>비밀번호:</th>
									<td>
									<input type='password' name='pw' size='10'>
									</td>
								</tr>							
						
							<tr>
								<td colspan="2" align="center">
								<input type="button" value="로그인" onclick="memberLogin()"  style="cursor: pointer">
								</td>
							</tr>			
					</td>
			</tr>
		</form>

		</table>
		</td>
		</tr>
		</table>


<script>
function memberLogin(){
	var sendData=$("#memberForm").serialize();

	$.ajax({
		type:"POST",
		url:"login_post.php",
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
				alert("로그인 되었습니다.");
				location.href="../index.php";
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