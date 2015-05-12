
<div class="contentWrap registPage">
  <div class="sectionBlock"><?php echo Form::open(); ?><?php echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
    <dl class="formFrame">
      <dt>メールアドレス</dt>
      <dd><?php echo Form::input('email',Input::post('email'),array('required'=>'required','type'=>'text',)); ?>
      </dd>
    </dl>
    <dl class="formFrame">
      <dt>パスワード</dt>
      <dd><?php echo Form::input('password',Input::post('password'),array('required'=>'required','type'=>'text',)); ?>
      </dd>
    </dl>
    <dl class="formFrame">
      <dt>表示ネーム</dt>
      <dd><?php echo Form::input('username',Input::post('username'),array('required'=>'required','type'=>'text',)); ?>
      </dd>
    </dl>
    <div class="buttonWrap">
      <ul>
        <li>
          <label for="registSubmit" class="submitBase primary">仮登録<?php echo Form::submit('submit_btn', '仮登録',array('id'=>'registSubmit')); ?>
          </label>
        </li>
        <li>
          <p><a href="/" class="submitBase inverse">戻る</a></p>
        </li>
      </ul>
    </div><?php echo Form::close(); ?>
  </div>
</div>