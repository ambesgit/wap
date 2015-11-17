<?php 
$request=isset($_GET["category"])?$_GET["category"]:"";
$cooking='{
  "books":[
    {"category": "cooking", "year": 2009, "price": 22.00, 
     "title": "Breakfast for Dinner", "author": "Amanda Camp"},
    {"category": "cooking", "year": 2010, "price": 75.00, 
     "title": "21 Burgers for the 21st Century", "author": "Stuart Reges"},
    {"category": "cooking", "year": 2005, "price": 30.00, 
     "title": "Cat Food: It\'s for People, Too", "author": "Gloria Demartelaere"}
  ]
}';
$computers='{
  "books": [
    {"category": "computers", "year": 2009, "price": 999.99, 
     "title": "Web Programming Step-by-Step", "author": "Marty Stepp and Jessica Miller"},
    {"category": "computers", "year": 2007, "price": 90.00, 
     "title": "Building Java Programs", "author": "Stuart Reges and Marty Stepp"},
    {"category": "computers", "year": 2007, "price": 35.00, 
     "title": "Core Java, 8th edition", "author": "Cay Horstmann"}
  ]
}';


$finance='{
  "books": [
    {"category": "finance", "year": 2006, "price": 18.00, 
     "title": "Freakonomics", "author": "Steven Levitt"},
    {"category": "finance", "year": 2006, "price": 14.95, 
     "title": "Personal Finance for Dummies", "author": "Eric Tyson"}
  ]
}';
if($request==="cooking"){
    echo $cooking;
}
else if($request==="computer"){
     echo $computers;
}
 else if($request==="finance"){
      echo $finance;
 }
 else{
     echo '{"category":["computer","cooking","finance"]}';
 }
?>

