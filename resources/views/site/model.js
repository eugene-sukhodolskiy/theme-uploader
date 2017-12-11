var Model = function(){
	var self = this;
	this.cache = {};

	this.get = function(url, callback, cacheflag){
		if(typeof self.cache[url] == 'undefined' || cacheflag == false){			
			$.getJSON(url, function(d){
				self.cache[url] = d;
				callback(d);
			});
		}else{
			callback(self.cache[url]);
		}
	}


}