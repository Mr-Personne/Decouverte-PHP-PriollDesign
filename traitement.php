<?php

//allows me to visualy see in a browser what a form has sent me with POST method of html form
// source : https://stackoverflow.com/questions/7093363/how-to-print-r-post-array/7093446
echo "<pre>";
print_r($_POST);
echo "</pre>";
//below should also work (useful maybe so i can start to get familliar with php loops?) :
foreach ($_POST as $key => $value) {
    echo '<p>'.$key.'</p>';
    foreach($value as $k => $v)
    {
    echo '<p>'.$k.'</p>';
    echo '<p>'.$v.'</p>';
    echo '<hr />';
    }
  
  } 
/////////////////////////////////////////////////////////////////////////////////////////

echo $_POST["name"];

?>