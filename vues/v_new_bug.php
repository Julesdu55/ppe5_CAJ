
<form name="new_bug" onsubmit="return checkFormNewBug();" enctype="multipart/form-data" method="POST" action="index.php?uc=dash&action=nouveau">
    <fieldset>
    <legend>Signalement d'un nouveau bug</legend>
    <p>
        <label for="objet">Objet : </label>
        <input id="objet" type="text" name="objet" size="50" maxlength="50"> <div id="checkObjet"></div>
    </p>
    <p>
        <label for="libelle">Description du problème : </label>
        <textarea id="libelle" name="libelle" size="500" maxlength="500"></textarea> <div id="checkLibelle"></div>
    </p>
    <p>
        <label for="apps">Application(s) concernées : </label>
        <select multiple id="apps" name="apps[]">
            <?php
            foreach($the_products as $p){
                echo '<option value="'.$p->getId().'">'.$p->getName().'</option>';
            }
            ?>
        </select><div id="checkApps"></div>
    </p>
    <p>
        <label for="file">Capture d'Ecran (optionnel)</label>
        <input type="file" name="capture">
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    </p>
    <p>
        <input type="submit" value="Valider" name="valider">
        <input type="reset" value="Annuler" name="annuler">
    </p>
    </fieldset>
</form>