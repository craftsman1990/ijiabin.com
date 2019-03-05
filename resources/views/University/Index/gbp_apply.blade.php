@extends('layouts.university')
@section('title','嘉宾派')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/apply.css')}}">
  <div class="wrapper">
    <div class="hint_box">
      <p class="hint">提示：</p>
      <p class="hint_con">1、收到报名信息后客服人员会在5个工作日内跟您取得联系</p>
      <p class="hint_con">2、嘉宾派将严格保密您所填写的信息，请您如实填写。</p>
    </div>
    <h5 class="one_tit">个人信息</h5>
    <form method="post" action="">
      @csrf
    <div class='formlist'>
      <div class='fname'>姓名<text>*</text></div>
      <input type='text' name="name" value="{{old('name')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>性别<text>*</text></div>
      <div class="box">
          <input type="radio"  id="radio1"  name="sex" value="1" /><label for="radio1">男</label>
          <div class="line"></div>
          <input type="radio"  id="radio2"  name="sex" value="0" /><label for="radio2">女</label>
      </div>
      <!-- <p class="top"><input name="sex" type="radio" />男</p>
      <p class="bot"><input name="sex" type="radio" />女</p> -->
    </div>
    <div class='formlist'>
      <div class='fname'>出生日期<text>*</text></div>
      <p class="top">
          <input type='text' value="birthday" value="{{old('birthday')}}"></input>
          <img src="{{asset('University/images/icon_rili@2x.png')}}" class="img_rili" alt="">
      </p>
    </div>
    <div class='formlist'>
      <div class='fname'>常住地<text>*</text></div>
      <input type='text' name="address" value="address"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>创业年数<text>*</text></div>
      <input type='text' name="venture_years" value="{{old('venture_years')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>目前您的身份属性（可多选）<text>*</text></div>
      <div class="box">
          <input type="checkbox" name="identity[]" value="创业者" id="checkbox1"/><label for="checkbox1">创业者</label>
          <div class="line"></div>
          <input type="checkbox" name="identity[]" value="投资人" id="checkbox2"/><label for="checkbox2">投资人</label>
          <div class="line"></div>
          <input type="checkbox" name="identity[]" value="其他" id="checkbox3"/><label for="checkbox3">其他</label>
          <input type="text" name="idqt" value="{{old('idqt')}}">
      </div>
    </div>
    <div class='formlist'>
      <div class='fname'>手机<text>*</text></div>
      <input type='text' name="mobile" value="{{old('mobile')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>微信<text>*</text></div>
      <input type='text' name="weixin" value="{{old('weixin')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>邮箱<text>*</text></div>
      <input type='text' name="email" value="{{old('email')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>毕业院校<text>*</text></div>
      <input type='text' name="graduate_scholl" value="{{old('graduate_scholl')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>学历<text>*</text></div>
      <input type='text' name="education_background" value="{{old('education_background')}}"></input>
    </div>

    <h5 class="one_tit">企业信息<text>*</text></h5>
    <div class='formlist'>
      <div class='fname'>企业全称<text>*</text></div>
      <input type='text' name="company" value="{{old('company')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>您的职位<text>*</text></div>
      <input type='text' name="position" value="{{old('position')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>企业成立年份<text>*</text></div>
      <input type='text' name="establish" value="{{old('establish')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>企业员工数<text>*</text></div>
      <input type='number' name="staff_number" value="{{old('staff_number')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>企业地址<text>*</text></div>
      <input type='text' name="company_address" value="{{old('company_address')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>企业融资阶段<text>*</text></div>
      <input type='text' name="financing_phases" value="{{old('financing_phases')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>企业去年营收<text>*</text></div>
      <input type='text' name="income" value="{{old('income')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>企业市值/企业估值/基金管理资产<text>*</text></div>
      <input type='text' name="market_value" value="{{old('market_value')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>本企业投资方</div>
      <input type='text' name="investor" value="{{old('investor')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>企业经营状况</div>
      <p class="fun">请尽可能通过文字表述您企业目前的现状或所投项目名称及运营状况。（200字以内）</p>
      <textarea onkeypress="if(this.value.length+1>200)event.keyCode=0" name="operation_state">{{old('operation_state')}}</textarea>
    </div>
    <div class='formlist'>
      <div class='fname'>您期望从嘉宾派得到哪些具体的服务（可多选）？</div>
      <div class="box">
          <input type="checkbox" name="expectation[]" value="标杆企业深度访学" id="checkbox3"/><label for="checkbox3">标杆企业深度访学</label>
          <div class="line"></div>
          <input type="checkbox" name="expectation[]" value="政府资源对接" id="checkbox4"/><label for="checkbox4">政府资源对接</label>
          <div class="line"></div>
          <input type="checkbox" name="expectation[]" value="品牌宣传" id="checkbox5"/><label for="checkbox5">品牌宣传</label>
          <div class="line"></div>
          <input type="checkbox" name="expectation[]" value="投融资机会" id="checkbox6"/><label for="checkbox6">投融资机会</label>
          <div class="line"></div>
          <input type="checkbox" name="expectation[]" value="校友交流" id="checkbox7"/><label for="checkbox7">校友交流</label>
          <div class="line"></div>
          <input type="checkbox" name="expectation[]" value="高管学习" id="checkbox8"/><label for="checkbox8">高管学习</label>
          <div class="line"></div>
          <input type="checkbox"name="expectation[]" value="其他" id="checkbox9"/><label for="checkbox9">其他</label>
          <input type="text" name="exqt" value="{{old('exqt')}}">
      </div>
    </div>
    <div class='formlist'>
      <div class='fname'>你对嘉宾派最感兴趣的人或者企业？</div>
      <input type='text' name="interest_jbp" value="{{old('interest_in')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>还有哪类（哪些）企业是你想见到和参访的？</div>
      <input type='text' name="interest_in" value="{{old('interest_in')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>在学习交流中你最重视的是（可多选）？<text>*</text></div>
      <div class="box">
          <input type="checkbox" name="pay_attention[]" value="和谁在一起（学员）学习交流" id="checkbox10"/>
          <label for="checkbox10">和谁在一起（学员）学习交流</label>
          <div class="line"></div>
          <input type="checkbox" name="pay_attention[]" value="向谁学习" id="checkbox11"/>
          <label for="checkbox11">向谁学习</label>
          <div class="line"></div>
          <input type="checkbox" name="pay_attention[]" value="课程设计" id="checkbox12"/>
          <label for="checkbox12">课程设计</label>
          <div class="line"></div>
          <input type="checkbox" name="pay_attention[]" value="学习时间" id="checkbox13"/>
          <label for="checkbox13">学习时间</label>
          <div class="line"></div>
          <input type="checkbox" name="pay_attention[]" value="学习地点" id="checkbox14"/>
          <label for="checkbox14">学习地点</label>
          <div class="line"></div>
          <input type="checkbox" name="pay_attention[]" value="学费" id="checkbox15"/>
          <label for="checkbox15">学费</label>
          <div class="line"></div>
          <input type="checkbox" name="pay_attention[]" value="其他" id="checkbox16"/>
          <label for="checkbox16">其他</label>
          <input type="text" name="paqt" value="{{old('paqt')}}">
      </div>
    </div>
    <div class='formlist'>
      <div class='fname'>推荐人<text>*</text></div>
      <input type='text' name="referrer" value="{{old('referrer')}}"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>推荐人联系方式<text>*</text></div>
      <p class="fun">手机号、微信号、邮箱皆可</p>
      <input type='text' name="referrer_mobile" value="{{old('referrer_mobile')}}"></input>
    </div>
    <div class="sub">
      <input type="submit">
    </div>
    </form>
  </div>

  
  <script>
    $(document).ready(function () {
      
    })
  </script>
@stop