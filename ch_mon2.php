<?php
if ($_GET["month"]=='') $_GET["month"]=$today["mon"];
if ($_GET["year"]=='') $_GET["year"]=$today["year"];

if ($_GET["month"] && !$_POST["month"]) $_POST["month"]=$_GET["month"];
else if (!$_POST["month"]) $_GET["month"]=$_POST["month"]=$today["mon"];

if ($_GET["year"] && !$_POST["year"]) $_POST["year"]=$_GET["year"];
else if (!$_POST["year"]) $_GET["year"]=$_POST["year"]=$today["year"];

if ($_POST["month"]) $_GET["month"]=$_POST["month"];
if ($_POST["year"]) $_GET["year"]=$_POST["year"];
$reqq2='index.php?sel=eco&id=1&month='.$_POST["month"].'&year='.$_POST["year"].'&qnt='.$_POST["qnt"];

print '<form method="post" name="add" action="'.$reqq2.'">';
print '<select style="font-family:verdana; font-size:11px" id="month" name="month">';
for ($z=1;$z<=12;$z++)
   {
    print '<option value="'.$z.'" ';
    if ($z==$_GET["month"]) print 'selected '; print '>'; 
    if ($z==1) print '������'; if ($z==2) print '�������';
    if ($z==3) print '����';  if ($z==4) print '������';
    if ($z==5) print '���';    if ($z==6) print '����';
    if ($z==7) print '����';   if ($z==8) print '������';
    if ($z==9) print '��������';   if ($z==10) print '�������';
    if ($z==11) print '������';    if ($z==12) print '�������';
   }
print '</select><select id="year" name="year" style="font-family:verdana; font-size:11px">';
for ($z=0;$z<=5;$z++)
   {
    print '<option value="'.($today["year"]-$z).'" '; 
    if (($today["year"]-$z)==$_POST["year"]) print 'selected';
    print '>';
    print $today["year"]-$z;
   }
print '</select>   ';
print '<select style="font-family:verdana; font-size:11px" id="qnt" name="qnt">';
for ($z=1;$z<=12;$z++)
   {
    print '<option value="'.$z.'" ';
    if ($z==$_POST["qnt"]) print 'selected '; print '>'.$z; 
   }
print '</select>&nbsp;&nbsp;&nbsp;';
print '<input name="add" value="�������" type="submit" style="font-family:tahoma; font-size: 12px">';
print '</form>';
?>