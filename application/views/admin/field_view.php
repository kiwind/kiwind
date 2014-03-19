                 <div class="tabCon"><div class="title"><h2><?=$title?>&nbsp;&mdash;&nbsp;字段管理</h2></div></div>
                 <div class="contentList">
                    <table id="listTable" border="0">
                        <thead>
                            <tr>
                                <th class="ck"><input class="check-all" type="checkbox" /></th>
                                <th>排序</th>
                                <th>字段名称</th>
                                <th>字段别名</th>
                                <th>字段类型</th>
                                <th class="operate">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($fields as $item): ?>
                            <tr>
                                <td class="ck"><input type="checkbox" value="<?=$item->id?>" /></td>
                                <td><input class="uiText" size="2" style="text-align:center;" type="text" value="<?=$item->idx?>" /></td>
                                <td><?=$item->name?></td>
                                <td><?=$item->othername?></td>
                                <td><?=$item->type?></td>
                                <td>
                                    <a class="action" href="<?=site_url('admin/content/field/update_view/'.$mid."/".$item->id)?>" title="修改">修改</a>|
                                    <a class="action" onclick="return confirm('确定要删除吗?');" href="<?=site_url('admin/content/field/delete/'.$mid."/".$item->id)?>" title="删除">删除</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="btnbar">
                        <a class="uiBtn" href="<?=site_url('admin/content/field/add_view/'.$mid)?>" title="添加字段"><span>添加字段</span></a>
                        <a id="deleteLotBtn" class="uiBtn" href="<?=site_url('admin/content/field/delete/'.$mid)?>" title="批量删除"><span>批量删除</span></a>
                        <a id="sortBtn" class="uiBtn" href="<?=site_url('admin/content/field/sort/'.$mid)?>" title="排序"><span>排序</span></a>
                    </div>
                </div>