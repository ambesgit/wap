<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include("top.html");?>

<fieldset class="column">
    <legend>Returning User:</legend>
    <form action="matches-submit.php" method="post">
        <p><label><strong>Name</strong><input type="text" name="seeker" size="16" maxlength="16"/></label></p>
        <p><input type="submit" value="View My Matches"/></P>
        
    </form>
</fieldset>
<?php include("bottom.html");?>



