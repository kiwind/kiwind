    <div class="tabCon">
        <div class="title"><h2>添加栏目</h2></div>
        <div class="tabContent">
            <form id="columnForm" class="postForm" method="post">
                <ul>
                    <li><b><em>*</em>栏目名称</b><input class="uiText ttitle" type="text" name="title" /><label class="tip">栏目名称长度不能超过20</label></li>
                    <li><b>父栏目</b>
                        <select name="pid">
                            <option value="0">无</option>
                            <?php foreach($res as $item){ ?>
                            <option value="<?=$item[0]?>"><?=$item[1]?></option>
                            <?php }?>
                        </select>
                    </li>
                    <li><b>内容模型</b>
                        <select name="mid">
                            <option value="0">无</option>
                            <?php foreach($mlist as $mitem):?>
                            <option value="<?=$mitem->id?>"><?=$mitem->title?></option>
                            <?php endforeach;?>
                        </select>
                    </li>
                    <li><b>栏目内容类别</b>
                        <select name="cid">
                            <option value="0">无</option>
                            <?php foreach($clist as $citem):?>
                            <option value="<?=$citem->id?>"><?=$citem->title?></option>
                            <?php endforeach;?>
                        </select>
                    </li>
                    <li><b>权重</b><input class="uiText" type="text" name="idx" value="<?=$midx ?>" /></li>
                </ul>
                <p>
                    <a id="submitBtn" class="uiBtn" href="<?=site_url('admin/content/column/add')?>" title="提交"><span>提交</span></a>
                    <a class="uiBtn" href="javascript:;" onclick="history.go(-1);" title="返回"><span>返回</span></a>
                </p>
            </form>
        </div>
    </div>