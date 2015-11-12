var myApp={};
myApp.counter=0;
myApp.x=0;
myApp.y=0;
myApp.animate=function(){
    var el=document.getElementsByTagName("body");
     window.setInterval(function(){        
        if(myApp.counter===0){
        el[0].style.backgroundImage='url("background2.jpg")'; 
        myApp.counter+=1;
    }
    else if(myApp.counter===1){
        el[0].style.backgroundImage='url("background2.jpg")'; 
        myApp.counter+=1;
    }
     else if(myApp.counter===2){
         el[0].style.backgroundImage='url("background2.jpg")'; 
        myApp.counter+=1;
     } 
     else{
        el[0].style.backgroundImage='url("background2.jpg")'; 
        myApp.counter=0;
     }
    },3000);
};
myApp.animate();

myApp.drawing=function(){
    var el=document.getElementById("drawing");
    var can=document.createElement("canvas");
        myApp.event(can);
    if(can!==undefined){
        can.setAttribute("width","500px");
        can.setAttribute("height","300px");
        can.style.backgroundColor="white";
        if(can.getContext){              
            var context=can.getContext("2d"); 
            myApp.penColor(context,"blue");
             context.beginPath();
             context.moveTo(myApp.x,myApp.y);
             context.lineTo(myApp.x,myApp.y);
            
            
        }
        el.appendChild(can);
        document.body.appendChild(el);
        
    }
};

myApp.penColor=function(can,color){
    can.strokeStyle=color;
    can.fillStyle=color;
    
};
myApp.pen=function(ev,con){ 
    var event=ev;
    if(event!==undefined){
        myApp.x=event.clientX;
        myApp.y=event.clientY;
    con.getContext("2d").lineTo(myApp.x,myApp.y);
    con.getContext("2d").stroke();
    //con.getContext("2d").fill();
    
    
}
};

myApp.event=function(can){
    can.addEventListener("click",function(e){myApp.pen(e,can);},false);
};

//myApp.drawing();




