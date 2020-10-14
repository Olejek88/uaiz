<style type="text/css">
.BlockHeaderLeftRight { font-size: 9px; }
.simple { font-size: 9px; }
.simple2 { font-size: 9px;  background-color: #efefef; }
</style>
<?php

$query = 'SELECT * FROM ecm ORDER BY id1';
echo $query;
if ($e2 = mysql_query ($query,$i)) 
while ($ui2 = mysql_fetch_row ($e2))
    {
     $query = 'SELECT * FROM devices WHERE type>=21 AND type<=28 AND ecm='.$ui2[0];
     if ($e3 = mysql_query ($query,$i))
     while ($ui3 = mysql_fetch_row ($e3))
    	{
	 $year=2012;
    	 for ($pm=1; $pm<=12; $pm++)
    	    {
	     $date=sprintf ("%d%02d01000000",$year,$pm);
	     $query = 'INSERT INTO data_hours SET device='.$ui3[0].', date='.$date.', year='.$year.', month='.$pm.',value='.$ui3[$pm+29]; 
	     echo $query;
	     $e6 = mysql_query ($query,$i);
    	    }
	}
    }
?>