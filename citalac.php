
<?php include "konekcija.php"?>
<?php include "klase.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="./styles.css" />
<style>
 a{
    color: yellow;
    text-decoration: none;
  }

  /* body {
  padding: 0;
  font-weight: 10px;
  background-color: rgb(65,105,225);
  color: #000;
  } */

  label{
    background-color: #FFFF99;
  }

  body {
  padding: 0;
  font-weight: 10px;
  background: url("mojaBiblioteka.jpg") no-repeat ;
 background-size:1400px 760px;
    margin:100px;
  color: red;
  }

  input{
     background-color: #FFCC99;
     color: black;
  }

  select{
    background-color: #FFCC99;
     color: black;
  }

  button{
    font-weight: bold;
    background-color: #ffb266;
    color: black;
  }

  th{
     background-color: #ffb266;
  }

  td{
     background-color: #FFCC99;
  }
</style>
<script src="skripta.js"></script>

 <title>Čitalac</title>
</head>
<body>

    <!-- div za prikaz svih blokova -->
    <div id="prikaziSveStoPostoji" style="display:none">
      <label for="nmp">Prikaži sve: </label>
      <a href="citalac.php"><input type="submit" value="Potvrdi" name="nmp"></a>
    </div>
    

    <!-- prikaz svih citalaca -->
    <div id="sviMojiCitaoci">
    <p>Ukoliko želite da vidite sve čitaoce biblioteke, kliknite na
     <a href="svicitaoci.php" target="_blank">svi čitaoci</a>.
    </p>
    </div>

    <!-- forma za dodavananje citalaca -->
    <div id="unosimCitaoca">
    <fieldset>
      <form action="" id="citaoc" name="unosCitaoca" method="post">
      <label for="">Dodajte novog čitaoca: </label><br><br>
        <!-- <p>Dodajte novog čitaoca: </p> -->
        <label for="ime">Ime:</label><br>
        <input type="text" name="ime" id="ime" placeholder="Unesi ime"> <br><br>
        <label for="prezime">Prezime: </label><br>
        <input type="text" name="prezime" id="prezime" placeholder="Unesi prezime"> <br><br>
        <label for="kategorija">Kategorija: </label><br>
        <input type="text" name="kategorija" id="kategorija" placeholder="Unesi kategoriju"> <br>
        <br>
        <button type="submit" name="unesiCitaoca"onclick="proveriFormuZaUnosCitaoca()">Unesi u bazu</button>
        <br>
    </form>
    <br>
    <input type="submit" value="Rezultat" onclick="skloniBlokove(blok1, 'prikaziSveStoPostoji')">
    </fieldset>
    </div>
    <br>

    <div id="proveravamCitaoca">
      <!-- forma za proveru -->
      <fieldset>
      <form action="" name="proveravanje" method="post">
      <label for="">Proverite koje knjige je uzeo konkretan čitalac/obrišite čitaoca: </label><br><br>
      <!-- <p>Proverite koje knjige je uzeo konkretan čitalac/obrišite čitaoca: </p> -->
        <label for="prov">Čitalac: </label>
        <select name="ponudaCitaoca" id="prov">
          <?php
            $rez = Citalac::vratiSveCitaoce($link);
            while($citalac = mysqli_fetch_array($rez))
            {
              $imePrezime = $citalac['ime'].' '.$citalac['prezime'];
          ?>    
              <option value="<?php echo $imePrezime?>"><?php echo $imePrezime?></option>
          <?php    
            } 
          ?>  
        </select>
        <button type="submit" name="provera">Proveri</button>
        <button type="submit" name="brisanjeCitaoca" value="Obriši">Obriši</button>
      </form>
      <br>
     <input type="submit" value="Rezultat" onclick="skloniBlokove(blok2, 'prikaziSveStoPostoji')">
      </fieldset>
      </div>
      <br>

      <!-- razduzivanje/zaduzivanje -->
      <div id="zaduzujem-razduzujemCitaoca">
      <fieldset>
      <form action="" method="post" name="zaduzivanje-razduzivanje">
        <label for="">Unesite novo zaduživanje čitaoca/razdužite čitaoca:</label><br><br>
        <!-- <p>Unesite novo zaduživanje čitaoca/razdužite čitaoca:</p>  -->
          <label for="citic">Čitalac: </label>
          <select name="ponudaCitalaca" id="citic">
          <?php
            $rez = Citalac::vratiSveCitaoce($link);
            while($citalac = mysqli_fetch_array($rez))
            {
              $imePrezime = $citalac['ime'].' '.$citalac['prezime'];
          ?>    
              <option value="<?php echo $imePrezime?>"><?php echo $imePrezime?></option>
          <?php    
            } 
          ?>  
          </select>
          <label for="knjiga">Knjiga: </label> 
          <select name="ponudaKnjiga" id="knjiga">
            <?php
              $rez = Knjiga::vratiSveKnjige($link);
              while($knjiga = mysqli_fetch_array($rez))
              {
                $naslov = $knjiga['imeKnjige'];
              ?>
                <option value="<?php echo $naslov ?>"><?php echo $naslov ?></option>      
            <?php
              }
            ?>
          </select>
          <button type="submit" name="zaduzivanje">Zaduži</button>
          <button type="submit" name="razduzivanje">Razduži</button>
      </form>
      <br>
      <input type="submit" value="Rezultat" onclick="skloniBlokove(blok2, 'prikaziSveStoPostoji')">
      </fieldset>
      </div>
    

      <script>
        var svi = ["sviMojiCitaoci" ,"unosimCitaoca", "proveravamCitaoca", "zaduzujem-razduzujemCitaoca"];
        var blok1 = ["sviMojiCitaoci", "proveravamCitaoca", "zaduzujem-razduzujemCitaoca"];
        var blok2 = ["sviMojiCitaoci", "unosimCitaoca", "zaduzujem-razduzujemCitaoca"];
        var blok3 = ["sviMojiCitaoci", "unosimCitaoca", "proveravamCitaoca"];

      </script>
