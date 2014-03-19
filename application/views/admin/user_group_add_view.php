    <div class="tabCon">
        <div class="title"><h2>添加用户组</h2></div>
        <div class="tabContent">
            <form id="groupForm" class="postForm" method="post">
                <ul>
                    <li><b>用户组名称</b><input class="uiText" type="text" name="title" /></li>
                    <li><b>权重</b><input class="uiText" type="text" value="<?php if($midx=="")echo 0;else echo $midx;?>" name="idx" /></li>
                </ul>
                <p>
                    <a id="submitBtn" class="uiBtn" href="<?=site_url('admin/user/group/add')?>" title="提交"><span>提交</span></a>
                    <a class="uiBtn" href="javascript:;" onclick="history.go(-1);" title="返回"><span>返回</span></a>
                </p>
            </form>
        </div>
    </div>