(function ($) {

    'use strict';

    /*
    Wizard #4
    */
    var $w4finish = $('#w4').find('ul.pager li.finish'),
        $w4validator = $("#w4 form").validate({
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
                $(element).remove();
            },
            errorPlacement: function (error, element) {
                element.parent().append(error);
            }
        });

    $w4finish.on('click', function (ev) {
        ev.preventDefault();
        var validated = $('#bookingForm').valid();
        if (validated) {

        }
    });

    $('#w4').bootstrapWizard({
        tabClass: 'wizard-steps',
        nextSelector: 'ul.pager li.next',
        previousSelector: 'ul.pager li.previous',
        firstSelector: null,
        lastSelector: null,
        onNext: function (tab, navigation, index, newindex) {
            var validated = $('#w4 form').valid();

            if(index == 2) {
                if(!isLoggedIn()) {
                    new PNotify({
                        title: 'Error',
                        text: 'Please Login to continue. ' +
                        'Click on the top right login button to login or sign up button to sign up.',
                        type: 'error',
                        shadow: true
                    });
                    return false;
                }
                if(!tripSelected) {
                    new PNotify({
                        title: 'Error',
                        text: 'Please Select a trip to continue. ',
                        type: 'error',
                        shadow: true
                    });
                    return false;
                }
            }
            if (!validated) {
                $w4validator.focusInvalid();
                return false;
            }
        },
        onTabClick: function (tab, navigation, index, newindex) {
            if (newindex == index + 1) {
                return this.onNext(tab, navigation, index, newindex);
            } else if (newindex > index + 1) {
                return false;
            } else {
                return true;
            }
        },
        onTabChange: function (tab, navigation, index, newindex) {
            var $total = navigation.find('li').size() - 1;
            $w4finish[newindex != $total ? 'addClass' : 'removeClass']('hidden');
            $('#w4').find(this.nextSelector)[newindex == $total ? 'addClass' : 'removeClass']('hidden');
        },
        onTabShow: function (tab, navigation, index) {
            if (index == 1) {
                setTripsData();
            }
            if(index == 3) {
                setSelectedPassenger();
                setPaymentDetails();
            }
            var $total = navigation.find('li').length - 1;
            var $current = index;
            var $percent = Math.floor(($current / $total) * 100);
            $('#w4').find('.progress-indicator').css({'width': $percent + '%'});
            tab.prevAll().addClass('completed');
            tab.nextAll().removeClass('completed');
        }
    });

}).apply(this, [jQuery]);
