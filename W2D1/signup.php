<?php
    /* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include("top.html");?>

    
     <fieldset>
         <legend>New User Signup</legend>
            <form action="signup-submit.php" method="post">                
                <p><label class="left"><strong>Name:</strong></label><input type="text" name="person_name" maxlength="16"/></p>
                <p><label class="left"><strong>Gender:</strong></label><label><input type="radio" name="gender" value="M"/>Male</label>
                    <label><input  type="radio" name="gender" value="F"/>Female</label>
              </p>
              <p><label class="left"><strong>Age:</strong></label><input type="text" name="age" size="6" maxlength="2"/></p>
              <p><label class="left"><strong>Personality:</strong></label><input type="text" name="personality" size="6" maxlength="4"/>
                (<a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp">Don't know your type?</a>)
            </p>
            <p><label class="left"><strong>Favorite OS:</strong></label><select name="favoriteOS">
                <option>Windows</option>
                <option>Mac OS X</option>
                <option>Linux</option>              
                </select> 
             </p>
             <p><label class="left"><strong>Seeking age:</strong></label><input type="text" name="min_seek_age" placeholder="min" size="6" maxlength="2"/>
                 to<input type="text" name="max_seek_age"  placeholder="max" size="6" maxlength="2"/></p>
            <p><input type="submit" value="Sign Up"/></p>
            </form>
        </fieldset>
<?php include("bottom.html");?>

    

