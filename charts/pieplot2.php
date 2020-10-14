<?php
include ("../../jpgraph2/jpgraph.php");
include ("../../jpgraph2/jpgraph_pie.php");
include ("../../jpgraph2/jpgraph_pie3d.php");
include("../config/local.php");
$arr = get_defined_vars();
$today=getdate ();

$data[0]=$_GET["da1"];
$data[1]=$_GET["da2"];
$data[2]=$_GET["da3"];
$data[3]=$_GET["da4"];

$dat[0]=$_GET["dat1"];
$dat[1]=$_GET["dat2"];
$dat[2]=$_GET["dat3"];
$dat[3]=$_GET["dat4"];

// Create the Pie Graph 
$graph = new PieGraph(300,280,"auto");
$graph->SetShadow();

// Set A title for the plot
$graph->title->SetFont(FF_ARIAL,FS_BOLD,7);

// Create
$p1 = new PiePlot3D($data);
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,9);
$graph->title->SetFont(FF_ARIAL,FS_BOLD,12);
$graph->title->SetColor("darkblue");
$graph->img->SetMargin(0,0,0,0);

$p1->SetAngle(50);
$p1->SetLegends($dat);

$p1->SetSliceColors(array('green','#ee5544','#eeee33','#ee80ee','#775577','#335555'));
$p1->SetCenter(0.49,0.62);
$p1->SetSize(133);
$p1->SetStartAngle(20); 
//$name='Отчет '.$month.','.$today["year"];
//$graph->title->Set($name);
$p1->value->SetColor("darkred");
$p1->SetLabelPos(0.5);
$graph->legend->SetAbsPos(5,5,'left','down');

$graph->Add($p1);
$graph->Stroke();
?>