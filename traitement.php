<?php

// below should also work (useful maybe so i can start to get familliar with php loops?) :
// foreach ($_POST as $key => $value) {
//     echo '<p>'.test_input($key).' => '.test_input($value).'</p>';
  
// } 

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
        header("Location: http://localhost:8080/#contact");
        exit;
    }
    elseif(!preg_match("/^[a-zA-Z ]*$/" , $_POST["name"])){
        //preg_match — Perform a regular expression match
        $nameErr = "Only letters and white space allowed";
        echo "<p>Only letters and white space allowed<p>";
        // die();
        header("Location: http://localhost:8080/#contact");
        exit;
    }
    else{
        $name = test_input($_POST["name"]);
        $_POST["name"] = test_input($_POST["name"]);
    }


    if(empty($_POST["email"])){
        $nameErr = "Ce champ est requis";
        header("Location: http://localhost:8080/#contact");
        exit;
    }
    elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        // filter_var — Filters a variable with a specified filter
        // If omitted, FILTER_DEFAULT will be used. check doc php Types of filters for list 
        $emailErr = "Invalid email format"; 
        echo "<p>Invalid email format<p>";
        header("Location: http://localhost:8080/#contact");
        exit;
        
    }
    else{
        $email = test_input($_POST["email"]);
        $_POST["email"] = test_input($_POST["email"]);
    }

    if(empty($_POST["title"])){
        $nameErr = "Ce champ est requis";
        header("Location: http://localhost:8080/#contact");
        exit;
    }
    else{
        $title = test_input($_POST["title"]);
        $_POST["title"] = test_input($_POST["title"]);
    }

    if(empty($_POST["comment"])){
        $nameErr = "Ce champ est requis";
        header("Location: http://localhost:8080/#contact");
        exit;
    }
    else{
        $comment = test_input($_POST["comment"]);
        $_POST["comment"] = test_input($_POST["comment"]);
    }
    
    
}

// echo "Voici le resultat après verification : -".$name.", -".$email.", -".$title.", -".$comment." ";

$to = 'sacha.h@codeur.online';
$subject = 'Bien reçu vos info php';
$message = 'Bonjour !Voici les informations envoyées dans
 le formulaire contient : '.$name.", -".$email.", -".$title.", -".$comment." ";

$message1 = "
 <html>
 <head>
 <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
 <title>Bien reçu vos info php</title>
 </head>
 <body>
     <div>
     <p>Bonjour,</p>
     <p>Voici les informations reçu du formulaire : </p>
     <p>Nom : ".$name."</p><p>Email : ".$email."</p><p>Title : ".$title."</p><p>Votre message : ".$comment."</p>
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

//sends MAIL and assigns true, if not sent assigns false
$sentMail = mail($to, $subject, $message1, $headers);
// $sentMail = TRUE;
// mail($to, $subject, $message);

if(!$sentMail){
    // error_get_last — Get the last occurred error
    $errorMessage = error_get_last()['message'];
    echo "<p>Mail hasn't been sent, sorry<p>";
    print_r($errorMessage);
    header("Location: http://localhost:8080/#contact");
    exit;
    
}
// else{
//     echo "<p>Mail has been sent to : ".$to."<p>";
// }

// needs to install sudo apt-get install sendmail before mail() works?


//allows me to visualy see in a browser what a form has sent me with POST method of html form
// source : https://stackoverflow.com/questions/7093363/how-to-print-r-post-array/7093446
// echo "<pre>";
// // print_r($_POST);
// //you can see current file name with below
// print_r(test_input($_SERVER));
// echo "</pre>";


//more secure to loop through them and use testing function on each item
// foreach ($_SERVER as $key => $value) {
//     echo '<p>'.test_input($key).' => '.test_input($value).'</p>';
  
// } 


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
// print_r(error_get_last());

// header("Location: http://localhost:8080/"); /* Redirection du navigateur */

// /* Assurez-vous que la suite du code ne soit pas exécutée une fois la redirection effectuée. */
// exit;
// phpinfo();

?>

<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description"
    content="Discover the world's top designer and creative website. Welcome and enjoy Piroll Design">
  <meta name="robots" content="all">
  <meta name="keywords" content="design, home page, welcome">
  

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" type="image/png" href="media/logo-header.png" />
  <title>Piroll Design</title>
</head>
<!-- qsfqsds -->

