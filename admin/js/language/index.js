var LANGUAGE = {
	init: function()
	{
		//默认按钮点击
		$('.default').on('click', function(){
			if ($(this).find('.switch_status').hasClass('on')) return false;
			var id = $(this).parents('tr').data('lan_id');
			LANGUAGE.modify({'lan_id': id, 'is_default': 1}, function(){
				$(this).parents('tr').data('default', 1);
				$('.default').each(function(){
					var tempId = $(this).parents('tr').data('lan_id');
					$(this).switchBtn(tempId == id ? 1 : 0);
				});
			});
		});
		//状态点击按钮
		$('.status').on('click', function(){
			var id = $(this).parents('tr').data('lan_id');
			var status = $(this).find('.switch_status').hasClass('on') ? 0 : 1;
			var obj = $(this);
			var res = LANGUAGE.modify({'lan_id': id, 'status': status}, function(){
				obj.switchBtn(status)
			});
		});
		//编辑框内switch
		$('#dealbox .switch_botton').on('click', function(){
			var status = $(this).find('.switch_status').hasClass('on') ? 0 : 1;
			$(this).switchBtn(status);
			$(this).parents('.form-control').find('input').val(status);
		});
		//修改
		$('.modify').on('click', function(){
			LANGUAGE.initShow($(this).parents('tr').data());
		});
		//新增
		$('.add').on('click', function(){
			LANGUAGE.initShow();
		});
		//保存
		$('#dealbox .save').on('click', function(){
			var check = true;
	    	$(this).parents('form').find('[required=required]').each(function(){
	    		var val = $(this).val();
	    		if (val == '') {
	    			check = false;
	    			var name = $(this).prev().text();
	    			errorTips('请将'+name.slice(0, -1)+'填写完整');
	    			$(this).focus();
	    			return false;
	    		}
	    	});
	    	if (!check) return false;
	    	LANGUAGE.save();
		});
	},
	modify: function(data, callback)
	{
		post(URI+'language/modify', data, function(res){
			callback();
		});
	},
	initShow:function (data)
	{	
		if (typeof data == 'undefined') data = {};

		$('#dealbox .form-control').each(function(){
			var name = $(this).attr('name');
			if (typeof data[name] == 'undefined') {
				$('#dealbox [name="'+name+'"]').val('');
			} else {
				$('#dealbox [name="'+name+'"]').val(data[name]);
			}
		});
		if (typeof data.status != 'undefined') {
			if (data.status == 0) {
				$('#dealbox [name="status"]').val(0).parents('.input-group').find('.switch_status').removeClass('on').addClass('off');
			} else {
				$('#dealbox [name="status"]').val(1).parents('.input-group').find('.switch_status').removeClass('off').addClass('on');
			}
		}

		if (typeof data.is_default != 'undefined') {
			if (data.is_default == 0) {
				$('#dealbox [name="is_default"]').val(0).parents('.input-group').find('.switch_status').removeClass('on').addClass('off');
			} else {
				$('#dealbox [name="is_default"]').val(1).parents('.input-group').find('.switch_status').removeClass('off').addClass('on');
			}
		} else {
			$('#dealbox [name="is_default"]').val(0).parents('.input-group').find('.switch_status').removeClass('on').addClass('off');
		}

		if (data.lan_id) {
			$('#dealbox h3').text('编辑语言');
		} else {
			$('#dealbox h3').text('新增语言');
		}

		$('#dealbox').dealboxShow();
	},
	save: function ()
	{
		if ($('#dealbox button.save').find('span').length > 0) return false;
    	$('#dealbox button.save').html($('#dealbox button.save').data('loading-text'));
    	post(URI + 'language/update', $('#dealbox form').serializeArray(), function(res){
    		window.location.reload();
    	}, function(){
    		$('#dealbox button.save').button('reset');
    	});
	}
};