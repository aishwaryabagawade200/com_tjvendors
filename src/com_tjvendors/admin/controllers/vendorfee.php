<?php
/**
 * @version    SVN: 
 * @package    Com_Tjvendors
 * @author     Techjoomla <contact@techjoomla.com>
 * @copyright  Copyright (c) 2009-2017 TechJoomla. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Vendor controller class.
 *
 * @since  1.6
 */
class TjvendorsControllerVendorFee extends JControllerForm
{
	/**
	 * Constructor
	 *
	 * @throws Exception
	 */
	public function __construct()
	{
			$this->view_list = 'vendorfees';
		$this->input = JFactory::getApplication()->input;

		if (empty($this->client))
		{
			$this->client = $this->input->get('client', '');
		}

		parent::__construct();
	}

	/**
	 * Gets the URL arguments to append to an item redirect.
	 *
	 * @param   integer  $recordId  The primary key fee_id for the item.
	 * @param   string   $urlVar    The name of the URL variable for the fee_id.
	 *
	 * @return  string  The arguments to append to the redirect URL.
	 *
	 * @since   1.6
	 */
	protected function getRedirectToItemAppend($recordId = null, $urlVar = 'id')
	{
		$input = JFactory::getApplication()->input;
		$cid = $input->post->get('cid', array(), 'array');
		$formData = new JRegistry($input->get('jform', '', 'array'));
		$currency = $formData->get('currency');
		$vendor_id = (int) $formData->get('vendor_id');
		$append = parent::getRedirectToItemAppend($recordId);
		$append .= '&vendor_id=' . $vendor_id . '&currency=' . $currency;

		return $append;
	}

	/**
	 * Gets the URL arguments to append to a list redirect.
	 *
	 * @return  string  The arguments to append to the redirect URL.
	 *
	 * @since   1.6
	 */
	protected function getRedirectToListAppend()
	{
		$input = JFactory::getApplication()->input;
		$cid = $input->post->get('cid', array(), 'array');
		$formData = new JRegistry($input->get('jform', '', 'array'));
		$vendor_id = (int) $formData->get('vendor_id');
		$append = parent::getRedirectToItemAppend($recordId);
		$append .= '&vendor_id=' . $vendor_id;

		return $append;
	}

	/**
	 * Function to edit field data
	 *
	 * @param   integer  $key  The primary key fee_id for the item.
	 * 
	 * @return  void
	 */
	public function edit($key = null)
	{
		$input = JFactory::getApplication()->input;
		$cid = $input->post->get('cid', array(), 'array');
		$vendorId = (int) (count($cid) ? $cid[0] : $input->getInt('vendor_id'));
		$feeId = (int) (count($cid) ? $cid[0] : $input->getInt('fee_id'));
		$link = JRoute::_(
		'index.php?option=com_tjvendors&view=vendorfee&layout=edit&id=' . $feeId . '&vendor_id=' . $vendorId, false
		);
		$this->setRedirect($link);
	}
}