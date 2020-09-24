<?php
    const titre = "Muelle Viejo";
    const prixBaseA = 15.50;
    const prixBaseW = 42;
    const prixBaseP = 50;


    $jours = $_GET['jours'] ?? 1; //valider les entrees du nombre de jours dans le query string
    if ($jours >=1 && $jours <=30){
        $jours = $jours;
        }     
    else {
        $jours = 1; 
    }


    if ($jours >=2) { $s = "s"; } else { $s = ""; } // mettre le s au pluriel de jour   

    $catOutil = $_GET['catOutil'] ??'A';  // valider les entrees de la catOutil dans le query string
    
    if($catOutil ===  'A' || $catOutil ===  'W' || $catOutil ===  'P'){
            $catOutil = $catOutil;
        } 
    else {
        $catOutil = 'A';
    }
    
    $costoBase = costoBase($jours, $catOutil); // appeler la fonction principale qui calcule le coût de location sans rabais
   
    if ($jours >3){    // appeler la fonction 20% de réduction si jours supérieure  à trois 
        $rabais20 = rabais20($costoBase, $catOutil);
    }
    else{
        $rabais20 = $costoBase; 
    }
    
    $rabaisPrixTotal = number_format(rabaisFinal($rabais20), 2,'.',''); // appeler la fonction rabaisFinal en fonction de rabais20
    $economie = $costoBase - $rabaisPrixTotal; // calculer le montant $ d'économie 
   
    if ($economie > 0){  // affiche la deuxième partie du message s'il y a économie
        $message = ', une économie de <span class="backblack">' .number_format($economie, 2,'.','')  . ' $ </span>  sur le prix régulier.';        
    }
    else{
        $message = ".";      
    }

    function rabais20(float $costoBase, string $catOutil) : float{
        if ($catOutil === 'W'){
          return $costoBase - $costoBase * 0.2; //obtenir 20%
        }
        else if ($catOutil === 'P'){
          return $costoBase - $costoBase * 0.2;
        }
        else{
            return $costoBase;
        }
    }

    function rabaisFinal(float $rabais20): float{
        if ($rabais20 >=200){
         return $rabais20 - 0.05 * $rabais20; //obtenir 5%
        }
        else{
            return $rabais20;
        }
    } 

    function costoBase(int $jours, string $catOutil) : float { // fonction calcule coût de base selon la catégorie et la quantité de jour
       if ($catOutil === 'A'){
          $calculBase = $jours * prixBaseA;
       }
       else if ($catOutil === 'W'){
         $calculBase = $jours * prixBaseW;
        }
       else if ($catOutil === 'P'){
         $calculBase = $jours * prixBaseP;
       }
       else{
         $calculBase = 0;  
        }
        
       return $costoBase = $calculBase ;  // renvoie le résultat du calcul du coût de location de base
    }
?>
   
<!DOCTYPE html>
    <html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <title><?= titre?></title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Location d'outils <?=titre ?></h1>
        <h2>Estimation</h2>
        <p style="line-height:25px"> Pour la location d'un outil de catégorie <span class="backblack" >  <?=$catOutil?></span> 
        pendant <span class="backblack"><?=$jours?></span>jour<?=$s?>, le coût total de la location <u><b>avant taxes</b></u> 
        sera <span class="backblack"><?=$rabaisPrixTotal?> $</span>  <span><?=$message?></span>  
        </p>
        <br/>
        <p id="buttonsPagEtimation">
        <a href="modifierjours.php?jours=<?php echo $_GET['jours']; ?>&catOutil=<?php echo $_GET['catOutil']; ?>"> <b>Modifier</b></a>
        <a href="index.php"><b>Nouvelle estimation</b></a>
        </p>
    </body>
</html>
    