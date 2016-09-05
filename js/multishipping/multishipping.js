var MultishippingConfig = Class.create();

MultishippingConfig.prototype = {
    initialize: function () {
        this.DEFAULT_WEEK = 7; // 8th weekday = default for the entire week
        this.DEFAULT_WEEKDAY = 24; // 25th hour of a day = default for a single weekday
        document.observe('change', this.identify.bind(this));
    },
    
    identify: function (event) {
        var element = event.target;
        if (element.hasAttribute('data-multishipping-day') && element.hasAttribute('data-multishipping-hour'))
        {
            var entity = Class.create();
            entity.day = element.getAttribute('data-multishipping-day');
            entity.hour = element.getAttribute('data-multishipping-hour');
            entity.value = element.value;
            if (element.nodeName === 'SELECT') {
                entity.field = 'is_enabled';
            }
            else if (element.hasClassName('price')) {
                entity.field = 'price';
            }
            else {
                entity.field = 'limit';
            }
            this.update(entity);
        }
    },
    
    update: function (entity) {
        if (entity.day == this.DEFAULT_WEEK) {
            console.log('updating entire table');
        }  
        else if (entity.hour == this.DEFAULT_WEEKDAY) {
            console.log('updating day ' + entity.day);
        }
        else {
            console.log('updating day ' + entity.day + ' hour ' + entity.hour);
        }
        
        if (entity.field == 'is_enabled') {
            if (entity.value == 'enabled') {
                document.querySelector("input[data-multishipping-day='" + entity.day + "'][data-multishipping-hour='" + entity.hour + "'].price").readOnly = false;
                document.querySelector("input[data-multishipping-day='" + entity.day + "'][data-multishipping-hour='" + entity.hour + "'].limit").readOnly = false;
            }
            else if (entity.value == 'disabled') {
                document.querySelector("input[data-multishipping-day='" + entity.day + "'][data-multishipping-hour='" + entity.hour + "'].price").readOnly = true;
                document.querySelector("input[data-multishipping-day='" + entity.day + "'][data-multishipping-hour='" + entity.hour + "'].limit").readOnly = true;
            }
                
        }
    }
    
};

document.observe("dom:loaded", function() {
    new MultishippingConfig();
});