    <div class="tabCon">
        <div class="title"><h2>修改分类</h2></div>
        <div class="tabContent">
            <form id="typeForm" class="postForm" method="post">
                <ul>
                    <li><b><em>*</em>分类名称</b><input class="uiText ttitle" type="text" name="title" value="<?=$item->title?>" /><label class="tip">分类名称长度不能超过20</label></li>
                    <li><b>父分类</b>
                        <select name="pid">
                            <option value="0">无</option>
                            <?php foreach($res as $row): ?>
                            <?php if($row[0]==$item->pid):?>
                            <option value="<?=$row[0]?>" selected="selected"><?=$row[1]?></option>
                            <?php else:?>
                            <option value="<?=$row[0]?>"><?=$row[1]?></option>
                            <?php endif;?>
                            <?php endforeach;?>
                        </select>
                    </li>
                    <li><b>所属栏目</b>
                        <select name="cid">
                            <option value="0">无</option>
                            <?php foreach($clist as $citem){ ?>
                            <?php if($citem->id==$item->cid): ?>
                            <option value="<?=$citem->id?>" selected="selected"><?=$citem->title?></option>
                            <?php else: ?>
                            <option value="<?=$citem->id?>"><?=$citem->title?></option>
                            <?php endif; ?>
                            <?php }?>
                        </select>
                    </li>
                    <li><b>权重</b><input class="uiText" type="text" name="idx" value="<?=$item->idx?>" /></li>
                </ul>
                <p>
                    <a id="submitBtn" class="uiBtn" href="<?=site_url('admin/content/type/update/'.$item->id)?>" title="提交"><span>提交</span></a>
                    <a class="uiBtn" href="javascript:;" onclick="history.go(-1);" title="返回"><span>返回</span></a>
                </p>
            </form>
        </div>
    </div>