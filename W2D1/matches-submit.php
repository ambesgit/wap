<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include("top.html");
$seeker_name=isset($_POST['seeker'])?$_POST['seeker']:" ";
if($seeker_name!=" "){
    $lines=file("singles.txt",FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
    foreach($lines as $line){
        if($seeker_name===substr($line,0,strlen($seeker_name))){
            list($seeker_name,$seeker_gender,$seeker_age,$seeker_personality, $seeker_favoriteOS,$seeker_min_seek_age,$seeker_max_seek_age)=explode(",",$line);
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

           
            
             


                
            
        
    



