
<header>
  <div class="headerWrap">
    <div class="logoWrap"><a href="/">
        <h1>GITADORA スキルシミュレーター α</h1></a>
      <p>このページはGITADORAのスキルを管理するスキルシミュレーターです。</p>
    </div><?php if(Auth::get_screen_name()){ ?>
    <div class="loginInfo"> <?php echo 'ユーザー名'; ?>
    </div><?php } ?>
  </div>
</header>