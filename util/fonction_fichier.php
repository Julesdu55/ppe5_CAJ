<?php
function envoieFichier($capture)
{
    $fichier = basename($capture['name']);
    $taille_maxi = 1000000;
    $taille = filesize($capture['tmp_name']);
    $extensions = array('.png', '.gif', '.jpg', '.jpeg', 'bmp');
    $extension = strrchr($capture['name'], '.');
    //Début des vérifications de sécurité...
    if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
        $erreur = '<br>Vous devez uploader un fichier de type png, gif, jpg, bmp ou jpeg...';
    }
    if($taille>$taille_maxi)
    {
        $erreur = '<br>Le fichier est trop gros...';
    }
    if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    {
        $fichier = formatageNomFichier($fichier);
        if(move_uploaded_file($capture['tmp_name'], "capture/". $fichier))
        //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
            echo "</br>Le fichier a bien été envoyé";
           // echo var_dump($fichier);
            return $fichier;
        }
        else //Sinon (la fonction renvoie FALSE).
        {
            echo '<br>Echec de l\'upload !';
            return false;
        }
    }
    else
        echo $erreur;
}

function formatageNomFichier($nom)
{
    //On formate le nom du fichier ici...
    //$fichier = strtr($fichier,'   ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    //$fichier = strtr($fichier,'éè','xy');
    $trans = array( 'À'=>'A',
        'Á'=>'A',
        'Â'=>'A',
        'Ã'=>'A',
        'Ä'=>'A',
        'Å'=>'A',
        'Ç'=>'C',
        'È'=>'E',
        'É'=>'E',
        'Ê'=>'E',
        'Ë'=>'E',
        'Ì'=>'I',
        'Í'=>'I',
        'Î'=>'I',
        'Ï'=>'I',
        'Ò'=>'O',
        'Ó'=>'O',
        'Ô'=>'O',
        'Õ'=>'O',
        'Ö'=>'O',
        'Ù'=>'U',
        'Ú'=>'U',
        'Û'=>'U',
        'Ü'=>'U',
        'Ý'=>'Y',
        'à'=>'a',
        'á'=>'a',
        'â'=>'a',
        'ã'=>'a',
        'ä'=>'a',
        'å'=>'a',
        'ç'=>'c',
        'è'=>'e',
        'é'=>'e',
        'ê'=>'e',
        'ë'=>'e',
        'ì'=>'i',
        'í'=>'i',
        'î'=>'i',
        'ï'=>'i',
        'ð'=>'o',
        'ò'=>'o',
        'ó'=>'o',
        'ô'=>'o',
        'õ'=>'o',
        'ö'=>'o',
        'ù'=>'u',
        'ú'=>'u',
        'û'=>'u',
        'ü'=>'u',
        'ý'=>'y',
        'ÿ'=>'y');
    $nom = strtr($nom,$trans);
    $nom = preg_replace('/([^.a-z0-9]+)/i','_', $nom);
    return $nom;
}
