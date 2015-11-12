<?php
require_once("db-connection.php");

$addeto_file=false;
$person_name=isset($_POST['person_name'])?$_POST['person_name']:"";
$gender=isset($_POST['gender'])?$_POST['gender']:"";
$age=isset($_POST['age'])?(int)$_POST['age']:"";
$personality=isset($_POST['personality'])?$_POST['personality']:"";
$favoriteOS=isset($_POST['favoriteOS'])?$_POST['favoriteOS']:"";
$min_seek_age=isset($_POST['min_seek_age'])?(int)$_POST['min_seek_age']:"";
$max_seek_age=isset($_POST['max_seek_age'])?(int)$_POST['max_seek_age']:""; 
$password=filter_input(INPUT_POST,"password");
$hashed_password=password_hash($password,PASSWORD_DEFAULT);
//manipulate the database here 
$types= str_split(trim($personality));
if($db!=NULL){
        if(count($types)>3){ 
            $stmt=$db->prepare("INSERT INTO singles(name,pass,gender,age,"
                    . "type1,type2,type3,type4,os,min,max) VALUES("
                    . ":name,:password,:gender,:age,:types0,:types1,"
                    . ":types2,:types3,:os,:min_seek_age,:max_seek_age)");
            $stmt->execute(array(':name'=>$person_name,':password'=>$hashed_password,
                ':gender'=>$gender,':age'=>$age,'types0'=>$types[0],
                ':types1'=>$types[1],':types2'=>$types[2],':types3'=>$types[3],
                ':os'=>$favoriteOS,':min_seek_age'=>$min_seek_age,':max_seek_age'=>$max_seek_age));

        }
}
//manipulate the file here 
if($person_name!="" && $hashed_password!="" && $gender!="" && $age!="" && $personality!="" && $favoriteOS!="" && $min_seek_age!="" && $max_seek_age!=""){       
$line="\n$person_name,$gender,$age,$personality,$favoriteOS, $min_seek_age, $max_seek_age";
    $x=file_put_contents("singles.txt", $line,FILE_APPEND); 
    $addeto_file=true;

}  

?>
     <?php if($addeto_file):
         include("top.html")?>
     <P>Thanks You</p>
     <p>Welcome to NerdLuv, <?=$person_name?></p>
     <P>Now<a href="matches.php">log in see your matches!<a></p>
     <?=include("bottom.html")?>
      <?php else: 
           include("top.html")?>
         <p>Please fill out all the required fields</p>
         <?=include("bottom.html")?>
      <?php endif;?>




  
