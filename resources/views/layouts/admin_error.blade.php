<!-- 提示信息(验证) -->
@if (count($errors) > 0)
  <div class="alert alert-danger alert-dismissable">
  	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <ul>
          @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
  <!-- 提示信息(成功) -->
@if(session('success'))
<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    {{session('success')}}
</div>
@endif
<!-- 提示信息(失败) -->
@if(session('hint'))
<div class="alert alert-danger alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    {{session('hint')}}
</div>
@endif