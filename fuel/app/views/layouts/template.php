<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?>| GITADORA SKILL SIMULATOR
    </title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:image" content="">
    <meta property="og:title" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:site_name" content="">
    <meta property="fb:app_id" content="">
    <meta property="og:description" content="">
    <link rel="canonical" href=""><?php echo Asset::css('default.css'); ?><?php echo Asset::js('lib/underscore-min.js'); ?><?php echo Asset::js('lib/underscore-min.map'); ?><?php echo Asset::js('lib/jquery.min.js'); ?><?php echo Asset::js('lib/jquery.min.map'); ?><?php echo Asset::js('lib/jquery.cookie.js'); ?><?php echo Asset::js('lib/backbone.js'); ?><?php echo Asset::js('view/common.js'); ?>
  </head>
  <body>
    <div class="headerOuter"><?php echo $header; ?>
    </div>
    <div class="contentOuter"><?php echo $content; ?>
    </div>
    <div class="footerOuter"><?php echo $footer; ?>
    </div>
  </body>
</html>