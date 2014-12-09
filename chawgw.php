<?php
/**
 * Chawgw MW skin
 *
 * @file
 * @ingroup Skins
 * @author Sia Nariman
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

if( !defined( 'MEDIAWIKI' ) ) die( 'This is an extension to the MediaWiki package and cannot be run standalone.' );

$wgExtensionCredits['skin'][] = array(
	'path' => __FILE__,
	'name' => 'Chawgw',
	'url' => 'http://www.chawg.org/wiki',
	'author' => array( 'Sia', 'Others' ),
	'version' => '1.1',
	'descriptionmsg' => 'chawgw-desc',
);

$wgValidSkinNames['chawgw'] = 'Chawgw';
$wgAutoloadClasses['SkinChawgw'] = __DIR__ . '/Chawgw.skin.php';
$wgExtensionMessagesFiles['Chawgw'] =  __DIR__ . '/Chawgw.i18n.php';

$wgResourceModules['skins.chawgw'] = array(
	'styles' => array(
		'assets/cssreset.css' => array( 'media' => 'screen' ),
		'assets/chawgw.css' => array( 'media' => 'screen' ),
		'assets/chawgw66em.css' => array( 'media' => 'screen and (max-width: 66em)' ),
		'assets/chawgw60em.css' => array( 'media' => 'screen and (max-width: 60em)' ),
		'assets/chawgw55em.css' => array( 'media' => 'screen and (max-width: 55em)' ),
		'assets/chawgw40em.css' => array( 'media' => 'screen and (max-width: 40em)' ),
		'assets/chawgw20em.css' => array( 'media' => 'screen and (max-width: 20em)' ),
		'assets/print.css' => array( 'media' => 'print' ),
	),
		'remoteBasePath' => 'chawgw',
		'localBasePath' => __DIR__,
);
