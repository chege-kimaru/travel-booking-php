const API = 'http://localhost/travel/api/route';

function logout() {
    $.removeCookie('BUSBOOKING-PASSENGER-JWT');
    $.removeCookie('BUSBOOKING-PASSENGER-ID');
    $.removeCookie('BUSBOOKING-PASSENGER-NAME');
    $.removeCookie('BUSBOOKING-PASSENGER-EMAIL');

    $(".logged-in").hide();
    $(".logged-out").show();
}

function login(data) {
    $.cookie('BUSBOOKING-PASSENGER-JWT', data.jwt);
    $.cookie('BUSBOOKING-PASSENGER-ID', data.id);
    $.cookie('BUSBOOKING-PASSENGER-NAME', data.name);
    $.cookie('BUSBOOKING-PASSENGER-EMAIL', data.email);

    $("#loggedInEmail").text(data.email);
    $("#loggedInName").text(data.name);

    $(".logged-in").show();
    $(".logged-out").hide();
}

function isLoggedIn() {
    return $.cookie('BUSBOOKING-PASSENGER-JWT');
}