<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title><?php echo _x( 'EDD Mobile', 'Translators: HTML head title', 'edd-mobile' ); ?></title>

		<link rel="apple-touch-icon-precomposed" href="<?php echo plugins_url(); ?>/edd-mobile/themes/img/icon.png" />

		<link href="<?php echo plugins_url(); ?>/edd-mobile/themes/img/startup.png" media="(device-width: 320px)" rel="apple-touch-startup-image">

		<link href="<?php echo plugins_url(); ?>/edd-mobile/themes/img/startup@2x.png" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">

		<link href="<?php echo plugins_url(); ?>/edd-mobile/themes/img/startup@5.png" sizes="640x1136" media="(device-height: 568px)" rel="apple-touch-startup-image">

		<link rel="stylesheet" href="<?php echo plugins_url(); ?>/edd-mobile/themes/css/ios.css" title="jQTouch">

		<script src="<?php echo plugins_url(); ?>/edd-mobile/themes/src/lib/jquery-1.7.min.js" type="application/x-javascript" charset="utf-8"></script>
		<script src="<?php echo plugins_url(); ?>/edd-mobile/themes/src/lib/jqtouch.min.js" type="text/javascript" charset="utf-8"></script>

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
				//useFastTouch: false
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
						 <h1><?php echo _x( 'EDD Mobile', 'Translators: Site headline', 'edd-mobile' ); ?></h1>
					 </div>
					<ul class="rounded">
						<li class="arrow"><a href="#stats"><?php _e( 'Stats', 'edd-mobile' ); ?></a></li>
						<li class="arrow data"><a href="#products" data-endpoint="products" data-storage="products"><?php _e( 'Products', 'edd-mobile' ); ?></a></li>
						<li class="arrow data"><a href="#customers" data-endpoint="customers" data-storage="customers"><?php _e( 'Customers', 'edd-mobile' ); ?></a></li>
						<li class="arrow data"><a href="#sales" data-endpoint="sales" data-storage="sales"><?php _e( 'Sales', 'edd-mobile' ); ?></a></li>
					</ul>
				 </div>

				 <div id="detail">
					 <div class="toolbar">
						 <h1><?php _e( 'EDD Mobile', 'edd-mobile' ); ?></h1>
						 <a href="#" class="back"></a>
					 </div>
					 <div class="scroll">
					 </div>
				 </div>

				 <div id="stats">
					 <div class="toolbar">
						 <h1><?php _e( 'EDD Stats', 'edd-mobile' ); ?></h1>
						 <a href="#" class="back"></a>
					 </div>
					<ul class="rounded">
						<li class="arrow data no-cache"><a href="#detail" data-endpoint="stats" data-type="earnings" data-storage="stats-earnings"><?php _e( 'Earnings', 'edd-mobile' ); ?></a></li>
						<li class="arrow data no-cache"><a href="#detail" data-endpoint="stats" data-type="sales" data-storage="stats-sales"><?php _e( 'Sales', 'edd-mobile' ); ?></a></li>
					 </ul>
				 </div>

				 <div id="products" class="list">
					 <div class="toolbar">
						 <h1><?php _e( 'EDD Products', 'edd-mobile' ); ?></h1>
						 <a href="#" class="back"></a>
							<a href="#" class="reloadButton"><div class="reload"></div></a>
					 </div>
					 <ul class="edgetoedge">
					 </ul>
				 </div>

				 <div id="customers" class="list">
					 <div class="toolbar">
						 <h1><?php _e( 'EDD Customers', 'edd-mobile' ); ?></h1>
						 <a href="#" class="back"></a>
						 <a href="#" class="reloadButton"><div class="reload"></div></a>
					 </div>
					 <ul class="edgetoedge">
					 </ul>
				 </div>

				 <div id="sales" class="list">
					 <div class="toolbar">
						 <h1><?php _e( 'EDD Sales', 'edd-mobile' ); ?></h1>
						 <a href="#" class="back"></a>
							<a href="#" class="reloadButton"><div class="reload"></div></a>
					 </div>
					 <ul class="metal">
					 </ul>
				 </div>

			<?php else : ?>

				 <div id="login" class="current">
					 <div class="toolbar">
						 <h1><?php _e( 'EDD Mobile', 'edd-mobile' ); ?></h1>
					 </div>
					 <form id="login-form" class="edit" action="" method="post">
						 <ul class="rounded">
						 	<li><input type="text" id="edd_mobile_user_login" name="edd_mobile_user_login" placeholder="<?php echo _x( 'Username', 'Translators: placeholder name', 'edd-mobile' ); ?>" id="usr" value="" /></li>
						 	<li><input type="password" id="edd_mobile_user_pass" name="edd_mobile_user_pass" value="" placeholder="<?php echo _x( 'Password', 'Translators: placeholder name', 'edd-mobile' ); ?>" id="pwd" value="" /></li>
						 </ul>
						 <input name="rememberme" type="hidden" id="sidebar-rememberme" value="forever"/>
						 <input type="submit" id="login-submit" name="wp-submit" class="actionButton gray submit" value="<?php _e( 'Log In', 'edd-mobile' ); ?>"/>

						 <input type="hidden" id="edd_mobile_action" name="edd_mobile_action" value="login"/>
						 <input type="hidden" id="edd_mobile_admin_ajax" name="edd_mobile_admin_ajax" value="<?php echo get_bloginfo('url'); ?>/wp-admin/admin-ajax.php"/>
						 <input type="hidden" id="edd_mobile_login_nonce" name="edd_mobile_login_nonce" value="<?php echo wp_create_nonce( 'edd_mobile_login_nonce' ); ?>"/>
					 </form>
				 </div>

			<?php endif; ?>

		</div>
	</body>
</html>