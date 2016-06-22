<?php

class DataCtrl {
	const AdBigShow = 1;
	const AdEditorRecommand = 2;
	const AdHotGame = 3;

	public function ResetAdCache()
	{
		$model = new DBCtrl;
		$model->Init();
		$cache = new RedisCtrl;
		$cache->Init();
		$category = $model->GetHotInfoList();
		$ad = array();
		foreach ($category as $key => $val)
		{
			$cacheKey = "";
			if ($val[0] == AdBigShow)
			{
				$cacheKey = "AdBigShow";
			}
			else if ($val[0] == AdEditorRecommand)
			{
				$cacheKey = "AdEditorRecommand";
			}
			else if ($val[0] == AdHotGame)
			{
				$cacheKey = "AdHotGame";
			}
			else
			{
				continue;
			}
			$ad[$cacheKey] = json_encode(array(
				"hot_id" => $val[0],
				"game_id_list" => $val[1],
				"ex1" => $val[2],
				"ex2" => $val[3],
				"ex3" => $val[4]
			));
		}
		$cache->StringMSet($ad);
		return 0;
	}

	public function ResetCategoryCache()
	{
		$model = new DBCtrl;
		$model->Init();
		$cache = new RedisCtrl;
		$cache->Init();
		$category = $model->GetCategoryInfoList();
		$ad = array();
		$ad["Category"] = array();
		foreach ($category as $key => $val)
		{
			$ad["Category"][] = array(
				"category_id" => $val[0],
				"name" => $val[1],
				"game_id_list" => $val[2],
				"pic" => $val[3]
			);
		}
		$ad["Category"] = json_encode($ad["Category"]);
		$cache->StringMSet($ad);
		return 0;
	}

	public function ResetNewGameCache()
	{
		$model = new DBCtrl;
		$model->Init();
		$cache = new RedisCtrl;
		$cache->Init();
		$cache->delete("NewGame");
		$category = $model->GetNewGameListSortTime();
		foreach ($category as $key => $val)
		{
			$cache->ZSetAdd("NewGame", $val[0], $val[7]);
		}
		return 0;
	}

	public function ResetOnSaleCache($game_id, $onsale_time)
	{
		$cache = new RedisCtrl;
		$cache->Init();
		$cache->ZSetAdd("NewGame", $game_id, $onsale_time);
	}

	public function ResetOffSaleCache($game_id)
	{
		$cache = new RedisCtrl;
		$cache->Init();
		$cache->ZSetDel("NewGame", $game_id);
		return 0;
	}

	public function ResetGameCache($game_id)
	{
		$model = new DBCtrl;
		$model->Init();
		$cache = new RedisCtrl;
		$cache->Init();
		$info = $model->GetGameList($game_id);
		if (empty($info))
		{
			return -1;
		}
		$info = array(
			'game_id' => $info[0],
			'icon' => $info[1],
			'url' => $info[2],
			'title' => $info[3],
			'brief' => $info[4],
			'content' => $info[5],
			'create_time' => $info[6],
			'onsale_time' => $info[7],
			'big_pic' => $info[8],
			'status' => $info[9],
			'is_login' => $info[10]
		);
		$cache->HashMSet("GameInfo", array($info[0] => json_encode($info))
						);
		return 0;
	}

	public function GetAndSetGameInfoCache($game_list)
	{
		$cache = new RedisCtrl;
		$cache->Init();
		$game_info = $cache->HashMGet("GameInfo", $game_list);
		$game_info_nocache = array();
		foreach ($GameInfo as $key => $val)
		{
			if (isset($val))
			{
				$game_info[$key] = json_decode($val);
			}
			else
			{
				$game_info_nocache[] = $key;
			}
		}

		if (!empty($game_info_nocache))
		{
			$model = new DBCtrl;
			$model->Init();
			$result = $model->GetGameList($game_list_nocache);
			$infoCache = array();
			foreach ($result as $key => $val)
			{
				$info = array(
					'game_id' => $val[0],
					'icon' => $val[1],
					'url' => $val[2],
					'title' => $val[3],
					'brief' => $val[4],
					'content' => $val[5],
					'create_time' => $val[6],
					'onsale_time' => $val[7],
					'big_pic' => $val[8],
					'status' => $val[9],
					'is_login' => $val[10]
				);
				$game_info[$info['game_id']] = $info;
				$infoCache[$info['game_id']] = json_encode($info);
			}
			$cache->HashMSet("GameInfo", $infoCache);
		}
		return $game_info;
	}

	public function HandlerGetMoreHotGame($page)
	{
		$result = array();
		$cache = new RedisCtrl;
		$cache->Init();
		$hot = $cache->StringMGet(array("AdHotGame"));
		$hot["AdHotGame"] = json_decode($hot["AdHotGame"]);
		$game_list = implode(",", $hot["AdHotGame"]["game_id_list"]);
		$game_list_ret = array_slice($game_list, $page * 10, 11); 
		$is_more = true;
		if (count($game_id_ret) < 11)
			$is_more = false;
		array_pop($game_list_ret);
		$desc = $this->GetAndSetGameInfoCache($game_list_ret);
		$date = array();
		$data['data'] = $desc;
		$data['isMore'] = $is_more;
		return $data;
	}

	public function HandlerGetMoreNewGame($page)
	{
		$result = array();
		$cache = new RedisCtrl;
		$cache->Init();
		$new = $cache->ZSetRevRange("NewGame", $page * 10, $page * 10 + 11);
		$is_more = true;
		if (count($new) < 11)
			$is_more = false;
		array_pop($new);
		$desc = $this->GetAndSetGameInfoCache($new);
		$date = array();
		$data['data'] = $desc;
		$data['isMore'] = $is_more;
		return $data;
	}

	public function HandlerGetIndex()
	{
		$result = array();
		$cache = new RedisCtrl;
		$cache->Init();
		//ad
		$ad = $cache->StringMGet(array("AdBigShow", "AdEditorRecommand"));
		$ad["AdHotGame"] = json_decode($ad["AdBigShow"]);
		$ad["AdEditorRecommand"] = json_decode($ad["AdEditorRecommand"]);

		$arr1 = implode(",", $ad["AdHotGame"]["game_id_list"]);
		$game_list = implode(",", $ad["AdHotGame"]["game_id_list"]);
		$game_list = array_merge($arr1, $game_list);

		$desc = $this->GetAndSetGameInfoCache($game_list_ret);
		$data = $ad;
		$data['AdGameInfo'] = $desc;
		
		//ad hot game list and new game list
		$data['HotGame'] = $this->HandlerGetMoreHotGame(0);
		$data['NewGame'] = $this->HandlerGetMoreNewGame(0);
		return $data;
	}
}

?>