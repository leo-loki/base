<?php
$blog_name = get_bloginfo( 'name', 'display' );
$description = get_bloginfo( 'description', 'display' );
$favicon_url = get_site_icon_url();
if($favicon_url) {
	$logo_mark_path = $favicon_url;
} else {
	$logo_mark_path = get_stylesheet_directory_uri()."/img/logo_mark.svg";
	$logo_mark_root = get_template_directory()."/img/logo_mark.svg";
}
global $login_page; global $my_page;
global $my_toggler_pos;
global $translation_engine;
$options = get_option('my_custom_options');
if ( $options['naviSide'] ) :
 $my_toggler_pos = "right";
endif;
if( $options['darkMode'] ) :
 $dark_mode = "is_dark_theme";
 if(isset($_COOKIE["DarkMode"])){ $value = $_COOKIE["DarkMode"];} else { $value = $_COOKIE["DarkMode"] = "notActive"; }
 if($value=="Active"){ $dark_mode .= " darkmode"; } else { $dark_mode .= " lightmode"; }
endif;
if( $options['srReverse'] ) :
 $scroll_delay_reverse = true;
endif;
if($_GET['navi']=="right"){ $my_toggler_pos = "right"; }
if ( have_posts() ) {
	$img_max_height = get_option('large_size_h')."px";
	$img_max_width = get_option('large_size_w')."px";
}
?><!doctype html>
<html <?php language_attributes(); ?>>
	<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-1694458-11"></script>
  <script>
   window.dataLayer = window.dataLayer || [];
   function gtag(){dataLayer.push(arguments);}
   gtag('js', new Date());
   gtag('config', 'UA-1694458-11');
  </script>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
		<?php wp_head(); ?>
		<?php if($img_max_height){ ?>
		<style type="text/css">
			@media only screen and ( min-height: <?=$img_max_height?>){
				.site_main .page_content figure,
				.site_main .entry_content figure { max-height: <?=$img_max_height?>; }
			}
		</style>
		<?php } ?>
	</head>
	<body <?php body_class($dark_mode); ?>>
		<div id="wrap" data-position="<?=$my_toggler_pos?>" class="<?php if( is_home() || is_front_page()){ echo "home"; }else{ echo "site"; } ?>">
		<header id="site-header" class="sticky admin_bar_relation">
			<div class="site_branding">
					<?php if ( has_custom_logo() ){ ?>
					<h1 class="site_logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?=$blog_name?>"><?php the_custom_logo(); ?></a>
					</h1>
					<?php } else { ?>
				<div class="site_title">
					<?php if ( is_file($logo_mark_root) || ($favicon_url) ) : ?>
					<div class="logo_mark">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?=$blog_name?>">
							<img src="<?=$logo_mark_path?>" width="48" height="48" alt="<?=$blog_name?>">
						</a>
					</div>
					<?php endif; ?>
					<h1 class="site_name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?=$blog_name?></a></h1>
					<?php if ( $description && get_theme_mod( 'display_title_and_tagline', true ) === true ) : ?>
				</div><!-- .site_name -->
				<p class="site_description">
					<?php echo $description; ?>
				</p>
				<?php endif; ?>
				<?php } ?>
			</div><!-- .site_branding -->
			<div class="header_navi_menu_wrap">
				<input type="checkbox" id="toggle-checkbox">
				<label for="toggle-checkbox" id="drawer-cover"></label>
				<label for="toggle-checkbox" id="checkarea" class="admin_bar_relation">
					<span id="toggle"><span></span></span>
					<span class="toggle_sub_txt"></span>
				</label>
				<div class="main_navi_menu">
					<nav class="main_navi_wrap admin_bar_relation">
      <?php if( is_active_sidebar( 'custom-widget1' )): ?>
						<?php dynamic_sidebar('custom-widget1'); ?>
      <?php endif; ?>
						<?php if( is_user_logged_in()) { ?>
						<ul class="member_navi_menu">
							<li><a href="<?php echo esc_url( home_url( '/' ) ).$my_page; ?>" title="マイページ" class="icon icon-profile">マイページ</a></li>
							<li><a href="<?php echo wp_logout_url(home_url()); ?>" title="ログアウト" class="icon icon-exit">ログアウト</a></li>
						</ul>
						<?php } else { ?>
						<ul class="member_navi_menu">
							<li><a href="<?php echo esc_url( home_url( '/' ) ).$login_page; ?>" title="ログイン" class="icon icon-enter">ログイン</a></li>
						</ul>
						<?php } ?>
					</nav>
				</div>
			</div>
		</header><!-- #site-header -->
		<main id="main" class="site_main" role="main">
