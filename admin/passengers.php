<?php
$title = "Passengers";
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
                <h2>Passengers</h2>

                <div class="right-wrapper pull-right">
                    <ol class="breadcrumbs">
                        <li>
                            <a href="index.php">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li><span>Passengers</span></li>
                    </ol>

                    <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
                </div>
            </header>


            <!-- start: page -->

            <div class="col-md-6 col-lg-12 col-xl-6">
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Passengers</h4>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover"
                                   id="passengersTable">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="passengersTableBody">

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
<script src="assets/vendor/jquery-appear/jquery.appear.js"></script>
<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
<script src="assets/vendor/flot/jquery.flot.js"></script>
<script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
<script src="assets/vendor/flot/jquery.flot.pie.js"></script>
<script src="assets/vendor/flot/jquery.flot.categories.js"></script>
<script src="assets/vendor/flot/jquery.flot.resize.js"></script>
<script src="assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
<script src="assets/vendor/raphael/raphael.js"></script>
<script src="assets/vendor/morris/morris.js"></script>
<script src="assets/vendor/gauge/gauge.js"></script>
<script src="assets/vendor/snap-svg/snap.svg.js"></script>
<script src="assets/vendor/liquid-meter/liquid.meter.js"></script>

<!-- Theme Base, Components and Settings -->
<script src="assets/javascripts/theme.js"></script>

<!-- Theme Custom -->
<script src="assets/javascripts/theme.custom.js"></script>

<!-- Theme Initialization Files -->
<script src="assets/javascripts/theme.init.js"></script>


<!-- Examples -->
<script src="assets/javascripts/dashboard/examples.dashboard.js"></script>



<!-- DataTables JavaScript -->
<script src="./assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="./assets/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="./assets/vendor/datatables-responsive/dataTables.responsive.js"></script>

<script src="assets/vendor/jquery/jquery.cookie.js"></script>

<script src="./app/main.js"></script>
<script src="./app/form.js"></script>
<script type="text/javascript">
    function setPassengersTableData() {
        $('#passengersTableBody').append(
            '<tr>\n' +
            '    <td><img src="./assets/images/loading.gif" alt="Loading..........." width="50" height="50">\n' +
            '    </td>\n' +
            '</tr>'
        );
        $.ajax({
            url: API + '/passenger/get-all.php',
            dataType: 'json',
            headers: {
                'Authorization': $.cookie('jwt')
            }
        }).done(function(data) {
            adminsData = [];
            $('#passengersTableBody').empty();
            $.each(data, function(i, admin) {
                adminsData.push({
                    "id" :   admin.id,
                    "name" :   admin.name,
                    "phone" :   admin.phone,
                    "email" :   admin.email,
                    "actions" : '&nbsp;&nbsp;<button class="btn btn-danger" onclick="deleteBtnClicked(this)">' +
                    '<i class="fa fa-trash-o"></i></button></a>'
                });
            });
            if( $('#passengersTable').DataTable()) {
                $('#passengersTable').DataTable().destroy();
            }
            $('#passengersTable').DataTable({
                data: adminsData,
                columns: [
                    {data: "id"},
                    {data: "name"},
                    {data: "phone"},
                    {data: "email"},
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
                setPassengersTableData();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown.error);
            }
        });
    }

    $(document).ready(function() {
        // requireAdmin();

        setPassengersTableData();

        submit($('#adminForm'), API + '/admin/add.php', (success, response) => {
            if(success) {
                alert(response.data);
                $('#adminForm')[0].reset();
                setPassengersTableData();
            } else {
                alert(response.error);
            }
        });

    });
</script>
</body>
</html>