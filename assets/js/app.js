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

function updateModuleNav() {
    const client = getClient();
    if (client === 'clientb') {
        $('#module-nav').show();
    } else {
        $('#module-nav').hide();
        $('.dynamic-div').data('module', 'cars');
    }
}

function loadModule(script) {
    const div = $('.dynamic-div');
    const module = div.data('module');
    const client = getClient();
    const url = buildUrl(client, module, script);

    $.ajax({
        url,
        success: function(html) {
            div.html(html);
            bindCarClick(module);
        },
        error: function() {
            div.html('<p>Erreur de chargement.</p>');
        }
    });
}

function bindCarClick(module) {
    const client = getClient();
    $('.dynamic-div tr[data-id]').on('click', function() {
        const id = $(this).data('id');
        const url = buildUrl(client, module, 'edit') + '?id=' + id;

        $.ajax({
            url,
            success: function(html) {
                $('.dynamic-div').html(html);
            },
            error: function() {
                $('.dynamic-div').html('<p>Erreur de chargement.</p>');
            }
        });
    });
}

function bindBackButton() {
    $('.dynamic-div').on('click', '#back-btn', function() {
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
        $('.dynamic-div').data('module', $(this).data('module'));
        loadModule('ajax');
    });
});