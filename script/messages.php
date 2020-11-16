<?php
    session_start();

    $db= new PDO('mysql:host=localhost;dbname=tchat_test;charset=utf8',"remi","test");

    $fetching_messages = $db -> query('SELECT * FROM tchat ORDER BY id');
    while($messages = $fetching_messages->fetch()){
        if($messages['pseudo'] == $_SESSION['username']){
            ?>
            <div id="bloc_message_right">
                <div id="date"><?php echo $messages['date_message'] ?></div>
                <div id="pseudo_message"><?php echo $messages['pseudo']?></div>
                <div id="text_message"><?php echo $messages['message']?></div>
            </div>
            <?php
        } else {
        ?>
        <div id="bloc_message_left">
            <div id="date"><?php echo $messages['date_message'] ?></div>
            <div id="pseudo_message"><?php echo $messages['pseudo']?></div>
            <div id="text_message"><?php echo $messages['message']?></div>
        </div>
        <?php
        }
    }
?>