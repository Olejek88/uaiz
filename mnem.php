<meta http-equiv="refresh" content="35,index.php?sel=mnem">

<div id="main" style="width:99%">
<img usemap="#menu" border=0 src="map/mnemo1.jpg">
<map name="menu">
<area shape="rect" coords="0,0,430,160" href="index.php?sel=uzels&id=7" target="_top" alt="������� ���������" onFocus="this.blur()" Onmouseover="document.all['inf33'].style.visibility='visible'" Onmouseout="document.all['inf33'].style.visibility='hidden'">
</map>
</div>
<style type="text/css">
div
{
	font-weight: bold;
	font-size: 14px;
	color: #003300;
	font-family: Verdana;
	font-family: Tahoma;
}
</style>
<?php
 $imit=0;
 $color_on='#98FE31';
 $color_off='#FFFD00';
 $color_none='#dddddd';

 $query = 'SELECT * FROM devices WHERE type=11';
 if ($e = mysql_query ($query,$i)) 
 while ($ui = mysql_fetch_row ($e))
	{
	 $devices[$ui[10]]=$ui[12];
	}
 // T����
 $query = 'SELECT * FROM data WHERE type=0 OR type=1 OR type=5';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{	 
	 if ($ui[1]==0 && $ui[8]==2)
		{
		 if ($ui[9]==675 && $ui[8]==2) $gvklgru3=$ui[3];  // 675	��������� ����������� ������� ��� 3
		 if ($ui[9]==674 && $ui[8]==2) $gvklgru2=$ui[3];  // 674	��������� ����������� ������� ��� 2
		 if ($ui[9]==673 && $ui[8]==2) $gvklgru1=$ui[3];  // 673	��������� ����������� ������� ��� 1

		 if ($ui[9]==672 && $ui[8]==2) $vvklgru3=$ui[3];  // 672	��������� ����������� ���������� ��� 3
		 if ($ui[9]==671 && $ui[8]==2) $vvklgru2=$ui[3];  // 671	��������� ����������� ���������� ��� 2
		 if ($ui[9]==670 && $ui[8]==2) $vvklgru1=$ui[3];  // 670	��������� ����������� ���������� ��� 1

		 if ($ui[9]==663 && $ui[8]==2) $gvklfab2=number_format($ui[3],2);  // 663	��������� ����������� ������� ������� �������������� 2
		 if ($ui[9]==662 && $ui[8]==2) $gvklfab1=number_format($ui[3],2);  // 662	��������� ����������� ������� ������� �������������� 1
		 if ($ui[9]==661 && $ui[8]==2) $vvklfab2=number_format($ui[3],2);  // 661	��������� ����������� ���������� ������� �������������� 2
		 if ($ui[9]==660 && $ui[8]==2) $vvklfab1=number_format($ui[3],2);  // 660	��������� ����������� ���������� ������� �������������� 1

		 if ($ui[9]==647 && $ui[8]==2) $gvkloto4=number_format($ui[3],2);  // 647	��������� ����������� ������� ��������� 4
		 if ($ui[9]==646 && $ui[8]==2) $gvkloto3=number_format($ui[3],2);  // 646	��������� ����������� ������� ��������� 3
		 if ($ui[9]==645 && $ui[8]==2) $gvkloto2=number_format($ui[3],2);  // 645	��������� ����������� ������� ��������� 2
		 if ($ui[9]==644 && $ui[8]==2) $gvkloto1=number_format($ui[3],2);  // 644	��������� ����������� ������� ��������� 1
		 if ($ui[9]==643 && $ui[8]==2) $vvkloto4=number_format($ui[3],2);  // 643	��������� ����������� ���������� ��������� 4
		 if ($ui[9]==642 && $ui[8]==2) $vvkloto3=number_format($ui[3],2);  // 642	��������� ����������� ���������� ��������� 3
		 if ($ui[9]==641 && $ui[8]==2) $vvkloto2=number_format($ui[3],2);  // 641	��������� ����������� ���������� ��������� 2
		 if ($ui[9]==640 && $ui[8]==2) $vvkloto1=number_format($ui[3],2);  // 640	��������� ����������� ���������� ��������� 1

		 if ($ui[9]==638 && $ui[8]==2) $gvklglz2=number_format($ui[3],2);  // 638	��������� ����������� ������� ���������� 2
		 if ($ui[9]==637 && $ui[8]==2) $gvklglz1=number_format($ui[3],2);  // 637	��������� ����������� ������� ���������� 1
		 if ($ui[9]==636 && $ui[8]==2) $vvklglz2=number_format($ui[3],2);  // 636	��������� ����������� ���������� ���������� 2
		 if ($ui[9]==635 && $ui[8]==2) $vvklglz1=number_format($ui[3],2);  // 635	��������� ����������� ���������� ���������� 1

		 if ($ui[9]==625 && $ui[8]==2) $gvklfor4=number_format($ui[3],2);  // 625	��������� ����������� ������� �������� 4
		 if ($ui[9]==624 && $ui[8]==2) $gvklfor3=number_format($ui[3],2);  // 624	��������� ����������� ������� �������� 3
		 if ($ui[9]==623 && $ui[8]==2) $gvklfor2=number_format($ui[3],2);  // 623	��������� ����������� ������� �������� 2
		 if ($ui[9]==622 && $ui[8]==2) $gvklfor1=number_format($ui[3],2);  // 622	��������� ����������� ������� �������� 1
		 if ($ui[9]==621 && $ui[8]==2) $vvklfor4=number_format($ui[3],2);  // 621	��������� ����������� ���������� �������� 4
		 if ($ui[9]==620 && $ui[8]==2) $vvklfor3=number_format($ui[3],2);  // 620	��������� ����������� ���������� �������� 3
		 if ($ui[9]==619 && $ui[8]==2) $vvklfor2=number_format($ui[3],2);  // 619	��������� ����������� ���������� �������� 2
		 if ($ui[9]==618 && $ui[8]==2) $vvklfor1=number_format($ui[3],2);  // 618	��������� ����������� ���������� �������� 1

		 if ($ui[9]==612 && $ui[8]==2) $gvklarm3=number_format($ui[3],2);  // 612	��������� ����������� ������� ��������� 3
		 if ($ui[9]==611 && $ui[8]==2) $gvklarm2=number_format($ui[3],2);  // 611	��������� ����������� ������� ��������� 2
		 if ($ui[9]==610 && $ui[8]==2) $gvklarm1=number_format($ui[3],2);  // 610	��������� ����������� ������� ��������� 1
		 if ($ui[9]==609 && $ui[8]==2) $vvklarm3=number_format($ui[3],2);  // 609	��������� ����������� ���������� ��������� 3
		 if ($ui[9]==608 && $ui[8]==2) $vvklarm2=number_format($ui[3],2);  // 608	��������� ����������� ���������� ��������� 2
		 if ($ui[9]==607 && $ui[8]==2) $vvklarm1=number_format($ui[3],2);  // 607	��������� ����������� ���������� ��������� 1

		 if ($ui[9]==601 && $ui[8]==2) $vklkot2=number_format($ui[3],2);	  // 601	��������� ����� ���������
		 if ($ui[9]==600 && $ui[8]==2) $vklkot1=number_format($ui[3],2);	  // 600	��������� ����� ���������

		 if ($ui[9]==592 && $ui[8]==2) $v2vklkot4=number_format($ui[3],2); // 592	��������� ����� 4 ������� 2
		 if ($ui[9]==591 && $ui[8]==2) $v2vklkot3=number_format($ui[3],2); // 591	��������� ����� 3 ������� 2
		 if ($ui[9]==590 && $ui[8]==2) $v2vklkot2=number_format($ui[3],2); // 590	��������� ����� 2 ������� 2
		 if ($ui[9]==589 && $ui[8]==2) $v2vklkot1=number_format($ui[3],2); // 589	��������� ����� 1 ������� 2

		 if ($ui[9]==581 && $ui[8]==2) $v1vklkot4=number_format($ui[3],2); // 592	��������� ����� 4 ������� 1
		 if ($ui[9]==580 && $ui[8]==2) $v1vklkot3=number_format($ui[3],2); // 591	��������� ����� 3 ������� 1
		 if ($ui[9]==579 && $ui[8]==2) $v1vklkot2=number_format($ui[3],2); // 590	��������� ����� 2 ������� 1
		 if ($ui[9]==578 && $ui[8]==2) $v1vklkot1=number_format($ui[3],2); // 589	��������� ����� 1 ������� 1

		 if ($ui[9]==570 && $ui[8]==2) $g1vklmzu=number_format($ui[3],2);  // 570	��������� ������� Zenith 5
		 if ($ui[9]==569 && $ui[8]==2) $v1vklmzu=number_format($ui[3],2);  // 569	��������� ����������� Zenith 5
		 if ($ui[9]==568 && $ui[8]==2) $g1vklmzu=number_format($ui[3],2);  // 568	��������� ������� Zenith 4
		 if ($ui[9]==567 && $ui[8]==2) $v1vklmzu=number_format($ui[3],2);  // 567	��������� ����������� Zenith 4
		 if ($ui[9]==566 && $ui[8]==2) $g1vklmzu=number_format($ui[3],2);  // 566	��������� ������� Zenith 3
		 if ($ui[9]==565 && $ui[8]==2) $v1vklmzu=number_format($ui[3],2);  // 565	��������� ����������� Zenith 3
		 if ($ui[9]==564 && $ui[8]==2) $g1vklmzu=number_format($ui[3],2);  // 564	��������� ������� Zenith 2
		 if ($ui[9]==563 && $ui[8]==2) $v1vklmzu=number_format($ui[3],2);  // 563	��������� ����������� Zenith 2
		 if ($ui[9]==562 && $ui[8]==2) $g1vklmzu=number_format($ui[3],2);  // 562	��������� ������� Zenith 1
		 if ($ui[9]==561 && $ui[8]==2) $v1vklmzu=number_format($ui[3],2);  // 561	��������� ����������� Zenith 1

		 if ($ui[9]==549 && $ui[8]==2) $gvklmzu2=number_format($ui[3],2);  // 549	��������� ��������������� ��� 2
		 if ($ui[9]==546 && $ui[8]==2) $gvklmzu1=number_format($ui[3],2);  // 546	��������� ��������������� ��� 1
		}
	 if ($ui[1]==5)
		{
		 //echo $ui[9].' '.$ui[8].' '.$ui[3].'<br>';
		 if ($ui[9]==582 && $ui[8]==12 && !$vsboi2) $vsboi2=number_format($ui[3],2).' �3';	// 582	������ ���� ������ 2
		 //if ($ui[9]==583 && $ui[8]==11 && !$qsboi2) $qsboi2=number_format($ui[3],2).' �3';	// 583	������ ���� ������ 2
		 if ($ui[9]==573 && $ui[8]==14 && !$w11) $w11=number_format($ui[3],2);   		// 573	������ �������������� ������ 1
		 if ($ui[9]==571 && $ui[8]==12 && !$vsboi1) $vsboi1=number_format($ui[3],2).' �3';    	// 571	������ ���� ������ 1
		 if ($ui[9]==572 && $ui[8]==11 && !$qsboi1) $qsboi1=number_format($ui[3],2).' �3';	// 572	������ ���� ������ 1
		 if ($ui[9]==584 && $ui[8]==14 && !$w2) $w2=number_format($ui[3],2).' ';    		// 584	������ �������������� ������ 2
		}

	 if ($ui[9]==669 && $ui[8]==4) $tsh4=number_format($ui[3],2);  	  // 669	����������� ������� 4
	 if ($ui[9]==668 && $ui[8]==4) $tsh3=number_format($ui[3],2);  	  // 668	����������� ������� 3

	 if ($ui[9]==667 && $ui[8]==4) $tgru=number_format($ui[3],2);  	  // 667	����������� ���� ���
	 if ($ui[9]==666 && $ui[8]==14) $wgru=number_format($ui[3],2);    // 666	������ �������������� ���
	 if ($ui[9]==665 && $ui[8]==11) $qgru=number_format($ui[3],2);    // 665	������ ���� ���
	 if ($ui[9]==664 && $ui[8]==16) $pgru=number_format($ui[3],2);    // 664	�������� ���� ���

	 if ($ui[9]==659 && $ui[8]==4) $tfab_v1=number_format($ui[3],2);  // 659	����������� ������� ������� �������������� 2  
	 if ($ui[9]==658 && $ui[8]==4) $tfab_v2=number_format($ui[3],2);  // 658	����������� ������� ������� �������������� 1 

	 if ($ui[9]==657 && $ui[8]==14) $wfab=number_format($ui[3],2);     // 657	������ �������������� ������� ��������������

	 if ($ui[9]==653 && $ui[8]==4) $ts23=number_format($ui[3],2).' C'; // 653	����������� ������ 2 ���� 3 
	 if ($ui[9]==652 && $ui[8]==4) $ts22=number_format($ui[3],2).' C'; // 652	����������� ������ 2 ���� 2
	 if ($ui[9]==651 && $ui[8]==4) $ts21=number_format($ui[3],2).' C'; // 651	����������� ������ 2 ���� 1
	 if ($ui[9]==650 && $ui[8]==4) $ts13=number_format($ui[3],2).' C'; // 650	����������� ������ 1 ���� 3
	 if ($ui[9]==649 && $ui[8]==4) $ts12=number_format($ui[3],2).' C'; // 649	����������� ������ 1 ���� 2
	 if ($ui[9]==648 && $ui[8]==4) $ts11=number_format($ui[3],2).' C'; // 648	����������� ������ 1 ���� 1

	 if ($ui[9]==639 && $ui[8]==14) $elec9=number_format($ui[3],2);    // 639	������ �������������� �������� �� ���������

	 if ($ui[9]==677 && $ui[8]==4) $ts4=number_format($ui[3],2);       // 677	����������� ���������� ���������� 4
	 if ($ui[9]==634 && $ui[8]==4) $ts3=number_format($ui[3],2);       // 634	����������� ���������� ���������� 3
	 if ($ui[9]==633 && $ui[8]==4) $ts2=number_format($ui[3],2);       // 633	����������� ���������� ���������� 2
	 if ($ui[9]==632 && $ui[8]==4) $ts1=number_format($ui[3],2);       // 632	����������� ���������� ���������� 1
	 if ($ui[9]==631 && $ui[8]==4) $ttfz13=number_format($ui[3],2);    // 631	����������� �� ������ ���������� 6
	 if ($ui[9]==630 && $ui[8]==4) $ttfz12=number_format($ui[3],2);    // 630	����������� �� ������ ���������� 5
	 if ($ui[9]==629 && $ui[8]==4) $ttfz11=number_format($ui[3],2);    // 629	����������� �� ������ ���������� 4
	 if ($ui[9]==628 && $ui[8]==4) $ttfz23=number_format($ui[3],2);    // 628	����������� �� ������ ���������� 3
	 if ($ui[9]==627 && $ui[8]==4) $ttfz22=number_format($ui[3],2);    // 627	����������� �� ������ ���������� 2
	 if ($ui[9]==626 && $ui[8]==4) $ttfz21=number_format($ui[3],2);    // 626	����������� �� ������ ���������� 1

	 if ($ui[9]==617 && $ui[8]==4) $tfrm_v4=number_format($ui[3],2);	  // 617	����������� ������� �������� 4  
	 if ($ui[9]==616 && $ui[8]==4) $tfrm_v3=number_format($ui[3],2);	  // 616	����������� ������� �������� 3
	 if ($ui[9]==615 && $ui[8]==4) $tfrm_v2=number_format($ui[3],2);	  // 615	����������� ������� �������� 2
	 if ($ui[9]==614 && $ui[8]==4) $tfrm_v1=number_format($ui[3],2);	  // 614	����������� ������� �������� 1

	 if ($ui[9]==613 && $ui[8]==14) $elec6=number_format($ui[3],2);    // 613	������ �������������� ��������

	 if ($ui[9]==606 && $ui[8]==4) $tarm_v1=number_format($ui[3],2).' C';	// 606	����������� ������� ��������� 1
	 if ($ui[9]==605 && $ui[8]==14) $elec3=number_format($ui[3],2);    	// 605	������ �������������� ���������
	 if ($ui[9]==676 && $ui[8]==4) $tarm_v2=number_format($ui[3],2).' C';	// 676	����������� ������� ��������� 2 

	 if ($ui[9]==604 && $ui[8]==4) $tnv=number_format($ui[3],2);	  // 604	����������� ������� �� �����

	 if ($ui[9]==602 && $ui[8]==12) $vkot2=number_format($ui[3],2);	  // 603	������ ���� ���������
	 if ($ui[9]==599 && $ui[8]==16) $pkot2=number_format($ui[3],2);	  // 599	�������� ���� ���������
	 if ($ui[9]==597 && $ui[8]==11) $qkot2=number_format($ui[3],2);	  // 597	������ ���� ���������
	 if ($ui[9]==595 && $ui[8]==4) $tkot2=number_format($ui[3],2);	  // 595	����������� ���� ���������
	 if ($ui[9]==602 && $ui[8]==12) $vkot1=number_format($ui[3],2);	  // 602	������ ���� ���������
	 if ($ui[9]==598 && $ui[8]==16) $pkot1=number_format($ui[3],2);	  // 598	�������� ���� ���������
	 if ($ui[9]==596 && $ui[8]==11) $qkot1=number_format($ui[3],2);	  // 596	������ ���� ���������
	 if ($ui[9]==594 && $ui[8]==4) $tkot1=number_format($ui[3],2);	  // 594	����������� ���� ���������

	 if ($ui[9]==593 && $ui[8]==14) $elec1=number_format($ui[3],2);    // 593	������ �������������� ���������

	 if ($ui[9]==588 && $ui[8]==4) $tkot2_v2=number_format($ui[3],2);  // 588	����������� ������� ������� 2
	 if ($ui[9]==587 && $ui[8]==4) $tkot2_v1=number_format($ui[3],2);  // 587	����������� ������� ������� 2

	 if ($ui[9]==584 && $ui[8]==14 && !$elec2) $elec2=number_format($ui[3],2);    	// 584	������ �������������� ������ 2
	 if ($ui[9]==582 && $ui[8]==12 && !$vboi2) $vboi2=number_format($ui[3],2).' �3';// 582	������ ���� ������ 2
	 //if ($ui[9]==583 && $ui[8]==11 && !$qboi2) $qboi2=number_format($ui[3],2).' �3';// 583	������ ���� ������ 2

	 if ($ui[9]==577 && $ui[8]==4) $tkot1_v2=number_format($ui[3],2).' C';  // 588	����������� ������� ������� 1
	 if ($ui[9]==576 && $ui[8]==4) $tkot1_v1=number_format($ui[3],2).' C';  // 587	����������� ������� ������� 1

	 if ($ui[9]==573 && $ui[8]==14 && !$elec11) $elec11=number_format($ui[3],2);   		// 573	������ �������������� ������ 1
	 if ($ui[9]==571 && $ui[8]==12 && !$vboi1) $vboi1=number_format($ui[3],2).' �3';    	// 571	������ ���� ������ 1
	 if ($ui[9]==572 && $ui[8]==11 && !$qboi1) $qboi1=number_format($ui[3],2).' �3';	// 572	������ ���� ������ 1

	 if ($ui[9]==560 && $ui[8]==4) $tmzu_v10=number_format($ui[3],2);  // 560	����������� ������� ��� 10
	 if ($ui[9]==559 && $ui[8]==4) $tmzu_v9=number_format($ui[3],2);   // 559	����������� ������� ��� 9
	 if ($ui[9]==558 && $ui[8]==4) $tmzu_v8=number_format($ui[3],2);   // 558	����������� ������� ��� 8
	 if ($ui[9]==557 && $ui[8]==4) $tmzu_v7=number_format($ui[3],2);   // 557	����������� ������� ��� 7
	 if ($ui[9]==556 && $ui[8]==4) $tmzu_v6=number_format($ui[3],2);   // 556	����������� ������� ��� 6
	 if ($ui[9]==555 && $ui[8]==4) $tmzu_v5=number_format($ui[3],2);   // 555	����������� ������� ��� 5
	 if ($ui[9]==554 && $ui[8]==4) $tmzu_v4=number_format($ui[3],2);   // 554	����������� ������� ��� 4
	 if ($ui[9]==553 && $ui[8]==4) $tmzu_v3=number_format($ui[3],2);   // 553	����������� ������� ��� 3
	 if ($ui[9]==552 && $ui[8]==4) $tmzu_v2=number_format($ui[3],2);   // 552	����������� ������� ��� 2
	 if ($ui[9]==551 && $ui[8]==4) $tmzu_v1=number_format($ui[3],2);   // 551	����������� ������� ��� 1

	 if ($ui[9]==548 && $ui[8]==4) $tsh2=number_format($ui[3],2);  	  // 548	����������� ������� 2
	 if ($ui[9]==547 && $ui[8]==4) $tsh1=number_format($ui[3],2);  	  // 547	����������� ������� 1

	 if ($ui[9]==545 && $ui[8]==14 && !$elec7) $elec7=number_format($ui[3],2).' ���/�'; 	// 545 	������ �������������� ���

	 $ui = mysql_fetch_row ($e);
	}

 if ($imit)
	{
	 $tarm_v1=rand(1600,1900)/100; $tarm_v2=rand(1600,1900)/100; $tarm_v3=rand(1800,2200)/100; $tarm_v4=rand(1800,2200)/100;
	 $tmzu_v1=rand(1800,2200)/100; $tmzu_v2=rand(1800,2200)/100; $tmzu_v3=rand(1800,2200)/100; $tmzu_v4=rand(1800,2200)/100;
	 $tmzu_v5=rand(1800,2200)/100; $tmzu_v6=rand(1800,2200)/100; $tmzu_v7=rand(1800,2200)/100; $tmzu_v8=rand(1800,2200)/100;
	 $tmzu_v9=rand(1800,2200)/100; $tmzu_v10=rand(1800,2200)/100;

	 $tfrm_v1=rand(2000,2300)/100; $tfrm_v2=rand(2000,2300)/100; $tfrm_v3=rand(1800,2200)/100; $tfrm_v4=rand(1800,2200)/100;
	 $tfab_v1=rand(2000,2300)/100; $tfab_v2=rand(2000,2300)/100; $tkot1_v1=rand(2000,2300)/100;

	 $tkot1_v2=rand(2000,2300)/100; $tkot2_v1=rand(2000,2300)/100; $tkot2_v2=rand(2000,2300)/100;
	 $tkot1=rand(1100,1200)/100; $qkot1=rand(500,600)/100; $pkot1=rand(400,500)/1000; $vkot1=rand(700,800)/1000; 
	 $tkot2=rand(1100,1200)/100; $qkot2=rand(600,700)/100; $pkot2=rand(400,500)/1000; $vkot2=rand(800,900)/1000;

	 $tboi1=rand(1100,1200)/100; $qboi1=rand(110,115)/100; $pboi1=rand(400,500)/1000; $vboi1=rand(200,240)/1000;
	 $tboi2=rand(1100,1200)/100; $qboi2=rand(100,120)/100; $pboi2=rand(400,500)/1000; $vboi2=rand(210,250)/1000;

	 $elec1=rand(17000,18000)/1000; $elec2=rand(3700,4800)/1000; $elec3=rand(3700,4800)/1000; $elec4=rand(700,1800)/1000;
	 $elec5=rand(700,1800)/1000; $elec6=rand(700,1800)/1000; $elec7=rand(700,1800)/1000; $elec8=rand(700,1800)/1000;
	 $elec9=rand(700,1800)/1000; $elec10=rand(700,1800)/1000; $elec11=rand(700,1800)/1000; $elec12=rand(700,1800)/1000;

	 $ts1=rand(7000,8000)/100; $ts2=rand(7000,8000)/100; $ts3=rand(7000,8000)/100; $ts4=rand(7000,8000)/100; $ts5=rand(7000,8000)/100;
	 $ttfz11=rand(8000,9000)/100; $ttfz12=rand(9000,10000)/100; $ttfz21=rand(8000,9000)/100;
	 $ttfz22=rand(9000,10000)/100; $ttfz31=rand(8000,9000)/100; $ttfz32=rand(9000,10000)/100;

	 $tsh1=rand(4500,5000)/100; $tsh2=rand(4000,4500)/100; $tsh3=rand(4400,4600)/100; $tsh4=rand(4500,4600)/100;

	 $ts11=rand(4000,4500)/100; $ts12=rand(8000,8300)/100; $ts13=rand(8300,8500)/100;
	 $ts21=rand(4000,4500)/100; $ts22=rand(8000,8300)/100; $ts23=rand(8300,8500)/100;

	 $tgru=rand(1200,1300)/100; $qgru=rand(1500,1600)/100; $pgru=rand(500,550)/1000;
	 $tnv=rand(2400,2600)/100;
	}
 // BOILER 2 --------------------------
 if ($devices[32])
	{
	 if ($v2vklkot1) print '<div id="sv_boi2_1" style="position:absolute;top:262;left:25;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">�1 ���.</div>'; 
	 else print '<div id="sv_boi2_1" style="position:absolute;top:262;left:25;width:50;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">�1 ����</div>'; 
	 if ($v2vklkot2) print '<div id="sv_boi2_2" style="position:absolute;top:262;left:88;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">�2 ���.</div>'; 
	 else print '<div id="sv_boi2_2" style="position:absolute;top:262;left:88;width:50;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">�2 ����</div>'; 
	 if ($v2vklkot3) print '<div id="sv_boi2_3" style="position:absolute;top:262;left:162;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">�3 ���.</div>'; 
	 else print '<div id="sv_boi2_3" style="position:absolute;top:262;left:162;width:50;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">�3 ����</div>'; 
	 if ($v2vklkot4) print '<div id="sv_boi2_4" style="position:absolute;top:262;left:230;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">�4 ���.</div>';
	 else print '<div id="sv_boi2_4" style="position:absolute;top:262;left:230;width:50;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">�4 ����</div>'; 
	}
 else
	{
	 print '<div id="sv_boi2_1" style="position:absolute;top:262;left:25;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">�1 ���.</div>'; 
	 print '<div id="sv_boi2_2" style="position:absolute;top:262;left:88;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">�2 ���.</div>'; 
	 print '<div id="sv_boi2_3" style="position:absolute;top:262;left:162;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">�3 ���.</div>'; 
	 print '<div id="sv_boi2_4" style="position:absolute;top:262;left:230;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">�4 ���.</div>';
	}
 if ($devices[31])
	 print '<div id="boi2" style="position:absolute;top:384;left:343;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T1(06M)</div>'; 
 else 	 print '<div id="boi2" style="position:absolute;top:384;left:343;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T1(06M)</div>'; 
 if ($devices[32])
	 print '<div id="boi2" style="position:absolute;top:384;left:400;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T2(03)</div>'; 
 else 	 print '<div id="boi2" style="position:absolute;top:384;left:400;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T2(03)</div>'; 

 print '<div id="g11" style="position:absolute;top:345;left:60;width:100;height:30">'.$vsboi2.'</div>'; 
