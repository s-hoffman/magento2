<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Webhook
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * The list of available authentication types
 */
class Mage_Webhook_Model_Source_Authentication
{
    /**
     * Path to environments section in the config
     * @var string
     */
    const XML_PATH_AUTHENTICATIONS = 'global/webhook/authentication_types';

    /**
     * Cash of options
     * @var null|array
     */
    protected $_options = null;

    /**
     * Get available authentication types
     *
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->_options) {
            return $this->_options;
        }

        $this->_options = array();

        $config = Mage::getConfig()->getNode(self::XML_PATH_AUTHENTICATIONS);
        if (!$config) {
            return $this->_options;
        }
        $this->_options = $config->asArray();

        return $this->_options;
    }

    public function getAuthenticationsForForm()
    {
        $elements = array();
        foreach ($this->toOptionArray() as $authName => $authentication) {
            $elements[] = array(
                'label' => Mage::helper('Mage_Webhook_Helper_Data')->__($authentication['label']),
                'value' => $authName,
            );
        }

        return $elements;
    }
}
