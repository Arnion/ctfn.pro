<?php
$this->title = $title; 
?>

<?= $this->render(	
	'@app/themes/th1/views/site/elements/__header_3.php',
) ?>


<div id="none" class="modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
					<span class="h3" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?=Yii::t('Frontend', 'Close')?></button>
				<button type="button" class="btn btn-primary"><?=Yii::t('Frontend', 'Save')?></button>
			</div>
		</div>
	</div>
</div>


<!-- Start -->
<div class="content site-certificate-create">

	<?= $this->render('__form', [
		'model' => $model,
		'bigTitle' => $bigTitle,
		'smallTitle' => $smallTitle,
	]) ?>
			
</div>
<!-- End -->
		
<?= $this->render(
	'@app/themes/th1/views/site/elements/__footer_1.php'
) ?>