@extends('Backend.template')
@section('head')
<meta id="ss_token" name="ss_token" value="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">创建子站点</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    子站点（专题站点）
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6" id='collection'>
                            <form role="form" @submit.prevent="collectionCreate">
                                <div class="form-group">
                                    <input name='sitename' class="form-control" placeholder="站点名称" v-model='name'>
                                    <p class="help-block">示例：<code>史量才记者中心</code></p>
                                    <p class="help-block">这里的名称仅作为管理标识。</p>
                                </div>

                                <div class="form-group">
                                    <input name='siteurl' class="form-control" placeholder="子站点域名" v-model='url'>
                                    <p class="help-block">示例：<code>rdblog</code>、<code>bbs</code></p>
                                    <p class="help-block">允许使用下划线，除此之外请不要输入其他符号。</p>
                                </div>

                                <div class="form-group">
                                    <input name='sitetitle' class="form-control" placeholder="站点标题" v-model='title'>
                                    <p class="help-block">示例：<code>2016新生专题-阳光网站</code></p>
                                    <p class="help-block">这里的内容将会出现在子站点的<code>title</code>属性中。</p>
                                </div>

                                
                                <div class="form-group">
                                    <label>站点主题模板</label>
                                    <select class="form-control" v-model='template'>
                                        <option value='' selected>无模板</option>
                                        <option value='rdblog'>研发博客</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>站点状态</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="onoff" id="siteon" value="1" checked v-model='status'>开启
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="oonoff" id="siteoff" value="0" v-model='status'>关闭
                                        </label>
                                    </div>
                                </div>
                                

                                <button type="submit" class="btn btn-outline btn-success">创建</button>
                                <button type="reset" class="btn btn-outline btn-default">重填</button>
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-6">
                            
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
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
    Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#ss_token').getAttribute('value');
    new Vue({
        el:'#collection',
        data:{
            name: '',
            url: '',
            title: '',
            template: '',
            status: '',
        },
        methods:{
            collectionCreate : function(e){
                if (this.name == '' || this.url == '' || this.title == '' || this.status == '') {
                    alert('数据不完整');
                }
                else
                {
                    // POST
                    this.$http.post('/api/collection', { 
                        name : this.name, 
                        uri: this.url,
                        title: this.title,
                        theme: this.template,
                        status: this.status,
                        }).then((response) => {
                            // get status
                            alert("创建成功！");
                            window.location = '/ssbackend';

                        }, (response) => {
                            alert("错误："+response.status+",请联系管理员。");
                    });
                    
                }
            }
        }
    })
</script>
@endsection