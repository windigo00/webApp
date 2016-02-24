<?php
namespace App\Helper;

/**
 * Description of XMLHelper
 *
 * @author KuBik
 */
class XMLHelper
{
	/**
	 * 
	 * @param \DOMNode $root
	 * @param int $filterOut Filter out element types. eg XML_TEXT_NODE
	 * @return \stdClass
	 */
	public static function xml_to_std(\DOMNode $root, $filterOut = []) {
		$result = new \stdClass;
		$result->name = $root->nodeName;
		if ($root->hasAttributes()) {
			$attrs = $root->attributes;
			$result->attributes = new \stdClass;
			foreach ($attrs as $attr) {
				$result->attributes->{$attr->name} = $attr->value;
			}
		}
		
		if ($root->hasChildNodes()) {
			$children = $root->childNodes;
			$result->children = array();
			foreach ($children as $child) {
				if (in_array($child->nodeType, $filterOut)) continue;
				$result->children[] = self::xml_to_std($child, $filterOut);
			}
		}
		return $result;
	}
	
	/**
	 * 
	 * @param \DOMNode $root
	 * @return array
	 */
	public static function xml_to_array(\DOMNode $root) {
		$result = array();

		if ($root->hasAttributes()) {
			$attrs = $root->attributes;
			foreach ($attrs as $attr) {
				$result['@attributes'][$attr->name] = $attr->value;
			}
		}

		if ($root->hasChildNodes()) {
			$children = $root->childNodes;
			if ($children->length == 1) {
				$child = $children->item(0);
				if ($child->nodeType == XML_TEXT_NODE) {
					$result['_value'] = $child->nodeValue;
					return count($result) == 1
						? $result['_value']
						: $result;
				}
			}
			$groups = array();
			foreach ($children as $child) {
				if (!isset($result[$child->nodeName])) {
					$result[$child->nodeName] = self::xml_to_array($child);
				} else {
					if (!isset($groups[$child->nodeName])) {
						$result[$child->nodeName] = array($result[$child->nodeName]);
						$groups[$child->nodeName] = 1;
					}
					$result[$child->nodeName][] = self::xml_to_array($child);
				}
			}
		}

		return $result;
	}
}
