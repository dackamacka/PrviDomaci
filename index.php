<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./styles.css" />
    <title>Biblioteka</title>
<style>
 a{
    color: black;
    text-decoration: none;
  }

  /* body {
  padding: 0;
  font-weight: 10px;
  background-color: rgb(65,105,225);
  color: #000;
  } */

  h1{
    font-size: 60px;
    font-weight: bold;
    background-color: #ffb266;
    color: black;
  
  }
  body {
  padding: 0;
  font-weight: 50px;
  background: url("mojaBiblioteka.jpg") no-repeat ;
 background-size:1400px 760px;

  
  color: #990000;
  }
  h2{
    font-size: 50px;
    font-weight: bold;
    background-color: #ffb266;
    color: black;
  
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
  </head>
  <body>
  <h1>Narodna biblioteka grada Beograda</h1>
   
    <h2>Dobrodosli!</h2>
    <table border="3" bordercolor="black" cellspaicing="0" width="100%">
      <tr>
        <th><a href="citalac.php" target="_blank">Čitaoci</a></th>
        
        <th><a href="literatura.php" target="_blank">Literatura</a></th>
      </tr>
    </table>
   <br>
   <button type="submit" name="vise" id="vise">Saznajte više o biblioteci</button>
   
   <button type="submit" name="skloni" id="skloni" onclick="skloniDiv('textHaled')">Skloni tekst</button>
   <br><br>
   <button type="submit" name="pocasniDugme" id="pocasniDugme">Učitaj počasne pisce</button>
   
   <button type="submit" name="skloniPocasne" id="skloniPocasne" onclick="skloniDiv('pocasniPisci')">Skloni počasne pisce</button>
   
    
    <div id="textHaled" style="background-color:#FFCC99"></div>
    <div id="pocasniPisci" style="background-color:#FFCC99"></div>
    <script>

    //primena AJAXA 1

    //nstavila sam da se tekst iz fajla ucitava pritiskom na dugme
     document.getElementById("vise").addEventListener("click", ucitajTekst);

    //funkcija za ucitavanje teksta
    function ucitajTekst() {
      var xhr = new XMLHttpRequest();
     
      xhr.open("GET", "onama.txt", true);

      xhr.onload = function () {
        if (this.status == 200) {
          document.getElementById("textHaled").innerHTML = this.responseText; //ispisi taj tekst na stranici
        }
      };

      xhr.send();
    }

    function skloniDiv(div) {
      document.getElementById(div).innerHTML = "";
    }

    //primena AJAXA 2

    //stavila sam da se niz korisnika iz json fajla ucita pritiskom na dugme
    document.getElementById("pocasniDugme").addEventListener("click", ucitajPisce);
    
    //funkcija za ucitavanje pisaca
    function ucitajPisce() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "pocasni.json", true);

        xhr.onload = function () {
          if (this.status == 200) {
            var pisci = JSON.parse(this.responseText); //funkcija koja je potrebna kad radis sa JSON objektom,
            //da bi mogao da ga parsiras niz objekata u ovom slucaju, pa da pristupas poljima dot operatorom

            var output = "";

            //prolazim kroz niz objekata 
            for (var i in pisci) {
              output +=
                "<ul>" +
                "<li>Ime: " +
                pisci[i].ime +
                " </li>" +
                "<li>Prezime: " +
                pisci[i].prezime +
                " </li>"+
                
                "</ul>";
              }

            document.getElementById("pocasniPisci").innerHTML = output;
          }
        };

        xhr.send();
      }

     
    </script>
    
  </body>
</html>
