<td align="left" valign="top" width="130">
<table border="0" cellpadding="0" cellspacing="0" width="130">
<tbody><tr>
<td bgcolor="#1881b6" nowrap="nowrap" height="20" valign="middle" width="11"><img src="files/icons_featured_co.gif" height="17" hspace="1" vspace="1" width="20"></td>
<td class="BlockHeaderLeftRight" height="20" width="108">&nbsp;<span id="IndicesLbl">Дата начала</span></td>
<td class="vdots" width="1"></td></tr>
	<?php
	 $today=getdate();
	 if ($_GET["year"]=='') $ye=$today["year"];
	 else $ye=$_GET["year"];
	 if ($_GET["styear"]=='') $styear=$today["year"];
	 else $styear=$_GET["styear"];
	 if ($_GET["enyear"]=='') $enyear=$today["year"];
	 else $enyear=$_GET["enyear"];

	 if ($_GET["start"]=='') $mn=$today["mon"];
	 else $mn=$_GET["start"];
	 if ($_GET["day"]=='') $day=$today["mday"];
	 else $day=$_GET["day"];
	 //echo $styear;
	 for ($pm=1; $pm<=12; $pm++)
	    {
	     $date=sprintf ("%d%02d%02d000000",$ye-1,$pm,1); 
	     $month=$pm; include ("time.inc");
	     if ($pm==$mn && $styear==($today["year"]-1)) print '<tr><td align="center" style="font-family: Verdana; font-size: xx-small; color: #006995"><img alt="" src="files/SideArrow.gif" hspace="3"></td><td bgcolor="#dedede">&nbsp;<a class="clickablebluetext" href="index.php?sel=ecm_all&start='.$pm.'&end='.$_GET["end"].'&date='.$date.'&styear='.($ye-1).'&enyear='.$_GET["enyear"].'">'.$month.', '.($ye-1).'</a></td><td class="vdots"></td></tr>';
	     else print '<tr><td align="center" style="font-family: Verdana; font-size: xx-small; color: #006995"><img alt="" src="files/SideArrow.gif" hspace="3"></td><td>&nbsp;<a class="clickablebluetext" href="index.php?sel=ecm_all&start='.$pm.'&end='.$_GET["end"].'&date='.$date.'&styear='.($ye-1).'&enyear='.$_GET["enyear"].'">'.$month.', '.($ye-1).'</a></td><td class="vdots"></td></tr>';
	    }
	 for ($pm=1; $pm<=12; $pm++)
	    {
	     $date=sprintf ("%d%02d%02d000000",$ye,$pm,1); 
	     $month=$pm; include ("time.inc");
	     if ($pm==$mn && $styear==$today["year"]) print '<tr><td align="center" style="font-family: Verdana; font-size: xx-small; color: #006995"><img alt="" src="files/SideArrow.gif" hspace="3"></td><td bgcolor="#dedede">&nbsp;<a class="clickablebluetext" href="index.php?sel=ecm_all&start='.$pm.'&end='.$_GET["end"].'&date='.$date.'&styear='.($ye).'&enyear='.$_GET["enyear"].'">'.$month.', '.$ye.'</a></td><td class="vdots"></td></tr>';
	     else print '<tr><td align="center" style="font-family: Verdana; font-size: xx-small; color: #006995"><img alt="" src="files/SideArrow.gif" hspace="3"></td><td>&nbsp;<a class="clickablebluetext" href="index.php?sel=ecm_all&start='.$pm.'&end='.$_GET["end"].'&date='.$date.'&styear='.($ye).'&enyear='.$_GET["enyear"].'">'.$month.', '.$ye.'</a></td><td class="vdots"></td></tr>';
	    }	     			
	?>
</table>
<br>
<table border="0" cellpadding="0" cellspacing="0" width="130">
<tbody><tr>
<td bgcolor="#1881b6" nowrap="nowrap" height="20" valign="middle" width="11"><img src="files/icons_featured_co.gif" height="17" hspace="1" vspace="1" width="20"></td>
<td class="BlockHeaderLeftRight" height="20" width="108">&nbsp;<span id="IndicesLbl">Дата конца</span></td>
<td class="vdots" width="1"></td></tr>
	<?php
	 $today=getdate();
	 if ($_GET["year"]=='') $ye=$today["year"];
	 else $ye=$_GET["year"];

	 if ($_GET["styear"]=='') $styear=$today["year"];
	 else $styear=$_GET["styear"];
	 if ($_GET["enyear"]=='') $enyear=$today["year"];
	 else $enyear=$_GET["enyear"];

	 if ($_GET["end"]=='') $mn=$today["mon"];
	 else $mn=$_GET["end"];
	 if ($_GET["day"]=='') $day=$today["mday"];
	 else $day=$_GET["day"];
	 for ($pm=1; $pm<=12; $pm++)
	    {
	     $date=sprintf ("%d%02d%02d000000",$ye-1,$pm,1); 
	     $month=$pm; include ("time.inc");
	     if ($pm==$mn && $styear==($today["year"]-1)) print '<tr><td align="center" style="font-family: Verdana; font-size: xx-small; color: #006995"><img alt="" src="files/SideArrow.gif" hspace="3"></td><td bgcolor="#dedede">&nbsp;<a class="clickablebluetext" href="index.php?sel=ecm_all&start='.$_GET["start"].'&end='.$pm.'&date='.$date.'&styear='.$_GET["styear"].'&enyear='.($ye-1).'">'.$month.', '.($ye-1).'</a></td><td class="vdots"></td></tr>';
	     else print '<tr><td align="center" style="font-family: Verdana; font-size: xx-small; color: #006995"><img alt="" src="files/SideArrow.gif" hspace="3"></td><td>&nbsp;<a class="clickablebluetext" href="index.php?sel=ecm_all&start='.$_GET["start"].'&end='.$pm.'&date='.$date.'&styear='.$_GET["styear"].'&enyear='.($ye-1).'">'.$month.', '.($ye-1).'</a></td><td class="vdots"></td></tr>';
	    }
	 for ($pm=1; $pm<=12; $pm++)
	    {
	     $date=sprintf ("%d%02d%02d000000",$ye,$pm,1); 
	     $date2=sprintf ("%d%02d%02d000000",2010,$pm,1);
	     $month=$pm; include ("time.inc"); 
	     if ($pm==$mn) print '<tr><td align="center" style="font-family: Verdana; font-size: xx-small; color: #006995"><img alt="" src="files/SideArrow.gif" hspace="3"></td><td bgcolor="#dedede">&nbsp;<a class="clickablebluetext" href="index.php?sel=ecm_all&start='.$_GET["start"].'&end='.$pm.'&styear='.$_GET["styear"].'&enyear='.($ye).'">'.$month.', '.$ye.'</a></td><td class="vdots"></td></tr>';
	     else print '<tr><td align="center" style="font-family: Verdana; font-size: xx-small; color: #006995"><img alt="" src="files/SideArrow.gif" hspace="3"></td><td>&nbsp;<a class="clickablebluetext" href="index.php?sel=ecm_all&start='.$_GET["start"].'&end='.$pm.'&styear='.$_GET["styear"].'&enyear='.($ye).'">'.$month.', '.$ye.'</a></td><td class="vdots"></td></tr>';
	    }	     			
	?>
</table></td>
