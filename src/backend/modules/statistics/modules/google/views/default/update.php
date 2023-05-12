<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use common\widgets\Alert;
use yii\bootstrap5\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use backend\modules\statistics\modules\google\GoogleModule;

$this->title = Yii::t('Menu', 'Google Tag Manager');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
	jQuery(document).ready(function($) {
		
	});	
", yii\web\View::POS_END);


//echo Yii::$app->security->generatePasswordHash('r561w5HnacRXjLEMRMJr');    // passwd hash
//echo Yii::$app->security->generateRandomString();                          // auth_key
//echo Yii::$app->security->generateRandomString() . '_' . time()+60;        // passwd_reset_token
//echo rtrim(strtr(base64_encode('mail@sheremetev.info'), '+/', '-_'), '='); // login

?>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-lg-offset-0">
			<div class="site-page-editor theme_content">
			
				<?=Alert::widget()?>
			
				<?php 
				$form = ActiveForm::begin([
					'id' => 'yandex-metric-form', 
					'class' => 'form-horizontal', 
					//'options'=>['enctype'=>'multipart/form-data'],
					'action' => ['/statistics/yandex/update'],
				]); ?>

					<div class="row">
						<div class="col-lg-12">
								
							<?php if ($model->getErrors()) { ?>
									
								<div class="bs-callout bs-callout-danger">
									<?= $form->errorSummary($model); ?>
								</div>
									
							<?php } ?>
								
						</div>
					</div>
						
					<div class="row">
						<div class="col-lg-12">

							<?= $form->field($model, 'code',[
								'template' => '<div class="form-group"><div class="col-md-12 col-sm-12 col-xs-12 has-feedback">{input}<span class="glyphicon form-control-feedback"></span></div><div class="clearfix"></div></div>{error}'
							])->textarea(['rows' => '20'])->label(false)?>
	
							<p class="clearfix">&nbsp;</p>
							<div class="row">
								<div class="col-sm-12 text-right">
									<?= Html::submitButton(Yii::t('Backend', 'btnSave'), ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
								</div>
							</div>
						</div>
					</div>

				<?php ActiveForm::end(); ?> 

			</div>
		</div>
	</div>
</div>