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
		self.model.get('', function(data){
			self.view.cmsListInSelectRender(data);
		});

		self.listingOnSelect('meta-cms/', '.cms-list-select');
		self.listingOnSelect('meta-browser/', '.resolution');
		self.listingOnSelect('db/browser-list.json', '.compatible-browsers');
		self.listingOnSelect('db/compatible-with.json', '.compatible-with');

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