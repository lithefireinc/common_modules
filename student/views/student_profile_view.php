<script type="text/javascript">
 Ext.namespace("studentProfile");
 studentProfile.app = function()
 {
 	return{
 		init: function()
 		{
 			ExtCommon.util.init();
 			ExtCommon.util.quickTips();
 			this.getGrid();
 		},
 		getGrid: function()
 		{
 			ExtCommon.util.renderSearchField('searchby');

 			var Objstore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?php echo site_url("student/getStudentInfo"); ?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [   {name: "STUDCODE"},
 											{ name: "STUDIDNO"},
                                            { name: "NAME"},
 											{ name: "LASTNAME"},
                                            { name: "FIRSTNAME"},
                                            { name: "MIDDLENAME"},
                                            { name: "GENDER"},
                                            { name: "BIRTHDATE"},
                                            { name: "BIRTHPLACE"},
                                            { name: "IDNO"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});


 			var grid = new Ext.grid.GridPanel({
 				id: 'studentProfilegrid',
 				height: 'auto',
 				width: 'auto',
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 						 // { header: "Id", dataIndex: "STUDIDNO", width: 100, sortable: true},
 						 { header: "Id No.", dataIndex: "IDNO", width: 100, sortable: true},
 						  { header: "Last Name", width: 150, sortable: true, dataIndex: "LASTNAME" },
                                                  { header: "First Name", width: 150, sortable: true, dataIndex: "FIRSTNAME" },
                                                  { header: "Middle Name", width: 150, sortable: true, dataIndex: "MIDDLENAME" },
                                                  { header: "Gender", width: 100, sortable: true, dataIndex: "GENDER" },
                                                  { header: "Date of Birth", width: 150, sortable: true, dataIndex: "BIRTHDATE" },
                                                  { header: "Place of Birth", width: 150, sortable: true, dataIndex: "BIRTHPLACE" }
 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,
 	        	bbar:
 	        		new Ext.PagingToolbar({
 		        		autoShow: true,
 				        pageSize: 25,
 				        store: Objstore,
 				        displayInfo: true,
 				        displayMsg: 'Displaying Results {0} - {1} of {2}',
 				        emptyMsg: "No Data Found."
 				    }),
 				tbar: [new Ext.form.ComboBox({
                    fieldLabel: 'Search',
                    hiddenName:'searchby-form',
                    id: 'searchby',
					//store: Objstore,
                    typeAhead: true,
                    triggerAction: 'all',
                    emptyText:'Search By...',
                    selectOnFocus:true,

                    store: new Ext.data.SimpleStore({
				         id:0
				        ,fields:
				            [
				             'myId',   //numeric value is the key
				             'myText' //the text value is the value

				            ]


				         , data: [['id', 'ID'], ['sd', 'Short Description'], ['ld', 'Long Description']]

			        }),
				    valueField:'myId',
				    displayField:'myText',
				    mode:'local',
                    width:100,
                    hidden: true

                }), {
					xtype:'tbtext',
					text:'Search:'
				},'   ', new Ext.app.SearchField({ store: Objstore, width:250}),
 					    {
 					     	xtype: 'tbfill'
 					 	}
 					 	<?php if($add):?>
 					 	,
 					 	{
 					     	xtype: 'tbbutton',
 					     	text: 'ADD',
							icon: '/images/icons/user_add.png',
 							cls:'x-btn-text-icon',

 					     	handler: studentProfile.app.Add

 					 	}
 					 	<?php endif;?>
 					 	<?php if($edit):?>
 					 	,'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'EDIT',
							icon: '/images/icons/user_edit.png',
 							cls:'x-btn-text-icon',

 					     	handler: studentProfile.app.Edit

 					 	}
 					 	<?php endif; ?>
 					 	/*,'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'DELETE',
							icon: '/images/icons/user_delete.png',
 							cls:'x-btn-text-icon',

 					     	handler: studentProfile.app.Delete

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'VIEW',
							icon: '/images/icons/user.png',
 							cls:'x-btn-text-icon',

 					     	handler: studentProfile.app.View

 					 	}*/
 	    			 ],
                                 listeners: {
			rowdblclick: function(grid, row, e){
                            
                        }
                        }
 	    	});

 			studentProfile.app.Grid = grid;
 			studentProfile.app.Grid.getStore().load({params:{start: 0, limit: 25}});

 			//var msgbx = Ext.MessageBox.wait("Redirecting to main page. . .","Status");


 			var _window = new Ext.Panel({
 		        title: 'Student Profile',
 		        width: '100%',
 		        height:480,
 		        renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'fit',
 		        items: [studentProfile.app.Grid],
 		        resizable: false

 			    /*listeners : {
 				    	  close: function(p){
 					    	  window.location="../"
 					      }
 			       	} */
 	        });

 	        _window.render();


 		},
 			setForm: function(){
			
			
			var school_store = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?=site_url("student/getSchoolHistory")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "LEVEL"},
 											{ name: "SCHOOL_HIST"},
 											{name : "SCHOOL_YEAR"},
 											{name: "SCHOIDNO"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});	
 					
 					ExtCommon.util.renderSearchField('searchby_school');
 				
 			var school_grid = new Ext.grid.GridPanel({
 				id: 'school_grid',
 				height: 120,
 				width: '100%',
 				border: true,
 				style: {marginBottom: '10px'},
 				ds: school_store,
 				cm:  new Ext.grid.ColumnModel(
 						[
                                                    
 						  { header: "YEAR LEVEL", width: 100, sortable: true, dataIndex: "LEVEL" },
 						  { header: "SCHOOL", width: 300, sortable: true, dataIndex: "SCHOOL_HIST" },
 						  { header: "SCHOOL YEAR", width: 100, sortable: true, dataIndex: "SCHOOL_YEAR" }
 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,
 	        	bbar:
 	        		new Ext.PagingToolbar({
 		        		autoShow: true,
 				        pageSize: 25,
 				        store: school_store,
 				        displayInfo: true,
 				        displayMsg: 'Displaying Results {0} - {1} of {2}',
 				        emptyMsg: "No Data Found."
 				    }),
 				tbar: [new Ext.form.ComboBox({
                    fieldLabel: 'Search',
                    hiddenName:'searchby_scho',
                    id: 'searchby_school',
					//store: Objstore,
                    typeAhead: true,
                    triggerAction: 'all',
                    emptyText:'Search By...',
                    selectOnFocus:true,

                    store: new Ext.data.SimpleStore({
				         id:0
				        ,fields:
				            [
				             'myId',   //numeric value is the key
				             'myText' //the text value is the value

				            ]


				         , data: [['id', 'ID'], ['sd', 'Short Description'], ['ld', 'Long Description']]

			        }),
				    valueField:'myId',
				    displayField:'myText',
				    mode:'local',
                    width:100,
                    hidden: true

                }),/* {
					xtype:'tbtext',
					text:'Search:'
				},'   ', new Ext.app.SearchField({ store: school_store, width:250}),*/
 					    {
 					     	xtype: 'tbfill'
 					 	},{
 					     	xtype: 'tbbutton',
 					     	text: 'ADD',
							icon: '/images/icons/application_add.png',
 							cls:'x-btn-text-icon',

 					     	handler: studentProfile.app.AddSchool,
 					     	//disabled: true,
 					     	id: 'add_school_button'
 					     	

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'DELETE',
							icon: '/images/icons/application_delete.png',
 							cls:'x-btn-text-icon',

 					     	handler: studentProfile.app.DeleteSchool,
 					     	//disabled: true,
 					     	id: 'delete_school_button'

 					 	}
 	    			 ]
 	    	});

 			studentProfile.app.schoolGrid = school_grid;
 			
 			var honors_store = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?=site_url("student/getHonorsHistory")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "HONORS"},
 											{ name: "DESCRIPTION"},
 											{name : "HONOR_YEAR"},
 											{name: "HONOCODE"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});	
 				
 			var honors_grid = new Ext.grid.GridPanel({
 				id: 'honors_grid',
 				height: 120,
 				width: '100%',
 				border: true,
 				style: {marginBottom: '10px'},
 				ds: honors_store,
 				cm:  new Ext.grid.ColumnModel(
 						[
                                                    
 						  { header: "HONORS", width: 100, sortable: true, dataIndex: "HONORS" },
 						  { header: "DESCRIPTION", width: 300, sortable: true, dataIndex: "DESCRIPTION" },
 						  { header: "YEAR", width: 100, sortable: true, dataIndex: "HONOR_YEAR" }
 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,
 	        	bbar:
 	        		new Ext.PagingToolbar({
 		        		autoShow: true,
 				        pageSize: 25,
 				        store: honors_store,
 				        displayInfo: true,
 				        displayMsg: 'Displaying Results {0} - {1} of {2}',
 				        emptyMsg: "No Data Found."
 				    }),
 				tbar: [new Ext.form.ComboBox({
                    fieldLabel: 'Search',
                    hiddenName:'searchby_honor',
                    id: 'searchby_honors',
					//store: Objstore,
                    typeAhead: true,
                    triggerAction: 'all',
                    emptyText:'Search By...',
                    selectOnFocus:true,

                    store: new Ext.data.SimpleStore({
				         id:0
				        ,fields:
				            [
				             'myId',   //numeric value is the key
				             'myText' //the text value is the value

				            ]


				         , data: [['id', 'ID'], ['sd', 'Short Description'], ['ld', 'Long Description']]

			        }),
				    valueField:'myId',
				    displayField:'myText',
				    mode:'local',
                    width:100,
                    hidden: true

                }), /*{
					xtype:'tbtext',
					text:'Search:'
				},'   ', new Ext.app.SearchField({ store: honors_store, width:250}),*/
 					    {
 					     	xtype: 'tbfill'
 					 	},{
 					     	xtype: 'tbbutton',
 					     	text: 'ADD',
							icon: '/images/icons/application_add.png',
 							cls:'x-btn-text-icon',

 					     	handler: studentProfile.app.AddHonors,
 					     	//disabled: true,
 					     	id: 'add_honors_button'
 					     	

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'DELETE',
							icon: '/images/icons/application_delete.png',
 							cls:'x-btn-text-icon',

 					     	handler: studentProfile.app.DeleteHonors,
 					     	//disabled: true,
 					     	id: 'delete_honors_button'

 					 	}
 	    			 ]
 	    	});

 			studentProfile.app.honorsGrid = honors_grid;

 			
 			
 		    var form = new Ext.form.FormPanel({
 		        labelWidth: 80,
 		        url:"<?php echo site_url("student/insertStudentInfo"); ?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,
				
 		        items: [
 		        {
 		        	xtype: 'fieldset',
 		        	height: 'auto',
 		        	width: 'auto',
 		        	//labelWidth: 75,
 		        	items: [
 		        		{
 		        			layout: 'column',
 		        			width: 'auto',
 		        			items: [
 		        				{
 		        					columnWidth: .20,
 		        					layout: 'form',
 		        					items: [
 		        						{
                                            xtype:'textfield',
                                            fieldLabel: 'ID No.*',
                                            name: 'IDNO',
											anchor:'90%',  // anchor width by percentage
	 	  	 	 		  					id: 'IDNO',
	 	  	 	 		  					allowBlank: false

                                        }
 		        					]
 		        				},
 		        				{
 		        					columnWidth: .266,
 		        					layout: 'form',
 		        					items: [
 		        						{
                                            xtype:'textfield',
                                            fieldLabel: 'Last Name*',
                                            name: 'LASTNAME',
											anchor:'93%',  // anchor width by percentage
	 	  	 	 		  					id: 'LASTNAME',
	 	  	 	 		  					allowBlank: false

                                       }
 		        					]
 		        				},
 		        				{
 		        					columnWidth: .266,
 		        					layout: 'form',
 		        					items: [
 		        						{
                                            xtype:'textfield',
                                            fieldLabel: 'First Name*',
                                            name: 'FIRSTNAME',
											anchor:'93%',  // anchor width by percentage
	 	  	 	 		  					id: 'FIRSTNAME',
	 	  	 	 		  					allowBlank: false

                                        }
 		        					]
 		        				},
 		        				{
 		        					columnWidth: .266,
 		        					layout: 'form',
 		        					items: [
 		        						{
                                            xtype:'textfield',
                                            fieldLabel: 'Middle Name*',
                                            name: 'MIDDLENAME',
											anchor:'93%',  // anchor width by percentage
	 	  	 	 		  					id: 'MIDDLENAME',
	 	  	 	 		  					allowBlank: false

                                        }
 		        					]
 		        				}
 		        			
 		        			]
 		        		},
 		        		{
 		        			layout: 'column',
 		        			width: 'auto',
 		        			items: [
 		        				{
 		        					columnWidth: .20,
 		        					layout: 'form',
 		        					items: [
 		        					
 		        						{
                                            xtype:'textfield',
                                            fieldLabel: 'Student ID',
                                            name: 'STUDIDNO',
											anchor:'90%',  // anchor width by percentage
	 	  	 	 		  					id: 'STUDIDNO'

                                         }
 		        					]
 		        				},
 		        				{
 		        					columnWidth: .534,
 		        					layout: 'form',
 		        					items: [
 		        					
                                       ExtCommon.util.createCombo('COURSE', 'COURIDNO', '96.3%', '<?php echo site_url('filereference/getCourseCombo')?>', 'Course*', false, false)
 		        					]
 		        				},
 		        				
 		        				{
 		        					columnWidth: .266,
 		        					layout: 'form',
 		        					items: [
 		        						ExtCommon.util.createCombo('STUDTYPE', 'STTYIDNO', '93%', '<?php echo site_url('filereference/getCombo/FILESTTY/STTYIDNO/STUDTYPE')?>', 'Type*', false, false)
 		        					]
 		        				}
 		        			
 		        			]
 		        		}
 		        	]
 		        },
 		        new Ext.TabPanel({

		        width:'auto',
		        activeTab: 0,
		        height: 420,
               // autoScroll: true,
                deferredRender: false,
		        //defaults:{autoHeight: true},
		        items:[
			        {
				        title: 'Profile', 
				        height: 'auto',
				        frame: true, 
				        layout: 'form', 
				        autoScroll: true, 
			        	items:[
			        		{
			        			xtype: 'fieldset',
			        			width: 'auto',
			        			height: 'auto',
			        			items: [
			        				{
			        					layout: 'column',
			        					width: 'auto',
			        					items: [
			        						{
			        							columnWidth: .2,
			        							layout: 'form',
			        							items: [
			        								new Ext.BoxComponent({
				          						    width: 130,
				          						    height: 130,
				          						    id: 'emp_photo',
				          						    name: 'emp_photo',
				          						    autoEl: {tag: 'img', src: '/images/icon_pic.jpg'}
				          						}),
				          						{	
				          							xtype: 'button', text: 'Add Picture',
						          					id: "upload_btn",
						          					disabled: true,
						          					style: {marginTop: '16.5px'},
						                                                    icon: '/images/icons/picture_add.png',
						          	 	 			        	handler: function () {
						                                                                    var attform = new Ext.form.FormPanel({
																	id: 'atthform',
																	name: 'atthform',
																	method: 'POST',
																	height: 110,
																	width: 342,
																	labelWidth: 150,
																	frame: true,
																	fileUpload: true,
																	items: [
						
																		{
																			xtype: 'textfield',
																	    	fieldLabel: 'Select file to upload',
																	    	name: 'file',
																	    	id: 'file',
																	    	inputType: 'file',
																	    	disableKeyFilter: true,
						                                                                                                autoCreate: {tag: 'input', type: 'text', size: '200', autocomplete: 'off'}
																		},
						                                                                                                {
						                                                                                                    xtype: 'hidden',
						                                                                                                    name: 'PICSTUDIDNO',
						                                                                                                    id: 'PICSTUDIDNO',
						                                                                                                    value: Ext.getCmp("STUDIDNO").getValue()
						                                                                                                }
																	]
																});
						
																var watth = new Ext.Window({
																	title: "Add Picture",
																	width: 360,
																	height: 120,
																	modal: true,
																	plain: true,
																	buttonAlign: 'right',
																	bodyStyle: 'padding:5px;',
																	resizable: false,
																	layout: 'fit',
																	items: [attform],
																	buttons: [
																		{
																			text: "Upload",
																			icon: '/images/icons/picture_save.png',
																			cls:'x-btn-text-icon',
						
																			handler: function(){
																				if (!attform.form.isValid()){
												        							Ext.Msg.show({
												        								title: "Error!",
												        								msg: "Please fill-in required fields (Marked Red)!",
												        								icon: Ext.Msg.ERROR,
												        								buttons: Ext.Msg.OK
												        							});
												        							return;
												        						}
						
						
						
												        						attform.form.submit({
												        							url: '<?php echo site_url("admin/uploadStudentPhoto/"); ?>',
												        							method: 'POST',
												        							success: function(f,a){
												        								Ext.Msg.show({
												        									title: 'Success',
												        									msg: a.result.data, //"An error has occured while trying to save the record!",
												        									icon: Ext.Msg.INFO,
												        									buttons: Ext.Msg.OK
												        								});
						                                                                 Ext.getCmp('emp_photo').getEl().dom.src = a.result.filename;
																						// Ext.getCmp('ADVIPICTURE').setValue(a.result.filename);
																			            watth.close();
												        							},
												        							failure: function(f,a){
												        								Ext.Msg.show({
												        									title: 'Error Alert',
												        									msg: a.result.data, //"An error has occured while trying to save the record!",
												        									icon: Ext.Msg.ERROR,
												        									buttons: Ext.Msg.OK
												        								})
												        							},
												        							waitMsg: 'Saving data...'
												        						})
																			}
																		},{
																			text: "Cancel",
																			icon: '/images/icons/cancel.png',
						                                                                                                        cls:'x-btn-text-icon',
						
																			handler: function() {
																				watth.close();
																			}
																		}
																	]
																});
																watth.show();
						          	 	  			            
						
						                                                                }
						
						              	 	  	                }
			        							]
			        						},
			        						{
			        							columnWidth: .8,
			        							layout: 'form',
			        							items: [
			        								ExtCommon.util.createCombo('DEPARTMENT', 'DEPTIDNO', '93%', '<?php echo site_url('filereference/getCombo/FILEDEPARTMENT/DEPTIDNO/DEPARTMENT')?>', 'Department*', false, false),
			        								{
			        									layout: 'column',
			        									width: 'auto',
			        									items:[
			        										{
			        											columnWidth: .483,
			        											layout: 'form',
			        											items: [
			        												ExtCommon.util.createCombo('STUDENTLEVEL', 'YEAR', '93%', '<?php echo site_url('filereference/getCombo/FILESTLE/YEAR/DESCRIPTIO/YEAR')?>', 'Year*', false, false)
			        											]
			        										},
			        										{
			        											columnWidth: .482,
			        											layout: 'form',
			        											items: [
			        												ExtCommon.util.createCombo('SECTION', 'SECTIDNO', '93%', '<?php echo site_url('filereference/getSectionCombo')?>', 'Section*', true, false)
			        											]
			        										}
			        									]
			        								},
			        								
			        								{
			        									layout: 'column',
			        									width: 'auto',
			        									items:[
			        										{
			        											columnWidth: .483,
			        											layout: 'form',
			        											items: [
			        												{
			                                                	  xtype:'datefield',
			                                                	  fieldLabel: 'Date of Birth',
			                                                	  name: 'BIRTHDATE',
			                                                	  id:'BIRTHDATE',
			                                                	  format:'Y-m-d',
			                                                	  allowBlank:false,
			                                                	  maxValue: new Date(),
			                                                	 // blankText:'Campo obbligatorio', 
			                                                	  anchor:'93%',
			                                                	  listeners:{change: function() {
			                                                	  var age = Ext.getCmp('AGE'); 
			                                                	  var currentTime = new Date();
			                                                	  var cmonth = currentTime.getMonth();
			                                                	  var cdate = currentTime.getDate(); 
			                                                	  var cyear = currentTime.getFullYear(); 
			                                                	  var parseddate = Date.parseDate(Ext.get('BIRTHDATE').getValue(), 'Y-m-d'); 
			                                                	  var month = parseddate.format('m')-1;
			                                                	  var date = parseddate.format('d');
			                                                	  var year = parseddate.format('Y'); 
			                                                	  var theYear = cyear - year;
			                                                	  var theMonth = cmonth - month;
			                                                	  var theDate = cdate - date;
			
			                                                	  var days = "";
			                                                	  if (cmonth == 0 || cmonth == 2 || cmonth == 4 || cmonth == 6 || cmonth == 7 || cmonth == 9 || cmonth == 11) days = 31;
			                                                	  if (cmonth == 3 || cmonth == 5 || cmonth == 8 || cmonth == 10) days = 30;
			                                                	  if (cmonth == 1) days = 28;
			
			                                                	  if (month < cmonth && date > cdate) { 
			                                                	  theYear = theYear + 1;
			                                                	  } 
			                                                	  else if (month > cmonth && date <= cdate) { 
			                                                	  theYear = theYear - 1;
			                                                	  theMonth = ((12 - -(theMonth)) + 1);
			                                                	  } 
			                                                	  else if (month > cmonth && date > cdate) { 
			                                                	  theMonth = ((12 - -(theMonth)));
			                                                	  }
			                                                	  if (date < cdate) { 
			                                                	  theDate = theDate; 
			                                                	  }
			                                                	  else if (date == cdate) { 
			                                                	  theDate = 0; 
			                                                	  }
			                                                	  else { 
			                                                	  theYear = theYear - 1;
			                                                	  } 
			                                                	  age.setValue(theYear);
			                                                	  },
			                                                	  select: function() {
			                                                    	  var age = Ext.getCmp('AGE'); 
			                                                    	  var currentTime = new Date();
			                                                    	  var cmonth = currentTime.getMonth();
			                                                    	  var cdate = currentTime.getDate(); 
			                                                    	  var cyear = currentTime.getFullYear(); 
			                                                    	  var parseddate = Date.parseDate(Ext.get('BIRTHDATE').getValue(), 'Y-m-d'); 
			                                                    	  var month = parseddate.format('m')-1;
			                                                    	  var date = parseddate.format('d');
			                                                    	  var year = parseddate.format('Y'); 
			                                                    	  var theYear = cyear - year;
			                                                    	  var theMonth = cmonth - month;
			                                                    	  var theDate = cdate - date;
			
			                                                    	  var days = "";
			                                                    	  if (cmonth == 0 || cmonth == 2 || cmonth == 4 || cmonth == 6 || cmonth == 7 || cmonth == 9 || cmonth == 11) days = 31;
			                                                    	  if (cmonth == 3 || cmonth == 5 || cmonth == 8 || cmonth == 10) days = 30;
			                                                    	  if (cmonth == 1) days = 28;
			
			                                                    	  if (month < cmonth && date > cdate) { 
			                                                    	  theYear = theYear + 1;
			                                                    	  } 
			                                                    	  else if (month > cmonth && date <= cdate) { 
			                                                    	  theYear = theYear - 1;
			                                                    	  theMonth = ((12 - -(theMonth)) + 1);
			                                                    	  } 
			                                                    	  else if (month > cmonth && date > cdate) { 
			                                                    	  theMonth = ((12 - -(theMonth)));
			                                                    	  }
			                                                    	  if (date < cdate) { 
			                                                    	  theDate = theDate; 
			                                                    	  }
			                                                    	  else if (date == cdate) { 
			                                                    	  theDate = 0; 
			                                                    	  }
			                                                    	  else { 
			                                                    	  theYear = theYear - 1;
			                                                    	  } 
			                                                    	  age.setValue(theYear);
			                                                    	  }
			                                            	  	  }
			                                                	  }
			        											]
			        										},
			        										{
			        											columnWidth: .482,
			        											layout: 'form',
			        											items: [
			        												{
			        													xtype: 'textfield',
			        													name: 'AGE',
			        													id: 'AGE',
			        													fieldLabel: 'Age',
			        													anchor: '93%',
			        													readOnly: true
			        												}
			        											]
			        										}
			        									]
			        								},
			        								{
			        									xtype: 'textfield',
			        									name: 'BIRTHPLACE',
			        									id: 'BIRTHPLACE',
			        									fieldLabel: 'Birth Place*',
			        									anchor: '93%',
			        								},
			        								{
			        									layout: 'column',
			        									width: 'auto',
			        									items:[
			        										{
			        											columnWidth: .483,
			        											layout: 'form',
			        											items: [
			        												new Ext.form.ComboBox(
					 		 			      				   {
				
					 		 	 			       	   	         store: new Ext.data.SimpleStore(
					 		 	 			       		            {
					 		 	 			       		               fields: ['field', 'value'],
					 		 	 			       		               data : [['001', 'Male'],['002', 'Female']]
					 		 	 			          		         }),
					 		 	 			       	   	         	valueField:'field',
					 		 	 			       		            displayField:'value',
				                                                                                    fieldLabel: 'Gender*',
					 		 	 			          		    name: 'GENDER',
					 		 	 			       		            id: 'GENDER',
				                                                                                    hiddenName:'GENDIDNO',
				                                                                                    hiddenId:'GENDIDNO',
					 		 	 			       		            editable: false,
					 		 	 			       		            mode: 'local',
					 		 	 			       		            anchor: '95%',
					 		 	 			       		            triggerAction: 'all',
					 		 	 			          		    selectOnFocus: true,
				                                                                                    allowBlank: false,
					 		 	 			       		            forceSelection:true,
					 		 	 			       		            tabIndex: 0,
					 		 	 			       		            listeners: {
				                                                                                    select: function(combo, record, index){
				
				                                                                                    }
					 		 	 			       		            }
					 		 	 			          		    })
			        											]
			        										},
			        										{
			        											columnWidth: .482,
			        											layout: 'form',
			        											items: [
			        												ExtCommon.util.createCombo('CITIZENSHIP', 'CITIIDNO', '93%', '<?php echo site_url('filereference/getCitizenshipCombo')?>', 'Citizenship*', false, false)
			        											]
			        										}
			        									]
			        								},
			        								ExtCommon.util.createCombo('RELIGION', 'RELIIDNO', '93%', '<?php echo site_url('filereference/getReligionCombo')?>', 'Religion*', false, false),
			        								{
					                                    xtype: 'textfield',
					                                    id: 'C_ADDR01',
					                                    name: 'C_ADDR01',
					                                    fieldLabel: 'City Address*',
					                                    qtip: 'Number, Street, District',
					                                    anchor: '93%',
					                                    allowBlank: false
					                                },
					                                {
					                                    xtype: 'textfield',
					                                    id: 'C_ADDR02',
					                                    name: 'C_ADDR02',
					                                    fieldLabel: '',
					                                    qtip: 'Barangay, Municipality, City',
					                                    anchor: '93%',
					                                    allowBlank: false
					                                },
					                                {
			        									layout: 'column',
			        									width: 'auto',
			        									items:[
			        										{
			        											columnWidth: .233,
			        											layout: 'form',
			        											items: [
			        												{
									                                    xtype: 'textfield',
									                                    id: 'C_ZIPCODE',
									                                    name: 'C_ZIPCODE',
									                                    fieldLabel: 'Zip Code',
									                                    anchor: '90%',
									                                    allowBlank: false
								                                	}
			        											]
			        										},
			        										{
			        											columnWidth: .25,
			        											layout: 'form',
			        											items: [
			        												{
									                                    xtype: 'textfield',
									                                    id: 'C_PROVINCE',
									                                    name: 'C_PROVINCE',
									                                    fieldLabel: 'Province',
									                                    anchor: '90%',
									                                    allowBlank: false
								                                	}
			        											]
			        										},
			        										{
			        											columnWidth: .482,
			        											layout: 'form',
			        											items: [
			        												ExtCommon.util.createCombo('COUNTRY', 'COUNIDNO', '93%', '<?php echo site_url('filereference/getCountryCombo')?>', 'Country*', false, false)
			        											]
			        										}
			        									]
			        								},
			        								{
					                                    xtype: 'textfield',
					                                    id: 'P_ADDR01',
					                                    name: 'P_ADDR01',
					                                    fieldLabel: 'Provincial Address*',
					                                    qtip: 'Number, Street, District',
					                                    anchor: '93%',
					                                    allowBlank: false
					                                },
					                                {
					                                    xtype: 'textfield',
					                                    id: 'P_ADDR02',
					                                    name: 'P_ADDR02',
					                                    fieldLabel: '',
					                                    qtip: 'Barangay, Municipality, City',
					                                    anchor: '93%',
					                                    allowBlank: false
					                                },
					                                {
			        									layout: 'column',
			        									width: 'auto',
			        									items:[
			        										{
			        											columnWidth: .233,
			        											layout: 'form',
			        											items: [
			        												{
									                                    xtype: 'textfield',
									                                    id: 'P_ZIPCODE',
									                                    name: 'P_ZIPCODE',
									                                    fieldLabel: 'Zip Code',
									                                    anchor: '90%',
									                                    allowBlank: false
								                                	}
			        											]
			        										},
			        										{
			        											columnWidth: .25,
			        											layout: 'form',
			        											items: [
			        												{
									                                    xtype: 'textfield',
									                                    id: 'P_PROVINCE',
									                                    name: 'P_PROVINCE',
									                                    fieldLabel: 'Province',
									                                    anchor: '90%',
									                                    allowBlank: false
								                                	}
			        											]
			        										},
			        										{
			        											columnWidth: .482,
			        											layout: 'form',
			        											items: [
			        												ExtCommon.util.createCombo('P_COUNTRY', 'P_COUNIDNO', '93%', '<?php echo site_url('filereference/getCountryCombo')?>', 'Country*', false, false)
			        											]
			        										}
			        									]
			        								}
			        							]
			        						}
			        					]
			        				}
			        			]
			        		}
			        	]
			        },
			         {
				        title: 'Family/Contact Information', 
				        height: 'auto',
				        frame: true, 
				        layout: 'form', 
				        autoScroll: true, 
			        	items:[
			        		{
			        			layout: 'column',
			        			width: 'auto',
			        			items: [
			        				{
			        					columnWidth: .5,
			        					layout: 'form',
			        					width: 'auto',
			        					items: [
			        						{
			        							xtype: 'fieldset',
			        							width: 'auto',
			        							title: 'Father\'s Information',
			        							labelWidth: 150,
			        							//labelAlign: 'top',
			        							items: [
			        								{
										                xtype: 'textfield',
										                id: 'FATHER',
										                name: 'FATHER',
										                fieldLabel: 'Name*',
										                anchor: '93%',
										                allowBlank: false
			        								},
			        								ExtCommon.util.createCombo('F_OCCUPATION', 'F_OCCUIDNO', '93%', '<?php echo site_url('filereference/getCombo/FILEOCCU/OCCUIDNO/OCCUPATION')?>', 'Occupation*', false, false),
			        								{
										                xtype: 'textfield',
										                id: 'F_COMPANY',
										                name: 'F_COMPANY',
										                fieldLabel: 'Company*',
										                anchor: '93%',
										                allowBlank: false
			        								},
			        								{
										                xtype: 'textfield',
										                id: 'F_EDUCATION',
										                name: 'F_EDUCATION',
										                fieldLabel: 'Educational Attainment*',
										                anchor: '93%',
										                allowBlank: false
			        								},
			        								{
										                xtype: 'textfield',
										                id: 'F_COMPANY_ADDRESS',
										                name: 'F_COMPANY_ADDRESS',
										                fieldLabel: 'Office Address*',
										                anchor: '93%',
										                allowBlank: false
			        								},
			        								{
										                xtype: 'textfield',
										                id: 'F_COMPANY_PHONE',
										                name: 'F_COMPANY_PHONE',
										                fieldLabel: 'Office Phone*',
										                anchor: '93%',
										                allowBlank: false
			        								},
			        								{
										                xtype: 'textfield',
										                id: 'F_MOBILE',
										                name: 'F_MOBILE',
										                fieldLabel: 'Mobile No.*',
										                anchor: '93%',
										                allowBlank: false
			        								},
			        								{
										                xtype: 'textfield',
										                id: 'F_EMAIL',
										                name: 'F_EMAIL',
										                fieldLabel: 'Email*',
										                anchor: '93%',
										                allowBlank: false
			        								},
			        								{
										                xtype: 'textfield',
										                id: 'HOME_ADDRESS',
										                name: 'HOME_ADDRESS',
										                fieldLabel: 'Home Address*',
										                anchor: '93%',
										                allowBlank: false
			        								},
			        								{
										                xtype: 'textfield',
										                id: 'HOME_PHONE',
										                name: 'HOME_PHONE',
										                fieldLabel: 'Home Phone*',
										                anchor: '93%',
										                allowBlank: false
			        								}
			        							]
			        						}
			        							
			        					]
			        				},
			        				{
			        					columnWidth: .49,
			        					layout: 'form',
			        					style: {marginLeft: 10},
			        					width: 'auto',
			        					items: [
			        						{
			        							xtype: 'fieldset',
			        							width: 'auto',
			        							title: 'Mother\'s Information',
			        							labelWidth: 150,
			        							//labelAlign: 'top',
			        							items: [
			        								{
										                xtype: 'textfield',
										                id: 'MOTHER',
										                name: 'MOTHER',
										                fieldLabel: 'Name*',
										                anchor: '93%',
										                allowBlank: false
			        								},
			        								ExtCommon.util.createCombo('M_OCCUPATION', 'M_OCCUIDNO', '93%', '<?php echo site_url('filereference/getCombo/FILEOCCU/OCCUIDNO/OCCUPATION')?>', 'Occupation*', false, false),
			        								{
										                xtype: 'textfield',
										                id: 'M_COMPANY',
										                name: 'M_COMPANY',
										                fieldLabel: 'Company*',
										                anchor: '93%',
										                allowBlank: false
			        								},
			        								{
										                xtype: 'textfield',
										                id: 'M_EDUCATION',
										                name: 'M_EDUCATION',
										                fieldLabel: 'Educational Attainment*',
										                anchor: '93%',
										                allowBlank: false
			        								},
			        								{
										                xtype: 'textfield',
										                id: 'M_COMPANY_ADDRESS',
										                name: 'M_COMPANY_ADDRESS',
										                fieldLabel: 'Office Address*',
										                anchor: '93%',
										                allowBlank: false
			        								},
			        								{
										                xtype: 'textfield',
										                id: 'M_COMPANY_PHONE',
										                name: 'M_COMPANY_PHONE',
										                fieldLabel: 'Office Phone*',
										                anchor: '93%',
										                allowBlank: false
			        								},
			        								{
										                xtype: 'textfield',
										                id: 'M_MOBILE',
										                name: 'M_MOBILE',
										                fieldLabel: 'Mobile No.*',
										                anchor: '93%',
										                allowBlank: false
			        								},
			        								{
										                xtype: 'textfield',
										                id: 'M_EMAIL',
										                name: 'M_EMAIL',
										                fieldLabel: 'Email*',
										                anchor: '93%',
										                allowBlank: false
			        								},
			        								{
										                xtype: 'textarea',
										                id: 'EMERGENCY_CONTACT',
										                name: 'EMERGENCY_CONTACT',
										                fieldLabel: 'Emergency Contact*',
										                anchor: '93%',
										                allowBlank: false,
										                height: 48
			        								}
			        							]
			        						}
			        							
			        					]
			        				}
			        			]
			        		}
			        	]			        
			         },
			         {
				        title: 'Educational Info', 
				        height: 'auto',
				        frame: true, 
				        layout: 'form', 
				        autoScroll: true, 
				        disabled: true,
				        id: 'education_tab',
			        	items:[
			        		studentProfile.app.schoolGrid, studentProfile.app.honorsGrid
			        	]
			         },
			         {
				        title: 'Miscellaneous', 
				        height: 'auto',
				        frame: true, 
				        layout: 'form', 
				        autoScroll: true,
				        labelWidth: 150, 
			        	items:[
			        		{
								xtype: 'textfield',
								id: 'BACKACCO',
								name: 'BACKACCO',
								fieldLabel: 'Back Accounts*',
								anchor: '93%',
								allowBlank: true
								
							},
							{
								xtype: 'textarea',
								id: 'NOTES',
								name: 'NOTES',
								fieldLabel: 'Notes*',
								anchor: '93%',
								allowBlank: true
								
							},
			        		{
								xtype: 'textfield',
								id: 'ENTRYYEAR',
								name: 'ENTRYYEAR',
								fieldLabel: 'Academic Year of Entry*',
								anchor: '93%',
								allowBlank: false
								
							},
							ExtCommon.util.createCombo('SCHOLARSHIP', 'SCHOLARIDNO', '93%', '<?php echo site_url('filereference/getCombo/FILESCHOLAR/SCHOLARIDNO/SCHOLARSHIP')?>', 'Scholarship*', true, false),
							{
								xtype: 'textfield',
								id: 'EMAIL',
								name: 'EMAIL',
								fieldLabel: 'Email',
								anchor: '93%',
								allowBlank: true
								
							},
							{
								xtype: 'textfield',
								id: 'WEBSITE',
								name: 'WEBSITE',
								fieldLabel: 'Website',
								anchor: '93%',
								allowBlank: true
								
							},
							{
								xtype: 'textfield',
								id: 'GUARDIAN',
								name: 'GUARDIAN',
								fieldLabel: 'Guardian (If Any)',
								anchor: '93%',
								allowBlank: true
								
							},
							{
								xtype: 'textfield',
								id: 'G_ADDRESS01',
								name: 'G_ADDRESS01',
								fieldLabel: 'Address',
								anchor: '93%',
								allowBlank: true
								
							},
							{
								xtype: 'textfield',
								id: 'G_ADDRESS02',
								name: 'G_ADDRESS02',
								fieldLabel: '',
								anchor: '93%',
								allowBlank: true
								
							},
							{
								xtype: 'textfield',
								id: 'G_ADDRESS03',
								name: 'G_ADDRESS03',
								fieldLabel: '',
								anchor: '93%',
								allowBlank: true
								
							},
							{
								xtype: 'textfield',
								id: 'G_PHONE',
								name: 'G_PHONE',
								fieldLabel: 'Contact No.',
								anchor: '93%',
								allowBlank: true
								
							}
							]
							},
							{
				        title: 'Requirements', 
				        height: 'auto',
				        frame: true, 
				        layout: 'form', 
				        autoScroll: true, 
			        	items:[
			        	{
			        		xtype: 'fieldset',
			        		height: 'auto',
			        		items: [
			        	
			        		{
			        			layout: 'column',
			        			width: 'auto',
			        			items: [
			        				{
			        					columnWidth: .5,
			        					width: 'auto',
			        					layout: 'form',
			        					items: [
			        						
			        							{
			        								xtype: 'fieldset',
			        								width: 'auto',
			        								title: 'Medical Information',
			        								items: [
			        									{
			        										xtype: 'checkbox',
			        										boxLabel: 'Passed Medical Examination',
			        										name: 'MEDICAL',
			        										id: 'MEDICAL',
			        										inputValue: 1
			        									}
			        								]
			        							},
			        							{
			        								xtype: 'fieldset',
			        								width: 'auto',
			        								title: 'Documents/Requirements',
			        								items: [
			        									{
			        										xtype: 'checkbox',
			        										boxLabel: 'High School Card',
			        										name: 'CARD',
			        										id: 'CARD',
			        										inputValue: 1
			        									},
			        									{
			        										xtype: 'checkbox',
			        										boxLabel: 'Certificate of Good Moral Character',
			        										name: 'GOODMORAL',
			        										id: 'GOODMORAL',
			        										inputValue: 1
			        									},
			        									{
			        										xtype: 'checkbox',
			        										boxLabel: '2x2 Picture (Blue Background)',
			        										name: 'PIC',
			        										id: 'PIC',
			        										inputValue: 1
			        									},
			        									{
			        										xtype: 'checkbox',
			        										boxLabel: 'Birth Certificate',
			        										name: 'BIRTHCERT',
			        										id: 'BIRTHCERT',
			        										inputValue: 1
			        									},
			        									{
			        										xtype: 'checkbox',
			        										boxLabel: 'Transcript of Record (For Transferees)',
			        										name: 'TOR',
			        										id: 'TOR',
			        										inputValue: 1
			        									},
			        									{
			        										xtype: 'checkbox',
			        										boxLabel: 'Honorable Dismissal (For Transferees)',
			        										name: 'HONODISM',
			        										id: 'HONODISM',
			        										inputValue: 1
			        									}
			        								]
			        							},
			        							{
			        								xtype: 'fieldset',
			        								width: 'auto',
			        								title: 'Entrance/Diagnostics',
			        								items: [
			        									{
			        										xtype: 'checkbox',
			        										boxLabel: 'Entrance Test',
			        										name: 'ENTREXAM',
			        										id: 'ENTREXAM',
			        										inputValue: 1
			        									},
			        									{
			        										xtype: 'checkbox',
			        										boxLabel: 'English Test',
			        										name: 'ENGLEXAM',
			        										id: 'ENGLEXAM',
			        										inputValue: 1
			        									}
			        								]
			        							}
			        						
			        					]
			        				},
			        				{
			        					columnWidth: .5,
			        					width: 'auto',
			        					layout: 'form',
			        					defaults: {readOnly: true},
			        					items: [
			        						{
												xtype: 'textarea',
												id: 'MEDICAL_NOTES',
												name: 'MEDICAL_NOTES',
												style: {marginTop: 5.5},
												fieldLabel: '',
												anchor: '93%',
												allowBlank: true,
												height: 53
												
											},
											{
												xtype: 'textarea',
												id: 'DOCUMENT_NOTES',
												name: 'DOCUMENT_NOTES',
												fieldLabel: '',
												style: {marginTop: 12},
												anchor: '93%',
												allowBlank: true,
												height: 163
												
											},
											{
												xtype: 'textarea',
												id: 'EXAM_NOTES',
												name: 'EXAM_NOTES',
												fieldLabel: '',
												style: {marginTop: 12},
												anchor: '93%',
												allowBlank: true,
												height: 70
												
											}
			        					]
			        				}
			        			]
			        		}
			        		]
			        		}
			        	]
			        	
			        	}
			        	
			         
		        ]
		        
		        })
 		        ]
 		    });

 		    studentProfile.app.Form = form;
 		},
 		Add: function(){

 			studentProfile.app.setForm();

 		  	var _window;
 		  	
 		  	studentProfile.app.edit = false;

 		    _window = new Ext.Window({
 		        title: 'New Student',
 		        width: 1000,
 		        height:600,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: studentProfile.app.Form,
 		        buttons: [{
 		         	text: 'Save',
                                 icon: '/images/icons/disk.png',
 	                handler: function () {
 			            if(ExtCommon.util.validateFormFields(studentProfile.app.Form)){//check if all forms are filled up

 		                studentProfile.app.Form.getForm().submit({
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: Ext.Msg.INFO
  								 });
 				                ExtCommon.util.refreshGrid(studentProfile.app.Grid.getId());
 				                _window.destroy();
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
                             icon: '/images/icons/cancel.png',
 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });
 		    
 		    studentProfile.app.Form.form.load({
							url:"<?php echo site_url("student/loadStudentId"); ?>",
							waitMsg:'Loading...',
                                                        params:{id: id},
							success: function(f, action){
                                                           // alert(action.result.data.firstName);
                                                           
                                                            _window.show();
                                                          
                                                           
							}

						});
 		  	//_window.show();
 		},
 		Edit: function(){


 			if(ExtCommon.util.validateSelectionGrid(studentProfile.app.Grid.getId())){//check if user has selected an item in the grid
 			var sm = studentProfile.app.Grid.getSelectionModel();
 			var id = sm.getSelected().data.STUDIDNO;
 			
 			studentProfile.app.edit = true;

 			studentProfile.app.setForm();
 		    _window = new Ext.Window({
 		        title: 'Update Student',
 		        width: 1000,
 		        height:600,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: studentProfile.app.Form,
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',
 		            handler: function () {
 			            if(ExtCommon.util.validateFormFields(studentProfile.app.Form)){//check if all forms are filled up
 		                studentProfile.app.Form.getForm().submit({
 			                url: "<?php echo site_url("student/updateStudent"); ?>",
 			                params: {id: id},
 			                method: 'POST',
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
 				                ExtCommon.util.refreshGrid(studentProfile.app.Grid.getId());
 				                _window.destroy();
 			                },
 			                failure: function(f,a){
 								Ext.Msg.show({
 									title: 'Error Alert',
 									msg: a.result.data,
 									icon: Ext.Msg.ERROR,
 									buttons: Ext.Msg.OK
 								});
 			                },
 			                waitMsg: 'Updating Data...'
 		                });
 	                }else return;
 		            }
 		        },{
 		            text: 'Cancel',
                            icon: '/images/icons/cancel.png',
 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });

                    studentProfile.app.Form.form.load({
							url:"<?php echo site_url("student/loadStudent"); ?>",
							waitMsg:'Loading...',
                                                        params:{id: id},
							success: function(f, action){
                                                           // alert(action.result.data.firstName);
                                                           
                                                            _window.show();
                                                            
                                                            Ext.get("COURIDNO").dom.value = action.result.data.COURIDNO;
                                                            Ext.get("RELIIDNO").dom.value = action.result.data.RELIIDNO;
                                                            Ext.get("CITIIDNO").dom.value = action.result.data.CITIIDNO;
                                                            Ext.get("DEPTIDNO").dom.value = action.result.data.DEPTIDNO;
                                                            Ext.get("STTYIDNO").dom.value = action.result.data.STTYIDNO;
                                                            Ext.get("COUNIDNO").dom.value = action.result.data.COUNIDNO;
                                                            Ext.get("P_COUNIDNO").dom.value = action.result.data.P_COUNIDNO;
                                                            Ext.get("F_OCCUIDNO").dom.value = action.result.data.F_OCCUIDNO;
                                                            Ext.get("M_OCCUIDNO").dom.value = action.result.data.M_OCCUIDNO;
                                                            Ext.get("SCHOLARIDNO").dom.value = action.result.data.SCHOLARIDNO;
                                                            Ext.get("YEAR").dom.value = action.result.data.STLE;
                                                            Ext.getCmp("STUDIDNO").setReadOnly(true);
                                                            Ext.getCmp("IDNO").setReadOnly(true);
                                                            Ext.getCmp("education_tab").enable();
                                                              Ext.getCmp('upload_btn').enable();
                                                            Ext.getCmp('emp_photo').getEl().dom.src = action.result.data.filename;
                                                            studentProfile.app.schoolGrid.getStore().setBaseParam("STUDIDNO", Ext.getCmp("STUDIDNO").getValue());
                                                            studentProfile.app.honorsGrid.getStore().setBaseParam("STUDIDNO", Ext.getCmp("STUDIDNO").getValue());
                                                            studentProfile.app.schoolGrid.getStore().load();
                                                            studentProfile.app.honorsGrid.getStore().load();
                                                            
							}

						});

 			}else return;
 		},
                View: function(){


 			if(ExtCommon.util.validateSelectionGrid(studentProfile.app.Grid.getId())){//check if user has selected an item in the grid
 			var sm = studentProfile.app.Grid.getSelectionModel();
 			var id = sm.getSelected().data.STUDIDNO;

 			var form = new Ext.form.FormPanel({
 		        labelWidth: 100,
 		        url:"<?php echo site_url("student/insertStudentInfo"); ?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,

 		        items: [ {
 					xtype:'fieldset',
 					title:'Student Information',
                                        
 					width:'auto',
 					height:'auto',
 					items:[
                                            {xtype: 'fieldset',
                                                
                                            

                                            items: [
                                            {

                                                  xtype:'textfield',
                                                  fieldLabel: 'Student ID*',
                                                  name: 'STUDIDNO',

                                                  anchor:'25%',  // anchor width by percentage
	 	  	 	 		  id: 'STUDIDNO',
                                                  //minLength: 10,
                                                  //maxLength: 10,
                                                  readOnly: true

                                                  },
                                            {
			            layout:'column',
			            width: 'auto',
                                    style: {paddingBottom: '7px'},
			            items: [
                                        {
	 	 			          columnWidth:.5,
	 	 			          layout: 'form',
	 	 			          items: [{

                                                  xtype:'textfield',
                                                  fieldLabel: 'First Name*',
                                                  name: 'FIRSTNAME',
	 	  	 	 		  allowBlank:false,
                                                  anchor:'95%',  // anchor width by percentage
	 	  	 	 		  id: 'FIRSTNAME',
                                                  readOnly: true

                                                  },
                                                  {
	 	  	 	 			 					xtype:'textfield',
	 	  	 	 			 		            fieldLabel: 'Last Name*',
	 	  	 	 			 		            name: 'LASTNAME',
	 	  	 	 			 		            allowBlank:false,
	 	  	 	 			 		            anchor:'95%',  // anchor width by percentage
	 	  	 	 			 		            id: 'LASTNAME',
                                                  readOnly: true
	 	  	 	 		},
                                                {xtype: 'datefield',
		 	 			        fieldLabel: 'Date of Birth*',
		 	 			        name: 'BIRTHDATE',
		 	 			        id: 'BIRTHDATE',
		 	 			        allowBlank: false,
		 	 			        format: 'Y-m-d',
		 	 			        anchor: '95%',
                                                        maxValue: new Date(),
                                                        readOnly: true

		 	 			      },
                                                      studentProfile.app.citiCombo()
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.5,
	 	 			          layout: 'form',
	 	 			          items: [{
	 	  	 	 			 					xtype:'textfield',
	 	  	 	 			 		            fieldLabel: 'Middle Name*',
	 	  	 	 			 		            name: 'MIDDLENAME',
	 	  	 	 			 		            allowBlank:false,
	 	  	 	 			 		            anchor:'95%',  // anchor width by percentage
	 	  	 	 			 		            id: 'MIDDLENAME',
                                                  readOnly: true
	 	  	 	 			 		        },
                                                                                new Ext.form.ComboBox(
	 		 			      				   {

	 		 	 			       	   	         store: new Ext.data.SimpleStore(
	 		 	 			       		            {
      		               fields: ['field', 'value'],
	 		 	 			       		               data : [['001', 'Male'],['002', 'Female']]
	 		 	 			          		         }),
	 		 	 			       	   	         	valueField:'field',
	 		 	 			       		            displayField:'value',
                                                                                    fieldLabel: 'Gender*',
	 		 	 			          		    name: 'GENDER',
	 		 	 			       		            id: 'GENDER',
                                                                                    hiddenName:'GENDIDNO',
                                                                                    hiddenId:'GENDIDNO',
	 		 	 			       		            editable: false,
	 		 	 			       		            mode: 'local',
	 		 	 			       		            anchor: '95%',
	 		 	 			       		            triggerAction: 'all',
	 		 	 			          		    selectOnFocus: true,
                                                                                    allowBlank: false,
	 		 	 			       		            forceSelection:true,
	 		 	 			       		            tabIndex: 0,
	 		 	 			       		            listeners: {
                                                                                    select: function(combo, record, index){

                                                                                    }
	 		 	 			       		            },
                                                  readOnly: true
	 		 	 			          		    }),
                                                                                    {
	 	  	 	 			 					xtype:'textfield',
	 	  	 	 			 		            fieldLabel: 'Place of Birth*',
	 	  	 	 			 		            name: 'BIRTHPLACE',
	 	  	 	 			 		            allowBlank:false,
	 	  	 	 			 		            anchor:'95%',  // anchor width by percentage
	 	  	 	 			 		            id: 'BIRTHPLACE',
                                                  readOnly: true
	 	  	 	 			 		        },
                                                                                studentProfile.app.reliCombo()

                                              ]
                                              }
                                    ]
                                }]
                        },
                                {xtype: 'fieldset',
                                title: 'Current Address',
                                labelWidth: 50,
                                items:[
                                {
                                    xtype: 'textfield',
                                    id: 'C_ADDR01',
                                    name: 'C_ADDR01',
                                    fieldLabel: 'Line 1*',
                                  //  emptyText: 'Number, Street',
                                    anchor: '97.5%',
                                                  readOnly: true
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'C_ADDR02',
                                    name: 'C_ADDR02',
                                    fieldLabel: 'Line 2*',
                                   // emptyText: 'Municipality, City',
                                    anchor: '97.5%',
                                                  readOnly: true
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'C_ADDR03',
                                    name: 'C_ADDR03',
                                    fieldLabel: 'Line 3*',
                                    //emptyText: 'Province, Country, Zip Code',
                                    anchor: '97.5%',
                                                  readOnly: true
                                }
                                ]
                                },
                                {xtype: 'fieldset',
                                title: 'Provincial Address',
                                labelWidth: 50,
                                items:[
                                {
                                xtype: 'checkbox',
                                boxLabel: 'Same as current address',
                                id: 'SAME',
                                name: 'SAME',
                                listeners: {
                                    check: function(cb, val){
                                        if(val == false){
                                            Ext.getCmp("P_ADDR01").setValue("").setReadOnly(false);
                                            Ext.getCmp("P_ADDR02").setValue("").setReadOnly(false);
                                            Ext.getCmp("P_ADDR03").setValue("").setReadOnly(false);
                                        }else{
                                        if(val == true){
                                            Ext.getCmp("P_ADDR01").setValue(Ext.getCmp("C_ADDR01").getValue()).setReadOnly(true);
                                            Ext.getCmp("P_ADDR02").setValue(Ext.getCmp("C_ADDR02").getValue()).setReadOnly(true);
                                            Ext.getCmp("P_ADDR03").setValue(Ext.getCmp("C_ADDR03").getValue()).setReadOnly(true);
                                        }
                                        }
                                    }
                                }
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'P_ADDR01',
                                    name: 'P_ADDR01',
                                    fieldLabel: 'Line 1*',
                                  //  emptyText: 'Number, Street',
                                    anchor: '97.5%',
                                                  readOnly: true
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'P_ADDR02',
                                    name: 'P_ADDR02',
                                    fieldLabel: 'Line 2*',
                                   // emptyText: 'Municipality, City',
                                    anchor: '97.5%',
                                                  readOnly: true
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'P_ADDR03',
                                    name: 'P_ADDR03',
                                    fieldLabel: 'Line 3*',
                                  //  emptyText: 'Province, Country, Zip Code',
                                    anchor: '97.5%',
                                                  readOnly: true
                                }
                                ]
                                },
                                {
                 					xtype:'fieldset',
                 					//title:'Upload Picture',
                 					width:'auto',
                 					height:'auto',

                 					labelWidth: 89,
                 					items:[

{
    layout:'column',
    width: 'auto',
    items: [
                    {
	          columnWidth:.5,
	          layout: 'form',
	          items: [
                  studentProfile.app.yearCombo(),
                  studentProfile.app.courseCombo(),
                                {
                                    xtype: 'textfield',
                                    id: 'WEBSITE',
                                    name: 'WEBSITE',
                                    fieldLabel: 'Website*',

                                    anchor: '95%',
                                                  readOnly: true
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'EMAIL',
                                    name: 'EMAIL',
                                    fieldLabel: 'Email*',
                                    vtype: 'email',
                                    anchor: '95%',
                                                  readOnly: true
                                }
                      //studentProfile.app.schoolYearCombo(),
                      //  studentProfile.app.semesterCombo(),
                      //  studentProfile.app.courseCombo(),
                      //  studentProfile.app.sectionCombo(),

                            ]},
	 		        {
		 		  columnWidth:.5,
		          layout: 'form',
		          items: [{
          			            layout:'column',
          			            width: 'auto',
          			            items: [
                                                  {
          	 	 			          columnWidth:.33,
          	 	 			          layout: 'form',
          	 	 			          items: [
                                                      new Ext.BoxComponent({

          						    width: 130,
                                                              //anchor: '95%',

          						    height: 130,

          						    id: 'emp_photo',

          						    name: 'emp_photo',

          						    autoEl: {tag: 'img', src: '/images/icon_pic.jpg'}

          						})]}, {
          	 	 			          columnWidth:.6,
          	 	 			          layout: 'form',
          	 	 			          items: []



                  	 	 			          }

                                              ]
                                                      }
                                                            ]
                                                            }
              ]
}

                                                            ]
                                                            }


 		        ]
 					}
 		        ]
 		    });

 		    _window = new Ext.Window({
 		        title: 'Update Student',
 		        width: 1000,
 		        height:720,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: form,
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',
 		            handler: function () {
 			            if(ExtCommon.util.validateFormFields(form)){//check if all forms are filled up
 		                form.getForm().submit({
 			                url: "<?php echo site_url("student/updateStudent"); ?>",
 			                params: {id: id},
 			                method: 'POST',
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
 				                ExtCommon.util.refreshGrid(studentProfile.app.Grid.getId());
 				                _window.destroy();
 			                },
 			                failure: function(f,a){
 								Ext.Msg.show({
 									title: 'Error Alert',
 									msg: a.result.data,
 									icon: Ext.Msg.ERROR,
 									buttons: Ext.Msg.OK
 								});
 			                },
 			                waitMsg: 'Updating Data...'
 		                });
 	                }else return;
 		            }
 		        },{
 		            text: 'Cancel',
                            icon: '/images/icons/cancel.png',
 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });

                    form.form.load({
							url:"<?php echo site_url("student/loadStudent"); ?>",
							waitMsg:'Loading...',
                                                        params:{id: id},
							success: function(f, action){
                                                           // alert(action.result.data.firstName);

                                                            _window.show();
                                                            Ext.get("COURIDNO").dom.value = action.result.data.COURIDNO;
                                                            Ext.get("RELIIDNO").dom.value = action.result.data.RELIIDNO;
                                                            Ext.get("CITIIDNO").dom.value = action.result.data.CITIIDNO;
                                                            
                                                            Ext.getCmp('emp_photo').getEl().dom.src = action.result.data.filename;
							}

						});

                                                Ext.getCmp("COURSE").setReadOnly(true);
                                                            Ext.getCmp("yearlevel").setReadOnly(true);
                                                            Ext.getCmp("RELIGION").setReadOnly(true);
                                                            Ext.getCmp("CITIZENSHIP").setReadOnly(true);

 		  	
 			}else return;
 		},
		Delete: function(){


			if(ExtCommon.util.validateSelectionGrid(studentProfile.app.Grid.getId())){//check if user has selected an item in the grid
			var sm = studentProfile.app.Grid.getSelectionModel();
			var id = sm.getSelected().data.id;
			Ext.Msg.show({
   			title:'Delete',
  			msg: 'Are you sure you want to delete this record?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
							url: "<?php echo site_url("student/deleteStudent"); ?>",
							params:{ id: id},
							method: "POST",
							timeout:300000000,
			                success: function(responseObj){
                		    	var response = Ext.decode(responseObj.responseText);
						if(response.success == true)
						{
							Ext.Msg.show({
								title: 'Status',
								msg: "Record deleted successfully",
								icon: Ext.Msg.INFO,
								buttons: Ext.Msg.OK
							});
							studentProfile.app.Grid.getStore().load({params:{start:0, limit: 25}});

							return;

						}
						else if(response.success == false)
						{
							Ext.Msg.show({
								title: 'Error!',
								msg: "There was an error encountered in deleting the record. Please try again",
								icon: Ext.Msg.ERROR,
								buttons: Ext.Msg.OK
							});

							return;
						}
							},
			                failure: function(f,a){
								Ext.Msg.show({
									title: 'Error Alert',
									msg: "There was an error encountered in deleting the record. Please try again",
									icon: Ext.Msg.ERROR,
									buttons: Ext.Msg.OK
								});
			                },
			                waitMsg: 'Deleting Data...'
						});
   			}
   			},

   			icon: Ext.MessageBox.QUESTION
			});

	                }else return;


		},
                schoolYearCombo: function(){

		return {
			xtype:'combo',
			id:'schoolYear',
			hiddenName: 'schoolYearId',
			name: 'schoolYearName',
			valueField: 'id',
			displayField: 'name',
			//width: 100,
			anchor: '95%',
			triggerAction: 'all',
			minChars: 2,
			forceSelection: true,
			enableKeyEvents: true,
			pageSize: 10,
			resizable: true,
			readOnly: false,
			minListWidth: 300,
			allowBlank: false,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id', type:'int', mapping:'id'}, {name: 'name', type:'string', mapping: 'name'}, {name: 'fax', type:'string', mapping: 'fax'}],
			url: "<?php echo site_url("student/getSchoolYear"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
			beforequery: function(qe){
				delete qe.combo.lastQuery;
			},
			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.getCmp(this.id).setValue(record.get('name'));

			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a school year'});

			},
			keypress: {buffer: 100, fn: function() {
			//Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'School Year*'

			}
	},
        semesterCombo: function(){

		return {
			xtype:'combo',
			id:'semester',
			hiddenName: 'semesterId',
			name: 'semesterName',
			valueField: 'id',
			displayField: 'name',
			//width: 100,
			anchor: '95%',
			triggerAction: 'all',
			minChars: 2,
			forceSelection: true,
			enableKeyEvents: true,
			pageSize: 10,
			resizable: true,
			readOnly: false,
			minListWidth: 300,
			allowBlank: false,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id', type:'int', mapping:'id'}, {name: 'name', type:'string', mapping: 'name'}, {name: 'fax', type:'string', mapping: 'fax'}],
			url: "<?php echo site_url("student/getSemester"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
			beforequery: function(qe){
				delete qe.combo.lastQuery;
			},
			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.getCmp(this.id).setValue(record.get('name'));

			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a semester'});

			},
			keypress: {buffer: 100, fn: function() {
			//Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Semester*'

			}
	},
        courseCombo: function(){

		return {
			xtype:'combo',
			id:'COURSE',
			hiddenName: 'COURIDNO',
                        hiddenId: 'COURIDNO',
			name: 'COURSE',
			valueField: 'id',
			displayField: 'name',
			//width: 100,
			anchor: '95%',
			triggerAction: 'all',
			minChars: 2,
			forceSelection: true,
			enableKeyEvents: true,
			pageSize: 10,
			resizable: true,
			readOnly: false,
			minListWidth: 300,
			allowBlank: false,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id'}, {name: 'name'}],
			url: "<?php echo site_url("filereference/getCourseCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
			beforequery: function(qe){
				delete qe.combo.lastQuery;
			},
			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');

			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a course'});

			},
			keypress: {buffer: 100, fn: function() {
			Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Course*'

			}
	},
        sectionCombo: function(){

		return {
			xtype:'combo',
			id:'section',
			hiddenName: 'sectionId',
			name: 'sectionName',
			valueField: 'id',
			displayField: 'name',
			//width: 100,
			anchor: '95%',
			triggerAction: 'all',
			minChars: 2,
			forceSelection: true,
			enableKeyEvents: true,
			pageSize: 10,
			resizable: true,
			readOnly: false,
			minListWidth: 300,
			allowBlank: false,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id', type:'int', mapping:'id'}, {name: 'name', type:'string', mapping: 'name'}, {name: 'fax', type:'string', mapping: 'fax'}],
			url: "<?php echo site_url("student/getSection"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
			beforequery: function(qe){
				delete qe.combo.lastQuery;
				},	
			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.getCmp(this.id).setValue(record.get('name'));

			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a section'});

			},
			keypress: {buffer: 100, fn: function() {
			//Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Section*'

			}
	},
        citiCombo: function(){

 			return {
 				xtype:'combo',
 				id:'CITIZENSHIP',
 				hiddenName: 'CITIIDNO',
                                hiddenId: 'CITIIDNO',
 				name: 'CITIZENSHIP',
 				valueField: 'id',
 				displayField: 'name',
 				//width: 100,
 				anchor: '95%',
 				triggerAction: 'all',
 				minChars: 2,
 				forceSelection: true,
 				enableKeyEvents: true,
 				pageSize: 10,
 				resizable: true,
 				//readOnly: true,
 				minListWidth: 300,
 				allowBlank: false,
 				store: new Ext.data.JsonStore({
 				id: 'idsocombo',
 				root: 'data',
 				totalProperty: 'totalCount',
 				fields:[{name: 'id'}, {name: 'name', type:'string', mapping: 'name'}, {name: 'firstname'}, {name: 'middlename'}, {name: 'lastname'}, {name: 'cellphone'}, {name: 'homephone'}, {name: 'memberId'}],
 				url: "<?=site_url("student/getCitizenshipCombo")?>",
 				baseParams: {start: 0, limit: 10}

 				}),
 				listeners: {
 				beforequery: function(qe){
				delete qe.combo.lastQuery;
				},
 				select: function (combo, record, index){
 				this.setRawValue(record.get('name'));
 				Ext.get(this.hiddenName).dom.value  = record.get('id');




 				},
 				blur: function(){
 				var val = this.getRawValue();
 				this.setRawValue.defer(1, this, [val]);
 				this.validate();
 				},
 				render: function() {
 				this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a citizenship'});

 				},
 				keypress: {buffer: 100, fn: function() {
 				Ext.get(this.hiddenName).dom.value  = '';
 				if(!this.getRawValue()){
 				this.doQuery('', true);
 				}
 				}}
 				},
 				fieldLabel: 'Citizenship*'

 				}
 	},
        reliCombo: function(){

 			return {
 				xtype:'combo',
 				id:'RELIGION',
 				hiddenName: 'RELIIDNO',
                                hiddenId: 'RELIIDNO',
 				name: 'RELIGION',
 				valueField: 'id',
 				displayField: 'name',
 				//width: 100,
 				anchor: '95%',
 				triggerAction: 'all',
 				minChars: 2,
 				forceSelection: true,
 				enableKeyEvents: true,
 				pageSize: 10,
 				resizable: true,
 				//readOnly: true,
 				minListWidth: 300,
 				allowBlank: false,
 				store: new Ext.data.JsonStore({
 				id: 'idsocombo',
 				root: 'data',
 				totalProperty: 'totalCount',
 				fields:[{name: 'id'}, {name: 'name', type:'string', mapping: 'name'}, {name: 'firstname'}, {name: 'middlename'}, {name: 'lastname'}, {name: 'cellphone'}, {name: 'homephone'}, {name: 'memberId'}],
 				url: "<?=site_url("student/getReligionCombo")?>",
 				baseParams: {start: 0, limit: 10}

 				}),
 				listeners: {
 				beforequery: function(qe){
				delete qe.combo.lastQuery;
				},
 				select: function (combo, record, index){
 				this.setRawValue(record.get('name'));
 				Ext.get(this.hiddenName).dom.value  = record.get('id');




 				},
 				blur: function(){
 				var val = this.getRawValue();
 				this.setRawValue.defer(1, this, [val]);
 				this.validate();
 				},
 				render: function() {
 				this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a religion'});

 				},
 				keypress: {buffer: 100, fn: function() {
 				Ext.get(this.hiddenName).dom.value  = '';
 				if(!this.getRawValue()){
 				this.doQuery('', true);
 				}
 				}}
 				},
 				fieldLabel: 'Religion*'

 				}
 	},
        yearCombo: function(){

		return {
			xtype:'combo',
			id:'yearlevel',
			hiddenName: 'YEAR',
                        hiddenId: 'YEAR',
			name: 'yearlevel',
			valueField: 'id',
			displayField: 'name',
			//width: 100,
			anchor: '95%',
			triggerAction: 'all',
			minChars: 2,
			forceSelection: true,
			enableKeyEvents: true,
			pageSize: 10,
			resizable: true,
			readOnly: false,
			minListWidth: 300,
			allowBlank: false,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id'}, {name: 'name'}],
			url: "<?php echo site_url("filereference/getStudentLevelCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
			beforequery: function(qe){
				delete qe.combo.lastQuery;
			},	
			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
                        this.setValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('name');

			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a level'});

			},
			keypress: {buffer: 100, fn: function() {
			Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Year Level*'

			}
	},
	AddSchool: function(){

		
								
 			var form = new Ext.form.FormPanel({
 		        labelWidth: 150,
 		        url:"<?=site_url("student/addStudentSchool")?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,

 		        items: [ {
 					xtype:'fieldset',
 					title:'Fields w/ Asterisks are required.',
 					width:'auto',
 					height:'auto',
 					items:[
 					ExtCommon.util.createCombo('SCHOOL', 'SCHOIDNO', '93%', '<?php echo site_url('filereference/getCombo/FILESCHO/SCHOIDNO/SCHOOL')?>', 'School*', false, false),
 					{
										                xtype: 'textfield',
										                id: 'LEVEL',
										                name: 'LEVEL',
										                fieldLabel: 'Year Level*',
										                anchor: '93%',
										                allowBlank: false
			       },
			       {
										                xtype: 'textfield',
										                id: 'SCHOOL_YEAR',
										                name: 'SCHOOL_YEAR',
										                fieldLabel: 'School Year*',
										                anchor: '93%',
										                allowBlank: false
			        }
 		        ]
 					}
 		        ]
 		    });

 		  	var subject_window;

 		    subject_window = new Ext.Window({
 		        title: 'Add Subject',
 		        width: 510,
 		        height:220,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: form,
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',

 	                handler: function () {
 			            if(ExtCommon.util.validateFormFields(form)){//check if all forms are filled up

 		                form.getForm().submit({
 		                	params: {STUDIDNO: Ext.getCmp("STUDIDNO").getValue()},
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: 'icon'
  								 });
  								
  								studentProfile.app.schoolGrid.getStore().setBaseParam("STUDIDNO", Ext.getCmp("STUDIDNO").getValue()); 
 				                ExtCommon.util.refreshGrid(studentProfile.app.schoolGrid.getId());
 				                subject_window.destroy();
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
                            icon: '/images/icons/cancel.png', cls:'x-btn-text-icon',

 		            handler: function(){
 			            subject_window.destroy();
 		            }
 		        }]
 		    });
 		   
							subject_window.show();
						
 		  	
 		},
 		AddHonors: function(){

		
								
 			var form = new Ext.form.FormPanel({
 		        labelWidth: 150,
 		        url:"<?=site_url("student/addStudentHonors")?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,

 		        items: [ {
 					xtype:'fieldset',
 					title:'Fields w/ Asterisks are required.',
 					width:'auto',
 					height:'auto',
 					items:[
 					{
										                xtype: 'textfield',
										                id: 'HONORS',
										                name: 'HONORS',
										                fieldLabel: 'Honors*',
										                anchor: '93%',
										                allowBlank: false
			       },
			       {
										                xtype: 'textarea',
										                id: 'DESCRIPTION',
										                name: 'DESCRIPTION',
										                fieldLabel: 'Description*',
										                anchor: '93%',
										                allowBlank: false
			       },
			       {
										                xtype: 'textfield',
										                id: 'HONOR_YEAR',
										                name: 'HONOR_YEAR',
										                fieldLabel: 'Year*',
										                anchor: '93%',
										                allowBlank: false
			        }
 		        ]
 					}
 		        ]
 		    });

 		  	var subject_window;

 		    subject_window = new Ext.Window({
 		        title: 'Add Honors',
 		        width: 510,
 		        height:250,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: form,
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',

 	                handler: function () {
 			            if(ExtCommon.util.validateFormFields(form)){//check if all forms are filled up

 		                form.getForm().submit({
 		                	params: {STUDIDNO: Ext.getCmp("STUDIDNO").getValue()},
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: 'icon'
  								 });
  					
  								//studentProfile.app.honorsGrid.getStore().setBaseParam("ACCESSNO", Ext.getCmp("ACCESSNO").getValue()); 
 				                ExtCommon.util.refreshGrid(studentProfile.app.honorsGrid.getId());
 				                subject_window.destroy();
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
                            icon: '/images/icons/cancel.png', cls:'x-btn-text-icon',

 		            handler: function(){
 			            subject_window.destroy();
 		            }
 		        }]
 		    });
 		   
							subject_window.show();
						
 		  	
 		},
 		DeleteSchool: function(){


			if(ExtCommon.util.validateSelectionGrid(studentProfile.app.schoolGrid.getId())){//check if user has selected an item in the grid
			var sm = studentProfile.app.schoolGrid.getSelectionModel();
			var id = sm.getSelected().data.SCHOIDNO;
			Ext.Msg.show({
   			title:'Delete',
  			msg: 'Are you sure you want to delete this record?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
                            url: "<?=  site_url("student/deleteSchoolHistory")?>",
							params:{ id: id, STUDIDNO: Ext.getCmp('STUDIDNO').getValue()},
							method: "POST",
							timeout:300000000,
			                success: function(responseObj){
                		    	var response = Ext.decode(responseObj.responseText);
						if(response.success == true)
						{
							Ext.Msg.show({
								title: 'Status',
								msg: "Record deleted successfully",
								icon: Ext.Msg.INFO,
								buttons: Ext.Msg.OK
							});
							studentProfile.app.schoolGrid.getStore().load();

							return;

						}
						else if(response.success == false)
						{
							Ext.Msg.show({
								title: 'Error!',
								msg: "There was an error encountered in deleting the record. Please try again",
								icon: Ext.Msg.ERROR,
								buttons: Ext.Msg.OK
							});

							return;
						}
							},
			                failure: function(f,a){
								Ext.Msg.show({
									title: 'Error Alert',
									msg: "There was an error encountered in deleting the record. Please try again",
									icon: Ext.Msg.ERROR,
									buttons: Ext.Msg.OK
								});
			                },
			                waitMsg: 'Deleting Data...'
						});
   			}
   			},

   			icon: Ext.MessageBox.QUESTION
			});

	                }else return;


		},
 		DeleteHonors: function(){


			if(ExtCommon.util.validateSelectionGrid(studentProfile.app.honorsGrid.getId())){//check if user has selected an item in the grid
			var sm = studentProfile.app.honorsGrid.getSelectionModel();
			var id = sm.getSelected().data.HONOCODE;
			Ext.Msg.show({
   			title:'Delete',
  			msg: 'Are you sure you want to delete this record?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
                            url: "<?=  site_url("student/deleteHonors")?>",
							params:{ id: id, STUDIDNO: Ext.getCmp('STUDIDNO').getValue()},
							method: "POST",
							timeout:300000000,
			                success: function(responseObj){
                		    	var response = Ext.decode(responseObj.responseText);
						if(response.success == true)
						{
							Ext.Msg.show({
								title: 'Status',
								msg: "Record deleted successfully",
								icon: Ext.Msg.INFO,
								buttons: Ext.Msg.OK
							});
							studentProfile.app.honorsGrid.getStore().load();

							return;

						}
						else if(response.success == false)
						{
							Ext.Msg.show({
								title: 'Error!',
								msg: "There was an error encountered in deleting the record. Please try again",
								icon: Ext.Msg.ERROR,
								buttons: Ext.Msg.OK
							});

							return;
						}
							},
			                failure: function(f,a){
								Ext.Msg.show({
									title: 'Error Alert',
									msg: "There was an error encountered in deleting the record. Please try again",
									icon: Ext.Msg.ERROR,
									buttons: Ext.Msg.OK
								});
			                },
			                waitMsg: 'Deleting Data...'
						});
   			}
   			},

   			icon: Ext.MessageBox.QUESTION
			});

	                }else return;


		}//end of functions
 	}

 }();

 Ext.onReady(studentProfile.app.init, studentProfile.app);

</script>

<div id="mainBody">
</div>