    <div class="tabCon">
        <div class="title"><h2>添加模型</h2></div>
        <div class="tabContent">
            <form id="modelForm" class="postForm" method="post">
                <ul>
                    <li><b><em>*</em>模型名称</b><input class="uiText" type="text" name="title" /><label class="tip">模型名称长度不能超过20</label></li>
                    <li><b><em>*</em>数据表</b><input class="uiText" type="text" name="table" /><label class="tip">数据表长度不能超过20</label></li>
                    <li><b>描述</b><textarea name="desc" cols="60" rows="5"></textarea><label class="tip">描述长度不能超过100</label></li>
                </ul>
                <p>
                    <a id="submitBtn" class="uiBtn" href="<?=site_url('admin/content/model/add')?>" title="提交"><span>提交</span></a>
                    <a class="uiBtn" href="javascript:;" onclick="history.go(-1);" title="返回"><span>返回</span></a>
                </p>
            </form>
        </div>
    </div>