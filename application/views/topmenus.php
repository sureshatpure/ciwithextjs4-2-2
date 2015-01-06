      <link rel="stylesheet" href="../../jqwidgets/styles/jqx.base.css" type="text/css" />
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/scripts/gettheme.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jscripts/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxcheckbox.js"></script>
   <link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.black.css" type="text/css" />
   <script type="text/javascript">
            $(document).ready(function () {
                var theme = "";
                // Create a jqxMenu
                $("#jqxMenu").jqxMenu({ width: '670', height: '30px', theme: 'black' });
                $("#jqxMenu").css('visibility', 'visible');
                $("#disabled").jqxCheckBox({ theme: theme, width: '150px', height: '20px' });
                $("#open").jqxCheckBox({ theme: theme, width: '150px', height: '20px' });
                $("#hover").jqxCheckBox({ theme: theme, width: '150px', height: '20px' });
                $("#topLevelArrows").jqxCheckBox({ theme: theme, width: '200px', height: '20px' });
                $("#animation").jqxCheckBox({ theme: theme, width: '150px', height: '20px' });

                $("#animation").on('change', function (event) {
                    var value = event.args.checked;
                    // enable or disable the menu's animation.
                    if (!value) {
                        $("#jqxMenu").jqxMenu({ animationShowDuration: 0, animationHideDuration: 0, animationShowDelay: 0 });
                    }
                    else {
                        $("#jqxMenu").jqxMenu({ animationShowDuration: 300, animationHideDuration: 200, animationShowDelay: 200 });
                    }
                });

                $("#disabled").on('change', function (event) {
                    var value = event.args.checked;
                    // enable or disable the menu
                    if (!value) {
                        $("#jqxMenu").jqxMenu({ disabled: false });
                    }
                    else {
                        $("#jqxMenu").jqxMenu({ disabled: true });
                    }
                });

                $("#hover").on('change', function (event) {
                    var value = event.args.checked;
                    // enable or disable the menu's hover effect.
                    if (!value) {
                        $("#jqxMenu").jqxMenu({ enableHover: false });
                    }
                    else {
                        $("#jqxMenu").jqxMenu({ enableHover: true });
                    }
                });

                $("#open").on('change', function (event) {
                    var value = event.args.checked;
                    // enable or disable the opening of the top level menu items when the user hovers them.
                    if (!value) {
                //        $("#jqxMenu").jqxMenu({ autoOpen: false });
                    }
                    else {
                   //     $("#jqxMenu").jqxMenu({ autoOpen: true });
                    }
                });
                $("#topLevelArrows").on('change', function (event) {
                    var value = event.args.checked;
                    // enable or disable the opening of the top level menu items when the user hovers them.
                    if (!value) {
                        $("#jqxMenu").jqxMenu({ showTopLevelArrows: false });
                    }
                    else {
                        $("#jqxMenu").jqxMenu({ showTopLevelArrows: true });
                    }
                });
            });
        </script>
        <div class="navbar" id="topMenus">
            <div class="navbar-inner" id="nav-inner">
                <div class="menuBar row-fluid">

