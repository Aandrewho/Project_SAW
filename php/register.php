<!DOCTYPE HTML>
<html>
    <head>
        <title>Pagina di registrazione</title>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
    <body>
        <?php
			include ("connessione.php"); //richiama il file php per connettersi al server			
			//Definisco le variabili del form e le setto
			$nome = $cognome = $sesso = $email = $password = $confirmpsw = $empty = "";
			//Variabili contenenti la stringa di errore
			$nomeErr = $cognomeErr = $sessoErr = $emailErr = $passwordErr = $confirmpswErr = "";			
			//POST crea un array composto dai campi del form
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				//Funzione utilizzata per testare l'input
				function test_input($data) {
					//Questa funzione restituisce il parametro privo degli spazi iniziali e finali
					$data = trim($data);
					//Questa funzione restituisce il parametro privo dei backslash
					$data = stripslashes($data);
					//Questa funzione è utile nel prevenire la presenza di marcatori HTML
					$data = htmlspecialchars($data);
					return $data;
				}
			
				//Controllo sul campo NOME
				if (empty($_POST["nome"])) {
					$nomeErr = "Inserire il nome";
				} else {
					$nome = test_input($_POST["nome"]);
					//Controlla se il nome contiene solo spazi e lettere
					if (!preg_match("/^[a-zA-Z ]*$/",$nome)) {
						$nomeErr = "E' concesso inserire solo lettere e spazi";
					}
				}			
				//Controllo sul campo COGNOME
				if (empty($_POST["cognome"])) {
					$cognomeErr = "Inserire il cognome";
				} else {
					$cognome = test_input($_POST["cognome"]);
					if (!preg_match("/^[a-zA-Z ]*$/",$cognome)) {
						$cognomeErr = "E' concesso inserire solo lettere e spazi";
					}
				}
				//Controllo sul campo SESSO
				if (empty($_POST["sesso"])) {
					$sessoErr = "Selezionare un sesso";
				} else {
					$sesso = test_input($_POST["sesso"]);
				}
				
				//Controllo sul campo EMAIL
				if (empty($_POST["email"])) {
					$emailErr = "Inserire un Email";
				} else {
					$email = test_input($_POST["email"]);
					//Controlla attraverso un filtro se l'email è formalmente valida
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$emailErr = "Formato email non valido";
                    }
                    $select = mysqli_query($con, "SELECT `email` FROM `Users` WHERE `email` = '".$_POST['email']."'") or exit(mysqli_error());
                    if(mysqli_num_rows($select))
                        $emailErr = "Questa Email è già in uso";
				}
				//Controllo sul campo PASSWORD
				if (empty($_POST["password"])) {
					$passwordErr = "Inserire una password";
				}	else {
					$password = $_POST["password"];
				}                
				//Controllo lunghezza password
                if(strlen(($password)) < 8) {
                    $passwordErr = "La Password deve essere almeno di 8 caratteri";
                }
                    
				//Controllo sul campo CONFIRMPSW
				if (empty($_POST["confirmpsw"])) {
					$confirmpswErr= "Reinserire la password";
				}
				
				//Controllo sull'uguaglianza delle password
				if ($_POST["password"] != $_POST["confirmpsw"]) {
					$confirmpswErr = "Le password devono essere uguali";
				}
				
				//md5 cripta la password
				$password = md5($password);				
				if(($nomeErr != "") || ($cognomeErr != "") ||  ($sessoErr != "") || ($emailErr != "") || ($passwordErr != "") || ($confirmpswErr != "") ) {
					
				}else{
					//Funzione che esegue la query di inserimento dei dati in tabella del DB
					$toinsert = ("INSERT INTO Users
							(id, nome, cognome, sesso, email, password)
							VALUES (NULL, '".$nome."','".$cognome."','".$sesso."','".$email."','".$password."')");
					$result1 = mysqli_query($con, $toinsert);
					$toobtain = ("SELECT * FROM Users WHERE email = '$email'");
					$result2 =  mysqli_query($con, $toobtain);
					if (mysqli_num_rows($result2) > 0) {
						while ($row = $result2->fetch_assoc()) {
							$id = $row['Id'];
						}
					}
					$tocreate = ("INSERT INTO Profilo
						(id, data, luogo, descrizione, link)
						VALUES ('".$id."' , '".$empty."', '".$empty."', '".$empty."', '".$empty."')");
					$result3 =  mysqli_query($con, $tocreate);
					if($result1 && $result2 && $result3){	
						header("Location:../php/login.php");	
				    }
				}
			}
		?>
		<div class="reg-img">
            <div class="reg-format">
                <div class="reg-titolo">
                    <h1>REGISTRAZIONE</h1>
                </div> 
                <div class="reg-input">
                <!-- (htmlspecialchars) Impedisce l'inserimento di codice HTML o JavaScript nel form-->
                <!-- ($_SERVER["PHP_SELF"]) è una variabile superglobale che ritorna il nome del file dello script in esecuzione. -->
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">  
                        <label for="nome">NOME</label><br>
                        <input id="nome" type="text" name="nome" value="<?php echo $nome;?>"/>
                        <span class="error">* <br><?php echo $nomeErr;?></span>
                        <br>                     
                        <label for="cognome">COGNOME</label><br>
                        <input id="cognome" type="text" name="cognome" value="<?php echo $cognome;?>"/>
                        <span class="error">* <br><?php echo $cognomeErr;?></span>                   
                        <label for="sesso">SESSO</label><br>
                        <input type="radio" name="sesso" <?php if(isset($sesso) && $sesso=="femminile") echo "checked";?> value="femminile"/>Donna
						<input type="radio" name="sesso" <?php if(isset($sesso) && $sesso=="maschile") echo "checked";?> value="maschile"/> Uomo
						<span class="error">* <br><?php echo $sessoErr;?></span>			
                        <label for="email">EMAIL</label><br>
                        <input id="email" type="email" name="email" value="<?php echo $email;?>"/>
                        <span class="error">* <br><?php echo $emailErr;?></span>
                        <label for="password">PASSWORD</label><br>
                        <input id="password" type="password" name="password" value="<?php echo $password;?>"/>
                        <span class="error">* <br><?php echo $passwordErr;?></span>
                        <label for="confirmpsw">CONFERMA PASSWORD</label><br>
                        <input id="confirmpsw" type="password" name="confirmpsw" value="<?php echo $confirmpsw;?>"/>
                        <span class="error">* <br><?php echo $confirmpswErr;?></span>
                        <button class="button" name="submit">REGISTRATI</button>   
                    </form>
                </div>
            </div> 
        </div>
    </body>
</html>