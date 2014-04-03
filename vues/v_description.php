<?php
echo "<table>";
foreach ($bugs as $bug){

    echo "<tr><td>".$bug->getDescription()."</td><td><img src='./capture/".$bug->getCapture()."' /></td></tr>";
}
echo "</table>";
echo '<br><input type="button" value="fermer" onclick="javascript:parent.opener.location.reload();window.close();">';
?>