
create user `wsj1`@`localhost` identified by 'wsj1';
create user `wsj1`@`%` identified by 'wsj1';  
  
create database wsj1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
  
grant all privileges on wsj1.* to `wsj1`@`localhost` ;
grant all privileges on wsj1.* to `wsj1`@`%` ;

create table member(
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
);


create table bbs1(
	`bno` int not null auto_increment primary KEY,
	` user_id` varchar(50),
	`name` varchar(50),
	 `nick_name` varchar(50),
	`subject` VARCHAR(250),
 	story text,	
	`level` CHAR(1),
	regdate datetime,
	ip VARCHAR(20)
);


DELIMITER $$
DROP PROCEDURE IF EXISTS loopInsert$$
 
CREATE PROCEDURE loopInsert()
BEGIN
    DECLARE i INT DEFAULT 1;
        
    WHILE i <= 500 DO
        insert into bbs1( user_id, `name`,`nick_name`,subject,story, `level`, regdate, ip) 
			values( 'test1','홍길동','닉홍길동',concat('제목',i),concat('내용',i),'3',now(),'84.17.34.25');
        SET i = i + 1;
    END WHILE;
END$$
DELIMITER $$



CALL loopInsert();



