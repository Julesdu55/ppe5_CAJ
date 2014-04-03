
<form name="cloture_bug" enctype="multipart/form-data" method="POST" action="index.php?uc=dash&action=cloture_Bug&id=<?php echo $_GET['id'] ?>">
    <fieldset>
    <legend>Cloturer le bug</legend>
    <p>
        <label for="libelle">Des  : </label>
        <textarea id="libelle" name="libelle" size="500" maxlength="500"></textarea> <div id="checkLibelle"></div>
    </p>

        <input type="submit"  value="Valider" name="valider">
        <input type="reset" value="Annuler" name="annuler">
    </p>
    </fieldset>
</form>
