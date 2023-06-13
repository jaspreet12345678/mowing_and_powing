"use strict";
(function($) {
    "use strict";
//Minimum and Maxium Date
    let tomrrowDate = new Date()
    tomrrowDate.setDate(tomrrowDate.getDate() + 1)
    $('#minMaxExample').datepicker({
        language: 'en',
        minDate: tomrrowDate // Now can select only dates, which goes after today
    })

//Disable Days of week
    var disabledDays = [0, 6];

    $('#disabled-days').datepicker({
        language: 'en',
        onRenderCell: function (date, cellType) {
            if (cellType == 'day') {
                var day = date.getDay(),
                    isDisabled = disabledDays.indexOf(day) != -1;
                return {
                    disabled: isDisabled
                }
            }
        }
    })
})(jQuery);
