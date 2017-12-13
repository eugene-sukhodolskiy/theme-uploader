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

	this.send = function(data, callback, fail){
		$.ajax({

		  method: "POST",
		  url: "upload-template/",
		  data: JSON.stringify(data)

		}).done(function() {
		    callback();
		}).fail(function(){
			fail();
		});
	}


}