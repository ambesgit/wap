(function(){
    "use strict";
    /*json["books"]*/
    $(function(){ 
        
           //data handlers
            function getData(data){ 
                var i;
                var json=JSON.parse(data); 
                $("body").append($("<pre><strong>"+"Books in category  "+json.books[0].category+":"+"<strong></pre>").css({
                    "color":"brown",
                    "fornt-weight":"bold",
                    "text-decoration":"underline"
                }));
                    for(i=0;i<json.books.length;i+=1){                  
                        $("body").append("<li>"+"<pre>"+json.books[i].title+", by "+json.books[i].author+
                                "("+json.books[i].year+")"+"</pre>"+"</li>");
                    }       
            }
              //error handlers
         function getError(error,status,exception){
                 console.log(error+ " "+ status + " "+exception);
        
          }
        $(":radio").click(function(){        
            $.get("books_json.php?",{"category":$(this).val()}).done(getData).fail(getError);

        });   
        });     
  
}());


