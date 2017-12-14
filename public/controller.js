var Controller = function(){
	var self = this;
	this.model = new Model();
	this.view = new View();
	this.mouseCoords = {x: 0, y: 0};

	this.cmsListAction = function(){
		self.model.get('meta-cms/', function(data){
			self.view.cmsListRender(data);
			initMainPagination();
			//console.log($('.main-nav .cms-list a:eq(0)'));
			setTimeout(function(){
				$('.main-nav .cms-list a:eq(0)').click();
			},200);
		}, false);
	}

	this.uploadThemeAction = function(){
		$(document).mousemove(function( event ) {
		  self.mouseCoords.x = event.pageX;
		  self.mouseCoords.y = event.pageY;
		})

		$('.file-select-clicker').click(function(){
			$('.drag-and-upload .file-field').click();
		});

		$('.drag-and-upload .file-field').change(function(e){
			var files = $(this).prop('files');
			for(var i=0; i<files.length; i++){
				loadImgAndZipFile(files[i]);
			}
			return false;
		});

		$('.drag-and-upload').on('dragover', function(){
			$(this).addClass('hover');
			return false;
		});

		$('.drag-and-upload').on('dragleave', function(){
			$(this).removeClass('hover');
			return false;
		});

		$('.drag-and-upload').on('drop', function(e){
			e.preventDefault();
			$(this).removeClass('hover');
			var files = e.originalEvent.dataTransfer.files;
			for(var i=0; i<files.length; i++){
				loadImgAndZipFile(files[i]);
			}
			return false;
		});

		$('.uploadToServ').on('click', function(){
			self.sendDataToServ();
		});
	}

	this.templateListOnCms = function(cmsId){
		self.model.get('template-list/' + cmsId, function(data){
			self.view.templateListRender(data);
		}, false);
	}

	this.themeListAction = function(elem){
		var cmsId = $(elem).attr('href');
		self.view.totalCountCms($(elem).find('.count').html());
		self.templateListOnCms(cmsId);
	}

	this.addDragAndDropEventThumbnail = function(thumb){
		
	}

	this.listingOnSelect = function(url, container){
		self.model.get(url, function(data){
			self.view.listingOnSelectRender(data, container);
		});
	}

	/**
	 * [addMetaAction for constroll processes after render page]
	 */
	this.addMetaAction = function(){

		self.listingOnSelect('meta-cms/', '.cms-list-select');
		$('.cms-list-select').bind('change', function(){
			self.listingOnSelect('meta-tech/' + getSelectedCms(), '.compatible-with');
			self.listingOnSelect('meta-compatible/' + getSelectedCms(), '.software');
		});
		self.listingOnSelect('meta-resolution/', '.resolution');
		self.listingOnSelect('meta-browser/', '.compatible-browsers');
		self.listingOnSelect('meta-file-type/', '.file-type');
		self.listingOnSelect('meta-columns/', '.column-count');
		self.listingOnSelect('meta-layout/', '.layout-type');

		self.listingOnSelect('meta-tech/' + getSelectedCms(), '.compatible-with');
		self.listingOnSelect('meta-compatible/' + getSelectedCms(), '.software');

		self.view.fixAddMetaPageRender();
	}

	this.pageAction = function(page, elem){
		self.view.removeFixesRendering();
		if(typeof self[page + 'Action'] != 'undefined'){
			self[page + 'Action'](elem);
		}
		self.view.pageRender(page);
		//scroll to top;
	}

	this.sendDataToServ = function(){
		self.model.send(self.collectDataForSending(), function(){
			//alert('Well done');
			console.log('Well done');
			//self.cmsListAction();
			document.location.reload();
		}, function(){
			alert('Error sending');
		});
	}

	this.collectDataForSending = function(){
		
		var data = {
			"cms": $('[name="cms"]').prop('value'),
			"template_name": $('[name="template_name"]').prop('value'),
			"description": $('[name="description"]').prop('value'),
			"keywords": $('[name="keywords"]').attr('data-keywords-value').split(';'),
			"resolution": getMultipleSelectValue('[name="resolution"]'),
			"compatible-browsers": getMultipleSelectValue('[name="compatible-browsers"]'),
			"compatible-with": getMultipleSelectValue('[name="compatible-with"]'),
			"software": getMultipleSelectValue('[name="software"]'),
			"file_type": getMultipleSelectValue('[name="file_type"]'),
			"column": getMultipleSelectValue('[name="column"]')[0],
			"layout": getMultipleSelectValue('[name="layout"]')[0],
			"thumbnails": THUMBNAILS,
			"zip": ZIP
		}

		return data;
	}
}