function toFinnish(){
  document.getElementById("english").classList.add("hidden");
  document.getElementById("finnish").classList.remove("hidden");
  document.getElementById("english-header").classList.add("hidden");
  document.getElementById("finnish-header").classList.remove("hidden");
  document.getElementById("english-button").classList.remove("active");
  document.getElementById("finnish-button").classList.add("active");
}

function toEnglish(){
  document.getElementById("finnish").classList.add("hidden");
  document.getElementById("english").classList.remove("hidden");
  document.getElementById("finnish-header").classList.add("hidden");
  document.getElementById("english-header").classList.remove("hidden");
  document.getElementById("finnish-button").classList.remove("active");
  document.getElementById("english-button").classList.add("active");
}
