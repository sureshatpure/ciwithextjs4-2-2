/**
 * @class Bleext.desktop.Constants
 * @extends Object
 * requires 
 * @autor Crysfel Villa
 * @date Mon Jul 25 23:04:37 CDT 2011
 *
 * Description
 *
 *
 **/

Ext.define("lms.application.constants",{
	alternateClassName	: "Lms.constants" ,
	singleton	: true,
 	
 	//Bleext.BASE_PATH = http://localhost/extjsci/
	//http://localhost/lms/public
	/* login url */
	DESKTOP_CONFIGURATION_URL	: Lms.BASE_PATH+"/desktop/config",
	DESKTOP_LOGIN_URL			: Lms.BASE_PATH+"/login/validate",
	DESKTOP_LOGOUT_URL			: Lms.BASE_PATH+"/login/logout",
	DESKTOP_HOME_URL			: Lms.BASE_PATH+"/desktop/home",
	
	/* The directory where the avatars are */
	USERS_AVATAR_PATH			: Lms.BASE_PATH+"resources/avatars/",
	
	/* The directory where the JS's are*/
	JS_PATH						: Lms.BASE_PATH+"js/",
	
	/* Default width and height for windows */
	DEFAULT_WINDOW_WIDTH		: 800,
	DEFAULT_WINDOW_HEIGHT		: 480,
	
	LOGIN_IMAGE					: Lms.BASE_PATH+"resources/images/login-image.jpg"
	
});