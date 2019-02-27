<?php
	session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Project-saw</title>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Roboto:700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/reset.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>        
    </head>

    <body>    
         <div class="main-img" id="titolo">
            <header class="header">
            <?php if(!empty($_SESSION['nome'])) : ?>
                    <a href="pagriservata.php" class="ciaouser"><b>Ciao, </b><?=$_SESSION['nome'];?></a>
        	<?php endif; ?>
                <h1 class="titolo">GE-MERGENCY</h1>   
                <nav>
                    <ul>
                        <li>
                            <a href="index.php">HOME</a>
                        </li>
                        <?php if(empty($_SESSION['email'])) : ?>
                        <li>
                            <a href="login.php">LOGIN</a>
                        </li>
                        <li>
                            <a href="register.php">REGISTRATI</a>
                        </li>
                        <?php else : ?>
                        <li>
                            <a href="logout.php">LOGOUT</a>                             
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="autocomplete.php">LEARN MORE</a>
                        </li>
                    </ul>
                </nav>
                <?php if(!empty($_SESSION['nome'])) : ?>        	
                	<button class="S_button" name="submit" onclick="document.location.href='segnalazione.php'" >SEGNALA</button> 
               	<?php endif; ?>
                
            </header>
        </div>
        
        <section id="prefazione" class="demo">
        	<div id="pref-testo">
				</div>
            <a href="#settanta"><span></span></a>
        </section>
        <section id="settanta" class="demo">
            <a href="#novantadue"><span></span></a>
        </section>
        <section id="novantadue" class="demo">
            <a href="#undici"><span></span></a>
        </section>
        <section id="undici" class="demo">
            <a href="#quattordici"><span></span></a>
        </section>
        <section id="quattordici" class="demo">
            <a href="#titolo"><span></span></a>
        </section>
    </body>
</html>