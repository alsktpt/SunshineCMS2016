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
	 * @return 
	 */
	public function idcard()
	{
		return $this->hasOne('App\Studentlist', 'sid', 'sid');
	}

	/**
	 * 关联到User内容表
	 * @return [type] [description]
	 */
	public function belongs()
	{
	    return $this->belongsTo('App\User', 'sid', 'sid');
	}



}
