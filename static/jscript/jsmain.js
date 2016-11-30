requirejs.config({
    "baseUrl": "http:\/\/namnv.younetco.com\/kendoplatform\/static\/jscript\/",
    "paths": {
        "jquery": "kendo\/jquery\/jquery",
        "bootstrap": "kendo\/bootstrap\/bootstrap",
        "jqueryui": "kendo\/jquery-ui\/jqueryui",
        "underscore": "kendo\/underscore\/underscore.min",
        "tiny_mce": "kendo\/tinymce\/jquery.tinymce.min"
    },
    "shim": {
        "bootstrap": {
            "deps": [
                "jquery"
            ],
            "exports": "bootstrap"
        },
        "jqueryui": {
            "deps": [
                "jquery"
            ],
            "exports": "jqueryui"
        },
        "underscore": {
            "deps": [
                "jquery"
            ],
            "exports": "_"
        }
    }
});
require([
    "jquery",
    "underscore",
    "bootstrap",
    "platform\/core\/main",
    "jqueryui",
    "platform\/authorization\/main",
    "platform\/comment\/main",
    "platform\/layout\/main",
    "platform\/friend\/main",
    "platform\/blocking\/main",
    "platform\/user\/main",
    "platform\/share\/main",
    "platform\/follow\/main",
    "platform\/review\/main",
    "platform\/notification\/main",
    "platform\/link\/main",
    "platform\/message\/main",
    "platform\/like\/main",
    "platform\/group\/main",
    "platform\/pages\/main",
    "platform\/photo\/main",
    "platform\/social\/main",
    "platform\/event\/main",
    "platform\/search\/main",
    "platform\/mail\/main",
    "platform\/help\/main",
    "platform\/report\/main",
    "platform\/activity\/main"
], function(){});