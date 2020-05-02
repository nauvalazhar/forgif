console.log('%cHello, dev!\n%cIf you think this is bad, please contribute, make some changes and it will get better!\n\nContact: %cdev@forgif.us','font-size:40px;color:#80AAB5;', 'font-size:16px;','color:#80AAB5;font-size:16px;')

function notif(data, options) {
	var element = "<div class='notif' id='"+data.id+"' style='width: "+data.width+"px'>";
	element += "<div class='notif-inner' style='width: "+data.width+"px'>"+data.content+"</div>";
	if(data.button) {
		element += "<div class='cta btn btn-default "+data.button.class+"' "+data.button.attr+">"+data.button.text+"</div>";
	}
	element += "<div class='close' onclick=\"removeNotif('"+data.id+"')\"><i class='ion-ios-close-empty'></i></div>";
	element += "</div>";
	$("body").prepend(element);
	setTimeout(function() {
		removeNotif(data.id);
	}, (typeof data.timeout == 'undefined' || !data.timeout ? 3000 : data.timeout));
}

function removeNotif(id) {
	$("#"+id).remove();
}

function loadingShow() {
	$(".logo").hide();
	$(".global-loader").show();
}

function loadingHide() {
	$(".logo").show();
	$(".global-loader").hide();
}

function showReportForm() {
	var el = `<div class="modal fade" id="modal-report" tabindex="-1">
	  <div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h4 class="modal-title">Report This Post</h4>
	      </div>
	      <form>
	      <div class="modal-body">
	      	<p>Tell us to understand what is happening, you can report this post with your own reason.</p>
	      	<textarea id="report-content" maxlength="160" class="form-control" placeholder="Your reasons for this report" style="height: 150px;"></textarea>
	      </div>
	      <div class="modal-footer">
	      	<button class="btn btn-primary" type="submit">Report</button>
	      	<button class="btn btn-default" data-dismiss="modal">Cancel</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>`;

	$(el).modal('toggle');
	$("body").prepend(el);
}

function hideReportForm() {
	$("#modal-report").modal('hide');
}

function getLinkModal(id) {
	var el = `<div class="modal fade" id="getlink" tabindex="-1">
	  <div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
		      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      	<h4 class="modal-title">Get Link</h4>
	      </div>
	      <div class="modal-body">
	      	<p>Copy the following link and share this GIF with your friends.</p>
	      	<input type="text" value="`+id+`" class="form-control get-link-input" readonly>
	      	<br>
	      	<p>or HTML5 player:</p>
	      	<input type="text" value="`+id+`/play" class="form-control" readonly>
	      </div>
	    </div>
	  </div>
	</div>`;

	$("body").prepend(el);
	$(el).modal('toggle').on('shown.bs.modal', function() {
		$('.get-link-input').select();
		$('.get-link-input').focus();
	});
}


// function elementStatus(item) {
// var element = "";
// 		element += "<div class=\"card\" id=\"gif--id--"+item.id+"\">";
// 		element += "<div class=\"users\">";
// 		element += "<div class=\"info\">";
// 		element += "<figure>";
// 		element += "	<a href='"+base_url+"/"+item.users.username+"'><img src=\""+base_url + "/media/" + item.users.picture + ".png" +"\"></a>";
// 		element += "</figure>";
// 		element += "<div class=\"meta\">";
// 		element += "	<div class=\"name\"><a href='"+base_url+"/"+item.users.username+"'>"+ item.users.name +"</a></div>";
// 		element += "	<div class=\"desc\">";
// 		element += "		<div class=\"time\">"+ item.date +"</div>";
// 		element += "	</div>";
// 		element += "</div>";
// 		if(item.login) {		
// 			element += "<div class=\"options\">";
// 			// element += "	<a class=\"option\"><i class=\"ion-chatbubble\"></i><div>0</div></a>";
// 			element += "	<a class=\"option post--like"+(item.has_like ? ' active': '')+"\" data-id=\""+item.id+"\""+(item.has_like ? ' data-unlike="true"':'')+"><i class=\"ion-heart\"></i><div>"+item.like_count+"</div></a>";
// 			element += "	<div class='dropdown'><a class=\"option\" data-toggle='dropdown'><i class=\"ion-android-more-vertical\"></i></a>";
// 			element += "		<ul class=\"dropdown-menu\">";
// 			if(item.owner) {
// 				element += "			<li><a role=\"button\" class=\"post--edit\" data-id=\""+item.id+"\">Edit</a></li>";
// 			}
// 			if(item.owner || item.admin) {
// 				element += "			<li><a role=\"button\" class=\"post--delete\" data-id=\""+item.id+"\">Delete</a></li>";			
// 			}
// 			// element += "			<li class=\"divider\"></li>";
// 			// element += "			<li><a href=\"#\">Report</a></li>";
// 			element += "		</ul>";
// 			element += "	</div>";
// 			element += "</div>";
// 		}
// 		element += "</div>";
// 		element += "</div>";
// 		element += "<div class=\"caption\">";
// 		element += item.content;
// 		element += "</div>";
// 		element += item.attachment;
// 		element += "</div>";
// return element;
// }

