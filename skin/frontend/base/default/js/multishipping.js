var Multishipping = Class.create(Checkout, {
    initialize: function($super,accordion, urls){
        $super(accordion, urls);
        //New Code Addded
        this.steps = ['login', 'billing', 'shipping', 'multishipping', 'shipping_method', 'payment', 'review'];
    },
    setMethod: function(){
        if ($('login:guest') && $('login:guest').checked) {
            this.method = 'guest';
            var request = new Ajax.Request(
                this.saveMethodUrl,
                {method: 'post', onFailure: this.ajaxFailure.bind(this), parameters: {method:'guest'}}
            );
            Element.hide('register-customer-password');
            this.gotoSection('billing'); //New Code Here
        }
        else if($('login:register') && ($('login:register').checked || $('login:register').type == 'hidden')) {
            this.method = 'register';
            var request = new Ajax.Request(
                this.saveMethodUrl,
                {method: 'post', onFailure: this.ajaxFailure.bind(this), parameters: {method:'register'}}
            );
            Element.show('register-customer-password');
            this.gotoSection('billing'); //New Code Here
        }
        else{
            alert(Translator.translate('Please choose to register or to checkout as a guest'));
            return false;
        }
    }
});
var MultishippingMethod = Class.create();
MultishippingMethod.prototype = {
    initialize: function(form, saveUrl){
        console.log('dupa5');
        this.form = form;
        if ($(this.form)) {
            console.log('dupa6');
            $(this.form).observe('submit', function(event){this.save();Event.stop(event);}.bind(this));
        }
        this.saveUrl = saveUrl;
        this.validator = new Validation(this.form);
        this.onSave = this.nextStep.bindAsEventListener(this);
        this.onComplete = this.resetLoadWaiting.bindAsEventListener(this);
    },
 
    validate: function() {
        console.log('dupa4');
        if(!this.validator.validate()) {
            return false;
        }
        return true;
    },
 
    save: function(){
        console.log('dupa##1');
        if (checkout.loadWaiting!=false) return;
        console.log('dupa##2');
        if (this.validate()) {
            console.log('dupa##3');
            checkout.setLoadWaiting('multishipping');
            var request = new Ajax.Request(
                this.saveUrl,
                {
                    method:'post',
                    onComplete: this.onComplete,
                    onSuccess: this.onSave,
                    onFailure: checkout.ajaxFailure.bind(checkout),
                    parameters: Form.serialize(this.form)
                }
            );
        }
    },
 
    resetLoadWaiting: function(transport){
        console.log('dupa2');
        checkout.setLoadWaiting(false);
    },
 
    nextStep: function(transport){
        console.log('dupa1');
        if (transport && transport.responseText){
            try{
                response = eval('(' + transport.responseText + ')');
            }
            catch (e) {
                response = {};
            }
        }
 
        if (response.error) {
            alert(response.message);
            return false;
        }
 
        if (response.update_section) {
            $('checkout-'+response.update_section.name+'-load').update(response.update_section.html);
        }
 
 
        if (response.goto_section) {
            checkout.gotoSection(response.goto_section);
            checkout.reloadProgressBlock();
            return;
        }

        checkout.setPayment();
    }
}

document.observe("dom:loaded", function() {
    document.observe('click', function(event) {
        console.log(event.target);
        if(event.target.hasClassName('multishipping-date')) {
            $('multishipping:date').value = event.target.getAttribute('data-multishipping-value');
            if($$('.multishipping-selected')[0]) $$('.multishipping-selected')[0].removeClassName('multishipping-selected');
            event.target.addClassName('multishipping-selected');
        }
    });
});