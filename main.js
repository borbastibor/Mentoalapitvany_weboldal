// Az oldal betöltődésekor végrehajtandó feladatok
window.onload = function() {
    var btn = document.getElementById("accessbutton");
    var modal = document.getElementById("accesswindow");
    var span = document.getElementsByClassName("close")[0];

    // Bejelentkező ablak megnyitása
    btn.onclick = function() {
        modal.style.display = "block";
    }
  
    // Kisablak bezárása a bezárás gombbal
    span.onclick = function() {
        modal.style.display = "none";
    }
  
    // Kisablak bezárása ha ki kattintunk a kisablakból 
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

// Elküldendő üzenet kliensoldali ellenőrzése
function validateMessageSend() {
    var username = document.forms["kapcsolatform"]["kapcsolatnev"].value,
        useremail = document.forms["kapcsolatform"]["kapcsolatemail"].value,
        usermsg = document.forms["kapcsolatform"]["kapcsolatmsgtext"].value,
        mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    // username ellenőrzése
    if (username == "") {
        alert("Nem adott meg nevet!");
        return false;
    }
    // e-mail cím ellenőrzése
    if (!useremail.matches(mailformat)) {
        alert("Nem megfelelő formátumú e-mail címet adott meg!");
        return false;
    }
    // üzenet tartalmának ellenőrzése
    if (usermsg == "") {
        alert("Nem írt szöveget az üzenethez!");
        return false;
    }
}

// Bejelentkezési adatok kliensoldali ellenőrzése
function validateSignIn() {
    var username = document.forms["belepesform"]["belepesinev"].value,
        nameformat = /^[A-Za-z0-9-]/;
    // Felhasználónév formátum ellenőrzése
    if (nameformat.test(username)) {
        alert("Nem megfelelő formátumú felhasználónevet adott meg!");
        return false;
    }
}

// Regisztrációs adatok kliensoldali ellenőrzése
function validateRegister() {
    var userfirstname = document.forms["regform"]["csaladnev"].value,
        userlastname = document.forms["regform"]["keresztnev"].value,
        userloginname = document.forms["regform"]["loginnev"].value,
        useremail = document.forms["regform"]["emailcim"].value,
        nameformat = /^[A-Za-z0-9-]/,
        emailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    // Loginnév ellenőrzése
    if (nameformat.test(userloginname)) {
        alert("Nem megfelelő formátumú loginnevet adott meg!");
        return false;
    }
    // Családnév ellenőrzése
    if (nameformat.test(userfirstname)) {
        alert("Nem megfelelő formátumú családnevet adott meg!");
        return false;
    }
    // Keresztnév ellenőrzése
    if (nameformat.test(userlastname)) {
        alert("Nem megfelelő formátumú keresztnevet adott meg!");
        return false;
    }
    // e-mail cím ellenőrzése
    if (emailformat.test(useremail)) {
        alert("Nem megfelelő formátumú e-mail címet adott meg!");
        return false;
    }
}