function elementStatus(item) {
	var el = `<div class="card-post" id="gif--id--`+item.id+`">
		`;
		if(item.privacy == 'public') {
			el += `<div class="post-badge" title="Public Post">
				<i class="ion-fireball"></i> Public
			</div>`;
		}
		el += `
		<div class="card-post-detail">
			<div class="user">
				<figure>
					<a href="`+base_url+`/`+item.users.username+`">
						<img src="`+base_url+`/media/`+item.users.picture+`.png">
					</a>
				</figure>
				<div class="user-info">
					<div class="name"><a href="`+base_url+`/`+item.users.username+`">`+item.users.name+`</a></div>
					<div class="time">`+item.date+`</div>
				</div>
			</div>`;

		// if(item.login) {
		el += `	<div class="buttons">
				<!--<a role="button"><i class="ion-chatbubble"></i> <span>100</span></a>-->
				`;
		if(item.login) {
			el +=	`<a role="button" class="option post--like`+(item.has_like ? ' active': '')+`" data-id="`+item.id+`"`+(item.has_like ? ' data-unlike="true"':'')+`><i class="ion-heart"></i> <span>`+item.like_count+`</span></a>`;
		}
		el +=	`<div class="options dropdown">
					<a href="" data-toggle="dropdown"><i class="ion-android-more-vertical"></i></a>
					<ul class="dropdown-menu">
		`;
		if(item.admin) {
			el +=`		<li><a role="button" class="post--public" data-id="`+item.id+`">Make as Public</a></li>`;
		}
		if(item.owner) {
			el += `	<li><a role="button" class="post--edit" data-id="`+item.id+`">Edit</a></li>`;
		}
		if(item.owner || item.admin) {
			el +=`		<li><a role="button" class="post--delete" data-id="`+item.id+`">Delete</a></li>`;
		}
			el +=`		<li><a role="button" class="post--getlink" data-link="`+item.link+`">Get Link</a></li>`;
		if(!item.owner && item.login) {			
			el += `<li><a role="button" class="post--report" data-id="`+item.id+`">Report</a></li>`;
		}
			el +=	`</ul>
				</div>
			</div>`;
		// }
		el += `	<div class="caption">
				`+item.content+`
			</div>
		</div>`;
		el += item.attachment;
		el += `</div>`;
	return el;
}

var infi_count = 0, infi_end = false;
function getStatus($this, me) {
	if(me) {me='/'+me}else{me=''}
	if(infi_end == true) {
		$(".infinite-scroll-loader").hide();
		$(".infi-end").show();
	}else{
  	infi_count++;
		$.ajax({
			url: base_url + '/status'+me+'/' + infi_count,
			dataType: 'json',
			beforeSend: function() {
				$(".infinite-scroll-loader").show();
			},
			complete: function() {
				$(".infinite-scroll-loader").hide();
			},
			success: function(data) {
				if(data.data.length == 0) infi_end = true;
				if(data.data.length == 0 && infi_count == 1) $(".infi-end").show();
				if(data.success == true) {
					if(infi_count == 0) {
						$this.html("");
					}
					data.data.forEach(function(item, index) {
						$this.append($(elementStatus(item)));
					});
				}
			}
		})			
	}
}


