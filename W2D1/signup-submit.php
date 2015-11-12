<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * person_name, gender(M/F), age,personality,favoriteOS,min_seek_age, max_seek_age
 */
$addeto_file=false;
$person_name=isset($_POST['person_name'])?$_POST['person_name']:"";
$gender=isset($_POST['gender'])?$_POST['gender']:"";
$age=isset($_POST['age'])?$_POST['age']:"";
$personality=isset($_POST['personality'])?$_POST['personality']:"";
$favoriteOS=isset($_POST['favoriteOS'])?$_POST['favoriteOS']:"";
$min_seek_age=isset($_POST['min_seek_age'])?$_POST['min_seek_age']:"";
$max_seek_age=isset($_POST['max_seek_age'])?$_POST['max_seek_age']:""; 
if($person_name!="" && $gender!="" && $age!="" && $personality!="" && $favoriteOS!="" && $min_seek_age!="" && $max_seek_age!=""){       
$line="\n" . $person_name . "," . $gender . "," . $age . "," . $personality . "," . $favoriteOS . "," . $min_seek_age . "," . $max_seek_age;
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




  
