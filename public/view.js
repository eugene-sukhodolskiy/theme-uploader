var View = function(){
	var self = this;

	this.cmsListRender = function(data){
		var html = '';
		for(var i=0; i<data.length; i++){
			html += '<li><a href="#" class="item" data-page="theme-list"><span class="count">';
			html += data[i]['count'] + '</span>' + data[i]['meta_value'] + '</a></li>';	
		}

		$('.cms-list').html(html);
	}

	this.fixAddMetaPageRender = function(){
		$('body').css('margin-top', '-22px');
	}

	this.removeFixesRendering = function(){
		$('body').removeAttr('style');
	}

	this.pageRender = function(page){
		$('.page').css('display', 'none');
		$('#' + page).css('display', 'block');
	}

	this.listingOnSelectRender = function(data, container){
		var html = '';
		for(var i=0; i<data.length; i++){
			html += '<option value="' + data[i]['id'] + '">' + data[i]['meta_value'] + '</option>';
		}

		$(container).material_select('destroy');
		$(container).html(html);
		$(container).material_select();
	}
}