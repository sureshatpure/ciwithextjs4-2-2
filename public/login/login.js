Ext.Loader.setConfig({
	enabled : true,
	paths   : {
	lms  : BASE_PATH+'js/login'
	} 
});

Ext.require("login.LoginForm");

Ext.onReady(function(){
	var win = Ext.create("login.LoginWindow");
	win.show();

	Ext.get("loading").remove();
});