<html>



    <head>



        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title><?php echo $title?></title>

		<link href= "/dev/ogs/css/ui_mainpage.css" rel="stylesheet" type="text/css" />

<!--[if lt IE 8]>







<style type="text/css">







#xouter{display:block}



#xcontainer{top:50%;display:block}



#xinner{top:-50%;position:relative}







</style>



<![endif]-->









<!--[if IE 7]>







<style type="text/css">







#xouter{



position:relative;



/*overflow:hidden;*/







}



</style>







<![endif]-->



 



        <!-- ** CSS ** -->



        <!-- base library -->



        <link rel="stylesheet" type="text/css" href="/js/ext34/resources/css/ext-all.css" />

        <!-- overrides to base library -->



<style type="text/css">

</style></head>

<body>

<!-- ** Javascript ** -->

        <!-- ExtJS library: base/adapter -->

        <script type="text/javascript" src="/js/ext34/adapter/ext/ext-base.js"></script>

        <script type="text/javascript" src="/js/commonjs/ExtCommon.js"></script>

        <!-- ExtJS library: all widgets -->

        <script type="text/javascript" src="/js/ext34/ext-all-debug.js"></script>

    













        

<div id="maincontent">

  <div id="left">

     <div id="object2"><img src="/images/ogslogo.png" /></div>

     

  </div>





  <div id="right">

    <div id="object1"><img src="/images/ogsrightheader.png" align="right" /></div>

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
        window.location="<?php echo site_url("main") ?>";
    }
}, '-',
		<?php
		//include("/home/infobahn/public_html/sms/functions/connect.php");
		//@session_start();
		$dbLink = new mysqli("localhost", "lithefzj_darryl", "LeyyeL03@!", "lithefzj_ogs".SEMEIDNO);
		$id = $userId;
		$username = $userName;
		#echo $id;

			$sql = "SELECT DISTINCT a.description AS btn, a.icon, b.description AS mnu, b.link, b.group, a.menu_link
FROM module_category a LEFT JOIN module b ON a.id = b.category_id
LEFT JOIN module_group_access c ON c.module_id = b.id
LEFT JOIN module_group d ON d.id = c.group_id
LEFT JOIN module_group_users e ON d.id = e.group_id
WHERE b.is_public = 1 OR e.username = '$username' ORDER BY a.order, b.group, b.order, b.description";
			/*$sql = mysql_query("SELECT a.description AS btn, a.icon, b.description AS mnu, b.link, b.group FROM tbl_button a JOIN tbl_menu b ON a.button_id = b.button_id
WHERE a.access_level IN (0, $id) ORDER BY b.order");*/

			$result = $dbLink->query($sql);
			
			//$sSQL = "SELECT * FROM module_menu WHERE module_id = ?";

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
					text: '$key',";
					if(!empty($value['menu_link']))
					echo "handler: function(){
  							window.location='".site_url($value['menu_link'])."';
  							}";
						echo "menu: [";
  $group = NULL;
  foreach($value as $k=> $val){
  if($count == 0 && $key == 'FILE REFERENCE'){
  $group = $val['group'];
  $count++;
  }
  if($group != $val['group'] && $key == 'FILE REFERENCE'){
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
        }elseif($val['menu'] == 'Approvals'){
        				echo "{

							text: '".$val['menu']."',
							menu: [
								{

							text: 'Adviser Profile',
							handler: function(){
  							window.location='".site_url("admin/adviserProfileChange")."';
  							}
								},
								{

							text: 'Student Profile',
							handler: function(){
  							window.location='".site_url("admin/studentProfileChange")."';
  							}
								}
							]";

						echo "}";
        }elseif($val['menu'] == 'Grade Entry Password'){
            echo "{

							text: '".$val['menu']."',
							handler: function(){


							var form = new Ext.form.FormPanel({
				 		        labelWidth: 150,
				 		        url:'".site_url("userMatrix/updateGradePassword")."',
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
        }
        else{
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
        window.location="<?php echo site_url("main/logout") ?>";
    }
}

			]

		}).render();

    </script>
    <?php echo $content_for_layout?>
<!--<style type="text/css">



a:link {

	color: #FFF;

}

a:visited {

	color: #FFF;

}

a:hover {

	color:#FFF;

}

a:active {

	color: #FFF;

}



</style>--><div id="mainfooter">

  <div align="center">SWP v1 / COPYRIGHT &copy; 2012 Lithefire Solutions Inc.<br />

  <a href="http://www.pixelcatalyst.net">www.lithefire.net</a></div>

  

     

  </div>





  <div id="rightfooter">

    <div id="imagefooter"></div>

  </div>

    

</div>



</body>



</html>