<?php
if ( have_posts() ) { ?>
			<section class="container">
<?php // Load posts loop.
 while ( have_posts() ) {
  the_post(); ?>
			<?php if ( ! is_front_page() && ! is_home() ): ?>
				<article>
			<?php if(get_thumb_img('full')){ ?>
			<header class="entry_header has_thumbnail">
				<figure class="thumb">
					<?php $alt = the_title('','',false); echo ''.get_thumb_img('full', $alt).''; ?>
				</figure>
				<?php	} else { ?>
    <?php the_custom_header_markup(); ?>
				<header class="entry_header">
				<?php	} ?>
				<?php if ( is_singular() ) : ?>
				<?php the_title( '<h2 class="entry-title default-max-width">', '</h2>' ); ?>
				<?php else : ?>
				<?php the_title( sprintf( '<h3 class="entry-title default-max-width"><a href="%s">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
				<?php endif; ?>
				</header><!-- .entry_header -->
			<?php endif; ?>
			<div class="entry_content">
    <?php if ( is_archive() && !is_singular() ) : ?>
    <h3 class="post_date aligncenter"><?php the_time('Y.m.d') ?></h3>
    <?php endif; ?>
  <?php
  the_content();
  wp_link_pages(
   array(
    'before'   => '<nav class="page_links">',
    'after'    => '</nav>',
    /* translators: %: page number. */
    'pagelink' => esc_html__( 'Page %', $translation_engine ),
   )
  );
  ?>
				</div><!-- .entry-content -->
    <?php if ( is_single() || is_archive() ) : ?>
    <div class="entry_footer">
     <nav>
      <ul>
       <li>カテゴリー : <?php the_category(' '); ?></li>
       <?php if ( is_singular() ) : ?>
       <li>掲載者：<?php the_author(); ?></li>
       <li><?php the_time('公開日：y年m月d日 - G : i') ?><?php the_modified_date('（更新日 : y.m.d - G : i）') ?></li>
       <?php the_tags('<li>タグ：','', '</li>'); ?>
       <?php endif; ?>
      </ul>
     </nav>
    </div><!-- .entry-footer -->
    <?php endif; ?>
    </article>
     <?php if ( is_singular() ) : ?>
     <?php if( comments_open() || get_comments_number() ){ ?>
     <article id="comments-section" class="max_width">
      <?php comments_template(); ?>
      <?php /*if(have_comments()){ ?>
      <nav class="comments_list_wrap">
       <ol class="comment_list">
 <?php wp_list_comments( array(
   'avatar_size' => 60,
   'style' => 'ol',
   'short_ping' => true,
  ) ); ?>
       </ol><!-- .comment-list -->
      </nav>
      <?php }*/ ?>
      <?php /*if( comments_open() ){ ?>
      <div id="comments-form">
       <?php comment_form(); ?>
      </div>
      <?php }*/ ?>
     </article>
     <?php } ?>
     <?php endif; ?>
   <?php } //endwhile ?>
     
     <?php the_posts_pagination(
  array(
   'screen_reader_text' => ' ',
   'mid_size' => 2,
   'prev_text' => __( 'Newer', $translation_engine ),
   'next_text' => __( 'Older', $translation_engine ),
  ));
     ?>
			</section><!-- .container -->
<?php } else { ?>
	<section class="container no-results not-found">
		<header class="page_header alignwide">
			<?php if ( is_search() ) : ?>
			<h2 class="page_title">
				<?php
								printf(
									/* translators: %s: search term. */
									esc_html__( 'Results for "%s"', $translation_engine ),
									'<span class="page_description search_term">' . esc_html( get_search_query() ) . '</span>'
								);
				?>
			</h2>
			<?php else : ?>
			<h2 class="page_title"><?php esc_html_e( 'Nothing here', $translation_engine ); ?></h2>
			<?php endif; ?>
		</header><!-- .page_header -->
		<div class="page_content default-max-width">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<?php
								printf(
									'<p>' . wp_kses(
										/* translators: 1: link to WP admin new post page. */
										__( 'Ready to publish your first post? <a href="%1$s">Get started here.</a>.', $translation_engine ),
										array(
											'a' => array(
												'href' => array(),
												'target' => array()
											),
											'br' => array(),
										)
									) . '</p>',
									esc_url( admin_url( 'post-new.php' ) )
								);
			?>
			<?php elseif ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', $translation_engine ); ?></p>
			<?php get_search_form(); ?>
			<?php else : ?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', $translation_engine ); ?></p>
			<?php get_search_form(); ?>
			<?php endif; ?>
		</div><!-- .page_content -->
	</section><!-- .container.no-results -->
   <?php } ?>
		</main><!-- #main.site-main -->

   <?php if( is_active_sidebar( 'custom-widget2' )): ?>
   <section id="bottom-section">
    <?php
    /*「お知らせ」カテゴリーの一覧 */
    $newslist = get_posts( array(
     'category_name' => 'info', // 「お知らせ」カテゴリーのスラッグ
     'posts_per_page' => 5 // 表示件数
    ));
    if($newslist){
    ?>
    <div class="navi_menu">
     <h4 class="navi_menu_title">お知らせ</h4>
     <nav role="navigation" aria-label="お知らせ">
      <ul>
       <?php
       foreach( $newslist as $post ):
       setup_postdata( $post );
       ?>
       <li><?php the_time('Y-m-d'); ?> : <a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></li>
       <?php
       endforeach;
       wp_reset_postdata();
       ?>
      </ul>
     </nav>
    </div>
    <?php } ?>
    <?php dynamic_sidebar('custom-widget2'); ?>
   </section><!-- #bottom-section -->
   <?php endif; ?>
		
		<?php
		$now_year = date("Y");
		$since = 2002; // サイトの公開年。
		if($since >= $now_year){ $since = false; }
		?>
		<footer id="site-footer">
			<div class="footer_wrap">
				<div id="footer-navigation">
					<?php wp_nav_menu(
	array(
		'theme_location' => 'footer-navigation',
		'menu_class' => 'footer_navi',
		'container' => 'nav',
	));
					?>
					<?php wp_nav_menu(
	array(
		'theme_location' => 'social-links',
		'menu_class' => 'sns_navi',
		'container' => 'nav',
	));
					?>
				</div>
  <small class="copyright">&copy;&nbsp;<?php if($since){ echo $since . " - "; } echo $now_year; ?>&nbsp;<?php bloginfo('name'); ?>.</small><br>
  <?php if(is_user_logged_in()) { ?>
		<nav class="login_out">
			<ul>
				<li><a href="<?php echo wp_logout_url(get_permalink()); ?>" class="icon icon-exit">ログアウト</a></li>
			</ul>
		</nav>
  <?php } ?>
		<input type="checkbox" id="mode-change">
		<?php if ($dark_mode){ ?>
  <label for="mode-change" id="mode-change-label"></label>
		<?php } ?>
	</div>
</footer><!-- #site-footer -->

<nav id="totop" class="scroll_disp">
	<ul><li><a href="#">TOP</a></li></ul>
</nav><!-- #totop -->
<?php wp_footer(); ?>
		</div><!-- #wrap -->
			<?php
			$includeFile = get_template_directory()."/inc/sr-setup.php";
			include_once($includeFile);
			?>
	</body>
</html>
