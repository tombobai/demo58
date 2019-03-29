
    <script type="text/javascript" src="{{ asset('js/fileupload/jquery.ui.widget.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/fileupload/jquery.iframe-transport.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/fileupload/jquery.fileupload.js') }}"></script>
    
    <link rel="stylesheet" type="text/css" href="{{ asset('js/imageselect/css/imgareaselect-default.css') }}" />
    <script type="text/javascript" src="{{ asset('js/imageselect/jquery.imgareaselect.pack.js') }}"></script>

        <div class="compile_banner">
            <div class="compile_banner_l">
                <div class="compile_banner_border">
                    <span id="imgword">选择一张本地照片编辑后上传</span>
                    <img style="vertical-align: middle;display:none;" id="flashimg" src="" />
                </div>
                <div class="endBtn">
                    <button type="button" class="btn btn-primary btn-xs" onclick="javascript:update_img();">保存</button>
                    <button type="button" class="btn btn-white btn-xs" onclick="javascript:delete_img();">关闭</button>
                </div>
            </div>
            <div class="compile_banner_r">
                <span id="fileupload_span">
                    <input type="file" class="btn_browse" id="fileupload" name="file"/>浏览...
                </span>
                <p>只限格式：jpg、gif、png</p>
                <p>建议尺寸：<?php echo $message; ?></p>
                <div class="cutter">
                    <h3>裁切尺寸</h3>
                    <ul>
                        <li>
                            宽度：<input type="text" class="cutter_size" id="selectorW" value="0" onkeyup="this.value=this.value.replace(/\D/g,'');updata_select('selectorW');" onafterpaste="this.value=this.value.replace(/\D/g,'')"/>
                        </li>
                        <li>
                            高度：<input type="text" class="cutter_size" id="selectorH" value="0" onkeyup="this.value=this.value.replace(/\D/g,'');updata_select('selectorH');" onafterpaste="this.value=this.value.replace(/\D/g,'')"/>
                        </li>
                        <li>
                            <button type="button" class="btn btn-primary btn_cutter btn-xs" onclick="save_img();">裁切并保存图片</button>
                        </li>
                    </ul>
                </div>
                <div class="scale">
                    <h3>缩放比例</h3>
                    <ul>
                        <li>
                            宽度：<input type="text" class="cutter_size" id="zoomW" value="0" onkeyup="this.value=this.value.replace(/\D/g,'');updata_zoom('zoomW');" onafterpaste="this.value=this.value.replace(/\D/g,'');"/>
                        </li>
                        <li>
                            高度：<input type="text" class="cutter_size" id="zoomH" value="0" onkeyup="this.value=this.value.replace(/\D/g,'');updata_zoom('zoomH');" onafterpaste="this.value=this.value.replace(/\D/g,'')"/>
                        </li>
                        <li>
                            <button type="button" class="btn btn-primary btn-xs btn_scale" id="zoom_button" onclick="javascript: update_zoomimg_zoom();">缩放</button>
                            <button type="button" class="btn btn-primary btn-xs btn_normal" id="primitive_button" onclick="javascript: update_zoomimg_primitive();">还原</button>
                        </li>
                    </ul>
                </div>
                <script type="text/javascript">
                    $(function(){
                        $('.btn_scale').show().css('margin-left',118);
                        $('.btn_normal').hide();
                    });
                </script>
            </div>
        </div>
    <input type="hidden" id="proportion" value="" />

    <input type="hidden" id="selectorX" value="0" />
    <input type="hidden" id="selectorY" value="0" />
                    
    <input type="hidden" id="primitive_width" value="" />
    <input type="hidden" id="primitive_height" value="" />
    <input type="hidden" id="primitive_img_path" value=""/>
    
    <input type="hidden" id="zoom_img_path" value=""/>
