<?php

namespace App\Data;

use App\Exceptions\MissingRequiredParameterException;

class Author extends EntityObject
{
	protected static function validateFactoryInput(array $rawData)
	{
		$return = parent::validateFactoryInput($rawData);
		if ((false !== $return) && is_array($return)) { // Check if Raw Data Passed Validation in Parent
			
			// @todo Add Validation of First Name
			// @todo Add Validation of Middle Name
			
			if (isset($rawData['last_name']) && !empty($rawData['last_name'])) { // Validate Required Last Name Parameter
				$return['lastName'] = (string) $rawData['last_name'];
			} else { // Middle of Validate Required Last Name Parameter
				throw new MissingRequiredParameterException('Missing required last name parameter (last_name)');
			} // End of Validate Required Last Name Parameter
			
			// @todo Add Validation of Pseudonyms
			
		} // End of Check if Raw Data Passed Validation in Parent
		return $return;
	}

	protected function initializeDataAttribute()
	{
		return array_merge(parent::initializeDataAttribute(), array(
			'firstName'     => null,
			'middleName'    => null,
			'lastName'      => null,
			'pseudonyms'    => array()
		));
	}

	protected function getRestrictedAttributesArray()
	{
		return array_merge(parent::getRestrictedAttributesArray(), array('pseudonyms'));
	}
}
