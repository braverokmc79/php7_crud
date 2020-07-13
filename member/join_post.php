<?php
	header("Content-Type: application/json");
	include_once ("../lib/db_connect.php");
	$connect = dbconn();


	$user_id = "";
	$name = "";
	$nick_name = "";
	$birth = "";
	$sex = "";
	$tel = "";
	$email = "";
	$pw = "";
	$addr_1 = "";
	$addr_2 = "";


	if (isset($_POST['user_id']))	$user_id = $_POST['user_id'];
	if (isset($_POST['name']))	$name = $_POST['name'];
	if (isset($_POST['nick_name']))	$nick_name = $_POST['nick_name'];
	if (isset($_POST['birth']))	$birth = $_POST['birth'];
	if (isset($_POST['sex']))	$sex = $_POST['sex'];
	if (isset($_POST['tel']))	$tel = $_POST['tel'];
	if (isset($_POST['email']))	$email = $_POST['email'];
	if (isset($_POST['pw']))	$pw = $_POST['pw'];
	if (isset($_POST['addr_1']))	$addr_1 = $_POST['addr_1'];
	if (isset($_POST['addr_2']))	$addr_2 = $_POST['addr_2'];


	if(!$user_id)ErrorJson("아이디를 입력하세요.", 'user_id');
	if(substr($user_id,"12"))ErrorJson("회원아이디는 12자 까지만 허용됩니다.", 'user_id');
	if(preg_match("/[^a-z 0-9]/",$user_id))ErrorJson("아이디는 영문소문자와 숫자만 가능합니다.",'user_id');

	$query = "select count(*) as count from member where user_id='$user_id'";
	$result=mysqli_query($connect, $query);			
	$row=mysqli_fetch_row($result);			
	if((int)$row[0]>0)ErrorJson("이미 등록된 아이디 입니다.",'user_id');
		
	if(!$name)ErrorJson("이름을 입력하세요." ,'name');	
	if(!$nick_name)ErrorJson("닉네임을 입력하세요." ,'nick_name');	
    if( !(strlen($name)>6 && strlen($name)<15) ) ErrorJson("이름은 2자에서 5자 까지 허용합니다.", "name");//한글은 1자당 3byte
	if(!$birth)ErrorJson("생년월일 입력하세요.",'birth'); 
	if(!(strlen($birth)==8)) ErrorJson("생년월일을은 8자를 입력하세요.", "birth"); 	
	if(!$sex)ErrorJson("성별을 선택 하세요.", 'sex');		
	if(!$tel)ErrorJson("연락처를 입력하세요.", 'tel'); 
	if(!(strlen($tel)>=8 && strlen($tel)<=15))ErrorJson("연락처는 최소8자리 부터 15자리 까지 입니다.",'tel');	
	if(!$email) ErrorJson("이메일을 입력하세요.", "email");
	if(!$email || !preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) ErrorJson("이메일주소가 잘못되었습니다.","email");
	if(!$pw)ErrorJson("비밀번호를 입력하세요.", 'pw');	 
	if(!$addr_1)ErrorJson("처음주소는 필수입니다.",'addr_1');


	$pw = md5($pw);
	//비밀번호 암호화

	$regdate = date("YmdHis", time());
	//날짜 시간
	$ip = getenv("REMOTE_ADDR");
	//ip
/*
	$query = "insert into member( user_id, name, nick_name, birth, sex, tel, email, pw, addr_1, addr_2, regdate, ip)
		values('$user_id', '$name', '$nick_name', '$birth', '$sex', '$tel', '$email', '$pw', '$addr_1', '$addr_2', '$regdate', '$ip')";

	
	mysqli_query($connect, $query);
	mysqli_close($connect);
	
	$return_result=array("result"=>"success", "msg"=>"회원가입이 완료 되었습니다.");
	echo(json_encode($return_result));
	
 * 
 */

	$query = "insert into member( user_id, name, nick_name, birth, sex, tel, email, pw, addr_1, addr_2, regdate, ip)
		values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


	$stmt = $connect->prepare($query);
	$stmt->bind_param("ssssssssssss", $user_id, $name, $nick_name ,$birth, $sex, $tel, $email, $pw, $addr_1, $addr_2, $regdate, $ip);
	$result=$stmt->execute();
	$stmt->close();
	$connect->close();
	
	if($result)$return_result=array("result"=>"success", "msg"=>"회원가입이 완료 되었습니다.");	
	else $return_result=array("result"=>"success", "msg"=>"회원가입에 실패 하였습니다.");
		
	echo(json_encode($return_result));
	

?>

