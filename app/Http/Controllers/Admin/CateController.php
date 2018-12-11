<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $k = $request->input('keywords');

        //连贯方法结合原始表达式防止sql语句注入
        $cate=DB::table('cates')->select(DB::raw('*,concat(path,",",id) as paths'))->orderBy('paths')->where('name','like','%'.$k.'%')->paginate(3);
        // $cate = DB::table('cates')->get();
        // dd($cate);
        foreach($cate as $key=>$value){
            // echo $value->path."<br>";
            // 转换为数组
            $arr = explode(',',$value->path);
            // echo '<pre>';
            // var_dump($arr); 
            // 获取逗号个数
            $len=count($arr)-1;
            $cate[$key]->name=str_repeat("--|",$len).$value->name;
        }
        return view('Admin.Cate.index',['cate'=>$cate,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cate = DB::table('cates')->get();
        // dd($cate);
        return view('Admin.Cate.add',['cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data=$request->all();
        //获取需要添加的数据
        $data = $request->only(['name','pid']);
        $pid=$request->input("pid");
        dd($data);
        //添加顶级分类
        if($pid==0){
            // dd($data);
            // 拼接path
            $data['path']='0';
        }else{
            // dd($data);
            // 添加子集
            $info=DB::table('cates')->where('id','=',$pid)->first();
            // 拼接path
            $data['path']=$info->path.','.$info->id;
            // dd($data);
        }

        // 执行入库
        if(DB::table('cates')->insert($data)){
            return redirect('/admincates')->with('success','分类添加成功');
        }else{
            return back()->with('error','分类添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo $id;
        //加载模板
        $cate = DB::table('cates')->where('id','=',$id)->first();
        // dd($cate);
        return view('Admin.Cate.edit',['cate'=>$cate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // dd($request->all());
        $data = $request->only(['name']);
        if(DB::table('cates')->where('id','=',$id)->update($data)){
            return redirect('/admincates')->with('success','修改成功');
        }else{
            return redirect('/admincates/$id')->with('error','修改失败');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $res=DB::table('cates')->where('pid','=',$id)->count();
        // echo $res;
        if($res>0){
            return back()->with('error','请先删除子分类');
        }

        if(DB::table('cates')->where('id','=',$id)->delete()){
            return redirect('/admincates')->with('success','删除成功');
        }else{
            return redirect('/admincates')->with('error','删除失败');
        }
    }
}
