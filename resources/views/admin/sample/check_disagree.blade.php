@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
<body class="gray-bg fadeInUp" style="background:#f3f3f4; height:auto;">
    <div class="row dashboard-header">
        <div class="col-sm-6 col-md-6 col-xs-6 check_left">
            <!--历史驳回记录开始-->
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>历史驳回记录</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="table_basic.html#">选项1</a>
                            </li>
                            <li><a href="table_basic.html#">选项2</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th width="30%">驳回时间</th>
                            <th width="70%">驳回原因</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>2018-03-31 15:49:30</td>
                            <td>身份证反面图片已过有效期；姓名和身份证姓名不一致</td>
                        </tr>
                        <tr>
                            <td>2018-03-31 15:49:30</td>
                            <td>身份证反面图片已过有效期；姓名和身份证姓名不一致</td>
                        </tr>
                        <tr>
                            <td>2018-03-31 15:49:30</td>
                            <td>身份证反面图片已过有效期；姓名和身份证姓名不一致</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <!--历史驳回记录结束-->
            <!--审核资金切换开始-->
            <div class="row">
                <div class="form-group clearfix">
                    <div class="col-sm-12 col-md-12 col-xs-12">
                        <div class="nav_set_list">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="javascript:;">完善资料</a></li>
                                <li><a href="javascript:;">资金方信息</a></li>
                                <li><a href="javascript:;">签合同</a></li>
                            </ul>
                            <div class="btn_group btn_refresh">

                            </div>
                        </div>
                        <div>
                            <!--内容切换-->
                            <form role="form" id="website_form">
                                <!--完善资料-->
                                <div class="panel panel-default panel_set_0">
                                    <div id="collapse_0" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="check_info">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <td width="30%" class="check_red">姓名</td>
                                                        <td width="70%">黎明</td>
                                                    </tr>
                                                    <tr>
                                                        <td>证件有效期</td>
                                                        <td>2018-03-31</td>
                                                    </tr>
                                                    <tr>
                                                        <td>家庭所在地区</td>
                                                        <td>身份证反面图片已过有效期；姓名和身份证姓名不一致</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="check_red">居住情况</td>
                                                        <td>自有住房</td>
                                                    </tr>
                                                    <tr>
                                                        <td>房产情况</td>
                                                        <td>有房无贷款</td>
                                                    </tr>
                                                    <tr>
                                                        <td>居住情况</td>
                                                        <td>三里屯SOHO</td>
                                                    </tr>
                                                    <tr>
                                                        <td>手机号</td>
                                                        <td>13456789876</td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--资金方信息-->
                                <div class="panel panel-default panel_set_1">
                                    <div id="collapse_1" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="check_info">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <td width="30%" class="check_red">姓名</td>
                                                        <td width="70%">郭富城</td>
                                                    </tr>
                                                    <tr>
                                                        <td>证件有效期</td>
                                                        <td>2018-03-31</td>
                                                    </tr>
                                                    <tr>
                                                        <td>家庭所在地区</td>
                                                        <td>身份证反面图片已过有效期；姓名和身份证姓名不一致</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="check_red">居住情况</td>
                                                        <td>自有住房</td>
                                                    </tr>
                                                    <tr>
                                                        <td>房产情况</td>
                                                        <td>有房无贷款</td>
                                                    </tr>
                                                    <tr>
                                                        <td>居住情况</td>
                                                        <td>三里屯SOHO</td>
                                                    </tr>
                                                    <tr>
                                                        <td>手机号</td>
                                                        <td>13456789876</td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--签合同-->
                                <div class="panel panel-default panel_set_2">
                                    <div id="collapse_2" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="check_info">
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <td width="30%" class="check_red">营销人员代码</td>
                                                        <td width="70%">004</td>
                                                    </tr>
                                                    <tr>
                                                        <td>领用合约</td>
                                                        <td>2018-03-31</td>
                                                    </tr>
                                                    <tr>
                                                        <td>浦发营业人员</td>
                                                        <td>刘德华</td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--审核资金切换结束-->
        </div>
        <div class="col-sm-6 col-md-6 col-xs-6  check_right">
            <div class="switch_file col-sm-3 col-md-3 col-xs-3">
                <ul class="folder-list" style="padding: 0">
                    <li>
                        <a href="javascript:;"><i class="fa fa-folder"></i>待完善资料时</a>
                        <ul class="sub_list">
                            <li>身份证正反面</li>
                            <li>车辆行驶证</li>
                            <li>客户手持身份证</li>
                            <li>签署征信授权书</li>
                            <li>三个月话费清单</li>
                            <li>其他</li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="fa fa-folder"></i>待签合同</a>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="fa fa-folder"></i>待办理抵押手续</a>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="fa fa-folder"></i>待上传交接照片</a>
                    </li>
                </ul>
            </div>
            <div class="switch_img col-sm-9 col-md-9 col-xs-9 clearfix">
                <div class="noClassify clearfix">
                    <div class="ibox-title">
                        <h5>身份证正面</h5>
                    </div>
                    <div class="file-box">
                        <div class="file file_border_red">
                            <a href="javascript:;">
                                <span class="corner"></span>
                                <div class="image">
                                    <img alt="image" class="img-responsive cls_zoom_image" src="{{ asset('admin/img/p3.jpg') }}">
                                </div>
                                <div class="file-name">
                                    Document_2014.doc
                                    <br/>
                                    <small>添加时间：2014-10-13</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="file-box">
                        <div class="file">
                            <a href="javascript:;">
                                <span class="corner"></span>
                                <div class="image">
                                    <img alt="image" class="img-responsive cls_zoom_image" src="{{ asset('admin/img/p1.jpg') }}">
                                </div>
                                <div class="file-name">
                                    Italy street.jpg
                                    <br/>
                                    <small>添加时间：2014-10-13</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="file-box">
                        <div class="file">
                            <a href="javascript:;">
                                <span class="corner"></span>
                                <div class="image">
                                    <img alt="image" class="img-responsive cls_zoom_image" src="{{ asset('admin/img/p2.jpg') }}">
                                </div>
                                <div class="file-name">
                                    Italy street.jpg
                                    <br/>
                                    <small>添加时间：2014-10-13</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="file-box">
                        <div class="file">
                            <a href="javascript:;">
                                <span class="corner"></span>
                                <div class="image">
                                    <img alt="image" class="img-responsive cls_zoom_image" src="{{ asset('admin/img/p3.jpg') }}">
                                </div>
                                <div class="file-name">
                                    Document_2014.doc
                                    <br/>
                                    <small>添加时间：2014-10-13</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="file-box">
                        <div class="file">
                            <a href="javascript:;">
                                <span class="corner"></span>
                                <div class="image">
                                    <img alt="image" class="img-responsive cls_zoom_image" src="{{ asset('admin/img/p1.jpg') }}">
                                </div>
                                <div class="file-name">
                                    Italy street.jpg
                                    <br/>
                                    <small>添加时间：2014-10-13</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="file-box">
                        <div class="file">
                            <a href="javascript:;">
                                <span class="corner"></span>
                                <div class="image">
                                    <img alt="image" class="img-responsive" src="{{ asset('admin/img/p3.jpg') }}">
                                </div>
                                <div class="file-name">
                                    Italy street.jpg
                                    <br/>
                                    <small>添加时间：2014-10-13</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="imgClassify">
                    <div class="ibox-title">
                        <h5>身份证反面</h5>
                    </div>
                    <div class="file-box">
                        <div class="file file_border_red">
                            <a href="javascript:;">
                                <span class="corner"></span>
                                <div class="image">
                                    <img alt="image" class="img-responsive cls_zoom_image" src="{{ asset('admin/img/p3.jpg') }}">
                                </div>
                                <div class="file-name">
                                    Document_2014.doc
                                    <br/>
                                    <small>添加时间：2014-10-13</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="file-box">
                        <div class="file">
                            <a href="javascript:;">
                                <span class="corner"></span>
                                <div class="image">
                                    <img alt="image" class="img-responsive cls_zoom_image" src="{{ asset('admin/img/p2.jpg') }}">
                                </div>
                                <div class="file-name">
                                    Document_2014.doc
                                    <br/>
                                    <small>添加时间：2014-10-13</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="file-box">
                        <div class="file">
                            <a href="javascript:;">
                                <span class="corner"></span>
                                <div class="image">
                                    <img alt="image" class="img-responsive cls_zoom_image" src="{{ asset('admin/img/p2.jpg') }}">
                                </div>
                                <div class="file-name">
                                    Document_2014.doc
                                    <br/>
                                    <small>添加时间：2014-10-13</small>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="file-box">
                        <div class="file">
                            <a href="javascript:;">
                                <span class="corner"></span>
                                <div class="image">
                                    <img alt="image" class="img-responsive cls_zoom_image" src="{{ asset('admin/img/p1.jpg') }}">
                                </div>
                                <div class="file-name">
                                    Document_2014.doc
                                    <br/>
                                    <small>添加时间：2014-10-13</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--审核结果开始-->
    <div class="checkResult">
        <div class="ibox-title">
            <h5>审核结果</h5>
        </div>
        <div class="row">
            <label class="control-label col-sm-3 col-md-3 col-xs-12"><sup>* </sup>审核结果：</label>
            <div class="col-sm-8 col-md-8 col-xs-12">
                <div class="radio_box">
                    <label for="male" class="control-label"><input type="radio" id="male" name="power" required/>通过</label>
                    <label for="female" class="control-label"><input type="radio" id="female" name="power" required/>驳回</label>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-3 col-md-3 col-xs-12"><sup>* </sup>驳回项：</label>
            <div class="col-sm-8 col-md-8 col-xs-12">
                <div class="check_box">
                    <div class="row">
                        <input type="checkbox" />待完善资料
                    </div>
                    <div class="row">
                        <input type="checkbox" />待签合同
                    </div>
                    <div class="row">
                        <input type="checkbox" />待办理抵押手续
                    </div>
                    <div class="row">
                        <input type="checkbox" />待上传交接图片
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-3 col-md-3 col-xs-12"><sup>* </sup>内部建议：</label>
            <div class="col-sm-8 col-md-8 col-xs-12">
                <textarea class="result_info" placeholder="这里输入内容" name="editor_area"></textarea>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-3 col-md-3 col-xs-12"></label>
            <div class="col-sm-8 col-md-8 col-xs-12">
                <button type="button" class="btn btn_submit btn_check_info">提交审核意见</button>
            </div>
        </div>
        <div class="btn_arrow">
            <img src="{{asset('admin/img/arrow_right.png') }}"/>
        </div>
    </div>
    <!--审核结果结束-->
    <!--显示大图开始-->
    <div id="zoom_image_popup">
        <div class="zoom_image_bg"><img src="" alt="" /></div>
    </div>
    <link rel="stylesheet" type="text/css" href="{{ asset('js/zoom_image/css/zoom_image.css') }}" />
    <script type="text/javascript" src="{{ asset('js/zoom_image/zoom_image.js') }}"></script>
    <!--显示大图结束-->
    <!--完善资料改错历史记录开始-->
    <div class="error_bg"></div>
    <div class="history col-sm-6 col-md-6 col-xs-6">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>历史修改记录</h5>
            </div>
            <div class="ibox-content">
                <table class="table">
                    <thead>
                    <tr>
                        <th width="30%">驳回时间</th>
                        <th width="70%">驳回原因</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>2018-03-31 15:49:30</td>
                        <td>身份证反面图片已过有效期；姓名和身份证姓名不一致</td>
                    </tr>
                    <tr>
                        <td>2018-03-31 15:49:30</td>
                        <td>身份证反面图片已过有效期；姓名和身份证姓名不一致</td>
                    </tr>
                    <tr>
                        <td>2018-03-31 15:49:30</td>
                        <td>身份证反面图片已过有效期；姓名和身份证姓名不一致</td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <div class="btn_close"><img src="{{ asset('admin/img/close.png') }}" width="30px"/></div>
    </div>
    <!--完善资料改错历史记录结束-->
</body>
    <script>
        $(document).ready(function(){$(".file-box").each(function(){animationHover(this,"pulse")})});
        var bFlag = true;
        $('.btn_arrow').click(function(){

            if(bFlag){
                $('.checkResult').removeClass('to_l');
                $('.checkResult').addClass('to_r');
                $('.btn_arrow img').attr('src',"{{ asset('admin/img/arrow_left.png') }}");
            }else{
                $('.checkResult').removeClass('to_r');
                $('.checkResult').addClass('to_l');
                $('.btn_arrow img').attr('src',"{{ asset('admin/img/arrow_right.png') }}");
            }
            bFlag = !bFlag;
        });

        $('.check_red').click(function(){
            $('.history,.error_bg').show();
        });
        $('.btn_close').click(function(){
            $('.history,.error_bg').hide();
        });

        $('.btn_check_info').click(function(){
            window.opener=null;
            window.open('','_self');
            window.close();
        });

        $('.nav-tabs li').click(function(){

            var index = $(this).index();
            console.log(index);
            $(this).addClass('active').siblings().removeClass('active');

            $('.panel_set_'+index).show().siblings().hide();

            //$('.btn_refresh a').attr('href','#collapse_'+index);
        });
    </script>
@endsection