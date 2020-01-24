<?php
$title = "Trips";
?>
<!doctype html>
<html class="fixed">

<?php include_once 'head.php'; ?>

<body>
<section class="body">

    <?php include_once 'header.php'; ?>

    <div class="inner-wrapper">

        <?php include_once 'side-bar-left.php'; ?>

        <section role="main" class="content-body">
            <header class="page-header">
                <h2>Trips</h2>

                <div class="right-wrapper pull-right">
                    <ol class="breadcrumbs">
                        <li>
                            <a href="index.php">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li><span>Trips</span></li>
                    </ol>

                    <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
                </div>
            </header>


            <!-- start: page -->

            <div class="col-md-6 col-lg-12 col-xl-6">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Trips</h4>
                            <button class="btn btn-success" data-toggle="modal" data-target="#addTripModal"><i
                                        class="fa fa-plus"></i></button>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover"
                                   id="tripsTable">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Route</th>
                                    <th>Bus</th>
                                    <th>Amount</th>
                                    <th>Departure</th>
                                    <th>Arrival</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="tripsTableBody">

                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
            </div>

    </div>


    <?php include_once 'side-bar-right.php'; ?>

</section>

<div class="modal fade" id="addTripModal" tabindex="-1" role="dialog" aria-labelledby="addTripModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addTripModalTitle">Add Trip</h4>
            </div>
            <div class="modal-body">
                <form role="form" id="tripForm">
                    <div class="form-group">
                        <label>Route</label>
                        <select name="route_id" class="form-control routeSelect">

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Bus</label>
                        <select name="bus_id" class="form-control busSelect">

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input name="amount" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Departure Time</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </span>
                            <input name="deptTime" type="text" data-plugin-timepicker class="form-control"
                                   data-plugin-options='{ "showMeridian": false }'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Arrival Time</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                            </span>
                            <input name="arrivalTime" type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }'>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-success">Save and Submit</button>
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
<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
<script src="assets/vendor/select2/select2.js"></script>
<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<script src="assets/vendor/fuelux/js/spinner.js"></script>
<script src="assets/vendor/dropzone/dropzone.js"></script>
<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script src="assets/vendor/codemirror/lib/codemirror.js"></script>
<script src="assets/vendor/codemirror/addon/selection/active-line.js"></script>
<script src="assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
<script src="assets/vendor/codemirror/mode/javascript/javascript.js"></script>
<script src="assets/vendor/codemirror/mode/xml/xml.js"></script>
<script src="assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="assets/vendor/codemirror/mode/css/css.js"></script>
<script src="assets/vendor/summernote/summernote.js"></script>
<script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="assets/javascripts/theme.js"></script>

<!-- Theme Custom -->
<script src="assets/javascripts/theme.custom.js"></script>

<!-- Theme Initialization Files -->
<script src="assets/javascripts/theme.init.js"></script>


<!-- Examples -->
<script src="assets/javascripts/forms/examples.advanced.form.js"></script>


<!-- DataTables JavaScript -->
<script src="./assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="./assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="./assets/vendor/datatables-responsive/dataTables.responsive.js"></script>

<script src="assets/vendor/jquery/jquery.cookie.js"></script>

<script src="./app/main.js"></script>
<script src="./app/form.js"></script>
<script type="text/javascript">
    function setRoutes() {
        $.ajax({
            url: API + '/route/get-all.php',
            dataType: 'json',
            headers: {
                'Authorization': $.cookie('jwt')
            }
        }).done(function(data) {
            $('.routeSelect').empty();
            $.each(data, function(i, route) {
                $('.routeSelect').append(
                    '<option value="' + route.id + '">' + route.title + '</option>'
                );
            });
        });
    }

    function setBuses() {
        $.ajax({
            url: API + '/bus/get-all.php',
            dataType: 'json',
            headers: {
                'Authorization': $.cookie('jwt')
            }
        }).done(function(data) {
            $('.busSelect').empty();
            $.each(data, function(i, bus) {
                $('.busSelect').append(
                    '<option value="' + bus.id + '">' + bus.title + '</option>'
                );
            });
        });
    }

    function setTripsTableData() {
        $('#tripsTableBody').append(
            '<tr>\n' +
            '    <td><img src="./assets/images/loading.gif" alt="Loading..........." width="50" height="50">\n' +
            '    </td>\n' +
            '</tr>'
        );
        $.ajax({
            url: API + '/trip/get-all.php',
            dataType: 'json',
            headers: {
                'Authorization': $.cookie('jwt')
            }
        }).done((data) => {
            tripsData = [];
            $('#tripsTableBody').empty();
            $.each(data, function(i, trip) {
                tripsData.push({
                    "id" :   trip.id,
                    "route" :   trip.route.title,
                    "bus" : trip.bus.title,
                    "deptTime" :   trip.deptTime,
                    "arrivalTime" :   trip.arrivalTime,
                    "amount" :   trip.amount,
                    "active" :   trip.active,
                    "actions" : '&nbsp;&nbsp;<button class="btn btn-danger" onclick="deleteBtnClicked(this)">' +
                    '<i class="fa fa-trash-o"></i></button></a>'
                });
            });
            if( $('#tripsTable').DataTable()) {
                $('#tripsTable').DataTable().destroy();
            }
            $('#tripsTable').DataTable({
                data: tripsData,
                columns: [
                    {data: "id"},
                    {data: "route"},
                    {data: "bus"},
                    {data: "amount"},
                    {data: "deptTime"},
                    {data: "arrivalTime"},
                    {data: "active"},
                    {data: "actions"},
                ]
            });
        });
    }

    function deleteBtnClicked(obj) {
        $.ajax({
            url: API + '/user/delete.php',
            type: 'post',
            contentType: "application/json",
            dataType: "json",
            data: JSON.stringify({'id': $(obj).closest('tr').find("td:eq(0)").text()}),
            headers: {
                'Authorization': $.cookie('jwt')
            },
            success: function (response) {
                alert(response.data);
                setTripsTableData();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown.error);
            }
        });
    }

    $(document).ready(function() {
        // requireAdmin();
        setRoutes();
        setBuses();
        setTripsTableData();

        submit($('#tripForm'), API + '/trip/add.php', (success, response) => {
            if(success) {
                alert(response.data);
                $('#tripForm')[0].reset();
                setTripsTableData();
            } else {
                alert(response.error);
            }
        });

    });
</script>

</body>
</html>