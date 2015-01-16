<?php
$my_array = array("b" => "Cat","a" => "Dog",  "c" => "Horse");
//ksort($my_array);
//print_r($my_array);
//exit();
$dsn = 'mysql:dbname=testdb;host=localhost;port=8066';
$user = 'root';
$password = '123456';
//exit('aaaaaaaaaa');
$dbh = new PDO($dsn, $user, $password);

$sql="SELECT * from tb1;";

$sth = $dbh->prepare($sql);
$sth->execute();
print_r($sth->fetchAll());

$dbh->beginTransaction();

$sql="insert into tb1 (id,`name`) values (null,'huang')";
$sth = $dbh->prepare($sql);
$sth->execute();
$dbh->commit();
exit();
$sql="SELECT * FROM contact_card where user_id=:userId AND uuid in (?)";
$sql="SELECT * FROM contact_card where user_id=:userId AND uuid in (:in_0,:in_1)";



$sth = $dbh->prepare($sql);
$sth->bindValue(':userId', '0FjLng5hYnAuexIB26GO4fFc0PzORcEAEWxeFz2S', PDO::PARAM_STR);
$sth->bindValue(':in_0', 'A0MA90FbxK89n0bkczUMuFTPXH7iM9JC', PDO::PARAM_STR);
$sth->bindValue(':in_1', 'ADek4nviVe5wtfRAj07HF8qpyoWNt0he', PDO::PARAM_STR);
$sth->execute();

print_r($sth->fetchAll());