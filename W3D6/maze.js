(function(){
    "use strict";
    $(function(){
        
        var numberOfWallHits=0;
    
        //this is for a single wall turn on red 
        
    $("div.boundary").mouseover(function(ev){
        if(!$(ev.target).hasClass("youlose")){
        $(ev.target).addClass("youlose");
    }    
    })/*.mouseleave(function(ev){
        if($(ev.target).hasClass("youlose")){
        $(ev.target).removeClass("youlose");
    } 
    })*/;
    
    //single wall ends here
    
    //all boundaries glow red on once
    $("div.boundary").mouseenter(function(){
        numberOfWallHits+=1;
        $("div.boundary").each(function(idx,el){
            if(!$(el).hasClass("youlose")){
                $(el).addClass("youlose");
            }
        });
    });/*.mouseleave(function(){
              $("div.boundary").each(function(idx,el){
                if($(el).hasClass("youlose")){
                $(el).removeClass("youlose");
            }
        });
        
       });*/
       
       //all boundaries at one glow ends here
       
    $("div#maze").mouseleave(function(){        
        numberOfWallHits +=1;
         $("div.boundary").each(function(idx,el){
            if(!$(el).hasClass("youlose")){
                $(el).addClass("youlose");
            }
        });
    });
    
    //start the game, it resets the variable that tracks if player is inside the box
    $("div#start").click(function(){
         $("h2").text("Game starts");       
         numberOfWallHits=0;       
        $("div.boundary").each(function(idx,el){
           if($(el).hasClass("youlose")){
               $(el).removeClass("youlose");
           }
        });
         
        if(!$("div#start").hasClass("started")){
            $("div#start").addClass("started");
        }
       
    });
    $("div#end").click(function(){
        if($("div#start").hasClass("started")){
            $("div#start").removeClass("started");
            if(numberOfWallHits===0){               
                $("h2").text("you win!:]");
            }
            else{                
                $("h2").text("Sorry, you lost.:[");
                numberOfWallHits=0;
                
            }
        }
       
    });
       
  //closing braket for the page loaded function      
    });
})();

