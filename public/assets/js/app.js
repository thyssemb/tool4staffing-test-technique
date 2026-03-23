const $dynamicDiv = $('.dynamic-div');

function getCookie(name) {
    const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    return match ? match[2] : null;
}

function setCookie(name, value) {
    document.cookie = name + '=' + value + '; path=/';
}

function getClient() {
    return getCookie('client') || 'clienta';
}

function renderError() {
    $dynamicDiv.html('<p class="text-red-500 text-sm">Erreur de chargement.</p>');
}

function updateModuleNav() {
    if (getClient() === 'clientb') {
        $('#module-nav').removeClass('hidden');
    } else {
        $('#module-nav').addClass('hidden');
    }
}

function load(url) {
    $.ajax({
        url,
        method: 'GET',
        success: html => $dynamicDiv.html(html),
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
    $dynamicDiv.on('click', '#back-btn', function() {
        const module = $(this).data('module') || 'cars';
        load(`/${module}`);
    });
}

$(document).ready(function() {
    if (!getCookie('client')) {
        setCookie('client', 'clienta');
    }

    updateModuleNav();

    // Load default view
    load('/cars');

    // Client switcher
    $('.client-btn').on('click', function() {
        setCookie('client', $(this).data('client'));
        updateModuleNav();
        load('/cars');
    });

    // Module switcher
    $('.module-btn').on('click', function() {
        const module = $(this).data('module');
        load(`/${module}`);
    });

    bindBackButton();
});