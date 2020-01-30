/*
* author: uncle
* time: 2020-01-29
*/

function uploadImage(){
	//layer.msg('上传图片');
	layer.open({
	  	type: 1,
	  	title: false,
	  	area: ['800px', '600px'],
	  	content: '<div class="layui-tab">'+
					'<ul class="layui-tab-title">'+
					    '<li class="layui-this">网站设置</li>'+
					    '<li>用户管理</li>'+
					    '<li>权限分配</li>'+
					    '<li>商品管理</li>'+
					    '<li>订单管理</li>'+
					'</ul>'+
					'<div class="layui-tab-content">'+
					    '<div class="layui-tab-item layui-show">内容1</div>'+
					    '<div class="layui-tab-item">内容2</div>'+
					    '<div class="layui-tab-item">内容3</div>'+
					    '<div class="layui-tab-item">内容4</div>'+
					    '<div class="layui-tab-item">内容5</div>'+
					'</div>'+
				'</div>'
	});
}