var Controller = function(){
	var self = this;
	this.model = new Model();
	this.view = new View();
	this.mouseCoords = {x: 0, y: 0};
	this.currentThemeLink = '';
	this.currentCmsId;
	this.lastOrder = false;

	this.search = function(s){
		if(self.lastOrder){
			var url = self.currentCmsId + '/search/' + s;
		}else{
			var url = self.currentCmsId + '/search/' + s + '/order/' + self.lastOrder;
		}
		self.view.preloaderShow('#themeList');
		try{
			self.model.get(url, function(data){
				if(data.templates.length == 0){
					self.view.resultMessageShow("Any theme not found");
				}else{
					self.view.resultMessageHide();
				}
				self.view.templateListRender(data);
				self.view.preloaderHide('#themeList');
			});
		}catch(err){
			self.view.resultMessageShow("Any theme not found");
		}
	}

	this.searchInit = function(){
		$('[name="search"]').keydown(function(e){
			if(e.keyCode == 13){
				var val = $(this).val();
				if(val != ''){
					self.search(val);
				}
				$('.close-search').css('display', 'block');
			}

			if(e.keyCode == '27'){
				$(this).val('');
				self.templateListOnCms(self.currentCmsId);
			}
		});

		$('.close-search').click(function(){
			$(this).css('display', 'none');
			$('[name="search"]').val('');
			self.templateListOnCms(self.currentCmsId);
		});
	}

	this.setLastOrder = function(){
		var order = getCookie('order');
		if(typeof order != 'undefined'){
			self.lastOrder = order;
		}
	};

	this.themeLinkMonitor = function(){
		setInterval(function(){
			var link = document.location.hash;
			link = link.split('#themelink=')[1];
			if(typeof link == 'undefined'){
				// close demo window
				self.view.demoPageClose();
			}else if(link != self.currentThemeLink){
				self.currentThemeLink = link;
				// change data in demo window
				self.view.bigPreloaderShow();
				self.model.get('template/?link=' + link, function(d){
					self.view.bigPreloaderHide();
					self.view.demoPageRender(d);
					self.model.get('increment-visible-counter/?link=' + link, function(d){
						console.log(d);
					});
				});
			}
		}, 100);
	}

	this.initWindow = function(){
		self.setLastOrder();
		self.searchInit();
		self.initMobileView();
		self.themeLinkMonitor();
		self.formValidation();
		self.notificationInit();
		self.ordersInit();
	};

	self.ordersInit = function(){
		$('[data-order]').on('click', function(e){
			e.preventDefault();
			var order = $(this).attr('data-order');
			setCookie('order', order);
			self.lastOrder = order;
			self.view.activeOrderLink(order);

			self.themeListReloadWithOrder(order);
		});

		if(self.lastOrder){
			self.view.activeOrderLink(self.lastOrder);
		}
	}

	this.cmsListAction = function(){
		self.view.preloaderShow('.main-nav');
		self.model.get('meta-cms/', function(data){
			self.view.cmsListRender(data);
			self.view.preloaderHide('.main-nav');
			initMainPagination();
			//console.log($('.main-nav .cms-list a:eq(0)'));
			setTimeout(function(){
				$('.main-nav .cms-list a:eq(0)').click();
			},200);
		}, false);
	}

	this.uploadThemeAction = function(){
		self.view.fixAddMetaPageRender();
		if($('#uploadTheme').attr('data-load') == 'uploaded'){
			return false;
		}

		$('#uploadTheme').attr('data-load', 'uploaded');

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

	this.templateListOnCms = function(cmsId, order){
		self.view.preloaderShow('#themeList');
		var url = typeof order == 'undefined' ? 'template-list/' + cmsId : 'template-list/' + cmsId + '/' + order;
		self.model.get(url, function(data){
			if(data.templates.length == 0){
				self.view.resultMessageShow("Any theme not found");
			}else{
				self.view.resultMessageHide();
			}
			self.view.templateListRender(data);
			self.view.preloaderHide('#themeList');
		}, false);
	}

	this.themeListAction = function(elem){
		var cmsId = $(elem).attr('href');
		self.currentCmsId = cmsId;
		self.view.totalCountCms($(elem).find('.count').html());
		if(self.lastOrder){
			self.templateListOnCms(cmsId, self.lastOrder);
		}else{
			self.templateListOnCms(cmsId);
		}
	}

	this.themeListReloadWithOrder = function(order){
		self.view.closeMenu();
		self.templateListOnCms(self.currentCmsId, order);
	}

	this.listingOnSelect = function(url, container){
		self.model.get(url, function(data){
			self.view.listingOnSelectRender(data, container);
			setTimeout(function(){
				$('body').click();
			},100);
		});
	}

	/**
	 * [addMetaAction for constroll processes after render page]
	 */
	this.addMetaAction = function(){
		self.view.preloaderShow('#addMeta');
		$('.cms-list-select').parent().css('display', 'block');
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
		setTimeout(function(){
			self.view.preloaderHide('#addMeta');
		}, 2000);

		self.view.fixAddMetaPageRender();
	}

	this.loadMetaForUpdatePage = function(selectedCMS){
		console.log('selectedCMS', selectedCMS);
		self.view.preloaderShow('#addMeta');
		$('.cms-list-select').parent().css('display', 'none');
		self.listingOnSelect('meta-resolution/', '.resolution');
		self.listingOnSelect('meta-browser/', '.compatible-browsers');
		self.listingOnSelect('meta-file-type/', '.file-type');
		self.listingOnSelect('meta-columns/', '.column-count');
		self.listingOnSelect('meta-layout/', '.layout-type');

		self.listingOnSelect('meta-tech/' + selectedCMS, '.compatible-with');
		self.listingOnSelect('meta-compatible/' + selectedCMS, '.software');

		self.view.fixAddMetaPageRender();
	}

	this.initMobileView = function(){
		$('.open-menu').on('click', function(e){
	    	e.preventDefault();
	    	controller.view.openMenu();
	    });

	    $('.close-menu').on('click', function(e){
	    	e.preventDefault();
	    	controller.view.closeMenu();
	    });
	}

	this.pageAction = function(page, elem){
		self.view.closeMenu();
		self.view.removeFixesRendering();
		if(typeof self[page + 'Action'] != 'undefined'){
			self[page + 'Action'](elem);
		}
		self.view.pageRender(page);
		//scroll to top;
	}

	this.sendDataToServ = function(){
		self.view.beforeUploadTheme();
		self.model.send(self.model.collectDataForSending(), function(){
			document.location.reload();
		}, function(){
			self.view.afterUploadTheme('Sending was failed');
		});
	}

	this.formValidation = function(){
		var isNoEmpty = function(input, minlen){
			var val = $(input).val();
			if(val.length < minlen){
				return false;
			}else{
				return true;
			}
		}

		var OnChanged = function(){
			if(isNoEmpty(this, parseInt($(this).attr('data-minlen')))){
				$(this).removeClass('invalid').addClass('valid');
			}else{
				$(this).addClass('invalid').removeClass('valid');
				self.view.notificationOpen({'title': 'Error',
				 'msg': 'All fields must be no empty. Minimum ' + $(this).attr('data-minlen') + ' symbols in current field',
				  'type':'err'});

				var el = this;
				setTimeout(function(){
					self.view.notificationClose(function(){
						$(el).focus();
					});
				},4000);
			}

		}

		var checkInputOnReady = function(){
			var data = self.model.collectDataForSending();
			var selectarr = [
				'resolution',
				'compatible-browsers',
				'compatible-with',
				'software',
				'file_type',
				'column',
				'layout'
			];

			if(data.template_name.length > parseInt($('[name="template_name"]').attr('data-minlen'))){
				if(data.description.length > parseInt($('[name="description"]').attr('data-minlen'))){
					var counter = 0;
					// if(typeof selectarr.length == 'undefined') return false;
					for(var i=0; i<selectarr.length; i++){
						if(data[selectarr[i]].length){
							counter++;
						}
					}
					if(counter == selectarr.length){
						return true;
					}
				}
			}

			return false;

		}

		setInterval(function(){
			var check = checkInputOnReady();
			if(check){
				$('#addMeta button').removeClass('disabled');
			}else{
				if(!$('#addMeta button').hasClass('disabled')){
					$('#addMeta button').addClass('disabled');
				}
			}

			var lod = $('#link_on_demo');
			if(lod.val().length >= lod.attr('data-minlen') && check){

				self.checkLinkOnExists(lod.val(), function(){
					//is true
					self.isLinkOnDemoUniq(lod.val(), function(){
						self.view.validLinkOnDemo(); // isUniq
					}, function(){
						// isNotUniq
						self.view.notificationOpen({
							'title': 'Error',
							'type': 'err',
							'msg': 'This link already exists in the database'
						});
						self.view.invalidLinkOnDemo();
					});
				}, function(err){
					// is false
					console.log(err);
				});

			}
			
		}, 600);

		$('#template_name').on('change', OnChanged);
		$('#description').on('change', OnChanged);
	}

	this.isLinkOnDemoUniq = function(link, isTrue, isFalse){
		if(self.lastDemoOnLinkCheckOnUniq == link){
			return false;
		}
		self.lastDemoOnLinkCheckOnUniq = link;
		self.model.get('islinkondemouniq/?link=' + link, function(d){
			if(d != 0){
				isFalse();
			}else{
				isTrue();
			}
		});
	}

	this.initKeywords = function(){
		self.model.get('all-keys/', function(d){
			var keys = {};
			for(var i=0; i<d.length; i++){
				keys[d[i]] = null;
			}

			$('.keywords-container').material_chip({
			    placeholder: 'Enter a tag',
			    secondaryPlaceholder: '+Tag',
			    autocompleteOptions: {
				      data: keys,
				      limit: Infinity,
				      minLength: 1
				    }
			  });
		}, true);
		
	}

	this.notificationInit = function(){
		$('.notification-container').css({
			display: 'none'
		});

		$('.notification-container .notif-ok').on('click', function(){
			self.view.notificationClose();
		});
	}

	this.checkLinkOnExists = function(link, isTrue, isFalse){
		isTrue();
	}

	this.loadThemeForUpdate = function(themeId){
		self.model.get('get-theme-info/' + themeId, function(data){
			console.log('themeId', themeId);
			console.log(data);
			data['keys'] = JSON.parse(data['keys']);
			self.loadMetaForUpdatePage(data['cms']['meta_value']);
			self.view.setDataToFormFormUpdate(data['template'], data['keys'], data['thumbnails']);
		});
	}

	this.addEventToUpdateBtn = function(){
		$('.upldate-template-btn').on('click', function(e){
			e.preventDefault();
			var themeId = $(this).attr('href').split('#')[1];
			self.loadThemeForUpdate(themeId);
			$('.page').css('display', 'none');
			$('#addMeta').css('display', 'block');
			return;
		});
	}



}