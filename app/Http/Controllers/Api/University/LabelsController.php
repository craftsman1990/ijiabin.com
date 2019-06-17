<?php

/**
 * @Author: lijiangkun
 * @Date:   2019-06-10 10:46:22
 * @Last Modified by:   lijiangkun
 * @E-mail: 1589523887@qq.com
 */
namespace App\Http\Controllers\Api\University;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hotbot;
use App\Models\Label;
use App\Models\DX\Course;
use App\Models\DX\Article;

class LabelsController extends Controller
{
	/**
	 * 标签聚合页
	 * @param page  页码数
     * @param limit 分页条数
	 * @param label_id 标签id
	 * @param type 类别：1：文章；2：视频
	 * @param 注意：type 默认为空（查询全部混合数据）
	 * @return json
	 */
	public function labelSearch(Request $request)
	{
		if (empty($request->label_id)) {
            return response()->json(['status'=>999,'msg'=>'参数错误！']);
        }
        //获取标签名称
        $name = Label::where('id','=',$request->label_id)->select('name')->get()->toArray();
        if ($name) {
        	$label_name = $name[0]['name'];
        }else{
        	$label_name = [];
        }
        $page = isset($request->page) ? (int)$request->page : 1;
        $limit = isset($request->limit) ? (int)$request->limit : 10;//默认10条
        $data = Article::labelSearch($request->label_id,$page,$limit,$request->type);
        return response()->json(['status'=>1,'msg'=>'success','name'=>$label_name,'data'=>$data]);
	}

	/**
	 * 获取热搜词
	 * @return json
	 */
	public function hotBot()
	{
		$data = Hotbot::getHotBotList();
		return response()->json(['status'=>1,'msg'=>'success','data'=>$data]);
	}
}
