const $dynamicDiv = $(".dynamic-div");

function getCookie(name) {
  const match = document.cookie.match(new RegExp("(^| )" + name + "=([^;]+)"));
  return match ? match[2] : null;
}

function setCookie(name, value) {
  document.cookie = name + "=" + value + "; path=/";
}

function getClient() {
  return getCookie("client") || "clienta";
}

function renderError(xhr) {
  const errorMsg = xhr.responseText
    ? `<p class="text-red-500 text-sm">Erreur: ${xhr.responseText}</p>`
    : '<p class="text-red-500 text-sm">Erreur de chargement.</p>';
  $dynamicDiv.html(errorMsg);
  console.error("AJAX Error:", xhr);
}

function updateModuleNav() {
  if (getClient() === "clientb") {
    $("#module-nav").removeClass("hidden");
  } else {
    $("#module-nav").addClass("hidden");
  }
}

function load(url) {
  console.log("Loading:", url);
  $.ajax({
    url,
    method: "GET",
    success: html => {
      console.log("Success:", html);
      $dynamicDiv.html(html);
    },
    error: renderError
  });
}

function loadCar(id) {
  load(`/cars/show?id=${id}`);
}

function loadGarage(id) {
  load(`/garages/show?id=${id}`);
}

function bindBackButton() {
  $dynamicDiv.on("click", "#back-btn", function () {
    const module = $(this).data("module") || "cars";
    load(`/${module}`);
  });
}

$(document).ready(function () {
  console.log("Document ready, client:", getClient());

  if (!getCookie("client")) {
    setCookie("client", "clienta");
  }

  updateModuleNav();

  // Load default view
  load("/cars");

  // Client switcher
  $(".client-btn").on("click", function () {
    const client = $(this).data("client");
    console.log("Switching to client:", client);
    setCookie("client", client);
    updateModuleNav();
    load("/cars");
  });

  // Module switcher
  $(".module-btn").on("click", function () {
    const module = $(this).data("module");
    console.log("Switching to module:", module);
    load(`/${module}`);
  });

  bindBackButton();
});
