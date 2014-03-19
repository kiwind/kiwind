    <div class="tabCon">
        <div class="title"><h2><?=$title?>&nbsp;&mdash;&nbsp;修改内容</h2></div>
        <div class="tabContent">
            <form id="contentForm" class="postForm" method="post">
                <ul>
                    <?php foreach($res as $item):?>
                    <li><?=$item?></li>
                    <?php endforeach;?>
                </ul>
                <p>
                    <a id="contentSumbitBtn" class="uiBtn" href="<?=site_url('admin/content/manage/update/'.$cid.'/'.$id)?>" title="提交"><span>提交</span></a>
                    <a class="uiBtn" href="javascript:;" onclick="history.go(-1);" title="返回"><span>返回</span></a>
                </p>
            </form>
            <?php echo $jsstr ?>
        </div>
    </div>