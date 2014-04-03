<?php
 // update_product.php <id> <new-name>
require_once "../bootstrap.php";

$num_bug = $_POST['idBug'];
$num_tech = $_POST['idTechnicien'];
$date_reso = $_POST['dateBug'];

// Explose la date pour avoir le jour, le mois, l'année séparément
list($j,$m,$y) = explode("/", $date_reso);

$laDate = new DateTime();
$laDate->setDate($y,$m,$j);

$bug = $entityManager->find('Bug', $num_bug);
$tech = $entityManager->find('User', $num_tech);

$bug->setEngineer($tech);
$bug->setResolution($laDate);

$entityManager->flush();

echo json_encode("Affecté");

?>