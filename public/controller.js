var Controller = function(){
	var self = this;
	this.model = new Model();
	this.view = new View();

	this.cmsListAction = function(){
		self.model.get('meta-cms/', function(data){
			self.view.cmsListRender(data);
			initMainPagination();
		});
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
		// self.model.get('', function(data){
		// 	self.view.cmsListInSelectRender(data);
		// });

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

	this.pageAction = function(page){
		self.view.removeFixesRendering();
		if(typeof self[page + 'Action'] != 'undefined'){
			self[page + 'Action']();
		}
		self.view.pageRender(page);
	}
}