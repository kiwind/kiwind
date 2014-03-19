                <div class="contentList">
                    <table border="0">
                        <thead>
                            <tr>
                               <th class="ck"><input class="check-all" type="checkbox" /></th>
                                <th>id</th>
                                <th>模型名称</th> 
                                <th>数据表</th>
                                <th>描述</th>
                                <th class="operate">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($list as $item): ?>
                            <tr>
                                <td class="ck"><input type="checkbox" value="<?=$item->id?>" /></td>
                                <td><?=$item->id?></td>
                                <td><?=$item->title?></td>
                                <td><?=$item->table?></td>
                                <td><?=$item->desc?></td>
                                <td>
                                    <a class="action" href="<?=site_url('admin/content/field/view/'.$item->id)?>" title="字段管理">字段管理</a>|
                                    <a class="action" href="<?=site_url('admin/content/model/update_view/'.$item->id)?>" title="修改">修改</a>|
                                    <a class="action" onclick="return confirm('确定要删除吗?');" href="<?=site_url('admin/content/model/delete/'.$item->id)?>" title="删除">删除</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="btnbar">
                        <a class="uiBtn" href="<?=site_url('admin/content/model/add_view')?>" title="添加模型"><span>添加模型</span></a>
                        <a id="deleteLotBtn" class="uiBtn" href="<?=site_url('admin/content/model/delete')?>" title="批量删除"><span>批量删除</span></a>
                    </div>
                </div>