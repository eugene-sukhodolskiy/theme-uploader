var controller = new Controller();

$(document).ready(function() {

    $('select').material_select();

    keywords();

    controller.cmsListAction();
    initMainPagination();

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
    	controller.pageAction($(this).attr('data-page'));
    	return false;
    });
}