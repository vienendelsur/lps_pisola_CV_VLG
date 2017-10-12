<?php require_once('../Connections/ConnexionAutoJaune.php'); ?>
<?php session_start(); if(isset($_SESSION['MM_Username'])) $_SESSION['VARt_utilisateurID']=$_SESSION['MM_Username']; //initialisation de l'identifiant du commercial authentifie ?><?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "../fr/login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../fr/login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if (isset($_GET['date'])) { // depuis la page des vendus on a envoyé une date

// il faut la mettre dans le sens de la BDD
list($day, $month, $year) = explode('-', $_GET['date']);// à quel endroit je coupe -' c'est le premier paramètre de explode
		$annee=$year;
		$mois=$month;
		$jour=$day;
		$date=$annee.'-'.$mois.'-'.$jour;
	$_POST['date_vente']=$date;
}

$colname_rsVendusJour = "-1";
if (isset($_POST['date_vente'])) {//Si on envoie une date de recherche, on récuprère l'année
  $colname_rsVendusJour = $_POST['date_vente'];
  
  list($year, $month, $day) = explode('-', $_POST['date_vente']);
	$annee=$year;
}
//MODIFICATION COMPORTEMENT DREAM
//selon l'année on choisit la table
	if($annee==2014){
		$table_vendu='t_vendu_2014';
	}elseif($annee==2015){
		$table_vendu='t_vendu_2015';
	}elseif($annee==2016){
		$table_vendu='t_vendu_2016_3_4';// A CHANGER POUR 2016
	}else{
		$table_vendu='t_vendu';//ajouté pour éviter la requête vide
	}
// IF si pas 2016
mysql_select_db($database_ConnexionAutoJaune, $ConnexionAutoJaune);
$query_rsVendusJour = sprintf("SELECT * FROM $table_vendu, t_modele, t_fabricant, t_constructeur, t_categorie, t_client WHERE $table_vendu.date_vente = %s AND $table_vendu.numero=t_modele.numero AND t_modele.id_fabricant=t_fabricant.id_fabricant AND t_modele.id_constructeur=t_constructeur.id_constructeur AND t_modele.id_categorie=t_categorie.id_categorie AND $table_vendu.id_client = t_client.id_client ORDER BY t_client.nom ASC", GetSQLValueString($colname_rsVendusJour, "date"));
$rsVendusJour = mysql_query($query_rsVendusJour, $ConnexionAutoJaune) or die(mysql_error());
$row_rsVendusJour = mysql_fetch_assoc($rsVendusJour);
$totalRows_rsVendusJour = mysql_num_rows($rsVendusJour);
// 3 requetes si 2016
?>
<!DOCTYPE HTML>
    <html>
    <head>
<meta charset="utf-8">
    <title>AutoJauneParis &gt; Administration &gt; Recherche</title>
    <link href="../styles/style_admin.css" rel="stylesheet" type="text/css" media="screen">
    <link href="../styles/style_impression.css" rel="stylesheet" media="print">
