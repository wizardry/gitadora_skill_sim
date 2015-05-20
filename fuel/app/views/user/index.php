<?php Config::load('iprefecture'); ?><?php $prefCode = Config::get('prefData'); ?><?php $pref = array(); ?><?php $i = 0; ?><?php foreach($prefCode as $area){ ?><?php $pref[$i] = $area; ?><?php $i++; ?><?php } ?>
<div class="contentWrap userPage">
  <div class="sectionBlock">
    <h2 class="sectionHeadline">さんの編集画面
    </h2>
    <ul class="tabMenu">
      <li class="toMyEdit">プロフィール情報の編集</li>
      <li class="toDrum">DRUMMANIA情報の編集</li>
      <li class="toGuitar">GUITARFREAKS情報の編集</li>
    </ul>
    <div class="tabContents">
      <div class="tabContent profileContent"><?php echo Form::open(array('name'=>'profiles')); ?><?php echo Form::hidden('formType','profiles'); ?>
        <dl class="formFrame">
          <dt>表示名</dt>
          <dd> <?php echo Form::input('displayName',Input::post('displayName'),array('required'=>'required','type'=>'text',)); ?>
          </dd>
        </dl>
        <dl class="formFrame">
          <dt>都道府県</dt>
          <dd> <?php echo Form::select('pref',Input::post('pref'),$pref); ?>
          </dd>
        </dl>
        <dl class="formFrame">
          <dt>ホーム</dt>
          <dd> <?php echo Form::input('home',Input::post('home'),array('type'=>'text',)); ?>
          </dd>
        </dl>
        <dl class="formFrame">
          <dt>URL</dt>
          <dd> <?php echo Form::input('url',Input::post('url'),array('type'=>'text',)); ?>
          </dd>
        </dl>
        <dl class="formFrame">
          <dt>コメント</dt>
          <dd> <?php echo Form::textarea('comment',Input::post('comment'),array('class'=>'comment')); ?>
          </dd>
        </dl>
        <div class="buttonWrap">
          <label for="userEditSubmit" class="submitBase primary">編集<?php echo Form::submit('submit_btn', '編集',array('id'=>'userEditSubmit')); ?>
          </label>
        </div><?php echo Form::close(); ?>
      </div>
      <div class="tabContent drumContent"><?php echo Form::open(array('name'=>'drum')); ?><?php echo Form::hidden('formType','drum'); ?><?php echo $drumform;  ?>
        <div class="controlWrap">
          <div class="hotControl">
            <table id="drumHotControlTable" class="controlTable hot">
              <thead>
                <tr>
                  <th class="iterator">Num</th>
                  <th class="title">曲名</th>
                  <th class="part">難易度</th>
                  <th class="part">レベル</th>
                  <th class="rate">達成率</th>
                  <th class="skill">スキル</th>
                  <th class="status">ランク</th>
                  <th class="comment">コメント</th>
                  <th class="comment">削除</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
          <div class="oldControl">
            <table id="drumOldControlTable" class="controlTable old">
              <thead>
                <tr>
                  <th class="iterator">Num</th>
                  <th class="title">曲名</th>
                  <th class="part">難易度</th>
                  <th class="part">レベル</th>
                  <th class="rate">達成率</th>
                  <th class="skill">スキル</th>
                  <th class="status">ランク</th>
                  <th class="comment">コメント</th>
                  <th class="comment">削除</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
        <div class="buttonWrap">
          <label for="drumEditSubmit" class="submitBase primary">編集<?php echo Form::submit('submit_btn', '編集',array('id'=>'drumEditSubmit')); ?>
          </label>
        </div><?php echo Form::close(); ?>
      </div>
      <div class="tabContent guitarContent"><?php echo $guitarform; ?><?php echo Form::open(array('name'=>'guitar')); ?><?php echo Form::hidden('formType','guitar'); ?>
        <div class="controlWrap">
          <div class="hotControl">
            <table id="GuitarHotControlTable" class="controlTable hot">
              <thead>
                <tr>
                  <th class="iterator">Num</th>
                  <th class="title">曲名</th>
                  <th class="part">難易度</th>
                  <th class="part">レベル</th>
                  <th class="rate">達成率</th>
                  <th class="skill">スキル</th>
                  <th class="status">ランク</th>
                  <th class="comment">コメント</th>
                  <th class="comment">削除</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
          <div class="oldControl">
            <table id="GuitarOldControlTable" class="controlTable old">
              <thead>
                <tr>
                  <th class="iterator">Num</th>
                  <th class="title">曲名</th>
                  <th class="part">難易度</th>
                  <th class="part">レベル</th>
                  <th class="rate">達成率</th>
                  <th class="skill">スキル</th>
                  <th class="status">ランク</th>
                  <th class="comment">コメント</th>
                  <th class="comment">削除</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
        <div class="buttonWrap">
          <label for="guitarEditSubmit" class="submitBase primary">編集<?php echo Form::submit('submit_btn', '編集',array('id'=>'guitarEditSubmit')); ?>
          </label>
        </div><?php echo Form::close(); ?>
      </div>
    </div>
  </div>
</div>