
<div class="contentWrap indexPage">
  <div class="sectionBlock loginFormBlock">
    <div class="loginBlock">
      <div class="loginBlockInner"><?php if(isset($error)){ ?>
        <p class="errorMeesage"><?php echo $error; ?>
        </p><?php } ?><?php echo Form::open(); ?>
        <dl class="formFrame">
          <dt>ユーザーIDもしくはメールアドレス</dt>
          <dd><?php echo Form::input('id',Input::post('id'),array('required'=>'required','type'=>'text',)); ?>
          </dd>
        </dl>
        <dl class="formFrame">
          <dt>パスワード</dt>
          <dd><?php echo Form::input('password',Input::post('password'),array('required'=>'required','type'=>'password',)); ?>
          </dd>
        </dl>
        <div class="buttonWrap">
          <label for="loginSubmit" class="submitBase primary">ログイン<?php echo Form::submit('submit_btn', 'ログイン',array('id'=>'loginSubmit')); ?>
          </label>
        </div><?php echo Form::close(); ?>
      </div>
    </div>
    <div class="registBlock">
      <div class="registBlockInner">
        <p><a href="newregist/" class="linkButtonBase newRegist">新規登録</a></p>
      </div>
    </div>
  </div>
  <div class="sectionBlock toSearchBlock">
    <p><a href="search/" class="linkButtonBase toSearch">検索 </a></p>
  </div>
</div>