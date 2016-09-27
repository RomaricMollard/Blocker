<?php

try
	{include('sql.php');}
	catch(Exception $e)
	{die('Erreur : '.$e->getMessage());}

$score_easy = $_GET['e'];
$score_hard = $_GET['h'];
$score_insane = $_GET['i'];
$id = $_GET['u'];
$name = $_GET['n'];
$code = $_GET['c'];

if($score_easy%$id==0 AND $code%42 == 0 AND $code%12 == 0 AND $score_easy>0 AND $id>0 AND $code>0){
	
	$score_easy = $score_easy/$id;
	
	$a = "0";
	$reponse = $bdd->query("SELECT * FROM BLOCKER_NAMES WHERE IDU='$id'");
	while ($donnees = $reponse->fetch())
	{
	$a='1';
	}
	
	if($a=="0"){
		$bdd->query("INSERT INTO BLOCKER_NAMES VALUES('$id','$name')");
		$bdd->query("INSERT INTO BLOCKER_SCORES VALUES('$id','0','0','0')");
	}
	
	$bdd->query("UPDATE BLOCKER_NAMES SET NAME = '$name' WHERE IDU = '$id'");
	
	$bdd->query("UPDATE BLOCKER_SCORES SET EASY = '$score_easy' WHERE IDU = '$id' AND EASY<'$score_easy'");
	$bdd->query("UPDATE BLOCKER_SCORES SET HARD = '$score_hard' WHERE IDU = '$id' AND HARD<'$score_hard'");
	$bdd->query("UPDATE BLOCKER_SCORES SET INSANE = '$score_insane' WHERE IDU = '$id' AND INSANE<'$score_insane'");
	
}

?>
<table width="100%" style="font-family: Helveltica, sans-serif;color: #aaa;font-size:15px;">
<tr><td valign="top"  style="color:#333;font-size:20px">
Easy
</td><td>

<table width="100%" style="font-family: Helveltica, sans-serif;color: #aaa;font-size:15px;">
<tr>
<td style="color:#333">Name</td>
<td style="color:#333">Highscore</td>
</tr>
<?php

$reponse = $bdd->query("SELECT * FROM BLOCKER_SCORES S JOIN BLOCKER_NAMES N ON S.IDU = N.IDU ORDER BY EASY DESC LIMIT 5");
	while ($donnees = $reponse->fetch())
	{
	 print "<tr><td>".$donnees["NAME"]."</td><td>".number_format($donnees["EASY"] , 0 , "," , " " )."</td></tr>";
	}

?>
</table>

</td><tr>
<tr><td valign="top"  style="color:#333;font-size:20px">
HARD
</td><td>

<table width="100%" style="font-family: Helveltica, sans-serif;color: #aaa;font-size:15px;">
<tr>
<td style="color:#333">Name</td>
<td style="color:#333">Highscore</td>
</tr>
<?php

$reponse = $bdd->query("SELECT * FROM BLOCKER_SCORES S JOIN BLOCKER_NAMES N ON S.IDU = N.IDU ORDER BY HARD DESC LIMIT 5");
	while ($donnees = $reponse->fetch())
	{
	 print "<tr><td>".$donnees["NAME"]."</td><td>".number_format($donnees["HARD"] , 0 , "," , " " )."</td></tr>";
	}

?>
</table>

</td><tr>
<tr><td valign="top"  style="color:#333;font-size:20px">
INSANE
</td><td>

<table width="100%" style="font-family: Helveltica, sans-serif;color: #aaa;font-size:15px;">
<tr>
<td style="color:#333">Name</td>
<td style="color:#333">Highscore</td>
</tr>
<?php

$reponse = $bdd->query("SELECT * FROM BLOCKER_SCORES S JOIN BLOCKER_NAMES N ON S.IDU = N.IDU ORDER BY INSANE DESC LIMIT 5");
	while ($donnees = $reponse->fetch())
	{
	 print "<tr><td>".$donnees["NAME"]."</td><td>".number_format($donnees["INSANE"] , 0 , "," , " " )."</td></tr>";
	}

?>
</table>

</td><tr>
</table>