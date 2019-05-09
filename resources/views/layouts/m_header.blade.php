<!-- 导航 -->
<div data-role="panel" id="myPanel"> 
  <div class="pagelist">
    @foreach($data['navig'] as $nav)
      @if($nav['id']==1)
        <h4 class="pagetit">
          <a class="{{$nav['id']==$data['oneId'] ? 'selected' : ''}}" href="{{url('mobile/transmit/oneId/'.$nav['id'].'/secId/1')}}">{{$nav['text']}}</a>
        </h4>
      @elseif($nav['id']==4)
       <h4 class="pagetit">
          <a class="{{$nav['id']==$data['oneId'] ? 'selected' : ''}}" href="{{url('mobile/transmit/oneId/'.$nav['id'].'/secId/'.$nav['nodes'][0]['id'])}}">{{$nav['text']}}</a>
        </h4>
      @elseif($nav['id']==6)
      <h4 class="pagetit">
      <!-- <a class="{{$nav['id']==$data['oneId'] ? 'selected' : ''}}" href="{{url('mobile/transmit/oneId/'.$nav['id'].'/secId/'.$nav['nodes'][0]['id'])}}"> -->
      <a class="{{$nav['id']==$data['oneId'] ? 'selected' : ''}}" href="{{url('mobile/page/meeting_2018')}}">
            <img src="{{asset('Mobile/images/jbfh.png')}}" alt="">
          </a>
        </h4>
      @else
        <h4 class="pagetit">
          <a class="{{$nav['id']==$data['oneId'] ? 'selected' : ''}}" href="{{url('mobile/transmit/oneId/'.$nav['id'].'/secId/'.$nav['nodes'][0]['id'])}}">{{$nav['text']}}</a>
        </h4>
        <ul class="test">
          @foreach($nav['nodes'] as $nodes)
            <li><a class="{{$nodes['id']==$data['secId'] ? 'selected' : ''}}" href="{{url('mobile/transmit/oneId/'.$nav['id'].'/secId/'.$nodes['id'])}}">{{$nodes['text']}}</a></li>
          @endforeach
        </ul>
      @endif
    @endforeach
  </div>
</div> 

<div data-role="header" class="ui-header">
  <a href="javascript:;" id="pagehide"><i class="icon iconfont icon-mulu"></i></a>
  <b><img src="{{asset('Mobile/images/jiabindaxue_logo.png')}}" alt=""></b>
  <a href="{{url('mobile/search')}}"><i class="icon iconfont icon-sousuo search"></i></a>
</div>