// print '<div id="g13" style="position:absolute;top:383;left:200;width:100;height:30">'.$qsboi2.'</div>'; 
 print '<div id="g12" style="position:absolute;top:303;left:60;width:100;height:30">'.$vboi2.'</div>'; 
 print '<div id="g14" style="position:absolute;top:383;left:60;width:100;height:30">'.$w2.'</div>'; 
 print '<div id="tv41" style="position:absolute;top:303;left:200;width:100;height:30">'.$tkot1_v1.'</div>'; 
 print '<div id="tv42" style="position:absolute;top:345;left:200;width:100;height:30">'.$tkot1_v2.'</div>'; 
 // end BOILER 2 ----------------------

 // BOILER 1 --------------------------
 //  335 790
 if ($devices[22])
	{
	 if ($v2vklkot1) print '<div id="sv_boi2_1" style="position:absolute;top:597;left:815;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">�1 ���.</div>'; 
	 else print '<div id="sv_boi2_1" style="position:absolute;top:597;left:815;width:50;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">�1 ����</div>'; 
	 if ($v2vklkot2) print '<div id="sv_boi2_2" style="position:absolute;top:597;left:883;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">�2 ���.</div>'; 
	 else print '<div id="sv_boi2_2" style="position:absolute;top:597;left:883;width:50;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">�2 ����</div>'; 
	 if ($v2vklkot3) print '<div id="sv_boi2_3" style="position:absolute;top:597;left:955;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">�3 ���.</div>'; 
	 else print '<div id="sv_boi2_3" style="position:absolute;top:597;left:955;width:50;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">�3 ����</div>'; 
	 if ($v2vklkot4) print '<div id="sv_boi2_4" style="position:absolute;top:597;left:1020;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">�4 ���.</div>';
	 else print '<div id="sv_boi2_4" style="position:absolute;top:597;left:1020;width:50;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">�4 ����</div>'; 
	}
 else
	{
	 print '<div id="sv_boi2_1" style="position:absolute;top:597;left:815;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">�1 ���.</div>'; 
	 print '<div id="sv_boi2_2" style="position:absolute;top:597;left:878;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">�2 ���.</div>'; 
	 print '<div id="sv_boi2_3" style="position:absolute;top:597;left:952;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">�3 ���.</div>'; 
	 print '<div id="sv_boi2_4" style="position:absolute;top:597;left:1020;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">�4 ���.</div>';
	}
 if ($devices[21])
	 print '<div id="boi2" style="position:absolute;top:719;left:1135;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T1(06M)</div>'; 
 else 	 print '<div id="boi2" style="position:absolute;top:719;left:1135;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T1(06M)</div>'; 
 if ($devices[22])
	 print '<div id="boi2" style="position:absolute;top:719;left:1192;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T2(03)</div>'; 
 else 	 print '<div id="boi2" style="position:absolute;top:719;left:1192;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T2(03)</div>'; 
  
 print '<div id="g11" style="position:absolute;top:638;left:850;width:100;height:30">'.$vboi1.'</div>';
 print '<div id="g12" style="position:absolute;top:680;left:850;width:100;height:30">'.$qboi1.'</div>'; 
 print '<div id="g14" style="position:absolute;top:718;left:990;width:100;height:30">'.$qsboi1.'</div>'; 
 print '<div id="g13" style="position:absolute;top:718;left:850;width:100;height:30">'.$vsboi1.'</div>'; 
 print '<div id="tv41" style="position:absolute;top:638;left:990;width:100;height:30">'.$tkot1_v1.'</div>'; 
 print '<div id="tv42" style="position:absolute;top:680;left:990;width:100;height:30">'.$tkot1_v2.'</div>'; 
 // end BOILER 1 ----------------------

 // MZU -------------------------------
 if ($devices[11])
	{
	 if ($gvklmzu1>0.01) print '<div id="s_mzu_1" style="position:absolute;top:92;left:592;width:35;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���.</div>'; 
	 else print '<div id="s_mzu_1" style="position:absolute;top:92;left:592;width:35;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">����</div>'; 
	 if ($gvklmzu2>0.01) print '<div id="s_mzu_2" style="position:absolute;top:124;left:592;width:35;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���.</div>'; 
	 else print '<div id="s_mzu_2" style="position:absolute;top:124;left:592;width:35;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">����</div>'; 
	}
 else
	{
	 print '<div id="s_mzu_1" style="position:absolute;top:92;left:592;width:35;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">�1 ���.</div>'; 
	 print '<div id="s_mzu_2" style="position:absolute;top:124;left:592;width:35;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">�2 ���.</div>'; 
	}
 if ($devices[12])
	{      
	 if ($v1vklmzu) print '<div id="sv_mzu_1" style="position:absolute;top:88;left:907;width:92;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 1 ���.</div>'; 
	 else print '<div id="sv_mzu_1" style="position:absolute;top:88;left:907;width:92;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 1 ����</div>'; 
	 if ($v2vklmzu) print '<div id="sv_mzu_2" style="position:absolute;top:119;left:907;width:9;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 2 ���.</div>'; 
	 else print '<div id="sv_mzu_2" style="position:absolute;top:119;left:907;width:92;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 2 ����</div>'; 
	 if ($v1vklmzu) print '<div id="sv_mzu_3" style="position:absolute;top:150;left:907;width:92;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 3 ���.</div>'; 
	 else print '<div id="sv_mzu_1" style="position:absolute;top:150;left:907;width:92;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 3 ����</div>'; 
	 if ($v2vklmzu) print '<div id="sv_mzu_4" style="position:absolute;top:181;left:907;width:9;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 4 ���.</div>'; 
	 else print '<div id="sv_mzu_2" style="position:absolute;top:181;left:907;width:92;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 4 ����</div>'; 
	 if ($v2vklmzu) print '<div id="sv_mzu_5" style="position:absolute;top:211;left:907;width:9;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 5 ���.</div>'; 
	 else print '<div id="sv_mzu_2" style="position:absolute;top:211;left:907;width:92;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 5 ����</div>'; 

	 if ($g1vklmzu) print '<div id="sg_mzu_1" style="position:absolute;top:88;left:1007;width:92;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 1 ���.</div>'; 
	 else print '<div id="s_mzu_1" style="position:absolute;top:88;left:1007;width:92;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 1 ����</div>'; 
	 if ($g2vklmzu) print '<div id="sg_mzu_2" style="position:absolute;top:119;left:1007;width:9;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 2 ���.</div>'; 
	 else print '<div id="s_mzu_2" style="position:absolute;top:119;left:1007;width:92;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 2 ����</div>'; 
	 if ($g1vklmzu) print '<div id="sg_mzu_1" style="position:absolute;top:150;left:1007;width:92;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 3 ���.</div>'; 
	 else print '<div id="s_mzu_1" style="position:absolute;top:150;left:1007;width:92;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 3 ����</div>'; 
	 if ($g2vklmzu) print '<div id="sg_mzu_2" style="position:absolute;top:181;left:1007;width:9;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 4 ���.</div>'; 
	 else print '<div id="s_mzu_2" style="position:absolute;top:181;left:1007;width:92;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 4 ����</div>'; 
	 if ($g2vklmzu) print '<div id="sg_mzu_2" style="position:absolute;top:211;left:1007;width:9;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 5 ���.</div>'; 
	 else print '<div id="s_mzu_2" style="position:absolute;top:211;left:1007;width:92;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 5 ����</div>'; 
	}
 else
	{
	 print '<div id="s_mzu_1" style="position:absolute;top:92;left:592;width:35;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">�1 ���.</div>'; 
	 print '<div id="s_mzu_2" style="position:absolute;top:124;left:592;width:35;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">�2 ���.</div>'; 
	}

 if ($devices[11])
	 print '<div id="mzu1" style="position:absolute;top:180;left:1121;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T1(06�)</div>'; 
 else 	 print '<div id="mzu1" style="position:absolute;top:180;left:1121;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T1(06�)</div>'; 
 if ($devices[12])
	 print '<div id="mzu2" style="position:absolute;top:180;left:1177;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T2(03)</div>'; 
 else 	 print '<div id="mzu2" style="position:absolute;top:180;left:1177;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T2(03)</div>'; 
 if ($devices[13])
	 print '<div id="mzu3" style="position:absolute;top:211;left:1120;width:51;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T3(12)</div>'; 
 else 	 print '<div id="mzu3" style="position:absolute;top:211;left:1120;width:51;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T3(12)</div>'; 
 if ($devices[14])
	 print '<div id="mzu4" style="position:absolute;top:211;left:1177;width:51;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T4(13)</div>'; 
 else 	 print '<div id="mzu4" style="position:absolute;top:211;left:1177;width:51;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T4(13)</div>'; 

 print '<div id="tsh1" style="position:absolute;top:180;left:560;width:150;height:30">'.$tsh1.'</div>'; 
 print '<div id="tsh2" style="position:absolute;top:208;left:560;width:100;height:30">'.$tsh2.'</div>'; 
  
 print '<div id="tv10" style="position:absolute;top:91;left:690;width:100;height:30">'.$tmzu_v1.' C</div>'; 
 print '<div id="tv11" style="position:absolute;top:121;left:690;width:100;height:30">'.$tmzu_v2.' C</div>'; 
 print '<div id="tv12" style="position:absolute;top:152;left:690;width:100;height:30">'.$tmzu_v3.' C</div>'; 
 print '<div id="tv13" style="position:absolute;top:182;left:690;width:100;height:30">'.$tmzu_v4.' C</div>'; 
 print '<div id="tv14" style="position:absolute;top:213;left:690;width:100;height:30">'.$tmzu_v5.' C</div>'; 
 print '<div id="tv15" style="position:absolute;top:91;left:820;width:100;height:30">'.$tmzu_v6.' C</div>'; 
 print '<div id="tv16" style="position:absolute;top:121;left:820;width:100;height:30">'.$tmzu_v7.' C</div>'; 
 print '<div id="tv17" style="position:absolute;top:152;left:820;width:100;height:30">'.$tmzu_v8.' C</div>'; 
 print '<div id="tv18" style="position:absolute;top:182;left:820;width:100;height:30">'.$tmzu_v9.' C</div>'; 
 print '<div id="tv19" style="position:absolute;top:213;left:830;width:100;height:30">'.$tmzu_v10.' C</div>'; 
 // end MZU 1 ----------------------

 // ��������� ----------------------
 if ($vvklarm1) print '<div id="s_arm_1" style="position:absolute;top:438;left:7;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 1 ���.</div>'; 
 else print '<div id="s_arm_1" style="position:absolute;top:438;left:7;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 1 ����</div>'; 
 if ($vvklarm2) print '<div id="s_arm_2" style="position:absolute;top:438;left:95;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 2 ���.</div>'; 
 else print '<div id="s_arm_2" style="position:absolute;top:438;left:95;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 2 ����</div>'; 
 if ($vvklarm3) print '<div id="s_arm_3" style="position:absolute;top:438;left:184;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 3 ���.</div>'; 
 else print '<div id="s_arm_3" style="position:absolute;top:438;left:184;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 3 ����</div>'; 
 if ($gvklarm1) print '<div id="s_arm_1" style="position:absolute;top:468;left:7;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 1 ���.</div>'; 
 else print '<div id="s_arm_1" style="position:absolute;top:468;left:7;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 1 ����</div>'; 
 if ($gvklarm2) print '<div id="s_arm_2" style="position:absolute;top:468;left:95;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 2 ���.</div>'; 
 else print '<div id="s_arm_2" style="position:absolute;top:468;left:95;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 2 ����</div>'; 
 if ($gvklarm3) print '<div id="s_arm_3" style="position:absolute;top:468;left:184;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 3 ���.</div>'; 
 else print '<div id="s_arm_3" style="position:absolute;top:468;left:184;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 3 ����</div>'; 

