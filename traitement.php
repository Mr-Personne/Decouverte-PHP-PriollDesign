<?php

$name = $email = $title = $comment = "";
// $name = $_POST["name"];

function test_input($data){
    //trim — Supprime les espaces (ou d'autres caractères) en début et fin de chaîne 
    //may need to use option 'character_mask' to be more precise?
    //triming spaces and new lines from a textarea could be a problem?
    $data = trim($data);
    $data = stripSlashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $title = test_input($_POST["title"]);
    $comment = test_input($_POST["comment"]);
    
}



// echo "testing ".$name;
// echo $_POST["name"];
if($name == "nemo"){
    //dot is used to concatenate
    echo "hello ".$name."!";
}
else{
    echo "who are you?";
}




//allows me to visualy see in a browser what a form has sent me with POST method of html form
// source : https://stackoverflow.com/questions/7093363/how-to-print-r-post-array/7093446
// echo "<pre>";
// // print_r($_POST);

// //you can see current file name with below
// print_r($_SERVER);
// echo "</pre>";
//below should also work (useful maybe so i can start to get familliar with php loops?) :
// foreach ($_POST as $key => $value) {
//     echo '<p>'.$key.'</p>';
//     foreach($value as $k => $v)
//     {
//     echo '<p>'.$k.'</p>';
//     echo '<p>'.$v.'</p>';
//     echo '<hr />';
//     }
  
//   } 

//var_dump is also useful to see stuff
// var_dump($_POST);
// source : https://www.php.net/manual/fr/function.var-dump.php
//the code above is at risque of running malicious code sent in form elem
//to avoid such things you can use htmlspecialchars() function:
// $name = htmlspecialchars($_POST["name"]);
// $message = htmlspecialchars($_POST["comment"]);
// htmlspecialchars($_POST["comment"]);
/////////////////////////////////////////////////////////////////////////////////////////

?>