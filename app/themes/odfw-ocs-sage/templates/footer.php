<footer class="content-info" role="contentinfo">

  <div class="container-fluid">
    <?php dynamic_sidebar('sidebar-footer'); ?>
  </div>

  <?php
	$GA_account = (!defined('WP_ENV') || WP_ENV === 'production') && !current_user_can('manage_options')
		? ocs_get_option('ocs-ga-account-production') //"UA-73552793-1"  //production
		: ocs_get_option('ocs-ga-account-development'); // "UA-73552793-2" //development
	?>
	<script>
		window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
		ga('create','<?=$GA_account; ?>','auto');ga('send','pageview')
	</script>
	<script src="https://www.google-analytics.com/analytics.js" async defer></script>

</footer>
