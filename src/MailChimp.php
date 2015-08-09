<?php

namespace mailchimp;

$classdir = dirname(__FILE__).'/';
require_once($classdir.'MailList.php');

class MailchimpConnector
{
	/**
	 * @var string $apiKey
	 * Mailchimp auth key
	**/
	private $apiKey;

	/**
	 * @var string $dc
	 * Mailchimp data center
	**/
	private $dc;

	/**
	 * @var string $endPoint
	**/
	private $endPoint;

	/**
	 * @param string $apiKey
	**/
	public function __construct($apiKey)
	{
		if (strpos($apiKey, "-") === false)
			throw new \InvalidArgumentException("Malformed Api Key");
		$this->apiKey = $apiKey;
		$this->dc = (substr($apiKey, strpos($apiKey, "-") +1));
		$this->endPoint = "https://".$this->dc.".api.mailchimp.com/2.0/";
		if (!$this->checkApiKey())
			throw new \InvalidArgumentException("Cannot verify ApiKey");
	}

	/**
	 * Check Api Key's validity
	 * @return boolean true if key is correct
	**/
	public function checkApiKey()
	{
		try
		{
			$this->request("helper/ping");
		}
		catch (\Exception $e)
		{
			return false;
		}
		return true;
	}

	/**
	 * Return List of existsing MailingList
	 * @return array(MailingList)
	**/
	public function getLists($name=null)
	{
		$request = $this->request("lists/list");
		$data = $request->data;
		if ($name === null)
		{
			$result = array();
			foreach ($data as $i)
				$result[] = MailingList::fromMailchimpRequest($i);
			return $result;
		}
		foreach ($data as $i)
			if ($i->id == $name || $i->name == $name)
				return MailingList::fromMailchimpRequest($i);
		return null;
	}

	/**
	 * @param string $method
	 * @param array $params
	 * @return array json result
	 * Send the query to Mailchimp and return the result
	**/
	public function request($method, $params=array())
	{
		$params["apikey"] = $this->apiKey;
		$args = json_encode($params);
		$curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $this->endPoint.$method.'.json');
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 10);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $args);
		$result = curl_exec($curl);
		if (!$result || curl_getinfo($curl, CURLINFO_HTTP_CODE) != 200)
		{
			curl_close($curl);
			throw new \Exception("Mailchimp request error");
		}
		curl_close($curl);
		$result = json_decode($result);
		return $result;
	}
}

