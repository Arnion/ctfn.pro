<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use common\widgets\Alert;
use common\models\Clients;
use yii\bootstrap5\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use app\modules\certificate\CertificateModule;
use frontend\components\SchoolToken;

$client = Clients::findUserId();

$chainId = SchoolToken::BNB_TESTNET_CHAIN_ID;
$contractAddress = $client->school_nft_address_testnet;
$jsAdminObj = SchoolToken::JS_ADMIN_OBJECT_TESTNET;


$this->registerJsFile('/js/ethers.umd.min.js', ['position' => yii\web\View::POS_END]);
$this->registerJsFile('/js/schoolToken.js', ['position' => yii\web\View::POS_END]);

if (!empty($client->is_mainnet)) {
	$this->registerJsFile('/js/adminctfnpromainnet.js', ['position' => yii\web\View::POS_END]);
	$jsAdminObj = SchoolToken::JS_ADMIN_OBJECT_MAINNET;
	$chainId = SchoolToken::BNB_MAINNET_CHAIN_ID;
	$contractAddress = $client->school_nft_address_mainnet;
} else {
	$this->registerJsFile('/js/adminctfnprotestnet.js', ['position' => yii\web\View::POS_END]);
}

$this->registerJs('
	jQuery(document).ready(function($) {
		$("#cf-modal-load").on("click", "[data-dismiss=\"modal\"]", function() {
			$("#cf-modal-load").toggle();
		});

		SearchButton();
	});

	let stateObj = {
		loading: false,
		reloadTokenBlock: false
	};

	function SearchButton() {
		$("#searchToken").off("click");
		$("#searchToken").on("click", async function() {

			if (stateObj.loading) {
				return false;
			}
			stateObj.loading = true;
			
			$(this).removeClass("disabled");
			$(this).addClass("disabled");
			
			$("#mintTokenSpinner").show();
			
			let result = await processMintToken();
			
			$("#mintTokenSpinner").hide();
			$(this).removeClass("disabled");
			stateObj.loading = false;
		});
	}
	
	async function processMintToken() {
		try {
			return await mintToken(studentAddress, newTokenUri);
		} catch(error) {
			console.log(error);
			alert(error);
		}
		return false;
	}

	async function mintToken(studentAddress, newTokenUri) {
		
		const provider = new ethers.providers.Web3Provider(window.ethereum); //id
		const listAccounts = await provider.send("eth_requestAccounts", []);
		const signer = await provider.getSigner(listAccounts[0]);
		const signer_address = await signer.getAddress();
		
		const {chainId} = await provider.getNetwork();

		let chainLabels = [];
		chainLabels[97] = "BNB Testnet";
		chainLabels[56] = "BNB Mainnet";

		const adminObj = ' . $jsAdminObj . ';
		const contractAddress = "'. $contractAddress .'";
		const BNBChainId = '. $chainId .';
		
		if (chainId != BNBChainId) {
			throw "'.Yii::t('Frontend', 'Error! Change network to ').'" + chainLabels[BNBChainId] + ". (ChainID = " + BNBChainId + ")";
		}

		if (!ethers.utils.isAddress(studentAddress)) {
			throw "'.Yii::t('Frontend', 'Error! User address is invalid ').'";
		}

		const contract = await new ethers.Contract(contractAddress, schoolToken.CONTRACT_ABI, signer);
		
		const price = await getMintPrice();
		const tx = await contract.safeMint(studentAddress, newTokenUri, {value: price, gasLimit: schoolToken.BASE_GAS_LIMIT});

		let result = await tx.wait();
		console.log("transaction", result);
		
		const [Transfer] = result.events;
		console.log("Transfer", Transfer);

		await SaveMintData(result.from, Transfer.args);	

		if (stateObj.reloadTokenBlock) {
			stateObj.reloadTokenBlock = false;
			await reloadTokenBlock();
			createTokenButton();
		}
	}

	async function SaveMintData(mintedby, Transfer) {
		stateObj.reloadTokenBlock = false;

		let tokenId = parseInt(Transfer[2]._hex);
		console.log("tokenId", tokenId);

		await $.ajax({
			type: "post",
			data: {
				YII_CSRF_TOKEN: "' . Yii::$app->getRequest()->getCsrfToken() . '",
				mintedby: mintedby,
				tokenId: tokenId,
			},
			success: function(response) {
				try {
					let result = JSON.parse(response);
					if (result.error) {
						console.log(result.message);
					} else {
						stateObj.reloadTokenBlock = true;
					}
				} catch (error) {
					console.log(error);
				}
			}
		});
	}


	async function getMintPrice() {
		const adminObj = '. $jsAdminObj .';
		const provider = new ethers.providers.Web3Provider(window.ethereum); //id
		const listAccounts = await provider.send("eth_requestAccounts", []);
		const signer = await provider.getSigner(listAccounts[0]);
		const signer_address = await signer.getAddress();
		
		const contract = await new ethers.Contract(adminObj.CONTRACT_ADDRESS, adminObj.CONTRACT_ABI, signer);
		return await contract.safeMintPrice();
	}

	async function reloadTokenBlock() {
		
		$("#reloadTokenContent").fadeOut();
		$("#reloadTokenSpinner").fadeIn();

		await $.ajax({
			type: "post",
			data: {
				YII_CSRF_TOKEN: "' . Yii::$app->getRequest()->getCsrfToken() . '"
			},
			success: function(response) {
				$("#reloadTokenContent").html(response);
			}
		});

		$("#reloadTokenSpinner").fadeOut();
		$("#reloadTokenContent").fadeIn();
	}


', yii\web\View::POS_END);


$this->registerCss('
	.cert-icon {
		font-size:22px;
	}
	.cert-icon-disable {
		color:#ccc;
	}
	.cert-block-text {
		width:236px;
		font-size:8px;
		color:#7b7b7b;
	}
	.cert-block-text .img-fluid {
		width:236px;
	}
	.cert-block-text .cert-pos {
		left:10px;
		right:10px;
		color:#7b7b7b;
	}
	.cert-block-text .pos-1 {
		top:52px;
	}
	.cert-block-text .pos-2 {
		top:70px;
	}
	.cert-block-text .pos-3 {
		top:80px;
	}
	.cert-block-text .pos-4 {
		top:89px;
	}
	.cert-block-text .pos-5 {
		right:34px;
		top:119px;
		color:#7b7b7b;
	}
');
?>

<!-- Start Home -->
<section class="bg-half-170 d-table w-100" style="background: url('/images/bg/01.jpg') bottom;">
	<div class="bg-overlay bg-gradient-overlay-2"></div>
	<div class="container">
		<div class="row mt-5 justify-content-center">
			<div class="col-12">
				<div class="title-heading text-center">
					<h5 class="heading fw-semibold sub-heading text-white title-dark"><?=Yii::t('Menu', 'Token address')?></h5>
					<p class="text-white-50 para-desc mx-auto mb-0"><?=Yii::t('Frontend', 'Education organization token addresss')?></p>
				</div>
			</div><!--end col-->
		</div><!--end row-->

	</div><!--end container-->
</section><!--end section-->
<div class="position-relative">            
	<div class="shape overflow-hidden text-white">
		<svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
		</svg>
	</div>
</div>
<!-- End Home -->

<!-- Start -->
<section class="section d-none">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-4 order-2 order-md-1 mt-4 pt-2 mt-sm-0 pt-sm-0">
				<div class="card creators creator-primary rounded-md shadow overflow-hidden sticky-bar">
					
					<?php if (empty($client->school_logo)) { ?>

						<div class="py-5" style="background: url('/upload/school_logo_default.jpg');"></div>
					
					<?php } else { ?>
					
						<div class="py-5" style="background: url('/upload/client/<?=md5($client->id)?>/<?=$client->school_logo?>');"></div>
					
					<?php } ?>
					
					
					<div class="position-relative mt-n5">
						
						<?php if (empty($client->image)) { ?>
					
							<img src="/upload/default.jpg" class="avatar avatar-md-md rounded-pill shadow-sm bg-light img-thumbnail mx-auto d-block" id="client-image" alt="">
							
						<?php } else { ?>
							
							<img src="/upload/client/<?=md5($client->id)?>/<?=$client->image?>" class="avatar avatar-md-md rounded-pill shadow-sm bg-light img-thumbnail mx-auto d-block" id="client-image" alt="">
							
						<?php } ?>
				
						<div class="content text-center pt-2 p-4">
							<h6 class="mb-0"><?=$client->name?> <?=$client->surname?></h6>
							<small class="text-muted"><?=$client->identify_name?></small>

							<ul class="list-unstyled mb-0 mt-3" id="navmenu-nav">
								<li class="px-0">
									<a href="/profile/view" class="d-flex align-items-center text-dark">
										<span class="fs-6 mb-0"><i class="uil uil-user"></i></span>
										<small class="d-block fw-semibold mb-0 ms-2"><?=Yii::t('Menu', 'Profile View')?></small>
									</a>
								</li>
								<li class="px-0 mt-2">
									<a href="/logout" class="d-flex align-items-center text-dark">
										<span class="fs-6 mb-0"><i class="uil uil-sign-in-alt"></i></span>
										<small class="d-block fw-semibold mb-0 ms-2"><?=Yii::t('Menu', 'Logout')?></small>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div><!--end col-->

			<div class="col-lg-9 col-md-8 order-1 order-md-2">
			
				<?=Alert::widget()?>
				<div class="result-img-load"></div>
			
				<div class="card rounded-md shadow p-4">		
					<div class="ms-lg-4">
					
						
						
					</div>	
				</div>
			</div><!--end col-->
		</div><!--end row-->
	</div><!--end container-->
</section><!--end section-->
<!-- End -->

<section class="section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 col-12">
				<div class="rounded p-4 shadow">
					<div class="row">
						<div class="col-12">
							<?=Alert::widget()?>
						</div>
						<div class="col-12">
						<?php $form = ActiveForm::begin([
								'id' => 'address-search',
								'class' => 'address-search',
							]); ?>

								<div class="row">
											
									<div class="col-12 mb-4">
											
										<?=$form->field($model, 'search_contract', [
											'template' => '<label for="publicpage-search_contract" class="form-label fw-bold">'.Yii::t('Frontend', 'Token address').' <i class="fa fa-asterisk text-danger"></i></label>{input}{error}'
										])->textInput(['type'=>'text', 'placeholder'=>Yii::t('Frontend', 'Education organization token address on bnb chain'), 'autocomplete' => 'off']) ?>
										
									</div><!--end col-->

									<div class="col-12 mb-4">
											
										<?=$form->field($model, 'search_token_id', [
											'template' => '<label for="publicpage-search_token_id" class="form-label fw-bold">'.Yii::t('Frontend', 'Token Id').' <i class="fa fa-asterisk text-danger"></i></label>{input}{error}'
										])->textInput(['type'=>'text', 'placeholder'=>Yii::t('Frontend', 'Token id'), 'autocomplete' => 'off']) ?>
										
									</div><!--end col-->	
									
								</div>

								<div class="col-lg-12">
											
									<?= Html::Button(Yii::t('Form', 'Search'), ['id'=>'submit-form', 'class' => 'btn btn-primary', 'name' => 'send']) ?>

								</div><!--end col-->
										
					
							<?php ActiveForm::end(); ?>
						</div><!--end col-->
					</div><!--end row-->
				</div>
			</div><!--end col-->
		</div><!--end row-->
	</div><!--end container-->

	<div class="container mt-100 mt-6" >
		<div class="row justify-content-center">
			<div class="col-12 col-lg-10">
				<ul class="nav nav-tabs border-bottom" id="vwTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="cert-tab" data-bs-toggle="tab" data-bs-target="#cert-item" type="button" role="tab" aria-controls="cert-item" aria-selected="true">Certificates</button>
					</li>
				</ul>
				<div id="reloadContent" class="row justify-content-center">
					<div class="col">
						<div class="card nft-items nft-primary rounded-md shadow overflow-hidden mb-1 p-3">
							<div class="d-flex justify-content-between">
								<div class="img-group">
									<a href="/certificate?id=11&amp;hash=a9c4d290cf2dab5c7725f6e411136e61" class="user-avatar" data-bs-toggle="tooltip" data-bs-placement="top" target="_blank" aria-label="Certificate PNG" data-bs-original-title="Certificate PNG">
										<i class="fa fa-file-image-o avatar avatar-sm-sm cert-icon" aria-hidden="true"></i>
									</a>
								</div>					
								<span>
									<a href="javascript:void(0)" class="icon cert-icon cert-icon-disable" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mainnet" data-bs-original-title="Mainnet"><i class="fa fa-wifi" aria-hidden="true"></i></a>
									<a href="https://testnet.bscscan.com/token/0xb37a1F249786eeE8422D3A061C0E3a605cbd9d65?a=31" class="icon cert-icon cert-icon-disable" data-bs-toggle="tooltip" data-bs-placement="top" target="_blank" aria-label="Testnet" data-bs-original-title="Testnet"><i class="fa fa-wifi" aria-hidden="true"></i></a>
								</span>
							</div> 
							<div class="nft-image rounded-md position-relative overflow-hidden cert-block-text">
								<a class="img-link" href="/certificate?id=11&amp;hash=a9c4d290cf2dab5c7725f6e411136e61" target="_blank"><img src="/upload/certificate/pr_certificate.png" class="img-fluid" alt="">
									<div class="position-absolute cert-pos pos-1">
										<div class="text-center">№ 11</div>
									</div>
									<div class="position-absolute cert-pos pos-2">
										<div class="text-center">Nikita Pivikov</div>
									</div>
									<div class="position-absolute cert-pos pos-3">
										<div class="text-center">Successfully passed (-la)</div>
									</div>
									<div class="position-absolute cert-pos pos-4">
										<div class="text-center">cool</div>
									</div>
									<div class="position-absolute pos-5">
										10.05.2023
									</div>
								</a>
							</div>
							<div class="card-body content position-relative p-0">
								<div class="justify-content-between mt-2">
									<div class="text-dark small">Nikita Pivikov</div>
									<div class="text-dark small">cool</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row justify-content-center">
					<div class="col-12">
						<div class="container mt-100 mt-60">
							<div class="row justify-content-center">
								<div class="col-12">
									<div class="section-title text-center">
										<h6 class="text-muted fw-normal mb-3">Contact us and we'll get back to you as soon as we can.</h6>
										<h4 class="title mb-4">Can't find your answer?</h4>
										<div class="mt-4 pt-2">
											<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#contactform" class="btn btn-primary rounded-md">Help Center</a>
										</div>
									</div>
								</div><!--end col-->
							</div><!--end row-->
						</div>
					</div>
				</div>
			</div>
		</div><!--end row-->
	</div><!--end container-->
</section>


