<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"  />
	<head>
		<title><?php echo $title;?></title>
		
		<!-- Favorites icon -->
	<link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.gif" />
	
	<!-- Style sheets -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/reset.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/menu.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/fancybox.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style-default.css" />
	</head>
		<body>
			<div id="Wrapper">
				<div id="Top">
		<div id="TopContainer">
			
			<!-- Search -->
			<div id="SearchWrapper">
				<div id="Search">
					<form action="http://empower.com.ph/ver3" id="SearchForm" method="get">
						<p style="margin:0;"><input type="text" name="s" id="SearchInput" value="" /></p>
						<p style="margin:0;"><input type="submit" id="SearchSubmit" class="noStyle" value="" /></p>
				</form>
				</div>
			</div>
			
			<!-- Main Menu: MegaMenu -->
			<div id="MainMenu">
				<ul id="MegaMenu">
				
					<li class=""><a href="http://empower.com.ph/ver3">Empower Website</a></li>	
					<li class=""><a href="<?php echo site_url("home/registration");?>">Register</a></li>		
					<li class=""><a href="<?php echo site_url("home");?>">Login</a></li>
				</ul>
			</div> <!-- END id="MainMenu" -->
			
		</div>
	</div> <!-- END id="Top" -->
				<div id="LogoHeader" class="subPageLogo" style="text-align: left;">
					<a href="http://empower.com.ph/ver3" id="Logo" class="logoMedium"><img src="http://empower.com.ph/ver3/wp-content/themes/empowerv3/images/logo.png" alt="Empower - Premium Products for your health needs"  /></a>				</div>
		
				<div id="PageTop"></div>
				
				<div id="PageWrapper">
					<div id="PageOverlay">
			<div id="PageOverlayContent">
				<div class="contentArea">
					<h1 class="pageTitle"><?php echo $page_header?></h1>
					<div class="pageIcon"><img src="http://empower.com.ph/ver3/wp-content/themes/empowerv3/images/spacer.gif" width="128" height="128" alt="Members Login" /></div>
				</div>
			</div>
		</div> <!-- END id="PageOveraly" -->

		<div id="Showcase">
			<div id="ShowcaseContent">
				<div class="contentArea">
					<!--<h2 class="pageTagLine"></h2>-->
				</div>
			</div>
		</div> <!-- END id="Showcase" -->
	
	
		<div id="MainPage">
			<div id="MainPageContent">
				<div class="contentArea">
					
					<div class="two_third">
						
<link rel="stylesheet" type="text/css" href="/js/ext34/resources/css/ext-all.css" />
						<link rel="stylesheet" type="text/css" href="/js/ext34/resources/css/xtheme-gray.css" />
 <!-- ** Javascript ** -->
      <!-- ExtJS library: base/adapter -->
        <script type="text/javascript" src="/js/ext34/adapter/ext/ext-base.js"></script>
        <script type="text/javascript" src="/js/commonjs/ExtCommon.js"></script>
        <!-- ExtJS library: all widgets -->
        <script type="text/javascript" src="/js/ext34/ext-all-debug.js"></script>
        <!-- <script type="text/javascript" src="http://www.peaklifeinc.com/js/ext/ext-all-debug.js"></script>-->					

<style type="text/css">

#mainContainer {padding: 0; width: 914px; margin: 0 auto; position: relative;}



</style>

							<br/>

						<br/>

						

	<div id="mainContainer">
		
		<?php echo $content_for_layout?>									




<br/>



</div>

<br/>

<br/>

<br/>

<br/>
						<!-- Extras -->
						<div class="postFooter">
													</div>
	
						<!-- End of Content -->
						<div class="clear"></div>
	
					</div> <!-- end  <div class="two-thirds"> -->
	
											
	
					<!-- End of Content -->
					<div class="clear"></div>
					<div id="MainPage2"></div>	
				</div> <!-- END class="contentArea" -->
			</div> <!-- END id="MainPageContent" -->
			
		</div> <!-- END id="MainPage" -->

				</div><!-- End of Page Wrapper-->
				<div id="FooterWrapper">
	
					<div id="Footer">
						<div id="FooterContent">
							
							<div class="contentArea">
				
													
									<div class=" footer-area-left">
									  <div id="text-10" class="widget widget_text">			<div class="textwidget">Copyright © 2011 · Empower – Premium Products for your health needs.</div>
					</div>						</div>
									
															
														
								<div class="clear"></div>
								
							</div> <!-- END class="contentArea" -->
							
						</div> <!-- END id="FooterContent" -->
					</div> <!-- END id="Footer" -->
				</div> <!-- END id="FooterWrapper" -->
			</div>
		</body>
</html>