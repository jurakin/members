<? define("__HIDE_TEST__", "_KeAr_PHP_WEB_"); ?>
<?php
@extract($_REQUEST);

require ("./connect.inc.php");
require ("./sess.inc.php");

if (!IsLogged())
{
	header("location: ".$g_baseadr."error.php?code=21");
	exit;
}

db_Connect();

$id_zav = (IsSet($id_zav) && is_numeric($id_zav)) ? (int)$id_zav : 0;
$id_us = (IsSet($id_us) && is_numeric($id_us)) ? (int)$id_us : 0;

@$vysledek2=MySQL_Query("SELECT * FROM ".TBL_USER." where id=$id_us");
$entry_lock = false;
if ($zaznam2=MySQL_Fetch_Array($vysledek2))
{
	$entry_lock = ($zaznam2['entry_locked'] != 0);
}

if (!$entry_lock)
{
	@$vysledek=MySQL_Query("DELETE FROM ".TBL_ZAVXUS." WHERE id_zavod = '$id_zav' AND id_user = '$id_us'");
}
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
	window.opener.location.reload();

	window.opener.focus();
	window.close();
//-->
</SCRIPT>