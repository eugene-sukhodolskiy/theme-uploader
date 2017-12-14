var controller = new Controller();
var ZIP; // theme file
var THUMBNAILS = [];

$(document).ready(function() {

    $('select').material_select();

    keywords();

    controller.cmsListAction();

});

var getSelectedCms = function(){
	return $('select[name="cms"] option[value="' + $('select[name="cms"]').prop('value') + '"]').html();
}

var keywords = function(){
	$('[data-keywords-container]').keydown(function(e){
		if(e.keyCode == 13){
			var val = $(this).prop('value');
			var oldVal = $(this).attr('data-keywords-value');
			oldVal = (oldVal == '') ? oldVal : oldVal + ';';
			$(this).attr('data-keywords-value', oldVal + val);

			var html = '<div class="keyword-item" ';
			html += 'data-keyword-item-value="' + val + '">';
			html += val + '<i class="material-icons">clear</i>';
			html += '</div>';
			var cont = $(this).attr('data-keywords-container');
			$(cont).append(html);
			$(this).prop('value', '').attr('value', '');

			$(cont).find('i.material-icons').parent().unbind('click');

			// remove keyword
			$(cont).find('i.material-icons').parent().bind('click', function(){
				var val = $(this).attr('data-keyword-item-value');
				var field = $(this).parent().attr('data-keywords-field');
				var keywords = $(field).attr('data-keywords-value');
				keywords = keywords.split(';');
				for(var i=0;i<keywords.length;i++){
					if(keywords[i] == val){
						keywords.splice(i, 1);
					}
				}

				keywords = keywords.join(';');
				$(field).attr('data-keywords-value', keywords);

				$(this).remove(); // remove from DOM
			});
		}
	});
}

var initMainPagination = function(){
	 // init paging
    $('[data-page]').click(function(){
    	controller.pageAction($(this).attr('data-page'), this);
    	return false;
    });
}

var loadImgAndZipFile = function(file){
	var filename = file.name.split('.');
	var format = filename[filename.length - 1];
	if(format == 'zip' || format == 'ZIP'){
		//console.log(file);
		// Adding to theme file list
		var reader = new FileReader();
		reader.onload = function(e){
			var dataUri = e.target.result;
			console.log(file.name);
			$('.zip-title').html(file.name);
			$('.zip-icon .material-icons').css('display', 'inline-block');
			$('.send-and-upload').css('display', 'inline-block');
			ZIP = dataUri;
		}
		reader.readAsDataURL(file);

	}else if(format == 'png' || format == 'PNG' || format == 'jpg' || format == 'JPG' || format == 'jpeg' || format == 'JPEG'){
		//console.log(file);
		// Adding to thumbnail list
		var reader = new FileReader();
		reader.onload = function(e){
			var dataUri = e.target.result;
			var img = new Image();
			img.src = dataUri;
			img.onload = function(){
				$('.thumbnail-container').append('<div class="thumb-wrap"></div>');
				var lastWrap = $('.thumbnail-container .thumb-wrap:last-of-type');
				$(lastWrap).append('<i class="material-icons remove-uploaded-img">clear</i>');
				$(lastWrap).append(img);
				$(lastWrap).find('.remove-uploaded-img').click(function(){
					$(this).parent().addClass('rem-flag');
					$('.thumbnail-container .thumb-wrap').each(function(inx){
						if($(this).hasClass('rem-flag')){
							THUMBNAILS.splice(inx, 1);
						}
					});
					$(this).parent().remove();
				});
				controller.addDragAndDropEventThumbnail(lastWrap);
			}
			$(img).addClass('thumbnail-item');
			$(img).attr('data-filename', file.name);
			var countThumbs = $('.thumbnail-container .thumbnail-item').length;
			$(img).attr('data-index', countThumbs);
			THUMBNAILS.push(dataUri);
		}
		reader.onerror = function(e) {
		    console.error("Файл не может быть прочитан! код " + e.target.error.code);
		};

		reader.readAsDataURL(file);
		
	}else{
		console.log('That file not zip');
	}
}

var getMultipleSelectValue = function(select){
	var materialSelect = $('#' + 'select-options-' + $(select).attr('data-select-id'));
	var materialItems = $(materialSelect).find('li');
	var selectItems = $(select).find('option');
	var res = [];
	for(var i=0;i<materialItems.length;i++){
		if($(materialItems[i]).hasClass('active')){
			res.push($(selectItems[i]).attr('value'));
		}
	}

	return res.length ? res : false;
}