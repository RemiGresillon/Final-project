<?php
session_start();
if (empty($_SESSION['username'])){
    header('Location:../index.php');
}


$db= new PDO('mysql:host=localhost;dbname=tchat_test;charset=utf8',"remi","test");

if(isset($_POST['message']) AND !empty($_POST['message']))
{

    $pseudo = htmlspecialchars($_SESSION['username']);
    $message = htmlspecialchars($_POST['message']);
    $actual_date = date("Y-m-d H:i:s");
    $insertmsg = $db -> prepare('INSERT INTO tchat(pseudo,message,date_message) VALUES(?,?,?)');
    $insertmsg -> execute(array($_SESSION['username'],$message,$actual_date));
}

?>


<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Site de test Tchat</title>
    <link rel="stylesheet" href="../css/style.css">
    <script>
        var xhr = new XMLHttpRequest();
        function reloading(){
            xhr.open('GET', '../script/messages.php');
            xhr.send(null);
            xhr.onreadystatechange = function() {
                var DONE = 4;
                var OK = 200;
                if (xhr.readyState === DONE) {
                    if (xhr.status === OK) {
                        document.getElementById('container_messages').innerHTML = xhr.responseText;
                    } else {
                    console.log('Error: ' + xhr.status);
                    }
                }
            }
        }
    setInterval(reloading,100);    
    </script>
</head>
<body>
    <div id="container_messages"></div>
    <form id="container_send_messages" method="post" action="">
        <div>Vous êtes connecté en tant que: <?php echo $_SESSION['username']?></div>
        <input type="text" name="message" placeholder = "Ecris ton message ici !"></textarea>
        <input type="submit" value="Envoie"/>
        <a href="deconnexion.php">Se déconnecter</a>
    </form>
    
</body>

</html>