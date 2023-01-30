
<?php
session_start();
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
    <link href="https://fonts.googleapis.com/css2?family=Lexend&display=swap" rel="stylesheet">
    <title>Contact Form</title>

</head>

<body class="flex flex-col bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 ... text-white font-Lexend ml-7 ">

    <header class="flex flex-col justify-around pt-5 font-Lexend pb-3">
        <form action="index.php">
        <button class="text-2xl mb-6">Hacker's Poulette</button>

        </form>
<?php
//Beginning of the Form
?>
        </div>
    </div>



    <form method="POST" action="" class="leading-8 ml-8 pb-4">
        <p>
            <label class="w-48 " for="firstname">* Firstname </label>
            <input class="bg-white rounded-lg ml-4 mb-3 pl-3 max-w-full text-gray-700 valid:border-green-500" type="text" name="firstname" placeholder="Firstname"   id='firstname' required><br>
        </p>

        <p>
            <label for="name">* Name </label>
            <input class="bg-white rounded-lg ml-12 mb-3 pl-3 max-w-full text-gray-700 valid:border-green-500" type="text" name="name" placeholder="Name" id="name" required><br>
        </p>

        <p>
            <label for="email">* E-mail </label>
            <input class="bg-white rounded-lg ml-11 mb-3 pl-3 max-w-full text-gray-700 valid:border-green-500" type="text" name="email" placeholder="E-mail" id="email" required><br>
        </p>

        <p>
            <label for="comment">* Comment (250 characters minimum please)</label>
            <br>
            <input class="bg-white rounded-lg mt-3 ml-3 mb-3 pl-3 max-w-full w-80 text-gray-700 valid:border-green-500" type="text" name="comment" placeholder="Leave a comment"  id="comment" required><br>
        </p>
    <!--   <div class="g-recaptcha" data-sitekey="your-site-key"></div> -->
        <input class="ml-3 mt-5 rounded-lg bg-gray-900 hover:bg-purple-900 active:bg-blue-900 pl-4 pr-4" type="submit" name="submit" value="Submit">
       

    </form>
  <!--  <script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
    <i class="m-5">* the fields are required</i>
    <br>
    <?php



    // we initiate an array that will contain any potential errors.

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $errors = array();
        $firstname = $name = $email = $comment = "";


        if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {
            if (strlen($_POST['email']) < 2) {
                $errors['email'] = "Email is required.";
            } else {
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "This email address is invalid.";
                }
            }

            // Validate the first name
            if (strlen($_POST['firstname']) < 2) {
                $errors['firstname'] = "First name is required.";
            } else {
                $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $firstname = substr($firstname, 2, 255);

                if (!preg_match("/^[a-zA-Z ]*$/", $firstname)) {
                    $errors['firstname'] = "Only letters and white space allowed in the first name.";
                }
            }

            // Validate the name
            if (strlen($_POST['name']) < 2) {
                $errors['name'] = "Name is required.";
            } else {
                $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                $name = substr($name, 2, 255);

                if (ctype_alpha($_POST['name']) == false) {
                    $errors['name'] = "Only letters and white space allowed in the name.";
                }
            }

            // Validate the comment field
            if (strlen($_POST['comment']) < 250) {
                $errors['comment'] = "Comment needs to be 250 characters minimum.";
            } else {
                $comment = filter_var($_POST['comment'], FILTER_UNSAFE_RAW);

                if (!preg_match("/^[0-9a-zA-Z\s,.'-]*$/", $comment)) {
                    $errors['comment'] = "Only letters, numbers and white space allowed in the address field.";
                }
            }


            if (count($errors) === 0) {
                echo '<p class="text-xl italic mb-2 p-2">Merci pour votre message !</p>';
        
                
            } else {

                foreach ($errors as $error) {
                    echo $error . "<br>";
                }
                echo 'Warning, you need to check your entries';
            }

            

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

        }



//      header('Location: thankyou.php');


	
try {
    // Connect to the database
    $bdd = new PDO('mysql:host=localhost;dbname=hakerspoulette;charset=utf8', 'nathaliegoffette', 'becode');
} catch (Exception $e) {
    // If an error occurs, display the error message
    die('Error : ' . $e->getMessage());
}

// Retrieve the form data
try {
	
	$firstname = $_POST['firstname'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$comment = $_POST['comment'];
	

// Insert the data into the database
$query = "INSERT INTO contactForm (firstname, name, email, comment) VALUES (:firstname, :name, :email, :comment)";
$stmt = $bdd->prepare($query);
$stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->execute();

	echo "exécutée";

} catch (exception $e) {

	echo "échec";
}

exit;

// Redirect the user to the read.php page
//header('Location: read.php');



     

    }


    ?>

  
</body>

</html>

