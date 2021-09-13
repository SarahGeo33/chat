<?php
$bdd = new PDO("mysql:host=127.0.0.1;dbname=chat_php;charset=utf8", "root", "");
if(isset($_POST['pseudo'])AND isset($_POST['message']) AND !empty($_POST['pseudo']) AND !empty($_POST['message']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $message = htmlspecialchars($_POST['message']);
    $insertmsg = $bdd->prepare('INSERT INTO chat(pseudo, message) VALUES(?, ?)');
    $insertmsg->execute(array($pseudo, $message));

}
?>
<html>
    <head>
        <title>CHAT PHP</title>
        <meta charset="utf-8">
    </head>
    <body>
    <form method="post" action="">
        <input type="text" name="pseudo" placeholder="PSEUDO" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" /><br />
        <br><br>
        <textarea type="text" name="message" placeholder="MESSAGE"/></textarea>
        <br><br>
        <input type="submit" value="Envoyer"/>

    </form>
    <?php
    $allmsg = $bdd->query('SELECT * FROM chat ORDER BY id DESC LIMIT 0, 10');
    while($msg = $allmsg->fetch())
    {
    ?>
        <b><?php echo $msg['pseudo']; ?> : </b><?php echo $msg['message']; ?><br />

    <?php
    }
    ?>


    </body>
</html>
