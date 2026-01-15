function gestisciSignup(event) {
  event.preventDefault();
  let form = event.target;
  let nome = form.nome.value;
  let cognome = form.cognome.value;
  let corretto = true;
  let erroreNome = document.querySelector("#erroreNome");
  let erroreCognome = document.querySelector("#erroreCognome");
  erroreNome.innerHTML = "";
  erroreCognome.innerHTML = "";
  for (i = 0; i < nome.length; i++)
    if (!isNaN(nome.charAt(i))) {
      corretto = false;
      erroreNome.innerHTML = "*";
    }

  for (i = 0; i < cognome.length; i++)
    if (!isNaN(cognome.charAt(i))) {
      corretto = false;
      erroreCognome.innerHTML = "*";
    }

  if (corretto) {
    let formData = new FormData(form);
    console.log(formData);
    fetch("api/signup.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => alert(data.message))
      .catch((error) => console.log(error));
  }
}

function gestisciLogin(event) {
  event.preventDefault();
  let form = event.target;
  let formData = new FormData(form);
  fetch("api/login.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      alert(data.message);
      if (data.success) window.location.replace("areaRiservata.php");
    })
    .catch((error) => console.log(error));
}

function aggiungiMessaggio(event) {
  event.preventDefault();
  let form = event.target;
  let formData = new FormData(form);
  fetch("api/aggiungi.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      alert(data.message);
    })
    .catch((error) => console.log(error));
  window.location.reload();
}

function eliminaMessaggio(ID_messaggio) {
  let conferma = confirm("Vuoi davvero eliminare il messaggio?");
  if(conferma)
  {
    let formData = new FormData();
    formData.append("ID_messaggio", ID_messaggio);
    fetch("api/elimina.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        alert(data.message);
      })
      .catch((error) => console.log(error));
    window.location.reload();
  }
}

function modificaMessaggio(ID_messaggio) {
  let divM = document.querySelector("#m" + ID_messaggio);
  let titolo = divM.querySelector(".titoloM");
  let testo = divM.querySelector(".testoM");
  let ok = divM.querySelector(".okM");
  let matita = divM.querySelector(".modificaM");
  titolo.removeAttribute("readonly");
  testo.removeAttribute("readonly");
  ok.removeAttribute("hidden");
  matita.setAttribute("hidden", "true");
}

function okMessaggio(ID_messaggio) {
  let divM = document.querySelector("#m" + ID_messaggio);
  let titolo = divM.querySelector(".titoloM");
  let testo = divM.querySelector(".testoM");
  let ok = divM.querySelector(".okM");
  let matita = divM.querySelector(".modificaM");
  let formData = new FormData();
  formData.append("ID_messaggio", ID_messaggio);
  formData.append("titolo", titolo.value);
  formData.append("messaggio", testo.value);
  fetch("api/modifica.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      alert(data.message);
    })
    .catch((error) => console.log(error));

  titolo.setAttribute("readonly", "true");
  testo.setAttribute("readonly", "true");
  ok.setAttribute("hidden", "true");
  matita.removeAttribute("hidden");
  window.location.reload();
}

function signout() {
  fetch("api/signout.php", {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      alert(data.message);
      if (data.success) window.location.replace("home.php");
    })
    .catch((error) => console.log(error));
}
