<?php

class MailchimpTest extends PHPUnit_Framework_TestCase
{
	public function testApiKey()
	{
		$mailchimp = new \mailchimp\MailchimpConnector(APIKEY_TEST);
	}

	/**
	 * @expectedException InvalidArgumentException
	**/
	public function testMalfomedApiKey()
	{
		new \mailchimp\MailchimpConnector(str_replace("-", "", APIKEY_TEST));
	}

	/**
	 * @expectedException InvalidArgumentException
	**/
	public function testBadApiKey()
	{
		new \mailchimp\MailchimpConnector(APIBADKEY_TEST);
	}
}

