window.Common = {};

$( document ).ready(function() {

		var apibase = '/signup';

		function get_geo()
		{
			 return $.get("http://ipinfo.io/geo", "jsonp");
		}

		$('.form-signup').submit(function(e) {
							
				var obj = $(e.currentTarget);
				
				$('div[class*="field-"]', obj).removeClass('error').find('.info').remove();
				
				var form = obj.serializeArray(),
						data = {};
				
				for(var i in form) {
						var item = form[i];
						data[item.name] = item.value;
				}
				
				var errors = false;
				var err_code = 'None';
				var error_msg = '';

				// IF the trial length is set to 60, override the submitted data with our own
				var trial_length = $.cookie('trial_length');
				if (trial_length == 60) {
					data.trial_length = 60;
				}
				if(data.name !== undefined && data.name.search(' ') < 0) {
						$('div.field-name').addClass('error');

						if(data.ref_page !== 'signup' && data.name && data.name.search(' ') < 0) {
							error_msg += 'Please include a first and last name.\n';
						}
						errors = true;
						err_code = 'Missing Name';
				} else if (data.name !== undefined) {
						var names = data.name.split(/ +/);
						data.first_name = names[0];
						data.last_name = names[names.length-1];
				}
				var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				if(!re.test(data.email)) {
						$('div.field-email').addClass('error');
						errors = true;
						err_code = 'Missing/Incorrect Email';
				}
				if(data.company !== undefined && data.company.length <= 2) {
						$('div.field-company').addClass('error');
						errors = true;
						err_code = 'Missing Company';
				}
				if(data.ref_employees !== undefined && (data.ref_employees.length < 1 || data.ref_employees == '0')) {
						$('div.field-ref-employees').addClass('error');
						errors = true;
						err_code = 'Missing Number of Employees';
				}
				if(data.industry_id !== undefined && data.industry_id == "x"){
						$('div.field-industry').addClass('error');
						errors = true;
				}
				if(data.password !== undefined && data.password.length < 6) {
						$('div.field-password').addClass('error');
						if(data.ref_page !== 'signup' && data.password && data.password.length < 6) {
							error_msg += 'Please use a password longer than 6 characters.\n';
						}
						errors = true;
						err_code = 'Missing Password';
				}
				if(data.confirm_password !== undefined && data.confirm_password != data.password) {
						$('div.field-confirm').addClass('error');
						errors = true;
						err_code = 'Incorrect Password Confirm';	
			}            
				if(data.phone_number !== undefined && data.phone_number.length < 10) {
						$('div.field-mobile').addClass('error');
						errors = true;
						err_code = 'Missing Mobile Number';
			}            
				if(errors) {
						e.preventDefault();
						if(error_msg !== '') {
							alert(error_msg);
						}
					try {
								ga('app.send', 'event', 'Errors', 'Signup', err_code);
					} catch(e) {}
						return;
				}
				else if(!data.is_mobile) {
						e.preventDefault(); 
				}
				if(!data.timezone_id) {
						data.timezone_id = jstz.determine().name();
						
						// This is for doing testing... will remove at a future date...
						if(document.location.hash == '#beta') {
								data.timezone_id = 'sagdg/esdg';
						}
				}
			
			try {
				ga('send', 'event', 'Account', 'Signup', data.ref_page);

				if (data.get_onboarding) {
					ga('send', 'event', 'Account', 'Signup Onboarding', data.get_onboarding);
				}
			} catch(e) {}

				if (data.try_reactivate) {
					delete data.try_reactivate;
					data.reactivate = obj.data('reactivate') || 'check';
					data.skip_password = true;
				}

				if(data.is_mobile) {
						obj.append('<input type="hidden" name="first_name" value="'+data.first_name+'" />');
						obj.append('<input type="hidden" name="last_name" value="'+data.last_name+'" />');
						obj.append('<input type="hidden" name="timezone_id" value="'+data.timezone_id+'" />');
						
						$("input[name='name']", obj).remove();
						
						obj.append('<input type="hidden" name="auth" value="'+window.csrf+'" />');
						obj.append('<input type="hidden" name="auth_date" value="'+window.csrf_date+'" />');
						
						return;
				}

				data.mbsy_short_code = mbsy_short_code;
				data.auth = window.csrf;
				data.auth_date = window.csrf_date;

				if($.cookie("referral_code"))
					data.referral_code = $.cookie("referral_code");
				
				if($.cookie("ref_plan_id"))
					data.ref_plan_id = $.cookie("ref_plan_id");

				if($.cookie("utm_source"))
					data.utm_source = $.cookie("utm_source");

				if($.cookie("utm_medium"))
					data.utm_medium = $.cookie("utm_medium");

				if($.cookie("utm_term"))
					data.utm_term = $.cookie("utm_term");
				
				if($.cookie("utm_content"))
					data.utm_content = $.cookie("utm_content");

				if($.cookie("utm_campaign"))
					data.utm_campaign = $.cookie("utm_campaign");

				get_geo().done(function(result) {
						data.state = result.region;
						data.city = result.city;
						data.zip = result.postal;
				});

				data.return_token = true;
				$('.create-loading').show();
				$('.submit_b').hide();
				
				jQuery.post(api_base, data, function(resp) {
						if(!resp.error) {
							window.analytics.track('Created Account', {
								env: 'js',
								coupon_code: data.coupon,
								referring_page: data.ref_page
							});

							if (data.redirect) {
								document.location.href = data.redirect;                     
							}
							else if (data.is_mobile) {
								document.location.href = 'http://wheniwork.com/mobile-signup-thanks/?current=thanks';
							} else if (data.get_industry) {
								IndustryPop(resp.account_id,resp.auto_login, resp.token);
							} else if (data.get_onboarding) {
								OnboardingRedirect(data.get_onboarding, resp.account_id, resp.auto_login, resp.token);
							} else {
								document.location.href = 'http://app.wheniwork.com/scheduler/setup?al='+resp.auto_login;
							}
						}
						else {

							$('.submit_b').show();
							$('.create-loading').hide();

							// Reactivation not possible
							if (resp.code === 5230) {
								Common.dialog(
									"It looks like you have already created a When I Work user. What would you like to do?",
									function(dialog) {
										if (this.hasClass('confirm')) {
											$('.form-signup').data('reactivate', 'nope').trigger('submit');
										}
										else {
											document.location.href = '/login';
										}
									},
									{
										'title': 'Email Already Exists',
										'buttons': ["Create New Account", "Go to Login"],
										'handleAll': true
									}
								);
								return;
							}
							// Reactivation is possible
							else if (resp.code === 5231) {
								Common.dialog(
									"It looks like you have an expired When I Work account. What would you like to do?",
									function(dialog) {
										if (this.hasClass('confirm')) {
											$('.form-signup').data('reactivate', true).trigger('submit');
										}
										else {
											$('.form-signup').data('reactivate', 'nope').trigger('submit');
										}
									},
									{
										'title': 'Reactivate Your Trial',
										'buttons': ["Reactivate Account", "New Account"],
										'handleAll': true
									}
								);
								return;
							}

								if(resp.code == 5010) {
										$('div.field-coupon').addClass('error').append('<div class="info"><ins></ins>That promo code is invalid.</div>');
										try {
									_gaq.push(['_trackEvent', 'Errors', 'Signup', 'Invalid Promo Code']);
								} catch(e) {}
								}
								else if(resp.code == 5030) {
										$('.field-timezone').remove();
										jQuery.post(api_base, {show_timezones:true}, function(resp){
												
												var select = ['<div class="field-timezone field-select">',
																'<label for="timezone_id"><i class="icon-time"></i></label>',
																			'<span><select name="timezone_id">'],
														timezones = resp.timezones || [];
												
												for(var i in timezones) {
														var tz = timezones[i],
																hour_offset = Math.floor(tz.offset),
																minute_offset = (tz.offset - hour_offset) * 60;
														
														if(minute_offset < 10) minute_offset = ['0',minute_offset].join('');
														
														var time = [hour_offset,':',minute_offset];
														if(hour_offset >= 0) {
																time.unshift('+');
														}
														select.push(['<option value="',tz.olson_id,'">(UTC ',time.join(''),') ',tz.name,'</option>'].join(''));
												}
												select.push('</select><abbr><i class="icon-angle-down" /></abbr></span></div>');
												if ($('> ul', obj).length) {
													obj.find('>ul').append($(select.join('')).wrap('<li />').parent());
												}
												else {
													var sel = $(select.join(''));
													sel.find('label').remove();
													obj.find('button').before(sel);
												}
												
												$('div.field-timezone').addClass('error').append('<div class="info">Select a timezone.</div>');
												try {
										_gaq.push(['_trackEvent', 'Errors', 'Signup', 'Missing Timezone']);
									} catch(e) {}
										}, function(resp) { });
								}
								else {
										alert("There was an unknown error!\n\nMessage: " + resp.error);
										try {
									_gaq.push(['_trackEvent', 'Errors', 'Signup', resp.error]);
								} catch(e) {}
								}
						}
				},"json");
				
		});

		// Function to redirect to an onboarding page on a successful trial signup.
		function OnboardingRedirect(callback, account_id, auto_login, token) {
			var form = $('<form action="' + callback + '" method="post">' +
					'<input type="text" name="account_id" value="' + account_id + '" />' +
					'<input type="text" name="auto_login" value="' + auto_login + '" />' +
					'<input type="text" name="token" value="' + token + '" />' +
				'</form>');
			$('body').append(form);
			form.submit();
		}

		function IndustryPop(account_id, auto_login, token) {
			console.log(account_id);
			console.log(auto_login);
			jQuery.magnificPopup.open({
				items: {src: '#industry-pop'},type: 'inline', closeOnBgClick: false},
			0);
			$('#industry_pop_account').val(account_id);
			$('#industry_pop_autologin').val(auto_login);
			$('#industry_pop_token').val(token);
		}

		$('.ind-box').click(function() {

				jQuery.post('/update-industry',{ industry_id: $(this).data('industry-id'), account_id: $('#industry_pop_account').val(), token: $('#industry_pop_token').val() }, function(data){
						document.location.href = 'http://app.wheniwork.com/scheduler/setup?al='+ $('#industry_pop_autologin').val();
				});
		});

		$('.start-demo').click(function() {
				// Popup code to go here
				var timezone = jstz.determine().name();
				var e = document.getElementById("industry");
				var industry_id = e.options[e.selectedIndex].value;
				jQuery.post( "/wiw-demo-create", { timezone: timezone, industry_id: industry_id  }, function( data ) {

						document.location.href = 'http://app.wheniwork.com/scheduler?al='+data;
				});
		});
		var valid_account_id = false;
		window.country_code = 'US';
		$('#subdomain').keyup(function(e) {
				var val = $('#subdomain').val();
				$.get('/signup-account-check', {'q': val, 'external': 't', 'mode': 'account-check'}, function(json) {
						if (json.query != $('#subdomain').val()) {
								return;
						}
						$('div.field-subdomain').removeClass('error').find('.info').remove();
						$('div.field-subdomain').removeClass('success').find('.info').remove();
						if(json.taken_by !== undefined) {
								$('div.field-subdomain').addClass('success').append('<div class="info">Account: '+(json.taken_by || "Valid")+'</div>');
								valid_account_id = true;
						} else {
								$('div.field-subdomain').addClass('error').append('<div class="info"><ins></ins>'+json.query+' is not a valid Account ID.<br />(ie. http://ACCOUNT-ID.wheniwork.com)</div>');
								valid_account_id = false;
						}

						window.country_code = json.country_code || 'US';
				}, 'json');
		});

		jQuery.fn.center = function () {
			this.css({
				'top': '50%',
				'left': '50%',
				'marginLeft': -(this.outerWidth()/2) + 'px',
				'marginTop': -(this.outerHeight()/2) + 'px',
				'position': 'fixed'
			});
			return this;
		};

		/* DIALOG VIEW FOR CONFIRMATION */

		window.AlertDialogView = function(options) {
			this.cid = 'dialog-view';
			options = options || {};
			this._ensureElement();
			this.initialize.apply(this, arguments);
			this.delegateEvents();
		};

		var delegateEventSplitter = /^(\S+)\s*(.*)$/;

		$.extend(window.AlertDialogView.prototype,
			{
				tagName: 'div',
				className: 'dialog-kit alert-dialog',
				events: {
					'click .button-close' : 'remove',
					'click .dialog-footer a' : 'action'
				},
				initialize: function(options) {
					this.options = options;
					this.callback = options.callback || false;
				},
				render: function() {
					var html = [
					'<div class="dialog-header"><a href="#" class="dialog-button button-close"><i class="fa fa-times"></i></a>',
					this.options.title || "Alert",
					'</div><div class="dialog-body"><p>',
					this.options.message,
					'</p></div>'
					];
					if (this.options.callback) {
						html.push('<div class="dialog-footer">');
						html.push('<a href="#" class="button-kit '+(this.options.color || 'green')+' large right confirm">');
						html.push(this.options.buttons[0] || 'Okay');
						if (this.options.buttons[1] !== null) {
							html.push('</a><a href="#" class="button-kit grey large">');
							html.push(this.options.buttons[1] || 'Cancel');
						}
						html.push('</a></div>');
					}

					this.$el.html(html.join('')).width(this.options.width || 500);

					return this;
				},
				action: function(e) {
					e.preventDefault();

					var obj = $(e.currentTarget);
					if ((obj.hasClass('confirm') || this.options.handleAll) && typeof this.callback === 'function') {
						this.callback.call(obj, this);
					}

					this.remove();
				},
				show: function(options) {
					if(!this.$el.parent().length) {
						$('body').append(this.$el);
					}

					if(options) {
						if(options.modal) {
							this._modal = $('<div class="dialog-kit-modal"/>');
							$('body').append(this._modal);
						}
					}

					this.$el.addClass('visible');

					if(options && options.position) {
						this.position(options.position);
					} else {
						this.position();
					}

					if(this.onShow) this.onShow.call(this, options);

					// Store all overlays, so they can be closed
					if(typeof App != 'undefined') App.removeOverlay(this);

					return this;
				},
				position: function(options) {
					if(options) {
						var css = {top: options.y};
						if(options.x) css.left = options.x;
						if(options.right) css.right = options.right;
						this.$el.css(css);
					} else {
						this.$el.center();
					}
				},
				hide: function() {
					this.$el.removeClass('visible');
					if(this._modal) {
						this._modal.remove();
						this._modal = null;
					}

					if(this.onHide) this.onHide.call(this);

					return this;
				},
				remove: function() {
					if(this._modal) {
						this._modal.remove();
						this._modal = null;
					}
					this.$el.remove();
					return this;
				},
				delegateEvents: function() {
					events = this.events || {};
					for (var key in events) {
						var method = this[events[key]];
						if (!method) continue;

						var match = key.match(delegateEventSplitter);
						var eventName = match[1], selector = match[2];
						method = jQuery.proxy(method, this);
						eventName += '.delegateEvents' + this.cid;
						if (selector === '') {
							this.$el.on(eventName, method);
						} else {
							this.$el.on(eventName, selector, method);
						}
					}
					return this;
				},
				undelegateEvents: function() {
					this.$el.off('.delegateEvents' + this.cid);
					return this;
				},
				setElement: function(element, delegate) {
					if (this.$el) this.undelegateEvents();
					this.$el = element instanceof jQuery ? element : jQuery(element);
					this.el = this.$el[0];
					if (delegate !== false) this.delegateEvents();
					return this;
				},
				_ensureElement: function() {
					if (!this.el) {
						var attrs = jQuery.extend({}, this.attributes || {});
						if (this.id) attrs.id = this.id;
						if (this.className) attrs['class'] = this.className;
						var $el = jQuery('<' + this.tagName + '>').attr(attrs);
						this.setElement($el, false);
					} else {
						this.setElement(this.el, false);
					}
				}
			}
		);

		Common.dialog = function(message, callback, options) {
			var settings = $.extend({}, {
				'modal' : true,
				'title'	: 'Alert',
				'buttons' : ['Okay', 'Cancel'],
				'color' : 'green'
			}, options || {});

			var dialog = new AlertDialogView({
				title: settings.title,
				message: message,
				buttons: settings.buttons,
				color: settings.color,
				callback: callback,
				handleAll: settings.handleAll || false
			});

			dialog.render().show({modal: settings.modal});
		};
});
