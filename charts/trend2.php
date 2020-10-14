<?php
include ("../../jpgraph2/jpgraph.php");
include ("../../jpgraph2/jpgraph_log.php");
include ("../../jpgraph2/jpgraph_line.php");
include ("../../jpgraph2/jpgraph_bar.php");
include("../config/local.php");
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);

$max=200;
$type=1;
if ($_GET["type"]) $type=$_GET["type"];

if ($type!=1) $query = 'SELECT * FROM data WHERE type='.$type.' AND channel='.$_GET["chan"].' ORDER BY date DESC LIMIT 200';
else $query = 'SELECT * FROM hours WHERE type='.$type.' AND channel='.$_GET["chan"].' AND value<100 ORDER BY date DESC LIMIT 200';
if ($a = mysql_query ($query,$i))
while ($uy = mysql_fetch_row ($a))
	{	 
	 $datas0[$rr]=$uy[3];
	 $dats[$rr]=$uy[2]; 
	 $rr++;
	 if ($rr>$max) break;
	}

 for ($i2=0; $i2<$max; $i2++) 
	{ 	 
	 if ($_GET["type"]==1) $dat[$i2]=$dats[$max-$i2][8].$dats[$max-$i2][9].'/'.$dats[$max-$i2][11].$dats[$max-$i2][12]; 
	 if ($_GET["type"]==1) $dat[$i2]=$dats[$max-$i2][5].$dats[$max-$i2][6].'-'.$dats[$max-$i2][8].$dats[$max-$i2][9]; 
	 $data0[$i2]=$datas0[$max-$i2];
	}

// Create the graph. These two calls are always required
if ($_GET["x"]!='') $graph = new Graph($_GET["x"],$_GET["y"],"auto");
else $graph = new Graph(850,200,"auto");	

$graph->img->SetMargin(35,15,22,22);
//$graph->SetMargin(30,20,60,20);
$graph->SetMarginColor('white');
$graph->SetScale("linlin");
$graph->SetFrame(false);
$graph->title->SetFont(FF_ARIAL,FS_BOLD,8);

$name=$_GET["name"].'                          '; 
$graph->tabtitle->Set($name);
$graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,8);
$graph->tabtitle->SetWidth(TABTITLE_WIDTHFIT);
$graph->xgrid->Show();
$graph->xgrid->SetColor('gray@0.5');
$graph->ygrid->SetColor('gray@0.5');

$graph->SetScale("textlin");
$graph->SetShadow();

$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);

// Create the linear plot
$lineplot=new LinePlot($data0);

// Add the plot to the graph
$graph->Add($lineplot);

$graph->SetMarginColor('white');
$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
//----------- legend -------------------
//$graph->xaxis->SetLabelAngle(45);
$lineplot->SetColor("red");
$lineplot->SetWeight(2);

//$graph->yaxis->SetWeight(1);
$graph->xaxis->SetTickLabels($dat);
//$graph->legend->Pos(0.15,0.02);
//--------------------------------------
// Display the graph
//$graph->xaxis->HideLabels();
$graph->xaxis->SetTextTickInterval(200,0);
JpGraphError::SetImageFlag(false);

try {
     $graph->Stroke();
    }
catch ( JpGraphException $e ) 
	{ }
//$graph->Stroke();
?>                   