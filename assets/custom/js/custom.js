$(document).ready(function(){

	function validateForm() {
		$('#singlebutton').click(function() {
	        var formParent = $(this).closest('form');
	        var form = formParent.serializeArray();
	        var imageItems = formParent.find(".talent_thumb");
	        if (imageItems.length <= 0) {
	            $('.result-picture-talent').html('<label class="col-md-offset-4 text-danger">Error !! Image cant be empty.</label>');
	            setTimeout(function(){ $('.result-picture-talent').html(''); }, 3000);
	        }

	        [].slice.call(form).forEach(function(elm) {
	            if (elm.name != 'talent_thumb[]') {
	                var formElement = $('[name='+elm.name+']');
	                if(formElement.attr('required')) {
	                    if (elm.value == '') {
	                        formElement.closest('.form-group').addClass('has-error');
	                    } else if(elm.value != '') {
	                        formElement.closest('.form-group').removeClass('has-error');
	                    }
	                }
	            }
	        });
	        if (formParent.find('.has-error').length == 0 && imageItems.length > 0) {
	            formParent.submit();
	        }

	    });

	    var form = $('#register_talent').serializeArray();
        [].slice.call(form).forEach(function(elm, i) {
            if (elm.name != 'talent_thumb[]') {
                var formElement = $('[name='+elm.name+']');
                if (formElement.is('input') || formElement.is('textarea')) {
                    if (formElement.attr('type') == 'date') {
                        $(formElement).change(function() {
                            if($(this).attr('required') && $(this).val() == '') {
                                formElement.closest('.form-group').addClass('has-error');
                                formElement.focus();
                            }else {
                                formElement.closest('.form-group').removeClass('has-error');
                            }
                        });
                    } else {
                        $(formElement).keyup(function() {
                            if($(this).attr('required') && $(this).val() == '') {
                                formElement.closest('.form-group').addClass('has-error');
                                formElement.focus();
                            }else {
                                formElement.closest('.form-group').removeClass('has-error');
                            }
                        });
                    }   
                } else if(formElement.is('select')) {
                    $(formElement).change(function() {
                        if($(this).attr('required') && $(this).val() == '') {
                            formElement.closest('.form-group').addClass('has-error');
                            formElement.focus();
                        }else {
                            formElement.closest('.form-group').removeClass('has-error');
                        }
                    });
                }
            }
        });
	}

	function _removeButton() {
		$('.display-thumb > .btn-remove').on('click', function(){
			var file = this.getAttribute('fileName');
			$.ajax({
				url 		: baseUrl+'post/delete_thumb/'+file,
			type 		: "POST",
			dataType: "json"
			}).done(function(r){
				var html =
		  '<input type="file" id="choose-thumb" class="loading" style="display: none;">'
		  +'<img src="'+baseUrl+'uploads/default/default-image.jpg">';
		  $('.display-thumb').html(html);
		  load();
			}).fail(function(){

			});
		});

		var buttonRemove = $('body').find('a.btn-remove');
		[].slice.call(buttonRemove).forEach(function(elm) {
			$(elm).on('click', function() {
				$(this).closest('.image-preview').remove('.image-preview');
			});
		});

		$('.inventory-thumb > .btn-remove').on('click', function(){
			var file = this.getAttribute('file-name')
				var html =
		  '<input type="file" id="choose-image" class="loading" style="display: none;">'
		  +'<img src="'+baseUrl+'assets_admin/images/default.PNG">';
		  $('.inventory-thumb').html(html);
		  load();
		});

		$('.talent-thumb > .btn-remove').on('click', function(){
			var file = this.getAttribute('file-name')
			$.ajax({
				url 		: baseUrl+'talent/remove_image',
			type 		: "POST",
			dataType: "json",
			data 		: {
				fileName : file
			}
			}).done(function(r){
				var html =
		  '<input type="file" id="choose-image" class="loading" style="display: none;">'
		  +'<img src="'+baseUrl+'assets_admin/images/user.png">';
		  $('.talent-thumb').html(html);
		  load();
			}).fail(function(text){
				console.log(text);
			});
		});
	}

	function uploadButton() {
		$('#choose-thumb').on('change', function(){
			readUrl(this);
		});
		$('#banner').on('change', function() {
			uploadBanner(this);
		});
		//==============================================
		//	Onchange Inventory Assets Upload Image
		//==============================================
		$('#choose-image').on('change', function(){
			$('#loader').show();
			uploadInventory(this);
		});
		//==============================================
		//	Onchange Talent Upload Picture
		//==============================================
		$('[name=choose-picture]').on('change', function(){
			$('#loader').show();
			uploadPicture(this);
		});
		//==============================================
		//	Onchange Venue Upload Album
		//==============================================
		$('[name=fileAlbum]').on('change', function(){
			$('#loader').show();
			uploadAlbum(this);
		});
	}

	/*
	** Function for Selected request model
	*/

	function selectRequest() {
		$(document).on('click', '.multiple-request', function() {
			if ($(this).hasClass('btn-default')) {
				$(this).removeClass('btn-default');
				$(this).addClass('btn-success');
			}else {
				$(this).addClass('btn-default');
				$(this).removeClass('btn-success');
			}
		});
	}

	/*
	** ===================================
	*/

	/*
	** Function for Send request model
	*/

	function sendRequest() {
		$('.send-request').click(function() {
			var Items = document.querySelectorAll('.multiple-request');
			var dataItems = [];
			[].slice.call(Items).forEach(function(elm) {
				if ($(elm).hasClass('btn-success')) {
					dataItems.push($(elm).data('request'));
				}
			});

			if (dataItems) {
				$('#loader').show();
				var data = {
					input : dataItems
				}

				$.ajax({
					url 		: baseUrl+'talent/sent_request',
					type 		: "POST",
					dataType	: "json",
					data 		: data
				}).done(function(r) {
					if (r.status) {
						$('.multiple-request').removeClass('btn-success');
						$.notify("Request Send..", {
					        globalPosition: 'bottom right',
					        className: 'success'
					      });
						$('#loader').hide();
					}
				}).fail(function(r) {
					$.notify("Request Failed", {
				        globalPosition: 'bottom right',
				        className: 'error'
				      });
					$('#loader').hide();
				});
			}
		});
	}

	/*
	** Function for Selected request model
	*/

	function uploadPicture(input){
		$.each(input.files, function (k, v){
			if (input.files[k]) {
				var reader = new FileReader();
				var formData = new FormData();
			  reader.onload = function (e) {
				var data = {
					'imageThumb' : e.target.result
				}
				console.log(data);
				$.ajax({
					url 		: baseUrl+'talent/upload_image',
					type 		: "POST",
					dataType: "json",
					data 		: data
				}).done(function(r){
					var html = 
						'<div class="image-preview col-sm-3">'
					  +'<div class="icon-group">'
						  +'<a href="javascript:void(0);" class="btn btn-danger btn-remove" data="1">'
							  +'<i class="fa fa-remove"></i>'
						  +'</a>'    
					  +'</div>'
					  +'<img src="'+baseUrl+r.value+'" style="width: 100%;">'
					  +'<input type="hidden" name="talent_thumb[]" value="'+r.file+'" class="talent_thumb">'    
				  +'</div>';
					$('.result-picture-talent').append(html);
					_removeButton();
					$('#loader').hide();
				}).fail(function(error){

				});	
			  }
			  reader.readAsDataURL(input.files[k]);
			}
	   });
	}

	function uploadBanner(input) {
		if (input.files[0]) {
			var reader = new FileReader();
			var formData = new FormData();
	  reader.onload = function (e) {
		var data = {
			'imageThumb' : e.target.result
		}
		$.ajax({
			url 		: baseUrl+'banner/save_banner',
			type 		: "POST",
			dataType: "json",
			data 		: data
		}).done(function(r){
			var html = 
					'<input type="text" name="post-thumb" value="'+r.value+'" hidden>'
			+'<input type="file" id="choose-thumb" class="loading" style="display: none;">'
			+'<img src="'+baseUrl+r.value+'">';
			$('.banner-thumb').html(html);
			_removeButton();
		}).fail(function(error){

		});	
	  }
	  reader.readAsDataURL(input.files[0]);
	}
	}

	function readUrl(input) {
		if (input.files[0]) {
			var reader = new FileReader();
			var formData = new FormData();
	  reader.onload = function (e) {
		var data = {
			'imageThumb' : e.target.result
		}
		$.ajax({
			url 		: baseUrl+'post/save_thumb',
			type 		: "POST",
			dataType: "json",
			data 		: data
		}).done(function(r){
			var html = 
					'<div class="btn-remove">'
			  +'<i class="fa fa-minus-circle"></i>'
				+'</div>'
				+'<input type="text" name="post-thumb" value="'+r.value+'" hidden>'
			+'<input type="file" id="choose-thumb" class="loading" style="display: none;">'
			+'<img src="'+baseUrl+'uploads/images/posts/new_post.jpg">';
			$('.display-thumb').html(html);
			_removeButton();
		}).fail(function(error){

		});	
	  }
	  reader.readAsDataURL(input.files[0]);
	}
	}

	function getEmbed() {
		var embed = $('[name=youtube_embed]').val();
		var html = '<iframe style="width: 100%;" height="315" src="'+embed+'" frameborder="0" allowfullscreen></iframe>';
		$('.youtube-embed').html(html);
	}

	function buttonAjaxAdd() {
		$('.add-new').on('click', function(){
			var dataModal = this.getAttribute('dataModal');
			var dataClass = dataModal.replace('modal-', '');
			$('#'+dataModal).modal('show');
			$('#'+dataModal).on('shown.bs.modal', function() {
				var form = this.querySelector('form.form-'+dataClass);
				$('#'+dataModal+' .btn-save').on('click', function() {
					var input = form.querySelector('[name='+dataClass+']');
					var value = $(input).val();
					var data = {
						value : value
					}

					$.ajax({
						url : baseUrl+dataClass+'/add',
						type     : 'POST',
						data     : data
					}).done(function(r){
						$('.'+dataClass).html(r);
						initSelect2();
						$('#'+dataModal).modal('hide');
					}).fail(function(){

					});
				});
			});
		});
	}

	function initSelect2() {
		$(document).ready(function() {
	  $(".select2_single").select2({
		placeholder: "Select a state",
		allowClear: true
	  });
	  $(".select2_group").select2({});
	  $(".select2_multiple").select2();
	});

	$("select[data-value]").each(function (){
		var me = $(this);
		me.val(me.data("value"));
		me.trigger('change'); ;
	});
	}

	function setCoverAlbum() {
		$('.check').click(function(e){
		  e.preventDefault();
		  var value = this.getAttribute('dataImage');
		  $('[name=cover_image]').val(value);
		  $('.check').addClass('btn-transparen');
		  $('.check').removeClass('btn-success');
		  $(this).removeClass('btn-transparen');
		  $(this).addClass('btn-success');
		});
	}

	function uploadAlbum(input){
		var i = 0;
		$.each(input.files, function (k, v){
		  if (input.files[k]) {
				var reader = new FileReader();
				var formData = new FormData();
				reader.onload = function (e) {
			  formData.append("image_data", e.target.result); 
				  $.ajax({
					url: baseUrl+"venue/upload_image",
					type: "POST",
					data: formData,
					dataType: "json",
					contentType: false,
					processData: false
				  }).done(function(data){
					$('.slider-for').slick('slickAdd',data.for);
					$('.slider-nav').slick('slickAdd',data.nav);
					setCoverAlbum();
					$('#loader').hide();
					load();
				  }).fail(function(){

				  });
				}
			  reader.readAsDataURL(input.files[k]);
		  }
		  i++;
		});
	}

	function uploadInventory(input){
		if (input.files[0]) {
			var reader = new FileReader();
			var formData = new FormData();
	  reader.onload = function (e) {
		var data = {
			'imageThumb' : e.target.result
		}
		$.ajax({
			url 		: baseUrl+'inventory/upload_image',
			type 		: "POST",
			dataType: "json",
			data 		: data
		}).done(function(r){
			var html = 
				'<div class="btn-remove">'
			+'<i class="fa fa-minus-circle"></i>'
			+'</div>'
			+'<input type="text" name="inventory-thumb" value="'+r.file+'" hidden>'
			+'<input type="file" id="choose-image" class="loading" style="display: none;">'
			+'<img src="'+baseUrl+r.value+'">';
			$('.inventory-thumb').html(html);
			_removeButton();
			$('#loader').hide();
		}).fail(function(error){

		});	
	  }
	  reader.readAsDataURL(input.files[0]);
	}
	}

	function deleteImageAlbum(){
		$('.remove').on('click', function(e){
			e.preventDefault();
			e.stopPropagation();
			var index = $(this).closest('.slick-slide').data('slick-index');
			var data = {
				'image' : this.getAttribute('dataImage')
			};
			$('.slider-nav').slick('slickRemove', index);
			$('.slider-for').slick('slickRemove', index);
		});
	}

	function chooseThumb(){
		$('.display-thumb > img').on('click', function(){
			var choose = document.getElementById('choose-thumb');
		choose.click();
		});
		$('.banner-thumb > img').on('click', function(){
			var choose = document.getElementById('banner');
		choose.click();
		});
		//==============================================
		//	Onchange Inventory Album
		//==============================================
		$('.inventory-thumb > img').on('click', function(){
			var choose = document.getElementById('choose-image');
		choose.click();
		});
		//==============================================
		//	Onchange Upload Talent Picture
		//==============================================
		$('.talent-thumb > img').on('click', function(){
			var choose = document.getElementById('choose-picture');
		choose.click();
		});
	}

	function load(){
		sendRequest();
		selectRequest();
		_removeButton();
		uploadButton();
		setCoverAlbum();
		chooseThumb();
		deleteImageAlbum();
		validateForm();
		$('.get-embeded').click(function() {
			getEmbed();
		});
		$('.slider-for').slick({
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  arrows: false,
		  fade: true,
		  asNavFor: '.slider-nav'
		});
		$('.slider-nav').slick({
		  slidesToShow: 3,
		  slidesToScroll: 1,
		  asNavFor: '.slider-for',
		  centerMode: true,
		  nextArrow: '<i class="fa fa-chevron-right success btn-next"></i>',
		  prevArrow: '<i class="fa fa-chevron-left success btn-prev"></i>',
		  focusOnSelect: true
		});

		$('.single-slider').slick({
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  nextArrow: '<i class="fa fa-chevron-right success btn-next-model"></i>',
		  prevArrow: '<i class="fa fa-chevron-left success btn-prev-model"></i>',
		  fade: true,
		  centerMode: true
		});

		$('.slider-view-for').each(function(){
				var $venue_id = $(this).data('venue');
				$(this).slick({
					slidesToShow: 1,
			  slidesToScroll: 1,
			  arrows: false,
			  fade: true,
			  asNavFor: '.slider-view-nav[data-venue="' + $venue_id + '"]'
			  })
			})

		$('.slider-view-nav').each(function() {
			var venueId = $(this).data('venue');
				$(this).slick({
			  slidesToShow: 3,
			  slidesToScroll: 1,
			  asNavFor: '.slider-view-for[data-venue="'+venueId+'"]',
			  centerMode: true,
			  nextArrow: '<i class="fa fa-chevron-right success btn-next"></i>',
			  prevArrow: '<i class="fa fa-chevron-left success btn-prev"></i>',
			  focusOnSelect: true
			});	    	
		});

		lightbox.option({
		  'resizeDuration': 200,
		  'wrapAround': true
		});
		initSelect2();
		buttonAjaxAdd();
	}

	load();
});