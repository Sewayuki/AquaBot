<?php


class BnsModule
{
	function __construct()
	{
		//
	}

	public function getBnsBaseItem()
	{
		//
	}

	public function searchBnsBaseItem()
	{
		//
	}

	public function getBnsProfileInfo($req)
	{
		$sch = urlencode($req);
		$info = file_get_contents('http://eu-bns.ncsoft.com/ingame/bs/character/profile?c='.$sch);
		$pattern1 = '@<dt><a href="#">(?P<mainname>.+?)<\/a> <span class="name">\[(?P<nickname>.+?)\]<\/span><\/dt>[\s\S]+?<dd class="desc">\s+<ul>\s+<li>(?P<class>.+?)<\/li>\s+<li>(?P<level>.+?)<span.+?"masteryLv">(?P<hmlevel>.+?)<\/span><\/li>\s+<li>(?P<server>.+?)<\/li>\s+<li>(?P<fraction>.+?)<\/li>@s';

		preg_match_all($pattern1, $info, $maininfo);

		$resp['mainname'] = $maininfo['mainname'][0];
		$resp['nickname'] = $maininfo['nickname'][0];
		$resp['class'] = $maininfo['class'][0];
		$resp['level'] = $maininfo['level'][0];
		$resp['hmlevel'] = $maininfo['hmlevel'][0];
		$resp['fraction'] = $maininfo['fraction'][0];

		return $resp;
	}
}