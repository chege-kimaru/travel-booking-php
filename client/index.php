<!doctype html>
<html class="fixed">
<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <title>Travel Bus Booking</title>
    <meta name="keywords" content="HTML5 Admin Template"/>
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light"
          rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css"/>
    <link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css"/>

    <!-- Specific Page Vendor CSS -->
    <link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css"/>

    <!-- Theme CSS -->
    <link rel="stylesheet" href="assets/stylesheets/theme.css"/>

    <!-- Skin CSS -->
    <link rel="stylesheet" href="assets/stylesheets/skins/default.css"/>

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

    <!-- Head Libs -->
    <script src="assets/vendor/modernizr/modernizr.js"></script>

    <style>
        .selected {
            border-color: black;
            border-width: thick;
        }
    </style>

</head>
<body>
<section class="body">

    <!-- start: header -->
    <header class="header">
        <div class="logo-container">
            <a href="#" class="logo">
                <h4>Travel Agency</h4>
            </a>
            <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
                 data-fire-event="sidebar-left-opened">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>

        <!-- start: search & user box -->
        <div class="header-right">

            <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">
                    <figure class="profile-picture">
                        <img src="assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle"
                             data-lock-picture="assets/images/!logged-user.jpg"/>
                    </figure>
                    <div class="profile-info logged-in">
                        <span class="name" id="loggedInName"></span>
                        <span class="role" id="loggedInEmail"></span>
                    </div>

                    <i class="fa custom-caret"></i>
                </a>

                <div class="dropdown-menu">
                    <ul class="list-unstyled">
                        <li class="divider"></li>
                        <div class="logged-out">
                            <li>
                                <a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#loginModal"><i
                                            class="fa fa-lock"></i> Sign in</a>
                            </li>
                            <li>
                                <a role="menuitem" tabindex="-1" href="#" data-toggle="modal"
                                   data-target="#signupModal"><i
                                            class="fa fa-lock"></i> Sign up</a>
                            </li>
                        </div>
                        <li>
                            <a onclick="logout()" class="logged-in" role="menuitem" tabindex="-1"><i
                                        class="fa fa-power-off"></i>
                                Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end: search & user box -->
    </header>
    <!-- end: header -->

    <div class="inner-wrapper">

        <div class="col-lg-offset-1 col-lg-10">
            <div class="row">
                <div class="col-xs-12">
                    <section class="panel panel-primary form-wizard" id="w4">
                        <header class="panel-heading">

                            <h2 class="panel-title">Make Your Booking</h2>
                        </header>
                        <div class="panel-body">
                            <div class="wizard-progress wizard-progress-lg">
                                <div class="steps-progress">
                                    <div class="progress-indicator"></div>
                                </div>
                                <ul class="wizard-steps">
                                    <li class="active">
                                        <a href="#w4-account" data-toggle="tab"><span>1</span>Check Availability</a>
                                    </li>
                                    <li>
                                        <a href="#w4-profile" data-toggle="tab"><span>2</span>Select Trip</a>
                                    </li>
                                    <li>
                                        <a href="#w4-billing" data-toggle="tab"><span>3</span>Apply</a>
                                    </li>
                                    <li>
                                        <a href="#w4-confirm" data-toggle="tab"><span>4</span>Confirmation</a>
                                    </li>
                                </ul>
                            </div>

                            <form class="form-horizontal" novalidate="novalidate" id="bookingForm">
                                <div class="tab-content">
                                    <div id="w4-account" class="tab-pane active">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Select Date</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar-o"></i>
														</span>
                                                    <input id="bookingDateInputField"
                                                            name="bookingDate" type="text" data-plugin-datepicker
                                                           data-plugin-options='{ "format": "yyyy-mm-dd" }'
                                                           class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Choose Route</label>
                                            <div class="col-md-6">
                                                <select id="routeInputField" name="trip_id" class="form-control routeSelect" required>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="w4-profile" class="tab-pane">

                                        <div class="row" id="availableTrips">

                                        </div>

                                    </div>
                                    <div id="w4-billing" class="tab-pane">
                                        <div class="row">
                                            <div class="col-md-6 selectedTrip">

                                            </div>
                                            <div class="col-md-6">
                                                <input id="passengerIdInputField" type="hidden" class="form-control"
                                                       name="passenger_id" required>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="passengerCountInputField">Passenger
                                                        Count</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" class="form-control" name="passengerCount"
                                                               id="passengerCountInputField" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" for="paymentMethodInputField">Payment
                                                        Method</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="paymentMethod"
                                                                id="paymentMethodInputField" required>
                                                            <option value="cash">Cash</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="w4-confirm" class="tab-pane">
                                        <div class="row">
                                            <div class="col-sm-4 selectedTrip">

                                            </div>
                                            <div class="col-sm-4 selectedPassenger">

                                            </div>
                                            <div class="col-sm-4 bookingDetails">

                                            </div>
                                        </div>
                                        <div class="row">
                                            <button type="submit" class="btn btn-primary">Confirm and Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer">
                            <ul class="pager">
                                <li class="previous disabled">
                                    <a><i class="fa fa-angle-left"></i> Previous</a>
                                </li>
                                <li class="finish hidden pull-right">
                                    <a>Finish</a>
                                </li>
                                <li class="next">
                                    <a>Next <i class="fa fa-angle-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

