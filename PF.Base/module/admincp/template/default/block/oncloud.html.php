<?php 
/**
 * [Nulled by DarkGoth - NCP TEAM] - 2015
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond_Benc
 * @package 		Phpfox
 * @version 		$Id: oncloud.html.php 6554 2013-08-30 11:27:59Z Raymond_Benc $
 */
 
defined('PHPFOX') or exit('NO DICE!'); 

?>
{if isset($aHostingPackage)}
<div class="hosting_package_name">
	{$aHostingPackage.title} Package
</div>
<div class="info_header">
	OnCloud Usage
</div>
<div class="p_4">
	<div class="info">
		<div class="info_left">
			Members:
		</div>
		<div class="info_right">
			{$sTotalMemberUsage}			
		</div>
	</div>	
	<div class="info">
		<div class="info_left">		
			Space:
		</div>
		<div class="info_right">
			{$sTotalSpaceUsage}
		</div>
	</div>
	<div class="info">
		<div class="info_left">
			Videos:
		</div>
		<div class="info_right">
			{$sTotalVideoUsage}
		</div>
	</div>
</div>
Unable to load OnCloud info.