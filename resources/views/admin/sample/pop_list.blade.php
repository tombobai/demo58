@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
<body class="gray-bg animated fadeInUp edit" style="background:#fff;">
    <div id="bigBox">
        <div class="searchBox">
            <div class="row">
                <div class="col-sm-5 col-md-5 col-xs-5">
                    <div class="form-group">
                        <label class="control-label col-md-4">文章标题：</label>
                        <div class="col-md-8">
                            <input type="text" name="" class="form-control" placeholder="请输入文本">
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 col-md-5 col-xs-5">
                    <div class="form-group clearfix">
                        <label class="control-label col-md-4">文章分类：</label>
                        <div class="col-sm-8 col-md-8 col-xs-12">
                            <select class="form-control" name="fenlei" required>
                                <option value="" selected>=请选择=</option>
                                <option value="2">地理</option>
                                <option value="3">历史</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 col-md-5 col-xs-5">
                    <div class="form-group">
                        <label class="control-label col-md-4">文章标题：</label>
                        <div class="col-md-8">
                            <input type="text" name="" class="form-control" placeholder="请输入文本">
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 col-md-5 col-xs-5">
                    <div class="form-group clearfix">
                        <label class="control-label col-md-4">文章分类：</label>
                        <div class="col-sm-8 col-md-8 col-xs-12">
                            <select class="form-control" name="fenlei" required>
                                <option value="" selected>=请选择=</option>
                                <option value="2">地理</option>
                                <option value="3">历史</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-1 col-md-1 col-xs-1">
                    <div class="btns pull-right btns_edit">
                        <button type="button" class="btn btn-sm">查询</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive ">
            <table class="table table-bordered table-condensed article_list dataTables-example">
                <thead>
                <tr>
                    <th width="70">文章标题</th>
                    <th width="40">作者</th>
                    <th width="70">来源</th>
                    <th width="40">文章分类</th>
                    <th width="70">发布时间</th>
                    <th width="30">发布状态</th>
                    <th width="80">banner图片</th>
                    <th width="50">操作</th>
                </tr>
                </thead>
                <tr>
                    <td>从你的全世界路过，你却没发现我从你的全世界路过，你却没发现我从你的全世界路过，你却没发现我从你的全世界路过，你却没发现我从你的全世界路过，你却没发现我从你的全世界路过，你却没发现我从你的全世界路过，你却没发现我</td>
                    <td>黄豆豆</td>
                    <td>新浪</td>
                    <td>抒情</td>
                    <td>2017.09.08</td>
                    <td>否</td>
                    <td><img src="img/banner.jpg" class="cls_zoom_image"/></td>
                    <td><button class="btn btn-primary btn-xs">编辑</button> <button class="btn btn-warning btn-xs">删除</button></td>
                </tr>
                <tr>
                    <td>你却没发现我，从你的全世界路过</td>
                    <td>黄豆豆</td>
                    <td>新浪</td>
                    <td>抒情</td>
                    <td>2017.09.08</td>
                    <td>否</td>
                    <td><img src="img/banner.jpg" class="cls_zoom_image"/></td>
                    <td><button class="btn btn-primary btn-xs">编辑</button> <button class="btn btn-warning btn-xs">删除</button></td>
                </tr>
                <tr>
                    <td>简爱</td>
                    <td>黄豆豆</td>
                    <td>新浪</td>
                    <td>抒情</td>
                    <td>2017.09.08</td>
                    <td>否</td>
                    <td><img src="img/big_pic_1.jpg" class="cls_zoom_image"/></td>
                    <td><button class="btn btn-primary btn-xs">编辑</button> <button class="btn btn-warning btn-xs">删除</button></td>
                </tr>

            </table>

        </div>
    </div>
</body>
@endsection