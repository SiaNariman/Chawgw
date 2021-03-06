<?php
/**
 * Chawgw skin
 *
 * @file
 * @ingroup Skins
 */

class SkinChawgw extends SkinTemplate {

	public $skinname = 'chawgw', $stylename = 'chawgw',
		$template = 'ChawgwTemplate', $useHeadElement = true;

	public function initPage( OutputPage $out ) {
		parent::initPage( $out );

		/* Assures mobile devices that the site doesn't assume traditional
		 * desktop dimensions, so they won't downscale and will instead respect
		 * things like CSS's @media rules */
		$out->addHeadItem( 'viewport',
			'<meta name="viewport" content="width=device-width, initial-scale=1" />'
		);
	}

	/**
	 * @param $out OutputPage object
	 */
	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );
		$out->addModuleStyles( 'skins.chawgw' );
	}
}

class ChawgwTemplate extends BaseTemplate {
	/**
	 * Like msgWiki() but it ensures edit section links are never shown.
	 *
	 * Needed for Mediawiki 1.19 & 1.20 due to bug 36975:
	 * https://bugzilla.wikimedia.org/show_bug.cgi?id=36975
	 *
	 * @param $message Name of wikitext message to return
	 */
	function msgWikiNoEdit( $message ) {
		global $wgOut;
		global $wgParser;

		$popts = new ParserOptions();
		$popts->setEditSection( false );
		$text = wfMessage( $message )->text();
		return $wgParser->parse( $text, $wgOut->getTitle(), $popts )->getText();
	}

