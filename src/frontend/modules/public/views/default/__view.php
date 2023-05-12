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
<section class="bg-item-detail d-table w-100">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="sticky-bar">
					<img src="/images/item-detail-1.jpg" class="img-fluid rounded-md shadow" alt="">
				</div>
			</div>

			<div class="col-md-6 mt-4 pt-2 mt-sm-0 pt-sm-0">
				<div class="ms-lg-5">
					<div class="title-heading">
						<h4 class="h3 fw-bold mb-0">Wolf with Skull <span class="text-gradient-primary">Orange</span> <br> <span class="text-gradient-primary">Illustration</span> T-shirt Tattoo</h4>
					</div>

					<div class="row">
						<div class="col-md-6 mt-4 pt-2">
							<h6>Current Bid</h6>
							<h4 class="mb-0">4.85 ETH</h4>
							<small class="mb-0 text-muted">$450.48USD</small>
						</div>

						<div class="col-md-6 mt-4 pt-2">
							<h6>Auction Ending In</h6>
							<h4 id="auction-item-8" class="fw-bold mb-0">00 : 00 : 00 : 00</h4>
						</div>

						<div class="col-12 mt-4 pt-2">
							<a href="#" class="btn btn-l btn-pills btn-primary me-2" data-bs-toggle="modal" data-bs-target="#NftBid"><i class="mdi mdi-gavel fs-5 me-2"></i> Place a Bid</a>
							<a href="#" class="btn btn-l btn-pills btn-primary" data-bs-toggle="modal" data-bs-target="#NftBuynow"><i class="mdi mdi-cart fs-5 me-2"></i> Buy Now</a>
						</div>
					</div>

					<div class="row mt-4 pt-2">
						<div class="col-12">
							<ul class="nav nav-tabs border-bottom" id="myTab" role="tablist">
								<li class="nav-item" role="presentation">
									<button class="nav-link active" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detailItem" type="button" role="tab" aria-controls="detailItem" aria-selected="true">Details</button>
								</li>
								
								<li class="nav-item" role="presentation">
									<button class="nav-link" id="bids-tab" data-bs-toggle="tab" data-bs-target="#bids" type="button" role="tab" aria-controls="bids" aria-selected="false">Bids</button>
								</li>

								<li class="nav-item" role="presentation">
									<button class="nav-link" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button" role="tab" aria-controls="activity" aria-selected="false">Activity</button>
								</li>
							</ul>

							<div class="tab-content mt-4 pt-2" id="myTabContent">
								<div class="tab-pane fade show active" id="detailItem" role="tabpanel" aria-labelledby="detail-tab">
									<p class="text-muted">Hey guys! New exploration about NFT Marketplace Web Design, this time I'm inspired by one of my favorite NFT website called Superex (with crypto payment)! What do you think?</p>
									<p class="text-muted">What does it mean? Biomechanics is the study of the structure, function and motion of the mechanical aspects of biological systems, at any level from whole organisms to organs, cells and cell organelles, using the methods of mechanics. Biomechanics is a branch of biophysics.</p>
									<h6>Owner</h6>

									<div class="creators creator-primary d-flex align-items-center">
										<div class="position-relative">
											<img src="images/client/09.jpg" class="avatar avatar-md-sm shadow-md rounded-pill" alt="">
											<span class="verified text-primary">
												<i class="mdi mdi-check-decagram"></i>
											</span>
										</div>
		
										<div class="ms-3">
											<h6 class="mb-0"><a href="creators.html" class="text-dark name">PandaOne</a></h6>
										</div>
									</div>
								</div>

								<div class="tab-pane fade" id="bids" role="tabpanel" aria-labelledby="bids-tab">
									<div class="creators creator-primary d-flex align-items-center">
										<div class="position-relative">
											<img src="images/client/01.jpg" class="avatar avatar-md-sm shadow-md rounded-pill" alt="">
										</div>
		
										<div class="ms-3">
											<h6 class="mb-0">2 WETH <span class="text-muted">by</span> <a href="creator-profile.html" class="text-dark name">0xe849fa28a...ea14</a></h6>
											<small class="text-muted">6 hours ago</small>
										</div>
									</div>

									<div class="creators creator-primary d-flex align-items-center mt-4">
										<div class="position-relative">
											<img src="images/client/08.jpg" class="avatar avatar-md-sm shadow-md rounded-pill" alt="">
										</div>
		
										<div class="ms-3">
											<h6 class="mb-0">0.001 WETH <span class="text-muted">by</span> <a href="creator-profile.html" class="text-dark name">VOTwear</a></h6>
											<small class="text-muted">6 hours ago</small>
										</div>
									</div>

									<div class="creators creator-primary d-flex align-items-center mt-4">
										<div class="position-relative">
											<img src="images/client/10.jpg" class="avatar avatar-md-sm shadow-md rounded-pill" alt="">
										</div>
		
										<div class="ms-3">
											<h6 class="mb-0">1.225 WETH <span class="text-muted">by</span> <a href="creator-profile.html" class="text-dark name">PandaOne</a></h6>
											<small class="text-muted">6 hours ago</small>
										</div>
									</div>
								</div>

								<div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
									<div class="row g-4">
										<div class="col-12">
											<div class="card activity activity-primary rounded-md shadow p-4">
												<div class="d-flex align-items-center">
													<div class="position-relative">
														<img src="images/items/1.jpg" class="avatar avatar-md-md rounded-md shadow-md" alt="">
		
														<div class="position-absolute top-0 start-0 translate-middle px-1 rounded-lg shadow-md bg-white">
															<i class="mdi mdi-account-check mdi-18px text-success"></i>
														</div>
													</div>
														
													<span class="content ms-3">
														<a href="javascript:void(0)" class="text-dark title mb-0 h6 d-block">Digital Art Collection</a>
														<small class="text-muted d-block mt-1">Started Following <a href="javascript:void(0)" class="link fw-bold">@Panda</a></small>
														
														<small class="text-muted d-block mt-1">1 hours ago</small>
													</span>
												</div>
											</div>
										</div><!--end col-->
										
										<div class="col-12">
											<div class="card activity activity-primary rounded-md shadow p-4">
												<div class="d-flex align-items-center">
													<div class="position-relative">
														<img src="images/gif/1.gif" class="avatar avatar-md-md rounded-md shadow-md" alt="">
		
														<div class="position-absolute top-0 start-0 translate-middle px-1 rounded-lg shadow-md bg-white">
															<i class="mdi mdi-heart mdi-18px text-danger"></i>
														</div>
													</div>
														
													<span class="content ms-3">
														<a href="javascript:void(0)" class="text-dark title mb-1 h6 d-block">Skrrt Cobain Official</a>
														<small class="text-muted d-block mt-1">Liked by <a href="javascript:void(0)" class="link fw-bold">@ButterFly</a></small>
														
														<small class="text-muted d-block mt-1">2 hours ago</small>
													</span>
												</div>
											</div>
										</div><!--end col-->
										
										<div class="col-12">
											<div class="card activity activity-primary rounded-md shadow p-4">
												<div class="d-flex align-items-center">
													<div class="position-relative">
														<img src="images/items/2.jpg" class="avatar avatar-md-md rounded-md shadow-md" alt="">
		
														<div class="position-absolute top-0 start-0 translate-middle px-1 rounded-lg shadow-md bg-white">
															<i class="mdi mdi-heart mdi-18px text-danger"></i>
														</div>
													</div>
														
													<span class="content ms-3">
														<a href="javascript:void(0)" class="text-dark title mb-1 h6 d-block">Wow! That Brain Is Floating</a>
														<small class="text-muted d-block mt-1">Liked by <a href="javascript:void(0)" class="link fw-bold">@ButterFly</a></small>
														
														<small class="text-muted d-block mt-1">2 hours ago</small>
													</span>
												</div>
											</div>
										</div><!--end col-->
									</div><!--end row-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!--end col-->
		</div><!--end row-->
	</div><!--end container-->

	<!--end container-->
</section>


