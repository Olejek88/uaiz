<div id="main" style="width:99%">
<img usemap="#menu" border=0 src="map/map1250.jpg">
<map name="menu">
<?php
/* $query = 'SELECT * FROM uzels';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 //$query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 //$u = mysql_query ($query,$i);
	 //if ($u) $uo = mysql_fetch_row ($u);
	 $x=$ui[6]; $y=$ui[7];
	 print '<area shape="rect" coords="'.$x.','.$y.','.number_format($x+100,0).','.number_format($y+50,0).'" href="index.php?sel=object&id='.$ui[0].'" target="_top" alt="'.$ui[1].'" onFocus="this.blur()">';
	 $ui = mysql_fetch_row ($e);
	} */
?>
</map>
</div>
<?php
 $query = 'SELECT * FROM data WHERE type=0';
 if ($e = mysql_query ($query,$i))
 while ($ui = mysql_fetch_row ($e))
    {
     $x=$y=0;
     if ($ui[9]==659 && $ui[8]==4) { $x=780; $y=410; $tv=number_format($ui[3],2);  } // 659	����������� ������� ������� �������������� 2  
     if ($ui[9]==658 && $ui[8]==4) { $x=780; $y=440; $tv=number_format($ui[3],2);  } // 658	����������� ������� ������� �������������� 1 

     if ($ui[9]==614 && $ui[8]==4) { $x=250; $y=440; $tv=number_format($ui[3],2); }	  // 617	����������� ������� �������� 4  
     if ($ui[9]==615 && $ui[8]==4) { $x=320; $y=440; $tv=number_format($ui[3],2); }	  // 616	����������� ������� �������� 3
     if ($ui[9]==616 && $ui[8]==4) { $x=390; $y=440; $tv=number_format($ui[3],2); }	  // 615	����������� ������� �������� 2
     if ($ui[9]==617 && $ui[8]==4) { $x=460; $y=440; $tv=number_format($ui[3],2); }	  // 614	����������� ������� �������� 1

     if ($ui[9]==606 && $ui[8]==4) { $x=250; $y=650; $tv=number_format($ui[3],2); }	// 606	����������� ������� ��������� 1
     if ($ui[9]==676 && $ui[8]==4) { $x=320; $y=680; $tv=number_format($ui[3],2); }	// 676	����������� ������� ��������� 2 
    
     if ($ui[9]==604 && $ui[8]==4) { $x=1; $y=100; $tv=number_format($ui[3],2); }	  // 604	����������� ������� �� �����

     if ($ui[9]==588 && $ui[8]==4) { $x=1150; $y=650; $tv=number_format($ui[3],2); }  // 588	����������� ������� ������� 2
     if ($ui[9]==587 && $ui[8]==4) { $x=1150; $y=680; $tv=number_format($ui[3],2); } // 587	����������� ������� ������� 2
    
     if ($ui[9]==577 && $ui[8]==4) { $x=0; $y=270; $tv=number_format($ui[3],2); } // 588	����������� ������� ������� 1
     if ($ui[9]==576 && $ui[8]==4) { $x=0; $y=300; $tv=number_format($ui[3],2); } // 587	����������� ������� ������� 1

     if ($ui[9]==560 && $ui[8]==4) { $x=870; $y=200; $tv=number_format($ui[3],2); } // 560	����������� ������� ��� 10
     if ($ui[9]==559 && $ui[8]==4) { $x=870; $y=140; $tv=number_format($ui[3],2); } // 559	����������� ������� ��� 9
     if ($ui[9]==558 && $ui[8]==4) { $x=790; $y=200; $tv=number_format($ui[3],2); } // 558	����������� ������� ��� 8
     if ($ui[9]==557 && $ui[8]==4) { $x=790; $y=140; $tv=number_format($ui[3],2); } // 557	����������� ������� ��� 7
     if ($ui[9]==556 && $ui[8]==4) { $x=710; $y=200; $tv=number_format($ui[3],2); } // 556	����������� ������� ��� 6
     if ($ui[9]==555 && $ui[8]==4) { $x=710; $y=140; $tv=number_format($ui[3],2); } // 555	����������� ������� ��� 5
     if ($ui[9]==554 && $ui[8]==4) { $x=630; $y=200; $tv=number_format($ui[3],2); } // 554	����������� ������� ��� 4
     if ($ui[9]==553 && $ui[8]==4) { $x=630; $y=140; $tv=number_format($ui[3],2); } // 553	����������� ������� ��� 3
     if ($ui[9]==552 && $ui[8]==4) { $x=550; $y=200; $tv=number_format($ui[3],2); } // 552	����������� ������� ��� 2
     if ($ui[9]==551 && $ui[8]==4) { $x=550; $y=140; $tv=number_format($ui[3],2); } // 551	����������� ������� ��� 1

     //$x=$uo[6]-20; $y=$uo[7]+80;
     if ($x>0 || $y>0)
     print '<div id=inf'.$ui[0].' style="position:absolute;top:'.$y.';left:'.$x.';width:60;height:20;margin-left:10;padding-left:10;">
	 <img src="charts/led.php?dat='.number_format($tv,2).'C" width=60 height=20></div>';
    }
?>