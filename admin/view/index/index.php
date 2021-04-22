<?php $this->load('common/header');?>
<div id="index-page">
	<div class="header">
		<div class="right">
			<a href="" class="glyphicon glyphicon-bell" id="message"></a>
			<a href="" class="glyphicon glyphicon-cog"></a>
			<a href="<?php echo url('login/logout');?>" class="glyphicon glyphicon-log-out"></a>
		</div>
	</div>
	<div class="body">
		<div class="nav-left">
			<div class="person">
				<div class="avatar">
					<img src="<?php echo $info['avatar'];?>">
				</div>
				<div class="info">
					<p class="e1 cf"><?php echo $info['name'];?>&nbsp;<?php echo $info['mem_id'];?></p>
					<p class="e1 cr"><?php echo $info['mobile'];?></p>
					<a href="<?php echo url('login/logout');?>" class="glyphicon glyphicon-off cr" title="退出登录"></a>
				</div>
			</div>
			<div class="left-content">
				<div class="left-one">
					<div class="toggle open" data-title="菜单切换开关">
						<span class="glyphicon glyphicon-align-justify"></span>
					</div>
					<?php if (!empty($controllerList)) {?>
					<div class="nav-content">
						<ul>
							<?php foreach ($controllerList as $key => $value) {?>
							<li data-title="<?php echo $value['name'];?>" data-to="<?php echo $value['name_en'];?>">
								<span class="glyphicon glyphicon-<?php echo $value['icon'];?>"></span>
								<span class="ml6"><?php echo $value['name'];?></span>
							</li>
							<?php } ?>
						</ul>
					</div>
					<?php }?>
				</div>
				<div class="left-two">
					<div class="title">
						<span class="text block c5f e1">页面标题</span>
						<span class="glyphicon glyphicon-backward" title="收起"></span>
					</div>
					<?php if (!empty($controllerList)) {?>
					<div class="nav-son-content">
						<?php foreach ($controllerList as $key => $value) { if (empty($value['son'])) continue;?>
						<div class="item" data-for="<?php echo $value['name_en'];?>">
							<ul>
								<?php foreach ($value['son'] as $sk => $sv) {?>
								<li data-src="<?php echo url($sv['name_en']);?>" class="selected">
									<span class="glyphicon glyphicon-<?php echo $sv['icon'];?>"></span>
									<span class="ml6"><?php echo $sv['name'];?></span>
									<a class="glyphicon glyphicon-link right" title="新窗口打开" target="_blank" href="<?php echo url($sv['name_en']);?>"></a>
								</li>
								<?php } ?>
							</ul>
						</div>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="content-right" style="background: transparent url(<?php echo url('login/signature');?>) repeat;">
			<iframe src="javascript:;" id="href-to-iframe" width="100%" marginwidth="0" height="100%" marginheight="0" align="top" scrolling="Yes" frameborder="0" hspace="0" vspace="0"></iframe>
		</div>
		<div class="claer"></div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	INDEX.init();
});
</script>
<?php $this->load('common/footer');?>