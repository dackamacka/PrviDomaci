var a = 1;

function skloniBlokove(nizBlokova, div) {
  for (const blok of nizBlokova) {
    document.getElementById(blok).style.display = "none";
  }
  document.getElementById(div).style.display = "inline";
}

function prikaziBlokove(nizBlokova, div) {
  for (const blok of nizBlokova) {
    document.getElementById(blok).style.display = "inline";
  }
  document.getElementById(div).style.display = "none";
}

function proveriFormuZaKnjige() {
  if (document.getElementById("novaKnjiga").value == "") {
    confirm("Morate uneti naslov knjige!");
    return;
  }

  if (
    (document.getElementById("imeNovogPisca").value != "" &&
      document.getElementById("prezimeNovogPisca").value == "" &&
      document.getElementById("zemljaPisca").value == "") ||
    (document.getElementById("imeNovogPisca").value == "" &&
      document.getElementById("prezimeNovogPisca").value != "" &&
      document.getElementById("zemljaPisca").value == "") ||
    (document.getElementById("imeNovogPisca").value == "" &&
      document.getElementById("prezimeNovogPisca").value == "" &&
      document.getElementById("zemljaPisca").value != "") ||
    (document.getElementById("imeNovogPisca").value != "" &&
      document.getElementById("prezimeNovogPisca").value != "" &&
      document.getElementById("zemljaPisca").value == "") ||
    (document.getElementById("imeNovogPisca").value != "" &&
      document.getElementById("prezimeNovogPisca").value == "" &&
      document.getElementById("zemljaPisca").value != "") ||
    (document.getElementById("imeNovogPisca").value == "" &&
      document.getElementById("prezimeNovogPisca").value != "" &&
      document.getElementById("zemljaPisca").value != "")
  ) {
    alert("Popunite ispravno podatke pisca!");
  }
}

function proveriFormuZaBrisanjeKnjige() {
  if (
    document.getElementById("imeNovogPisca").value != "" ||
    document.getElementById("prezimeNovogPisca").value != "" ||
    document.getElementById("zemljaPisca").value != "" ||
    document.getElementById("noviZanr").value != ""
  ) {
    alert(
      "Ne smete popunjavati podatke o piscu ili knjizi ukoliko brišete postojeću knjigu!"
    );
  }
}

function proveriFormuZaUnosCitaoca() {
  if (
    (document.getElementById("ime").value == "" &&
      document.getElementById("prezime").value == "" &&
      document.getElementById("kategorija").value == "") ||
    (document.getElementById("ime").value != "" &&
      document.getElementById("prezime").value == "" &&
      document.getElementById("kategorija").value == "") ||
    (document.getElementById("ime").value == "" &&
      document.getElementById("prezime").value != "" &&
      document.getElementById("kategorija").value == "") ||
    (document.getElementById("ime").value == "" &&
      document.getElementById("prezime").value == "" &&
      document.getElementById("kategorija").value != "") ||
    (document.getElementById("ime").value != "" &&
      document.getElementById("prezime").value != "" &&
      document.getElementById("kategorija").value == "") ||
    (document.getElementById("ime").value != "" &&
      document.getElementById("prezime").value == "" &&
      document.getElementById("kategorija").value != "") ||
    (document.getElementById("ime").value == "" &&
      document.getElementById("prezime").value !== "" &&
      document.getElementById("kategorija").value != "")
  ) {
    alert("Morate popuniti sve podatke o čitaocu!");
    return;
  }

  if (
    document.getElementById("kategorija").value > 3 ||
    document.getElementById("kategorija").value == 0
  ) {
    alert("Kategorija članstva mora biti u skupu vrednosti {1, 2, 3}!");
  }
  var serijalizacija=$("#citaoc").serialize();

  console.log(serijalizacija);

  req=$.ajax({

    url:"unosCitaoca.php",

    type:"post",

    data:serijalizacija

  });

  req.done(function(res, textStatus, jqXHR){

    if(res=="uspesno ste upisali citaoca"){

      alert("uspesno ste upisali citaoca");

  }else alert("Niste upisali citaoca: "+res);

  console.log(res);

  });

  req.fail(function(jqXHR, textStatus, errorThrown){

  console.error('Sledeca greska se desila> '+textStatus, errorThrown)});

  
}

function skloniDiv(div) {
  document.getElementById(div).innerHTML = "";
}

function loadText() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "onama.txt", true);

  xhr.onload = function () {
    if (this.status == 200) {
      console.log(this.responseText);
      document.getElementById("textHaled").innerHTML = this.responseText;
    }
  };

  xhr.send();
}
