
<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=hakerspoulette;charset=utf8', 'nathaliegoffette', 'becode');

$errorMsg = array(
    'errorName' => 'Your name can only contain letters',
    'errorName2' => 'Your name must contain between 2 and 255 characters',
    'errorFirstname' => 'Your First name can only contain letters',
    'errorFisrtname2' => 'Your First name must contain between 2 and 255 characters',
    'errorEmail' => 'The e-mail address is incorrect',
    'errorComment' => 'Your comment must contain between 250 and 1000 characters'
);

$arraySave = array();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="output.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend&family=Quantico:ital,wght@1,700&display=swap" rel="stylesheet"> 
    <title>Contact Form</title>

</head>

<body class="flex flex-col bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 ... text-white font-Lexend ml-7 ">

    <header class="flex flex-col justify-around pt-5 font-Quantico pb-3">
        <form action="index.php">
        <button class="text-7xl mb-6">Hacker's Poulette</button>

        </form>

    </div>
    </div>



    <form method="POST" action="" class="leading-8 ml-0 pb-4">
        <p>
            <label class="w-48 " for="firstname">* Firstname </label>
            <input class="bg-white rounded-lg ml-4 mb-3 pl-3 max-w-full text-gray-700 drop-shadow-xl  valid:border-green-500" type="text" name="firstname" placeholder="Firstname"  value="<?php echo isset($_POST["firstname"]) ? $_POST["firstname"] : ''; ?>" id='firstname' required><br>
            <?php
            if (isset($_POST['firstname'])) {
                if (empty($_POST['firstname'])) {
                    echo '<p>Firstname is required</p>';
                } else {
                    $firstname = $_POST['firstname'];
                    $firstname = filter_var($firstname, FILTER_SANITIZE_SPECIAL_CHARS);
                    if (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ]+$/', $firstname)) {
                        echo '<p>' . $errorMsg['errorFirstname'] . '</p>';
                    }
                    if (strlen($firstname) < 2 || strlen($firstname) > 250) {
                        echo '<p>' . $errorMsg['errorFirstname2'] . '</p>';
                    } else {
                        $arraySave['firstname'] = $firstname;
                    }
                }
            }
            ?>
            
        </p>

        <p>
            <label for="name">* Name </label>
            <input class="bg-white rounded-lg ml-12 mb-3 pl-3 max-w-full text-gray-700 drop-shadow-xl valid:border-green-500" type="text" name="name" placeholder="Name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ''; ?>" id="name" required><br>
            <?php
            if (isset($_POST['name'])) {
                if (empty($_POST['name'])) {
                    echo '<p>Name is required</p>';
                } else {
                    $name = $_POST['name'];
                    $name = filter_var($name, FILTER_SANITIZE_SPECIAL_CHARS);
                    if (!preg_match('/^[a-zA-ZÀ-ÖØ-öø-ÿ]+$/', $name)) {
                        echo '<p>' . $errorMsg['errorName'] . '</p>';
                    }
                    if (strlen($name) < 2 || strlen($name) > 250) {
                        echo '<p>' . $errorMsg['errorName2'] . '</p>';
                    } else {
                        $arraySave['name'] = $name;
                    }
                }
            }
            ?>
        </p>

        <p>
            <label for="email">* E-mail </label>
            <input class="bg-white rounded-lg ml-11 mb-3 pl-3 max-w-full text-gray-700 drop-shadow-xl valid:border-green-500" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" type="text" name="email" placeholder="E-mail" id="email" required><br>
            <?php
            if (isset($_POST['email'])) {
                if (empty($_POST['email'])) {
                    echo '<p>Email adress is required </p>';
                } else {
                    $email = $_POST['email'];
                    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo '<p>' . $errorMsg['errorEmail'] . '</p>';
                    } else {
                        $arraySave['email'] = $email;
                    }
                }
            }
            ?>

        </p>

        <p>
            <label for="comment">* Comment </label>
            <br>
            <input class="bg-white rounded-lg mt-3 ml-10 mb-3 pl-3 max-w-full w-80 text-gray-700 drop-shadow-xl valid:border-green-500" type="text" name="comment" placeholder="Leave a comment" value="<?php echo isset($_POST["comment"]) ? $_POST["comment"] : ''; ?>" id="comment" required><br>
            
            <?php
            if (isset($_POST['comment'])) {
                if (empty($_POST['comment'])) {
                    echo '<p>Message is required </p>';
                } else {
                    $comment = $_POST['comment'];
                    $comment = filter_var($comment, FILTER_SANITIZE_SPECIAL_CHARS);
                    if (strlen($comment) < 250 || strlen($comment) > 1000) {
                        echo '<p>' . $errorMsg['errorComment'] . '</p>';
                    } else {
                        $arraySave['comment'] = $comment;
                    }
                }
            }
            ?>

        </p>
    <!--   <div class="g-recaptcha" data-sitekey="your-site-key"></div> -->
        <input class="ml-3 mt-5 rounded-lg bg-gray-900 hover:bg-purple-900 active:bg-blue-900 pl-4 pr-4" type="submit" name="submit" value="Submit">
       

    </form>
  <!--  <script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
    <i class="ml-0 m-5">* the fields are required</i>
    <br>
    <?php

            //$response = $_POST["g-recaptcha-response"];
            //$url = 'https://www.google.com/recaptcha/api/siteverify';
            //$data = array(
            //    'secret' => 'your-secret-key',
            //    'response' => $response
            //);
            //$options = array(
            //    'http' => array (
            //        'method' => 'POST',
            //        'content' => http_build_query($data)
            //    )
            //);
            //$context  = stream_context_create($options);
            //$verify = file_get_contents($url, false, $context);
            //$captcha_success=json_decode($verify);

            //if ($captcha_success->success==false) {
            //// show an error message
            //} else if ($captcha_success->success==true) {
            //// process the form
            //}

        


if(isset($firstname)&& isset($name) && isset($email) && isset($comment)) {
    $query = "INSERT INTO contactForm (firstname, name, email, comment) VALUES (:firstname, :name, :email, :comment)";
    $stmt = $bdd->prepare($query);
    $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $stmt->execute();
 
        
	//echo "Votre commentaire a bien été transmis";
    header('Location: thankyou.php');
    exit;

} else {
    //echo '<p>error</p>';

}

    ?>

<footer>
    <p>Proudly coded by <a href="https://github.com/nathaliegoffette">Nath</a> for <a href="https://becode.org/">Becode</a></p>
</footer>
  
</body>


</html>

