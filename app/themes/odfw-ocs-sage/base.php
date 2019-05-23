<?php

use Roots\Sage\Config;
use Roots\Sage\Wrapper;

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
<?php
do_action('get_header');
get_template_part('templates/header');
?>
  <div class="wrap container-fluid" role="document">
    <div class="content row">

      <aside class="sidebar" role="complementary">
        <?php include Wrapper\sidebar_path(); ?>
      </aside><!-- /.sidebar -->

      <main class="main" role="main">
        <?php
        if ( is_page('22') ):
          get_template_part('templates/home', 'page');
        endif
        ?>
        <div class="main-content" id="mainContent" tabindex="-1">
          <?php include Wrapper\template_path(); ?>
        </div>
        <?php if (Config\display_sidebar()) : ?>
          <aside class="inner-sidebar sidebar">
            <?php get_template_part('templates/nav-inner'); ?>
          </aside>
        <?php endif; ?>
      </main><!-- /.main -->
    </div><!-- /.content -->
  </div><!-- /.wrap -->
<?php
do_action('get_footer');
get_template_part('templates/footer');
wp_footer();
?>

  </body>
</html>
