<?php
namespace Unit1\CustomConfig\Model\Config;

class Converter implements \Magento\Framework\Config\ConverterInterface
{
    public function convert($source)
    {
        $output = [];
        $xpath = new \DOMXPath($source);

        $messages = $xpath->evaluate('/config/welcome_message');

        foreach ($messages as $messageNode) {

            $storeId = $this->getAttributeValue($messageNode, 'store_id');

            $message = trim($messageNode->nodeValue);

            $output['messages'][$storeId] = [
                'message' => $message
            ];
        }

        return $output;
    }

    private function getAttributeValue(\DOMNode $node, $attributeName)
    {
        $attr = $node->attributes->getNamedItem($attributeName);
        return $attr ? $attr->nodeValue : null;
    }
}