<script>
 $(function () {
	$('#fileupload').fileupload({
		headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
		url:"{{ url('admincp/ajaxupload/upload_image?flag='.$flag) }}",
        dataType: 'json',
        done: function (e, result) {
        	if(result.result.status=="success"){
            	var flashimg_src = $("#flashimg").attr('src');
            	if(flashimg_src!=''){
            		$.ajax({
            			headers: {
            	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            	        },
                        cache : false,
                        type : 'post',
                        url : "{{ url('admincp/ajaxupload/delete_image') }}",
                        data : {"imageSource":flashimg_src}
                    });//删除本页上传的图片
            	}

				var _image_primitive_width = result.result.primitive_width;
				var _image_primitive_height = result.result.primitive_height;
				var _image_path = result.result.path;
				var _image_proportion = result.result.proportion;
				var _image_width = result.result.width;
				var _image_height = result.result.height;
				
                //清除上一次或页面初始的设置值
                $("#imgword").hide();//关闭初始显示的文字
                empty_img();//清空裁切用参数
                $('#proportion').val(1);//缩放比例
                $('#primitive_width').val(_image_primitive_width);//图片真实宽度
                $('#primitive_height').val(_image_primitive_height);//图片真实高度
                $('#zoomW').val(_image_primitive_width);//图片真实宽度
                $('#zoomH').val(_image_primitive_height);//图片真实高度
                $('#primitive_img_path').val(_image_path);
                $('.defalut_none').show();

                $('#proportion').val(_image_proportion);//缩放比例
                
                $('#flashimg').attr("src", "{{ url('') }}" + _image_path + "?" + Date.parse(new Date()) );//图片路径
                $('#flashimg').attr("width", _image_width);//图片宽
                $('#flashimg').attr("height", _image_height);//图片高
                //$('#windown-close').remove();//移除弹出层关闭的叉子
                $('#flashimg').show();//显示图片

                $('#flashimg').imgAreaSelect({movable:true});
                $('#flashimg').imgAreaSelect
                ({
                    onSelectEnd: function (img, selection)
                    {
                        var x1 = Math.round(selection.x1 * _image_proportion);
                        var y1 = Math.round(selection.y1 * _image_proportion);
                        var x2 = Math.round(selection.x2 * _image_proportion);
                        var y2 = Math.round(selection.y2 * _image_proportion);
                        $('#selectorX').val(x1);
                        $('#selectorY').val(y1);
                        $('#selectorW').val(x2 - x1);
                        $('#selectorH').val(y2 - y1);
                    }
                });

                $('.baocunanniu').show();
                
        	}else{
        		alert("上传失败，请重新选择图片！");
        	}
        	//alert(JSON.stringify(result.result));
        }
	});

	/*$("#browser_btn").click(function(){
		$('#fileupload').trigger('click');
	});*/
});

/****************************/
 //关闭弹出框
 function close_popup_image()
 {
     $('#flashimg').imgAreaSelect({hide:true});//关闭选取框，防止缓存

     //关闭弹出层
     $("#windownbg").remove();
     $("#windown-box").fadeOut("slow",function(){$(this).remove();});
     $("body").eq(0).css("overflow","auto");
 }
 
 //保存图片
 function update_img()
 {
     var new_img = $("#flashimg").attr("src");//http://www.xxx.com/afdsfds.jpg?1231231231213
     var img_url = new_img.slice("<?php echo strlen(url('')); ?>", '-14');//去掉结尾的?xxx
     if(img_url=='')
     {
         alert('请上传图片');
         return false;
     }
     delete_image();

     $("#<?php echo $input; ?>").val(img_url);
     $("#<?php echo $input; ?>_changeTag").val(1);
     update_parent_thumb(img_url);
     close_popup_image();
 }

 //裁切保存图片
 function save_img()
 {
     //裁切的左上角坐标及宽高
     var selectorX = $("#selectorX").val();
     var selectorY = $("#selectorY").val();
     var selectorW = $("#selectorW").val();
     var selectorH = $("#selectorH").val();

     var imgpath = $("#flashimg").attr('src');//图片路径
     var del_path = $('#<?php echo $input; ?>').val();

     if ((selectorW == 0) || (selectorH == 0))
     {
         if(!confirm('没有选区，图片保存将不被裁切，确定保存！')){
             return false;
         }
     }

     $.ajax({
    	 headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         cache : false,
         type : 'post',
         url : "{{ url('admincp/ajaxupload/save_image') }}",
         data : "selectorX="+selectorX+"&selectorY="+selectorY+"&selectorW="+selectorW+"&selectorH="+selectorH+"&imageSource="+imgpath+"&del_path="+del_path,
         dataType :"text",
         success : function(callback){
             if(callback == 1)
             {
                 delete_image();
             }
             var img_url = imgpath.slice("<?php echo strlen(url('')); ?>", '-14');
             $('#<?php echo $input; ?>').val(img_url);
             $("#<?php echo $input; ?>_changeTag").val(1);
             update_parent_thumb(img_url);
             close_popup_image();
         }
     });
 }

 //父级页面显示上传的图片
 function update_parent_thumb(img_url)
 {
	 $("#<?php echo $input; ?>_view").attr("src","<?php echo url('');?>"+img_url);
     $("#<?php echo $input; ?>_delete").show();
 }

 //关闭
 function delete_img()
 {
    $.ajax({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      cache : false,
      type : 'post',
      url : "{{ url('admincp/ajaxupload/delete_image') }}",
      data : "imageSource=" + $("#flashimg").attr('src'),
      success: function (data){
          if ($('#zoom_img_path').val() == '')
          {
              close_popup_image();
          } else {
              $.ajax({
            	  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  cache : false,
                  type : 'post',
                  url : "{{ url('admincp/ajaxcommon/delete_image') }}",
                  data : "imageSource=" + '<?php echo url(''); ?>' + $("#primitive_img_path").val() + "?" + Date.parse(new Date()),
                  success: function (data){
                      close_popup_image();
                  }
              });
          }
      }
    });
 }

 //ajax加载loading
 function loading()
 {
     $("#loading").ajaxStart(function(){
         $(this).show();
     }).ajaxComplete(function(){
         $(this).hide();
     });
 }

