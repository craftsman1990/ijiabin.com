<?php

namespace App\Http\Controllers\Admin\DX;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DX\Article;
use App\Models\DX\RecommendArticle;
use Illuminate\Support\Facades\DB;
use App\Models\Recommend;


class ArticleRecommendController extends Controller
{
    //
    public function __construct()
    {
    }

    /**
     * 文章推荐位列表页
     **/
    public function index(Request $request)
    {
        //推荐
        $Recommend =Recommend::where('status',1)->get()->toArray();

        $data['recommend_info'] = $Recommend;
        //dd($Recommend);

        if ($request->all()){
            $where['rec_id'] = $request->get('rec_id');
            $where['type'] = $request->get('type');
            $like = $request->get('title');
            $list =  Article::getRecommendList($where,$like);
            $data['rec_id'] = $where['rec_id'];
            $data['type'] = $where['type'];
            $data['title'] = $like;
        }else{
            $data['rec_id'] = 0;
            $data['type'] = 0;
            $data['title'] = null;
            $list =Article::getRecommendList($data,$data['title']);
        }

        $list->setPath(config('hint.domain').'admin/jbdx/article/recommendList?rec_id='.$data['rec_id'].'&type='.$data['type'].'&title='.$data['title']);
        // dd($list);
        return view('Admin.DX.Article.Recommend.index',compact('list',$list),compact('data',$data));
    }

    /**
     * 执行添加
     **/
    public function store(Request $request)
    {

        $verif = array(
            'recommend_id' => 'required|numeric',
            'aids' => 'required',
        );
        $credentials = $this->validate($request,$verif);

        $credentials['aids'] = explode(',',$credentials['aids']);

        $insert_arr = array();

        if ($credentials['aids']){
            foreach ($credentials['aids'] as $value)
            {
                $insert_arr[] = array(
                    'recommend_id'=>$credentials['recommend_id'],
                    'aid'=>$value,
                    'created_at'=>date('Y-m-d H:i:s',time()),
                    'updated_at'=>date('Y-m-d H:i:s',time()),
                );
            }
        }
        //dd($insert_arr);

        if(RecommendArticle::insert($insert_arr)){
            return redirect('admin/jbdx/article/recommend')->with('success', config('hint.add_success'));
        }else{
            return back()->with('hint',config('hint.add_failure'));
        }

    }

    /**
     * 删除推荐
     * @param  [type] $labelData [导入的数据]
     * @param  [type] $data      [差集数据]
     * @return [type]   boolean         [true/false]
     */
    public function delRecommend($id,$recommend_id)
    {

        $where = array(
            'aid'=>$id,
            'recommend_id' =>$recommend_id
        );

        if(RecommendArticle::where($where)->delete()){
            return redirect('admin/jbdx/article/recommend')->with('success', config('hint.del_success'));
        }
        return back()->with('hint',config('hint.del_failure'));

    }
}
