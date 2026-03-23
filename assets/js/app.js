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

function buildUrl(client, module, script) {
    return `customs/${client}/modules/${module}/${script}.php`;
}

function renderError() {
    $dynamicDiv.html('<p class="text-red-500 text-sm">Erreur de chargement.</p>');
}

function updateModuleNav() {
    const client = getClient();
    if (client === 'clientb') {
        $('#module-nav').removeClass('hidden');
    } else {
        $('#module-nav').addClass('hidden');
        $dynamicDiv.data('module', 'cars');
    }
}

function loadModule(script) {
    const module = $dynamicDiv.data('module');
    const url = buildUrl(getClient(), module, script);

    $.ajax({
        url,
        success: function(html) {
            $dynamicDiv.html(html);
            bindCarClick(module);
        },
        error: renderError
    });
}

function bindCarClick(module) {
    $dynamicDiv.find('tr[data-id]').on('click', function() {
        const id = $(this).data('id');
        const url = buildUrl(getClient(), module, 'edit') + '?id=' + id;

        $.ajax({
            url,
            success: function(html) {
                $dynamicDiv.html(html);
            },
            error: renderError
        });
    });
}

function bindBackButton() {
    $dynamicDiv.on('click', '#back-btn', function() {
        loadModule('ajax');
    });
}

$(document).ready(function() {
    if (!getCookie('client')) {
        setCookie('client', 'clienta');
    }

    updateModuleNav();
    loadModule('ajax');
    bindBackButton();

    $('[data-client]').on('click', function() {
        setCookie('client', $(this).data('client'));
        updateModuleNav();
        loadModule('ajax');
    });

    $('#module-nav button').on('click', function() {
        $dynamicDiv.data('module', $(this).data('module'));
        loadModule('ajax');
    });
});