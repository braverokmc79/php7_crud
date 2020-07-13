<!DOCTYPE html>
<html>
    <head>
    	<meta http-equiv="content-type" content="text/html; charset=utf-8" />		
		<title>자유 게시판</title>
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
		<style>			
			#page_num {
				    font-size: 14px;				
				    width: inherit;
				    text-align: center;
				    display: inline-table; 
			}
			#page_num ul li {
				float: left;
				margin-left: 10px; 
				text-align: center;
			}
			.fo_re {
				font-weight: bold;
				color:red;
			}
			ul{list-style:none;}	
			button{cursor: pointer;}		
		</style>
    </head>
    <body>
    	

        <?php
         include ('../lib/db_connect.php');
			
		  $conn = dbconn();
		  //DB컨넥트
		  $member = member();
		  //회원정보
        
          $page=isset($_GET['page']) ? 	$_GET['page'] :1;
 	
 		  $sql="select * from bbs1";
          $result = mysqli_query($conn ,$sql);
          $row_num = mysqli_num_rows($result); //게시판 총 레코드 수
          $list = 10; //한 페이지에 보여줄 개수
          $block_ct = 5; //블록당 보여줄 페이지 개수

          $block_num = ceil($page/$block_ct); // 현재 페이지 블록 구하기
          $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
          $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

          $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
          if($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
          $total_block = ceil($total_page/$block_ct); //블럭 총 개수
          $start_num = ($page-1) * $list; //시작번호 (page-1)에서 $list를 곱한다.
      
	      $sql = "SELECT b.bno, b.user_id, b.`name`, b.subject , b.`level`, b.regdate, b.ip , m.nick_name FROM bbs1 b INNER JOIN member m ON b.user_id=m.user_id"; 
	      $sql .=" order by bno desc  limit $start_num, $list";	
		  $result = mysqli_query($conn,$sql);	        
       ?>
    
    	
		<table border='0' vellspacing='0' width='100%' height='100%' align='center' valign='top'>
				<tr>
					<td width='100%' height='70' align='left' valign='midole' bgcolor='e89c05'>
					<table border='0' width='90%' height='70' bgcolor='#e89c05' align='center' cellspacing='0' cellpadding='0'>
						<tr>
							<td width='100%' height='70' align='left' valgin='middle'><a href='../index.php'><strong>[홈]</strong></a> 
								&nbsp; &nbsp; &nbsp; <a href='./write.php'><strong>[게시판 글쓰기]</strong></a>
							</td>
	
						</tr>
						<tr>
							<td width='100%' height='100%' align='right' valign='middle'>&nbsp;
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
							</td>
	
						</tr>
					</table>
					</td>
				</tr>
	
				
				<tr>
				<td width='100%' height=100%' align='center' valign='top'>
				
				<table border='0' width='75%' height='100%'  align='center' cellspacing='0' cellpadding='0'>
					<tr>
						<td width='100%' height='10' colspan='5' bgcolor='fffff'>&nbsp;</td>
					</tr>
					<tr>	
						<td width='100%' height='30' colspan='5'  class='font_tdl' bgcolor='fffff' style="text-align:center">
							<h3>- 자유게시판 -</h3>							
						</td>
					</tr>
				<tr bgcolor='e00fde' style="font-weight:bold;">	
					<td class='font_tr2' width='5%'  height='30' align='center' valign='middle'>no</td>
					<td class='font_tr2' width='15%' height='30' align='center' valign='middle'>이름</td>
					<td class='font_tr2' width='40%' height='30' align='center' valign='middle'>제목</td>
					<td class='font_tr2' width='15%' height='30' align='center' valign='middle'>날짜</td>
					<td class='font_tr2' width='10%' height='30' align='center' valign='middle'>관리</td>
				</tr>
		
						
			      <?php
			          
				//쿼리 조회 결과가 있는지 확인
		        if($result){
		           // echo "조회 성공";
		        }else{
		         
				    //echo "결과 없음: ".mysqli_error($conn);
				    echo "<tr align='center' valign='middle'>
				    		<td colspan='5'>데이터가 없습니다. </td>
						</tr>";
					
		        }
			          
			               //반복문을 이용하여 result 변수에 담긴 값을 row변수에 계속 담아서 row변수의 값을 테이블에 출력한다.
			              while($row = mysqli_fetch_array($result)){ 
			            ?>
			                <tr align='center' valign='middle'>
			                    <td>
			                        <?php
			                            echo $row["bno"];
			                        ?>
			                    </td>
			                    <td>
			                        <?php			                            
			                            echo $row["name"];
			                           
			                        ?>
			                    </td>
			                    <td>
			                        <?php
			                        	echo "<a href='detail.php?bno=".$row["bno"]."'>";
			                            echo $row["subject"];
										 echo "</a>";
			                        ?>
			                    </td>
			                    <td>
			                        <?php
			                            echo date('Y-m-d ',strtotime($row["regdate"]));
			                        ?>
			                    </td>
			                     <td>			                        
			                        <button  onclick="checkUser('<?=$row['bno'] ?>' , '<?=$row['user_id'] ?>' , 'update')" >수정</button>
			                        <button  onclick="checkUser('<?=$row['bno'] ?>' , '<?=$row['user_id'] ?>' , 'delete')" >삭제</button>			                        
			                        </td>
			                </tr>
            <?php
                }
            ?>
			
			
					<tr>
						<td colspan='5' bgcolor='FFFFF'  align='center'>
							<?php paging($page,$block_start,$block_end,$block_num, $total_block,$total_page);  ?>
						</td>
					</tr>
	
				
				</table>

			</td>
			</tr>
			
		
		<tr>
			<td width='100%' height='100%' align='center' valign='top'>&nbsp;</td>
		</tr>
		</table>
				    
		    
 <form method="post" action="write.php" id="updateAction">
 	<input type="hidden" name="bno" id="update_bno">
 	<input type="hidden" name="action_type" value="update">
 </form>
 
        <?php  
        
          // 페이징 함수 구현      
         function paging($page,$block_start,$block_end,$block_num, $total_block,$total_page){
         		
				echo '<div id="page_num">';
				echo '<ul>';
				
		          if($page <= 1)
		          { //만약 page가 1보다 크거나 같다면
		            echo "<li class='fo_re'>처음</li>"; //처음이라는 글자에 빨간색 표시 
		          }else{
		            echo "<li><a href='?page=1'>처음</a></li>"; //알니라면 처음글자에 1번페이지로 갈 수있게 링크
		          }
		          if($page <= 1)
		          { //만약 page가 1보다 크거나 같다면 빈값
		            
		          }else{
		          $pre = $page-1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
		            echo "<li><a href='?page=$pre'>이전</a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
		          }
		          for($i=$block_start; $i<=$block_end; $i++){ 
		            //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
		            if($page == $i){ //만약 page가 $i와 같다면 
		              echo "<li class='fo_re'>[$i]</li>"; //현재 페이지에 해당하는 번호에 굵은 빨간색을 적용한다
		            }else{
		              echo "<li><a href='?page=$i'>[$i]</a></li>"; //아니라면 $i
		            }
		          }
		          if($block_num >= $total_block){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 빈 값
		          }else{
		            $next = $page + 1; //next변수에 page + 1을 해준다.
		            echo "<li><a href='?page=$next'>다음</a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
		          }
		          if($page >= $total_page){ //만약 page가 페이지수보다 크거나 같다면
		            echo "<li class='fo_re'>마지막</li>"; //마지막 글자에 긁은 빨간색을 적용한다.
		          }else{
		            echo "<li><a href='?page=$total_page'>마지막</a></li>"; //아니라면 마지막글자에 total_page를 링크한다.
		          }
		  
				echo '</ul>';
				echo '</div>';
				
		  }
        ?>

<script>
function checkUser(bno, writer, type){
	var login_user_id='<?= isset($member['user_id'])? $member['user_id']:'' ?>';
	if(writer!=login_user_id){
		alert("작성자만 수정 및 삭제가 가능합니다.");
		return;		
	}
	if(type=='update'){
		$("#update_bno").val(bno);
		$("#updateAction").submit();
		
	}else if(type=="delete"){
		
		if(confirm("정말 삭제 하시겠습니까?")){			
			$.ajax({
				type:"POST",
				url:"delete_process.php",
				data:{
					'bno':bno,
					'writer':writer
				},
				dataType:"json",
				success : function(data, status, xhr) { 				
					console.log(data.result); 
					if(data.result=="errorMsg"){
						alert(data.msg);
						return;		
					}else if(data.result=="success"){
						alert("삭제 되었습니다.");
						location.reload();
						return;		
					}
													
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log("error"); 
					console.log(jqXHR.responseText); 
				}	
		   });
		}
		
	}	
	
}		
</script>

    </body>
</html>    	



     