</section>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="loginModalTitle">Login</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="loginForm">
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" class="form-control" type="email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input name="password" class="form-control" type="password">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success">Login</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="signupModalTitle">Sign Up</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="signupForm">
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" class="form-control" type="email">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input name="phone" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input name="password" class="form-control" type="password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input name="password_confirm" class="form-control" type="password">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success">Sign Up</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Vendor -->
<script src="assets/vendor/jquery/jquery.js"></script>
<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

<!-- Specific Page Vendor -->
<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
<script src="assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
<script src="assets/vendor/pnotify/pnotify.custom.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="assets/javascripts/theme.js"></script>

<!-- Theme Custom -->
<script src="assets/javascripts/theme.custom.js"></script>

<!-- Theme Initialization Files -->
<script src="assets/javascripts/theme.init.js"></script>


<!-- Examples -->
<script src="assets/javascripts/forms/examples.wizard.js"></script>


<!-- DataTables JavaScript -->

<script src="assets/vendor/jquery/jquery.cookie.js"></script>

<script src="./app/main.js"></script>
<script src="./app/form.js"></script>
<script type="text/javascript">

    let tripSelected = false;

    function setPaymentDetails() {
        let ticket = $('#tripAmount').text();
        let passCount = $('#passengerCountInputField').val();
        let total = parseInt(ticket) * parseInt(passCount);
        let paymentMethod = $('#paymentMethodInputField').val();
        $('.bookingDetails').empty().append(
            '    <section class="panel panel-primary">\n' +
            '        <header class="panel-heading">\n' +
            '            <h2 class="panel-title">Payment Details</h2>\n' +
            '        </header>\n' +
            '        <div class="panel-body">\n' +
            '            <table class="table table-hover mb-none">\n' +
            '                <tr><th>Ticket</th><td>' + ticket + '</td></tr>\n' +
            '                <tr><th>Number of passengers</th><td>' + passCount + '</td></tr>\n' +
            '                <tr><th>Total</th><td>' + total + '</td></tr>\n' +
            '                <tr><th>Payment Through</th><td>' + paymentMethod + '</td></tr>\n' +
            '            </table>\n' +
            '        </div>\n' +
            '    </section>\n'
        );
    }

    function setSelectedPassenger() {
        $('#selectedPassenger').append(
            '<tr>\n' +
            '    <td><img src="./assets/images/loading.gif" alt="Loading..........." width="50" height="50">\n' +
            '    </td>\n' +
            '</tr>'
        );

        $.ajax({
            url: API + '/passenger/get-single.php?id=' + $.cookie('BUSBOOKING-PASSENGER-ID'),
            dataType: 'json',
            headers: {
                'Authorization': $.cookie('jwt')
            }
        }).done((passenger) => {
            $('#passengerIdInputField').val(passenger.id);
            $('.selectedPassenger').empty().append(
                '    <section class="panel panel-primary">\n' +
                '        <header class="panel-heading">\n' +
                '            <h2 class="panel-title">Passenger Details</h2>\n' +
                '        </header>\n' +
                '        <div class="panel-body">\n' +
                '            <table class="table table-hover mb-none">\n' +
                '                <tr><th>Name</th><td>' + passenger.name + '</td></tr>\n' +
                '                <tr><th>Phone</th><td>' + passenger.phone + '</td></tr>\n' +
                '                <tr><th>Email</th><td>' + passenger.email + '</td></tr>\n' +
                '            </table>\n' +
                '        </div>\n' +
                '    </section>\n'
            );
        });
    }

    function selectTrip(object, tripId) {
        $('.single-trip').css("border", "");
        $(object).parent().parent().parent().css("border", "2px solid black");
        setSelectedTrip(tripId);
    }

    function setSelectedTrip(tripId) {
        $('#selectedTrip').append(
            '<tr>\n' +
            '    <td><img src="./assets/images/loading.gif" alt="Loading..........." width="50" height="50">\n' +
            '    </td>\n' +
            '</tr>'
        );
        $.ajax({
            url: API + '/trip/get-single.php?id=' + tripId,
            dataType: 'json',
            headers: {
                'Authorization': $.cookie('jwt')
            }
        }).done((trip) => {
            tripSelected = true;
            $('.selectedTrip').empty().append(
                '    <section class="panel panel-primary">\n' +
                '        <header class="panel-heading">\n' +
                '            <h2 class="panel-title">' + trip.deptTime + ' ' + trip.route.title + '</h2>\n' +
                '        </header>\n' +
                '        <div class="panel-body">\n' +
                '            <table class="table table-hover mb-none">\n' +
                '                <tr><th>Route</th><td>' + trip.route.title + '</td></tr>\n' +
                '                <tr><th>Departure Time</th><td>' + trip.deptTime + '</td></tr>\n' +
                '                <tr><th>Arrival Time</th><td>' + trip.arrivalTime + '</td></tr>\n' +
                '                <tr><th>Bus</th><td>' + trip.bus.numPlate + '</td></tr>\n' +
                '                <tr><th>Seats</th><td>' + trip.bus.seatsNum + '</td></tr>\n' +
                '                <tr><th>Amount per Passenger</th><td id="tripAmount">' + trip.amount + '</td></tr>\n' +
                '            </table>\n' +
                '        </div>\n' +
                '    </section>\n'
            );
        });
    }

    function setTripsData() {
        $('#availableTrips').append(
            '<tr>\n' +
            '    <td><img src="./assets/images/loading.gif" alt="Loading..........." width="50" height="50">\n' +
            '    </td>\n' +
            '</tr>'
        );
        $.ajax({
            url: API + '/trip/get-for-route.php?routeId=' + $('#routeInputField').val(),
            dataType: 'json',
            headers: {
                'Authorization': $.cookie('jwt')
            }
        }).done((data) => {
            $('#availableTrips').empty();
            $.each(data, function (i, trip) {
                $('#availableTrips').append(
                    '<div class="col-md-3">\n' +
                    '    <section class="selected single-trip panel panel-primary">\n' +
                    '        <header class="panel-heading">\n' +
                    '            <h2 class="panel-title">' + trip.deptTime + ' ' + trip.route.title + '</h2>\n' +
                    '        </header>\n' +
                    '        <div class="panel-body">\n' +
                    '            <table class="table table-hover mb-none">\n' +
                    '                <tr><th>Route</th><td>' + trip.route.title + '</td></tr>\n' +
                    '                <tr><th>Departure Time</th><td>' + trip.deptTime + '</td></tr>\n' +
                    '                <tr><th>Arrival Time</th><td>' + trip.arrivalTime + '</td></tr>\n' +
                    '                <tr><th>Bus</th><td>' + trip.bus.title + '</td></tr>\n' +
                    '                <tr><th>Seats</th><td>' + trip.bus.seatsNum + '</td></tr>\n' +
                    '                <tr><th>Amount per Passenger</th><td>' + trip.amount + '</td></tr>\n' +
                    '            </table>\n' +
                    '            <div>' +
                    '                <button type="button" class="btn btn-primary" onclick="selectTrip(this,' + trip.id + ')">Select</button>' +
                    '            </div>' +
                    '        </div>\n' +
                    '    </section>\n' +
                    '</div>'
                );
            });
        });
    }

    function setRoutes() {
        $.ajax({
            url: API + '/route/get-all.php',
            dataType: 'json',
            headers: {
                'Authorization': $.cookie('jwt')
            }
        }).done(function (data) {
            $('.routeSelect').empty();
            $.each(data, function (i, route) {
                $('.routeSelect').append(
                    '<option value="' + route.id + '">' + route.title + '</option>'
                );
            });
        });
    }

    $(document).ready(function () {

        if (isLoggedIn()) {
            $("#loggedInEmail").text($.cookie('email'));
            $("#loggedInName").text($.cookie('name'));

            $(".logged-in").show();
            $(".logged-out").hide();
        } else {
            $("#loggedInEmail").text('');
            $("#loggedInName").text('');

            $(".logged-in").hide();
            $(".logged-out").show();
        }

        setRoutes();

        submit($('#loginForm'), API + '/passenger/login.php', (success, response) => {
            if (success) {
                login(response);
                alert(response.data);
                $('#loginForm')[0].reset();
            } else {
                alert(response.error);
            }
        });

        submit($('#signupForm'), API + '/passenger/register.php', (success, response) => {
            if (success) {
                alert(response.data);
                $('#signupForm')[0].reset();
            } else {
                alert(response.error);
            }
        });

        submit($('#bookingForm'), API + '/booking/add.php', (success, response) => {
            if(success) {
                new PNotify({
                    title: 'Success',
                    text: response.data,
                    type: 'custom',
                    addclass: 'notification-success',
                    icon: 'fa fa-check'
                });
                $('#bookingForm')[0].reset();
                alert("Your booking has been placed successfully.");
                location.href = 'index.php';
            } else {
                new PNotify({
                    title: 'Error',
                    text: response.error,
                    type: 'error',
                    shadow: true
                });
            }
        });

    });
</script>
</body>
</html>