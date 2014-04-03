<?php

if(!isset($_REQUEST['action']))
    $action = 'list';
else
    $action = $_REQUEST['action'];

switch($action){
    case 'list':{
        $the_bugs = getAllBugs();
        $bugs_en_cours = $the_bugs[0];
        $bugs_fermes =  $the_bugs[1];
        $users = getUsersByFunction();
        include("vues/v_dashboard_resp.php");
        break;
    }

    case 'affectation':{
        if (isset($_POST['b_affect'])){
            affectBug();
        }
        $the_bugs = getAllBugs();
        $bugs_en_cours = $the_bugs[0];
        $bugs_fermes =  $the_bugs[1];
        $users = getUsersByFunction();
        include("vues/v_dashboard_resp.php");
        break;
    }
}


