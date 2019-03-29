var imgs = document.getElementsByClassName("cls_zoom_image");
var lens = imgs.length;
var popup = document.getElementById("zoom_image_popup");
popup.onclick = function (){
    popup.style.display = "none";
}

function showBig(src){
    popup.getElementsByTagName("img")[0].src = src;
    popup.style.height = ''+$(document).height()+'px';
    popup.style.display = "block";
}


	for(var i = 0; i < lens; i++){
	    imgs[i].onclick = function (event){
	        event = event||window.event;
	        var target = document.elementFromPoint(event.clientX, event.clientY);
	        showBig(target.src);
	    }
	}	





