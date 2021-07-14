<?php
//
/* ##### Custom functions ##### */
/***** plain2021b *****/
/**
##### Global variables. #####
*/
function gb_vars() {
	global $now_stmp; global $now; global $this_timezone;
	global $domain;
	global $my_toggler_pos;
	global $login_page; global $my_page;
	global $translation_engine;
	$my_now_stmp = time();
	$my_now_date = date("Ymd");
	$domain = $_SERVER['HTTP_HOST'];
	$my_toggler_pos = "left";
	$login_page = "mypage";
	$my_page = "mypage"; // Default is the dashboard profile "wp-admin/profile.php". If there is a profile page, change it to slug.
 $translation_engine = 'iruya';
}
add_action( 'after_setup_theme', 'gb_vars' );
//
global $tos_link;
$tos_link = "https://de-sign.work/?page_id=1458";// Terms of Service page ("false" if not available)
/* ##### end of Global variables. ##### */
/**
##### Remove unnecessary WP output code. #####
*/
// Removed meta tag that outputs WP version.
remove_action( 'wp_head', 'wp_generator' );
// Remove unnecessary code for printing.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
// Remove OEmbed.
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
// Remove Wp-json.
remove_action( 'wp_head', 'rest_output_link_wp_head' );
// Remove EditURI.
remove_action( 'wp_head', 'rsd_link' );
// Remove Wlwmanifest.
remove_action( 'wp_head', 'wlwmanifest_link' );
// Remove Rel link.
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
// Remove Canonical.
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
//
/** -----------------------------------------------------------
 *
 * Remove DNS prefetch.
 *
 * @param string $hints Description.
 * @param string $relation_type .
 * @return $hints
 * -----------------------------------------------------------*/
