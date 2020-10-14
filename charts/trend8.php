<?php                     
include ("../../jpgraph2/jpgraph.php");
include ("../../jpgraph2/jpgraph_log.php");
include ("../../jpgraph2/jpgraph_line.php");
include ("../../jpgraph2/jpgraph_bar.php");
include("../config/local.php");
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$max=100;

$name=$_GET["name"].'          ';
//$query = 'SELECT * FROM channels WHERE id='.$_GET["chan"];
//$u = mysql_query ($query,$i);
//if ($u) $uo = mysql_fetch_row ($u);
//if ($uo) $name=$uo[1].'          ';

for ($j=0; $j<$max; $j++) 
	{ 
	 $data0[$j]=rand ($_GET["min"],$_GET["max"])/100;
	}

$query = 'SELECT * FROM hours WHERE type=1 AND channel='.$_GET["chan"].' AND device='.$_GET["device"].' ORDER BY date DESC';
//echo $query;
$rr=0;
if ($u = mysql_query ($query,$i))
while ($uo = mysql_fetch_row ($u))
	{
	 $datas0[$rr]=$uo[3]; $dats[$rr]=$uo[2]; 
 	 $rr++;
	 if ($rr>$max) break;
	}

for ($i=0; $i<$rr; $i++) 
	{ 
	 $dat[$i]=$dats[$rr-$i-1];
	 $data0[$i]=$datas0[$rr-$i-1];
	}

//for ($i=0; $i<31; $i++) print $dat[$i].' '.$data0[$i];
// Create the graph. These two calls are always required
$graph = new Graph(400,110,"auto");	
$graph->img->SetMargin(30,10,20,5);
//$graph->SetMargin(30,20,60,20);
$graph->SetMarginColor('white');
//$graph->SetScale("linlin",0,30);
$graph->SetScale("linlin");
$graph->SetFrame(false);
$graph->title->SetFont(FF_ARIAL,FS_BOLD,8);
$graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,8);
$graph->tabtitle->Set($name);
$graph->tabtitle->SetWidth(TABTITLE_WIDTHFIT);
$graph->xgrid->Show();
$graph->xgrid->SetColor('gray@0.5');
$graph->ygrid->SetColor('gray@0.5');
$graph->SetShadow();

$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);

// Create the linear plot
$lineplot=new LinePlot($data0);

// Add the plot to the graph
$graph->Add($lineplot);
$graph->tabtitle->Set($name);
$graph->SetMarginColor('white');
$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
//----------- legend -------------------
//$graph->xaxis->SetLabelAngle(45);
//$graph->xaxis->SetTickLabels($dat);

$lineplot->SetColor("red");
$lineplot->SetWeight(2);
$lineplot->SetStepStyle();
//--------------------------------------
// Display the graph
$graph->xaxis->HideLabels();
$graph->Stroke();
?>                   