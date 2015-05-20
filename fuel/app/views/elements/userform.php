<?php $node = '<div class="userform '.$data[0].'">'; ?><?php echo $node; ?>
<dl class="formFrame">
  <dt>新曲</dt>
  <dd><?php echo Form::select($data[0].'hotSelect','',[],['class'=>'hotSelect','multiple'=>'multiple']); ?>
  </dd>
  <dd class="sup">ctrl + 選択で複数選択できます。</dd>
</dl>
<dl class="formFrame">
  <dt>旧曲</dt>
  <dd><?php echo Form::select($data[0].'oldSelect','',[],['class'=>'oldSelect','multiple'=>'multiple']); ?>
  </dd>
  <dd class="sup">ctrl + 選択で複数選択できます。</dd>
</dl>
<div class="buttonWrap"><span class="submitBase primary js-controlAdd">追加する</span></div><?php echo "</div>"; ?>