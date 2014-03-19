                 <div class="contentList">
                    <table border="0">
                        <thead>
                            <tr>
                                <th>栏目名称</th>
                                <th class="operate">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($res as $item): ?>
                            <tr>
                                <td><?=$item[1]?></td>
                                <?php if($item[2]!=""):?>
                                <td>
                                    <a class="action" href="<?=site_url('admin/content/manage/list/'.$item[0])?>" title="进入管理">进入管理</a>
                                </td>
                                <?php else:?>
                                <td>&nbsp;</td>
                                <?php endif;?>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>