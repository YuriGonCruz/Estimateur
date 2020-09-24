
<?php
  const titre = "Muelle Viejo";
  $jours = $_GET['jours'] ?? 1; //valider les entrees du nombre de jours dans le query string
  if ($jours >=1 && $jours <=30){
      $jours = $jours;
      }     
  else {
      $jours = 1; 
  }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= titre?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Location d'outils: <?= titre?></h1>
    <h2>Estimateur de prix de location</h2>
    <p>SVP, veuillez indiquer la durée de la location en jours puis appuyez sur le bouton qui correspond au type d'outil:</p>
    <div  style=" margin-left:20px; ">
        <form id="form" method="GET" action="estimate.php">
            <label for="categorie">Durée (en jours): </label>
            <input type="number" name="jours" value= <?=$jours?>  min="1" max="30" style="background:lime" oninput="changeCouleur()" required> <br/><br/>
            <label  for="categorie">Catégorie:</label>
            <select id="catOutil" name="catOutil" onchange="coleurSelect()"requiered>
                <option value="A">A: Léger</option>
                <option value="W">W: Lourd</option>
                <option value="P">P: Professionel</option>
            </select>
            <br/><br/>
            <button type="submit"  > Estimate</button>
            <button type="button" onclick="jourAlea();coleurSelect();"> Random</button>
            <button type="button" onclick="resetJours()"> Reset</button>
            <br/>
        </form>
    </div>

    <script>

        function setSelectedIndex(s, valsearch) //fonction lorsque le bouton Modifier obtient la catégorie qui était A W P
        {
   
        for (i = 0; i< s.options.length; i++){ 
            if (s.options[i].value == valsearch){
            s.options[i].selected = true;
        break;
            }
        }
        return;
        }
        setSelectedIndex(document.getElementById("catOutil"),"<?=$_GET['catOutil']?>");

        coleurSelect();
         function coleurSelect(){
            let e = document.getElementById("catOutil");
            let result = e.options[e.selectedIndex].value;
            if (result === "A" ) {
                form.catOutil.style.background = "rgb(195, 241, 174)";
            } else if (result === "W") {
                form.catOutil.style.background = "rgb(248, 80, 50)";
            } else if (result === "P"){
                form.catOutil.style.background = "rgb(115, 92, 247)";
            } else {
                form.catOutil.style.background = "rgb(195, 241, 174)";
            }
        }
        changeCouleur();
        function changeCouleur(){
            let jours = form.jours.value;
            if (jours <= 10) {
            form.jours.style.background  = "lime";
            } else if (jours <= 20) {
            form.jours.style.background  = "pink";
            } else {
            form.jours.style.background  = "yellow";
            }
        } 

        function categories(){
            let temp = Math.random()*(3); // choisir la catégorie A W P random
            if (temp < 1){
                return "A";
            } else if (temp < 2){ 
                return "W";
            } else {
                return "P";
            }
        }
        function jourAlea(){
            form.catOutil.value = categories();
            form.jours.value = random(+form.jours.min, +form.jours.max);
            changeCouleur();              
        }

        function random(min, max) {
            return Math.trunc(Math.random()*(max-min+1)) + min;
        } 

        function resetJours(){
            form.jours.value = 1 ;
            form.jours.style.background  = "lime";
            form.catOutil.value ="A";
            form.catOutil.style.background = "rgb(195, 241, 174)";
        }

    </script>
</body>
</html>