//更新选择框
 function updata_select(id)
 {
     var proportion = $('#proportion').val();//图像缩放比例
     var id_val = parseInt($("#"+id).val());

     if (id == 'selectorW')
     {
         var iwidth = Math.round($("#flashimg").width() * proportion);//图片的真实宽度
         var selectorX = Math.round($('#selectorX').val() * proportion);//选取框真实上边距
         if (id_val > iwidth)//填写值超出图片宽度
         {
             $('#selectorX').val('0');//左边距设为0
             $('#selectorW').val(iwidth);//宽度设为真实宽度
         } else if ((id_val + selectorX) > iwidth){//
             $('#selectorX').val(Math.round((iwidth - id_val) / proportion));
         }
     }

     if (id == 'selectorH')
     {
         var iheight = Math.round($("#flashimg").height() * proportion);//图片的真实高度
         var selectorY = Math.round($('#selectorY').val() * proportion);//选取框真实左边距
         if (id_val > iheight)
         {
             $('#selectorY').val('0');
             $('#selectorH').val(iheight);
         } else if ((id_val + selectorY) > iheight){
             $('#selectorY').val(Math.round((iheight - id_val) / proportion));
         }
     }

     var x1 = Math.round(parseInt($('#selectorX').val() / proportion));
     var y1 = Math.round(parseInt($('#selectorY').val() / proportion));
     var width_add = Math.round(parseInt($('#selectorW').val() / proportion));
     var height_add = Math.round(parseInt($('#selectorH').val() / proportion));
     var x2 = x1 + width_add;
     var y2 = y1 + height_add;

     var ias = $('#flashimg').imgAreaSelect({ instance: true});
     ias.cancelSelection();
     ias.setSelection(x1, y1, x2, y2, true);
     ias.setOptions({ show: true });
 }
 
 //缩放尺寸输入框
 function updata_zoom(id)
 {
     var width = parseInt($('#primitive_width').val());//原图宽
     var height = parseInt($('#primitive_height').val());//原图高
     var id_val = parseInt($("#"+id).val());
     if (id == 'zoomW')
     {
         if (id_val > width)//填写值超出原图宽度
         {
             $('#zoomW').val(width);
             $('#zoomH').val(height);
         } else {
             if(!isNaN(id_val))
                $('#zoomH').val(Math.round(height / width * id_val));
             else
                 $('#zoomH').val('');
         }
     }

     if (id == 'zoomH')
     {
         if (id_val > height)
         {
             $('#zoomW').val(width);
             $('#zoomH').val(height);
         } else {
         if(!isNaN(id_val))
             $('#zoomW').val(Math.round(width / height * id_val));
         else
             $('#zoomW').val('');
         }
     }
 }

