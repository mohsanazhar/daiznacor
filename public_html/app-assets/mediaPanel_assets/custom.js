
var track_page = 1;
var load_data = true;
var ajaxReq = baseURL+"ajaxrequest";
function sendData(url,obj){
    var smVaribale;
    $.ajax({
        "async":false,
        "type" : "POST",
        "global" : false,
        "dataType" : "html",
        "url":url,
        "data" : obj,
        "success" : function(data){
            smVaribale=data;
        }
    });
    return smVaribale;
}
$(document).ready(function(){
	var multiple = false;
	window.type = "";
	window.return = "";
	window.for = "";
	window.media = "";
	window.up = "";
  // Image Insertion in Editor

	
	function formatBytes(bytes,decimals) {			// Get Size of Media
	   if(bytes == 0) return '0 Bytes';
	   var k = 1000,
		   dm = decimals + 1 || 3,
		   sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
		   i = Math.floor(Math.log(bytes) / Math.log(k));
	   return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
	}
	
	$(".mediaPanel .m-left ul li").click(function(){				// For active menu list
		$(".mediaPanel .m-left ul li").removeClass("active");
		$(this).addClass("active");	
		var f  = $(this).attr("data-for");
		$(".m-box").css("display", "none");
		$("."+f).css("display", "block");
	});
	
	$(document).on("click",".mediaPanel .m-insert ul.file-list li",function(){	// For active media
		$(".mediaPanel .m-insert ul.file-list li").removeClass("active");
		$(this).addClass("active");
		
	});
	$(document).on("click",".m-ins-image",function(){								// For Media Information
		var src, file, size, demension, date, type, name, id;
		src = $(this).attr("src");
		file = $(this).attr("data-file");
		name = $(this).attr("data-name");
		size = $(this).attr("data-size");
		id = $(this).attr("data-id");
		demension = $(this).attr("data-dimension");
		date = $(this).attr("data-date");
		type = $(this).attr("data-type");
		var d = new Date(date * 1000);
		var dateString = d.toDateString();
		$(".f-info .img").html("<img src='"+src+"' style='max-height:120px; max-width:120px;' data-id='"+id+"' alt='Image'>");
		$(".f-info .title").html(name);
		$("input[name='img-title']").val(name);
		$("input[name='img-alt']").val(name);
		$(".f-info .date").html(dateString);
		$(".f-info .size").html(formatBytes(size));
		$(".f-info .dimension").html(demension);
		$(".f-info").css("display", "block");
	});
    $(document).on("click",".m-ins-pdf",function(){								// For Media Information
        var src, file, size, demension, date, type, name, id;
        src = $(this).attr("src");
        file = $(this).attr("data-file");
        name = $(this).attr("data-name");
        size = $(this).attr("data-size");
        id = $(this).attr("data-id");
        demension = $(this).attr("data-dimension");
        date = $(this).attr("data-date");
        type = $(this).attr("data-type");
        var d = new Date(date * 1000);
        var dateString = d.toDateString();
        $(".f-info .img").html("<img src='"+src+"' style='max-height:120px; max-width:120px;' data-id='"+id+"' alt='Image'>");
        $(".f-info .title").html(name);
        $("input[name='img-title']").val(name);
        $("input[name='img-alt']").val(name);
        $(".f-info .date").html(dateString);
        $(".f-info .size").html(formatBytes(size));
        $(".f-info .dimension").html(demension);
        $(".f-info").css("display", "block");
    });
	
	$(".close-m-panel").click(function(){					// Close and Refresh Media Panel
		close_media_panel();
	});
	
	function close_media_panel(){
		$(".mediaPanel .m-insert ul.file-list li").removeClass("active");
		$(".media-wrapper").css("display", "none");
		$(".mediaPanel").css("display", "none");
		$(".f-info").css("display", "none");	
	}
	
	
	$("#mediaUpload").change(function(){
		var v = $(this).val();
		var validExts = new Array(".png",".jpg",".jpeg",".pdf");
		var fileExt = v;
		fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
		fileExt = fileExt.toLowerCase();
		if (validExts.indexOf(fileExt) < 0) {
		  alert("Invalid file selected, valid files are of " +
				   validExts.toString() + " types.");
			$(this).val("");
		  return false;
		}else{
			upload_u_file();
			$(".m-box").css("display", "none");
			$(".m-insert").css("display", "block");
			$(".mediaPanel .m-left ul li").removeClass("active");
			$(".mediaPanel .m-left ul li[data-for='m-insert']").addClass("active");
		}
			
	});

	

	$(document).on("click", ".insert-media", function(){			// Open Media Panel
		var type, rt, fr;
		type = $(this).attr("data-type");
		rt = $(this).attr("data-return");
		fr = $(this).attr("data-for");
		window.type = type;
		window.return = rt;
		window.for = fr;
		window.link = $(this).attr("data-link");
		window.file = $(this).attr("data-file");
		$(".media-wrapper").css("display", "block");
		$(".mediaPanel").css("display", "block");
	});
	
	$(document).on("click", ".insert-m-to", function(){				// Return Media to specified position
		var elm = $(".mediaPanel .m-insert ul.file-list li.active img");
		window.media = elm.attr("data-file");
		if (window.for=="link"){
			date_for_link();
		}else if(window.for=="display"){
			data_for_display();
		}else if(window.for=="editor"){
			data_for_editor();	
		}
	});
	
	function date_for_link(){
		if (window.type=="image"){
			var link = window.media;
			if (window.return!="" && window.return!="undefined"){
				var target = $(window.return).get(0).tagName;
				if (target=="INPUT" || target=="input"){
					$(window.return).val(link);
				}else{
					$(window.return).html(link);	
				}
			}
		}
		close_media_panel();
	}
	
	function data_for_display(){
		if (window.type=="image"){
			var link = window.media;
			var img_title = $(".f-info .alt-form input[name='img-title']").val();
			var img_alt = $(".f-info .alt-form input[name='img-alt']").val();
			var tl = (img_title=="") ? "" : "title='"+img_title+"'";
			var al = (img_title=="") ? "" : "alt='"+img_alt+"'";
			if (window.return!="" && window.return!="undefined"){
				var target = $(window.return).get(0).tagName;
				if (target!="INPUT" || target!="input"){
					var img = "<img src='"+link+"' "+ tl +" "+ al +">";
					if (window.link!="undefined" || window.link!=""){
						$("input[name='"+window.link+"']").val(link);	
					}
					$(window.return).html(img);
					 $(".f-info .alt-form input[name='img-title']").val("");
					 $(".f-info .alt-form input[name='img-alt']").val("");
				}
			}
		}
		close_media_panel();	
	}
	
	function data_for_editor(){
		if (window.type=="image"){
			var link = window.media;
			var img_title = $(".f-info .alt-form input[name='img-title']").val();
			var img_alt = $(".f-info .alt-form input[name='img-alt']").val();
			var tl = (img_title=="") ? "" : "title='"+img_title+"'";
			var al = (img_title=="") ? "" : "alt='"+img_alt+"'";
			
			if (window.return!="" && window.return!="undefined"){
				var target = $(window.return).get(0).tagName;
				var img = "<img src='"+link+"' "+ tl +" "+ al +">";
				window.return = window.return.replace("#","");
				tinyMCE.get(window.return).execCommand("mceInsertContent",false,img);
				$(".f-info .alt-form input[name='img-title']").val("");
				$(".f-info .alt-form input[name='img-alt']").val("");
			}
		}
		close_media_panel();
	}
	
	$(".v-submit").click(function(){
		var url = $("input[name='url']").val();
		var source = $("select[name='source']").val();
		var embed = $("input[name='embed']").val();
		var data = "source="+source+"&embed="+embed;
		var v = sendData(url,data);
		window.return = window.return.replace("#","");
		tinyMCE.get(window.return).execCommand("mceInsertContent",false,v);
		$("input[name='embed']").val("");
		close_media_panel();
	});
	
	// Delete Image;
	$(".del-fu").click(function(){
		var f = $(".f-info .img img").attr("data-id");
		var data = "action=_medialPanel&method=_delMedia&t="+f+"&_token="+token;
		var r = confirm("Do you want to delete file?");
		if (r==true){
			var j = sendData(ajaxReq,data);
			$(".f-info .img").html("");
			$(".f-info .title").html("");
			$(".f-info .date").html("");
			$(".f-info .size").html("");
			$(".f-info .dimension").html("");
			$(".file-list li.active").remove();
			$(".f-info").css("display", "none");
		}
	});
	
	// Create Folder
	$(document).on('click','.v-submit-f',function(){
		var f = $(".f-gal").val();
        var parent=$('.parent_name').val();
		var inp = $(this).attr("data-input");
		if (f==""){
			//alert(ajaxReq);
			alert("Please enter folder name!");	
		}else{
			var data = "action=_medialPanel&method=_createFolder&t="+f+"&s="+inp+"&parent="+parent+"&_token="+token;
			var j = sendData(ajaxReq, data);
			//alert(j);
			$(".f-gal").val("");
			$(".folder-g").html(j);
			
			data = "action=_medialPanel&method=_getFolders&_token="+token;
			j = sendData(ajaxReq, data);
            $("select[name='parent_folder']").html(j);
			$("select[name='folder']").html(j);
			$(this).attr("data-input", "new");
		}
	});
	
	// Delete Folder
	$(document).on("click", ".del-folder",function(){
		var t = $(this).attr("data-title");
		if (window.confirm("Do you want to delete folder?")){
			$(this).parent().parent().remove();	
			var data = "action=_medialPanel&method=_delFolder&t="+t;
			sendData(ajaxReq, data);
			
			data = "action=_medialPanel&method=_getFolders&_token="+token;
			j = sendData(ajaxReq, data);
                        $("select[name='parent_folder']").html(j);
			$("select[name='folder']").html(j);
		}
	});
	
	// Edit Folder
	$(document).on("click", ".edit-folder", function(){
		var t = $(this).attr("data-title");
                var p=$(this).attr("data-parent");
		$(".f-gal").val(t);
                $('select>option[value="'+p+'"]').prop('selected', true);
		$(".v-submit-f").attr("data-input", t);
                $(".v-submit-f").attr("data-parent",p);
	});
	
	$(".image-from-folder").change(function(){
		var v = $(this).val();
		var url = $("input[name='ajaxurl']").val()+"get_insert_images.php";
		var data = "action=_medialPanel&method=_get_images&f="+v+"&page=1&_token="+token;
		var  j =sendData(ajaxReq, data);
		if(j == "No More Image"){
			j = "<div class='alert alert-info'>No More Images</div>";
		}
		$(".mediaPanel .m-box .ins-left .inner .file-list").html(j);
		track_page = 1;
		load_data = true;
	});
	
	$(".m-box .ins-left .inner").scroll(function(){
		if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
			if (load_data==true){
				track_page++
				$(".mediaPanel .m-box .ins-left .inner").addClass("load-data");
				var folder = $(".image-from-folder").val();
				var obj =  "action=_medialPanel&method=_get_images&f="+folder+"&page="+track_page+"&_token="+token;
				var data = sendData(ajaxReq, obj);
				loading = true; 
				if(data == "No More Image"){
					load_data = false;
					data = "<div class='alert alert-info'>No More Images</div>";
				}
				$(".mediaPanel .m-box .ins-left .inner").removeClass("load-data");
				$(".mediaPanel .m-box .ins-left .inner .file-list").append(data);
        
			}
		}
	});

});