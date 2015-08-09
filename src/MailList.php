<?php

namespace mailchimp;

class MailingList
{
	/**
	 * @var string $id
	**/
	private $id;

	/**
	 * @var string $name
	**/
	private $name;

	/**
	 * @var DateTime $created
	**/
	private $created;

	/**
	 * @var string $from_email
	**/
	private $from_email;

	/**
	 * @var string $from_name
	**/
	private $from_name;

	/**
	 * @var default_subject
	**/
	private $default_subject;

	/**
	 * @var default_language
	**/
	private $default_language;

	/**
	 * @var string $subscribe_url_short
	**/
	private $subscribe_url_short;

	/**
	 * @var string $subscribe_url_long
	**/
	private $subscribe_url_long;

	/**
	 * @var array $stats
	**/
	private $stats;

	/**
	 * @var array $allFields
	**/
	private $allFields;

	public function __construct()
	{ }

	/**
	 * Create an instance of MailingList from given response
	 * @param array $request
	 * @return MailingList instance
	**/
	public static function fromMailchimpRequest($request)
	{
		$instance = new self();
		$instance->id = $request->id;
		$instance->name = $request->name;
		$instance->created = new \DateTime($request->date_created);
		$instance->from_email = $request->default_from_email;
		$instance->from_name = $request->default_from_name;
		$instance->default_subject = $request->default_subject;
		$instance->default_language = $request->default_language;
		$instance->subscribe_url_short = $request->subscribe_url_short;
		$instance->subscribe_url_long = $request->subscribe_url_long;
		$instance->stats = $request->stats;
		$instance->allFields = $request;
		return $instance;
	}

	public function getStats()
	{
		$result = array();
		foreach ($this->stats as $i => $j)
			$result[$i] = $j;
		return $result;
	}

	public function __get($key)
	{
		if ($key == "stats")
			return $this->getStats();
		else if (property_exists($this, $key))
			return $this->$key;
	}
}

