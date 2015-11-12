<!DOCTYPE html>

<html>
    <head>
        <title>Rancid Tomatoes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styleSheets/movie.css" rel="stylesheet" type="text/stylesheet"/>
        <link href="resources/rotten.gif" rel="icon"/>
        
    </head>
    <body>
       
        <div id="banner">  
           
            <p><img src="resources/banner.png" alt="banner image"/></P>
            
        </div>
        <header>
            <h2>
                <?php $movie=(isset($_GET['film']))?$_GET['film']:'tmnt';
                list($name,$year,$ratting,)=explode("\n",  file_get_contents($movie . '/info.txt'));
                echo $name . '  ' . ($year);
                ?>
            </h2>
        </header>
        
        <!-- this div contains all other divs in the body -->
        
        <div id="container"> 
            
            <!--This div is for the overview image on the right float-->
            
            <div id="art_rottenbig">
               
		<?php    
               
                if($ratting>=60){?>
                <img src="resources/freshbig.png" alt="freshbig image"/><?=$ratting . '%' ?>              
                <?php } else if ($movie<60){?>
                     <img src="resources/rottenbig.png" alt="rottenbig image"/><?= $ratting . '%' ?>
                    
                <?php } else{?>
                     <img src="resources/rottenbig.png" alt="rottenbig image"/><?= 0 . '%' ?>
                <?php }?>
            
            </div>
            
            <!--This div is for the overviews on the right under the overview image-->
            
            <div id="art_overview">                 
		<?php 
                echo '<img src=' . $movie . '/overview.png alt="overview image"/>'; 
                $overviews=explode("\n", file_get_contents($movie . '/overview.txt'));
                echo "<dl>";
                        foreach($overviews as $view){ 
                            try{
                             if(isset($view)){  
                            list($dt,$dd)=explode(":" | " ", trim($view));
                             }
                            
                            }
                            catch(Exception $et){
                                
                            }
                            
                            ?>	
                                 
                    
                     
                     <dt><?=isset($dt)?$dt:" "?></dt>
                     <dd>
                         <?=isset($dd)?$dd:' '?>
                     </dd>
                     
                     <?php }?>
                     <?php echo "</dl>"?>
                 
            </div>
            
            <!--  this div is for comments of users and holds many divs left and right float -->
            
            <div class="review">
                
		<?php  
                $odd_even=0;                               
                $div_enclose="leftside";  
                $ratting_icon="resources/fresh.gif";
                $overview_texts=glob($movie . '/review*.txt');
                if(isset($overview_texts)){               
                    foreach($overview_texts as $file){
                        $odd_even++;
                            list($rvw,$ricon,$revname, $publication)=file($file,FILE_IGNORE_NEW_LINES);                            
                            if(isset($ricon)&&isset($rvw)&&isset($revname)&&isset($publication)){
                                if("fresh"===strtolower($ricon)){
                                     $ratting_icon="resources/fresh.gif";
                                }
                                else{
                                    $ratting_icon="resources/rotten.gif";
                                }
                            
                            if($odd_even<=count($overview_texts)/2){                               
                                 $div_enclose="rightside";
                            }
                            else{
                                $div_enclose="leftside";
                            }
                                    
                        ?> 
                         <div class=<?=$div_enclose?> >
                            <div class="comment">                                
                                <img src=<?=$ratting_icon?> alt="rattingicon">                                
                                <blockquote> <?=$rvw;?></blockquote>
                            </div> 
                             <div class="critic" >
                                 <img src="resources/critic.gif" alt="critic image">
                                 <blockquote> <?=$revname . $publication?></blockquote>
                                 
                            </div>
                        </div>
                        
                            <?php }}}?>
            </div>  
            <!--  for comments of users ends here -->
            
            <footer>
                <span><?="(1-" . $odd_even . ') of' . $odd_even?></span>
            </footer>
            </div>
        
            <p class="validator" > 
            <a id="html" href="http://validator.w3.org/check/referer">
            <img src="http://mumstudents.org/cs472/2013-09/images/w3c-html.png"
             accesskey="" alt="Validate" />
            </a>            
            <a id="css" href="http://jigsaw.w3.org/css-validator/check/referer">
             <img src="http://jigsaw.w3.org/css-validator/images/vcss"
            alt="Valid CSS!" /></a> 
            
             </p>
</body>
</html>