	/**
	 * Template filter callback for this skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 */
	public function execute() {
		$this->html( 'headelement' );

		?>

		<div class="mw-jump">
			<a href="#bodyContent"><?php $this->msg( 'chawgw-skiptocontent' ) ?></a><?php $this->msg( 'comma-separator' ) ?>
			<a href="#search"><?php $this->msg( 'chawgw-skiptosearch' ) ?></a>
		</div>

		<div id="top-wrap" role="banner">
			<div id="serxirr"> <a href="/">
				<?php echo Html::element( 'img', array( 'id' => 'logo', 'src' => $this->data['logopath'], 'alt' => '' ) ); ?>
			</a>

			<div id="torrlink">
			<ul>
			<li><a href="https://plus.google.com/105529644745701857276" rel="publisher"><img src="http://chawg.org/meko/style/AirFixed_rtl/img/google_plus.png" alt="Chawg on GooglePlus" /></a></li>
			<li><a href="https://www.facebook.com/chawg"><img src="http://chawg.org/meko/style/AirFixed_rtl/img/facebook.png" alt="Chawg on Facebook" /></a></li>
			<li><a href="https://twitter.com/chawg"><img src="http://chawg.org/meko/style/AirFixed_rtl/img/twitter.png" alt="Chawg on Twitter" /></a></li> 
			</ul>
			<!-- Sereta  GERRAN xishte-->
				<form action="<?php $this->text( 'wgScript' ); ?>" id="searchform">
					<input type='hidden' name="title" value="<?php $this->text( 'searchtitle' ) ?>" />
					<div>
						<?php echo $this->makeSearchInput( array( 'type' => 'text', 'id' => 's' ) ); ?>
						<?php echo $this->makeSearchButton( 'go', array(
							'value' => $this->translator->translate( 'searchbutton' ),
							'class' => "searchButton",
							'id'    => "searchsubmit",
						) ); ?>
					</div>
				</form>
				<!-- Kotaiy -->
			</div>
			
			</div>
			<!--<div id="tagline"><?php $this->msg( 'tagline' ) ?></div>-->

			<a id="menubutton" href="#menu">Menu</a>
			<div id="nav" role="navigation">
			<?php
				if( array_key_exists( 'navigation', $this->data['sidebar'] ) ) {
					echo "<ul id='menu'>\n";
					foreach( $this->data['sidebar']['navigation'] as $item ) {
						printf( '<li id="menu-item-%s">', Sanitizer::escapeId( $item['id'] ) );
						printf( '<a href="%s">%s</a>', htmlspecialchars( $item['href'] ), htmlspecialchars( $item['text'] ) );
						echo "</li>\n";
					}
					echo "</ul>\n";
				}
			?>
			</div>
		</div>

		<div id="mw-js-message"></div>
		<?php
			foreach( array( 'newtalk', 'sitenotice', 'undelete' ) as $msg ) {
				if( $this->data[$msg] ) {
					echo "<div id='$msg' class='message'><p>";
					$this->html( $msg );
					echo '</p></div>';
				}
			}
		?>

		<div id="main" role="main">
			<div id="navcontainer">
			<ul>
			<?php
				foreach ( $this->data['content_actions'] as $key => $tab ) {
					echo $this->makeListItem( $key, $tab, array( 'tag' => 'li' ) );
					echo '<li class="meta-sep"></li>';
				}
			?>
			</ul>
			</div>

			<div id="bodyContent">
				<h1><?php $this->html( 'title' ); ?></h1>
				<?php if ( $this->data['subtitle'] ) { ?>
					<div class="subtitle"><?php $this->html( 'subtitle' ) ?></div>
				<?php } ?>

				<?php $this->html( 'bodytext' ) ?>
				<?php $this->html( 'dataAfterContent' ); ?>
			</div>

			<div id="footer">
				<?php
					foreach ( $this->getFooterLinks() as $category => $links ) {
						if ( $category === 'info' ) {
							foreach ( $links as $key ) {
								echo '<p>';
								$this->html( $key );
								echo '</p>';
							}
						} else {
							echo '<ul>';
							foreach ( $links as $key ) {
								echo '<li>';
								$this->html( $key );
								echo '</li>';
							}
							echo '</ul>';
						}
					}
				?>
			</div>

			<?php $this->html( 'catlinks' ); ?>
		</div>

		<div id="bottom-wrap">
		<div id="footer-wrap-inner">

		<div id="primary" class="footer">
			<ul>

			

			<?php if( $this->data['language_urls'] ) { ?>
				<li>
					<h3><?php $this->msg( 'otherlanguages' ) ?></h3>
					<ul>
					<?php
						foreach( $this->data['language_urls'] as $key => $langlink ) {
							echo $this->makeListItem( $key, $langlink );
						}
					?>
					</ul>
				</li>
			<?php } ?>

			<?php if( $this->getPersonalTools() ) { ?>
			<li class="widget">
				<h3><?php $this->msg( 'personaltools' ) ?></h3>
				<div>
					<ul>
					<?php
						foreach ( $this->getPersonalTools() as $key => $item ) {
							echo $this->makeListItem( $key, $item );
						}
					?>
					</ul>
				</div>
			</li>
			<?php } ?>

			<li class="widget">
				<?php echo $this->msgWikiNoEdit( 'chawgw-extracontent-column1' ); ?>
			</li>

			</ul>
		</div>

		<div id="secondary" class="footer">
			<ul>

			<li id="toolbox" class="widget">
				<h3><?php $this->msg( 'toolbox' ) ?></h3>
				<ul>
				<?php
					foreach ( $this->getToolbox() as $key => $tbitem ) {
						echo $this->makeListItem( $key, $tbitem );
					}
					wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this ) );
				?>
				</ul>
			</li>

			<?php
				foreach( $this->data['sidebar'] as $name => $menu ) {
					/* standard menus are already handled elsewhere */
					if( empty($menu) ||
					    $name == 'navigation' ||
					    $name == 'SEARCH' ||
					    $name == 'LANGUAGES' ||
					    $name == 'TOOLBOX' ) {
						continue;
					}
					echo "<li class='widget'>";
					$msgObj = wfMessage( $name );
					$heading = $msgObj->exists() ? $msgObj->text() : $name;
					printf( '<h3>%s</h3>', htmlspecialchars( $heading ) );
					echo "<ul>\n";
					foreach( $menu as $item ) {
						printf( '<li><a href="%s">%s</a></li>' . "\n",
						        htmlspecialchars( $item['href'] ),
						        htmlspecialchars( $item['text'] ) );
					}
					echo "</ul></li>\n";
				}
			?>

			<li class="widget">
				<?php echo $this->msgWikiNoEdit( 'chawgw-extracontent-column2' ); ?>
			</li>

			</ul>
		</div>

		<div id="ternary" class="footer">
			<ul>

			<!-- <li class="widget">
				<?php echo Html::element( 'img', array( 'id' => 'logo', 'src' => $this->data['logopath'], 'alt' => '' ) ); ?>
			</li> -->
			
			<li class="widget">
				<?php echo $this->msgWikiNoEdit( 'chawgw-extracontent-column3' ); ?>
			</li>
				<h3> بەشەکان </h3>
							<li><a href="http://chawg.org/meko">مەکۆکان</a></li>
							<li><a href="http://chawg.org/meko؟کۆن">مەکۆی ئەرشیف</a></li>
							<li><a href="/wiki/چاوگ:سەبارەت">دەربارە</a></li>
			</ul>
		</div>
		<div style="clear: both"></div>

		</div>
		</div>

		<?php $this->printTrail(); ?>

		</body>
		</html>
		<?php
	}
}
