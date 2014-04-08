<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" >
    $(document).ready(function(){

        // Cache les div des popup
        $("[id^='dialog_date']").hide();
        $("[id^='dialog_tech']").hide();
        $("[id^='dialog_ok']").hide();


        // Action du bouton affecter
        $("[id^='b_affect_']").click(function(){
            // Récuperer l'id du Bug de la ligne en question
            num = $(this).attr('id').substr(9);
            idTech = $('#liste_'+num+' :selected').val();
            dateBug = $('#dateBug_'+num+'').val();

            console.log(num);
            console.log(idTech);
            console.log(dateBug);

            if(idTech == ''){
                // Ouvre le popup dialog_tech si le technicien n'est pas sélectionné
                $( "#dialog_tech" ).dialog();
            }if(dateBug == ''){
                // Ouvre le popup dialog_date si le champ date n'est pas rempli
                $( "#dialog_date" ).dialog();
            }else{
                $( "#dialog_ok" ).dialog();
                $.ajax({
                    type: "POST",
                    async:false,
                    url: "/PPE5_CAJ/util/donnees_ajax.php",
                    dataType:'json',
                    data: "idBug=" + num + "&idTechnicien=" + idTech + "&dateBug=" + dateBug,
                })
            }
        })
    })
</script>


<div id="liste_tickets">
    <h2>Tickets en cours</h2>
    <?php
    foreach ($bugs_en_cours as $bug) {
        if ($bug->getEngineer() != null){
            $engineer = $bug->getEngineer()->getName();
        }else{
            $engineer = "non affecté";
        }
        // Récuperer l'id du bug
        $Idbug = $bug->getId();

        echo "<ul id=".$Idbug."'>";
        echo "<li><img src='./images/en_cours.png' width='30px' height='30px'/></li>";
        echo "<li>".$bug->getCreated()->format('d.m.Y')."</li>";
        echo "<li> affecté à : ".$engineer."</li>";
        echo "<li> Produit(s) : ";
        foreach ($bug->getProducts() as $product) {
            echo "- ".$product->getName()." ";
        }
        echo "</li>";
        $dateResolution = $bug->getResolution();
        if(isset($dateResolution)){
            echo "<li> Date de résolution donnée: ".$dateResolution->format('d.m.Y')."</li>";
        }else{
            echo "<li> Date de résolution donnée: Pas de date</li>";
        }
        $image = $bug->getCapture();
        if(isset($image)){
            echo "<img src='./capture/".$image."' width='50' height='50'>";
        }else{
            echo "<img src='./capture/Pas de capture.jpg' width='50' height='50'>";
        }
        echo "<br />";
        echo "<select name='liste' id='liste_".$Idbug."'>";
        echo "<option value=''>Choisissez un technicien</option>";
        foreach ($users as $user){
            echo "<option value='".$user->getId()."'>".$user->getName().' '.$user->getPrenom()."</option>";
        }
        echo "</select> ";
        echo "Date de résolution (jj/mm/YYYY)<input type=text name='dateBug' id='dateBug_".$Idbug."'>";
        echo "<input name='b_affect' id='b_affect_".$Idbug."' type='submit' value='Affecter'>";
        echo "<div id='dialog_tech' title='Erreur'>Vous n'avez pas sélectionné de technicien</div>";
        echo "<div id='dialog_date' title='Erreur'>Vous n'avez pas rempli le champ date</div>";
        echo "<div id='dialog_ok' title='Erreur'>L'enregistrement a bien été pris en compte</div>";
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
        $Idbug = $bug->getId();
        echo "<ul id=".$Idbug." title='Description : ".$bug->getDescription()."'>";
        echo "<li><img src='./images/ferme.png' width='30px' height='30px'/></li>";
        echo "<li>".$bug->getCreated()->format('d.m.Y')."</li>";
        echo "<li> affecté à : ".$engineer."</li>";
        echo "<li> Produit(s) : ";
        foreach ($bug->getProducts() as $product) {
            echo "- ".$product->getName()." ";
        }
        echo "</li>";
        echo "<li>".$bug->getDescription()."</li>";
        echo "</ul>";
    }
    ?>
</div>