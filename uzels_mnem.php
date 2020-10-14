<meta http-equiv="refresh" content="85,http://212.57.156.94:81/index.php?sel=uzels_mnem&id=<?php print $_GET["id"]; ?>">
<table><tr><td valign="top">
<?php
 $query = 'SELECT * FROM uzels WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 if ($ui) { $name=$ui[1]; $mnem=$ui[3]; }
 print '<img usemap="#menu" border=0 src="'.$mnem.'">';
?>
</td><td valign="top">
<table align="center" border="0" cellpadding="0" cellspacing="1" width="100%">
<tr class="BlockHeaderLeftRight" align="center"><td style="white-space:nowrap">Время</td>
<?php
 $query = 'SELECT * FROM uzels WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i); $cn=0;
 if ($e) $ui = mysql_fetch_row ($e);
 $uzel=$ui[0];

 $query = 'SELECT * FROM devices WHERE object='.$uzel;
 $cn=0;
 if ($e = mysql_query ($query,$i))
 while ($ui = mysql_fetch_row ($e))
	{
 	 $query = 'SELECT * FROM channels WHERE opr>0 AND device='.$ui[11];
	 $e2 = mysql_query ($query,$i);
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 while ($uo)
		{
		 print '<td>'.$uo[15].'</td>';
		 $prm[$cn]=$uo[9]; $src[$cn]=$uo[10]; $chan[$cn]=$uo[0];
		 $uo = mysql_fetch_row ($e2); $cn++;
		}
	}
 print '</tr>';
 $maxcn=$cn;
 
 $today=getdate();
 $ye=$today["year"];
 $mn=$today["mon"];
 $x=0; $nn=1; $ts=$today["hours"];
 if ($ts>1) $ts-=2;
 $tm=$dy=$today["mday"];
 $max=24;
 for ($tn=0; $tn<=$max; $tn++)
	{
	 $date1[$tn]=sprintf ("%d%02d%02d%02d0000",$ye,$mn,$tm,$ts);
	 $dat[$tn]=sprintf ("%d-%02d-%02d %02d:00:00",$ye,$mn,$tm,$ts);
	 $data0[$tn]=$data1[$tn]=$data2[$tn]=$data3[$tn]=$data4[$tn]=$data5[$tn]=$data6[$tn]=$data7[$tn]=$data8[$tn]=$data9[$tn]='-';
         if ($tm==1 && $ts==0)
		{
		 $mn--; $ts=24;
		 $dy=31;
		 if (!checkdate ($mn,31,$ye)) { $dy=30; }
		 if (!checkdate ($mn,30,$ye)) { $dy=29; }
		 if (!checkdate ($mn,29,$ye)) { $dy=28; }
		 $tm=$dy;
	        }
	 if ($ts==0) { $ts=24; $tm--; }
	 $ts--;
	}

 $query = 'SELECT * FROM hours WHERE type=1 ORDER BY date DESC LIMIT 10000';
//echo $query;
 $a = mysql_query ($query,$i);
 if ($a) $uy = mysql_fetch_row ($a);
 while ($uy)
      	{
	 $x=$max+1; $c=$maxcn+1;
	 for ($tn=0; $tn<=$max; $tn++)
	 if ($uy[2]==$dat[$tn]) $x=$tn;
	 for ($cn=0; $cn<$maxcn; $cn++)
	 if ($uy[9]==$chan[$cn]) $c=$cn;
       	 $data[$c][$x]=number_format($uy[3],3);
       	 $uy = mysql_fetch_row ($a);
      	}
 for ($tn=0; $tn<=$max; $tn++)
	{
	 print '<tr><td align=center class="BlockHeaderLeftRight" style="padding-left:5px; padding-right:5px; white-space:nowrap">'.$dat[$tn].'</td>';
	 for ($cn=0; $cn<$maxcn; $cn++)
	  	    if ($data[$cn][$tn]) print '<td align=center bgcolor=#ffffff class="simple">'.$data[$cn][$tn].'</td>';
	 print '</tr>';
       }

?>
</table>
</td></tr></table>
<style type="text/css">
div
{
	font-weight: bold;
	font-size: 14px;
	color: #003300;
	font-family: Verdana;
}
</style>

