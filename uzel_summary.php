<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta content="JavaScript" name="vs_defaultClientScript">
<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
<link href="files/BaseStyle.css" type="text/css" rel="stylesheet">
</head>

<?php
 include("config/local.php");
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
 $query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
 $query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
?>

<body bottommargin="0" topmargin="10">
<form name="Form1" method="post" action="uzel_summary.php" id="Form1">
<div>
</div>

<?php
 if ($_GET["obj"]=='') $query = 'SELECT * FROM objects LIMIT 1';
 else $query = 'SELECT * FROM objects WHERE id='.$_GET["obj"];
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 $dat='-';
	 $query = 'SELECT * FROM devices WHERE type=11 AND object='.$ui[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);
	 $query = 'SELECT * FROM data WHERE type=0 AND device='.$uo[11];
	 $y = mysql_query ($query,$i);
	 if ($y) $uy = mysql_fetch_row ($y);
	 while ($uy)
		{
		 if ($uy[8]==4 && $uy[6]==0 && !$tpod) $tpod=$uy[3];
		 if ($uy[8]==4 && $uy[6]==1 && !$tobr) $tobr=$uy[3];
		 if ($uy[8]==11 && $uy[6]==0 && !$vpod) $vpod=$uy[3];
		 if ($uy[8]==11 && $uy[6]==1 && !$vobr) $vobr=$uy[3];
		 if ($uy[8]==13 && $uy[6]==10 && !$qpod) $qpod=$uy[3];
		 if ($uy[8]==13 && $uy[6]==11 && !$qobr) $qobr=$uy[3];
		 if ($uy[8]==13 && $uy[6]==2 && !$qpot) $qpot=$uy[3];
		 if ($uy[8]==12 && $uy[6]==5 && !$vgvs) $vgvs=$uy[3];
		 if ($uy[8]==12 && $uy[6]==6 && !$vhvs) $vhvs=$uy[3];
		 if ($uy[8]==16 && $uy[6]==10 && !$phvs) $phvs=$uy[3];
		 if ($uy[8]==16 && $uy[6]==0 && !$vgvs) $p1=$uy[3];
		 if ($uy[8]==16 && $uy[6]==1 && !$vhvs) $p2=$uy[3];
		 if ($dat=='-') $dat=$uy[2];
		 $uy = mysql_fetch_row ($y);
		}	 
	 $ui = mysql_fetch_row ($e);
	}
?>

<table id="Table0" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
	<td nowrap="nowrap" width="35%">
	<a id="lblMarketName" href="" target="_top" style="font-size: x-small; font-weight: bold;"></a></td>
	<td align="right" nowrap="nowrap" width="15%">
	<a id="MarketwatchHL" class="BlueText" href="" target="_parent" style="font-size: xx-small;">Полная информация&nbsp;|</a>
	<a id="SectorHL" class="BlueText" href="index.php?sel=objects" target="_parent" style="font-size: xx-small;">&nbsp;Все узлы учета</a>
	<img src="files/moredetails.gif"></td>
	</tr>
	</tbody></table>

	<table id="Table1" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody><tr>
	<td class="DashedLine" nowrap="nowrap" width="35%"><span id="Label7" class="BlueText">Текущие показания</span></td>
	<td class="DashedLine" nowrap="nowrap">&nbsp;</td>
	<td class="DashedLine" nowrap="nowrap" width="50%"><span id="CurrentLbl" class="BlackText">ЭЭ 1,475.10 кВт / Газ 1,475.10 м3</span>&nbsp;</td>
	</tr>
	<tr>
	<td class="DashedLine" nowrap="nowrap" width="35%"><span id="Label8" class="BlueText">Предыдущий период</span></td>
	<td class="DashedLine" nowrap="nowrap">&nbsp;</td>
	<td class="DashedLine" nowrap="nowrap" width="50%"><span id="PevLbl" class="BlackText">ЭЭ 1,466.66 кВт / Газ 1,466.66 м3</span>&nbsp;</td>
	<td class="DashedLine" width="15%">&nbsp;</td>
	</tr>

	<tr>
	<td class="DashedLine" nowrap="nowrap" width="35%"><span id="Label9" class="BlueText">Изменение</span></td>
	<td class="DashedLine" nowrap="nowrap">
	<img id="imgChange" src="files/up.gif" style="border-width: 0px; height: 16px; width: 16px;"></td>
	<td class="DashedLine" nowrap="nowrap" width="50%"><span id="ChangeLbl" class="BlackText">8.44</span>&nbsp;
	<span id="lblChangePer" class="blackText">0.58%</span></td>
	<td class="DashedLine" width="15%">&nbsp;</td>
	</tr>
	</tbody></table>
	<hr noshade="noshade" size="1" width="100%">

			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody><tr>
					<td nowrap="nowrap" width="35%"><span id="Label10" class="BlueText">Накопительные итоги</span></td>
					<td nowrap="nowrap">&nbsp;</td>
					<td nowrap="nowrap" width="70%"><span id="VolumeLbl" class="BlackText">79,050</span></td>
				</tr>
				<tr>
					<td class="DashedLine" nowrap="nowrap" width="35%"><span id="Label11" class="BlueText">Среднее значение за месяц</span></td>
					<td class="DashedLine" nowrap="nowrap" width="16">&nbsp;</td>
					<td class="DashedLine" nowrap="nowrap" width="70%"><span id="AverageLbl" class="BlackText">2,203,169</span>&nbsp;
					</td>
				</tr>
				<tr>
					<td class="DashedLine" nowrap="nowrap" width="30%"><span id="Label20" class="BlueText"> Минимальное значение за месяц</span></td>
					<td class="DashedLine" nowrap="nowrap" width="16">&nbsp;</td>
					<td class="DashedLine" nowrap="nowrap" width="70%"><span id="LowLbl" class="BlackText">1,361.12 [12 февраля 2011]</span>&nbsp;&nbsp;
				</tr>
				<tr>
					<td class="DashedLine" nowrap="nowrap" width="30%"><span id="Label20" class="BlueText"> Максимальное значение за месяц</span></td>
					<td class="DashedLine" nowrap="nowrap" width="16">&nbsp;</td>
					<td class="DashedLine" nowrap="nowrap" width="70%"><span id="LowLbl" class="BlackText">1,529.21 [17 февраля 2011]</span>&nbsp;&nbsp;
				</tr>
			</tbody></table>
			<hr noshade="noshade" size="0" width="100%">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tbody><tr>
			<td colspan="3" nowrap="nowrap" width="100%">&nbsp;
			<span id="Label1" class="BlueText" style="font-size: xx-small;">Данные на:</span>&nbsp;<span id="lastUpdateLbl" class="BlackText">17/02/2011 13:03</span>&nbsp;
			<input name="ImageButton1" id="ImageButton1" src="files/refresh.gif" alt="Refresh" style="border-width: 0px;" type="image"></td>
			</tr>
			</tbody></table>
		</form>
	</body></html>