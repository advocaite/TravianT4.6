<?php

class ClouDNS_SDK {

	protected $id;
	protected $password;
	protected $user_type;

	function __construct($auth_id, $auth_password, $is_subuser = false) {
		if ($is_subuser == false) {
			$this->user_type = 'auth-id';
		} else {
			if (is_numeric($auth_id)) {
				$this->user_type = 'sub-auth-id';
			} else {
				$this->user_type = 'sub-auth-user';
			}
		}
		$this->id = $auth_id;
		$this->password = $auth_password;
	}

	private function apiRequest($api_data, $api_url) {

		$init = curl_init();
		curl_setopt($init, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($init, CURLOPT_URL, 'https://api.cloudns.net/' . $api_url . '.json');
		curl_setopt($init, CURLOPT_POST, true);
		curl_setopt($init, CURLOPT_POSTFIELDS, $this->user_type . '=' . $this->id . '&auth-password=' . $this->password . $api_data);

		$content = curl_exec($init);

		curl_close($init);

		return json_decode($content, true);
	}

	public function apiLogin() {
		$url = 'dns/login';

		return $this->apiRequest(false, $url);
	}

	public function dnsResgisterDomainZone($domain_name, $zone_type, $ns = false, $master_ip = false) {
		$data = '&domain-name=' . $domain_name . '&zone-type=' . $zone_type .
			'&ns=' . $ns . '&master-ip=' . $master_ip;
		$url = 'dns/register';

		return $this->apiRequest($data, $url);
	}

	public function dnsAvailableNameServers() {
		$url = 'dns/available-name-servers';

		return $this->apiRequest(false, $url);
	}

	public function dnsDeleteDomainZone($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/delete';

		return $this->apiRequest($data, $url);
	}

	public function dnsListZones($page, $rows_per_page, $search = false) {
		$data = '&page=' . $page . '&rows-per-page=' . $rows_per_page .
			'&search=' . $search;
		$url = 'dns/list-zones';

		return $this->apiRequest($data, $url);
	}

	public function dnsGetPagesCount($rows_per_page, $search = false) {
		$data = '&rows-per-page=' . $rows_per_page . '&search=' . $search;
		$url = 'dns/get-pages-count';

		return $this->apiRequest($data, $url);
	}

	public function dnsGetZonesStatistics() {
		$url = 'dns/get-zones-stats';

		return $this->apiRequest(false, $url);
	}

	public function dnsGetMailForwardsStatistics() {
		$url = 'dns/get-mail-forwards-stats';

		return $this->apiRequest(false, $url);
	}

	public function dnsGetZoneInformation($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/get-zone-info';

		return $this->apiRequest($data, $url);
	}

	public function dnsUpdateZone($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/update-zone';

		return $this->apiRequest($data, $url);
	}

	public function dnsUpdateStatus($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/update-status';

		return $this->apiRequest($data, $url);
	}

	public function dnsIsUpdated($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/is-updated';

		return $this->apiRequest($data, $url);
	}

	public function dnsChangeZonesStatus($domain_name, $status = false) {
		$data = '&domain-name=' . $domain_name . '&status=' . $status;
		$url = 'dns/change-status';

		return $this->apiRequest($data, $url);
	}

	public function dnsListRecords($domain_name, $host = false, $type = false) {
		$data = '&domain-name=' . $domain_name . '&host=' . $host . '&type=' . $type;
		$url = 'dns/records';

		return $this->apiRequest($data, $url);
	}

	public function dnsAddRecord($domain_name, $record_type, $host, $record, $ttl, $priority = false, $weight = false, $port = false, $frame = false, $frame_title = false, $frame_keywords = false, $frame_description = false, $save_path = false, $redirect_type = false, $mail = false, $txt = false, $algorithm = false, $fptype = false, $status = false, $geodns_location = false, $caa_flag = false, $caa_type = false, $caa_value = false) {

		$data = '&domain-name=' . $domain_name . '&record-type=' . $record_type . '&host=' . $host . '&record=' . $record . '&ttl=' . $ttl .
			'&priority=' . $priority . '&weight=' . $weight . '&port=' . $port . '&frame=' . $frame . '&frame-title=' . $frame_title .
			'&frame-keywords=' . $frame_keywords . '&frame-description=' . $frame_description . '&save-path=' . $save_path .
			'&redirect-type=' . $redirect_type . '&mail=' . $mail . '&txt=' . $txt . '&algorithm=' . $algorithm . '&fptype=' . $fptype .
			'&status=' . $status . '&geodns_location=' . $geodns_location . '&caa_flag=' . $caa_flag . '&caa_type=' . $caa_type . '&caa_value' . $caa_value;
		$url = 'dns/add-record';

		return $this->apiRequest($data, $url);
	}

	public function dnsDeleteRecord($domain_name, $record_id) {
		$data = '&domain-name=' . $domain_name . '&record-id=' . $record_id;
		$url = 'dns/delete-record';

		return $this->apiRequest($data, $url);
	}

	public function dnsModifyRecord($domain_name, $record_id, $host, $record, $ttl, $priority = false, $weight = false, $port = false, $frame = false, $frame_title = false, $frame_keywords = false, $frame_description = false, $save_path = false, $redirect_type = false, $mail = false, $txt = false, $algorithm = false, $fptype = false, $status = false, $geodns_location = false, $caa_flag = false, $caa_type = false, $caa_value = false) {

		$data = '&domain-name=' . $domain_name . '&record-id=' . $record_id . '&host=' . $host . '&record=' . $record . '&ttl=' . $ttl .
			'&priority=' . $priority . '&weight=' . $weight . '&port=' . $port . '&frame=' . $frame . '&frame-title=' . $frame_title .
			'&frame-keywords=' . $frame_keywords . '&frame-description=' . $frame_description . '&save-path=' . $save_path .
			'&redirect-type=' . $redirect_type . '&mail=' . $mail . '&txt=' . $txt . '&algorithm=' . $algorithm . '&fptype=' . $fptype .
			'&status=' . $status . '&geodns_location=' . $geodns_location . '&caa_flag=' . $caa_flag . '&caa_type=' . $caa_type . '&caa_value' . $caa_value;
		$url = 'dns/mod-record';

		return $this->apiRequest($data, $url);
	}

	public function dnsCopyRecords($domain_name, $from_domain, $delete_current_records = false) {
		$data = '&domain-name=' . $domain_name . '&from-domain=' . $from_domain .
			'&delete-current-records=' . $delete_current_records;
		$url = 'dns/copy-records';

		return $this->apiRequest($data, $url);
	}

	public function dnsImportRecords($domain_name, $format, $content, $delete_existing_records = false) {
		$data = '&domain-name=' . $domain_name . '&format=' . $format .
			'&content=' . $content . '&delete-existing-records=' . $delete_existing_records;
		$url = 'dns/records-import';

		return $this->apiRequest($data, $url);
	}

	public function dnsExportRecordsBIND($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/records-export';

		return $this->apiRequest($data, $url);
	}

	public function dnsGetAvailableRecords($zone_type) {
		$data = '&zone-type=' . $zone_type;
		$url = 'dns/get-available-record-types';

		return $this->apiRequest($data, $url);
	}

	public function dnsGetAvailableTTL() {
		$url = 'dns/get-available-ttl';

		return $this->apiRequest(false, $url);
	}

	public function dnsGetSOA($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/soa-details';

		return $this->apiRequest($data, $url);
	}

	public function dnsModifySOA($domain_name, $primary_ns, $admin_mail, $refresh, $retry, $expire, $default_ttl) {
		$data = '&domain-name=' . $domain_name . '&primary-ns=' . $primary_ns .
			'&admin-mail=' . $admin_mail . '&refresh=' . $refresh .
			'&retry=' . $retry . '&expire=' . $expire . '&default-ttl=' . $default_ttl;
		$url = 'dns/modify-soa';

		return $this->apiRequest($data, $url);
	}

	public function dnsGetDynamicURL ($domain_name, $record_id) {
		$data = '&domain-name=' . $domain_name . '&record-id=' . $record_id;
		$url = 'dns/get-dynamic-url';
		
		return $this->apiRequest($data, $url);
	}
	
	public function dnsDisableDynamicURL($domain_name, $record_id) {
		$data = '&domain-name=' . $domain_name . '&record-id=' . $record_id;
		$url = 'dns/disable-dynamic-url';

		return $this->apiRequest($data, $url);
	}

	public function dnsChangeDynamicURL($domain_name, $record_id) {
		$data = '&domain-name=' . $domain_name . '&record-id=' . $record_id;
		$url = 'dns/change-dynamic-url';

		return $this->apiRequest($data, $url);
	}

	public function dnsImportViaTransfer($domain_name, $server) {
		$data = '&domain-name=' . $domain_name . '&server=' . $server;
		$url = 'dns/change-dynamic-url';

		return $this->apiRequest($data, $url);
	}

	public function dnsChangeRecordStatus($domain_name, $record_id, $status = false) {
		$data = '&domain-name=' . $domain_name . '&record-id=' . $record_id .
			'&status=' . $status;
		$url = 'dns/change-record-status';

		return $this->apiRequest($data, $url);
	}

	public function dnsAddMasterServer($domain_name, $master_ip) {
		$data = '&domain-name=' . $domain_name . '&master-ip=' . $master_ip;
		$url = 'dns/add-master-server';

		return $this->apiRequest($data, $url);
	}

	public function dnsDeleteMasterServer($domain_name, $master_id) {
		$data = '&domain-name=' . $domain_name . '&master-id=' . $master_id;
		$url = 'dns/delete-master-server';

		return $this->apiRequest($data, $url);
	}

	public function dnsListMasterServer($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/master-servers';

		return $this->apiRequest($data, $url);
	}
	
	public function dnsMailForwardsStats() {
		$url = 'dns/get-mailforward-stats';

		return $this->apiRequest(false, $url);
	}

	public function dnsAvailableMailForwards() {
		$url = 'dns/get-mailforward-servers';

		return $this->apiRequest(false, $url);
	}

	public function dnsAddMailForward($domain_name, $box, $host, $destination) {
		$data = '&domain-name=' . $domain_name . '&box=' . $box . '&host=' . $host .
			'&destination=' . $destination;
		$url = 'dns/add-mail-forward';

		return $this->apiRequest($data, $url);
	}

	public function dnsDeleteMailForward($domain_name, $mail_forward_id) {
		$data = '&domain-name=' . $domain_name . '&mail-forward-id=' . $mail_forward_id;
		$url = 'dns/delete-mail-forward';

		return $this->apiRequest($data, $url);
	}

	public function dnsModifyMailForward($domain_name, $box, $host, $destination, $mail_forward_id) {
		$data = '&domain-name=' . $domain_name . '&box=' . $box . '&host=' . $host .
			'&destination=' . $destination . '&mail-forward-id=' . $mail_forward_id;
		$url = 'dns/modify-mail-forward';

		return $this->apiRequest($data, $url);
	}

	public function dnsListMailForwards($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/mail-forwards';

		return $this->apiRequest($data, $url);
	}

	public function dnsAddCloudDomain($domain_name, $cloud_domain_name) {
		$data = '&domain-name=' . $domain_name . '&cloud-domain-name=' . $cloud_domain_name;
		$url = 'dns/add-cloud-domain';

		return $this->apiRequest($data, $url);
	}

	public function dnsDeleteCloudDomain($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/delete-cloud-domain';

		return $this->apiRequest($data, $url);
	}

	public function dnsChangeCloudMaster($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/set-master-cloud-domain';

		return $this->apiRequest($data, $url);
	}

	public function dnsListCloudDomains($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/list-cloud-domains';

		return $this->apiRequest($data, $url);
	}

	public function dnsAllowNewIP($domain_name, $ip) {
		$data = '&domain-name=' . $domain_name . '&ip=' . $ip;
		$url = 'dns/axfr-add';

		return $this->apiRequest($data, $url);
	}

	public function dnsDeleteAllowedIP($domain_name, $id) {
		$data = '&domain-name=' . $domain_name . '&id=' . $id;
		$url = 'dns/axfr-remove';

		return $this->apiRequest($data, $url);
	}

	public function dnsListAllowedIP($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/axfr-list';

		return $this->apiRequest($data, $url);
	}

	public function dnsHourlyStatistics($domain_name, $year, $month, $day) {
		$data = '&domain-name=' . $domain_name . '&year=' . $year .
			'&month=' . $month . '&day=' . $day;
		$url = 'dns/statistics-hourly';

		return $this->apiRequest($data, $url);
	}

	public function dnsDailyStatistics($domain_name, $year, $month) {
		$data = '&domain-name=' . $domain_name . '&year=' . $year . '&month=' . $month;
		$url = 'dns/statistics-daily';

		return $this->apiRequest($data, $url);
	}

	public function dnsMonthlyStatistics($domain_name, $year) {
		$data = '&domain-name=' . $domain_name . '&year=' . $year;
		$url = 'dns/statistics-monthly';

		return $this->apiRequest($data, $url);
	}

	public function dnsYearlyStatistics($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/statistics-yearly';

		return $this->apiRequest($data, $url);
	}

	public function dnsLast30DaysStatistics($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/statistics-last-30-days';

		return $this->apiRequest($data, $url);
	}

	public function dnsGetParkedTemplates() {
		$url = 'dns/get-parked-templates';

		return $this->apiRequest(false, $url);
	}

	public function dnsGetParkedSettings($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/get-parked-settings';

		return $this->apiRequest($data, $url);
	}

	public function dnsModifyParkedSettings($domain_name, $template, $title = false, $description = false, $keywords = false, $contact_form = false) {
		$data = '&domain-name=' . $domain_name . '&template=' . $template .
			'&title=' . $title . '&description=' . $description .
			'&keywords=' . $keywords . '&contact-form=' . $contact_form;
		$url = 'dns/set-parked-settings';

		return $this->apiRequest($data, $url);
	}

	public function dnsListGeoDNSLocations($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'dns/get-geodns-locations';

		return $this->apiRequest($data, $url);
	}

	public function domainCheckAvailability($name, $tld = array()) {
		$data = '&name=' . $name;
		if (is_array($tld)) {
			foreach ($tld as $value) {
				$data = $data . '&tld[]=' . $value;
			}
			$url = 'domains/check-available';

			return $this->apiRequest($data, $url);
		}
		return "Invalid array!";
	}

	public function domainsPriceList() {
		$url = 'domains/pricing-list';

		return $this->apiRequest(false, $url);
	}

	public function domainsRegisterNewDomain($domain_name, $tld, $period, $mail, $name, $company, $address, $city, $state, $zip, $country, $telnocc, $telno, $faxnocc = false, $faxno = false, $ns = false, $registrant_type = false, $registrant_type_id = false, $registrant_policy = false, $birth_date = false, $birth_cc = false, $birth_city = false, $birth_zip = false, $publication = false, $vat = false, $siren = false, $duns = false, $trademark = false, $waldec = false, $registrant_type_other = false, $privacy_protection = false, $code = false, $publicity = false, $kpp = false, $passport_number = false, $passport_issued_by = false, $passport_issued_on = false) {
		if (!is_array($ns) && ($ns != false)) {
			return "Invalid ns array!";
		}
		$data = '&domain-name=' . $domain_name . '&tld=' . $tld . '&period=' . $period .
			'&mail=' . $mail . '&name=' . $name . '&company=' . $company . '&address=' .
			$address . '&city=' . $city . '&state=' . $state . '&zip=' . $zip .
			'&country=' . $country . '&telnocc=' . $telnocc . '&telno=' . $telno .
			'&faxnocc=' . $faxnocc . '&faxno=' . $faxno;
		if ($ns != false) {
			foreach ($ns as $value) {
				$data = $data . '&ns[]=' . $value;
			}
		} else {
			$data = $data . '&ns=' . $ns;
		}
		$data = $data . '&registrant_type=' . $registrant_type .
			'&registrant_type_id=' . $registrant_type_id . '&registrant_policy=' . $registrant_policy .
			'&birth_date=' . $birth_date . '&birth_cc=' . $birth_cc . '&birth_city=' . $birth_city .
			'&birth_zip=' . $birth_zip . '&publication=' . $publication . '&vat=' . $vat . '&siren=' . $siren .
			'&duns=' . $duns . '&trademark=' . $trademark . '&waldec=' . $waldec . '&registrant_type_other=' . $registrant_type_other .
			'&privacy_protection=' . $privacy_protection . '&code=' . $code . '&publicity=' . $publicity . '&kpp=' . $kpp .
			'&passport_number=' . $passport_number . '&passport_issued_by=' . $passport_issued_by .
			'&passport_issued_on=' . $passport_issued_on;
		$url = 'domains/order-new-domain';

		return $this->apiRequest($data, $url);
	}

	public function domainsRenewDomain($domain_name, $period) {
		$data = '&domain-name=' . $domain_name . '&period=' . $period;
		$url = 'domains/order-renew-domain';

		return $this->apiRequest($data, $url);
	}

	public function domainsTransferDomain($domain_name, $tld, $mail, $name, $company, $address, $city, $state, $zip, $country, $telnocc, $telno, $faxnocc = false, $faxno = false, $transfer_code = false, $registrant_type = false, $birth_date = false, $birth_cc = false, $birth_city = false, $birth_zip = false, $publication = false, $vat = false, $siren = false, $duns = false, $trademark = false, $waldec = false, $registrant_type_other = false, $privacy_protection = false, $code = false, $registrant_type_id = false, $publicity = false, $ns = false, $kpp = false, $passport_number = false, $passport_issued_by = false, $passport_issued_on = false) {
		if (!is_array($ns) && ($ns != false)) {
			return "Invalid ns array!";
		}
		$data = '&domain-name=' . $domain_name . '&tld=' . $tld . '&mail=' . $mail .
			'&name=' . $name . '&company=' . $company . '&address=' . $address .
			'&city=' . $city . '&state=' . $state . '&zip=' . $zip . '&country=' . $country .
			'&telnocc=' . $telnocc . '&telno=' . $telno . '&faxnocc=' . $faxnocc . '&faxno=' . $faxno .
			'&transfer-code=' . $transfer_code . '&registrant_type=' . $registrant_type . '&birth_date=' . $birth_date .
			'&birth_cc=' . $birth_cc . '&birth_city=' . $birth_city . '&birth_zip=' . $birth_zip . '&publication=' . $publication .
			'&vat=' . $vat . '&siren=' . $siren . '&duns=' . $duns . '&trademark=' . $trademark . '&waldec=' . $waldec .
			'&registrant_type_other=' . $registrant_type_other . '&privacy_protection=' . $privacy_protection . '&code=' . $code .
			'&registrant_type_id=' . $registrant_type_id . '&publicity=' . $publicity;
		if ($ns != false) {
			foreach ($ns as $value) {
				$data = $data . '&ns[]=' . $value;
			}
		} else {
			$data = $data . '&ns=' . $ns;
		}
		$data = $data . '&kpp=' . $kpp . '&passport_number=' . $passport_number . '&passport_issued_by=' . $passport_issued_by . '&passport_issued_on=' . $passport_issued_on;
		$url = 'domains/order-transfer-domain';

		return $this->apiRequest($data, $url);
	}

	public function domainsListRegisteredDomains($rows_per_page, $page, $search = false) {
		$data = '&rows-per-page=' . $rows_per_page . '&page=' . $page . '&search=' . $search;
		$url = 'domains/list-domains';

		return $this->apiRequest($data, $url);
	}

	public function domainsGetPagesCount($rows_per_page, $search = false) {
		$data = '&rows-per-page=' . $rows_per_page . '&search=' . $search;
		$url = 'domains/get-pages-count';

		return $this->apiRequest($data, $url);
	}

	public function domainsDomainInfo($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'domains/domain-info';

		return $this->apiRequest($data, $url);
	}

	public function domainsGetContacts($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'domains/get-contacts';

		return $this->apiRequest($data, $url);
	}

	public function domainsModifyContacts($domain_name, $type, $mail, $name, $company, $address1, $city, $state, $zip, $country, $telnocc, $telno, $address2 = false, $address3 = false, $faxnocc = false, $faxno = false) {
		$data = '&domain-name=' . $domain_name . '&type=' . $type . '&mail=' . $mail . '&name=' . $name . '&company=' .
			$company . '&address1=' . $address1 . '&address2=' . '&city=' .
			$city . '&state=' . $state . '&zip=' . $zip . '&country=' . $country .
			'&telnocc=' . $telnocc . '&telno=' . $telno . $address2 . '&address3=' . $address3 . '&faxnocc=' . $faxnocc .
			'&faxno=' . $faxno;
		$url = 'domains/set-contacts';

		return $this->apiRequest($data, $url);
	}

	public function domainsListNameServers($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'domains/get-nameservers';

		return $this->apiRequest($data, $url);
	}

	public function domainsModifyNameServers($domain_name, $nameservers) {
		$data = '&domain-name=' . $domain_name;
		if (!is_array($nameservers)) {
			return "Invalid array!";
		}
		foreach ($nameservers as $value) {
			$data = $data . '&nameservers[]=' . $value;
		}
		$url = 'domains/set-nameservers';

		return $this->apiRequest($data, $url);
	}

	public function domainsGetChildNameServers($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'domains/get-child-nameservers';

		return $this->apiRequest($data, $url);
	}

	public function domainsAddChildNameServers($domain_name, $host, $ip) {
		$data = '&domain-name=' . $domain_name . '&host=' . $host . '&ip=' . $ip;
		$url = 'domains/add-child-nameservers';

		return $this->apiRequest($data, $url);
	}

	public function domainsDeleteChildNameServers($domain_name, $host, $ip) {
		$data = '&domain-name=' . $domain_name . '&host=' . $host . '&ip=' . $ip;
		$url = 'domains/delete-child-nameservers';

		return $this->apiRequest($data, $url);
	}

	public function domainsModifyChildNameServers($domain_name, $host, $old_ip, $new_ip) {
		$data = '&domain-name=' . $domain_name . '&host=' . $host . '&old-ip=' . $old_ip . '&new-ip=' . $new_ip;
		$url = 'domains/modify-child-nameservers';

		return $this->apiRequest($data, $url);
	}

	public function domainsModifyPrivacyProtection($domain_name, $status) {
		$data = '&domain-name=' . $domain_name . '&status=' . $status;
		$url = 'domains/edit-privacy-protection';

		return $this->apiRequest($data, $url);
	}

	public function domainsModifyTransferLock($domain_name, $status) {
		$data = '&domain-name=' . $domain_name . '&status=' . $status;
		$url = 'domains/edit-transfer-lock';

		return $this->apiRequest($data, $url);
	}

	public function domainsGetTransferCode($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'domains/get-transfer-code';

		return $this->apiRequest($data, $url);
	}

	public function domainsGetRAAStatus($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'domains/get-raa-status';

		return $this->apiRequest($data, $url);
	}

	public function domainsResendRAAVerification($domain_name) {
		$data = '&domain-name=' . $domain_name;
		$url = 'domains/resend-raa-verification';

		return $this->apiRequest($data, $url);
	}

	public function sslOrderNewSSL($domain_name, $period, $type) {
		$data = '&domain-name=' . $domain_name . '&period=' . $period . '&type=' . $type;
		$url = 'ssl/order-new';

		return $this->apiRequest($data, $url);
	}

	public function sslListOrderedCertificates($page, $rows_per_page) {
		$data = '&page=' . $page . '&rows-per-page=' . $rows_per_page;
		$url = 'ssl/list';

		return $this->apiRequest($data, $url);
	}

	public function sslGetPagesCount($rows_per_page) {
		$data = '&rows-per-page=' . $rows_per_page;
		$url = 'ssl/get-pages-count';

		return $this->apiRequest($data, $url);
	}

	public function sslInformation($ssl_id) {
		$data = '&ssl-id=' . $ssl_id;
		$url = 'ssl/info';

		return $this->apiRequest($data, $url);
	}

	public function sslSubmitCSR($ssl_id, $mail, $csr) {
		$data = '&ssl-id=' . $ssl_id . '&mail=' . $mail . '&csr=' . $csr;
		$url = 'ssl/submit-csr';

		return $this->apiRequest($data, $url);
	}

	public function sslRenew($ssl_id, $period) {
		$data = '&ssl-id=' . $ssl_id . '&period=' . $period;
		$url = 'ssl/order-renew';

		return $this->apiRequest($data, $url);
	}

	public function sslChangeVerificationMail($ssl_id, $mail) {
		$data = '&ssl-id=' . $ssl_id . '&mail=' . $mail;
		$url = 'ssl/change-verification-mail';

		return $this->apiRequest($data, $url);
	}

	public function sslReissue($ssl_id, $mail, $csr) {
		$data = '&ssl-id=' . $ssl_id . '&mail=' . $mail . '&csr=' . $csr;
		$url = 'ssl/reissue';

		return $this->apiRequest($data, $url);
	}

	public function sslListVerificationMails($ssl_id) {
		$data = '&ssl-id=' . $ssl_id;
		$url = 'ssl/get-verification-mails';

		return $this->apiRequest($data, $url);
	}

	public function subAddNewUser($password, $zones, $mail_forwards, $ip = false) {
		$data = '&password=' . $password . '&zones=' . $zones . '&mail-forwards=' . $mail_forwards . 'ip=' . $ip;
		$url = 'sub-users/add.json';

		return $this->apiRequest($data, $url);
	}

	public function subGetUserInfo($id) {
		$data = '&id=' . $id;
		$url = 'sub-users/get-info.json';

		return $this->apiRequest($data, $url);
	}

	public function subGetPagesCount($rows_per_page) {
		$data = '&rows-per-page=' . $rows_per_page;
		$url = 'sub-users/get-pages-count.json';

		return $this->apiRequest($data, $url);
	}

	public function subListSubUsers($pages, $rows_per_page) {
		$data = '&pages=' . $pages . '&rows-per-page=' . $rows_per_page;
		$url = 'sub-users/list-sub-users.json';

		return $this->apiRequest($data, $url);
	}

	public function subModifyZonesLimit($id, $zones) {
		$data = '&is=' . $id . '&zones=' . $zones;
		$url = 'sub-users/modify-zones-limit.json';

		return $this->apiRequest($data, $url);
	}

	public function subModifyMailForwardsLimit($id, $mail_forwards) {
		$data = '&id=' . $id . 'mail-forwards=' . $mail_forwards;
		$url = 'sub-users/modify-mail-forwards-limit.json';

		return $this->apiRequest($data, $url);
	}

	public function subAddIP($id, $ip) {
		$data = '&id=' . $id . '&ip=' . $ip;
		$url = 'sub-users/add-ip.json';

		return $this->apiRequest($data, $url);
	}

	public function subRemoveIP($id, $ip) {
		$data = '&id=' . $id . '&ip=' . $ip;
		$url = 'sub-users/remove-ip.json';

		return $this->apiRequest($data, $url);
	}

	public function subModifyStatus($id, $status) {
		$data = '&id=' . $id . '&status=' . $status;
		$url = 'sub-users/modify-status.json';

		return $this->apiRequest($data, $url);
	}

	public function subModifyPassword($id, $password) {
		$data = '&id=' . $id . '&password=' . $password;
		$url = 'sub-users/modify-password.json';

		return $this->apiRequest($data, $url);
	}

	public function subZones($id) {
		$data = '&id=' . $id;
		$url = 'sub-users/zones.json';

		return $this->apiRequest($data, $url);
	}

	public function subDelegateZone($id, $zone) {
		$data = '&id=' . $id . '&zone=' . $zone;
		$url = 'sub-users/delegate-zone.json';

		return $this->apiRequest($data, $url);
	}

	public function subRemoveZoneDelegation($id, $zone) {
		$data = '&id=' . $id . '&zone=' . $zone;
		$url = 'sub-users/remove-zone-delegation.json';

		return $this->apiRequest($data, $url);
	}

	public function subDeleteSubUser($id) {
		$data = '&id=' . $id;
		$url = 'sub-users/delete.json';

		return $this->apiRequest($data, $url);
	}

}