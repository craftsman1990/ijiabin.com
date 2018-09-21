$(function(){
  $(".dls_tit").each(function(i){
    var divH = $(this).height();
    // console.log(divH);
    var $p = $("p", $(this)).eq(0);
    while ($p.outerHeight() > divH) {
        $p.text($p.text().replace(/(\s)*([a-zA-Z0-9]+|\W)(\.\.\.)?$/, "..."));
    };
  });
  //关注
  $(".jbcm1").hover(function(){
    $(".code1").css("display","block");
  },function(){
    $(".code1").css("display","none");
  })
  $(".jbcm2").hover(function(){
    $(".code2").css("display","block");
  },function(){
    $(".code2").css("display","none");
  })


  //分享
  $(".wx").hover(function(){
    $(".big-wx").css("display","block");
  },function(){
    $(".big-wx").css("display","none");
  })
  $(".wb").hover(function(){
    $(".big-wb").css("display","block");
  },function(){
    $(".big-wb").css("display","none");
  })

  //搜索
  $(".inp_search").keydown(function(event){ 
    if(event.keyCode==13){ 
      window.location.href = "search-detail.html";
      console.log(1)
    } 
  }); 
  var artWid = $('.article').width();
  var imgObj = $('.article img');
  var imgObjLen = imgObj.length;
  for (var i = 0; i < imgObjLen; i++) {
    var imgWid = imgObj.eq(i).width();
    console.log(imgWid);
    if (imgWid > artWid) {
      imgObj.eq(i).width(artWid);
      // $('img').width(artWid);
    }
  }

})





