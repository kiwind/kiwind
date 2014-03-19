    <div class="tabCon">
        <div class="title"><h2>修改栏目</h2></div>
        <div class="tabContent">
            <form id="columnForm" class="postForm" method="post">
                <ul>
                    <li><b>栏目名称</b><input class="uiText ttitle" type="text" name="title" value=<?=$item->title?> /></li>
                    <li><b>父栏目</b>
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
                    <li><b>内容模型</b>
                        <select name="mid">
                            <option value="0">无</option>
                            <?php foreach($mlist as $mitem):?>
                            <?php if($item->mid==$mitem->id):?>
                            <option value="<?=$mitem->id?>" selected="selected"><?=$mitem->title?></option>
                            <?php else:?>
                            <option value="<?=$mitem->id?>"><?=$mitem->title?></option>
                            <?php endif;?>
                            <?php endforeach;?>
                        </select>
                    </li>
                    <li><b>栏目内容类别</b>
                        <select name="cid">
                            <option value="0">无</option>
                            <?php foreach($clist as $citem):?>
                            <?php if($item->cid==$citem->id):?>
                            <option value="<?=$citem->id?>" selected="selected"><?=$citem->title?></option>
                            <?php else:?>
                            <option value="<?=$citem->id?>"><?=$citem->title?></option>
                            <?php endif;?>
                            <?php endforeach;?>
                        </select>
                    </li>
                    <li><b>权重</b><input class="uiText" type="text" name="idx" value="<?=$item->idx?>" /></li>
                </ul>
                <p>
                    <a id="submitBtn" class="uiBtn" href="<?=site_url('admin/content/column/update/'.$item->id)?>" title="提交"><span>提交</span></a>
                    <a class="uiBtn" href="javascript:;" onclick="history.go(-1);" title="返回"><span>返回</span></a>
                </p>
            </form>
        </div>
    </div>