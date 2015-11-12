//this will hold all accounts created sofar
var accountInfoList=[];
window.onload=function(){
    "use strict";
    //1. for problem one
    document.getElementById("rudy").onclick=rudyTimer;
    
    
    /*2. when the page is loaded call the createAccount method using the module name
     this will setup the onclick event so this is only one time call
     after that the click to the button will call the createAccount
     i could have do this as the first one but, i want to see the different way of doing the same thing
    */
    bankAccount();
    
    
        
      
};

//1. problem one 
var rudyTimer=(function(){
    "use strict";
    var timer=null;
    var rudy=function(){
        try{
            document.getElementById("output").innerHTML +="Rudy!";
        }
        catch(ex){
            
        }
    };
    var delayMsg2=function(){
        if(timer === null){
            timer=setInterval(rudy,1000);
        }
        else{
            clearInterval(timer);
            timer=null;
        }
       
    };
    //returns the method that set and clear the time interval
return delayMsg2;})();


//2. this is my module for the bankAccount

var bankAccount=(function(){
    "use strict";
    /*global accountInfoList*/  
    
     var accountName="N",currentBalance=-1;//private variables
     
     //private setter for the account name
     var setName=function(){
         try{
             if(document.getElementById("name").value!==""){
            accountName=document.getElementById("name").value;
        }
        }
        catch(ex){}
       
        };
        
        //private setter for the balance
     var setBalance=function(){
         try{
              if(document.getElementById("balance").value!==""){
            currentBalance=parseFloat(document.getElementById("balance").value);
        }
        }
        catch(ex){}
        
        };
        
        //public to create account and diplay all created accounts to the textarea
    var createAccount=function(){       
        var loop=0;
           setName();//set name 
           setBalance(); //set balance
           //after setting the name and balance, account objct is creating and added to the accountInfoList
           if(accountInfoList.length!==0 || (accountName!=="N" && currentBalance!==-1)){
           accountInfoList.push({name:accountName,balance:currentBalance});
       }
       
       /* this variable is used to concatnation
        instead of accessing the dom element textarea in each loop,
        i conncatent the accounts name and balance to a single string 
        then write once to the DOM element(textarea);
        */
        var tempString="";
        for(loop=0; loop<accountInfoList.length; loop+=1){
               tempString +="Account name:  "+ accountInfoList[loop].name+" "+"Balance: "+ accountInfoList[loop].balance+"\n";
           }
          try{
              if(tempString!==""){
                  document.getElementById("tarea").value=tempString; 
              }
            //this is like recurssive but not, i assigned this method to the onclick event
           document.getElementById("create").onclick=createAccount; 
           
       }
       catch(ex){}
    };
  
  
  
 // the module will return the createAccount public method 
return createAccount;})();

