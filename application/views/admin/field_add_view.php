    <div class="tabCon">
        <div class="title"><h2><?=$title?>&nbsp;&mdash;&nbsp;字段管理&nbsp;&mdash;&nbsp;添加字段</h2></div>
        <div class="tabContent">
            <form id="fieldForm" class="postForm" method="post">
                <ul>
                    <li><b>字段类型</b>
                        <select name="tid">
                            <?php foreach($fieldtype as $item){ ?>
                            <option value="<?=$item['id']?>"><?=$item['text']?></option>
                            <?php }?>
                        </select>
                    </li>
                    <li><b><em>*</em>字段名</b><input class="uiText" type="text" name="name" /><label class="tip">只能由英文字母、数字和下划线组成，并且仅能字母开头，不以下划线结尾，长度不能超过20</label></li>
                    <li><b><em>*</em>字段别名</b><input class="uiText" type="text" name="othername" /><label class="tip">例如：文章标题，长度不能超过20</label></li>
                    <li><b>字段长度</b><input class="uiText" type="text" name="length" /><label class="tip"></label></li>
                    <li><b>字段提示</b><textarea cols="60" rows="5" name="tip"></textarea><label class="tip">长度不能超过100</label></li>
                    <li><b>默认值</b><input class="uiText" type="text" name="defaultValue" /></li>
                    <li><b>是否必填</b><input class="uiRadio" type="radio" name="ismust" checked="checked" value="1" /><label>是</label><input class="uiRadio" type="radio" name="ismust" value="0" /><label>否</label></li>
                    <li><b>是否在列表页显示</b><input class="uiRadio" type="radio" name="isshow" checked="checked" value="1" /><label>是</label><input class="uiRadio" type="radio" name="isshow" value="0" /><label>否</label></li>
                    <li><b>作为搜索条件</b><input class="uiRadio" type="radio" name="issearch" value="1" /><label>是</label><input class="uiRadio" type="radio" checked="checked" name="issearch" value="0" /><label>否</label></li>
                    <li><b>权重</b><input class="uiText" type="text" value="<?=$midx ?>" name="idx" /></li>
                </ul>
                <p>
                    <a id="submitBtn" class="uiBtn" href="<?=site_url('admin/content/field/add/'.$mid)?>" title="提交"><span>提交</span></a>
                    <a class="uiBtn" href="javascript:;" onclick="history.go(-1);" title="返回"><span>返回</span></a>
                </p>
            </form>
        </div>
    </div>