<body>
  <header class=" bg-image-header">
    <!--********************section sacha********************-->
    <div class="container-fluid pt-3">
      <div class="container">
        <!--********************section menu********************-->

        <div class="row d-flex">

          <!-- <div class="col-lg-4">
            <p><img src="media/logo-header.png" alt="logo de Piroll Design" class="img-fluid" width="25" height="31">
            </p>
          </div>
          <div class="col-lg-8">
            <nav>
              <ul class="d-flex flex-wrap list-unstyled justify-content-between font-weight-bold">
                <li class="text-baby-blue">HOME</li>
                <li>ABOUT</li>
                <li>WORK</li>
                <li>PROCESS</li>
                <li>SERVICES</li>
                <li>TESTIMONIALS</li>
                <li>CONTACT</li>
              </ul>
            </nav>
          </div> -->

          <nav class="navbar navbar-expand-lg navbar-light w-100 align-items-center">
            <p><img src="media/logo-header.png" alt="logo de Piroll Design" class="img-fluid" width="25" height="31">
            </p>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link nav-active-color" href="http://sachah.promo-vesoul33.codeur.online/php-pirolldesign">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="http://sachah.promo-vesoul33.codeur.online/php-pirolldesign/#about-us">ABOUT</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="http://sachah.promo-vesoul33.codeur.online/php-pirolldesign/#work">WORK</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="http://sachah.promo-vesoul33.codeur.online/php-pirolldesign/#process">PROCESS</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="http://sachah.promo-vesoul33.codeur.online/php-pirolldesign/#services">SERVICES</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="http://sachah.promo-vesoul33.codeur.online/php-pirolldesign/#testimonials">TESTIMONIALS</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="http://sachah.promo-vesoul33.codeur.online/php-pirolldesign/#contact">CONTACT</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>


      </div>
    </div>

    
    <p class="text-center"><?php print_r(error_get_last()); ?></p>
  </header>
  <main>
      <div class="container-fluid">
          <div class="container">
              <div class="row">
                  <div class="col-12 align-items-center justify-content-center">
                    <p class="text-center">
                      <img src="media/mail-confirmation.png" alt="mail icon" width="1920" height="1738"
                       style="width : 20%;" class="img-fluid pt-5">
                    </p>
                      <h1 class="text-center">Merci pour votre message <?php echo $name; ?>!</h1>
                      <p class="p-3">Voici les informations que vous nous avez transmise :</p>

                  </div>
              </div>

              <div class="row">
                  <div class="col-6 align-items-center justify-content-center">
                      <p class="text-center">Email : <span class="font-weight-bold"><?php echo $email; ?></span></p>
                      
                  </div>

                  <div class="col-6 align-items-center justify-content-center">
                      <p class="text-center">Title : <span class="font-weight-bold"><?php echo $title; ?></span></p>
                      
                  </div>
              </div>

              <div class="row p-3">
                  <div class="col-12 align-items-center justify-content-center">
                      <p>Votre Message :</p>
                      <p><span class="font-weight-bold"><?php echo $comment; ?></span></p>

                  </div>
              </div>
          </div>
      </div>
  </main>

  <footer>
  <div class="container-fluid bg-dark text-white pt-5 pb-5">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-3 pb-md-5 d-flex flex-column text-sm-left">
          <p class="p-2 font-weight-bold">Piroll Design, Inc.</p>
          <p class="font-size-3">© 2019 Reproduction Sacha HENRY, Quentin PETREQUIN. Groupe 8.</p>
        </div>
        <div
          class="col-sm-6 col-md-6 col-lg-2 offset-lg-1 font-size-3 pb-5 d-flex flex-column pt-xs-3 pt-sm-3 pt-md-3 pt-lg-3 text-sm-center text-md-center text-lg-left text-xl-left">
          <p>hello@pirolltheme.com</p>
          <p>+44 987 065 908</p>
        </div>
        <div
          class="col-4 col-sm-4 col-md-4 col-lg-1 offset-lg-3 font-size-3 pt-md-3 pt-lg-3 pb-5 text-center text-sm-center text-md-center text-lg-left text-xl-left">
          <ul class="list-unstyled">
            <li>Project</li>
            <li>About</li>
            <li>Services</li>
            <li>Carreer</li>
          </ul>
        </div>
        <div
          class="col-4 col-sm-4 col-md-4 col-lg-1 font-size-3 pt-md-3 pt-lg-3 pb-5 text-center text-sm-center text-md-center text-lg-left text-xl-left">
          <ul class="list-unstyled">
            <li>News</li>
            <li>Event</li>
            <li>Contact</li>
            <li>Legals</li>
          </ul>
        </div>
        <div
          class="col-4 col-sm-4 col-md-4 col-lg-1 font-size-3 pt-md-3 pt-lg-3 text-center text-sm-center text-md-center text-lg-left text-xl-left">
          <ul class="list-unstyled">
            <li>Facebook</li>
            <li>Twitter</li>
            <li>Instagram</li>
            <li>Dribbble</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  </footer>



  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

  <script src="js/formerrorcheck.js"></script>
  <script src="js/load-more.js"></script>
</body>

</html>