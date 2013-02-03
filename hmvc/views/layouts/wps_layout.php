<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title id='title'>Registration - Web Points System</title>
	<link rel="stylesheet" type="text/css" href="/js/ext34/resources/css/ext-all.css" />
<style>
body {
	font: normal 14px/18px Arial, Helvetica, sans-serif;
	color: #333;
	background-color: #FCFCFC;
}

#top {
border-top: 1px solid #FDFDFF;
border-bottom: 1px solid rgba(0, 0, 2, 0.1);
box-shadow: 0 1px 0 rgba(253, 253, 255, 0.5);
background: url(../images/toolbar.png) 0 0 repeat-x;
}

#main {
padding: 10px 0;
min-height: 400px;
}

#footer {
color: #fff;
background: #28292A;
border-top: 1px solid #232425;
padding: 10px 0;
}

#TopContainer { margin: 0; padding: 5px; overflow: hidden; }
#TopContainer a { line-height: 24px; color: #999; }

.wrapper { max-width: 900px; box-size: border-box; margin: auto; }
ul.line { list-style: none; }
ul.line li { display: inline-block; }
ul.line li a { text-decoration: none; padding: 0 10px; }

.ctr { text-align: center; }
.float-left { float: left; }
.float-right { float: right; }

h2 { font-size: 150%; }

</style>
	
</head>
<body>
			<link rel="stylesheet" type="text/css" href="/js/ext34/resources/css/ext-all.css" />
			
			<script type="text/javascript" src="/js/ext34/adapter/ext/ext-base.js"></script>

	        <script type="text/javascript" src="/js/commonjs/ExtCommon.js"></script>
	
	        <!-- ExtJS library: all widgets -->
	
	        <script type="text/javascript" src="/js/ext34/ext-all-debug.js"></script>
	     <div id="top">
			<div class="wrapper">
				<div id="TopContainer">
						<ul class="line float-left">
							<li class=""><h2><a href="#">WPS</a></h2></li>	
						</ul>
					<!--	<ul class="line float-right">
							<li class=""><a href="#">Register</a></li>		
							<li class=""><a href="#">Login</a></li>
					</ul>-->
				</div>
			</div>
		</div>
	        <div id="userControls">
</div>
<script type="text/javascript">
   	var addreslinkdev = "/dcarchive";
   	var addreslinklive = "/dcarchive";
