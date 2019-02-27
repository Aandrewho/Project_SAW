<!DOCTYPE html>
<html>
    <head>
        <title>Pagina di login</title>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
    
	<?php
		include ("connessione.php"); //richiama il file php per connettersi al server
		
		//Variabili del form
		$email = $password = "";
		$remember;
		//Variabili di testo per le stringhe di errore
		$emailErr = $passwordErr = $error = "";
		
	    if(isset($_GET['submit'])) {	    		
	    	if (empty($_GET["email"]))	{
	    		$emailErr = "Inserire il proprio indirizzo email";
	    	}	else {
	    		//Funzione per impedire l'inserimento di caratteri non consentiti
	    		$email = mysqli_real_escape_string($con, $_GET['email']);
	    		if (!filter_var($email, FILTER_VALIDATE_EMAIL))	{
	    			$emailErr = "Formato email non valido";
	    		}
	    	}
	    	
	    	if (empty($_GET["password"])) {
	    		$passwordErr = "Inserire la propria password";
	    	}	else {
	    		$password = mysqli_real_escape_string($con,$_GET['password']);
	    	}	
	    	
	    	//Controllo se il checkbox è spuntato
	    	if (!empty($_GET["remember"])) {
	    		$remember = $_GET['remember'];
	    	}
	    		
	    	//Eseguo l'hash della password per poterlo confrontare con quello presente sul DB
	    	$password = md5($password);	    		
	    		    
	    	$query = mysqli_query($con, "SELECT * FROM Users WHERE email='$email' AND password='$password'");
	    	if (mysqli_num_rows($query) > 0) {
	    		while ($row = $query->fetch_assoc()) {
	    			$nome = $row['nome'];
                    $id = $row['Id'];
	    		}
	    		//Istruzioni per aggiornare il last_login
	    		date_default_timezone_set('Europe/Rome');
	    		$date = date('m/d/Y h:i:s a', time());
	    		mysqli_query($con, "UPDATE Users SET last_login = '" .$date. "' WHERE email = '$email'") or exit(mysqli_error());
    			session_start();
                $_SESSION['Id'] = $id;
    			$_SESSION['email'] = $email;
    			$_SESSION['nome'] = $nome;
    			if(isset($remember)){
    				setcookie('userlogin', $email, $nome, $id, time() + 3600);
    			}
    			header('Location: ../php/index.php');
    		
	    	}
	    	else {
	    			$error = "Indirizzo email e/o password errati";
	    	}
	    }
	    ?>
	    <div class="log-img">
            <div class="log-format">
                <div class="log-titolo">
                    <h1>LOGIN</h1>
                </div> 
                <div class="log-input">
                    <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
                        <label for="email">EMAIL</label><br>
                        <input id="email" type="text" name="email"/>
                        <span class="error">* <?php echo $emailErr;?></span><br>
                        <label for="password">PASSWORD</label><br>
                        <input id="password" type="password" name="password"/>                       
                        <span class="error">* <?php echo $passwordErr;?></span>                     
                        <span class="error"> <?php echo $error;?></span> 
                        <div class="remember">
                            <label><input type="checkbox" value=true name="remember"/>REMEMBER ME</label><br>
                        </div>     
                        <button class= "button" name="submit">LOGIN</button>            
                    </form>
                </div>
            </div> 
        </div>
    </body>
</html>