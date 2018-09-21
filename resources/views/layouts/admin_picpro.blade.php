 <!-- 图片裁剪 -->
    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span>
                    </button>
                    <!-- <i class="fa fa-laptop modal-icon"></i> -->
                    <h5 class="modal-title">图片截取</h5>
                    <!-- <small class="font-bold">这里可以显示副标题。 -->
                </div>
                <div class="modal-body">
                    <div id="clipArea" style="margin-top: 20px;height: 500px;"></div>
                    <!-- <div id="view"></div> -->
                </div>
                <div class="modal-footer">
                    <input name="admin_pic" type="file" id="file" class="valid">
                    <button type="button" class="btn btn-white quxiao" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">保存</button>
                    <button id="clipBtn" class="btn btn-primary">截取</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 文章，视频封面图尺寸 -->
    <input type="hidden" name="scre_gm_width" value="{{config('hint.scre_gm_width')}}">
    <input type="hidden" name="scre_gm_height" value="{{config('hint.scre_gm_height')}}">
    <input type="hidden" name="opt_gm_width" value="{{config('hint.opt_gm_width')}}">
    <input type="hidden" name="opt_gm_height" value="{{config('hint.opt_gm_height')}}">
    <!-- 导师学员照片尺寸 -->
    <input type="hidden" name="scre_ts_width" value="{{config('hint.scre_ts_width')}}">
    <input type="hidden" name="scre_ts_height" value="{{config('hint.scre_ts_height')}}">
    <input type="hidden" name="opt_ts_width" value="{{config('hint.opt_ts_width')}}">
    <input type="hidden" name="opt_ts_height" value="{{config('hint.opt_ts_height')}}">
    
    <!-- <script src="http://www.jq22.com/jquery/2.1.1/jquery.min.js"></script> -->
    <script src={{asset("Admin/js/iscroll-zoom.js")}}></script>
    <script src={{asset("Admin/js/hammer.js")}}></script>
    <script src={{asset("Admin/js/lrz.all.bundle.js")}}></script>
    <script src={{asset("Admin/js/jquery.photoClip.js")}}></script>