function remove_dns_prefetch( $hints, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		return array_diff( wp_dependencies_unique_hosts(), $hints );
	}
	return $hints;
}
// Removed DNS prefetch code insert.
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );
// Pause Gutenberg style loading. (load the latest version later) 
function remove_block_library_style() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'remove_block_library_style' );
// Delete image attributes.
function remove_image_attribute( $html ){
	$html = preg_replace( '/(width|height)="\d*"\s/', '', $html );
	$html = preg_replace( '/class=[\'"]([^\'"]+)[\'"]/i', '', $html );
	$html = preg_replace( '/title=[\'"]([^\'"]+)[\'"]/i', '', $html );
	$html = preg_replace( '/<a href=".+">/', '', $html );
	$html = preg_replace( '/<\/a>/', '', $html );
	return $html;
}
add_filter( 'image_send_to_editor', 'remove_image_attribute', 10 );
add_filter( 'post_thumbnail_html', 'remove_image_attribute', 10 );
// Deleted the version "?ver = ..." query automatically given by WordPress.
function remove_wp_ver_css_js( $src ) {
	/* if(strpos($src, 'ver=')) *Conditional branch to delete all version queries. */
	if(strpos($src, 'ver=' . get_bloginfo( 'version' ))) /**Conditional branch to delete only WP version. */
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'remove_wp_ver_css_js', 9999 );
// Adjust category title.
function add_parent_archive_title($title){
 if(is_category()){
  return get_category_parents(get_query_var('cat'),false,' - ');
 }
 return $title;
}
add_filter('get_the_archive_title','add_parent_archive_title');
/* ##### end of Remove. ##### */
/**
##### add Script & Style #####
*/
function theme_enqueue_styles() {
	// Enqueue - html5 shiv. ( for IE )
	wp_enqueue_script( 'custom-html5', get_stylesheet_directory_uri() . '/js/html5shiv.js', array(), '3.7.3' );
	wp_script_add_data( 'custom-html5', 'conditional', 'lt IE 9' );
	// Removed jquery that WordPress reads by default.
	wp_deregister_script('jquery');
	// Enqueue - jQuery.
	//wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-1.12.4.min.js', "", "1.12.4", false );
	wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-3.5.1.min.js', "", "3.5.1", false );
	// Enqueue - jQuery cookie library.
	wp_enqueue_script( 'cookie-jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js', array(),"1.4.1" );
	// Enqueue - Custom script.
	wp_enqueue_script( 'smart-script', get_stylesheet_directory_uri() . '/js/script.js', array(), '1.0.1' );
	// Enqueue - Dark mode script.
	wp_enqueue_script( 'darkmode-script', get_stylesheet_directory_uri() . '/js/dm.js', array(), '1.0.1' );
	// Enqueue - Object-fit for IE and Edge script.
	wp_enqueue_script( 'objrctfit-ie', get_stylesheet_directory_uri() . '/js/ofi.min.js', array(), '3.2.4' );
 //
 function nxw_setup_theme() {
  add_theme_support( 'wp-block-styles' );
 }
 add_action( 'after_setup_theme', 'nxw_setup_theme' );
 /* Enqueue - wp-block-styles
 function nxw_setup_theme() {
  add_theme_support( 'wp-block-styles' );
 }
 add_action( 'after_setup_theme', 'nxw_setup_theme' ); */
	// Enqueue - Gutenberg style.
 wp_enqueue_style( 'editor-style', get_stylesheet_directory_uri() . '/css/block-editor.min.css?var=5.6.1');
 // Enqueue - Custom style.
 wp_enqueue_style( 'parent-style', get_stylesheet_directory_uri() . '/style.css' );
 //wp_enqueue_style( 'editor-style', get_stylesheet_directory_uri() . '/css/editor-style.min.css?var=5.6.1');
 //wp_enqueue_style( 'editor-theme', get_stylesheet_directory_uri() . '/css/editor-theme.min.css?var=5.6.1');
 //wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
 //wp_enqueue_style( 'custom-editor', get_stylesheet_directory_uri() . '/custom-editor.css');
/* ##### end of Add. ##### */
/**
##### Specific processing. #####
*/
// Add Swiper script & CSS on top page.
 if(is_home() || is_front_page()){
  wp_enqueue_style( 'slide-style', '//cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.11/swiper-bundle.min.css', array('custom-editor'));
  wp_enqueue_script( 'slide-script', '//cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.11/swiper-bundle.min.js', false );
 }
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
// Delaying loading by adding the "loading =" lazy "" attribute in an iframe be other than YouTube.
function oEmbed_iframe_lazyload($tag){
	if(strpos($tag, 'iframe') !== false){
		$tag = preg_replace('/iframe /', 'iframe loading="lazy" ', $tag);
	}
	return $tag;
}
add_filter('embed_oembed_html', 'oEmbed_iframe_lazyload');
// Add original style to editor.
function custom_block_editor_css(){
 add_theme_support( 'editor-styles' ); // This one line is necessary.
 add_editor_style( '/css/custom-editor.css' ); // To specify the path to the file prepared to theme folder.
}
add_action( 'after_setup_theme', 'custom_block_editor_css' );
/* ##### end of Specific processing. ##### */
/**
##### カスタマイズ項目の追加（全般）#####
*/
// titleタグの出力
add_theme_support( 'title-tag' );
function wp_title_spacer( $spacer ) {
	$spacer = ' | ';
	return $spacer;
}
add_filter( 'document_title_separator', 'wp_title_spacer' );
/* トップページスライダー調整ファイルの読込
 function prefix_add_footer_styles() {
  if(is_home() || is_front_page()){
   wp_enqueue_script( 'slide-setup', get_stylesheet_directory_uri() . '/js/slide-setup.js', array(), '1.0.1' );
  }
 };
 add_action( 'wp_footer', 'prefix_add_footer_styles' ); */
//
// カスタムロゴ機能を使用
add_theme_support('custom-logo');
// HTML5対応
add_theme_support(
 'html5',
 array(
  'search-form',
  'comment-form',
  'comment-list',
  'gallery',
  'caption',
  'style',
  'script',
  'navigation-widgets',
 )
);
//
// カスタムヘッダー画像を使用
add_theme_support('custom-header');
//
// カスタム背景を使用
/*$wp_customize->add_setting( 'add_navigation_bg_color_header', array(
 'default' => '#ffffff',
 'sanitize_callback' => 'sanitize_hex_color',
 'transport' => 'postMessage'
));
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'add_navigation_bg_color_header', array(
 'label'                 => esc_attr__( 'Navigation Background Color', 'paperio' ),
 'section'               => 'add_navigation_section',
 'settings'                      => 'add_navigation_bg_color_header',
)));*/
$custom_background_defaults = array(
 'default-image' => get_bloginfo('template_url') . '/img/login-bg.jpg',
 'wp-head-callback'       => '_custom_background_cb'
);
//$custom_background_defaults = array($wp_customize);
add_theme_support( 'custom-background', $custom_background_defaults );
//
// ナビゲーションメニューの有効化
function navi_disp_setup() {
	register_nav_menus( array(
		'header-navigation' => 'Header Navigation',
		'footer-navigation' => 'Footer Navigation',
		'social-links'      => 'Social Links',
	));
}
add_action( 'after_setup_theme', 'navi_disp_setup' );
// ウィジェットエリアの追加
$sidebars = array(1, 2, 3);
foreach($sidebars as $number) {
	register_sidebar(array(
		'name' => 'Custom Widget ' . $number,
		'id' => 'custom-widget' . $number,
		'class' => 'custom_widget' . $number,
		'before_widget' => '<div class="navi_menu">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="navi_menu_title">',
		'after_title' => '</h4>'
	));
}
// 投稿サムネイル（アイキャッチ画像）を有効化
add_theme_support('post-thumbnails');
// アイキャッチ画像のsrcset属性を削除
add_filter('wp_calculate_image_srcset_meta', '__return_null');
// サムネイル画像の読込（サイズ指定："thumbnail", "medium", "large", "full"）
function get_thumb_img($size = 'full', $alt = null){
	$thumb_id = get_post_thumbnail_id();
	$thumb_img = wp_get_attachment_image_src($thumb_id, $size);
	$thumb_src = $thumb_img[0];
	$alt = ($alt) ? $alt : get_the_title();
	if($thumb_id){
		return '<img src="'.$thumb_src.'" alt="'.$alt.'">';
	} else { return false; }
}
// エディタでの幅広・全幅の切替対応
add_theme_support( 'align-wide' );
// タイトル「保護中:」を変更
function edit_protected_word () {
	return '限定公開：%s';
}
add_filter('protected_title_format','edit_protected_word');
// タイトル「非公開:」を変更
function edit_private_word () {
	return '【非公開】%s';
}
add_filter('private_title_format','edit_private_word');
// 続きを読む（more）カスタマイズ
function change_more_link() {
	$html = '<div class="more_link"><a href="' . esc_url( get_permalink() ) . '">続きを読む...</a></div>';
	return $html;
}
add_filter( 'the_content_more_link', 'change_more_link' );
/**
カスタマイザーへの項目追加
*/
function my_customizer( $customizeArray ) {
	$customizeArray -> add_section( 'my_custom', array(
		'title'     => 'カスタムセッティング', // 項目名
		'priority'  => 200, // 優先順位'
  'description' => '「ダークモードに対応する」にチェックを入れると、色関連のカスタマイズ項目は自動調整されます。',
	));
 // toggle position [left or right](default : left)
	$customizeArray -> add_setting( 'my_custom_options[naviSide]', array(
		'default' => false,
		'type' => 'option',
		'transport' => 'refresh',
		//'transport' => 'postMessage', // 表示更新のタイミング。デフォルトは'refresh'（即時反映）
	));
	$customizeArray -> add_control( 'my_custom_options_navi', array(
		'settings' => 'my_custom_options[naviSide]', // settingのキー
		'label' => 'トグル位置を右側にする', // ラベル名
		'section' => 'my_custom', // sectionを指定
		'type' => 'checkbox', // フォームの種類を指定
	));
 // dark mode (default : light mode) 
	$customizeArray -> add_setting( 'my_custom_options[darkMode]', array(
		'default' => false,
		'type' => 'option',
		'transport' => 'refresh',
	));
	$customizeArray -> add_control( 'my_custom_options_dark', array(
		'settings' => 'my_custom_options[darkMode]', // settingのキー
		'label' => 'ダークモードに対応する', // ラベル名
		'section' => 'my_custom', // sectionを指定
		'type' => 'checkbox', // フォームの種類を指定
	));
 // Scroll Reveal reverse (default : false) 
	$customizeArray -> add_setting( 'my_custom_options[srReverse]', array(
		'default' => false,
		'type' => 'option',
		'transport' => 'refresh',
	));
	$customizeArray -> add_control( 'my_custom_options_scroll', array(
		'settings' => 'my_custom_options[srReverse]', // settingのキー
		'label' => '遅延表示を反復する', // ラベル名
		'section' => 'my_custom', // sectionを指定
		'type' => 'checkbox', // フォームの種類を指定
	));
}
add_action( 'customize_register', 'my_customizer' );
/* end of カスタマイザーへの項目追加 */
/**
コメント関連
*/
// コメント入力欄のカスタマイズ（URL欄の削除など）
function my_comment_form_customize($args) {
 $commenter = wp_get_current_commenter();
 $req = get_option( 'require_name_email' );
 $aria_req = ($req ? " aria-required='true'" : '');
 $args['author'] = '<p class="commenter">' . '<label for="commenter-name">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .'<input id="commenter-name" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
 $args['email'] = '<p class="commenter_email"><label for="commenter-email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="commenter-email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
 $args['url'] = '';
 return $args;
}
add_filter('comment_form_default_fields', 'my_comment_form_customize');
// コメント入力欄の並替え
function my_comment_form_replace($arg) {
 $comment_field = $arg['comment'];
 unset( $arg['comment'] );
 $arg['comment'] = $comment_field;
 return $arg;
}
add_filter('comment_form_fields', 'my_comment_form_replace');
// コメント欄の項目変更
function my_comment_fields_remove($defaults) {
 $defaults['title_reply'] = 'コメントはお気軽にどうぞ！';
 $defaults['comment_notes_before'] = 'ここがBEFORE';
 $defaults['comment_notes_after'] = '<p class="form-allowed-tags">上記の内容で問題なければ、下記「コメントを送信する」ボタンを押してください。</p>';
 $defaults['label_submit'] = 'コメントを送信する';
 return $defaults;
}
add_filter('comment_form_defaults', 'my_comment_fields_remove');
/* end of コメント関連 */
/* ##### end of 追加（全般）##### */
/**
##### ログイン・新規登録 #####
*/
// ログイン用CSSの追加
function custom_login_style() { ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/login.css?ver=1.0" type="text/css" media="all">
<?php }
add_action( 'login_enqueue_scripts', 'custom_login_style' );
// ログイン（管理者バー表示）時のCSS追加
function logged_custom() {
	if ( is_user_logged_in() ) : ?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/logged_in.css?ver=1.0" type="text/css" media="all">
	<?php endif;
}
add_action('wp_head', 'logged_custom');
// ログイン画面のロゴリンク先をサイトURLに変更
function custom_login_logo_url() {
  return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'custom_login_logo_url' );
// ロゴのタイトルをサイト名に変更
function custom_login_title() {
	return get_option('blogname');
}
add_filter( 'login_headertitle', 'custom_login_title');
// ユーザー名を隠す
add_filter( 'author_rewrite_rules', '__return_empty_array' );
function disable_author_archive() {
 if( $_GET['author'] || preg_match('#/author/.+#', $_SERVER['REQUEST_URI']) ){
  wp_redirect( home_url( '/404.php' ) );
  exit;
 }
}
add_action('init', 'disable_author_archive');
// ユーザー登録時の文言変更
function custom_gettext( $translated, $text, $domain ) {
	$custom_translates = array(
		'default' => array(
			'このブログに登録' => '新規登録（STAFF ONLY）',
		)
	);
	if ( isset( $custom_translates[$domain] ) ) {
		$translated = str_replace( array_keys( $custom_translates[$domain] ), $custom_translates[$domain], $translated );
	}
	return $translated;
}
add_filter( 'gettext', 'custom_gettext', 10, 3 ); // 翻訳ファイルを直さず文言変更
/* ##### end of ログイン・新規登録 ##### */
/**
##### ダッシュボード・ツールバー関連 #####
*/
// ダッシュボードウィジェット表示オプション削除
function rm_dashboard_option() {
	//remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // 概要
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // アクティビティ
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // クイックドラフト
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPress イベントとニュース
	remove_action( 'welcome_panel','wp_welcome_panel' ); // ようこそ
}
add_action('wp_dashboard_setup', 'rm_dashboard_option' );
//ダッシュボード用のCSS追加
function my_admin_style(){
    wp_enqueue_style( 'my_admin_style', get_stylesheet_directory_uri().'/css/my_admin.css' );
}
add_action( 'admin_enqueue_scripts', 'my_admin_style' );
/* ##### end of ダッシュボード・ツールバー関連 ##### */
/**
##### プラグイン関連 #####
※未使用のプラグイン項目は削除可
*/
/* WP Members */
// 利用規約（TOS）リンク
if($tos_link){
 function my_tos_link( $text ) {
  global $tos_link;
  $text = '</a><label for="tos" class="tos_label"><a href="'.$tos_link.'" target="_blank" rel="noopener">こちらの利用規約</a>に同意してチェックを入れてください。</label><a>';
  return $text;
 }
 add_filter( 'wpmem_tos_link_txt', 'my_tos_link' );
}
/* プラグインのスタイル読込を削除 */
// ※不要の場合は以下コードをすべて削除
function remove_plugins_style() {
 // ソースコードからプラグインスタイルが読込まれている<link>タグのIDを確認して以下に指定
 //（複数可／id名の末尾「...-css」は不要）
 // ※全てのプラグインスタイルの読込が削除できるわけではないのでご了承ください。
 wp_dequeue_style('contact-form-7'); //（例）Contact form7
 wp_dequeue_style('wp-members'); //（例）WP Members
 wp_dequeue_style('aioseo-admin-bar'); //（例）AIO SEO adminbar logo
 //wp_dequeue_style('yoast-seo-adminbar'); //（例）Yoast SEO adminbar logo
}
add_action( 'wp_enqueue_scripts', 'remove_plugins_style', 9999);
/* ##### end of プラグイン関連 ##### */
/*
-----------------------------------------------------
##### end of Custom functions #####
-----------------------------------------------------
*/
/* EOF */