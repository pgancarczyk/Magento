var MultishippingConfig = Class.create();

MultishippingConfig.prototype = {
    
    initialize: function () {
        document.observe('change', this.identify.bind(this));
        console.log(this);
    },
    
    identify: function (event) {
        var element = event.target;
        if (element.hasAttribute('data-multishipping-day') && element.hasAttribute('data-multishipping-hour'))
        {
            var entity = Class.create();
            entity.day = element.getAttribute('data-multishipping-day');
            entity.hour = element.getAttribute('data-multishipping-hour');
            entity.value = element.value;
            if (element.nodeName === 'SELECT')
            {
                entity.field = 'enabled';
            }
            else if (element.hasClassName('price'))
            {
                entity.field = 'price';
            }
            else
            {
                entity.field = 'limit';
            }
            this.update(entity);
        }
    },
    
    update: function (entity) {
        console.log(entity.day);
    }
    
};

document.observe("dom:loaded", function() {
    new MultishippingConfig();
});