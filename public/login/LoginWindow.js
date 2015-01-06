/**
 * @class Bleext.modules.login.LoginPanel
 * @extends Bleext.ui.ModalPanel
 * @autor Crysfel Villa
 * @date Sun Jul 10 16:27:45 CDT 2011
 *
 * The login Panel.
 *
 **/


Ext.define("login.LoginWindow",{
	extend 			: "login.abstract.ModalWindow",
	requires		: ["login.LoginForm"],
	
	layout			: "auto",
	modal			: false,
	width			: 400,
	height			: 240,
	closable		: false,
	
	forward			: true,
	
	initComponent: function() {
		
        this.items = this.buildItems();

		this.callParent();
	},
	
	buildItems	: function(){
		return [{
			xtype	: "component",
			//html 	: '<img src="'+login.constants.LOGIN_IMAGE+'" />' 
			html 	: '<img src="themes/default/images/login-image.jpg" />' 
			
		},
			Ext.create("login.LoginForm",{forward:this.forward})
		];
	}
});