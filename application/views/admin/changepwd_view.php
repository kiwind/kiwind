    <div class="tabCon">
        <div class="title"><h2>修改密码</h2></div>
        <div class="tabContent">
            <form id="pwdForm" class="postForm" method="post">
                <ul>
                    <li><b><em>*</em>原密码</b><input class="uiText" type="text" name="ymm" /></li>
                    <li><b><em>*</em>新密码</b><input class="uiText" type="password" name="xmm" /><label class="tip">密码长度不能超过20</label></li>
                    <li><b><em>*</em>再次输入</b><input class="uiText" type="password" name="zxmm" /><label class="tip">密码长度不能超过20</label></li>
                </ul>
                <p>
                    <a id="submitBtn" class="uiBtn" href="<?php echo site_url('admin/user/changepwd/update') ?>" title="提交"><span>提交</span></a>
                    <a class="uiBtn" href="javascript:;" onclick="history.go(-1);" title="返回"><span>返回</span></a>
                </p>
            </form>
        </div>
    </div>