</body>
</html>

<?php
  //  upisivanje novog citaoca u bazu 
  if(isset($_POST['unesiCitaoca']))
  {
    if($_POST['ime'] !== "" && $_POST['prezime'] !== "" && $_POST['kategorija'] !== "")
    {
        $citalac = new Citalac($_POST['ime'], $_POST['prezime'], $_POST['kategorija']);
        //provera da li postoji u bazi
        if(!$citalac->postojiUBazi($link))
          $citalac->upisiUBazu($link);
        else
           echo "Citalac vec postoji u bazi!";
    }

  }

  //provera koju knjigu je uzeo koji korisnik
  if(isset($_POST['provera']))
  {
    $vrednost = $_POST['ponudaCitaoca'];
    $povratniNiz = Citalac::iseciImePrezime($vrednost);
    $id = Citalac::vratiIDcitaoca($link, $povratniNiz['ime'], $povratniNiz['prezime']);
    $rezultatUpita = UzeoKnjigu::vratiSpojenoCitalacKnjigaPisac($link);

    echo '<table border="2">';
    echo '<tr>';
      echo '<th>'; echo 'Ime' ; echo '</th>';
      echo '<th>'; echo 'Prezime' ; echo '</th>';
      echo '<th>'; echo 'Knjiga' ; echo '</th>';
      echo '<th>'; echo 'Pisac' ; echo '</th>';
    echo '</tr>';
    while($korisnik = mysqli_fetch_array($rezultatUpita))
    {
      if($korisnik['citalacID'] == $id)
      {
        echo '<tr>';
          echo '<th>'; echo $korisnik['ime'] ; echo '</th>';
          echo '<th>'; echo $korisnik['prezime'] ; echo '</th>';
          echo '<th>'; echo $korisnik['imeKnjige'] ; echo '</th>';
          echo '<th>'; echo $korisnik['imePisca'].' '.$korisnik['prezimePisca'] ; echo '</th>';
      echo '</tr>';
      }
    }
    echo '</table>'; 
  }

  //brisanje konkretnog citaoca
  if(isset($_POST['brisanjeCitaoca']))
  {
    $vrednost = $_POST['ponudaCitaoca'];
    $povratniNiz = Citalac::iseciImePrezime($vrednost);
    $id = Citalac::vratiIDcitaoca($link, $povratniNiz['ime'], $povratniNiz['prezime']);
    Citalac::izbaciCitaoca($link, $id);
  }



  //unos zaduzenja
  if(isset($_POST['zaduzivanje']))
  {
    $imePrezime = $_POST['ponudaCitalaca'];
    $imeKnjige = $_POST['ponudaKnjiga'];
    $idKnjige = Knjiga::vratiIDKnjigeNaOsnovuImena($link, $imeKnjige);
    $povratniNiz = Citalac::iseciImePrezime($imePrezime);
    $citalacID = Citalac::vratiIDcitaoca($link, $povratniNiz['ime'], $povratniNiz['prezime']);
    
    if(UzeoKnjigu::postojiParCitalacKnjiga($link, $citalacID, $idKnjige))
      die("Čitalac $imePrezime je već zadužio knjigu $imeKnjige.");

    UzeoKnjigu::ubaciParCitalacKnjigaUBazu($link, $citalacID, $idKnjige);
    
  }
  //razduzivanje citaoca
  if(isset($_POST['razduzivanje']))
  {
    $imePrezime = $_POST['ponudaCitalaca'];
    $imeKnjige = $_POST['ponudaKnjiga'];
    $idKnjige = Knjiga::vratiIDKnjigeNaOsnovuImena($link, $imeKnjige);
    $povratniNiz = Citalac::iseciImePrezime($imePrezime);
    $citalacID = Citalac::vratiIDcitaoca($link, $povratniNiz['ime'], $povratniNiz['prezime']);
    
    if(!UzeoKnjigu::postojiParCitalacKnjiga($link, $citalacID, $idKnjige))
      die("Čitalac $imePrezime nije uzeo knjigu $imeKnjige.");

    UzeoKnjigu::izbaciParCitalacKnjiga($link, $citalacID, $idKnjige);

  }



?>
