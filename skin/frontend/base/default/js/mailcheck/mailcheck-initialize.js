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
    var disposableDomains = settings.disposableDomains;
    var defaultText = settings.text;
    var notAllowedText = settings.notAllowedText;

    jQuery('#email, #email_address').on('blur', function (e) {
        if(disposableDomains !== false) {
            domain = jQuery(e.currentTarget).val().replace(/.*@/, "");
            if (disposableDomains.indexOf(domain) > -1) {
                jQuery(e.currentTarget).addClass('validation-failed');
                jQuery(e.currentTarget).parent().append('<p class="mailcheck-suggestion-element">' + notAllowedText + '</p>');
                return;
            }
        }
        jQuery(this).mailcheck({
            domains: domains,
            secondLevelDomains: secondLevelDomains,
            topLevelDomains: topLevelDomains,
            suggested: function (element, suggestion) {
                jQuery('.mailcheck-suggestion-element').remove();
                text = defaultText + ' <a href="javascript:fillEmail(\'' + e.currentTarget.id + '\', \'' + suggestion.full + '\')">' + suggestion.full + '</a>?';
                jQuery(e.currentTarget).parent().append('<p class="mailcheck-suggestion-element">' + text + '</p>');
            },
            empty: function (element) {
                // callback code
                jQuery('.mailcheck-suggestion-element').remove();
            }
        });
    });

});

function fillEmail(field,email) {
    jQuery('#' + field).val(email);
    jQuery('.mailcheck-suggestion-element').remove();
}
