





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/2000/REC-xhtml1-20000126/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="data/athene.ico" type="image/x-icon"/>
<title>Arkisto - Athene</title>
<link rel="stylesheet" href="data/athene.css"/>
<script>
function getVote(int) {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("poll").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","vote.php?vote="+int,true);
  xmlhttp.send();
}
</script>
</head>

<body>
<!-- erityishuomioita:
        - keskitystŠ ei saa tŠllŠ skaalautuvuus-systeemillŠ
          toimimaan ainakaan safarissa
 -->
<table summary="maintable" cellspacing="0" cellpadding="0">
	<tr>
		<!-- spacereita kŠytetŠŠn pakottamaan leiskan minimikoko, 200px + 200px + 200px -->
		<td><img class="spacer" alt="" src="data/spacer.gif"/></td>
		<td><img class="spacer" alt="" src="data/spacer.gif"/></td>
		<td><img class="spacer" alt="" src="data/spacer.gif"/></td>
	</tr>
	<tr>
		<!-- otsikkopalkki -->
		<td colspan="3" class="titlemainbg" width="800" height="100"><a href="/"><img alt="Athene - informaatioverkostojen kilta" src="data/logo2.gif" width="600" height="100"/></a></td>
	</tr>
	<tr>
		<td width="200" valign="top" class="sidestatic">
			<!-- tulevat tapahtumat -->
			<div class="side1">

		<table summary="tulevat tapahtumat" cellspacing="0" cellpadding="0" width="190">
<tr><td colspan="2" class="sidetitlebg">
<h3 class="side1title">Mikä ihmeen arkisto?</h3>
</td>
</tr>
<tr>
<td class="sidecontentrow"><p>Athenen arkistoon on koottu killan digitaalista historiaa. Arkiston ulkoasu pohjautuu Athenen ensimmäisiin omiin verkkosivuihin. Jos täältä puuttuu jotain joka todellakin pitäisi tänne laittaa, ota yhteyttä tietskarijengiin.</p>
</td>
</tr>
</table>

			</div>
			<!-- keskusteluryhmien uudet viestit -->
			<div class="side2">


		<table summary="keskusteluryhmat" cellspacing="0" cellpadding="0" width="190">
<tr><td colspan="3" class="sidetitlebg"><h3 class="side2title">Uusimmat lisäykset</h3>
<?php
$filename = "data/additions.txt";
$content = file($filename);
for($i = 1; $i <= 5; $i++){
  $entry = $content[count($content)-$i];
  $entry = explode(" ",$entry,2);
  echo "<tr><td class='sidecontentrow'>".date("d.m.y",$entry[0])."</td><td class='sidecontentrow'>".$entry[1]."</td></tr>";
}
?>
</td>
</tr>
<tr>
<td class="sidecontentrow"><p></p>
</td>
</tr>
</table>


			</div>
			<!-- tŠmŠnhetkinen kysely -->

			<div class="side3">
	<table summary="kysely" cellspacing="0" cellpadding="0" width="190">
		<tr>
			<td class="sidetitlebg">
        <h3 class="side3title">Kysely</h3>
			</td>
		</tr>
		<tr>
			<td class="sidecontentrow">
        <p>Oliko ennen kaikki paremmin?</p>
        <div id="poll">
        <form>
        <input type="radio" name="vote" value="1" onclick="getVote(this.value)"> Kyllä
        <br>
        <input type="radio" name="vote" value="2" onclick="getVote(this.value)"> Ei
        <span style="display:none;">
        <br>
        <input type="radio" name="vote" value="3" onclick="getVote(this.value)"> Olen neitsyt
        </span>
        </form>
        </div>
        </div>
	</td>
		</tr>
	</table>
</div>
			<div class="sidebottom"/>
		</td>
		<td width="400" valign="top" class="contentbg">
			<!-- pŠŠotsikko ja varsinainen sisŠltš -->
			<div class="maintitle">
				<h2>Arkisto</h2>
			</div>
			<div class="maincontent">
      <?php

      $overrides = array(

        "kaljakroketti" => "Kaljakrokettiturnaus 2011",
        "phuksibileet/2002" => "Club Havana",
        "phuksibileet/2003" => "Club Mañana",
        "phuksibileet/2008" => "Club Anamñam",
        "phuksibileet/2010" => "Club Tease",
        "phuksibileet/2012" => "Club Avast",
		    "phuksibileet/2017" => "Club Amazon",

      );

      function check_addition($title){
        $filename = "data/additions.txt";
        $content = file($filename);

        foreach($content as $row){
          $check = trim(explode(" ", $row, 2)[1]);
          if($check==$title){ return true; }
        }

        file_put_contents($filename, time()." ".$title.PHP_EOL, FILE_APPEND | LOCK_EX);
      }

      function page_title($url) {
        $fp = file_get_contents($url);
        if (!$fp)
            return null;


        $res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);

        if (!$res)
            return null;

        // Clean up title: remove EOL's and excessive whitespace.
        $title = preg_replace('/\s+/', ' ', $title_matches[1]);
        $title = trim($title);
        return $title;
      }

      foreach (scandir(".") as $url){
        $nimi = page_title($url . "/index.html");
        if($nimi == null){
          $nimi = page_title($url . "/index.htm");
        }
        if($nimi == null){
          $nimi = page_title($url . "/index.php");
        }
        if(array_key_exists($url, $overrides)){
          $nimi = $overrides[$url];
        }
        if($url != "." && $nimi != null){
          check_addition($nimi);
          echo "<a href='$url' target='_blank'><p><b>" . $nimi . "</b></p></a>";
        }
      }

      $categories = array("vuosijuhlat", "phuksibileet");

      foreach($categories as $category){
        echo "<br><h3>" . ucwords($category) . "</h3>";
        $kansio = $category . "/";
        foreach (scandir($kansio,1) as $url){
          $nimi = page_title($kansio . $url . "/index.html");
          if($nimi == null){
            $nimi = page_title($kansio . $url . "/index.htm");
          }
          if($nimi == null){
            $nimi = page_title($kansio . $url . "/index.php");
          }
          if(array_key_exists($kansio . $url, $overrides)){
            $nimi = $overrides[$url];
          }
          if(is_numeric($url) && $nimi != null){
            check_addition($nimi);
            echo "<a href='$kansio$url' target='_blank'><p><b>" . $nimi . "</b> <i>($url)</i></p></a>";
          }
        }
      }

      ?>
			</div>
		</td>
		<!-- navigaatio -->

		<td valign="top" width="200" class="naviback">

      <!--<a href="/" class="navgroup_unsel"></a>-->
			<span class="navgroup_sel">Arkisto</span>

		</td>
	</tr>
</table>
</body>
</html>
