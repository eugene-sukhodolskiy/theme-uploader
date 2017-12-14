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

		// $.ajaxSetup({
		//     headers: {
		//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		//         'X-XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		//         'X-Requested-With': 'XMLHttpRequest'
		//     }
		// });
		$.ajax({

		  method: "PATCH",
		  url: "upload-template/",
		  dataType: 'json',
		  data: {'data' : JSON.stringify(data), '_token' : TOKEN}

		}).done(function(msg) {
			console.log(msg);
		    callback();
		}).fail(function(msg){
			console.log(msg);
			fail();
		});
	}


}