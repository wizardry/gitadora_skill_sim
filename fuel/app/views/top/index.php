
<div class="contentWrap indexPage">
  <div class="sectionBlock loginFormBlock">
    <div class="loginBlock">
      <div class="loginBlockInner"><?php echo Form::open(); ?>
        <dl class="formFrame">
          <dt>ユーザーID</dt>
          <dd><?php echo Form::input('userid',Input::post('userid'),array('required'=>'required','type'=>'text',)); ?>
          </dd>
        </dl>
        <dl class="formFrame">
          <dt>パスワード</dt>
          <dd><?php echo Form::input('password',Input::post('password'),array('required'=>'required','type'=>'password',)); ?>
          </dd>
        </dl>
        <div class="buttonWrap">
          <label for="loginSubmit" class="submitBase default"><?php echo Form::submit('submit_btn', 'ログイン',array('id'=>'loginSubmit')); ?>
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
<div class="testWrap">
  <h1>helloWorld</h1><?php Debug::$js_toggle_open = true; ?><?php Debug::dump($query); ?><?php Debug::dump($res1); ?>
  <div class="registBlock">
    <form method="POST"><?php echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
      <table>
        <tr>
          <th>ユーザー名</th>
          <td><?php echo Form::input('username',Input::post('username'),array('required'=>'required','type'=>'text',)); ?><sup>英数字8文字以内</sup>
          </td>
        </tr>
        <tr>
          <th>パスワード</th>
          <td><?php echo Form::input('password',Input::post('password'),array('required'=>'required','type'=>'text',)); ?><sup>英数字15文字以内</sup>
          </td>
        </tr>
        <tr>
          <th>パスワード（確認）</th>
          <td><?php echo Form::input('password',Input::post('password'),array('required'=>'required','type'=>'text',)); ?><sup>英数字15文字以内</sup>
          </td>
        </tr>
        <tr>
          <th>メールアドレス</th>
          <td><?php echo Form::input('email',Input::post('email'),array('required'=>'required','type'=>'text',)); ?>
          </td>
        </tr>
      </table>
      <div class="buttonWrap">
        <label for="registSubmit" class="btnBase submitButton">送信<?php echo Form::submit('submit_btn', '送信',array('id'=>'registSubmit')); ?>
        </label>
      </div>
    </form>
  </div>
</div>