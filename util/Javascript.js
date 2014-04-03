/**
 * Created with JetBrains PhpStorm.
 * User: Alexandre
 * Date: 31/03/14
 * Time: 10:17
 * To change this template use File | Settings | File Templates.
 */
function checkFormNewBug()
{
    erreur=0;
    if (document.getElementById("objet").value=="")
    {
        document.getElementById("checkObjet").innerHTML="Ce champ est nécessaire";
        erreur = 1;
    }
    else
        document.getElementById("checkObjet").innerHTML="";

    if(document.getElementById("libelle").value=="")
    {
        document.getElementById("checkLibelle").innerHTML="Ce champ est nécessaire";
        erreur = 1;
    }
    else
        document.getElementById("checkLibelle").innerHTML="";

    if(document.getElementById("apps").value=="")
    {
        document.getElementById("checkApps").innerHTML="Ce champ est nécessaire";
        erreur = 1;
    }
    else
        document.getElementById("checkApps").innerHTML="";

    if (erreur == 1)
    {
        return false;
    }
}