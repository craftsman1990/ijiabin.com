$(function(){
  $(".test li a").click(function() {
    $(this).siblings('li').removeClass('selected');  // 删除其他兄弟元素的样式
    $(this).addClass('selected');                            // 添加当前元素的样式
  }); 


  $("#home").click(function(){
    $(window).attr('location','index.html'); 
  })

  $(".tablea").find(".box:first").show();    //为每个BOX的第一个元素显示        
  
})