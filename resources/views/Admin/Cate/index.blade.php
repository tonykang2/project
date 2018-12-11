@extends("Admin.AdminPublic.public")
@section('admin')
<html>
 <head></head>
 <script src='/static/jquery-1.7.2.min.js'></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i>类别列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
   <form action="admincates" method="get">
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
    
     <div class="dataTables_filter" id="DataTables_Table_1_filter">
      <label>分类名: <input type="text" aria-controls="DataTables_Table_1" name='keywords' value="{{$request['keywords'] or ''}}" />
      
      <input type="submit" class="btn btn-success" value="搜索">
     </div>
     </form>
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 97.2px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 136.2px;" aria-label="Browser: activate to sort column ascending">分类名</th>
    
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 81.2px;" aria-label="Engine version: activate to sort column ascending">pid</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 56px;" aria-label="CSS grade: activate to sort column ascending">path</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 56px;" aria-label="CSS grade: activate to sort column ascending">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
       @foreach($cate as $row)
       <tr class="odd"> 
        <td class="  sorting_1">{{$row->id}}</td> 
        <td class=" ">{{$row->name}}</td> 
    
        <td class=" ">{{$row->pid}}</td> 
        <td class=" ">{{$row->path}}</td> 
        <td class=" ">
        <form action="/admincates/{{$row->id}}" method="post">
        {{csrf_field()}}
        {{method_field('DELETE')}}
             <button type='submit' class='btn btn-danger'>删除</button>
        </form>
        <a href="/admincates/{{$row->id}}/edit" class="btn btn-success success">修改</a>
        </td> 
       </tr>
       @endforeach

      </tbody>
     </table>
     
     <div class="dataTables_paginate paging_full_numbers" id="pages">
      {{$cate->appends($request)->render()}}
      
     </div>
    </div> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section('title','分类列表')