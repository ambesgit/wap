"use-strict";
window.onload=useBiggerButton;
      
/*the onclick event of the button with id "big" is overloaded so to see
the effect of the onclick for different actions, we have to commenting
out the other parts otherwise only the last function attached to onclick
of this button takes effect
*/
function useBiggerButton(){
    //for the popup alert 
    document.getElementById("big").onclick=function(){        
        alert("Hello world");
    };
    
    //for the size increase of the text area
    document.getElementById("big").onclick=function(){
       document.getElementById('tarea').style.fontSize="24pt";

    };   
    
     //for use of the Bling checkbox        
    document.getElementById("bling").onchange=function(){
       // alert("changed checkbox");
         var doc=document.getElementById('tarea');
        if(document.getElementById('bling').checked){
          doc.style.fontWeight="bold";
          doc.style.color="green";
          doc.style.textDecoration="underline";
          document.body.style.backgroundImage="url('http://www.cs.washington.edu/education/courses/190m/CurrentQtr/labs/6/hundred-dollar-bill.jpg')";
      }
      else{
           doc.style.fontWeight="normal";
      }
    };
    
    //for increase of the size of the textarea
     document.getElementById("big").onclick=function(){
            var oldFontValue=window.getComputedStyle(document.getElementById('tarea'),null).getPropertyValue("font-size");
            var oldFontValueParsed=parseInt(oldFontValue);
            document.getElementById('tarea').style.fontSize=(oldFontValueParsed+2)+"pt";
    
        };
    
    //timer  
    function useTimer(){
    var txt=document.getElementById("tarea");
    var fontSize=window.getComputedStyle(txt,null).getPropertyValue("font-size");
    txt.style.fontSize=(parseInt(fontSize)+2)+"pt";
    }
     document.getElementById('big').onclick=function(){
        setInterval(useTimer,500);
     };
     
     
     //this is for the pigLatin part
     
     document.getElementById('lgpay').onclick=function(){  
        var txt=document.getElementById("tarea");
         var val=txt.value;
         var x=0;
    while(x<val.length-1){
        if((val.charAt(x)).toLowerCase()==="a" ||
                (val.charAt(x)).toLowerCase()==="e" ||
                (val.charAt(x)).toLowerCase()==="u" ||
                (val.charAt(x)).toLowerCase()==="o" ||
                (val.charAt(x)).toLowerCase()==="i"){
            break;
        }
        x++;
    }
    if(x<val.length && x!==0){        
        txt.value=val.substring(x)+ val.substring(0,x)+"-ay";
    }
    else{
        txt.value=val+"-ay";
    }
    };
    
    //this is for the Malkovitch
    document.getElementById('mal').onclick=function(){
         if((document.getElementById('tarea').value).length>=5){
             document.getElementById('tarea').value="Malkovitch";
         }
     };
     
}
