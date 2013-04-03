<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>EDD Mobile</title>

		<link rel="apple-touch-icon-precomposed" href="<?php echo plugins_url(); ?>/edd-mobile/themes/img/icon.png" />

		<link href="<?php echo plugins_url(); ?>/edd-mobile/themes/img/startup.png" media="(device-width: 320px)" rel="apple-touch-startup-image">

		<link href="<?php echo plugins_url(); ?>/edd-mobile/themes/img/startup@2x.png" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">

 <link href="<?php echo plugins_url(); ?>/edd-mobile/themes/img/startup@5.png" sizes="640x1136" media="(device-height: 568px)" rel="apple-touch-startup-image">

		<link rel="stylesheet" href="<?php echo plugins_url(); ?>/edd-mobile/themes/css/ios.css" title="jQTouch">

		<script src="<?php echo plugins_url(); ?>/edd-mobile/themes/src/lib/jstouch.js" type="application/x-javascript" charset="utf-8"></script>
		<script src="<?php echo plugins_url(); ?>/edd-mobile/themes/src/lib/jqtouch.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo plugins_url(); ?>/edd-mobile/themes/src/lib/iscroll.js" type="text/javascript" charset="utf-8"></script>

		<?php if( is_user_logged_in() && edd_mobile_key() ) :?>
			<script type="text/javascript" charset="utf-8">

				var key = '<?php echo edd_mobile_key(); ?>';
				var token = '<?php echo edd_mobile_token(); ?>';

			</script>
		<?php endif ; ?>

		<script type="text/javascript" charset="utf-8">

			var site_url = '<?php bloginfo( 'siteurl' ); ?>';

			var endpoint = '';
			var api_url = '';
			var referrer = '';
			var cache = '';
			var dataclass = '';
			var storage = '';
			var type = '';
			var id = '';
			var datefrom = '';
			var dateto = '';
			var myScroll;

			var jQT = new $.jQTouch({
				useFastTouch: false
			});

			function loaded() {
				setTimeout(function () {
					myScroll = new iScroll('wrapper');
				}, 100);
			}
			window.addEventListener('load', loaded, false);

			document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);

		</script>

		<script src="<?php echo plugins_url(); ?>/edd-mobile/themes/src/edd-mobile.js" type="text/javascript" charset="utf-8"></script>


		 <?php edd_mobile_head(); ?>

	</head>
	<body>
		<div id="jqt">

			<?php if( is_user_logged_in() && edd_mobile_key() ) :?>

				 <div id="home" class="current">
					 <div class="toolbar">
						 <h1>EDD Mobile</h1>
					 </div>
					<ul class="rounded">
						<li class="arrow"><a href="#stats">Stats</a></li>
						<li class="arrow data"><a href="#products" data-endpoint="products" data-storage="products">Products</a></li>
						<li class="arrow data"><a href="#customers" data-endpoint="customers" data-storage="customers">Customers</a></li>
						<li class="arrow data"><a href="#sales" data-endpoint="sales" data-storage="sales">Sales</a></li>
					</ul>
				 </div>

				 <div id="detail">
					 <div class="toolbar">
						 <h1>EDD Mobile</h1>
						 <a href="#" class="back"></a>
					 </div>
					 <div class="scroll">
					 </div>
				 </div>

				 <div id="stats">
					 <div class="toolbar">
						 <h1>EDD Stats</h1>
						 <a href="#" class="back"></a>
					 </div>
					<ul class="rounded">
						<li class="arrow data no-cache"><a href="#detail" data-endpoint="stats" data-type="earnings" data-storage="stats-earnings">Earnings</a></li>
						<li class="arrow data no-cache"><a href="#detail" data-endpoint="stats" data-type="sales" data-storage="stats-sales">Sales</a></li>
					 </ul>
				 </div>

				 <div id="products" class="list">
					 <div class="toolbar">
						 <h1>EDD Products</h1>
						 <a href="#" class="back"></a>
							<a href="#" class="reloadButton"><div class="reload"></div></a>
					 </div>
					 <ul class="edgetoedge">
					 </ul>
				 </div>

				 <div id="customers" class="list">
					 <div class="toolbar">
						 <h1>EDD Customers</h1>
						 <a href="#" class="back"></a>
						 <a href="#" class="reloadButton"><div class="reload"></div></a>
					 </div>
					 <ul class="edgetoedge">
					 </ul>
				 </div>

				 <div id="sales" class="list">
					 <div class="toolbar">
						 <h1>EDD Sales</h1>
						 <a href="#" class="back"></a>
							<a href="#" class="reloadButton"><div class="reload"></div></a>
					 </div>
					 <ul class="metal">
					 </ul>
				 </div>

			<?php else : ?>

				 <div id="login" class="current">
					 <div class="toolbar">
						 <h1>EDD Mobile</h1>
					 </div>
					 <form id="login-form" class="edit" action="<?php echo site_url( 'wp-login.php'); ?>" method="post">
						 <ul class="rounded">
						 	<li><input type="text" name="log" placeholder="Username" id="usr" value="" /></li>
						 	<li><input type="password" name="pwd" value="" placeholder="Password" id="pwd" value="" /></li>
						 </ul>
						 <input name="rememberme" type="hidden" id="sidebar-rememberme" value="forever"/>
						 <input type="submit" id="login-submit" name="wp-submit" class="actionButton gray submit" value="Log In"/>
						 <input type="hidden" name="testcookie" value="1" />
					 </form>
				 </div>

			<?php endif; ?>

		</div>
	</body>
</html>