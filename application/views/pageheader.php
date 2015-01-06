</head>
<body>
	
<div id="page"><!-- container which holds data temporarly for pjax calls -->
	<div id="pjaxContainer" class="hide noprint"></div>
<div class="navbar-bg">
<?php $this->load->view('menu');?>	
</div>
        <div class="clear"></div>
        <div class="LMSpageheader">
        <div class="companyLogo floatleft">
            <img alt="logo.png" title="logo.png" src="<?=base_url()?>public/images/logo.png">&nbsp;</div>
		
        
        <ul class="top-menu floatRight">
     <li><a id="menubar_item_right_Administrator" class="userName textOverflowEllipsis span" title="User"><?php  echo $this->session->userdata['username']."-".$this->session->userdata['user_id']."-".$this->session->userdata['reportingto'];?> <i class="caret"></i> 
         </a> </li>			 
     <li>
				<a target="" id="menubar_item_right_LBL_SIGN_OUT" href="<?=base_url()?>admin/logout">Sign Out</a>
								</li>
	 						</ul><div class="clear"></div>
        </div>	
        <div class="clear"></div>
        <div class="bodyContents">
        <div class="sidebar">
            <ul class="sidebar-menu">		
            <li>
<a href="<?= base_url()?>leads" class="quickLinks">Leads List</a></li><li>
<a  href="<?= base_url()?>dashboard" class="quickLinks">Dashboard</a></li>
            
             
            <li>
<a href="#">Recently Modified</a></li><li>
<a href="#"> Loading Widget</a></li>
            <li><a class="quickLinks" href="<?= base_url()?>leads/convertedleads">Converted Leads</a></li>
                   <li>    <a class="quickLinks" href="<?= base_url()?>dashboard/executivepipeline">
                    Branch/User Wise Lead Ageing</a></li>
                              <li>    <a class="quickLinks" href="<?= base_url()?>dashboard/additional">
                    Branch/Status Wise Lead Count</a></li>
                    <li><a href="<?= base_url()?>dashboard/generadtedleads">User /Branch Wise Generated Leads</a></li>
                      <li><a href="<?= base_url()?>dashboard/daynoprogress">Day No Progress</a></li>
                      
                             <li><a class="quickLinks" href="<?= base_url()?>dashboard/generadtedleads">
                    User /Branch Wise Generated Leads</a></li>
        </ul>
        </div>
            
  
     