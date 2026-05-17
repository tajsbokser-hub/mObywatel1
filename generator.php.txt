<?php
session_start();
if(!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!==true){header("Location: index.php");exit;}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Generator</title>
<link rel="stylesheet" href="generator.css">
</head>
<body>
<div class="wrap">
<div class="head">
<h1>Kreator</h1>
<a href="dashboard.php">← Powrót</a>
</div>
<div class="card">
<form action="api/generate.php" method="post">
<div class="field">
<label>Imię</label>
<input type="text" id="imie" name="imie" placeholder="Wpisz imię" required>
</div>
<div class="field">
<label>Nazwisko</label>
<input type="text" id="nazwisko" name="nazwisko" placeholder="Wpisz nazwisko" required>
</div>
<div class="field">
<label>Urodzony</label>
<input type="text" id="birthdate" name="birthdate" placeholder="DD.MM.RRRR" required>
</div>
<div class="row">
<div class="field">
<label>PESEL</label>
<input type="text" id="pesel" name="pesel" placeholder="Numer PESEL" required maxlength="11">
</div>
<button type="button" class="btn-sm" onclick="gen()">Losuj</button>
</div>
<div class="sep"></div>
<div class="field">
<label>URL Obrazu</label>
<input type="text" id="link_zdjecia" name="link_zdjecia" placeholder="Link do zdjęcia" required>
</div>
<div class="field">
<label>Płeć</label>
<select id="plec" name="plec" required>
<option value="">Wybierz...</option>
<option value="Mężczyzna">Mężczyzna</option>
<option value="Kobieta">Kobieta</option>
</select>
</div>
<input type="submit" class="submit" value="Zatwierdź">
</form>
</div>
</div>
<script>
function gen(){
var d=document.getElementById("birthdate").value,s=document.getElementById("plec").value;
if(!d||!s){alert("Podaj datę i płeć");return}
var p=d.split('.').map(Number);
if(p.length<3){alert("Format: DD.MM.RRRR");return}
var y=p[2]%100,m=p[1];
if(p[2]>=2000)m+=20;
var v=''+String(y).padStart(2,'0')+String(m).padStart(2,'0')+String(p[0]).padStart(2,'0')+String(Math.floor(Math.random()*1000)).padStart(3,'0')+(s==="Kobieta"?Math.floor(Math.random()*5)*2:Math.floor(Math.random()*5)*2+1);
var w=[1,3,7,9,1,3,7,9,1,3],sum=0;
for(var i=0;i<10;i++)sum+=parseInt(v[i])*w[i];
document.getElementById("pesel").value=v+((10-sum%10)%10);
}
</script>
</body>
</html>
