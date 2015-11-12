
<!DOCTYPE html>
<html>
	<!--
	Web Programming Step by Step
	Lab #3, PHP
	-->

	<head>
		<title>Music Viewer</title>
		<meta charset="utf-8" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<h1>My Music Page</h1>
		
		<!-- Exercise 1: Number of Songs (Variables) -->
                <p>
                    I love music.I have 
		<?php
			
			$music=8976345; 
                        
                        $total_hours=$music/10;
                        echo $music . " " + "total songs," . " " . "which is over" . " " . $total_hours . " " . "hours of music!";
                    
			 
		?>
                   
                </p>
		<!-- Exercise 2: Top Music News (Loops) -->
		<!-- Exercise 3: Query Variable -->
		<div class="section">
			<h2>Yahoo! Top Music News</h2>
		
			<ol>
				<?php 
                                $newspages=5;
                                try{
                                if(isset($_GET['newspages'])>0){
                                    $newspages=$_GET['newspages'];
                                }      
                                }
                                catch(Exception $e){
                                    echo " ";
                                }
                                for($x=0; $x<$newspages;$x++){
                                echo '<li><a href=' . '"' .'http://music.yahoo.com/news/archive/' . $x . '.html' . '"' . '>Page' . $x . '</a></li>';
                                }                                
                                        
                                ?>
			</ol>
		</div>

		<!-- Exercise 4: Favorite Artists (Arrays) -->
		<!-- Exercise 5: Favorite Artists from a File (Files) -->
		<div class="section">
			<h2>My Favorite Artists</h2><br/>
                            <h4>From File</h4>
			<ol>
                            
				<?php                                 
                                $from_file=file("favorite.txt",FILE_IGNORE_NEW_LINES);
                                foreach($from_file as $fartist){
                                    echo  '<li> <a href=' . '"' . 'http://music.yahoo.com/videos/' . $fartist . '/"' . '>' . $fartist . '</a></li>';
                                }
                                
                                ?>
                            
			</ol>
                            <h4>From Array</h4>
                            <ol>
                            
				<?php 
                                $favorite_artists=array("Britney Spears","Christina Aguilera","Justin Bieber","Lady Gaga");
                                
                                foreach($favorite_artists as $artist){
                                    echo  '<li> <a href=' . '"' . 'http://music.yahoo.com/videos/' . explode(" ",$artist)[0] . '"' . '>' . $artist . '</a></li>';
                                }
                                
                                ?>
                            
			</ol>
                        
		</div>
		
		<!-- Exercise 6: Music (Multiple Files) -->
		<!-- Exercise 7: MP3 Formatting -->
		<div class="section">
			<h2>My Music and Playlists</h2>
                        <ul id="musiclist">
                            
                        <?php 
                        
                      
                        $mp3songs=glob("songs/*.mp3");                                             
                        shuffle($mp3songs);
                        if(isset($mp3songs)){
                            foreach($mp3songs as $file_name){                                
                                $sort_by_size[]=filesize($file_name);
                                $reverse_name_order[]=  strtolower(basename($file_name));
                            }
                            //
                            rsort($sort_by_size); 
                            rsort($reverse_name_order);
                            
                            foreach($mp3songs as $play){  
                                $x=0;
                                /*
                                 In the reveresed sorted array , we have size of 
                                 * files sorted from larger to smaller
                                 * but we don't need this to display rahter 
                                 * we need the file themselves sorted in that order
                                 * to do so, i replace the size with the file name
                                 * and size using while loop to get the right 
                                 * location of the current file in the $sort_by_size
                                 * array i created
                                 */
                                while($x<count($sort_by_size)){
                                    if($sort_by_size[$x]===filesize($play)){
                                        $sort_by_size[$x]=basename($play) . '(' . 
                                        number_format(filesize($play)/1024) . 'KB)';
                                    }
                                    if($reverse_name_order[$x]===strtolower(basename($play))){
                                        $reverse_name_order[$x]=basename($play) . '(' . 
                                        number_format(filesize($play)/1024) . 'KB)';
                                    }
                                    $x++;
                                }
                                echo '<li class="mp3item"><a href=' . '"' .  
                                        $play . '"' . '>' . basename($play) . '(' . 
                                        number_format(filesize($play)/1024) . 'KB)' . '</a><br/>' . 
                                        '<audio controls>
                                        <source src=' . '"' . 'songs/' . basename($play) .  '"' . '  ' . 'type="audio/mpeg">

                                         </audio></li>';
                                
                               
                               
                                
                            }
                            
                            
                        }
                        
                        
                         $playlist=glob("songs/*.m3u");
                         if(isset($playlist)){
                             foreach($playlist as $m3u){
                             echo '<li class="playlistitem">' . basename($m3u) . ':<br/>';
                                $m3u_content=file($m3u);
                                    if(isset($m3u_content)){  
                                      echo '<ul>';
                                    foreach($m3u_content as $content){
                                        if(($pos=strpos($content,"#"))===false){
                                        echo '<li>' . $content . '</li>';
                                        }
                                    }
                                }
                                echo '</ul></li>';
                             }   
                         }
                         
                         //reverse order by alphabet 
                            
                          echo '<li  style="color: #000066;font-family: fantasy; font-size: 14pt; margin-bottom: 0
                               ">  Reverse Order By Name:<br/>';  
                           if(isset($reverse_name_order)){  
                                      echo '<ul>';
                                    foreach($reverse_name_order as $reverse){
                                        
                                        echo '<li>' . $reverse . '</li>';
                                        
                                    }
                                }
                                echo '</ul> </li>';
                                //reverse order by file size
                        echo '<li  style="color: #000066;font-family: fantasy; font-size: 14pt;margin-bottom: 0
                               ">Sorted by size from largest size to smallest size:<br/>'; 
                           if(isset($sort_by_size)){  
                                      echo '<ul>';
                                    foreach($sort_by_size as $reverse){
                                        
                                        echo '<li>' . $reverse . '</li>';
                                        
                                    }
                                }
                                echo '</ul> </li>';
                          
                        ?>
                            
                        </ul>
                        
                      
                     <!--    
			<ul id="musiclist">
				<li class="mp3item">
					<a href="http://mumstudents.org/cs472/Labs/3/songs/be-more.mp3">be-more.mp3</a>
				</li>
				
				<li class="mp3item">
					<a href="http://mumstudents.org/cs472/Labs/3/songs/just-because.mp3">just-because.mp3</a>
				</li>

				<li class="mp3item">
					<a href="http://mumstudents.org/cs472/Labs/3/songs/drift-away.mp3">drift-away.mp3</a>
				</li>
                                 -->
				<!-- Exercise 8: Playlists (Files) -->
                                <!--
				<li class="playlistitem">472-mix.m3u:
					<ul>
						<li>Hello.mp3</li>
						<li>Be More.mp3</li>
						<li>Drift Away.mp3</li>
						<li>190M Rap.mp3</li>
						<li>Panda Sneeze.mp3</li>
					</ul>
				</li>
			</ul>
                        -->
 
		</div>

		<div>
			<a href="http://validator.w3.org/check/referer">
				<img src="http://mumstudents.org/cs472/Labs/3/w3c-html.png" alt="Valid HTML5" />
			</a>
			<a href="http://jigsaw.w3.org/css-validator/check/referer">
				<img src="http://mumstudents.org/cs472/Labs/3/w3c-css.png" alt="Valid CSS" />
			</a>
		</div>
	</body>
</html>



