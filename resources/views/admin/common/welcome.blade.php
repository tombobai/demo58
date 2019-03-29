@extends('admin.layouts.master')

@section('title', $page_title)

@section('content')
<body class="gray-bg">
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="col-sm-5">
            <h2>XXX-管理系统</h2>
            <p>欢迎使用XXX-管理系统，在该系统中可以维护日常网站的信息。</p>
            <p>
                <b>遇到问题：</b>请及时联系管理员
            </p>
        </div>
        <div class="col-sm-4">
            <h4>系统具有以下功能：</h4>
            <ol>
                <li>维护日常网站的信息</li>
                <li>拥有良好的用户体验</li>
                <li>使用方便，可扩展性强</li>
            </ol>
        </div>
    </div>
</body>
@endsection