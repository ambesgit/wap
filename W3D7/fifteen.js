(function(){
"use strict";
 
$(function() {  
    //this two coordinates are used to track the blank square and also used to calculate the neighbors to the blank square
    var blank_x="300px",blank_y="300px";
    $("#puzzlearea div").each(function(idx,el){
        var x=(idx%4)*100;
        var y=(Math.floor(idx/4)*100);
        $(el).addClass("puzzlepiece").css(
                {   "left":x+"px","top":y+"px",
                    "background-image":"url('background.jpg')",                    
                   
                }).attr({
                    "x":x,
                    "y":y
                });
              el.style.backgroundPosition = -x + 'px ' + (-y) + 'px';
    }); 
    //this function is used to check if the 
    //pecies are fit together to its winning position
     function checkPuzzle(){
        var check=true;
        $(".puzzlepiece").each(function(idx,el){
           if(idx>-1){//used only to by pass the error in JSLint test that says unused pararmeter idx
            var attr_x=$(el).attr("x");//this is the orginal position which never change during shuffle
            var attr_y=$(el).attr("y");//the same reason as x
            var left= parseInt($(el).css("left"),10); //this property is changible during the shuffling
            var top= parseInt($(el).css("top"),10);//this is also changible
            if(attr_x!==left &&attr_y!==top){//after playing the puzzle, the changible and the fix property has to be the same
                check=false;
                return false;
            }
        }});
        return check;
    }
    /*move the clicked square to the blank square
    during moving the left and top property of the piece changed 
    but the x and y attribute remain the same
    by doing this, at the end of the play, it is easy to check if every piece
    is on their supposed position, if not the player don't win
    */
    function movePuzzle(el){            
            var tempx=$(el).css("left");
            var tempy=$(el).css("top");            
           $(el).css({   
                    "left":blank_x,"top":blank_y,
                    "background-image":"url('background.jpg')"                 
                   
                });
                 el.style.backgroundPosition = -blank_x  + (-blank_y);
                 blank_x=tempx;
                 blank_y=tempy;
                if(blank_x==="300px" && blank_y==="300px" && checkPuzzle()){
                     alert("you won");
                 }
                
    }
   /*whenever you hover on every piece of the puzzle
    this function will be called and the piece will be checked if it 
    can be slideup to the blank square, if so the border and the text become red
    To qualify the puzzle piece should satisfy the condition given in the fi close
    (the piece should be either directly to the right or left or top or bottom of the 
    the blank squar)
    */
    function slideUp(el){
        var x1= parseInt($(el).css("left"),10);      
        var y1= parseInt($(el).css("top"),10);          
        if(((parseInt(blank_x,10)-x1===100 || parseInt(blank_x,10)-x1===-100)&&(parseInt(blank_y,10)-y1===0)) ||((parseInt(blank_y,10)-y1===100 || parseInt(blank_y,10)-y1===-100)&&(parseInt(blank_x,10)-x1===0))){
            if(!$(el).hasClass("movablepiece")){
                    $(el).addClass("movablepiece");                    
                }
             else{
                  $(el).removeClass("movablepiece");
             }  
         }
    }
    /*when the puzzle passes the slideup test, the player can click it
    when it is clicked, the piece will move to the blank square(actually here
    swapping is occuring)*/
    $(".puzzlepiece").click(function(){
            
            if($(this).hasClass("movablepiece")){                
                 movePuzzle(this);//this will be changed by slideUp function
                
        }
          
        });
        //when the a specific puzzlepiece is under the mouse, this event will fire 
   $(".puzzlepiece").mouseover(function(){
       slideUp(this);
       
    });
    //when the mouse leaves this puzzlepiece, cleanup will carry on by the slideup
    //function when the puzzlepiece was selected,if not this will do nothing
     $(".puzzlepiece").mouseleave(function(){
       slideUp(this);
    });
    
   //shuffle the squares included the blank square
   function shuffle(){
       var temp=[];//track the pieces which change positions so will not chnage again
    var pieces=$("#puzzlearea");
    var x=-1;//this will make sure no piece remains in its orgininal place
    var rnd=0;
    while(temp.length<15){
        rnd=Math.floor(Math.random()*15);
        //if the randomly generated number is already in the temp array , don't swap instead generate again a new number
        if(temp.indexOf(rnd)<0 && x!==rnd){
            movePuzzle(pieces.children()[rnd]);
            temp.push(rnd);
            x+=1;
         }
      
        }
       }
       //whenever you need a new game , you can shuffle them by click this button
       $("#shufflebutton").click(shuffle);  
     });

}());
