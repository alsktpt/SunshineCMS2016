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
                    <table class="table table-striped table-bordered table-hover" id="dataTables-collection">
                        <thead>
                            <tr>
                                <th>站点名称</th>
                                <th>站点URI</th>
                                <th>站点标题</th>
                                <th>站点状态</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="coll in collections">
                                <td>@{{ coll.name }}</td>
                                <td>@{{ coll.uri  }}</td>
                                <td>@{{ coll.title  }}</td>
                                <td>@{{ coll.available  }}</td>
                                <td>@{{ coll.created_at  }}</td>
                                <td>
                                <a href="/ssbackend/collection/@{{ coll.uri }}">编辑</a> 
                                <a href="/@{{ coll.uri }}">访问</a> 
                                </td>
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

<script src="{{ URL::asset('js/vue.min.js') }}"></script>
<script src="{{ URL::asset('js/vue-r.min.js') }}"></script>

<script>

new Vue({
    el: '#dataTables-collection',
    data: {
        collections:[],
    },
    ready: function() {
        
        this.$http.get('/api/collection').then((response) => {
            // success callback
            for (var i = response.body.length - 1; i >= 0; i--) {
                response.body[i]['available'] = (response.body[i]['status'] === 1)?'运行中':'关闭维护';
                this.collections.push(response.body[i]);
            };
        }, (response) => {
            // error callback
            console.log(response);
        });
            
    }

})

</script>
@endsection