<!-- new -->
               <div class="span3 row-fluid" id="">
                      <!-- start of widget --> 
                    <div id='jqxWidget' style='height: 32px;'>
                        <div id='jqxMenu' style='visibility: hidden; margin-left: 5px;'>
                            <ul>
                                <li><a href="#Home">Home</a></li>
                                <li>Solutions
                                    <ul style='width: 250px;'>
                                        <li><a href="#Education">Education</a></li>
                                        <li><a href="#Financial">Financial services</a></li>
                                        <li><a href="#Government">Government</a></li>
                                        <li><a href="#Manufacturing">Manufacturing</a></li>
                                        <li type='separator'></li>
                                        <li>Software Solutions
                                            <ul style='width: 220px;'>
                                                <li><a href="#ConsumerPhoto">Consumer photo and video</a></li>
                                                <li><a href="#Mobile">Mobile</a></li>
                                                <li><a href="#RIA">Rich Internet applications</a></li>
                                                <li><a href="#TechnicalCommunication">Technical communication</a></li>
                                                <li><a href="#Training">Training and eLearning</a></li>
                                                <li><a href="#WebConferencing">Web conferencing</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">All industries and solutions</a></li>
                                    </ul>
                                </li>
                                <li>Products
                                    <ul>
                                        <li><a href="#PCProducts">PC products</a></li>
                                        <li><a href="#MobileProducts">Mobile products</a></li>
                                        <li><a href="#AllProducts">All products</a></li>
                                    </ul>
                                </li>
                                <li>Support
                                    <ul style='width: 200px;'>
                                        <li><a href="#SupportHome">Support home</a></li>
                                        <li><a href="#CustomerService">Customer Service</a></li>
                                        <li><a href="#KB">Knowledge base</a></li>
                                        <li><a href="#Books">Books</a></li>
                                        <li><a href="#Training">Training and certification</a></li>
                                        <li><a href="#SupportPrograms">Support programs</a></li>
                                        <li><a href="#Forums">Forums</a></li>
                                        <li><a href="#Documentation">Documentation</a></li>
                                        <li><a href="#Updates">Updates</a></li>
                                    </ul>
                                </li>
                                <li>Communities
                                    <ul style='width: 200px;'>
                                        <li><a href="#Designers">Designers</a></li>
                                        <li><a href="#Developers">Developers</a></li>
                                        <li><a href="#Educators">Educators and students</a></li>
                                        <li><a href="#Partners">Partners</a></li>
                                        <li type='separator'></li>
                                        <li>By resource
                                            <ul>
                                                <li><a href="#Labs">Labs</a></li>
                                                <li><a href="#TV">TV</a></li>
                                                <li><a href="#Forums">Forums</a></li>
                                                <li><a href="#Exchange">Exchange</a></li>
                                                <li><a href="#Blogs">Blogs</a></li>
                                                <li><a href="#Experience Design">Experience Design</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>Company
                                    <ul style='width: 180px;'>
                                        <li><a href="#About">About Us</a></li>
                                        <li><a href="#Press">Press</a></li>
                                        <li><a href="#Investor">Investor Relations</a></li>
                                        <li><a href="#CorporateAffairs">Corporate Affairs</a></li>
                                        <li><a href="#Careers">Careers</a></li>
                                        <li><a href="#Showcase">Showcase</a></li>
                                        <li><a href="#Events">Events</a></li>
                                        <li><a href="#ContactUs">Contact Us</a></li>
                                        <li><a href="#Become an affiliate">Become an affiliate</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div> 
<!-- end  of jqwidget -->
                </div>
<!-- new end -->

<!-- start - logout -->
                
                <div class="span3 row-fluid" id="headerLinksmenu">
                        <div></div>
                    <span class="pull-right headerLinksContainer">
                        <span class="dropdown span settingIcons ">
                            <a id="menubar_item_right_LBL_FEEDBACK" class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <img src="http://10.1.2.40/salescrm/public/images/info.png" alt="Feedback" title="Feedback">
                            </a>
                            
                        </span>
                
                        <span class="dropdown span">
                            <span class="dropdown-toggle row-fluid" data-toggle="dropdown" href="#">
                                <a id="menubar_item_right_Administrator" class="userName textOverflowEllipsis span" title="User" style="font-size: 13px !important;
    line-height: 1.4; color:white; font-weight:bold;">JSURESH-195- <i class="caret"></i> 
                                </a> 
                            </span>
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a target="" id="menubar_item_right_LBL_MY_PREFERENCES" href="#">My Preferences</a>
                                </li>
                                <li class="divider">&nbsp;
                                </li>
                                <li>
                                    <a target="" id="menubar_item_right_LBL_SIGN_OUT" href="http://10.1.2.40/salescrm/admin/logout">Sign Out</a>
                                </li>
                            </ul>
                        </span>
                    </span>
                </div>

   <!-- end logout --> 

                      </div>

                </div>
            </div> 