//还原图片
 function update_zoomimg_primitive()
 {
     $('#flashimg').imgAreaSelect({hide:true});

     var width = parseInt($('#primitive_width').val());
     var height = parseInt($('#primitive_height').val());
     var src = $('#primitive_img_path').val();

     $('#zoomW').val(width);
     $('#zoomH').val(height);

     if ($('#zoom_img_path').val() == '') return false;
     
     $.ajax({
    	 headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         cache : false,
         type : 'post',
         url : "{{ url('admincp/ajaxupload/delete_image') }}",
         data : {"imageSource=" : $("#flashimg").attr('src')},
         success: function (data){
             var proportion;

             if ((width < 500) && (height < 500))
             {
                 proportion = 1;
             } else if (width > height) {
                 proportion = width / 500;
                 height = Math.round(height / proportion);
                 width = 500;
             } else if (width < height) {
                 proportion = height / 500;
                 width = Math.round(width / proportion);
                 height = 500;
             } else {
                 proportion = width / 500;
                 width = 500;
                 height = 500;
             }

             empty_img();//清空裁切用参数


             $('#flashimg').attr("src", '<?php echo url(''); ?>' + src + "?" + Date.parse(new Date()) );//图片路径
             $('#flashimg').attr("width", width);//图片宽
             $('#flashimg').attr("height", height);//图片高
             $('#flashimg').show();//显示图片

             $('#proportion').val(proportion);//缩放比例
             $('#zoom_img_path').val('');
             $('#primitive_button').hide();//还原按钮隐藏

             $('#flashimg').imgAreaSelect({hide:false, movable:true});
             $('#flashimg').imgAreaSelect({
                 onSelectEnd: function (img, selection)
                 {
                     var x1 = Math.round(selection.x1 * proportion);
                     var y1 = Math.round(selection.y1 * proportion);
                     var x2 = Math.round(selection.x2 * proportion);
                     var y2 = Math.round(selection.y2 * proportion);
                     $('#selectorX').val(x1);
                     $('#selectorY').val(y1);
                     $('#selectorW').val(x2 - x1);
                     $('#selectorH').val(y2 - y1);
                 }
             });
         }
     });
 }

//缩放图片
 function update_zoomimg_zoom()
 {
     $('#flashimg').imgAreaSelect({hide:true});
     //loading();
     var width = $('#zoomW').val();
     var height = $('#zoomH').val();
     var src = $('#primitive_img_path').val();

     $.ajax({
    	headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
     	cache : false,
        type : 'post',
        url : "{{ url('admincp/ajaxupload/zoom_image') }}",
        data : {
         	"width":width,
         	"height":height,
         	"src":src
        },
        dataType: 'json',
        success: function (data)
        {
        	empty_img();//清空裁切用参数
            $('#proportion').val(data.proportion);//缩放比例
            $('#zoom_img_path').val(data.path);

            $('#flashimg').attr("src", '<?php echo url(''); ?>' + data.path + "?" + Date.parse(new Date()) );//图片路径
            $('#flashimg').attr("width", data.width);//图片宽
            $('#flashimg').attr("height", data.height);//图片高
            $('#flashimg').show();//显示图片
            $('#primitive_button').show();//还原按钮显示
            $('.btn_scale').show().css('margin-left',59);

            $('#flashimg').imgAreaSelect({hide:false, movable:true});
            $('#flashimg').imgAreaSelect
            ({
            	onSelectEnd: function (img, selection)
                {
                     var x1 = Math.round(selection.x1 * data.proportion);
                     var y1 = Math.round(selection.y1 * data.proportion);
                     var x2 = Math.round(selection.x2 * data.proportion);
                     var y2 = Math.round(selection.y2 * data.proportion);
                     $('#selectorX').val(x1);
                     $('#selectorY').val(y1);
                     $('#selectorW').val(x2 - x1);
                     $('#selectorH').val(y2 - y1);
                }
            });
       }
    });
 }

//清空裁切用参数
 function empty_img()
 {
     $('#selectorX').val(0);
     $('#selectorY').val(0);
     $('#selectorW').val(0);
     $('#selectorH').val(0);
 }

 //删除原始图片，如有缩放图时删除上传原图
 function delete_image()
 {
     var img_path = '<?php echo url(''); ?>' + $("#<?php echo $input; ?>").val();//获取页面打开是已存在的图片

     //删除图片
     $.ajax({
    	 headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         cache : false,
         type : 'post',
         url : "{{ url('admincp/ajaxupload/delete_image') }}",
         data : "imageSource=" + img_path + "?" + Date.parse(new Date())
     });

     if ($('#zoom_img_path').val() != '')
     {
         $.ajax({
        	 headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             cache : false,
             type : 'post',
             url : "{{ url('admincp/ajaxupload/delete_image') }}",
             data : "imageSource=" + '<?php echo url(''); ?>' + $("#primitive_img_path").val() + "?" + Date.parse(new Date())
         });
     }
 }
</script>
