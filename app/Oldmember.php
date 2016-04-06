<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * 	旧用户中心的兼容
 */
class Oldmember extends Model
{
	/**
	* 关联到ucenter的sun_student_list
	*
	* @var string
	*/
	protected $connection = 'olducenter';

	/**
	* 不使用timestamps
	*
	* @var bool
	*/
	public $timestamps = false;

	/**
	* 主键为用户id
	*
	* @var string
	*/
	protected $primaryKey = 'uid';

	/**
	 * 表名为sun_members
	 *
	 * @var  string [<description>]
	 */
	protected $table='sun_members';

	/**
	 *  禁止增加数据
	 */
	protected $fillable=[];

	/**
	 * 关联到Studentlist
	 * @return boolean [description]
	 */
	public function Idcard()
	{
		return $this->hasOne('App\Studentlist', 'sid', 'sid');
	}


}
