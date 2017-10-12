<?php require_once('../Connections/ConnexionAutoJaune.php'); ?>
<?php
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
	
  $logoutGoTo = "../index.php";
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsVendu = 30;
$pageNum_rsVendu = 0;
if (isset($_GET['pageNum_rsVendu'])) {
  $pageNum_rsVendu = $_GET['pageNum_rsVendu'];
}
$startRow_rsVendu = $pageNum_rsVendu * $maxRows_rsVendu;

mysql_select_db($database_ConnexionAutoJaune, $ConnexionAutoJaune);
$query_rsVendu = "SELECT t_vendu.id_vendu, t_client.id_client, t_modele.id_modele, t_fabricant.id_fabricant, t_constructeur.id_constructeur, t_modele.p_photo, t_modele.numero, t_modele.modele, t_fabricant.fabricant, t_constructeur.constructeur, t_modele.achat, t_vendu.prix_de_vente, t_vendu.date_vente, t_client.nom, t_client.prenom, t_vendu.paye FROM t_vendu, t_client, t_modele, t_fabricant, t_constructeur WHERE t_vendu.id_client=t_client.id_client AND t_modele.id_fabricant=t_fabricant.id_fabricant AND t_modele.id_constructeur=t_constructeur.id_constructeur AND t_vendu.numero=t_modele.numero ORDER BY date_vente DESC, nom ASC";
$query_limit_rsVendu = sprintf("%s LIMIT %d, %d", $query_rsVendu, $startRow_rsVendu, $maxRows_rsVendu);
$rsVendu = mysql_query($query_limit_rsVendu, $ConnexionAutoJaune) or die(mysql_error());
$row_rsVendu = mysql_fetch_assoc($rsVendu);

if (isset($_GET['totalRows_rsVendu'])) {
  $totalRows_rsVendu = $_GET['totalRows_rsVendu'];
} else {
  $all_rsVendu = mysql_query($query_rsVendu);
  $totalRows_rsVendu = mysql_num_rows($all_rsVendu);
}
$totalPages_rsVendu = ceil($totalRows_rsVendu/$maxRows_rsVendu)-1;

$queryString_rsVendu = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsVendu") == false && 
        stristr($param, "totalRows_rsVendu") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsVendu = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsVendu = sprintf("&totalRows_rsVendu=%d%s", $totalRows_rsVendu, $queryString_rsVendu);

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<!--<script type="text/javascript">
<!--
window.onload=montre;
function montre(id) {
var d = document.getElementById(id);
	for (var i = 1; i<=10; i++) {
		if (document.getElementById('smenu'+i)) {document.getElementById('smenu'+i).style.display='none';}
	}
if (d) {d.style.display='block';}
}
</script>//-->
<title>AutoJauneParis &gt; Admin &gt;</title>
<link href="../styles/style_admin.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">
  <div id="header">
    <h1><img src="../images/maquette/acceuil02.png" alt="autojauneparis" width="234" height="74">
      <!-- fin de #header -->
    </h1>
  </div>
  <div id="sidebar1">
    <h3><a href="<?php echo $logoutAction ?>">d&eacute;connexion</a>
    </h3>
    <?php include ("../inclus/menu_admin.php"); ?><!--la navigation principale-->
    <p>
      <!-- fin de #sidebar1 -->
    </p>
  </div>
  <div id="mainContent">
    <h1>  vendus /trimestre <?php echo date("Y"); ?> en cours  : <?php echo $totalRows_rsVendu ?> modèles</h1>
    <table border="1" cellpadding="5" cellspacing="5" class="tableau">
      <tr>
        <th>Vignette</th>
        <th>Fabricant, constructeur, <br>
        nom et n°</th>
        <th>Achat</th>
        <th>Prix de vente</th>
        <th>Vendu le…</th>
        <th>Client</th>
        <th>Supprimer</th>
      </tr>
      <?php do { ?>
        <tr>
          <td><div align="center"><img src="../images/petite/<?php echo $row_rsVendu['p_photo']; ?>" alt="pas de photo"><br>
          </div></td>

          <td>
            <p><?php echo $row_rsVendu['fabricant']; ?> -
          <?php echo $row_rsVendu['constructeur']; ?></p>
            <p><?php echo $row_rsVendu['modele']; ?> n° <strong><?php echo $row_rsVendu['numero']; ?></strong></p>
          </td>
          <td>&nbsp;<?php echo $row_rsVendu['achat']; ?></td>
          <td>&nbsp;<?php echo $row_rsVendu['prix_de_vente']; ?> €</td>
          <?php 
	  	list($day, $month, $year) = explode('-', $row_rsVendu['date_vente']);
		$annee=$year;
		$mois=$month;
		$jour=$day;
		$date=$annee.'-'.$mois.'-'.$jour;
	  ?>
          <td><a href="vendus_jour.php?date=<?php echo $date; ?>"><?php echo $date; ?></a></td>
          <td>
            <p><a href="vendus_client.php?id_client=<?php echo $row_rsVendu['id_client']; ?>&date_vente=<?php echo $row_rsVendu['date_vente']; ?>"><?php echo $row_rsVendu['prenom']; ?> <?php echo $row_rsVendu['nom']; ?></a>
            </p>
            <p>payé : <?php echo $row_rsVendu['paye']; ?></p>
            <?php /*?><p><a href="achats_client.php?id_client=<?php echo $row_rsVendu['id_client']; ?>">Tous ses achats</a>
            </p><?php */?>
          </td>
          <td><a href="supr_vendu.php?id_vendu=<?php echo $row_rsVendu['id_vendu']; ?>"><img src="../images/maquette/corbeille.png" border="0"></a>
          </td>
        </tr>
        <?php } while ($row_rsVendu = mysql_fetch_assoc($rsVendu)); ?>
    </table>
    <table border="0">
  <tr>
    <td><?php if ($pageNum_rsVendu > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rsVendu=%d%s", $currentPage, 0, $queryString_rsVendu); ?>">Premier</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_rsVendu > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_rsVendu=%d%s", $currentPage, max(0, $pageNum_rsVendu - 1), $queryString_rsVendu); ?>">Pr&eacute;c&eacute;dent</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_rsVendu < $totalPages_rsVendu) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rsVendu=%d%s", $currentPage, min($totalPages_rsVendu, $pageNum_rsVendu + 1), $queryString_rsVendu); ?>">Suivant</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_rsVendu < $totalPages_rsVendu) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_rsVendu=%d%s", $currentPage, $totalPages_rsVendu, $queryString_rsVendu); ?>">Dernier</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
  </div>
  <!-- Cet élément de suppression doit suivre immédiatement l'élément div #mainContent afin de forcer l'élément div #container à contenir tous les éléments flottants enfants -->
  <br class="clearfloat">
  <div id="footer"><!--    fin de footer -->
  </div>
  <!-- fin de #container -->
</div>
</body>
</html>
<?php

mysql_free_result($rsVendu);

?>
