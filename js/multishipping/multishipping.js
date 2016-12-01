var MultishippingConfig = Class.create();
var MultishippingEntity = Class.create();

MultishippingConfig.prototype = {
    
    DEFAULT_WEEK: 7, // 8th weekday = default for the entire week
    DEFAULT_DAY: 24, // 25th hour of a day = default for a single weekday
    
    initialize: function () {
        document.observe('change', this.identify.bind(this));
        new MultishippingEntity(MultishippingConfig.prototype.DEFAULT_WEEK, 0).update();
    },
    
    identify: function (event_or_element) {
//        if (event_or_element.target) {
            var element = event_or_element.target;
//            console.log('event');
//        }
//        else {
//            var element = event_or_element;
//            console.log('element');
//        }
//        delete element.target;
        if (element.hasAttribute('data-multishipping-day') && element.hasAttribute('data-multishipping-hour'))
        {
            new MultishippingEntity(element.getAttribute('data-multishipping-day'), element.getAttribute('data-multishipping-hour')).update();
        }
    }
    
//    update: function (entity) {
//        if (entity.day === MultishippingConfig.prototype.DEFAULT_WEEK) {
//            console.log('updating entire table');
//            for (day = 0; day < 7; day++) {
//                this.identify($$("[data-multishipping-day='" + day + "'][data-multishipping-hour='" + MultishippingConfig.prototype.DEFAULT_DAY + "'][class='limit'")[0]);
//                this.identify($$("[data-multishipping-day='" + day + "'][data-multishipping-hour='" + MultishippingConfig.prototype.DEFAULT_DAY + "'][class='price'")[0]);
//                this.identify($$("[data-multishipping-day='" + day + "'][data-multishipping-hour='" + MultishippingConfig.prototype.DEFAULT_DAY + "'][class='is_enabled'")[0]);
//            }
//        }  
//        else if (entity.hour === MultishippingConfig.prototype.DEFAULT_DAY) {
//            console.log('updating day ' + entity.day);
//            for (hour = 0; hour < 24; hour++) {
//                this.identify($$("[data-multishipping-day='" + entity.day + "'][data-multishipping-hour='" + hour + "'][class='" + entity.field + "'")[0]);
//            }
//        }
//        else {
//            console.log('updating day ' + entity.day + ' hour ' + entity.hour);
//        }
        
//        var value = this.getDefaultFor(entity);
        
//    },
    
//    getDefaultFor: function (entity) {
//        if (entity.hour === MultishippingConfig.prototype.DEFAULT_DAY) {
//            
//        }
//    }
    
};

MultishippingEntity.prototype = {
    
    SELECT_DISABLED: 2,
    SELECT_ENABLED: 1,
    SELECT_DEFAULT: 0,
    
    initialize: function (day, hour) {
        this.elements = Class.create();
        this.elements.is_enabled = $$("[data-multishipping-day='" + day + "'][data-multishipping-hour='" + hour + "'][class='is_enabled'")[0];
        this.elements.limit = $$("[data-multishipping-day='" + day + "'][data-multishipping-hour='" + hour + "'][class='limit'")[0];
        this.elements.price = $$("[data-multishipping-day='" + day + "'][data-multishipping-hour='" + hour + "'][class='price'")[0];
        
        this.day = day;
        this.hour = hour;
        this.inherit = this.elements.is_enabled.value == MultishippingEntity.prototype.SELECT_DEFAULT ? true : false;
    },
    
    update: function (values) {
        
//        console.log('WITHIN updating day ' + this.day + ', hour ' + this.hour);
        
        // change the values if called with them (means called from recursion, not from a click)
        if ((typeof values !== 'undefined') && (this.inherit)) {
            this.elements.limit.placeholder = values.limit;
            this.elements.price.placeholder = values.price;
            this.elements.limit.setAttribute('data-multishipping-placeholder', values.limit);
            this.elements.price.setAttribute('data-multishipping-placeholder', values.price);
        }
        else { // then define values for further use
            var values = Class.create();
            values.price = this.elements.price.value;
            values.limit = this.elements.limit.value;
            if (!values.price) { // not enough, need to inherit
                values.price = this.elements.price.placeholder;
            }
            if (!values.limit) { // not enough, need to inherit
                values.price = this.elements.limit.placeholder;
            }            
        }
        
        if (this.day == MultishippingConfig.prototype.DEFAULT_WEEK) { // is default for the entire week
            for (day = 0; day < 7; day++) {
//                console.log('updating day ' + day + ', hour ' + MultishippingConfig.prototype.DEFAULT_DAY);
                new MultishippingEntity(day, MultishippingConfig.prototype.DEFAULT_DAY).update(values);
            }
        }
        
        else if (this.hour == MultishippingConfig.prototype.DEFAULT_DAY) { // is default for the entire day
            for (hour = 0; hour < 24; hour++) {
//                console.log('updating day ' + this.day + ', hour ' + hour);
                new MultishippingEntity(this.day, hour).update(values);
            }            
        }
        
        if (this.elements.is_enabled.value == MultishippingEntity.prototype.SELECT_ENABLED) {
            this.elements.limit.readOnly = false;
//            this.elements.limit.placeholder = '';
            this.elements.price.readOnly = false;
//            this.elements.price.placeholder = '';
        }
        else if (this.elements.is_enabled.value == MultishippingEntity.prototype.SELECT_DISABLED) {      
            this.elements.limit.readOnly = true;
            this.elements.limit.placeholder = 'X';            
            this.elements.price.readOnly = true;
            this.elements.price.placeholder = 'X';            
        }
        else if (this.elements.is_enabled.value == MultishippingEntity.prototype.SELECT_DEFAULT) {      
            this.elements.limit.readOnly = false;
            this.elements.limit.placeholder = this.elements.limit.getAttribute('data-multishipping-placeholder');         
            this.elements.price.readOnly = false;
            this.elements.price.placeholder = this.elements.price.getAttribute('data-multishipping-placeholder');           
        }        

    }
}

document.observe("dom:loaded", function() {
    new MultishippingConfig();
});