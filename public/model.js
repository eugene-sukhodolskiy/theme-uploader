var Model = function(){
	var self = this;
	this.cache = {};

	this.get = function(url, callback, cacheflag){
		if(typeof self.cache[url] == 'undefined' || cacheflag == false){			
			$.getJSON(url, function(d){
				self.cache[url] = d;
				callback(d);
			}, function(err){
				// try again
				self.get(url, callback, false);
				console.log(err, 'Trying again');
			});
		}else{
			callback(self.cache[url]);
		}
	}

	this.send = function(data, callback, fail){

		console.log(data);
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

	this.collectDataForSending = function(){
		
		var data = {
			"cms": $('[name="cms"]').prop('value'),
			"template_name": $('[name="template_name"]').prop('value'),
			"description": $('[name="description"]').prop('value'),
			"keywords": self.getInputKeywords('.keywords-container'),//$('[name="keywords"]').attr('data-keywords-value').split(';'),
			"resolution": getMultipleSelectValue('[name="resolution"]'),
			"compatible-browsers": getMultipleSelectValue('[name="compatible-browsers"]'),
			"compatible-with": getMultipleSelectValue('[name="compatible-with"]'),
			"software": getMultipleSelectValue('[name="software"]'),
			"file_type": getMultipleSelectValue('[name="file_type"]'),
			"column": getMultipleSelectValue('[name="column"]')[0],
			"layout": getMultipleSelectValue('[name="layout"]')[0],
			"thumbnails": THUMBNAILS,
			"zip": ZIP,
			"link_on_demo": $('#link_on_demo').val()
		}

		return data;
	}

	this.getInputKeywords = function(container){
		var chips = $(container).find('.chip');
		var ret = [];

		for(var i=0; i<chips.length; i++){
			ret.push(chips[i].innerHTML.split('<i')[0]);
		}

		return ret;
	}


}