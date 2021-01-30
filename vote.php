<?php
$vote = $_REQUEST['vote'];

//get content of textfile
$filename = "data/poll_result.txt";
$content = file($filename);

//put content in array
$array = explode("||", $content[0]);
$yes = $array[0];
$no = $array[1];
$virgin = $array[2];

if ($vote == 1) {
  $yes = $yes + 1;
}
if ($vote == 2) {
  $no = $no + 1;
}
if ($vote == 3) {
  $virgin = $virgin + 1;
}

//insert votes to txt file
$insertvote = $yes."||".$no."||".$virgin;
$fp = fopen($filename,"w");
fputs($fp,$insertvote);
fclose($fp);
?>

<table>
<tr>
<td>Kyllä</td>
<td>
<img src="data/poll.gif"
width='<?php echo(100*round($yes/($no+$yes+$virgin),2)); ?>'
height='20'>
<?php echo(100*round($yes/($no+$yes+$virgin),2)); ?>%
</td>
</tr>
<tr>
<td>Ei</td>
<td>
<img src="data/poll.gif"
width='<?php echo(100*round($no/($no+$yes+$virgin),2)); ?>'
height='20'>
<?php echo(100*round($no/($no+$yes+$virgin),2)); ?>%
</td>
</tr>
<tr style="display:none;">
<td>Olen<br>neitsyt</td>
<td>
<img src="data/poll.gif"
width='<?php echo(100*round($virgin/($no+$yes+$virgin),2)); ?>'
height='20'>
<?php echo(100*round($virgin/($no+$yes+$virgin),2)); ?>%
</td>
</tr>
</table>
<p style="margin-top: 8px;">Ääniä yhteensä: <?php echo $no+$yes+$virgin ?></p>
