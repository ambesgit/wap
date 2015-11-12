window.onload=function(){
    
    "use strict";
    /*global ANIMATIONS*/
    
     var setintervalID_start=0;    
      var i=0;
       var temp=[];
      function changeFrame(){
                    if(i<temp.length){
                        document.getElementById("tarea").value=temp[i];
                        i=i+1;
                    }
                    else{
                        i=0;
                        document.getElementById("tarea").value=temp[i];
                    }
                 
                }
     //start event
       document.getElementById("start").onclick=function(){ 
                document.getElementById("start").disabled=true;
                document.getElementById("animation").disabled=true;
               
                temp=(document.getElementById("tarea").value||"").split("=====\n");
            //set the interval 
             setintervalID_start=setInterval(changeFrame,250);
    };
    
    //select event
   document.getElementById("animation").onchange=function(){
        document.getElementById("tarea").value=ANIMATIONS[document.getElementById("animation").value];
   };
   
   //stop event
   document.getElementById("stop").onclick=function(){
       document.getElementById("start").disabled=false;
       document.getElementById("animation").disabled=false;
       clearInterval(setintervalID_start);
       document.getElementById("tarea").value=ANIMATIONS[document.getElementById("animation").value];
   };
   
   //size change event
   document.getElementById("size").onchange=function(){
        document.getElementById("tarea").style.fontSize=document.getElementById("size").value;
   };
   
   //speed change event
   document.getElementById("spd").onchange=function(){
       if(document.getElementById("spd").checked && document.getElementById("start").disabled){
           clearInterval(setintervalID_start);
           setintervalID_start=setInterval(changeFrame,50);
       }
       else if(document.getElementById("start").disabled){
           clearInterval(setintervalID_start);
            setintervalID_start=setInterval(changeFrame,250);
       }
   };
};


