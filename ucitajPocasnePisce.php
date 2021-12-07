<?php
session_start();
require "pisci.php";
$json = '{"ucitani"=[
    {
      "pisacID": 1,
      "ime": "Haled",
      "prezime": "Hoseini",
      "godiste":1986,
      "zemljaPorekla":"Avganistan"
    },
    {
      "pisacID": 2,
      "ime": "Danilo",
      "prezime": "Kiš"
    },
      
    {
      "pisacID": 3,
      "ime": "Herman",
      "prezime": "Hese"
    },
    {
      "pisacID": 4,
      "ime": "Haruki",
      "prezime": "Murakami"
     
    },
    {
      "pisacID": 5,
      "ime": "Miloš",
      "prezime": "Crnjanski"
    }
  ]}';
//json pretvara u odgovarajucu vrstu objekta,ceo json dokument, vraca niz
$niz=array();
$_SESSION['spisak']=array();
array_push($niz,new Pisac("Haled","Hoseini"));
array_push($niz,new Pisac("Danilo","Kis"));
array_push($niz,new Pisac("Herman","Hese"));
array_push($niz,new Pisac("Milos","Crnjanski"));
array_push($niz,new Pisac("Haruki","Murakami"));
for($i=0;$i<count($niz);$i++){
  echo $niz[$i]->ime;
  echo $niz[$i]->prezime;
  echo "\n";
}
$_SESSION['spisak']=$niz;
echo print_r($_SESSION);


?>