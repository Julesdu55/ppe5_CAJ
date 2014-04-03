<div id="bandeau">
<!-- Images En-t�te -->
    <h1>HelpDesk Maison des ligues</h1>
</div>
<!--  Menu haut-->
<ul id="menu">


    <?php
        if(estConnecter()){
            echo '<li><a href="index.php?uc=dash"> Mon tableau de bord </a></li>';
            //echo '<li><a href="index.php?uc=liste_tickets"> Incidents déclarés </a></li>';
            if ($_SESSION['login']['fonction'] == "Club" ){

                echo '<li><a href="index.php?uc=dash&action=nouveau"> Nouvel incident</a></li>';
            }
            echo '<li><a href="index.php?uc=deconnexion">Se déconnecter</a></li>';
        }else{
            echo '<li><a href="index.php?uc=accueil"> Accueil </a></li>';
        }
    ?>
</ul>
