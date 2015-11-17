(function(){
"use strict";
//timer id
var timer;
$(function(){
    prepopulate();
});

//this function is add a boy class to each of the 
//selected elements(#people .person)
function prepopulate(){
    $("#people .person").addClass("boy");
}
//gets the checked value from boy/girl radio button
function getGender(gender){
    if(gender){
        return gender;
    }
   return $("input:checked").val(); 
}

//this will create 5 div elements and based on the selected radio button
//those divs will be a member of the class person and boy/girl
function populate(){
    var i;
    var gender=getGender();
    for(i=0;i<5;i+=1){
        $("#people").append($("<div>").addClass("person "+gender));
    }
    
}
//this code sets onclick event handler to the add button, and the handle is 
//the above function, populate
$(function(){    
    $("#add").click(populate);
});

//kill a random boy/girl based on the selected gender
//once killed, the boy/girl will be marked as splat and the gender class will removed from it
//so that it will not get another killing (so kind exempted)
function kill(gender){
    var i;
    var peeps=$("#people ."+getGender(gender));
    for(i=0;i<peeps.length/5;i+=1){
        var randomIndex=Math.floor(Math.random()*peeps.length);
        $(peeps[randomIndex]).removeClass(getGender());
        $(peeps[randomIndex]).addClass('splat');
    }
}
//set the onclick event to the kill button and pass the kill function
$(function(){
    $("#kill").click(function(){kill(getGender());});
});

//will remove the deads from the scene (clean up)
function clearDead(){    
    $("#people .splat").remove();
}

//attach click event to the cleanup button and pass the cleanup function 
//to remove the killed onces from the page
$(function(){
    $("#cleanup").click(clearDead);
});
//this moves the raptor up and down and kills 1/5 of both genders
function stomp(){
    $("#raptor").css('top',function(idx,old){
        return ((parseInt(old)+75)%150)+'px';
    });
    kill("boy");
    kill("girl");
}
//setup clickevent on the stomp button and pass the stomp function to handle the event
$(function(){
    $("#stomp").click(stomp);
});
//enlarge the rapter size and resizeback to normal base on the current state of the raptor
function enragedRaptor(){
    if($("#raptor").hasClass("enrage")){
        $("h1").first().removeClass("enrage");
        $("#raptor").removeClass("enrage").width(function(idx,old){
            return old-50;
        });
    }
    else{
        $("h1").first().addClass('enrage');
        $("#raptor").addClass('enrage').width(function(idx,old){
            return old +50;
        });
    }
}

//attached click event to the enrage button so the header and the raptor will change accordingly
$(function(){
    $("#enrage").click(enragedRaptor);
});

function patrolRight(){
    $("#raptor").css('left',function(idx,old){
        if(parseInt(old)>=300){
            clearInterval(timer);
            timer=setInterval(patrolLeft,20);
        }
      return parseInt(old)+4+ 'px';
    });
}
function patrolLeft(){
    $("#raptor").css('left',function(idx,old){
        if(parseInt(old)<=10){
            clearInterval(timer);
            $(this).css({'top':"5px",'left':'10px'});
        }
        return parseInt(old) - 4 + "px";
    });
}
function patrol(){
    clearInterval(timer);
    timer=setInterval(patrolRight,20);
}
$(function(){
    $("#patrol").click(patrol);
});
})();