ExtCommon.util.init();
ExtCommon.util.quickTips();
ExtCommon.util.validations();



		new Ext.Toolbar({

			renderTo: 'userControls',

			items:

			[
			 {
    xtype: 'tbbutton',
    text: 'HOME',
    icon: '/images/icons/house.png',
    cls: 'x-btn-text-icon',
    handler: function(){
        window.location="<?php echo site_url("home") ?>";
    }
}, '-',
		<?php
		//include("/home/infobahn/public_html/sms/functions/connect.php");
		//@session_start();
		$dbLink = new mysqli("localhost", "lithefzj_darryl", "LeyyeL03@!", "lithefzj_pos");
		$id = $userId;
		$username = $userName;
		#echo $id;

			$sql = "SELECT DISTINCT a.description AS btn, a.icon, b.description AS mnu, b.link, b.group
FROM module_category a LEFT JOIN module b ON a.id = b.category_id
LEFT JOIN module_group_access c ON c.module_id = b.id
LEFT JOIN module_group d ON d.id = c.group_id
LEFT JOIN module_group_users e ON d.id = e.group_id
WHERE b.is_public = 1 OR e.username = '$username' ORDER BY a.order, b.group, b.order, b.description";
			/*$sql = mysql_query("SELECT a.description AS btn, a.icon, b.description AS mnu, b.link, b.group FROM tbl_button a JOIN tbl_menu b ON a.button_id = b.button_id
WHERE a.access_level IN (0, $id) ORDER BY b.order");*/

			$result = $dbLink->query($sql);

			while($rows=$result->fetch_assoc()){

			$btnarray[] = $rows;

			}
		//print_r($btnarray);
if(!empty($btnarray)){
  foreach($btnarray as $key => $value){

  $buttons[$value['btn']][] = array('menu'=>$value['mnu'], 'link'=>$value['link'], 'group'=>$value['group']);
  $icon[$value['btn']] = $value['icon'];
  $lastmenu[$value['btn']] = $value['mnu'];
  $lastbutton = $value['btn'];
  }
  #print_r($lastmenu);

  $count = 0;

  foreach($buttons as $key => $value){
  //print_r($val);
  echo "{
					xtype: 'tbbutton',
					icon: '".$icon[$key]."',
					cls: 'x-btn-text-icon',
					text: '$key',
						menu: [";
  $group = NULL;
  foreach($value as $k=> $val){
  if($count == 0 && ($key == 'FILE REFERENCE' || $key == 'TRANSACTIONS')){
  $group = $val['group'];
  $count++;
  }
  if($group != $val['group'] && ($key == 'FILE REFERENCE' || $key == 'TRANSACTIONS')){
  	echo "'-',";
  	$group = $val['group'];
  	}
        if($val['menu'] == 'Change Password'){
            echo "{

							text: '".$val['menu']."',
							handler: function(){


							var form = new Ext.form.FormPanel({
				 		        labelWidth: 150,
				 		        url:'".site_url("userMatrix/updatePassword")."',
				 		        method: 'POST',
				 		        defaultType: 'textfield',
				 		        frame: true,
				 		        height: 100,

				 		        items: [ {
				 					xtype:'fieldset',
				 					title:'Please Confirm',
				 					width:370,
				 					height:'auto',
				 					defaults: {

				 				        anchor: '95%',
				 				        allowBlank: false
				 				      },
				 				      defaultType: 'textfield',

				 					items:[
						 			  {
				 				        fieldLabel: 'Old Password*',
				 				        inputType: 'password',
				 				        name: 'oldpass',
				 				        allowBlank: false,
				 				        id: 'oldpass'
				 				      },

						 			  {
				 				        fieldLabel: 'New Password*',
				 				        inputType: 'password',
				 				        name: 'pass',
				 				        allowBlank: false,
				 				        id: 'pass'
				 				      },{
				 				        fieldLabel: 'Confirm Password*',
				 				        inputType: 'password',
				 				        name: 'pass-cfrm',
				 				        vtype: 'password',
                                                                        enableKeyEvents: true,
				 				        allowBlank: false,
				 				        initialPassField: 'pass', // id of the initial password field
                                                                        listeners: {
                                                                            specialkey: function(f, e){
                                                                            if(e.getKey() == e.ENTER){
                                                                                if(ExtCommon.util.validateFormFields(form)){//check if all forms are filled up

				 		                form.getForm().submit({
					 		                params: {id: '$id'},
				 			                success: function(f,action){
				                 		    	Ext.MessageBox.alert('Status', action.result.data);
				                  		    	 Ext.Msg.show({
				  								     title: 'Status',
				 								     msg: action.result.data,
				  								     buttons: Ext.Msg.OK,
				  								     icon: Ext.Msg.INFO
				  								 });

				 				                _pwwindow.destroy();
				 			                },
				 			                failure: function(f,a){
				 								Ext.Msg.show({
				 									title: 'Error Alert',
				 									msg: a.result.data,
				 									icon: Ext.Msg.ERROR,
				 									buttons: Ext.Msg.OK
				 								});
				 			                },
				 			                waitMsg: 'Saving Data...'
				 		                });
				 	                }else return;
                                                                            }
                                                                            }
                                                                        }
				 				      }

				 		        ]
				 					}
				 		        ]
				 		    });

				 		    var _pwwindow = new Ext.Window({
				 		        title: 'Change Password',
				 		        width: 410,
				 		        height:225,
				 		        layout: 'fit',
				 		        plain:true,
				 		        modal: true,
				 		        bodyStyle:'padding:5px;',
				 		        buttonAlign:'center',
				 		        items: form,
				 		        buttons: [{
				 		         	text: 'Save',
				 	                handler: function () {
				 			            if(ExtCommon.util.validateFormFields(form)){//check if all forms are filled up

				 		                form.getForm().submit({
					 		                params: {id: '$id'},
				 			                success: function(f,action){
				                 		    	Ext.MessageBox.alert('Status', action.result.data);
				                  		    	 Ext.Msg.show({
				  								     title: 'Status',
				 								     msg: action.result.data,
				  								     buttons: Ext.Msg.OK,
				  								     icon: Ext.Msg.INFO
				  								 });

				 				                _pwwindow.destroy();
				 			                },
				 			                failure: function(f,a){
				 								Ext.Msg.show({
				 									title: 'Error Alert',
				 									msg: a.result.data,
				 									icon: Ext.Msg.ERROR,
				 									buttons: Ext.Msg.OK
				 								});
				 			                },
				 			                waitMsg: 'Saving Data...'
				 		                });
				 	                }else return;
				 	                }
				 	            },{
				 		            text: 'Cancel',
				 		            handler: function(){
				 			            _pwwindow.destroy();
				 		            }
				 		        }]
				 		    });
				 		  	_pwwindow.show();

  						}";

						echo "}";
        }else{
  	echo "{

							text: '".$val['menu']."',
							handler: function(){
  						window.location='".site_url($val['link'])."';
  						}";

						echo "}";
        }
  	if($val['menu'] != $lastmenu[$key])
  	echo ",";

  }

  echo "
						]


				}";

  if($key != $lastbutton)
  echo ", '-',";
  //print_r($buttons);
  //echo $lastbutton;
  }
  }
		?>
, '-', {
    xtype: 'tbbutton',
    text: 'LOGOUT',
    icon: '/images/icons/door_out.png',
    cls: 'x-btn-text-icon',
    handler: function(){
        window.location="<?php echo site_url("home/logout") ?>";
    }
}

			]

		}).render();

</script>

<?php echo $content_for_layout?>
    <!--
<div id="main">
<div class="wrapper">
<div class="module mod-stripes style-stripes">
	<div class="deepest" style="min-height: 200px;" id="deepest">
		
	</div>
</div>
</div>
</div>-->
<div id="footer">
	<div class="wrapper ctr">
		Copyright &#169; 2012 - Web Points Systems. All Rights Reserved.
	</div>
</div>
</body>
</html>