                 <div class="tabCon"><div class="title"><h2><?=$title?></h2></div></div>
                 <div class="contentList">
                    <table border="0">
                        <thead>
                            <tr>
                                <th class="ck"><input class="check-all" type="checkbox" /></th>
                                <?php foreach($fieldothername as $th): ?>
                                <th><?=$th->othername?></th>
                                <?php endforeach; ?>
                                <th class="operate">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($res as $item): ?>
                            <tr>
                                <td class="ck"><input type="checkbox" value="<?=$item['id']?>" /></td>
                                <?=$item['content']?>
                                <td>
                                    <a class="action" href="<?=site_url('admin/content/manage/update_view/'.$cid.'/'.$item['id'])?>" title="修改">修改</a>|
                                    <a class="action" onclick="return confirm('确定要删除吗?');" href="<?=site_url('admin/content/manage/delete/'.$cid.'/'.$item['id'])?>" title="删除">删除</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="page"><?=$pagebar?></div>
                    <div class="btnbar">
                        <a class="uiBtn" href="<?=site_url('admin/content/manage/add_view/'.$cid)?>" title="添加内容"><span>添加内容</span></a>
                        <a id="deleteLotBtn" class="uiBtn" href="<?=site_url('admin/content/manage/delete/'.$cid)?>" title="批量删除"><span>批量删除</span></a>
                    </div>
                    <div class="searchbar">
                        <form action="<?=site_url('admin/content/manage/search/'.$cid)?>" method="GET">
                           <?php echo $searchstr ?> 
                        </form>
                    </div>
                </div>