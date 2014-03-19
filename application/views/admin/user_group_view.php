                <div class="contentList">
                    <table border="0">
                        <thead>
                            <tr>
                               <th class="ck"><input class="check-all" type="checkbox" /></th>
                                <th>用户组</th>
                                <th class="operate">操作</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($group as $item): ?>
                            <tr>
                                <td class="ck"><input type="checkbox" value="<?=$item->id?>" /></td>
                                <td><?=$item->title?></td>
                                <td><a class="action update" href="<?=site_url('admin/user/group/update_view/'.$item->id)?>" title="修改">修改</a>|<a class="action delete" onclick="return confirm('确定要删除吗?');" href="<?=site_url('admin/user/group/delete/'.$item->id)?>" title="删除">删除</a></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="btnbar">
                        <a class="uiBtn" href="<?=site_url('admin/user/group/add_view')?>" title="添加"><span>添加</span></a>
                        <a id="deleteLotBtn" class="uiBtn" href="<?=site_url('admin/user/group/delete')?>" title="批量删除"><span>批量删除</span></a>
                    </div>
                </div>