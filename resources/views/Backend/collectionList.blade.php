@extends('Backend.template')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">子站列表</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th>Engine version</th>
                                <th>CSS grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="odd gradeX">
                                <td>Trident</td>
                                <td>Internet Explorer 4.0</td>
                                <td>Win 95+</td>
                                <td class="center">4</td>
                                <td class="center">X</td>
                            </tr>
                            <tr class="even gradeC">
                                <td>Trident</td>
                                <td>Internet Explorer 5.0</td>
                                <td>Win 95+</td>
                                <td class="center">5</td>
                                <td class="center">C</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
@endsection


@section('script')
<script src="{{ URL::asset('js/plugins/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('js/plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('js/vue.min.js') }}"></script>
<script src="{{ URL::asset('js/vue-r.min.js') }}"></script>

<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
            responsive: true
    });
});

new Vue({

    ready: function() {
        console.log('ready');
        // GET request
        this.$http({url: '/api/collection', method: 'GET'}).then(function (response) {
            console.log(response);
        }, function (response) {
            // error callback
        });

    }

})
</script>
@endsection