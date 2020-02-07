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
	  	content: '<div class="upload-border">'+
	  				'<div class="layui-tab">'+
						'<ul class="layui-tab-title">'+
						    '<li class="layui-this">上传文件</li>'+
						    '<li>网络文件</li>'+
						    '<li>图库</li>'+
						'</ul>'+
						'<div class="layui-tab-content">'+
						    '<div class="layui-tab-item layui-show">'+
						    	'<div class="layui-upload">'+
								  	'<button type="button" class="layui-btn layui-btn-normal" id="choose">选择文件</button>'+
								  	'<button type="button" class="layui-btn" id="start-upload">开始上传</button>'+
								'</div>'+
						    '</div>'+
						    '<div class="layui-tab-item">'+
						    	'<div class="layui-form-item">'+
								    '<label class="layui-form-label">网络文件地址</label>'+
								    '<div class="layui-input-block">'+
								      '<input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入网络文件地址" class="layui-input">'+
								    '</div>'+
								 '</div>'+
						    '</div>'+
						    '<div class="layui-tab-item">内容3</div>'+
						'</div>'+
					'</div>'+
				'</div>'
	});
}
