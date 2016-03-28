<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>
<header id="masthead" role="banner" class="<?php //print $navbar_classes; ?> site-header header sticky">
	<div id="header-container">
		<div id="navigation" class="container">
			<div class="row">
                <div class="col-xs-6 col-sm-3">
				  <?php if (!empty($page['header'])): ?>
					<?php print render($page['header']); ?>
				  <?php endif; ?>
				  <?php if (!empty($site_name)): ?>
					<a class="name navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a>
				  <?php endif; ?>
				</div>
				<div class="col-sm-9">

					<div class="navbar-header">
					
						<?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
								<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								  <span class="sr-only">Toggle navigation</span>
								  <span class="icon-bar"></span>
								  <span class="icon-bar"></span>
								  <span class="icon-bar"></span>
								</button>
						  <div class="navbar-collapse collapse">
							<nav role="navigation" class = "navbar navbar-default">
							  <?php if (!empty($page['navigation'])): ?>
								<?php print render($page['navigation']); ?>
							  <?php endif; ?>
							</nav>
						  </div>
						<?php endif; ?>
					</div>
				
			    </div><!-- /col-sm-9-->

			</div><!-- /row -->   
	   </div >  
   </div>
</header>


<!-- MAIN CONTAINER -->

<!-- typically we use the $is-front variable, but this is a subsite.  So find something in the page to show us if it is the kultrun home page -->
<?php if (strpos (substr ( $variables['page']['content']['system_main']['content']['#markup'] , 0 ,200 ),"kultrun-home-page") > 0): ?>
<div class="main-container container-fluid">
<?php else: ?>
<div class="main-container container">
<?php endif; ?>


  <div class="row">

    <?php if (!empty($page['sidebar_first'])): ?>
      <aside class="col-sm-3" role="complementary">
        <?php print render($page['sidebar_first']); ?>
      </aside>  <!-- /#sidebar-first -->
    <?php endif; ?>

    <section<?php print $content_column_class; ?>>
      <?php if (!empty($page['highlighted'])): ?>
        <div class="highlighted"><?php print render($page['highlighted']); ?></div>
      <?php endif; ?>

      <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
      <a id="main-content"></a>
      <?php print render($title_prefix); ?>
      <?php if (!empty($title)): ?>
        <div class="page-header-image"><h1 class="page-header"><?php print $title; ?></h1></div>
      <?php endif; ?>
      <?php print render($title_suffix); ?>
      <?php print $messages; ?>
      <?php if (!empty($tabs)): ?>
        <?php print render($tabs); ?>
      <?php endif; ?>
      <?php if (!empty($page['help'])): ?>
        <?php print render($page['help']); ?>
      <?php endif; ?>
      <?php if (!empty($action_links)): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>
      <?php print render($page['content']); ?>

<!-- Social and Search MOBILE : Should be converted to Block(s) -->
    <div class="row visible-xs-block hidden-sm hidden-md hidden-lg">
      <div class="bottom-social col-sm-10 col-sm-offset-1">

          <a class="btn btn-social btn-facebook" href="http://www.facebook.com/#!/pages/Waterloo-ON/Neruda-Productions/23975042636" title="Join Us on Facebook!"><span class="fa fa-facebook-square"></span></a>

          <a class="btn btn-social btn-twitter" href="https://twitter.com/NerudaArts" title="Follow Us on Twitter!"><span class="fa fa-twitter-square"></span></a>
        
          <a class="btn btn-social btn-instagram" href="http://instagram.com/nerudaarts.ca/" title="Get the picture on Instagram!"><span class="fa fa-instagram"></span></a>

          <a class="btn btn-social btn-youtube" href="http://www.youtube.com/user/nerudaarts" title="Watch + Listen on Youtube!"><span class="fa fa-youtube-play"></span></a>
        
          <a class="btn btn-social btn-rss" href="http://www.nerudaarts.ca/feed" title="Old School News via our RSS Feed!"><span class="fa fa-rss-square"></span></a>

        <div class="btn-group">
          <button type="button" class="btn btn-social dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <span class="fa fa-calendar"></span>
            <span class="caret caret-social"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li><a class="link-ical" href="http://nerudaarts.ca/calendar/ical" title="Add to ical">add to iCal</a></li>
            <li><a class="link-gcal" href="http://www.google.com/calendar/render?cid=http%3A%2F%2Fnerudaarts.ca%2Fcalendar%2Frss" title="Add to Google Calendar">remind with google calendar</a></li>
          </ul>
        </div>

        <a class="btn btn-social btn-gs" href="http://grandsocial.ca/people/50aaa3f28e91cdfb4700030a" title="Get Social on Grand Social!"><span class="icon icon-grandsocial">GS</span></a>   

      </div><!-- /bottom-social -->

      <div class="col-sm-10 col-sm-offset-1">
        
        <?php $block = module_invoke('search', 'block_view');
          print render($block['content']);
          ?>
      </div>
    </div><!-- End of SOCIAL MEDIA and SEARCH MOBILE -->

    </section>

    <?php if (!empty($page['sidebar_second'])): ?>
      <aside class="col-sm-3" role="complementary">
        <?php print render($page['sidebar_second']); ?>
      </aside>  <!-- /#sidebar-second -->
    <?php endif; ?>

  </div>
</div>
<footer class="footer container-fluid">
  <div >

      <div >
        <div class="col-md-4"><?php print render($page['footer1']); ?></div>
        <div class="col-md-4"><?php print render($page['footer2']); ?></div>
        <div class="col-md-4"><?php print render($page['footer3']); ?></div>
      </div>
  </div>
</footer>
