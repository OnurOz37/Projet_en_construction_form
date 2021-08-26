<?php 

$firstname = $name = $email = $tel = $message = ""; 
$firstnameError = $nameError = $emailError = $telError = $messageError = ""; 
$isSuccess = false; 
$emailTo = "onurozogul1@gmail.com"; 

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $firstname = verifyInput($_POST["firstname"]); 
    $name =verifyInput( $_POST["name"]); 
    $email =verifyInput( $_POST["email"]); 
    $tel =verifyInput( $_POST["tel"]); 
    $message =verifyInput( $_POST["message"]); 
    $isSuccess=true; 
    $emailText = "";

    if(empty($firstname))
    {
        $firstnameError = "Veuillez entrer votre prénom svp.";
        $isSuccess=false;
    }
    else
    {
        $emailText .= "firstname: $firstname\n";
    }
    if(empty($name))
    {
        $nameError = "Veuillez entrer votre nom svp.";
        $isSuccess=false;
    }
    else
    {
        $emailText .= "name: $name\n";
    }
    if(empty($message))
    {
        $messageError = "Veuillez entrer votre message svp. ";
        $isSuccess=false;
    }
    else
    {
        $emailText .= "message: $message\n";
    }
    if (!isEmail($email))
    {
        $emailError = "Veuillez entrer un email valide svp. ";
        $isSuccess=false;
    }
    else
    {
        $emailText .= "email: $email\n";
    }
    if (!isTel($tel))
    {
        $telError = "Veuillez entrer que des chiffres et des espaces svp. ";
        $isSuccess=false;
    }
    else
    {
        $emailText .= "tel: $tel\n";
    }
    if($isSuccess)
    {
        $headers = "From : $firstname $name <$email>\r\nReply-To : $email"; 
        //envoie de l'email
        mail($email, "Vous avez un message", $emailText, $headers);
        $firstname = $name = $email = $tel = $message = ""; //pour reinitialiser apres avoir recu le message de validation

    }
}


function isTel($var)
{
    return preg_match("/^[0-9 ]*$/", $var);
}
function isEmail($var)
{
    return filter_var($var, FILTER_VALIDATE_EMAIL); //cette fonction va permettre de comparer notre mail a un filtre de validation de email
}

function verifyInput ($variable)
{
    $variable = trim($variable);
    $variable = stripslashes($variable);
    $variable= htmlspecialchars($variable); 
    return $variable; 
}



?>


<!DOCTYPE html>
<html>
    <head>
        <title>Contactez-moi !</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="widht=device-widht, initial-scale=1">
        <script src="jquery-3.6.0.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato" type="text/css">
        <link rel="stylesheet" href="CSS/style.css">

    </head>
    <body>
        <div class="container">
            <div class="divider"></div>
            <div class="heading">
                <h2>Contactez-moi</h2>
            </div>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <form id="contact-form" method="POST" role="form"  action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF']); ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="firstname">Prénom <span class="blue"> *</span></label>
                                <input type="text" id="firstname" name="firstname"  class="form-control" placeholder="Votre prénom" value="<?php echo $firstname; ?>">
                                <p class="comments"><?php echo $firstnameError ?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="name">Nom <span class="blue"> *</span></label>
                                <input type="text" id="name" name="name"  class="form-control" placeholder="Votre nom" value="<?php echo $name; ?>">
                                <p class="comments"><?php echo $nameError ?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="email">E-mail <span class="blue"> *</span></label>
                                <input type="email" id="email" name="email"  class="form-control" placeholder="Votre e-mail" value="<?php echo $email; ?>">
                                <p class="comments"><?php echo $emailError ?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="tel">Téléphone </label>
                                <input type="tel" id="tel" name="tel" class="form-control" placeholder="Votre téléphone" value="<?php echo $tel; ?>">
                                <p class="comments"><?php echo $telError ?></p>
                            </div>
                            <div class="col-md-12">
                                <label for="message">Message <span class="blue"> *</span></label>
                                <textarea name="message" id="message"  class="form-control" placeholder="Votre message" rows="4" ><?php echo $message; ?></textarea>
                                <p class="comments"><?php echo $messageError ?></p>
                            </div>
                            <div class="col-md-12">
                               
                                <p class="blue"><strong>*Ces informations sont requises</strong></p>
                            </div>
                            <div class="col-md-12">
                               
                                <input type="submit" class="button1" value="Envoyer">
                            </div>
                            
                        </div>

                        <p class="thank-you" style="display:<?php if($isSuccess) echo 'block'; else echo 'none'; ?>">Votre message a bien été transmis. Merci de m'avoir contacté.</p>

                    </form>
                </div>
            </div>
        </div>
    </body>
</html>