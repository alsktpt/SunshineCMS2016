<?php 

namespace App\Repositories;

use Doctrine\Common\Collections\Collection;

use App\Collection as SunshineCollection;
use App\Permission;
use Carbon\Carbon;
use DB;

/**
* 子站点集的数据库逻辑
*/
class CollectionRepository
{
	
	function __construct()
	{
		# code...
	}
	/**
	 * [createWithPermissions description]
	 * @param  [type] $arr [include collection's uri, name, description]
	 * @return 无返回值 出问题直接throw一个excption
	 */
	public function createWithPermissions($arr)
	{
		DB::connection('mysql');
		$arr['created_at'] = Carbon::now();
	    $arr['updated_at'] = Carbon::now();
		$permissionsArr = $this->permissionArrayOfCollection($arr['uri'], $arr['name']);
		DB::transaction(function () use ($permissionsArr, $arr) {
            DB::table('permissions')->insert($permissionsArr);
            DB::table('collections')->insert($arr);
        });
	}

	public function deleteWithPermissions($id)
	{
		$coll = SunshineCollection::findOrFail($id);
	}
	/**
	 * [updateWithPermissions description]
	 * @param  [type] $arr     [description]
	 * @param  [type] $motouri [description]
	 * @return [type]          [description]
	 */
	public function updateWithPermissions($arr, $motouri)
	{
		$collection = SunshineCollection::find($motouri);
		$permissions = Permission::where('name', 'like', '@'.$motouri.'%')->get();
		$permissionsArr = $permissions->toArray();

		DB::transaction(function () use ($permissionsArr, $arr, $motouri) {
			for ($i=0; $i < count($permissionsArr); $i++) { 
				$newPermissionName = str_replace($motouri, $arr['uri'], $permissionsArr[$i]['name']);
			    DB::table('permissions')->where('id', $permissionsArr[$i]['id'])
			    						->update([
			    							'name' => $newPermissionName,
			    							'updated_at' => Carbon::now()
			    							]);
			}
		    DB::table('collections')->where('uri',$motouri)->update($arr);
		});
	}
	/**
	 * [updateWithOut description]
	 * @param  [type] $arr [description]
	 * @return [type]      [description]
	 */
	public function updateWithOut($arr)
	{
		$collection = SunshineCollection::find($arr['uri']);
		return $collection->update($arr)
		?TRUE
		:FALSE;
	}

	private function permissionArrayOfCollection($uri, $name)
	{
		return [
            [
	            'name' => '@'.$uri.'-read',
	            'label' => $name.' 读权限',
	            'description' => $name.' 允许进入。',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
            ],
            [
	            'name' => '@'.$uri.'-write',
	            'label' => $name.' 写权限',
	            'description' => $name.' 发表权限',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ],
	        [
	            'name' => '@'.$uri.'-edit',
	            'label' => $name.' 管理编辑',
	            'description' => $name.' 可以对文章进行编辑/审核/删除，也可以对用户进行禁言。',
	            'created_at' => Carbon::now(),
	            'updated_at' => Carbon::now()
	        ]

		];
	}
}
?>