$(function() {
	$(document).on("click", ".gif--player",function() {
		// var $this = $(this),
		// 		$thumb = $this.find("img").attr('src');

		// if($this.hasClass("active")) {
		// 	$this.find('img').attr('src', $this.find("img").attr('data-src'));
		// 	$this.removeClass("active");
		// 	$this.parent().removeClass("active");
		// }else{
		// 	$this.find('img').attr('src', (($this.find('img').attr('src')).replace('thumbs/', '')).replace("png", "gif"));
		// 	$this.addClass("active");
		// 	$this.parent().addClass("active");
		// }
		// $this.find("img").attr('data-src', $thumb);
		var $this = $(this), video = $this.find("video").get(0);

		// $(".gif--player video")[0].pause();
		if(video.paused) {
			$this.addClass("active");
			video.play();
		}else{
			$this.removeClass("active");
			video.pause();
		}
	});

	$(document).on("contextmenu", ".gif--player", function() {
		// return false;
	});

	$(".forgif--button").each(function() {
		var $this = $(this);

		$this.click(function() {
			$.ajax({
				url: base_url + '/friends',
				data: {
					user_to: $this.data("to")
				},
				headers: {
					'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
				},
				dataType: 'json',
				type: 'post',
				beforeSend: function() {
					$this.addClass("disabled");
					loadingShow();
				},
				complete: function() {
					$this.removeClass("disabled");
					loadingHide();
				},
				success: function() {
					$this.after("<div class='help-text'>Forgif request has been sent</div>");
					$this.hide();
				}
			})
			return false;
		});
	});

	$(".confirm--button").each(function() {
		var $this = $(this);

		$this.click(function() {
			$.ajax({
				url: base_url + '/friends',
				data: {
					id: $this.data("to"),
					_method: 'PATCH'
				},
				headers: {
					'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
				},
				dataType: 'json',
				type: 'post',
				beforeSend: function() {
					$this.addClass("disabled");
				},
				complete: function() {
					$this.removeClass("disabled");
				},
				success: function() {
					$this.after("<div class='help-text'>Forgif request has been accepted</div>");
					$this.hide();
				}
			})
			return false;
		});
	});

	$(".unforgif--button").each(function() {
		var $this = $(this);

		$this.click(function() {
			$.ajax({
				url: base_url + '/friends',
				data: {
					id: $this.data("to"),
					_method: 'DELETE'
				},
				headers: {
					'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
				},
				dataType: 'json',
				type: 'post',
				beforeSend: function() {
					$this.addClass("disabled");
				},
				complete: function() {
					$this.removeClass("disabled");
				},
				success: function() {
					$this.after("<div class='help-text'>You have stopped forgifing</div>");
					$this.hide();
				}
			})
			return false;
		});
	});

	$("#form-status").submit(function() {
		var $this = $(this);
		var formData = new FormData(this);
		$.ajax({
			url: $this.attr("action"),
			type: $this.attr("method"),
			data: formData,
			dataType: 'json',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
	    contentType: false,
	    processData: false,
			error: function(xhr) {
				var response = JSON.parse(xhr.responseText);
				if(xhr.status == 422) {
					notif({
						id: 'error',
						content: response[Object.keys(response)[0]]
					});
				}
			},
			beforeSend: function() {
				$this.find(".loader").fadeIn();
				$this.find(".submit").attr('disabled', true);
				$this.find(".form-group.has-error .help-block").remove();
				$this.find(".form-group").removeClass("has-error");
			},
			complete: function() {
				$this.find(".loader").fadeOut();
				$this.find(".submit").attr('disabled', false);
			},
			success: function(data) {
				$this[0].reset();
				$this.find(".char").text(160);
				$("[data-status-loader]").prepend($(elementStatus(data.data)));
				autosize.update($this.find(".char"));
			}
		})
		return false;
	});

	$("#form-status textarea[name='content']").on("paste keyup keypress", function(){
		var max = 160;
		var count = max - $(this).val().length;
		if(count < 0) {

		}else{
			$("#form-status .char").text(count);		
		}
	});

	autosize($("#form-status textarea[name='content']"));

	$(document).on("click", ".post--like", function() {
		var $this = $(this),
				$id = $this.data('id'),
				type = 'like',
				count = parseFloat($this.find("span").html()),
				cl = $this.find("span");

		if($this.is('[data-unlike]') == true) {
			type = 'unlike';
			$this.removeAttr("data-unlike");
			cl.html(count - 1);
			$this.removeClass("active");
		}else{
			$this.attr('data-unlike', true);
			cl.html(count + 1);
			$this.addClass("active");
		}

		$.ajax({
			url: base_url + '/status/' + $id + '/' + type,
			type: 'post',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			beforeSend: function() {
			},
			error: function() {
			},
			complete: function() {

			},
			success: function(data) {
			}
		})
		return false;
	});

	$(document).on("click", ".post--delete", function() {
		var $this = $(this),
				$id = $this.data('id'),
				$restore = $this.is('[data-restore]'),
				type = 'delete';

		if($restore) {
			type = 'restore';
		}

		$.ajax({
			url: base_url + '/status/' + $id + '/' + type,
			type: ($restore ? 'post' : 'delete'),
			dataType: 'json',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			beforeSend: function() {
				loadingShow();
			},
			complete: function() {
				loadingHide();
			},
			success: function(data) {
				if($restore) {
					$("#gif--id--"+$id).fadeIn();
					removeNotif('notif-restore-'+$id);
				}else{
					notif({
						id: 'notif-restore-'+$id,
						content: 'Post has been successfully deleted, you want to restore it?',
						width: 570,
						timeout: 1000000,
						button: {
							class: 'post--delete',
							attr: "data-id='"+$id+"' data-restore",
							text: 'Undo'
						}
					});
					$("#gif--id--"+$id).fadeOut();
				}
			}
		})
	});

	$(document).on("click", ".post--public", function() {
		var $this = $(this),
				$id = $this.data('id');

		$.ajax({
			url: base_url + '/status/' + $id + '/public',
			method: 'patch',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			beforeSend: function() {
				loadingShow();
			},
			complete: function() {
				loadingHide();
			},
			success: function(data) {
				notif({
					id: 'success-public',
					content: 'Post has been set to public'
				});
			}
		})

	});

	$(document).on('click', '.post--edit', function() {
		var $this = $(this),
				$id = $this.data('id'),
				$caption = $("#gif--id--"+$id).find('.caption'),
				value = $caption.html();

		$caption.attr('contenteditable', true);
		$caption.after("<div class='help-block sm'>Press Enter to send or Escape to cancel edit</div>")
		$caption.focus();
		$caption.on('keydown', function(e){
			if(e.keyCode == 13 && !e.shiftKey) {
				$.ajax({
					url: base_url + '/status/' + $id + '/edit',
					method: 'patch',
					data: {
						content: $caption.html()
					},
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					beforeSend: function() {
						loadingShow();
						$("#gif--id--"+$id).find('.caption').attr('contenteditable', false);
					},
					error: function() {
						$("#gif--id--"+$id).find('.caption').attr('contenteditable', true);
					},
					complete: function() {
						loadingHide();
					},
					success: function(data) {
						$caption.html(data.data.content);
						$caption.parent().find(".help-block").remove();
					}
				})
				return false;
			}else if(e.keyCode === 27) {
						$caption.html(value);
						$caption.parent().find(".help-block").remove();
				$("#gif--id--"+$id).find('.caption').attr('contenteditable', false);
			}else if(e.shiftKey && e.keyCode == 13) {
				return true;
			}
		});
	});

	$(document).on('click', ".post--report", function(){
		showReportForm();
		var $toggle = $(this),
				$id = $toggle.data('id');

		$(document).on("submit", "#modal-report form", function() {
			var $form = $(this);

			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: base_url + '/report',
				type: 'post',
				data: {
					id: $id,
					reason: $form.find("#report-content").val()
				},
				beforeSend: function() {
					$form.find(":input").attr('disabled', true);
					$form.find("[type='submit']").html('Reporting ...');
				},
				complete: function() {
					$form.find(":input").attr('disabled', false);
					$form.find("[type='submit']").html('Report');
				},
				error: function(xhr) {
					var response = JSON.parse(xhr.responseText);
					if(xhr.status == 422) {
						notif({
							id: 'error',
							content: response[Object.keys(response)[0]]
						});
					}
				},
				success: function() {
					$form[0].reset();
					hideReportForm();
					notif({
						id: 'report-notif',
						content: 'Thanks for letting us know, your report has been received'
					})
				}
			})
			return false;
		});
		return false;
	});

	$(document).on("click", ".post--getlink", function() {
		getLinkModal($(this).data("link"));
		return false;
	});

	$("#pick-gif-group input").change(function() {
		var picked = "<i class=\"ion ion-image\"></i> GIF picked",
				hover = '<i class="ion ion-image"></i> Change GIF',
				selected_path = ($(this).val().split("\\")[$(this).val().split("\\").length-1]);
		if($(this).val()) {
			$(this).parent().find("a").html(picked);
			$(this).parent().find("a").attr("title", selected_path);
			$(this).parent().find("a").attr("data-toggle", "tooltip");
			$(this).parent().find("a").mouseover(function() {
				$(this).html(hover);
			}).mouseout(function() {
				$(this).html(picked)
			});
		}
	})

	if($(window).outerWidth() > 768) {
		$("#primary-sidebar").stick_in_parent({
			parent: 'section.home',
			offset_top: 80
		});		
	}

	$(".dropdown-menu .user-list").niceScroll();

	if(!localStorage.getItem('tour') || localStorage.getItem("tour") !== appver) {
		var tour = new Tour({
		  steps: [
		  {
		  	element: '#form-status',
		  	title: 'GIF Upload Form',
		  	content: 'You can upload your GIF through this form.'
		  },
		  {
		  	element: '#form-status .btn-danger',
		  	title: 'Pick Button',
		  	content: 'First off, click this button to select the GIF you want to upload.',
		  	placement: 'bottom'
		  },
		  {
		  	element: '#form-status textarea',
		  	title: 'Caption',
		  	content: 'Give a little caption for the GIF you\'ll upload.'
		  },
		  {
		  	element: '#form-status .btn-primary',
		  	title: 'Post Button',
		  	content: 'Just click this button and your GIF will be uploaded. And for more help visit the Help Center.',
		  	placement: 'bottom'
		  }
		],
		backdrop: true,
		redirect: false,
		storage: false,
		onEnd: function() {
			localStorage.setItem('tour', appver);
		}
		});
		tour.init();
		tour.start();
	}
});