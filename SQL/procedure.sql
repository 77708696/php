mysql存储过程示例

CREATE  PROCEDURE `contact_insert`(IN userId CHAR(40),IN sum INT,IN in_card_groupID char(30),IN contact_group_id CHAR(30) )
BEGIN
	DECLARE i,uid INT;
	DECLARE phone varchar(12);
	DECLARE email,gid varchar(30);
	set i = 0;

	WHILE(i <= sum) DO

			set gid = rand_string(29);
			
		set i=i+1;
  END WHILE;
END

CREATE  FUNCTION `rand_string`(n INT) RETURNS varchar(255) CHARSET utf8
BEGIN
	DECLARE chars_str varchar(100) DEFAULT 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	DECLARE return_str varchar(255) DEFAULT '';
	DECLARE i INT DEFAULT 0;
  WHILE i < n DO
    SET return_str = concat(return_str,substring(chars_str , FLOOR(1 + RAND()*62 ),1));
    SET i = i +1;
  END WHILE;
	RETURN return_str;
END



CREATE  PROCEDURE `user_insert`(IN sum INT)
BEGIN
	DECLARE i,uid INT;
	DECLARE phone varchar(12);
	DECLARE email,gid varchar(30);
  DECLARE userid varchar(40);
	set i = 0;
	
  
	SELECT max(id) into uid FROM `account_basic`;
	WHILE(i <= sum) DO
		set userid =  left(uuid(),40);
		set uid = uid + 1;
		set email = CONCAT('tt_',LPAD( concat(uid),8,'0'),'@aa.com');
		set phone = concat('133', LPAD( concat(uid),8,'0'));
		#select uid,phone,email;

		INSERT INTO account_basic (user_id, mobile, email, password, secure_level, status) VALUES (userid, phone, email, 'e10adc3949ba59abbe56e057f20f883e', 10, 'active');
		set uid = LAST_INSERT_ID();
		INSERT INTO account_basic_detail (user_id, real_name, nick_name, avatar_path, gender, birthday, country_code) VALUES (userid, concat('rel_',uid), 'nc', 'null', 'n', '1981-01-01', 10000);
		INSERT INTO account_basic_extend_info (user_id, register_ip, created_time) VALUES (userid, 'ip', now());
		
		#set uid = uid + 1;
		set i=i+1;
	END WHILE;

END