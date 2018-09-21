<!DOCTYPE html>
<html>
<head>
	<title>辅助功能</title>
</head>
<body>
	 <!-- 加载编辑器内容 -->
    <script id="editor" type="text/pslain" style="width:800px;height:600px;" name="content">{!!old('content')!!}</script>

	 <!-- 百度编辑器 -->
    <script type="text/javascript" charset="utf-8" src={{asset("UE/ueditor.config.js")}}></script>
    <script type="text/javascript" charset="utf-8" src={{asset("UE/ueditor.all.min.js")}}> </script>
    <script type="text/javascript" charset="utf-8" src={{asset("UE/lang/zh-cn/zh-cn.js")}}></script>
    <script type="text/javascript">
        var ue = UE.getEditor('editor',{
        	toolbars: [
		    	['fullscreen', 'source', 'removeformat', 'cleardoc', 'selectall']
			]
        });

    </script>
</body>
</html>