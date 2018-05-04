<?php
/**
 * Edit button structure.
 *
 * @package Stax
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<a href="<?php echo esc_url( add_query_arg( array( 'stax-editor' => '' ) ) ); ?>" class="sq-opener">
	<span tooltip="Edit header with STAX" flow="left">
		<span class="uiIcon uiIcon--s button--s button--ghost bg-silver--hover" role="button">
			<svg class="svgIcon fill-white" width="28" height="28" viewBox="0 0 24 24">
				<path fill="#ffffff" d="M5,3V12H3V14H5V21H7V14H9V12H7V3M11,3V8H9V10H11V21H13V10H15V8H13V3M17,3V14H15V16H17V21H19V16H21V14H19V3"></path>
			</svg>
		</span>
	</span>
</a>