<!--pour le date picker-->
<link href="../styles/jquery-ui.min.css" rel="stylesheet" type="text/css">
<script src="../external/jquery/jquery.js"></script>
<script src="jquery-ui.min.js"></script>
<script>
$(function() {
	 	$.datepicker.regional['fr'] = {
    closeText: 'Fermer',
    prevText: 'Précédent',
    nextText: 'Suivant',
    currentText: 'Aujourd\'hui',
    monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
    monthNamesShort: ['Janv.','Févr.','Mars','Avril','Mai','Juin','Juil.','Août','Sept.','Oct.','Nov.','Déc.'],
    dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
    dayNamesShort: ['Dim.','Lun.','Mar.','Mer.','Jeu.','Ven.','Sam.'],
    dayNamesMin: ['D','L','M','M','J','V','S'],
    weekHeader: 'Sem.',
    dateFormat: 'yy-mm-dd',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: '',
    showWeek: true,
};

$.datepicker.setDefaults($.datepicker.regional['fr']);
		$( "#datepicker" ).datepicker(
			{
			numberOfMonths: 1,
			}
		);
		
});
</script>
<!--fin du date picker
-->

    </head>
    <body>    
    <div id="container">
      <div id="header">
        <h1><img src="../images/maquette/acceuil02.png" alt="autojauneparis" width="234" height="74">
          <!-- fin de #header -->
        </h1>
      </div>
    <div id="sidebar1">
      <h3><a href="<?php echo $logoutAction ?>">d&eacute;connexion</a></h3>
    <?php include ("../inclus/menu_admin.php"); ?><!--la navigation principale-->
    </div>
  <div id="mainContent">
    <h1>Recherche des ventes par  jour<br>toutes les années</h1>
    <form id="formCherche" name="formCherche" method="post" action="vendus_jour.php">
      <input type="search" placeholder="date journée" name="date_vente" id="datepicker">
      <input type="submit" name="submit" value="Go">
    </form>
    <p>&nbsp;</p>
    <?php if ($totalRows_rsVendusJour > 0) { // Show if recordset not empty ?>
  <h2 class="print">Vente(s) : <span class="attention"><?php echo $totalRows_rsVendusJour ?></span> le 
    <?php list($day, $month, $year) = explode('-', $row_rsVendusJour['date_vente']);
		$annee2=$year;
		$mois=$month;
		$jour=$day;
		$date=$annee2.'-'.$mois.'-'.$jour; ?>
    <span class="attention"><?php echo $date ?></span></h2>
        <table border="1" cellpadding="2" cellspacing="0" id="tableau_imprim">
        <tr>
          <th>numero</th>
          <th>vignette</th>
          <th>fabricant, constructeur</th>
          <th>modèle</th>
          <th>achat</th>
          <th>&nbsp;</th>
          <th>client</th>
          <th>payé</th>
          <th>prix</th>
          <th>&nbsp;</th>
        </tr>
        <?php $total=0; ?>
        <?php 	
      		do { ?>
          <tr>
            <td><?php echo $row_rsVendusJour['numero']; ?></td>
            <td class="ne_pas_imprimer"><div align="center"><img src="../images/petite/<?php echo $row_rsVendusJour['p_photo']; ?>" alt="pas de photo"></div></td>
            <td><?php echo $row_rsVendusJour['fabricant']; ?><br>
	    <?php echo $row_rsVendusJour['constructeur']; ?>
            </td>
            <td><?php echo $row_rsVendusJour['modele']; ?></td>
            <td><?php echo $row_rsVendusJour['achat']; ?></td>
            <td>&nbsp;</td>
            <td>
              <p><a href="vendus_client.php?id_client=<?php echo $row_rsVendusJour['id_client']; ?>&date_vente=<?php echo $row_rsVendusJour['date_vente']; ?>" target="_blank"><?php echo $row_rsVendusJour['prenom']; ?><br>
                <?php echo $row_rsVendusJour['nom']; ?></a>
              </p>
              <?php 
			  //selon l'année on choisit la page à afficher
if($annee==2014){
	$page='achats_client_2014.php';
}elseif($annee==2015){
	$page='achats_client_2015.php';
}elseif($annee==2016){
	$page='achats_client_2016.php';
}elseif($annee==2017){
	$page='achats_client.php';
}
			  ?>
              <p><a href="<?php echo $page; ?>?id_client=<?php echo $row_rsVendusJour['id_client']; ?>" target="_blank">tous ses achats selon l'année</a>
              </p>
            </td>
            <td><em><?php echo $row_rsVendusJour['paye']; ?></em></td>
            <td><?php echo $row_rsVendusJour['prix_de_vente']; $total+= $row_rsVendusJour['prix_de_vente']; ?> €</td>
            <?php
		if($annee==2016){
			?>
            <td><a href="supr_vendus_jour.php?id_vendu=<?php echo $row_rsVendusJour['id_vendu']; ?>"><img src="../images/maquette/corbeille.png" border="0"></a></td>
             <?php 
		}else{
			?>
            <td>&nbsp;</td>
             <?php 
		}
			?>
          </tr>
          <?php } while ($row_rsVendusJour = mysql_fetch_assoc($rsVendusJour)); ?>
        <tr>
          <td colspan="7">Total du jour</td>
          <td><?php echo $totalRows_rsVendusJour ?> modèle(s)</td>
          <td><strong><?php echo $total; ?> € </strong></td>
          <td>&nbsp;</td>
          </tr>
      </table>
      <?php } // Show if recordset not empty ?>
<!-- fin de #mainContent -->
</div>
  <br class="clearfloat">
  <div id="footer"><!--  fin de footer -->
  </div>
  <!-- fin de #container -->
  </div>
    </body>
</html>
<?php mysql_free_result($rsVendusJour); ?>
