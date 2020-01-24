const API = 'http://localhost/travel/api/route';

if(location.href != 'http://localhost/travel/admin/login.php') {
    setAdmin();
}

function logout() {
    $.removeCookie('BUSBOOKING-ADMIN-JWT');
    $.removeCookie('BUSBOOKING-ADMIN-ID');
    $.removeCookie('BUSBOOKING-ADMIN-USERNAME');

    $(".logged-in").hide();
    $(".logged-out").show();

    location.href = "login.php";
}

function login(data) {
    $.cookie('BUSBOOKING-ADMIN-JWT', data.jwt);
    $.cookie('BUSBOOKING-ADMIN-ID', data.id);
    $.cookie('BUSBOOKING-ADMIN-USERNAME', data.username);
}

function requireAdmin() {
    if(!$.cookie('BUSBOOKING-ADMIN-JWT')) {
        location.href = "login.php";
        return false;
    }
    return true;
}

function setAdmin() {
    if(requireAdmin()) {
        $("#loggedInName").text($.cookie('BUSBOOKING-ADMIN-USERNAME'));

        $(".logged-in").show();
        $(".logged-out").hide();
    }
}