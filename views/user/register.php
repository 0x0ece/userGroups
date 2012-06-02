<?php
$this->breadcrumbs=array(
	Yii::t('userGroupsModule.general','User Registration'),
);
?>
<div id="userGroups-container">
	<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'user-groups-passrequest-form',
			'enableAjaxValidation'=>false,
			'enableClientValidation'=>true,
		)); ?>
		<div class="row">
			<?php echo $form->labelEx($model,'username'); ?>
			<?php echo $form->textField($model,'username'); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'email'); ?>
			<?php echo $form->textField($model,'email'); ?>
			<?php echo $form->error($model,'email'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password'); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'password_confirm'); ?>
			<?php echo $form->passwordField($model,'password_confirm'); ?>
			<?php echo $form->error($model,'password_confirm'); ?>
		</div>

		<?php
		// additional fields of additional profiles supporting registration
		foreach ($profiles as $p) {
			$this->renderPartial('//'.str_replace(array('{','}'), NULL, $p['model']->tableName()).'/'.$p['view'], array('form' => $form, 'model' => $p['model']));
		}
		?>
		<?php if (UserGroupsConfiguration::findRule('simple_password_reset') === false): ?>
		<div class="row">
			<?php echo $form->labelEx($model,'question'); ?>
			<?php echo $form->textField($model,'question'); ?>
			<?php echo $form->error($model,'question'); ?>
		</div>
		<div class="row">
			<?php echo $form->labelEx($model,'answer'); ?>
			<?php echo $form->textField($model,'answer'); ?>
			<?php echo $form->error($model,'answer'); ?>
		</div>
		<?php endif; ?>
		<div class="row">
			<?php echo $form->labelEx($model,'captcha'); ?>
			<div>
			<?php $this->widget('CCaptcha', array(
				'clickableImage'=>true,
				'buttonOptions'=>array(
					'id'=>'refreshCaptcha',
				),
			)); ?>
			<?php echo $form->textField($model,'captcha'); ?>
			<?php echo $form->error($model,'captcha'); ?>
			</div>
			<div class="hint"><?php echo Yii::t('userGroupsModule.general', 'Please enter the letters as they are shown in the image above.<br/>Letters are not case-sensitive.')?></div>
		</div>
		<div class="row buttons">
			<?php echo CHtml::submitButton(Yii::t('userGroupsModule.general','Register')); ?>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>