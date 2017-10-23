
function sansAccent(str){
    var accent = [
        /[\300-\306]/g, /[\340-\346]/g, // A, a
        /[\310-\313]/g, /[\350-\353]/g, // E, e
        /[\314-\317]/g, /[\354-\357]/g, // I, i
        /[\322-\330]/g, /[\362-\370]/g, // O, o
        /[\331-\334]/g, /[\371-\374]/g, // U, u
        /[\321]/g, /[\361]/g, // N, n
        /[\307]/g, /[\347]/g // C, c
    ];
    var noaccent = ['A','a','E','e','I','i','O','o','U','u','N','n','C','c'];
    for(var i = 0; i < accent.length; i++){
        str = str.replace(accent[i], noaccent[i]);
    }
    return str;
}

var owlSlider = jQuery("#owl-homeslider");
owlSlider.owlCarousel({
    items : 1,
    rtl:true,
    stopOnHover: true,
    pagination: false,
    navigation: true,
    lazyLoad: true,
    slideSpeed: 800,
    autoPlay: true,
    autoPlaySpeed: 3000,
    autoHeight: true,
    navigationText: [
        "<i class='fa fa-chevron-left'></i>",
        "<i class='fa fa-chevron-right'></i>"
    ],
});

var owlReview = jQuery("#review_customer");
owlReview.owlCarousel({
    items : 4,
    rtl:true,
    stopOnHover: true,
    pagination: false,
    navigation: true,
    lazyLoad: true,
    slideSpeed: 800,
    autoPlay: true,
    autoPlaySpeed: 3000,
    autoHeight: true,
    navigationText: [
        "<i class='fa fa-chevron-left'></i>",
        "<i class='fa fa-chevron-right'></i>"
    ],
});

var owlQA = jQuery("#sliderQA");
owlQA.owlCarousel({
    items : 4,
    rtl:true,
    stopOnHover: true,
    pagination: false,
    navigation: true,
    lazyLoad: true,
    slideSpeed: 800,
    autoPlay: true,
    autoPlaySpeed: 3000,
    autoHeight: true,
    navigationText: [
        "<i class='fa fa-chevron-left'></i>",
        "<i class='fa fa-chevron-right'></i>"
    ],
});

jQuery('#accountForm')
.formValidation({
    framework: 'bootstrap',
    excluded: [':disabled'],
    icon: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
        cost: {
            validators: {
                notEmpty: {
                    message: 'The cost is required'
                }
            }
        },

        methodPay: {
            validators: {
                notEmpty: {
                    message: 'The method Pay is required'
                }
            }
        },

        invest_cost: {
            validators: {
                notEmpty: {
                    message: 'The invest-cost  is required'
                }
            }
        },

        invest_month: {
            validators: {
                notEmpty: {
                    message: 'The invest-month is required'
                }
            }
        }

    }
})
.on('err.field.fv', function(e, data) {
    var $invalidFields = data.fv.getInvalidFields().eq(0);

    var $tabPane     = $invalidFields.parents('.tab-pane'),
        invalidTabId = $tabPane.attr('id');

    if (!$tabPane.hasClass('active')) {
        $tabPane.parents('.tab-content')
            .find('.tab-pane')
            .each(function(index, tab) {
                var tabId = jQuery(tab).attr('id'),
                    $li   = jQuery('a[href="#' + tabId + '"][data-toggle="tab"]').parent();

                if (tabId === invalidTabId) {
                    jQuery(tab).addClass('active');
                    $li.addClass('active');
                } else {
                    jQuery(tab).removeClass('active');
                    $li.removeClass('active');
                }
            });

        $invalidFields.focus();
    }
});