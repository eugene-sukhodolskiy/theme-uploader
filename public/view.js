var View = function(){
	var self = this;

	this.cmsListRender = function(data){
		var html = '';
		for(var i=0; i<data.length; i++){
			html += '<li><a href="' + data[i]['id'] + '" class="item" data-page="themeList"><span class="count">';
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
			if(typeof data[i]['id'] != 'undefined'){
				html += '<option value="' + data[i]['id'] + '">' + data[i]['meta_value'] + '</option>';
			}else{
				html += '<option value="' + data[i]['meta_value'] + '">' + data[i]['meta_value'] + '</option>';
			}
		}

		// console.log($(container).attr('multiple'));
		// if($(container).attr('multiple') == 'multiple'){
		// 	$(container).prepend('<option value="defalut" disabled selected>Choose your option</option>');
		// }
		$(container).material_select('destroy');
		$(container).html(html);
		$(container).material_select();
	}

	this.templateListRender = function(data){
		console.log(data);
		
		// clear container
		$('#themeList .cards-container > div').each(function(i){
			if(!$(this).hasClass('card-for-clone')){
				$(this).remove();
			}
		});

		$('.card-for-clone').css('display', 'none');
		for(var i=0;i<data['templates'].length;i++){
			if(data['thumbs'][i] == null){
				data['thumbs'][i] = {'src': 'http://lorempixel.com/300/200'};
			}
			$('.card-for-clone').clone().appendTo('#themeList .cards-container');
			var card = $('#themeList .cards-container .card:last');
			$(card).find('.card-image img').attr('src', data['thumbs'][i]['src']);
			$(card).find('.c-title').html(data['templates'][i]['name']);
			$(card).find('.description').html(data['templates'][i]['description']);
			$(card).find('a.link-on-demo').attr('href', data['templates'][i]['link_on_demo']);
			$(card).find('a.upldate-template-btn').attr('href', '#' + data['templates'][i]['id']);
			$(card).parent().removeAttr('style');
			$(card).parent().removeClass('card-for-clone');
		}

	}

	this.totalCountCms = function(count){
		$('#themeList .total span').html(count);
	}
}