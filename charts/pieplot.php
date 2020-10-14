<?php
include ("../../../jpgraph2/jpgraph.php");
include ("../../../jpgraph2/jpgraph_pie.php");
include ("../../../jpgraph2/jpgraph_pie3d.php");
include("../config/local.php");
$arr = get_defined_vars();
$today=getdate ();

$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
$query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
$query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
//------------------------------------------------------------------------
$query = 'SELECT * FROM uzels WHERE type=1';
$e = mysql_query ($query,$i); $cn=0;
if ($e) $ui = mysql_fetch_row ($e);
while ($ui) 
	{ 
	 $name[$cn]=$ui[1];
	 $data[$cn]=rand (100,150); $cn++;
	 $ui = mysql_fetch_row ($e);
	}

// Create the Pie Graph 
$graph = new PieGraph(500,235,"auto");
$graph->SetShadow();

// Set A title for the plot
$graph->title->SetFont(FF_ARIAL,FS_BOLD,7);

// Create
$p1 = new PiePlot3D($data);
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,8);
$graph->title->SetFont(FF_ARIAL,FS_BOLD,12);
$graph->title->SetColor("darkblue");
$graph->img->SetMargin(0,0,0,0);

$p1->SetAngle(60);
$p1->SetLegends($name);

$p1->SetSliceColors(array('green','#ee5544','#eeee33','#ee80ee','#775577','#335555'));
$p1->SetCenter(0.68,0.45);
$p1->SetSize(149);
$p1->SetStartAngle(20); 
//$name='Отчет '.$month.','.$today["year"];
//$graph->title->Set($name);
$p1->value->SetColor("darkred");
$p1->SetLabelPos(0.5);
$graph->legend->SetAbsPos(5,5,'left','down');
//$graph->legend->SetColumns(2);

$graph->Add($p1);
$graph->Stroke();
?>