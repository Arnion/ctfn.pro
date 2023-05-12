<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use common\models\Clients;

if (!Yii::$app->user->isGuest) { 
	$client = Clients::findUserId();
	if (empty($client)) {
		$client = new Clients;
	}
		
	$this->registerCss('
		.auth-hidden {
			display:none; 
		}
	');
}
?>

<div id="cf-modal-load" class="modal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"></h5>
				<button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
					<span class="h3" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer visually-hidden">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?=Yii::t('Frontend', 'Close')?></button>
				<button type="button" class="btn btn-primary"><?=Yii::t('Frontend', 'Save')?></button>
			</div>
		</div>
	</div>
</div>

<?php /*
<!-- Loader -->
<div id="preloader">
	<div id="status">
		<div class="spinner">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>
	</div>
</div>
<!-- Loader -->
*/?>

<!-- Navbar STart -->
<header id="topnav" class="defaultscroll sticky">
	<div class="container">
		<!-- Logo Start-->
		<a class="logo" href="/">
			<span class="logo-light-mode">
				<img src="/images/logo/logo-dark.png" height="26" class="l-dark" alt="">
				<img src="/images/logo/logo-white.png" height="26" class="l-light" alt="">
			</span>
			<img src="/images/logo/logo-light.png" height="26" class="logo-dark-mode" alt="">
		</a>
		<!-- Logo end-->

		<!-- Mobile -->
		<div class="menu-extras">
			<div class="menu-item">
				<!-- Mobile menu toggle-->
				<a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
					<div class="lines">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</a>
				<!-- End mobile menu toggle-->
			</div>
		</div>
		<!-- Mobile -->

		 <?php if (!Yii::$app->user->isGuest) { ?>

			<!--Login button Start-->
			<ul class="buy-button list-inline mb-0">
				<li class="list-inline-item mb-0 me-1">
					<a id="connectWallet">
						<span class="btn-icon-dark"><span class="btn btn-icon btn-pills btn-primary"><i class="uil uil-wallet fs-6"></i></span></span>
						<span class="btn-icon-light"><span class="btn btn-icon btn-pills btn-light"><i class="uil uil-wallet fs-6"></i></span></span>
					</a>
				</li>
				
				<li class="list-inline-item mb-0"> 
					<div class="dropdown dropdown-primary">
						<button type="button" class="btn btn-pills dropdown-toggle p-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							
							<?php if (empty($client->image)) { ?>
					
								<img src="/upload/default.jpg" class="rounded-pill avatar avatar-sm-sm" alt="">
								
							<?php } else { ?>
								
								<img src="/upload/client/<?=md5($client->id)?>/<?=$client->image?>" class="rounded-pill avatar avatar-sm-sm" alt="">
								
							<?php } ?>
		
						</button>
						<div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow border-0 mt-3 pb-3 pt-0 overflow-hidden rounded" style="min-width: 200px;">
							<div class="position-relative">
								<div class="pt-5 pb-3 bg-gradient-primary"></div>
								<div class="px-3">
									<div class="d-flex align-items-end mt-n4">
										
										<?php if (empty($client->image)) { ?>
					
											<img src="/upload/default.jpg" class="rounded-pill avatar avatar-md-sm img-thumbnail shadow-md" alt="">
											
										<?php } else { ?>
											
											<img src="/upload/client/<?=md5($client->id)?>/<?=$client->image?>" class="rounded-pill avatar avatar-md-sm img-thumbnail shadow-md" alt="">
											
										<?php } ?>
				
										<h6 class="text-dark fw-bold mb-0 ms-1"><?=$client->name?> <?=$client->surname?></h6>
									</div>
									<div class="mt-2">
										<small class="text-start text-dark d-block fw-bold"><?=Yii::t('Frontend', 'Wallet')?>:</small>
										<div class="d-flex justify-content-between align-items-center">
											<small id="myPublicAddress" class="text-muted">0</small>
											<a href="javascript:void(0);" class="text-primary"><span class="uil uil-copy"></span></a>
										</div>
									</div>
									
									<div class="mt-2">
										<small class="text-dark"><?=Yii::t('Frontend', 'Balance')?>: <span class="text-primary fw-bold">0ETH</span></small>
									</div>
								</div>
							</div>
							<div class="mt-2">
								<a class="dropdown-item small fw-semibold text-dark d-flex align-items-center" href="/profile/view"><span class="mb-0 d-inline-block me-1"><i class="uil uil-user align-middle h6 mb-0 me-1"></i></span> <?=Yii::t('Menu', 'Profile View')?></a>
								<div class="dropdown-divider border-top"></div>
								<a class="dropdown-item small fw-semibold text-dark d-flex align-items-center" href="/logout"><span class="mb-0 d-inline-block me-1"><i class="uil uil-sign-out-alt align-middle h6 mb-0 me-1"></i></span> <?=Yii::t('Menu', 'Logout')?></a>
							</div>
						</div>
					</div>
				</li>
				
			</ul>
			<!--Login button End-->
			<div id="navigation">
				<!-- Navigation Menu-->   
				<ul class="navigation-menu nav-left nav-light">
					<li class="has-submenu parent-parent-menu-item">
						<a href="javascript:void(0)"><?=Yii::t('Menu', 'Profile View')?></a><span class="menu-arrow"></span>
						<ul class="submenu">
							<li><a href="/profile/view" class="sub-menu-item"> <?=Yii::t('Menu', 'View Profile')?></a></li>
							<li><a href="/profile/update" class="sub-menu-item"> <?=Yii::t('Menu', 'Profile Edit')?></a></li>
						</ul>
					</li>
					<li class="has-submenu parent-parent-menu-item">
						<a href="javascript:void(0)"><?=Yii::t('Menu', 'Public')?></a><span class="menu-arrow"></span>
						<ul class="submenu">
							<li><a href="/public/address" class="sub-menu-item"> <?=Yii::t('Menu', 'Public Address')?></a></li>
							<li><a href="/public/contract" class="sub-menu-item"> <?=Yii::t('Menu', 'Public Contract')?></a></li>
							<li><a href="/public/view" class="sub-menu-item"> <?=Yii::t('Menu', 'Public View')?></a></li>
						</ul>
					</li>
					<li><a href="/logout" class="sub-menu-item"><?=Yii::t('Menu', 'Logout')?></a></li>
				</ul><!--end navigation menu-->
			</div><!--end navigation--> 
		 
		 <?php } else { ?>

			<div id="navigation">
				<!-- Navigation Menu-->   
				<ul class="navigation-menu nav-left nav-light">
					<li class="has-submenu parent-parent-menu-item">
						<a href="javascript:void(0)"><?=Yii::t('Menu', 'Public')?></a><span class="menu-arrow"></span>
						<ul class="submenu">
							<li><a href="/public/address" class="sub-menu-item"> <?=Yii::t('Menu', 'Public Address')?></a></li>
							<li><a href="/public/contract" class="sub-menu-item"> <?=Yii::t('Menu', 'Public Contract')?></a></li>
							<li><a href="/public/view" class="sub-menu-item"> <?=Yii::t('Menu', 'Public View')?></a></li>
						</ul>
					</li>
					<li><a href="/login" class="sub-menu-item"><?=Yii::t('Menu', 'Login')?></a></li>
					<li><a href="/signup" class="sub-menu-item"><?=Yii::t('Menu', 'Signup')?></a></li>
				</ul><!--end navigation menu-->
			</div><!--end navigation-->
		 <?php } ?>
	</div><!--end container-->
</header><!--end header-->
<!-- Navbar End -->