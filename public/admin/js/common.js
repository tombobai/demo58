$(function() {
    //绑定刷新
    $(".btn_refreach").click(function(){
        window.location.reload();
    });
    //绑定a点击
    $(".a_click").click(function(){
        var _url = $(this).attr('data-url');
        window.location.href = _url;
    });
});

/**
 * 功能：添加/编辑页中，点击"返回"按钮
 */
function back_btn(url){
    window.location.href = url;
}