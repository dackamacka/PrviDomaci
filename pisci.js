

   
    
    //funkcija za ucitavanje pisaca
function ucitajPisce() {
    
    const Http = new XMLHttpRequest();
    const url='ucitajPocasnePisce.php';
    Http.open("GET", url);
    Http.send();
    location.reload();
    Http.onreadystatechange = (e) => {
    console.log(Http.responseText);}
   
  }