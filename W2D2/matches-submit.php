<?php

require_once("db-connection.php");
include("top.html");

$seeker_name=isset($_POST['seeker'])?$_POST['seeker']:NULL;
$seeker_password=isset($_POST['password'])?password_hash($_POST['password'],PASSWORD_DEFAULT ):NULL;
if(!$seeker_password||!$seeker_name){
    header('Location:matches.php');
    exit();
}
//search a match from database if there is a connection object
if($db!=NULL){
                $stmts=$db->prepare("select* from singles where name=:name");
            $stmts->execute(array(':name'=>$seeker_name));
            //this array will be used to compare the matches with this particular seeker
            $stmt=array();
            foreach($stmts as $st){
                $stmt=$st;
                if(!password_verify($_POST['password'], $st['pass'])){
                    header('Location: matches.php');
                    exit();
                }
            }
            //if php doesn't exit on the top line, that means password matches so go head do the matche

            $rows=$db->prepare('select * from singles where gender<>:gender '
                    . 'AND age>=:min AND age<=:max AND os=:os '
                    . 'AND(type1=:type1 OR type2=:type2 OR type3=:type3 OR type4=:type4)');

            $rows->execute(array(':gender'=>$stmt['gender'],':min'=>$stmt['min'],
                                    ':max'=>$stmt['max'],':os'=>$stmt['os'],':type1'=>$stmt['type1'],
                                    ':type1'=>$stmt['type1'],':type2'=>$stmt['type2'],
                                    ':type3'=>$stmt['type3'],':type4'=>$stmt['type4']));

            ?>
            <p>This is from database, if you stop mysql server, i can read from a backup file too</p>
            <p>Matches for <?=$seeker_name?></p>
            
            <div class="match"> 
             <?php
            if(count($rows)!==0):
            foreach($rows as $row):?>
                <p class="match">

                        <img class="match" src="images/user.jpg"/>
                        <?= $row['name'];?>
                    </p>

                    <ul>           
                        <li><strong>Gender:</strong><?=$row['gender'];?></li>
                         <li><strong>Age:</strong><?=$row['age'];?></li>  
                         <li><strong>Type:</strong><?=$row['type1'] . $row['type2'] . $row['type3'] . $row['type4'];?></li> 
                          <li><strong>OS:</strong><?=$row['os'];?></li>             

                     </ul>

                    <?php endforeach;?>
                    <?php endif;?>
                </div>
                 <?php require_once("bottom.html");
                     exit();
                 ?> 

            <?php

}

//search a match from file

if($seeker_name!=NULL && $seeker_password!=NULL){
    $lines=file("singles.txt",FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
    foreach($lines as $line){
       
        if($seeker_name===substr($line,0,strlen($seeker_name))){
            list($seeker_name,$seeker_gender,$seeker_age,$seeker_personality, $seeker_favoriteOS,$seeker_min_seek_age,$seeker_max_seek_age)=explode(",",$line);
            if(false){//make this false for the users in file because now password is set for them
                //this will be used when password field is added to the singles text file later
                //for now most the users aoesn't have password field jump it from checking
                header('Location:matches.php');
                exit();
            }
             break;
        }

    }
   
}

?>

<?php
//search singles who satified the seekers check list
$matched=array();
if(isset($seeker_name) && isset($seeker_gender)):
    foreach($lines as $line):
            $index=0;              
       list($matcher_name,$matcher_gender,$matcher_age,$matcher_personality, 
               $matcher_favoriteOS,$matcher_min_seek_age,$matcher_max_seek_age)
               =explode(",",$line);  
        if(trim($matcher_gender)!=trim($seeker_gender) 
                && trim($matcher_age)>=trim($seeker_min_seek_age) 
                && trim($matcher_age)<=trim($seeker_max_seek_age) 
                && trim($matcher_favoriteOS)===trim($seeker_favoriteOS)){
            
            while($index<strlen(trim($matcher_personality))){
                if(substr($matcher_personality,$index,1)===substr($seeker_personality,$index,1)){                    
                    $matched[]=array($matcher_name,"gender:"=>$matcher_gender,"age:"=>$matcher_age,
                                "type:"=>$matcher_personality,"OS:"=>$matcher_favoriteOS,
                               );                    
                     break;
                     
                }
                $index++;                
            }
            
                
            
        }
        ?>       
         <?php endforeach;?>
         
         <?php endif;?>
<p>Because there is no database connection, i am reading the matches from file</p>
<p>Matches for <?=$seeker_name?></p>
<div class="match"> 
<?php
if(count($matched)>0):
for($i=0;$i<count($matched);$i++):?>   
          
            
        <p class="match">
           
            <img class="match" src="images/user.jpg"/>
            <?= $matched[$i][0];?>
        </p>

        <ul>
            <?php array_shift($matched[$i])?>
            <?php foreach($matched[$i] as $key =>$value):?>
            
            <li><strong><?=$key?></strong><?=$value;?></li>       
           
            
        <?php endforeach;?>
           <li><a href></a></li>
         </ul>
        
        <?php endfor;?>
        <?php endif;?>
    </div>
  <?php include("bottom.html");?>       

           
            
             


                
            
        
    



