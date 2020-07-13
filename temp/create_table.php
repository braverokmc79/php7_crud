<?php
  header("content-type:text/html; charset=UTF-8");
  include_once("../lib/db_connect.php");
  $connect= dbconn();
	   
  $sql="create table member(
		no int not null auto_increment primary KEY,
		user_id varchar(50),
		`name` varchar(50),
		nick_name varchar(50),
		birth VARCHAR(20),
		sex varchar(5),
		tel VARCHAR(20),
		email VARCHAR(30),
		pw VARCHAR(100),
		addr_1 VARCHAR(100),
		addr_2 VARCHAR(100),
		`level` CHAR(1) default '3' ,
		regdate datetime,
		ip VARCHAR(20)
	)";
	
   $sql2="create table bbs1(
		`bno` int not null auto_increment primary KEY,
		`user_id` varchar(50),
		`name` varchar(50),
		`nick_name` varchar(50),
		`subject` VARCHAR(250),
	 	`story` text,	
		`level` CHAR(1),
		regdate datetime,
		ip VARCHAR(20)
	)
	";   
	   
   $query =mysqli_query($connect,$sql);
   if (!$query){   	  	
   	   $result=mysqli_error($connect);
    	 // die('테이블 생성에 실패 하였습니다.<br>' . $result);
	  	echo '
		<script>
		window.alert("'.$result.'");
		history.back(1);
		</script>
		';		
		mysqli_close($connect);
		exit;  //위에 에러 메시지만 뛰운다.
   }
	  
   $query2 =mysqli_query($connect,$sql2);

   
   if (!$query2){
   	  
   	   $result=mysqli_error($connect);
    	 // die('테이블 생성에 실패 하였습니다.<br>' . $result);
	  	echo '
		<script>
		window.alert("'.$result.'");
		history.back(1);
		</script>
		';
		 mysqli_close($connect);	
		exit;  //위에 에러 메시지만 뛰운다.
   }
     
   mysqli_close($connect);	
?>

<script>
	window.alert("테이블을 생성 하였습니다.");
	history.back(1);		
</script>





