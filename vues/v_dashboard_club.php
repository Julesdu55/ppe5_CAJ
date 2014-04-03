
<div id="liste_tickets">
    <h2>Tickets en cours</h2>
<?php
foreach ($bugs_en_cours as $bug) {
    if ($bug->getEngineer() != null){
        $engineer = $bug->getEngineer()->getName();
    }else{
        $engineer = "non affecté";
    }
    echo "<ul>";
    echo "<li><img src='./images/en_cours.png' width='30px' height='30px'/></li>";
    echo "<li>".$bug->getCreated()->format('d.m.Y')."</li>";
    echo "<li><info class='carac'> affecté à :</info> ".$engineer."</li>";
    echo "<li><info class='carac'> Produit(s) :</info> ";
    foreach ($bug->getProducts() as $product) {
        echo "- ".$product->getName()." ";
    }
    echo "</li>";
    echo "<li>".$bug->getDescription()."</li>";
    if ($bug->getCapture()!= "")
        echo "<li><a href='capture/".$bug->getCapture()."'>Capture d'écran</a>";
    echo "</ul>";
}
?>
</div>

<div id="liste_tickets">
    <h2>Tickets fermés</h2>
    <?php
    foreach ($bugs_fermes as $bug) {
        if ($bug->getEngineer() != null){
            $engineer = $bug->getEngineer()->getName();
        }else{
            $engineer = "non affecté";
        }
        echo "<ul>";
        echo "<li><img src='./images/ferme.png' width='30px' height='30px'/></li>";
        echo "<li>".$bug->getCreated()->format('d.m.Y')."</li>";
        echo "<li><info class='carac'> affecté à :</info> ".$engineer."</li>";
        echo "<li><info class='carac'> Produit(s)</info> : ";
        foreach ($bug->getProducts() as $product) {
            echo "- ".$product->getName()." ";
        }
        echo "</li>";
        echo "<li>".$bug->getDescription()."</li>";
        if ($bug->getCapture()!= "")
            echo "<li> <a href='capture/".$bug->getCapture()."'>Capture d'écran</a>";
        echo"<li><info class='carac'> Résumé :</info> ".$bug->getResume()."</li>";
        if($bug->getResolution()!= null)
        echo"<li><info class='carac'>Résolu le :</info> ".$bug->getResolution()->format('d.m.Y')."</li>";
        else"<li><info class='carac'>Pas de date</info></li>";
        echo "</ul>";
    }
    ?>
</div>