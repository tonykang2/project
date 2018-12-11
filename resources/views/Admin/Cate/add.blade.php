@extends("Admin.AdminPublic.public")
@section('admin')
<!-- <h1>这是用户添加</h1> -->
<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>分类添加</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form class="mws-form" action="/admincates" method='post'>
                       
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">分类名</label>
                    				<div class="mws-form-item">
                    					<input type="text" class="large" name='name' value='{{old("name")}}'>
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">父类</label>
                    				<div class="mws-form-item">
                    					<select name="pid" class="large">
                                                  <option value="0">--请选择--</option>  
                                                  @foreach($cate as $row)                  
                                                  <option value="{{$row->id}}">{{$row->name}}</option>
                                                  @endforeach                    
                                             </select>
                    				</div>
                    			
                    			
                    		</div>
                    		<div class="mws-button-row">
                              
                              {{csrf_field()}}
                    			<input type="submit" value="Submit" class="btn btn-danger">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>
@endsection
@section('title','分类添加')