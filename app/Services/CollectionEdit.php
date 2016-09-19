<?php

namespace App\Services;

use DB;

use App\Permission;
use App\Collection;
use App\Repositories\CollectionRepository;


/**
*   子站点集的单位添加、修改、删除的操作逻辑
*/
class CollectionEdit
{

	protected $collectionRepo;
	
	function __construct(CollectionRepository $CollectionRepository)
	{
		$this->collectionRepo = $CollectionRepository;
	}

	public function createCollection(Array $collection)
	{
		$this->collectionRepo->createWithPermissions($collection);
	}

	public function updateCollection(Array $collection, $motouri)
	{

		if ($collection['uri'] == $motouri) {
			return $this->collectionRepo->updateWithOut($collection);
		}else{

			$this->collectionRepo->updateWithPermissions($collection, $motouri);
		}
	}

	public function deleteCollection($id)
	{
		$this->collectionRepo->deleteWithPermissions($id);
	}
}


?>