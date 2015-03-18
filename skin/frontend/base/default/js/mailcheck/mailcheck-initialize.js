jQuery(window).ready(function () {
    var settings = (function() {
        var json = null;
        jQuery.ajax({
            'async': false,
            'global': false,
            'url': "/mailcheck/fetch/settings",
            'dataType': "json",
            'success': function (data) {
                json = data;
            }
        });
        return json;
    })();

    var domains = settings.domains;
    var secondLevelDomains = settings.secondLevelDomains;
    var topLevelDomains = settings.topLevelDomains;
    var defaultText = settings.text;

    jQuery('#email').on('blur', function () {
        jQuery(this).mailcheck({
            domains: domains,
            secondLevelDomains: secondLevelDomains,
            topLevelDomains: topLevelDomains,
            suggested: function (element, suggestion) {
                jQuery('.mailcheck-suggestion-element').remove();
                text = defaultText + ' <a href="javascript:fillEmail(\'' + suggestion.full + '\')">' + suggestion.full + '</a>?';
                jQuery('#email').parent().append('<p class="mailcheck-suggestion-element">' + text + '</p>');
            },
            empty: function (element) {
                // callback code
                jQuery('.mailcheck-suggestion-element').remove();
            }
        });
    });

});

function fillEmail(email) {
    jQuery('#email').val(email);
    jQuery('.mailcheck-suggestion-element').remove();
}
