<?php
require_once ('./classes/Page.php');
$maPage = new Page();

$maPage->setTitre('Nourou Darayni');

$maPage->addMetaItem('description', 'nourou darayni web');
$maPage->addMetaItem('auteur', 'moussa thimbo');

$maPage->addCss('./styles/style.css');
$maPage->addCss('./includes/playlists/playlist_styles.css');
$maPage->addCss('http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css');
$maPage->addCss('./styles/menu.css');
$maPage->addCss('./includes/calendrier/css/eventCalendar.css');
$maPage->addCss('./includes/calendrier/css/eventCalendar_theme_responsive.css');
$maPage->addCss('styles/diapo_style.css');
$maPage->addCss('./pages/dahira/contact/contact.css');

$maPage->addJs('./scripts/utils.js');
$maPage->addJs("http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js");
$maPage->addJs('./scripts/cufon-yui.js');
$maPage->addJs('./scripts/Bebas_400.font.js');
$maPage->addJs('./scripts/jquery.tools.min.js');
$maPage->addJs('scripts/jquery.jDiaporama.js');
$maPage->addJs('./pages/dahira/contact/scripts/gen_validatorv31.js');
$maPage->addJs('http://connect.facebook.net/en_US/all.js#xfbml=1');
$maPage->addJs('http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js');
$maPage->addJs('./scripts/jquery.youtubepopup.min.js');
$maPage->addJs('./scripts/login.js');
$maPage->addJs('./scripts/history.js');

$maPage->setContent('./includes/home.php');
$maPage->setHeader('./includes/header.php');
$maPage->setSideBar('./includes/sidebar.php');
$maPage->setFooter('./includes/footer.php');

$maPage->afficherPage();