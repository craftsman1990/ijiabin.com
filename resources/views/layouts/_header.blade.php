<nav>
    <ul>
        <li><img src="{{asset('Home/images/jiabindaxue_logo.png')}}" alt="" class="cm_logo"></li>
        @foreach($data['navig'] as $nav)
            @if($nav['id'] == 1)
                <li><a href="{{url('/')}}">首页</a></li>
            @elseif($nav['id'] ==6)
                <!-- <li class="fh"><a href="{{url('summit/oneId/'.$nav['id'])}}" target="_blank"><img class="fh_logo" src="{{asset('Home/images/jbfh.jpg')}}"></a></li> -->
                <li class="fh"><a href="{{url('page/meeting_2018')}}" target="_blank"><img class="fh_logo" src="{{asset('Home/images/jbfh.jpg')}}"></a></li>
            @else
                <li>
                    <a href="javascript:;">{{$nav['text']}}<b class="triangle"></b></a>
                    <ul>
                     @foreach($nav['nodes'] as $nodes)
                        <li><a href="{{url('transmit/oneId/'.$nav['id'].'/secId/'.$nodes['id'])}}">{{$nodes['text']}}</a></li>
                     @endforeach   
                    </ul>
                </li>
            @endif
         @endforeach
        <p class="font" onClick="location.href='{{url('search')}}'"><i class="icon iconfont icon-fangdajing"></i>搜索</p>
    </ul>
</nav>

