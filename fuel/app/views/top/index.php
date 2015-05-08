
<h1>helloWorld</h1>
<div class="registBlock"><?php echo Form::open(); ?><?php echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token()); ?>
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
  </div><?php echo Form::close(); ?>
</div>