<?php
 $query = 'SELECT * FROM data WHERE type=0 OR type=1 OR type=5';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{	 
	 if ($ui[1]==0 && $ui[8]==2)
		{
		 if ($ui[9]==675 && $ui[8]==2) $gvklgru3=$ui[3];  // 675	Состояние нагревателя горелка ГРУ 3
		 if ($ui[9]==674 && $ui[8]==2) $gvklgru2=$ui[3];  // 674	Состояние нагревателя горелка ГРУ 2
		 if ($ui[9]==673 && $ui[8]==2) $gvklgru1=$ui[3];  // 673	Состояние нагревателя горелка ГРУ 1

		 if ($ui[9]==672 && $ui[8]==2) $vvklgru3=$ui[3];  // 672	Состояние нагревателя вентилятор ГРУ 3
		 if ($ui[9]==671 && $ui[8]==2) $vvklgru2=$ui[3];  // 671	Состояние нагревателя вентилятор ГРУ 2
		 if ($ui[9]==670 && $ui[8]==2) $vvklgru1=$ui[3];  // 670	Состояние нагревателя вентилятор ГРУ 1

		 if ($ui[9]==663 && $ui[8]==2) $gvklfab2=number_format($ui[3],2);  // 663	Состояние нагревателя горелка участок полуфабрикатов 2
		 if ($ui[9]==662 && $ui[8]==2) $gvklfab1=number_format($ui[3],2);  // 662	Состояние нагревателя горелка участок полуфабрикатов 1
		 if ($ui[9]==661 && $ui[8]==2) $vvklfab2=number_format($ui[3],2);  // 661	Состояние нагревателя вентилятор участок полуфабрикатов 2
		 if ($ui[9]==660 && $ui[8]==2) $vvklfab1=number_format($ui[3],2);  // 660	Состояние нагревателя вентилятор участок полуфабрикатов 1

		 if ($ui[9]==647 && $ui[8]==2) $gvkloto4=number_format($ui[3],2);  // 647	Состояние нагревателя горелка отопление 4
		 if ($ui[9]==646 && $ui[8]==2) $gvkloto3=number_format($ui[3],2);  // 646	Состояние нагревателя горелка отопление 3
		 if ($ui[9]==645 && $ui[8]==2) $gvkloto2=number_format($ui[3],2);  // 645	Состояние нагревателя горелка отопление 2
		 if ($ui[9]==644 && $ui[8]==2) $gvkloto1=number_format($ui[3],2);  // 644	Состояние нагревателя горелка отопление 1
		 if ($ui[9]==643 && $ui[8]==2) $vvkloto4=number_format($ui[3],2);  // 643	Состояние нагревателя вентилятор отопление 4
		 if ($ui[9]==642 && $ui[8]==2) $vvkloto3=number_format($ui[3],2);  // 642	Состояние нагревателя вентилятор отопление 3
		 if ($ui[9]==641 && $ui[8]==2) $vvkloto2=number_format($ui[3],2);  // 641	Состояние нагревателя вентилятор отопление 2
		 if ($ui[9]==640 && $ui[8]==2) $vvkloto1=number_format($ui[3],2);  // 640	Состояние нагревателя вентилятор отопление 1

		 if ($ui[9]==638 && $ui[8]==2) $gvklglz2=number_format($ui[3],2);  // 638	Состояние нагревателя горелка глазуровка 2
		 if ($ui[9]==637 && $ui[8]==2) $gvklglz1=number_format($ui[3],2);  // 637	Состояние нагревателя горелка глазуровка 1
		 if ($ui[9]==636 && $ui[8]==2) $vvklglz2=number_format($ui[3],2);  // 636	Состояние нагревателя вентилятор глазуровка 2
		 if ($ui[9]==635 && $ui[8]==2) $vvklglz1=number_format($ui[3],2);  // 635	Состояние нагревателя вентилятор глазуровка 1

		 if ($ui[9]==625 && $ui[8]==2) $gvklfor4=number_format($ui[3],2);  // 625	Состояние нагревателя горелка формовка 4
		 if ($ui[9]==624 && $ui[8]==2) $gvklfor3=number_format($ui[3],2);  // 624	Состояние нагревателя горелка формовка 3
		 if ($ui[9]==623 && $ui[8]==2) $gvklfor2=number_format($ui[3],2);  // 623	Состояние нагревателя горелка формовка 2
		 if ($ui[9]==622 && $ui[8]==2) $gvklfor1=number_format($ui[3],2);  // 622	Состояние нагревателя горелка формовка 1
		 if ($ui[9]==621 && $ui[8]==2) $vvklfor4=number_format($ui[3],2);  // 621	Состояние нагревателя вентилятор формовка 4
		 if ($ui[9]==620 && $ui[8]==2) $vvklfor3=number_format($ui[3],2);  // 620	Состояние нагревателя вентилятор формовка 3
		 if ($ui[9]==619 && $ui[8]==2) $vvklfor2=number_format($ui[3],2);  // 619	Состояние нагревателя вентилятор формовка 2
		 if ($ui[9]==618 && $ui[8]==2) $vvklfor1=number_format($ui[3],2);  // 618	Состояние нагревателя вентилятор формовка 1

		 if ($ui[9]==612 && $ui[8]==2) $gvklarm3=number_format($ui[3],2);  // 612	Состояние нагревателя горелка армировка 3
		 if ($ui[9]==611 && $ui[8]==2) $gvklarm2=number_format($ui[3],2);  // 611	Состояние нагревателя горелка армировка 2
		 if ($ui[9]==610 && $ui[8]==2) $gvklarm1=number_format($ui[3],2);  // 610	Состояние нагревателя горелка армировка 1
		 if ($ui[9]==609 && $ui[8]==2) $vvklarm3=number_format($ui[3],2);  // 609	Состояние нагревателя вентилятор армировка 3
		 if ($ui[9]==608 && $ui[8]==2) $vvklarm2=number_format($ui[3],2);  // 608	Состояние нагревателя вентилятор армировка 2
		 if ($ui[9]==607 && $ui[8]==2) $vvklarm1=number_format($ui[3],2);  // 607	Состояние нагревателя вентилятор армировка 1

		 if ($ui[9]==601 && $ui[8]==2) $vklkot2=number_format($ui[3],2);	  // 601	Состояние котла котельная
		 if ($ui[9]==600 && $ui[8]==2) $vklkot1=number_format($ui[3],2);	  // 600	Состояние котла котельная

		 if ($ui[9]==592 && $ui[8]==2) $v2vklkot4=number_format($ui[3],2); // 592	Состояние котла 4 бойлера 2
		 if ($ui[9]==591 && $ui[8]==2) $v2vklkot3=number_format($ui[3],2); // 591	Состояние котла 3 бойлера 2
		 if ($ui[9]==590 && $ui[8]==2) $v2vklkot2=number_format($ui[3],2); // 590	Состояние котла 2 бойлера 2
		 if ($ui[9]==589 && $ui[8]==2) $v2vklkot1=number_format($ui[3],2); // 589	Состояние котла 1 бойлера 2

		 if ($ui[9]==581 && $ui[8]==2) $v1vklkot4=number_format($ui[3],2); // 592	Состояние котла 4 бойлера 1
		 if ($ui[9]==580 && $ui[8]==2) $v1vklkot3=number_format($ui[3],2); // 591	Состояние котла 3 бойлера 1
		 if ($ui[9]==579 && $ui[8]==2) $v1vklkot2=number_format($ui[3],2); // 590	Состояние котла 2 бойлера 1
		 if ($ui[9]==578 && $ui[8]==2) $v1vklkot1=number_format($ui[3],2); // 589	Состояние котла 1 бойлера 1

		 if ($ui[9]==570 && $ui[8]==2) $g1vklmzu=number_format($ui[3],2);  // 570	Состояние горелки Zenith 5
		 if ($ui[9]==569 && $ui[8]==2) $v1vklmzu=number_format($ui[3],2);  // 569	Состояние вентилятора Zenith 5
		 if ($ui[9]==568 && $ui[8]==2) $g1vklmzu=number_format($ui[3],2);  // 568	Состояние горелки Zenith 4
		 if ($ui[9]==567 && $ui[8]==2) $v1vklmzu=number_format($ui[3],2);  // 567	Состояние вентилятора Zenith 4
		 if ($ui[9]==566 && $ui[8]==2) $g1vklmzu=number_format($ui[3],2);  // 566	Состояние горелки Zenith 3
		 if ($ui[9]==565 && $ui[8]==2) $v1vklmzu=number_format($ui[3],2);  // 565	Состояние вентилятора Zenith 3
		 if ($ui[9]==564 && $ui[8]==2) $g1vklmzu=number_format($ui[3],2);  // 564	Состояние горелки Zenith 2
		 if ($ui[9]==563 && $ui[8]==2) $v1vklmzu=number_format($ui[3],2);  // 563	Состояние вентилятора Zenith 2
		 if ($ui[9]==562 && $ui[8]==2) $g1vklmzu=number_format($ui[3],2);  // 562	Состояние горелки Zenith 1
		 if ($ui[9]==561 && $ui[8]==2) $v1vklmzu=number_format($ui[3],2);  // 561	Состояние вентилятора Zenith 1

		 if ($ui[9]==549 && $ui[8]==2) $gvklmzu2=number_format($ui[3],2);  // 549	Состояние теплогенератора МЗУ 2
		 if ($ui[9]==546 && $ui[8]==2) $gvklmzu1=number_format($ui[3],2);  // 546	Состояние теплогенератора МЗУ 1
		}
	 if ($ui[1]==5)
		{
		 //echo $ui[9].' '.$ui[8].' '.$ui[3].'<br>';
		 if ($ui[9]==582 && $ui[8]==12 && !$vsboi2) $vsboi2=number_format($ui[3],2).' м3';	// 582	Расход воды бойлер 2
		 //if ($ui[9]==583 && $ui[8]==11 && !$qsboi2) $qsboi2=number_format($ui[3],2).' м3';	// 583	Расход газа бойлер 2
		 if ($ui[9]==573 && $ui[8]==14 && !$w11) $w11=number_format($ui[3],2);   		// 573	Расход электроэнергии бойлер 1
		 if ($ui[9]==571 && $ui[8]==12 && !$vsboi1) $vsboi1=number_format($ui[3],2).' м3';    	// 571	Расход воды бойлер 1
		 if ($ui[9]==572 && $ui[8]==11 && !$qsboi1) $qsboi1=number_format($ui[3],2).' м3';	// 572	Расход газа бойлер 1
		 if ($ui[9]==584 && $ui[8]==14 && !$w2) $w2=number_format($ui[3],2).' kWt';    		// 584	Расход электроэнергии бойлер 2
		}

	 if ($ui[9]==669 && $ui[8]==4) $tsh4=number_format($ui[3],2);  	  // 669	Температура шликера 4
	 if ($ui[9]==668 && $ui[8]==4) $tsh3=number_format($ui[3],2);  	  // 668	Температура шликера 3

	 if ($ui[9]==667 && $ui[8]==4) $tgru=number_format($ui[3],2);  	  // 667	Температура газа ГРУ
	 if ($ui[9]==666 && $ui[8]==14) $wgru=number_format($ui[3],2);    // 666	Расход электроэнергии ГРУ
	 if ($ui[9]==665 && $ui[8]==11) $qgru=number_format($ui[3],2);    // 665	Расход газа ГРУ
	 if ($ui[9]==664 && $ui[8]==16) $pgru=number_format($ui[3],2);    // 664	Давление газа ГРУ

	 if ($ui[9]==659 && $ui[8]==4) $tfab_v1=number_format($ui[3],2);  // 659	Температура воздуха участок полуфабрикатов 2  
	 if ($ui[9]==658 && $ui[8]==4) $tfab_v2=number_format($ui[3],2);  // 658	Температура воздуха участок полуфабрикатов 1 

	 if ($ui[9]==657 && $ui[8]==14) $wfab=number_format($ui[3],2);     // 657	Расход электроэнергии участок полуфабрикатов

	 if ($ui[9]==656 && $ui[8]==4) $ts33=number_format($ui[3],2).' C'; // 656	Температура сушила 2 зоны 3 
	 if ($ui[9]==655 && $ui[8]==4) $ts32=number_format($ui[3],2).' C'; // 655	Температура сушила 2 зоны 2
	 if ($ui[9]==654 && $ui[8]==4) $ts31=number_format($ui[3],2).' C'; // 654	Температура сушила 2 зоны 1
	 if ($ui[9]==653 && $ui[8]==4) $ts23=number_format($ui[3],2).' C'; // 653	Температура сушила 2 зоны 3 
	 if ($ui[9]==652 && $ui[8]==4) $ts22=number_format($ui[3],2).' C'; // 652	Температура сушила 2 зоны 2
	 if ($ui[9]==651 && $ui[8]==4) $ts21=number_format($ui[3],2).' C'; // 651	Температура сушила 2 зоны 1
	 if ($ui[9]==650 && $ui[8]==4) $ts13=number_format($ui[3],2).' C'; // 650	Температура сушила 1 зоны 3
	 if ($ui[9]==649 && $ui[8]==4) $ts12=number_format($ui[3],2).' C'; // 649	Температура сушила 1 зоны 2
	 if ($ui[9]==648 && $ui[8]==4) $ts11=number_format($ui[3],2).' C'; // 648	Температура сушила 1 зоны 1

	 if ($ui[9]==639 && $ui[8]==14) $elec9=number_format($ui[3],2);    // 639	Расход электроэнергии тепловеи на отопление

	 if ($ui[9]==677 && $ui[8]==4) $ts4=number_format($ui[3],2);       // 677	Температура технология глазуровка 4
	 if ($ui[9]==634 && $ui[8]==4) $ts3=number_format($ui[3],2);       // 634	Температура технология глазуровка 3
	 if ($ui[9]==633 && $ui[8]==4) $ts2=number_format($ui[3],2);       // 633	Температура технология глазуровка 2
	 if ($ui[9]==632 && $ui[8]==4) $ts1=number_format($ui[3],2);       // 632	Температура технология глазуровка 1
	 if ($ui[9]==631 && $ui[8]==4) $ttfz13=number_format($ui[3],2);    // 631	Температура на сушила глазуровка 6
	 if ($ui[9]==630 && $ui[8]==4) $ttfz12=number_format($ui[3],2);    // 630	Температура на сушила глазуровка 5
	 if ($ui[9]==629 && $ui[8]==4) $ttfz11=number_format($ui[3],2);    // 629	Температура на сушила глазуровка 4
	 if ($ui[9]==628 && $ui[8]==4) $ttfz23=number_format($ui[3],2);    // 628	Температура на сушила глазуровка 3
	 if ($ui[9]==627 && $ui[8]==4) $ttfz22=number_format($ui[3],2);    // 627	Температура на сушила глазуровка 2
	 if ($ui[9]==626 && $ui[8]==4) $ttfz21=number_format($ui[3],2);    // 626	Температура на сушила глазуровка 1

	 if ($ui[9]==617 && $ui[8]==4) $tfrm_v4=number_format($ui[3],2);	  // 617	Температура воздуха формовка 4  
	 if ($ui[9]==616 && $ui[8]==4) $tfrm_v3=number_format($ui[3],2);	  // 616	Температура воздуха формовка 3
	 if ($ui[9]==615 && $ui[8]==4) $tfrm_v2=number_format($ui[3],2);	  // 615	Температура воздуха формовка 2
	 if ($ui[9]==614 && $ui[8]==4) $tfrm_v1=number_format($ui[3],2);	  // 614	Температура воздуха формовка 1

	 if ($ui[9]==613 && $ui[8]==14) $elec6=number_format($ui[3],2);    // 613	Расход электроэнергии формовка

	 if ($ui[9]==606 && $ui[8]==4) $tarm_v1=number_format($ui[3],2).' C';	// 606	Температура воздуха армировка 1
	 if ($ui[9]==605 && $ui[8]==14) $elec3=number_format($ui[3],2);    	// 605	Расход электроэнергии армировка
	 if ($ui[9]==676 && $ui[8]==4) $tarm_v2=number_format($ui[3],2).' C';	// 676	Температура воздуха армировка 2 

	 if ($ui[9]==604 && $ui[8]==4) $tnv=number_format($ui[3],2);	  // 604	Температура воздуха на улице

	 if ($ui[9]==603 && $ui[8]==4) $vkot2=number_format($ui[3],2);	  // 603	Расход воды котельная
	 if ($ui[9]==599 && $ui[8]==4) $pkot2=number_format($ui[3],2);	  // 599	Давление газа котельная
	 if ($ui[9]==597 && $ui[8]==4) $qkot2=number_format($ui[3],2);	  // 597	Расход газа котельная
	 if ($ui[9]==595 && $ui[8]==4) $tkot2=number_format($ui[3],2);	  // 595	Температура газа котельная
	 if ($ui[9]==602 && $ui[8]==4) $vkot1=number_format($ui[3],2);	  // 602	Расход воды котельная
	 if ($ui[9]==598 && $ui[8]==4) $pkot1=number_format($ui[3],2);	  // 598	Давление газа котельная
	 if ($ui[9]==596 && $ui[8]==4) $qkot1=number_format($ui[3],2);	  // 596	Расход газа котельная
	 if ($ui[9]==594 && $ui[8]==4) $tkot1=number_format($ui[3],2);	  // 594	Температура газа котельная

	 if ($ui[9]==593 && $ui[8]==14) $elec1=number_format($ui[3],2);    // 593	Расход электроэнергии котельная

	 if ($ui[9]==588 && $ui[8]==4) $tkot2_v2=number_format($ui[3],2);  // 588	Температура воздуха душевые 2
	 if ($ui[9]==587 && $ui[8]==4) $tkot2_v1=number_format($ui[3],2);  // 587	Температура воздуха душевые 2

	 if ($ui[9]==584 && $ui[8]==14 && !$elec2) $elec2=number_format($ui[3],2);    	// 584	Расход электроэнергии бойлер 2
	 if ($ui[9]==582 && $ui[8]==12 && !$vboi2) $vboi2=number_format($ui[3],2).' м3';// 582	Расход воды бойлер 2
	 //if ($ui[9]==583 && $ui[8]==11 && !$qboi2) $qboi2=number_format($ui[3],2).' м3';// 583	Расход газа бойлер 2

	 if ($ui[9]==577 && $ui[8]==4) $tkot1_v2=number_format($ui[3],2).' C';  // 588	Температура воздуха душевые 1
	 if ($ui[9]==576 && $ui[8]==4) $tkot1_v1=number_format($ui[3],2).' C';  // 587	Температура воздуха душевые 1

	 if ($ui[9]==573 && $ui[8]==14 && !$elec11) $elec11=number_format($ui[3],2);   		// 573	Расход электроэнергии бойлер 1
	 if ($ui[9]==571 && $ui[8]==12 && !$vboi1) $vboi1=number_format($ui[3],2).' м3';    	// 571	Расход воды бойлер 1
	 if ($ui[9]==572 && $ui[8]==11 && !$qboi1) $qboi1=number_format($ui[3],2).' м3';	// 572	Расход газа бойлер 1

	 if ($ui[9]==560 && $ui[8]==4) $tmzu_v10=number_format($ui[3],2);  // 560	Температура воздуха МЗУ 10
	 if ($ui[9]==559 && $ui[8]==4) $tmzu_v9=number_format($ui[3],2);   // 559	Температура воздуха МЗУ 9
	 if ($ui[9]==558 && $ui[8]==4) $tmzu_v8=number_format($ui[3],2);   // 558	Температура воздуха МЗУ 8
	 if ($ui[9]==557 && $ui[8]==4) $tmzu_v7=number_format($ui[3],2);   // 557	Температура воздуха МЗУ 7
	 if ($ui[9]==556 && $ui[8]==4) $tmzu_v6=number_format($ui[3],2);   // 556	Температура воздуха МЗУ 6
	 if ($ui[9]==555 && $ui[8]==4) $tmzu_v5=number_format($ui[3],2);   // 555	Температура воздуха МЗУ 5
	 if ($ui[9]==554 && $ui[8]==4) $tmzu_v4=number_format($ui[3],2);   // 554	Температура воздуха МЗУ 4
	 if ($ui[9]==553 && $ui[8]==4) $tmzu_v3=number_format($ui[3],2);   // 553	Температура воздуха МЗУ 3
	 if ($ui[9]==552 && $ui[8]==4) $tmzu_v2=number_format($ui[3],2);   // 552	Температура воздуха МЗУ 2
	 if ($ui[9]==551 && $ui[8]==4) $tmzu_v1=number_format($ui[3],2);   // 551	Температура воздуха МЗУ 1

	 if ($ui[9]==548 && $ui[8]==4) $tsh2=number_format($ui[3],2);  	  // 548	Температура шликера 2
	 if ($ui[9]==547 && $ui[8]==4) $tsh1=number_format($ui[3],2);  	  // 547	Температура шликера 1

	 if ($ui[9]==545 && $ui[8]==4 && !$elec7) $elec7=number_format($ui[3],2).' кВт/ч'; 	// 545 	Расход электроэнергии МЗУ

	 $ui = mysql_fetch_row ($e);
	}

 if ($_GET["id"]==8)
	{
	 // t dush
	 print '<div id="tt1" style="position:absolute;top:180;left:450;width:150;height:30">W='.$elec11.'</div>'; 
	 print '<div id="tt2" style="position:absolute;top:250;left:450;width:100;height:30">V='.$vboi1.'</div>'; 
	 print '<div id="tt2" style="position:absolute;top:250;left:50;width:100;height:30">Q='.$qboi1.'</div>'; 
	 print '<div id="tt2" style="position:absolute;top:130;left:100;width:100;height:30">T='.$tkot1_v1.' C</div>';
	 print '<div id="tt2" style="position:absolute;top:130;left:400;width:100;height:30">T='.$tkot1_v2.' C</div>'; 
	}
 if ($_GET["id"]==9)
	{
	 // t dush
	 print '<div id="tt1" style="position:absolute;top:300;left:300;width:150;height:30">W='.$elec2.'</div>'; 
	 print '<div id="tt2" style="position:absolute;top:300;left:450;width:100;height:30">V='.$vboi2.'</div>'; 
	 print '<div id="tt2" style="position:absolute;top:130;left:100;width:100;height:30">T='.$tkot2_v1.' C</div>';
	 print '<div id="tt2" style="position:absolute;top:130;left:400;width:100;height:30">T='.$tkot2_v2.' C</div>'; 
	}
 if ($_GET["id"]==7)
	{
	 // t mzu
	 print '<div id="tt1" style="position:absolute;top:350;left:70;width:150;height:30">'.$tmzu_v1.'</div>'; 
	 print '<div id="tt1" style="position:absolute;top:350;left:210;width:150;height:30">'.$tmzu_v2.'</div>'; 
	 print '<div id="tt1" style="position:absolute;top:350;left:275;width:150;height:30">'.$tmzu_v3.'</div>'; 
	 print '<div id="tt1" style="position:absolute;top:350;left:335;width:150;height:30">'.$tmzu_v4.'</div>'; 
	 print '<div id="tt1" style="position:absolute;top:350;left:460;width:150;height:30">'.$tmzu_v5.'</div>'; 

	 print '<div id="tt1" style="position:absolute;top:400;left:70;width:150;height:30">'.$tmzu_v6.'</div>'; 
	 print '<div id="tt1" style="position:absolute;top:400;left:210;width:150;height:30">'.$tmzu_v7.'</div>'; 
	 print '<div id="tt1" style="position:absolute;top:400;left:275;width:150;height:30">'.$tmzu_v8.'</div>'; 
	 print '<div id="tt1" style="position:absolute;top:400;left:335;width:150;height:30">'.$tmzu_v9.'</div>'; 
	 print '<div id="tt1" style="position:absolute;top:400;left:460;width:150;height:30">'.$tmzu_v10.'</div>'; 
	}
 if ($_GET["id"]==16)
	{
	 // t opravka
	 print '<div id="tt1" style="position:absolute;top:150;left:200;width:150;height:30">'.$tfab_v1.'</div>'; 
	 print '<div id="tt2" style="position:absolute;top:300;left:200;width:100;height:30">'.$tfab_v2.'</div>'; 
	}
 if ($_GET["id"]==12)
	{
	 // t opravka
	 print '<div id="tt1" style="position:absolute;top:420;left:5;width:150;height:30">'.$tfrm_v1.' C</div>'; 
	 print '<div id="tt1" style="position:absolute;top:420;left:150;width:150;height:30">'.$tfrm_v2.' C</div>'; 
	 print '<div id="tt1" style="position:absolute;top:420;left:300;width:150;height:30">'.$tfrm_v3.' C</div>'; 
	 print '<div id="tt1" style="position:absolute;top:420;left:450;width:150;height:30">'.$tfrm_v4.' C</div>'; 
	}
 if ($_GET["id"]==11)
	{
	 // t arm
	 print '<div id="tt1" style="position:absolute;top:100;left:170;width:150;height:30">'.$tarm_v1.'</div>'; 
	 print '<div id="tt2" style="position:absolute;top:100;left:360;width:100;height:30">'.$tarm_v2.'</div>'; 
	 print '<div id="tt3" style="position:absolute;top:430;left:360;width:100;height:30">W='.$elec3.'</div>'; 
	}

 if ($_GET["id"]==13)
	{
	 // t technolog
	 print '<div id="tt1" style="position:absolute;top:270;left:100;width:150;height:30">'.$tsh1.'</div>'; 
	 print '<div id="tt2" style="position:absolute;top:270;left:255;width:100;height:30">'.$tsh2.'</div>'; 
	 print '<div id="tt3" style="position:absolute;top:270;left:410;width:100;height:30">'.$tsh3.'</div>'; 
	 print '<div id="tt4" style="position:absolute;top:270;left:565;width:100;height:30">'.$tsh4.'</div>'; 
	}
 if ($_GET["id"]==15)
	{ 
	 // t technolog
	 print '<div id="ts11" style="position:absolute;top:230;left:285;width:150;height:30">'.$ts11.'</div>'; 
	 print '<div id="ts21" style="position:absolute;top:230;left:360;width:100;height:30">'.$ts12.'</div>'; 
	 print '<div id="ts31" style="position:absolute;top:230;left:435;width:100;height:30">'.$ts12.'</div>'; 
	 print '<div id="ts41" style="position:absolute;top:230;left:510;width:100;height:30">'.$ts13.'</div>'; 

	 print '<div id="ts12" style="position:absolute;top:350;left:285;width:150;height:30">'.$ts21.'</div>'; 
	 print '<div id="ts22" style="position:absolute;top:350;left:360;width:100;height:30">'.$ts22.'</div>'; 
	 print '<div id="ts32" style="position:absolute;top:350;left:435;width:100;height:30">'.$ts22.'</div>'; 
	 print '<div id="ts42" style="position:absolute;top:350;left:510;width:100;height:30">'.$ts23.'</div>'; 
	 
	 print '<div id="ts13" style="position:absolute;top:480;left:285;width:150;height:30">'.$ts31.'</div>'; 
	 print '<div id="ts13" style="position:absolute;top:480;left:360;width:150;height:30">'.$ts32.'</div>'; 
	 print '<div id="ts13" style="position:absolute;top:480;left:435;width:150;height:30">'.$ts32.'</div>'; 
	 print '<div id="ts13" style="position:absolute;top:480;left:510;width:150;height:30">'.$ts33.'</div>'; 
	}
 ?>
 <style type="text/css">
 div.dv
    {
	font-size: 10px;
	color: #003399;
	font-family: Verdana;
	padding:5px;
	background-color: #E8F0F5; 
    }
 </style>
 <table>
 <?php
 $query = 'SELECT * FROM uzels WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i); $cn=0;
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
 	 $query = 'SELECT * FROM channels WHERE prm=4 AND device='.$ui[5].'';
	 $e2 = mysql_query ($query,$i); $cn=0;
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 while ($uo)
		{
		 print '<tr><td><img src="charts/trend4.php?width=1250&max=500&height=200&chan='.$uo[0].'&prm='.$uo[9].'&device='.$uo[2].'&name='.$uo[1].'&min=8000&max=8500&vkl=9&maxt=1000"></td></tr>';
		 $uo = mysql_fetch_row ($e2);
		}
	 $ui = mysql_fetch_row ($e);
	}
 ?>
 </table>