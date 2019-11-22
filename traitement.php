<?php
$_POST["name"] = test_input($_POST["name"]);
var_dump($_POST);
// below should also work (useful maybe so i can start to get familliar with php loops?) :
foreach ($_POST as $key => $value) {
    echo '<p>'.test_input($key).' => '.test_input($value).'</p>';
  
  } 

$nameErr = $emailErr = $titleErr = $commentErr = "";
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
    if(empty($_POST["name"])){
        $nameErr = "Ce champ est requis";
    }
    elseif(!preg_match("/^[a-zA-Z ]*$/" , $_POST["name"])){
        //preg_match — Perform a regular expression match
        $nameErr = "Only letters and white space allowed";
        echo "<p>Only letters and white space allowed<p>";
        // die();
    }
    else{
        $name = test_input($_POST["name"]);
        $_POST["name"] = test_input($_POST["name"]);
    }


    if(empty($_POST["email"])){
        $nameErr = "Ce champ est requis";
    }
    elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        // filter_var — Filters a variable with a specified filter
        // If omitted, FILTER_DEFAULT will be used. check doc php Types of filters for list 
        $emailErr = "Invalid email format"; 
        echo "<p>Invalid email format<p>";
        
    }
    else{
        $email = test_input($_POST["email"]);
        $_POST["email"] = test_input($_POST["email"]);
    }

    if(empty($_POST["title"])){
        $nameErr = "Ce champ est requis";
    }
    else{
        $title = test_input($_POST["title"]);
        $_POST["title"] = test_input($_POST["title"]);
    }

    if(empty($_POST["comment"])){
        $nameErr = "Ce champ est requis";
    }
    else{
        $comment = test_input($_POST["comment"]);
        $_POST["comment"] = test_input($_POST["comment"]);
    }
    
    
}

echo "Voici le resultat après verification : -".$name.", -".$email.", -".$title.", -".$comment." ";

$to = 'sacha.h@codeur.online';
$subject = 'Bien reçu vos info php';
$message = 'Bonjour !Voici les informations envoyées dans
 le formulaire contient : '.$name.", -".$email.", -".$title.", -".$comment." ";

$message1 = "
 <html>
 <head>
 <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
 <title></title>
 </head>
 <body>
     <div id='email-wrap' style='background: #151515;color: #FFF;'>
     <p>Bonjour,</p><br>
     <p>Voici les informations reçu du formulaire : </p><br>
     <p>".$name."</p><p>".$email."</p><p>".$title."</p><p>".$comment."</p>
     <p>Thank you,</p>
     <p>Administration</p>
     </div>
 </body>
 </html>
     ";

//parameter 'header' of mail is what alllows us to style email with html "Content-Type: text/html; charset=ISO-8859-1"
$headers = "From: " . $email . "\r\n";
// $headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
// $headers .= "CC: susan@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

//sends mail and assigns true, if not sent assigns false
$sentMail = mail($to, $subject, $message1, $headers);
// mail($to, $subject, $message);

if(!$sentMail){
    // error_get_last — Get the last occurred error
    $errorMessage = error_get_last()['message'];
    echo "<p>Mail hasn't been sent, sorry<p>";
    print_r($errorMessage);
}
else{
    echo "<p>Mail has been sent to : ".$to."<p>";
}

// needs to install sudo apt-get install sendmail before mail() works?


//allows me to visualy see in a browser what a form has sent me with POST method of html form
// source : https://stackoverflow.com/questions/7093363/how-to-print-r-post-array/7093446
// echo "<pre>";
// // print_r($_POST);
// //you can see current file name with below
// print_r(test_input($_SERVER));
// echo "</pre>";


//more secure to loop through them and use testing function on each item
foreach ($_SERVER as $key => $value) {
    echo '<p>'.test_input($key).' => '.test_input($value).'</p>';
  
  } 


//var_dump is also useful to see stuff
// var_dump($_POST);
// source : https://www.php.net/manual/fr/function.var-dump.php
//the code above is at risque of running malicious code sent in form elem
//to avoid such things you can use htmlspecialchars() function:
// $name = htmlspecialchars($_POST["name"]);
// $message = htmlspecialchars($_POST["comment"]);
// htmlspecialchars($_POST["comment"]);
/////////////////////////////////////////////////////////////////////////////////////////

// error_get_last — Get the last occurred error
print_r(error_get_last());

// header("Location: http://localhost:8080/"); /* Redirection du navigateur */

// /* Assurez-vous que la suite du code ne soit pas exécutée une fois la redirection effectuée. */
// exit;
phpinfo();

?>