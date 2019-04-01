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

    //重置
    $('.search-reset').on('click', function () {
        var formId = $(this).parents('form').attr('id');
        $(':input', '#'+formId).not(':button,:submit,:reset,:hidden').attr('value', '');
        $('select', '#'+formId).find('option').removeAttr('selected');
        $(".chosen-select", '#'+formId).trigger("chosen:updated");
    });

    // 点击按钮触发跳转到指定页函数
    $('.page-go').off('click').on('click', function () {
        var pageObj = $(this).parents('.pagination-jump');
        var inputVal = $(pageObj).find('.page-input').val();
        var pageGoObj = $(this);
        if(inputVal == '' || parseInt(inputVal) > parseInt(pageGoObj.find('a').data('totalpage'))){
            return false;
        }
        var toPage = setUrlParam(pageGoObj.find('a').data('url'), 'page', inputVal);
        window.location.href = toPage;
    });
});

function setUrlParam(location,name, value) {
    var url = location;
    var splitIndex = url.indexOf("?") + 1;
    var paramStr = url.substr(splitIndex, url.length);

    var newUrl = url.substr(0, splitIndex);

    // - if exist , replace
    var arr = paramStr.split('&');
    for (var i = 0; i < arr.length; i++) {
        var kv = arr[i].split('=');
        if (kv[0] == name) {
            newUrl += kv[0] + "=" + value;
        } else {
            if (kv[1] != undefined) {
                newUrl += kv[0] + "=" + kv[1];
            }
        }
        if (i != arr.length - 1) {
            newUrl += "&";
        }
    }

    // - if new, add
    if (newUrl.indexOf(name) < 0) {
        newUrl += splitIndex == 0 ? "?" + name + "=" + value : "&" + name + "=" + value;
    }
    return newUrl;
}

/**
 * 功能：添加/编辑页中，点击"返回"按钮
 */
function back_btn(url){
    window.location.href = url;
}