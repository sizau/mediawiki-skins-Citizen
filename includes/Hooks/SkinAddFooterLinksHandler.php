<?php

declare( strict_types=1 );

namespace MediaWiki\Skins\Citizen\Hooks;

use MediaWiki\Hook\SkinAddFooterLinksHook;
use Skin;

/**
 * Handler for adding custom footer links (e.g., ICP records)
 */
class SkinAddFooterLinksHandler implements SkinAddFooterLinksHook {

	/**
	 * Add custom footer links
	 *
	 * @param Skin $skin
	 * @param string $key The category of footer links
	 * @param array &$footerItems Array of footer items
	 */
	public function onSkinAddFooterLinks( Skin $skin, string $key, array &$footerItems ) {
		if ( $key !== 'places' ) {
			return;
		}

		$config = $skin->getConfig();

		// Add custom footer links if configured
		$customLinks = $config->get( 'CitizenFooterCustomLinks' );
		if ( $customLinks && is_array( $customLinks ) ) {
			foreach ( $customLinks as $key => $link ) {
				if ( isset( $link['text'] ) && isset( $link['url'] ) ) {
					$footerItems[$key] = $this->makeFooterLink(
						$link['text'],
						$link['url'],
						$link['title'] ?? $link['text'],
						$link['icon'] ?? null
					);
				}
			}
		}
				
		// Add ICP record if configured
		$icpRecord = $config->get( 'CitizenFooterICPRecord' );
		if ( $icpRecord ) {
			$footerItems['icprecord'] = $this->makeFooterLink(
				$icpRecord['text'],
				$icpRecord['url'] ?? 'https://beian.miit.gov.cn/',
				$icpRecord['title'] ?? '中华人民共和国工业和信息化部 - ICP/IP地址/域名信息备案管理系统',
				$icpRecord['icon'] ?? null
			);
		}

		// Add PSB (Public Security Bureau) record if configured
		$psbRecord = $config->get( 'CitizenFooterPSBRecord' );
		if ( $psbRecord ) {
			$footerItems['psbrecord'] = $this->makeFooterLink(
				$psbRecord['text'],
				$psbRecord['url'] ?? 'http://beian.mps.gov.cn/',
				$psbRecord['title'] ?? '中华人民共和国公安部 - 全国互联网安全管理平台',
				$psbRecord['icon'] ?? null
			);
		}
	}

	/**
	 * Create a footer link HTML
	 *
	 * @param string $text Link text
	 * @param string $url Link URL
	 * @param string $title Link title attribute
	 * @param string|null $icon Icon URL (optional)
	 * @return string HTML string
	 */
	private function makeFooterLink( string $text, string $url, string $title, ?string $icon = null ): string {
		$external = strpos( $url, 'http' ) === 0 && strpos( $url, $_SERVER['HTTP_HOST'] ?? '' ) === false;
		$attributes = [
			'href' => $url,
			'title' => $title,
		];

		if ( $external ) {
			$attributes['rel'] = 'noreferrer noopener';
			$attributes['target'] = '_blank';
		}

		$attrString = '';
		foreach ( $attributes as $key => $value ) {
			$attrString .= ' ' . $key . '="' . htmlspecialchars( $value, ENT_QUOTES ) . '"';
		}

		$content = '';
		if ( $icon ) {
			$content .= '<img src="' . htmlspecialchars( $icon, ENT_QUOTES ) . '" alt="" style="display: inline-block; vertical-align: middle; height: 16px; width: auto;"> ';
		}
		$content .= '<span style="display: inline-block; vertical-align: middle;">' . htmlspecialchars( $text ) . '</span>';

		return '<a' . $attrString . '>' . $content . '</a>';
	}
}
