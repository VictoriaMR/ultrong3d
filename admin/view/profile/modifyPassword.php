<?php $this->load('common/header');?>
<div class="container-fluid">
	<form class="form-horizontal" style="width: 500px;">
		<div class="input-group mt16">
            <div class="input-group-addon"><span>新密码：</span></div>
            <input type="password" class="form-control" name="password" required="required" maxlength="30" value="">
        </div>
        <div class="input-group mt16">
            <div class="input-group-addon"><span>确认密码：</span></div>
            <input type="password" class="form-control" name="re_password" required="required" maxlength="30" value="">
        </div>
        <div class="mt16">
            <button type="button" class="btn btn-primary btn-lg btn-block save">确认</button>
        </div>
	</form>
</div>
<script type="text/javascript">
$(function(){
	PASSWORD.init();
})
</script>
<?php $this->load('common/footer');?>