<?php                                                                             
 $query = 'SELECT * FROM uzels WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 if ($ui) { $name=$ui[1]; }
?>
<td align="left" valign="top" width="200">
<table id="Table1" border="0" cellpadding="0" cellspacing="0" width="200">
	<tbody><tr>
	<td bgcolor="#1881b6" nowrap="nowrap" height="20" valign="middle" width="21"><img src="files/icons_login.gif" height="17" hspace="1" vspace="1" width="20"></td>
	<td class="BlockHeaderLeftRight" height="20" width="178">&nbsp;<span id="IndicesLbl">”злы учета</span></td>
	<td class="vdots" width="1"></td></tr>
	<tr><td colspan="3" style="height:5px"></td></tr>
	<?php
	 $query = 'SELECT * FROM uzels';
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 while ($ui)
		{	 
		 print '<tr style="font-family: Verdana; font-size: xx-small; color: #006995"><td colspan=3 style="padding-left:5px"><a href="index.php?sel=uzels&id='.$ui[0].'" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">'.$ui[1].'</a></td></tr>
			<tr><td colspan="3" style="height:5px"></td></tr>';
	         $ui = mysql_fetch_row ($e);
		}
	?>
</table></td>
<td style="padding-right: 3px; padding-left: 1px; margin-left: 1px; margin-right: 3px;" align="center" valign="top" width="100%">
<table id="Table8" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr><td height="30">
	<table id="Table5" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody><tr>
		<td class="ActiveTabsBorder" id="TD_Profile1" style="height: 34px;" align="center" height="34" valign="baseline"><span id="ProfileSummaryLbl" class="ClickableBlueText" onclick="ChangeTabPS('Profile', '1',10, 'ProfileFrame', 'uzels_summary.php?id=<?php print $_GET["id"]; ?>');" style="font-size:XX-Small;">—уммарно по узлу учета</span></td>
		<td class="InActiveTabsBorder" id="TD_Profile2" style="height: 34px;" align="center" height="34" valign="baseline"><span id="PricePerformanceLbl" class="ClickableBlueText" onclick="ChangeTabPS('Profile', '2',10, 'ProfileFrame', 'index.php?sel=uzels&mn=2&id=<?php print $_GET["id"]; ?>')" style="font-size:XX-Small;">Ё—ћ, каналы измерени€</span></td>
		<td class="InActiveTabsBorder" id="TD_Profile3" style="height: 34px;" align="center" height="34" valign="baseline"><span id="FinancialHighlightsLbl" class="ClickableBlueText" onclick="ChangeTabPS('Profile', '3',10, 'ProfileFrame', 'index.php?sel=uzels&mn=3&id=<?php print $_GET["id"]; ?>')" style="font-size:XX-Small;">Ёффективность</span></td>
		<td class="InActiveTabsBorder" id="TD_Profile4" style="height: 34px;" align="center" height="34" valign="baseline"><a href="index.php?sel=uzels_mnem&id=<?php print $_GET["id"]; ?>"><span id="TechnicalAnalysisLbl" class="ClickableBlueText" style="font-size:XX-Small;">ћнемосхема узла</span></a></td>
		</tr>
	<tr>
	<td colspan="10" bgcolor="#fafcfb">
	<table class="TableBorder" id="Table6" border="0" width="100%">
	<tbody><tr>
	<td align="right" bgcolor="#fafcfb">&nbsp; <img id="full" onclick="ShowHidePan('full');" alt="Full Screen Mode" src="files/imagesfullScreen1.jpg">&nbsp;
	<img id="normal" onclick="ShowHidePan('normal');" alt="Normal Mode" src="files/imagesnormalScreen.jpg">
	<br>
	<iframe id="ProfileSummaryFrame" style="width: 100%;" name="ProfileFrame" src="uzels_summary.php?id=<?php print $_GET["id"]; ?>" height="1400" width="100%"></iframe>

</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table></td>
