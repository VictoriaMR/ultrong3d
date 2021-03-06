<?php $this->load('common/header');?>
<div class="container-fluid">
	<div class="bottom15">
	    <button class="btn btn-success add" type="button"><span class="glyphicon glyphicon-plus-sign"></span>&nbsp;新增语言</button>
	</div>
	<table class="table  table-hover table-middle mt16">
        <tr>
            <th class="col-md-1 col-1">ID</th>
            <th class="col-md-2 col-2">名称</th>
            <th class="col-md-1 col-1">码</th>
            <th class="col-md-1 col-1">状态</th>
            <th class="col-md-1 col-1">是否默认</th>
            <th class="col-md-3 col-3">操作</th>
        </tr>
        <?php if (!empty($list)) { ?>
        <?php foreach ($list as $key => $value){ ?>
            <tr
                data-lan_id="<?php echo $value['lan_id'];?>"
                data-name="<?php echo $value['name'];?>"
                data-code="<?php echo $value['code'];?>"
                data-status="<?php echo $value['status'];?>"
                data-is_default="<?php echo $value['is_default'];?>"
            >
            	<td class="col-md-1 col-1"><?php echo $value['lan_id'];?></td>
            	<td class="col-md-2 col-2"><?php echo $value['name'];?></td>
            	<td class="col-md-1 col-1"><?php echo $value['code'];?></td>
            	<td class="col-md-1 col-1">
                    <div class="switch_botton status" data-status="<?php echo $value['status'];?>"><div class="switch_status <?php echo $value['status'] ? 'on' : 'off';?>"></div></div>
                </td>
                <td class="col-md-1 col-1">
                	<div class="switch_botton default" data-default="<?php echo $value['is_default'];?>"><div class="switch_status <?php echo $value['is_default'] ? 'on' : 'off';?>"></div></div>
                </td>
                <td class="col-md-3 col-3">
                	<button class="btn btn-primary btn-xs modify" type="button" ><span class="glyphicon glyphicon-edit"></span>&nbsp;修改</button>
                    <button class="btn btn-danger btn-sm delete hide" type="button" ><span class="glyphicon glyphicon-trash"></span>&nbsp;删除</button>
                </td>
            </tr>
        <?php } ?>
    	<?php } else { ?>
    	<tr>
    		<td colspan="7" style="text-align: center;"><span style="color: orange;">暂无数据</span></td>
    	</tr>
    	<?php } ?>
    </table>
</div>
<div id="dealbox" class="hidden">
    <div class="mask"></div>
    <div class="centerShow">
        <form class="form-horizontal">
            <input type="hidden" class="form-control" name="lan_id" value="0">
            <button type="button" class="close" aria-hidden="true">&times;</button>
            <h3 style="margin-top: 0px;">新增语言</h3>
            <div class="input-group mt16">
                <div class="input-group-addon"><span>名称：</span></div>
                <input type="text" class="form-control" name="name" required="required" maxlength="30" value="">
            </div>
            <div class="input-group">
                <div class="input-group-addon"><span>码：</span></div>
                <input type="text" class="form-control" name="code" required="required" maxlength="5" value="">
            </div>
            <div class="input-group">
                <div class="input-group-addon"><span>状态：</span></div>
                <div class="form-control" style="padding-top: 2px;width: 210px;">
                    <div class="switch_botton" data-status="1"><div class="switch_status on"></div></div>
                    <input type="hidden" name="status" value="1">
                </div>
            </div>
            <div class="input-group">
                <div class="input-group-addon"><span>是否默认：</span></div>
                <div class="form-control" style="padding-top: 2px;width: 183px;">
                    <div class="switch_botton" data-status="0"><div class="switch_status off"></div></div>
                    <input type="hidden" name="is_default" value="0">
                </div>
            </div>
            <div class="margin-top-15">
                <button type="button" class="btn btn-primary btn-lg btn-block save">确认</button>
            </div>
        </form>
    </div>
</div>
<script>
$(function(){
	LANGUAGE.init();
})
</script>
<?php $this->load('common/footer');?>