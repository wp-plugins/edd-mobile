$(function(){

	$('input').live('touchstart click', function(){
		$(this).focus();
	});

	 $('body > * > *').not('#login').each(function() {
		  $(this).children().not('.toolbar').wrapAll('<div id="wrapper" /></div>');
		  $(this).children('#wrapper').wrapInner('<div id="scroller" /></div>');
	   });

	 $('body > * > *').bind('pageAnimationStart', function( e, info ){

	 })
	 .bind('pageAnimationEnd', function( e, info ){

		if ( info.direction =='in' ){

			if ( myScroll ) { myScroll.destroy(); }

				if ( $('div#'+e.target.id+' #wrapper').get(0) ) {

					setTimeout( function () {
						myScroll = new iScroll( $('div#'+e.target.id+' #wrapper').get(0) );

					 }, 0);

				}

		}

	});

	$('#detail').bind('pageAnimationStart', function( e, info ){

	})
	.bind('pageAnimationEnd', function( e, info ){

		if ( info.direction =='out' ){

			$("#detail .scroll").empty();


		}

	});


	$('#login-submit').click( function(e) {

		e.preventDefault();

		$( '#login' ).append( '<div class="loading"><div class="spinner"><div class="bar1"></div><div class="bar2"></div><div class="bar3"></div><div class="bar4"></div><div class="bar5"></div><div class="bar6"></div><div class="bar7"></div><div class="bar8"></div><div class="bar9"></div><div class="bar10"></div><div class="bar11"></div><div class="bar12"></div></div></div>' );

	  	if ( $('#edd_mobile_user_login').val() != '' || $('#edd_mobile_user_pass').val() != '' ) {

	  		usr = $('#edd_mobile_user_login').val();
	  		psw = $('#edd_mobile_user_pass').val();
	  		nonce = $('#edd_mobile_login_nonce').val();
	  		ajaxurl = $('#edd_mobile_admin_ajax').val();

	  		var data = {
		  		action: 'edd_mobile_login_action',
		  		edd_mobile_user_login: usr,
		  		edd_mobile_user_pass: psw,
		  		edd_mobile_login_nonce: nonce
		  		};

		  		console.log(data);

		  	$.post(ajaxurl, data, function(response) {

		  	console.log(response);

		  		if( response == 'failed') {

		  			$('.loading').remove();
		  		 	alert('Login Failed!');

		  		} else {

			  		location.reload();
			  	}
			});

		}


	});

	$('#jqt .reloadButton').on('touchstart click', function(e) {

		type = false;

		$(this).children().addClass('rotatethis');

		eddmobile_get_api(storage, type);

		$(".current ul").empty();

	 });

	 $('li a').live('touchstart click', function(){

		endpoint = $(this).attr('data-endpoint');
		type = $(this).attr('data-type');
		storage = $(this).attr('data-storage');
		id = $(this).attr('data-id');
		referrer	= $(this).attr('href');
		cache = $(this).parent().hasClass('no-cache');
		dataclass = $(this).parent().hasClass('data');

		api_url = site_url +'/edd-api/'+ endpoint +'/?key='+ key +'&token='+ token +'&type=' + type +'&number=10000';

		//console.log(api_url);
		//console.log(type);

		if ( dataclass && !localStorage.getItem(storage) || cache ) {

			eddmobile_get_api(storage, type);

		} else {

			eddmobile_load_local_data( storage, type, id );

		}

	  });


	  function eddmobile_get_api( storage, type, id ) {

		  $('.loading').remove();

		  $( '.current #wrapper' ).append( '<div class="loading"><div class="spinner"><div class="bar1"></div><div class="bar2"></div><div class="bar3"></div><div class="bar4"></div><div class="bar5"></div><div class="bar6"></div><div class="bar7"></div><div class="bar8"></div><div class="bar9"></div><div class="bar10"></div><div class="bar11"></div><div class="bar12"></div></div></div>' );

		  $('#stats .loading').remove();

		  $.ajax({
			url: api_url,
			dataType: 'json',
			success: function( data ) {

				localStorage.setItem( storage, JSON.stringify(data) );

				setTimeout(function(){
					  	eddmobile_load_local_data( storage, type, id );
				}, 2000);

			},
			error: function(xhr, textStatus, errorThrown) {
				console.log("FAIL: " + xhr + " " + textStatus + " " + errorThrown);

				alert('API access failed. Please check your data connection.');
				$('.loading').remove();
				$('#jqt .reloadButton').children().removeClass('rotatethis');
			}
		});
	  }


	  //loads data from local storage and builds UI
	  function eddmobile_load_local_data( storage, type, id ) {

		  $('.loading').remove();

		  setTimeout(function(){
			  $('#jqt .reloadButton').children().removeClass('rotatethis');
		  }, 350);

		  var data = JSON.parse( localStorage.getItem( storage ) );

		  var content = '';

		  switch ( storage ) {

			 	case 'products':

			 		if ( type == 'detail' ) {

			 			$("#detail .scroll").empty();

			 			for ( var i = 0; i < data.products.length; i++ ) {

							if( data.products[i].info.id == id ) {

								content = '<ul>';
								content += '<li>' + data.products[i].info.title + '</li>';
								content += '<li>Price: $' + data.products[i].pricing.amount + '</li>';
								content += '</ul>';

								content += '<h2>Sales</h2>';

								content += '<ul>';
								content += '<li>Earnings: $' + data.products[i].stats.total.earnings + '</li>';
								content += '<li>Sold: ' + data.products[i].stats.total.sales + '</li>';
								content += '</ul>';

								content += '<h2>Monthly Average</h2>';

								content += '<ul>';
								content += '<li>Earnings: $' + data.products[i].stats.monthly_average.earnings + '</li>';
								content += '<li>Sold: ' + data.products[i].stats.monthly_average.sales + '</li>';
								content += '</ul>';

							}
						}

						$("#detail .scroll").append(content);

			 		} else {

				 		$("#products ul").empty();

						$.each( data.products, function(i, product){
						  	content = '<li class="arrow"><a href="#detail" data-endpoint="products" data-storage="products" data-type="detail" data-id="' + product.info.id + '">' + product.info.title + '</a></li>';

						  	$("#products ul").append(content);
						});

					}

			 	break;
			 	case 'customers':

			 		if ( type == 'detail' ) {

			 			$("#detail .scroll").empty();

			 			for ( var i = 0; i < data.customers.length; i++ ) {

						  		if( data.customers[i].info.id == id ) {

										content = '<ul>';
										content += '<li>' + data.customers[i].info.display_name + '</li>';
										content += '<li>Username: ' + data.customers[i].info.username + '</li>';
										content += '<li class="arrow"><a href="mailto:' + data.customers[i].info.email + '?subject=' + site_url + '">' + data.customers[i].info.email + '</a></li>';
										content += '<li>Downloads: ' + data.customers[i].stats.total_downloads + '</li>';
										content += '<li>Purchases: ' + data.customers[i].stats.total_purchases + '</li>';
										content += '<li>Total Spent: $' + data.customers[i].stats.total_spent + '</li>';
										content += '</ul>';

						  		}
						}

						$("#detail .scroll").append(content);


			 		} else {

			 			$("#customers ul").empty();

						 $.each( data.customers, function(i, customer){
						  	content = '<li class="arrow"><a href="#detail" data-endpoint="customers" data-storage="customers" data-type="detail" data-id="' + customer.info.id + '">' + customer.info.display_name + '</a></li>';


						  	$("#customers ul").append(content);
						 });

					}

			 	break;
			 	case 'stats-earnings':

			 		$("#detail .scroll").empty();

					content = '<h2>Earnings</h2>';
					content += '<ul>';
					content += '<li>Current Month: $' + data.earnings.current_month + '</li>';
					content += '<li>Last Month: $' + data.earnings.last_month + '</li>';
					content += '<li>Total: $' + data.earnings.totals + '</li>';
					content += '</ul>';


					//content += '<h2>Date Range</h2>';
					//content += '<ul><li>From: <input id="date" type="date" value"" /></li>';
					//content += '<li>To: <input id="date" type="date" value"" /></li></ul>';

					//content += '<div class="actionButton gray">Filter</div>';


					$("#detail .scroll").append(content);


				break;
				case 'stats-sales':

					$("#detail .scroll").empty();

				 	content = '<h2>Sales</h2>';
				 	content += '<ul>';
					content += '<li>Current Month: ' + data.sales.current_month + '</li>';
					content += '<li>Last Month: ' + data.sales.last_month + '</li>';
					content += '<li>Total: ' + data.sales.totals + '</li>';
					content += '</ul>';

					//content += '<h2>Date Range</h2>';
					//content += '<ul><li>From: <input id="date" type="date" value"" /></li>';
					//content += '<li>To: <input id="date" type="date" value"" /></li></ul>';

					//content += '<div class="actionButton gray">Filter</div>';

					$("#detail .scroll").append(content);

			 	break;
			 	case 'sales':

			 		if ( type == 'detail' ) {

				 		$("#detail .scroll").empty();

					  	for ( var i = 0; i < data.sales.length; i++ ) {

						  		if( data.sales[i].ID == id ) {

										content = '<ul>';
										content += '<li>Order #' + data.sales[i].ID + '</li>';
										content += '<li class="arrow"><a href="mailto:' + data.sales[i].email + '?subject=' + site_url + '">' + data.sales[i].email + '</a></li>';
										content += '<li>' + data.sales[i].date + '</li>';
										content += '</ul>';

										content += '<h2>Products</h2>';

										content += '<ul>';
									 	for ( var r = 0; r < data.sales[i].products.length; r++ ) {
									 		content += '<li>' + data.sales[i].products[r].name + '</li>';
									 	}
									 	content += '</ul>';

								}

						}

						$("#detail .scroll").append( content );

			 		} else {

			 			$("#sales ul").empty();

						 $.each( data.sales, function(i, sale){

						 	content = '<li class="arrow"><a href="#detail" data-endpoint="sales" data-storage="sales" data-type="detail" data-id="' + sale.ID + '">Order #' + sale.ID + '<em>' + sale.date + '</em></a></li>';

						  	$("#sales ul").append(content);
						 });
					 }

			 	break;
		 	} // end switch

		 		setTimeout(function(){
					  	myScroll.refresh();
				}, 500);
	  }

}); //end ready func