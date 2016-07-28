@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">修改文章</div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>编辑失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <form action="{{ url('admin/comment/update') }}" method="POST">
                        {!! csrf_field() !!}
                         <input type="hidden" name="_method" value="put" />
                        <input type="hidden" name="id" class="form-control" required="required" value={{ $comment->id }}>
                        <input type="text" name="nickname" class="form-control" required="required" placeholder="请输入标题" value={{ $comment->nickname }}>
                        <br>
                        <textarea name="content" rows="10" class="form-control" required="required" placeholder="请输入内容">{{ $comment->content }}</textarea>
                        <br>
                        <button class="btn btn-lg btn-info">修改</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection