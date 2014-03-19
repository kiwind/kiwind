                 <div class="contentList">
                    <table border="0">
                        <thead>
                            <tr>
                                <th class="ck"><input class="check-all" type="checkbox" /></th>
                                <th>分类名称</th>
                                <th>所属栏目</th> 
                                <th class="operate">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($res as $item): ?>
                            <tr>
                                <td class="ck"><input type="checkbox" value="<?=$item[0]?>" /></td>
                                <td><?=$item[1]?></td>
                                <td><?=$item[2]?></td>
                                <td>
                                    <a class="action" href="<?=site_url('admin/content/type/update_view/'.$item[0])?>" title="修改">修改</a>|
                                    <a class="action" onclick="return confirm('确定要删除吗?');" href="<?=site_url('admin/content/type/delete/'.$item[0])?>" title="删除">删除</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="btnbar">
                        <a class="uiBtn" href="<?=site_url('admin/content/type/add_view')?>" title="添加分类"><span>添加分类</span></a>
                        <a id="deleteLotBtn" class="uiBtn" href="<?=site_url('admin/content/type/delete')?>" title="批量删除"><span>批量删除</span></a>
                    </div>
                </div>