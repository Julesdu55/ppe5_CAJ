<?php
/**
 * teste si une chaîne a un format de code postal
 *
 * Teste le nombre de caractères de la chaîne et le type entier (composé de chiffres)
 * @param $codePostal : la chaîne testée
 * @return : vrai ou faux
*/
function estUnCp($codePostal)
{
   
   return strlen($codePostal)== 5 && estEntier($codePostal);
}
/**
 * teste si une chaîne est un entier
 *
 * Teste si la chaîne ne contient que des chiffres
 * @param $valeur : la chaîne testée
 * @return : vrai ou faux
*/

function estEntier($valeur) 
{
	return preg_match("/[^0-9]/", $valeur) == 0;
}
/**
 * Teste si une chaîne a le format d'un mail
 *
 * Utilise les expressions régulières
 * @param $mail : la chaîne testée
 * @return : vrai ou faux
*/
function estUnMail($mail)
{
return  preg_match ('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#', $mail);
}
/*
 * Fonction qui verifie si utilisateur est connecté
 * renvoie 1 si connecté
 * renvoie 0 si non connecté
 *
 */
function estConnecter(){
    $resu = 0;
    if(isset($_SESSION['login'])){
        $resu = 1;
    }
    return $resu;
}

/*
 * Déconnecte l'utilisateur
 */
function seDeconnecter(){
   unset($_SESSION['login']);
    echo'Vous avez été déconnecté';
}

/*
 * Fonction qui verifie si utilisateur est valide
 * reçoit le login et le mot de passe à vérifier.
 * La fonction s'occcupe de créer la variable session 'status' pour identifier le type d'utilisateur connecté
 * renvoie 1 si ok
 * renvoie 0 si non ok
 *
 */

function authentifierUser($l,$m){
    require "bootstrap.php";

    $dql = "SELECT u FROM User u WHERE u.login = '$l' AND u.mdp = '$m'";

    $query = $entityManager->createQuery($dql);
    $query->setMaxResults(1);
    $users = $query->getResult();

    if (count($users) > 0){
        $leClub = null;
        if ($users[0]->getLeClub() != null){
            $leClub = $users[0]->getLeClub()->getNumClub();
        }
        $log = array('id'=>$users[0]->getId(),'identite'=>$users[0]->getPrenom() . " " .$users[0]->getName(), 'fonction'=>$users[0]->getFonction(), 'club'=>$leClub );
        $_SESSION['login'] = $log;
        return 1;
    }else{
        return 0;
    }
}
function getBugsForTechnicien($id){
    require "bootstrap.php";
    $bugRepository = $entityManager->getRepository('Bug');
    $bugs =  $bugRepository->findBy(array('engineer' => $id));

  //  \Doctrine\Common\Util\Debug::dump($bugs);
    $tab1 = array();
    $tab2 = array();
    foreach ($bugs as $bug) {
        if ($bug->getStatus() == "CLOSE"){
            $tab2[] = $bug;
        }else{
            $tab1[] = $bug;
        }
    }
    $retour = array($tab1, $tab2);
    return $retour;
}

// Récupérer les bugs en fonction de la fonction du user
function getBugsOpenByUser($id){
    require "bootstrap.php";
    $users = $entityManager->find('User', $id);
    $bugs = $users->getReportedBugs();
    $tab1 = array();
    $tab2 = array();
    foreach ($bugs as $bug) {
        if ($bug->getStatus() == "CLOSE"){
            $tab2[] = $bug;
        }else{
            $tab1[] = $bug;
        }
    }
    $retour = array($tab1, $tab2);
    return $retour;
}

// Récupérer tous les bugs
function getAllBugs(){
    require "bootstrap.php";
    $bugRepository = $entityManager->getRepository('Bug');
    $bugs = $bugRepository->findAll();
    $tab1 = array();
    $tab2 = array();
    foreach ($bugs as $bug) {
        if ($bug->getStatus() == "CLOSE"){
            $tab2[] = $bug;
        }else{
            $tab1[] = $bug;
        }
    }
    $retour = array($tab1, $tab2);
    return $retour;
}

// Récupérer informations sur les techniciens et le responsable
function getUsersByFunction(){
    require "bootstrap.php";
    $userRepository = $entityManager->getRepository('User');
    $users = $userRepository->findAll();
    foreach ($users as $user){
        if($user->getFonction() == "Technicien" || $user->getFonction() == "Responsable"){
            $tech[] = $user;
        }
    }
    return $tech;
}

// Récupérer les informations de toutes les applications
function getAllProducts(){
    require "bootstrap.php";
    $productRepository = $entityManager->getRepository('Product');
    $products = $productRepository->findAll();
    return $products;
}

// Affecter un bug à un technicien
function affectBug(){
    var_dump($_POST);
}

// Ajouter un bug
function ajouterNewBug(){
    $obj = $_POST['objet'];
    $lib = $_POST['libelle'];
    $apps = $_POST['apps'];
  //  echo var_dump($_FILES['capture']);
    if ($_FILES['capture']['size'] != 0)
        $nomFichier = envoieFichier($_FILES['capture']);

    //echo var_dump($apps);

    require "bootstrap.php";

    $reporter = $entityManager->find("User", $_SESSION['login']['id']);
    //$engineer = new User();

    $bug = new Bug();
    $bug->setDescription($lib);
    $bug->setCreated(new DateTime("now"));
    $bug->setStatus("OPEN");
    if (isset ($nomFichier))
    {
        if ($nomFichier != false )
            $bug->setCapture($nomFichier);
    }

    foreach ($apps as $productId) {
        $product = $entityManager->find("Product", $productId);
        $bug->assignToProduct($product);
    }

    $bug->setReporter($reporter);
    //$bug->setEngineer($engineer);

    $entityManager->persist($bug);
    $entityManager->flush();

    return "Le bug a été créé.";
}

function updateAction($id,$libelle)
{
    require "bootstrap.php";
    $bugs = $entityManager->find('Bug', $id);
    //var_dump($bugs);
    if (!$bugs) {
        throw $this->createNotFoundException(
            'Aucun produit trouvé pour cet id : '.$id
        );
    }

    $bugs->setStatus('CLOSE');
    $bugs->setResume($libelle);
    $entityManager->flush();


}

?>