//	{
//	 print '<div id="s_arm_1" style="position:absolute;top:438;left:7;width:78;height:23;background-color:'.$color_none.';font-size:11px;text-align:center"></div>'; 
//	 print '<div id="s_arm_2" style="position:absolute;top:438;left:95;width:78;height:23;background-color:'.$color_none.';font-size:11px;text-align:center"></div>'; 
//	 print '<div id="s_arm_3" style="position:absolute;top:438;left:184;width:78;height:23;background-color:'.$color_none.';font-size:11px;text-align:center"></div>'; 
//	 print '<div id="s_arm_4" style="position:absolute;top:468;left:7;width:78;height:23;background-color:'.$color_none.';font-size:11px;text-align:center"></div>'; 
//	 print '<div id="s_arm_5" style="position:absolute;top:468;left:95;width:78;height:23;background-color:'.$color_none.';font-size:11px;text-align:center"></div>'; 
//	 print '<div id="s_arm_6" style="position:absolute;top:468;left:184;width:78;height:23;background-color:'.$color_none.';font-size:11px;text-align:center"></div>'; 
//	}

 if ($devices[51])
	 print '<div id="arm1" style="position:absolute;top:538;left:307;width:51;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T1(10)</div>'; 
 else 	 print '<div id="arm1" style="position:absolute;top:538;left:307;width:51;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T1(10)</div>'; 
 if ($devices[52])
	 print '<div id="arm2" style="position:absolute;top:538;left:363;width:51;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T2(13)</div>'; 
 else 	 print '<div id="arm2" style="position:absolute;top:538;left:363;width:51;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T2(13)</div>'; 

 // vozduh armirovka
 print '<div id="tv1" style="position:absolute;top:503;left:77;width:100;height:30">'.$tarm_v1.'</div>'; 
 print '<div id="tv2" style="position:absolute;top:538;left:77;width:100;height:30">'.$tarm_v2.'</div>'; 
 print '<div id="tv3" style="position:absolute;top:503;left:220;width:100;height:30">'.$tarm_v3.'</div>'; 
 print '<div id="tv4" style="position:absolute;top:538;left:220;width:100;height:30">'.$tarm_v4.'</div>'; 
 // end ��������� -----------------

 // �������� ----------------------
 if ($vvklfor1) print '<div id="sv_for_1" style="position:absolute;top:440;left:623;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 1 ���.</div>'; 
 else print '<div id="sv_for_1" style="position:absolute;top:440;left:623;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 1 ����</div>'; 
 if ($vvklfor2) print '<div id="sv_for_2" style="position:absolute;top:471;left:623;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 2 ���.</div>'; 
 else print '<div id="sv_for_1" style="position:absolute;top:471;left:623;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 2 ����</div>'; 
 if ($vvklfor3) print '<div id="sv_for_3" style="position:absolute;top:503;left:623;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 3 ���.</div>'; 
 else print '<div id="sv_for_1" style="position:absolute;top:503;left:623;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 3 ����</div>'; 
 if ($vvklfor4) print '<div id="sv_for_4" style="position:absolute;top:535;left:623;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 4 ���.</div>'; 
 else print '<div id="sv_for_1" style="position:absolute;top:535;left:623;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 4 ����</div>'; 

 if ($gvklfor1) print '<div id="sg_for_1" style="position:absolute;top:440;left:708;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���. 1 ���.</div>'; 
 else print '<div id="sg_for_1" style="position:absolute;top:440;left:708;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���. 1 ����</div>'; 
 if ($gvklfor2) print '<div id="sg_for_2" style="position:absolute;top:471;left:708;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���. 2 ���.</div>'; 
 else print '<div id="sg_for_1" style="position:absolute;top:471;left:708;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���. 2 ����</div>'; 
 if ($gvklfor3) print '<div id="sg_for_3" style="position:absolute;top:503;left:708;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���. 3 ���.</div>'; 
 else print '<div id="sg_for_1" style="position:absolute;top:503;left:708;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���. 3 ����</div>'; 
 if ($gvklfor4) print '<div id="sg_for_4" style="position:absolute;top:535;left:708;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���. 4 ���.</div>'; 
 else print '<div id="sg_for_1" style="position:absolute;top:535;left:708;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���. 4 ����</div>'; 

 print '<div id="tv21" style="position:absolute;top:442;left:550;width:100;height:30">'.$tfrm_v1.' C</div>'; 
 print '<div id="tv22" style="position:absolute;top:474;left:550;width:100;height:30">'.$tfrm_v2.' C</div>'; 
 print '<div id="tv23" style="position:absolute;top:506;left:550;width:100;height:30">'.$tfrm_v3.' C</div>'; 
 print '<div id="tv24" style="position:absolute;top:539;left:550;width:100;height:30">'.$tfrm_v4.' C</div>'; 

 if ($devices[61])
	 print '<div id="for1" style="position:absolute;top:539;left:811;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T1(10)</div>'; 
 else 	 print '<div id="for1" style="position:absolute;top:539;left:811;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T1(10)</div>'; 
 if ($devices[62])
	 print '<div id="for2" style="position:absolute;top:539;left:868;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T2(13)</div>'; 
 else 	 print '<div id="for2" style="position:absolute;top:539;left:868;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T2(13)</div>'; 
 // end �������� ------------------

 // ������ � ��������� ------------
 if ($vvkloto1) print '<div id="sv_oto_1" style="position:absolute;top:415;left:954;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 1 ���.</div>'; 
 else print '<div id="sv_oto_1" style="position:absolute;top:415;left:954;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 1 ����</div>'; 
 if ($vvkloto2) print '<div id="sv_oto_2" style="position:absolute;top:449;left:954;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 2 ���.</div>'; 
 else print '<div id="sv_oto_2" style="position:absolute;top:449;left:954;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 2 ����</div>'; 
 if ($vvkloto3) print '<div id="sv_oto_3" style="position:absolute;top:483;left:954;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 3 ���.</div>'; 
 else print '<div id="sv_oto_3" style="position:absolute;top:483;left:954;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 3 ����</div>'; 
 if ($vvkloto4) print '<div id="sv_oto_4" style="position:absolute;top:517;left:954;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 4 ���.</div>'; 
 else print '<div id="sv_oto_4" style="position:absolute;top:517;left:954;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 4 ����</div>'; 

 if ($gvkloto1) print '<div id="sg_oto_1" style="position:absolute;top:415;left:1040;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 1 ���.</div>'; 
 else print '<div id="sg_oto_1" style="position:absolute;top:415;left:1040;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 1 ����</div>'; 
 if ($gvkloto2) print '<div id="sg_oto_2" style="position:absolute;top:449;left:1040;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 2 ���.</div>'; 
 else print '<div id="sg_oto_2" style="position:absolute;top:449;left:1040;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 2 ����</div>'; 
 if ($gvkloto3) print '<div id="sg_oto_3" style="position:absolute;top:483;left:1040;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 3 ���.</div>'; 
 else print '<div id="sg_oto_3" style="position:absolute;top:483;left:1040;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 3 ����</div>'; 
 if ($gvkloto4) print '<div id="sg_oto_4" style="position:absolute;top:517;left:1040;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 4 ���.</div>'; 
 else print '<div id="sg_oto_4" style="position:absolute;top:517;left:1040;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 4 ����</div>'; 

 print '<div id="tsh1" style="position:absolute;top:311;left:1010;width:150;height:30">'.$ts11.'</div>'; 
 print '<div id="tsh2" style="position:absolute;top:342;left:1010;width:150;height:30">'.$ts12.'</div>'; 
 print '<div id="tsh3" style="position:absolute;top:373;left:1010;width:150;height:30">'.$ts13.'</div>'; 
 print '<div id="tsh4" style="position:absolute;top:311;left:1158;width:150;height:30">'.$ts21.'</div>'; 
 print '<div id="tsh5" style="position:absolute;top:342;left:1158;width:150;height:30">'.$ts22.'</div>'; 
 print '<div id="tsh6" style="position:absolute;top:373;left:1158;width:150;height:30">'.$ts23.'</div>'; 
 if ($devices[71])
	 print '<div id="glz1" style="position:absolute;top:538;left:1133;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T1(10)</div>'; 
 else 	 print '<div id="glz1" style="position:absolute;top:538;left:1133;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T1(10)</div>'; 
 if ($devices[72])                                             
	 print '<div id="glz2" style="position:absolute;top:538;left:1190;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T2(13)</div>'; 
 else 	 print '<div id="glz2" style="position:absolute;top:538;left:1190;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T2(13)</div>'; 
 // end ������ � ��������� --------

 // ���������� --------------------
 if ($gvklglz1) print '<div id="sg_glz_1" style="position:absolute;top:588;left:264;width:71;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 1 ���.</div>'; 
 else print '<div id="sg_glz_2" style="position:absolute;top:588;left:264;width:71;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 1 ����</div>'; 
 if ($gvklglz2) print '<div id="sg_glz_2" style="position:absolute;top:618;left:264;width:71;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 2 ���.</div>'; 
 else print '<div id="sg_glz_2" style="position:absolute;top:618;left:264;width:71;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 2 ����</div>'; 
 if ($vvklglz1) print '<div id="sv_glz_1" style="position:absolute;top:648;left:264;width:71;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 1 ���.</div>'; 
 else print '<div id="sv_glz_1" style="position:absolute;top:648;left:264;width:71;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">����1 ����</div>'; 
 if ($vvklglz2) print '<div id="sv_glz_2" style="position:absolute;top:678;left:264;width:71;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 2 ���.</div>'; 
 else print '<div id="sv_glz_2" style="position:absolute;top:678;left:264;width:71;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">����2 ����</div>'; 

 print '<div id="tt1" style="position:absolute;top:614;left:70;width:150;height:30">'.$ts1.'</div>'; 
 print '<div id="tt2" style="position:absolute;top:644;left:70;width:100;height:30">'.$ts2.'</div>'; 
 print '<div id="tt4" style="position:absolute;top:614;left:195;width:100;height:30">'.$ts3.'</div>'; 
 print '<div id="tt5" style="position:absolute;top:644;left:195;width:100;height:30">'.$ts4.'</div>'; 

 print '<div id="tt4" style="position:absolute;top:720;left:70;width:150;height:30">'.$ttfz11.'</div>'; 
 print '<div id="tt5" style="position:absolute;top:751;left:70;width:100;height:30">'.$ttfz12.'</div>'; 
 print '<div id="tt6" style="position:absolute;top:720;left:195;width:100;height:30">'.$ttfz21.'</div>'; 
 print '<div id="tt7" style="position:absolute;top:751;left:195;width:150;height:30">'.$ttfz22.'</div>'; 

 if ($devices[71])
	 print '<div id="glz1" style="position:absolute;top:758;left:339;width:51;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T1(10)</div>'; 
 else 	 print '<div id="glz1" style="position:absolute;top:758;left:339;width:51;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T1(10)</div>'; 
 if ($devices[72])
	 print '<div id="glz2" style="position:absolute;top:758;left:395;width:51;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T2(13)</div>'; 
 else 	 print '<div id="glz2" style="position:absolute;top:758;left:395;width:51;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T2(13)</div>'; 
 // end ���������� ----------------

 // ������� -----------------------
 if ($vvklfab1) print '<div id="sg_glz_1" style="position:absolute;top:598;left:479;width:77;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 1 ���.</div>'; 
 else print '<div id="sg_glz_2" style="position:absolute;top:598;left:479;width:77;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 1 ����</div>'; 
 if ($vvklfab2) print '<div id="sg_glz_2" style="position:absolute;top:598;left:565;width:77;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���� 2 ���.</div>'; 
 else print '<div id="sg_glz_2" style="position:absolute;top:598;left:565;width:77;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���� 2 ����</div>'; 
 if ($gvklfab1) print '<div id="sv_glz_1" style="position:absolute;top:630;left:479;width:77;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 1 ���.</div>'; 
 else print '<div id="sv_glz_2" style="position:absolute;top:630;left:479;width:77;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 1 ����</div>'; 
 if ($gvklfab2) print '<div id="sv_glz_2" style="position:absolute;top:630;left:565;width:77;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">��� 2 ���.</div>'; 
 else print '<div id="sv_glz_2" style="position:absolute;top:630;left:565;width:77;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">��� 2 ����</div>'; 
	
 print '<div id="tv31" style="position:absolute;top:667;left:550;width:100;height:30">'.$tfab_v1.' C</div>'; 
 print '<div id="tv32" style="position:absolute;top:702;left:550;width:100;height:30">'.$tfab_v2.' C</div>'; 
 if ($devices[102])
	 print '<div id="opr1" style="position:absolute;top:697;left:719;width:51;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T1(10)</div>'; 
 else 	 print '<div id="opr1" style="position:absolute;top:697;left:719;width:51;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T1(10)</div>'; 
 // end ������� -------------------

 // ����� -------------------------
 if ($vklkot1) print '<div id="s_kot_1" style="position:absolute;top:82;left:15;width:132;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">����� 1 �������</div>'; 
 else print '<div id="s_kot_2" style="position:absolute;top:82;left:15;width:132;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">����� 1 ��������</div>'; 
 if ($vklkot2) print '<div id="s_kot_2" style="position:absolute;top:82;left:157;width:132;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">����� 2 �������</div>'; 
 else print '<div id="s_kot_2" style="position:absolute;top:82;left:157;width:132;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">����� 2 ��������</div>'; 


 print '<div id="g1" style="position:absolute;top:117;left:60;width:100;height:30">'.$tkot1.' C</div>'; 
 print '<div id="g2" style="position:absolute;top:150;left:60;width:100;height:30">'.$qkot1.' �3</div>'; 
 print '<div id="g3" style="position:absolute;top:185;left:60;width:100;height:30">'.$pkot1.' ���</div>'; 
 print '<div id="g4" style="position:absolute;top:219;left:60;width:100;height:30">'.$vkot1.' �3/�</div>'; 
 print '<div id="g5" style="position:absolute;top:117;left:200;width:100;height:30">'.$tkot2.' C</div>'; 
 print '<div id="g6" style="position:absolute;top:150;left:200;width:100;height:30">'.$qkot2.' �3</div>'; 
 print '<div id="g7" style="position:absolute;top:185;left:200;width:100;height:30">'.$pkot2.' ���</div>'; 
 print '<div id="g8" style="position:absolute;top:219;left:200;width:100;height:30">'.$vkot2.' �3/�</div>'; 

 if ($devices[41])
	 print '<div id="kot1" style="position:absolute;top:214;left:343;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T1(06M)</div>'; 
 else 	 print '<div id="kot1" style="position:absolute;top:214;left:343;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T1(06M)</div>'; 
 if ($devices[42])
	 print '<div id="kot2" style="position:absolute;top:214;left:400;width:50;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">T2(03)</div>'; 
 else 	 print '<div id="kot2" style="position:absolute;top:214;left:400;width:50;height:23;background-color:'.$color_none.';font-size:11px;text-align:center">T2(03)</div>'; 
 // end ����� ---------------------

 // elec
 print '<div id="e1" style="position:absolute;top:165;left:330;width:150;height:30">'.$elec1.' ���/�</div>'; 
 print '<div id="e2" style="position:absolute;top:344;left:330;width:100;height:30">'.$elec2.' ���/�</div>'; 
 print '<div id="e3" style="position:absolute;top:496;left:300;width:100;height:30">'.$elec3.' ���/�</div>'; 
 print '<div id="e4" style="position:absolute;top:664;left:343;width:100;height:30">'.$elec4.' ���/�</div>'; 
 print '<div id="e5" style="position:absolute;top:342;left:825;width:100;height:30">'.$wgru.' ���/�</div>'; 
 print '<div id="e6" style="position:absolute;top:508;left:808;width:100;height:30">'.$elec6.' ���/�</div>'; 
 print '<div id="e7" style="position:absolute;top:153;left:1130;width:100;height:30">'.$elec7.'</div>'; 
 print '<div id="e9" style="position:absolute;top:450;left:1135;width:100;height:30">'.$elec9.' ���/�</div>'; 
 print '<div id="e10" style="position:absolute;top:658;left:662;width:100;height:30">'.$wfab.' ���/�</div>'; 
 print '<div id="e11" style="position:absolute;top:678;left:1125;width:100;height:30">'.$elec11.' ���/�</div>'; 

 // GRU -------------------------------
 if ($gvklgru1) print '<div id="sg_gru_1" style="position:absolute;top:271;left:731;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���.1 ���.</div>'; 
 else print '<div id="sg_gru_1" style="position:absolute;top:271;left:731;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���.1 ����</div>'; 
 if ($gvklgru2) print '<div id="sg_gru_2" style="position:absolute;top:306;left:731;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���.2 ���.</div>'; 
 else print '<div id="sg_gru_2" style="position:absolute;top:306;left:731;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���.2 ����</div>'; 
 if ($gvklgru3) print '<div id="sg_gru_3" style="position:absolute;top:339;left:731;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">���.3 ���.</div>'; 
 else print '<div id="sg_gru_3" style="position:absolute;top:339;left:731;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">���.3 ����</div>'; 

 if ($vvklgru1) print '<div id="sg_gru_1" style="position:absolute;top:271;left:646;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">����.1 ���.</div>'; 
 else print '<div id="sv_gru_1" style="position:absolute;top:271;left:646;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">����.1����</div>'; 
 if ($vvklgru2) print '<div id="sg_gru_2" style="position:absolute;top:305;left:646;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">����.2 ���.</div>'; 
 else print '<div id="sv_gru_2" style="position:absolute;top:305;left:646;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">����.2����</div>'; 
 if ($vvklgru3) print '<div id="sg_gru_3" style="position:absolute;top:339;left:646;width:78;height:23;background-color:'.$color_on.';font-size:11px;text-align:center">����.3 ���.</div>'; 
 else print '<div id="sv_gru_3" style="position:absolute;top:339;left:646;width:78;height:23;background-color:'.$color_off.';font-size:11px;text-align:center">����.3����</div>'; 

 print '<div id="tsh3" style="position:absolute;top:274;left:560;width:150;height:30">'.$tsh3.'</div>';
 print '<div id="tsh4" style="position:absolute;top:302;left:560;width:100;height:30">'.$tsh4.'</div>';

 //print '<div id="tgru" style="position:absolute;top:342;left:525;width:150;height:30">'.$tgru.' C</div>';
 print '<div id="qgru" style="position:absolute;top:374;left:525;width:150;height:30">'.$qgru.' �3/�</div>';
 //print '<div id="pgru" style="position:absolute;top:406;left:525;width:150;height:30">'.$pgru.' ���</div>';
 //print '<div id="wgru" style="position:absolute;top:342;left:725;width:150;height:30">'.$wgru.' kWt</div>';

 if ($devices[91])                                            
	 print '<div id="gru1" style="position:absolute;top:401;left:811;width:51;height:24;background-color:'.$color_on.';font-size:11px;text-align:center">T1(10)</div>'; 
 else 	 print '<div id="gru1" style="position:absolute;top:401;left:811;width:51;height:24;background-color:'.$color_none.';font-size:11px;text-align:center">T1(10)</div>'; 
 if ($devices[92])
	 print '<div id="gru2" style="position:absolute;top:401;left:867;width:52;height:24;background-color:'.$color_on.';font-size:11px;text-align:center">T2(13)</div>'; 
 else 	 print '<div id="gru2" style="position:absolute;top:401;left:867;width:52;height:24;background-color:'.$color_none.';font-size:11px;text-align:center">T2(13)</div>'; 
 // end GRU ---------------------------

 print '<div id="pgru" style="position:absolute;top:765;left:1140;width:150;height:30">'.$tnv.' C</div>'; 
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
 </style>';

 <?php
 $query = 'SELECT * FROM uzels LIMIT 1';
 $e = mysql_query ($query,$i); $cn=0;
 if ($e) $ui = mysql_fetch_row ($e);
 if (0)
 while ($ui)
	{
 	 $device=$ui[5];
	 print '<div id="inf33" class="dv" style="position:absolute;top:80;left:800;width:410;height:300;visibility:hidden;">';
	 print '<br><img src="charts/trend8.php?device=1&prm=14&min=1900&max=2200">';
	 print '<br><font style="font-family:verdana; font-weight:bold; font-size:12px">'.$ui[1].'</font><br>';

	 $query = 'SELECT * FROM channels WHERE device='.$device;
	 $e2 = mysql_query ($query,$i); $cn=0;
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 while ($uo)
		{
		 print '<font style="font-size:11px; font-weight:normal">'.$uo[1].'</font>&nbsp;&nbsp;&nbsp;<font style="font-weight:bold">';
		 if ($uo[9]==2) print rand(0,1);	 
		 if ($uo[9]==4) print number_format(rand(2000,4000)/100,2);
		 if ($uo[9]==11) print number_format(rand(1000,2000)/10,2);	 
		 if ($uo[9]==14) print number_format(rand(200,5000)/10,2);	 
		 if ($uo[9]==16) print number_format(rand(100,500)/1000,2);	 
		 print '<br>';	 
		 $uo = mysql_fetch_row ($e2);  $cn++;
		}
	 print '</div>';
	 $ui = mysql_fetch_row ($e);
	}
?>