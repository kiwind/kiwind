                 <div class="contentList">
                    <table id="listTable" border="0">
                        <thead>
                            <tr>
                                <th class="ck"><input class="check-all" type="checkbox" /></th>
                                <th>排序</th>
                                <th>栏目名称</th>
                                <th>内容模型</th> 
                                <th>栏目内容类别</th>
                                <th class="operate">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($res as $item): ?>
                            <tr>
                                <td class="ck"><input type="checkbox" value="<?=$item[0]?>" /></td>
                                <td><input class="uiText" size="2" style="text-align:center;" type="text" value="<?=$item[4]?>" /></td>
                                <td><?=$item[1]?></td>
                                <td><?=$item[2]?></td>
                                <td><?=$item[3]?></td>
                                <td>
                                    <a class="action" href="<?=site_url('admin/content/column/update_view/'.$item[0])?>" title="修改">修改</a>|
                                    <a class="action" onclick="return confirm('确定要删除吗?');" href="<?=site_url('admin/content/column/delete/'.$item[0])?>" title="删除">删除</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="btnbar">
                        <a class="uiBtn" href="<?=site_url('admin/content/column/add_view')?>" title="添加栏目"><span>添加栏目</span></a>
                        <a id="deleteLotBtn" class="uiBtn" href="<?=site_url('admin/content/column/delete')?>" title="批量删除"><span>批量删除</span></a>
                        <a id="sortBtn" class="uiBtn" href="<?=site_url('admin/content/column/sort')?>" title="排序"><span>排序</span></a>
                    </div>
                </div>