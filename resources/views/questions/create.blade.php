@extends('layouts.app')
@include('vendor.ueditor.assets')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">发布问题</div>
                <div class="panel-body">
                    <form action="/questions" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="title">标题</label>
                            <input type="text" name="title" class="form-control" placeholder="请输入问题标题" id="title">
                        </div>
                        <!-- 编辑器容器 -->
                        <script id="container" name="content" type="text/plain"></script>
                        <button class="btn btn-success pull-right" type="submit">发布问题</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });
</script>
@endsection