var TRANSFER = {
	init: function() 
	{
		$('.modify').on('click', function(){
			TRANSFER.initShow($(this).parents('tr').data());
			$('#dealbox').dealboxShow();
		});
		$('#dealbox button.save').on('click', function(){
	    	var check = true;
	    	$(this).parents('form').find('[required=required]').each(function(){
	    		var val = $(this).val();
	    		if (val == '') {
	    			check = false;
	    			var name = $(this).prev().text();
	    			POP.tips('请将'+name.slice(0, -1)+'填写完整');
	    			$(this).focus();
	    			return false;
	    		}
	    	});
	    	if (!check) return false;
	    	$(this).button('loading');
	    	TRANSFER.save();
	    	$(this).button('reset');
	    });
	    //重构缓存
	    $('.reload-cache').on('click', function(){
	    	var obj = $(this);
	    	obj.button('loading');
	    	post(URI+'transfer/reloadCache', {}, function(res){
	    		obj.button('reset');
	    	}, function(){
	    		obj.button('reset');
	    	});
	    })
	},
	initShow:function (data)
	{	
		for (var i in data) {
			$('#dealbox [name="'+i+'"]').val(data[i]);
		}
	},
	save: function ()
	{
    	post(URI+'transfer/modify', $('#dealbox form').serializeArray(), function(res){
    		window.location.reload();
    	}, function(){
    		$('#dealbox button.save').button('reset');
    	});
    	return true;
	}
};