@extends('layouts.university')
@section('title','嘉宾派')
@section('content')
  <link rel="stylesheet" href="{{asset('University/css/swiper.min.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('University/css/apply.css')}}">
  <div class="wrapper">
    <form>
    <h5 class="one_tit">个人信息</h5>
    <div class='formlist'>
      <div class='fname'>姓名<text>*</text></div>
      <input type='text' name="name"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>性别<text>*</text></div>
      <div class="box">
          <input type="radio"  id="radio1"  name="sex" value="1" /><label for="radio1">男</label>
          <div class="line"></div>
          <input type="radio"  id="radio2"  name="sex" value="0" /><label for="radio2">女</label>
      </div>
    </div>
    <div class='formlist'>
      <div class='fname'>手机<text>*</text></div>
      <input type='text' name="mobile"></input>
    </div>
    <div class='formlist'>
      <div class='fname'>微信（手机号或者微信号）<text>*</text></div>
      <input type='text'></input>
    </div>
    <div class='formlist'>
      <div class='fname'>邮箱<text>*</text></div>
      <input type='text'></input>
    </div>
    <div class='formlist'>
      <div class='fname'>是否为嘉宾派学员<text>*</text></div>
      <div class="box">
          <input type="radio"  id="radio3"  name="yn" /><label for="radio3">是</label>
          <div class="line"></div>
          <input type="radio"  id="radio4"  name="yn"/><label for="radio4">否</label>
      </div>
    </div>
    <div class='formlist'>
      <div class='fname'>公司全称<text>*</text></div>
      <input type='text'></input>
    </div>
    <div class='formlist'>
      <div class='fname'>职位<text>*</text></div>
      <input type='text'></input>
    </div>
    <div class='formlist'>
      <div class='fname'>所属行业<text>*</text></div>
      <input type='text'></input>
    </div>
    <div class='formlist'>
      <div class='fname'>是否为嘉宾派学员<text>*</text></div>
      <div class="box">
          <input type="radio"  id="radio5"  name="yn" /><label for="radio5">是</label>
          <div class="line"></div>
          <input type="radio"  id="radio6"  name="yn"/><label for="radio6">否</label>
      </div>
    </div>
    <div class='formlist'>
      <div class='fname'>获取本项目的渠道<text>*</text></div>
      <input type='text'></input>
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