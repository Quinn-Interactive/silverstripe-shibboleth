<?php

/**
 * The SAML2_ArtifactResponse, is the response to the SAML2_ArtifactResolve.
 *
 * @author Danny Bollaert, UGent AS. <danny.bollaert@ugent.be>
 * @package simpleSAMLphp
 * @version $Id$
 */
class SAML2_ArtifactResponse extends SAML2_StatusResponse {


	/**
	 * @var any contains saml2message XML
	 */
	private $any;


	public function __construct(DOMElement $xml = NULL) {
		parent::__construct('ArtifactResponse', $xml);

		if(!is_null($xml)){

			$status = SAML2_Utils::xpQuery($xml, './saml_protocol:Status');
			assert('!empty($status)'); /* Will have failed during StatusResponse parsing. */

			$status = $status[0];

			for ($any = $status->nextSibling; $any !== NULL; $any = $any->nextSibling) {
				if ($any instanceof DOMElement) {
					$this->any = $any;
					break;
				}
				/* Ignore comments and text nodes. */
			}
		}

	}


	public function setAny(DOMElement $any) {
		assert('!is_null($any)');
		$this->any = $any;
	}


	public function getAny() {
		return $this->any;
	}


	/**
	 * Convert the response message to an XML element.
	 *
	 * @return DOMElement  This response.
	 */
	public function toUnsignedXML() {

		$root = parent::toUnsignedXML();
		if (isset($this->any)) {
			$node = $root->ownerDocument->importNode($this->any, TRUE);
			$root->appendChild($node);

		}

		return $root;
	}

}
