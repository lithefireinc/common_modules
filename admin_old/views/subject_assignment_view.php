<script type="text/javascript">
 Ext.namespace("subject_assignment");
 subject_assignment.app = function()
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
 							url: "<?=site_url("filereference/getCourse")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "COURIDNO"},
 											{ name: "COURSE"},
                                                                                        { name: "ABBREV"},
                                                                                        { name: "DESCRIPTIO"},
                                                                                        { name: "CLUSIDNO"},
                                                                                        { name: "IDCHCODE"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});


 			var grid = new Ext.grid.GridPanel({
 				id: 'subject_assignmentgrid',
 				height: 300,
 				width: 900,
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                                                  { header: "Id", width: 75, sortable: true, dataIndex: "COURIDNO" },
 						  { header: "Course", width: 300, sortable: true, dataIndex: "COURSE" },
                                                  { header: "Abbreviation", width: 150, sortable: true, dataIndex: "ABBREV" }

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
 					 	},{
 					     	xtype: 'tbbutton',
 					     	text: 'FACULTY LIST',
							icon: '/images/icons2/user_business.png',
 							cls:'x-btn-text-icon',
 					     	handler: subject_assignment.app.Edit

 					 	}
 	    			 ]
 	    	});

 			subject_assignment.app.Grid = grid;
 			subject_assignment.app.Grid.getStore().load({params:{start: 0, limit: 25}});

 			var _window = new Ext.Panel({
 		        title: 'Subject Assignment',
 		        width: '100%',
 		        height:420,
 		        renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'fit',
 		        items: [subject_assignment.app.Grid],
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
 		    var form = new Ext.form.FormPanel({
 		        labelWidth: 150,
 		        url:"<?=site_url("filereference/addCourse")?>",
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

                            xtype:'textfield',
 		            fieldLabel: 'Course*',
                            autoCreate : {tag: "input", type: "text", size: "20", autocomplete: "off", maxlength: "47"},
 		            name: 'COURSE',
 		            allowBlank:false,
 		            anchor:'93%',  // anchor width by percentage
 		            id: 'COURSE'
 		        },
                        {

                            xtype:'textfield',
 		            fieldLabel: 'Abbreviation*',
                            autoCreate : {tag: "input", type: "text", size: "20", autocomplete: "off", maxlength: "47"},
 		            name: 'ABBREV',
 		            allowBlank:false,
 		            anchor:'93%',  // anchor width by percentage
 		            id: 'ABBREV'
 		        },
                        {
                            xtype:'textarea',
 		            fieldLabel: 'Description*',
                            maxLength: 47,
 		            name: 'DESCRIPTIO',
 		            allowBlank:false,
 		            anchor:'93%',  // anchor width by percentage
 		            id: 'DESCRIPTIO'
 		        },
                        {

                            xtype:'textfield',
 		            fieldLabel: 'Course Code*',
                            autoCreate : {tag: "input", type: "text", size: "20", autocomplete: "off", maxlength: "2"},
 		            name: 'IDCHCODE',
 		            allowBlank:false,
 		            anchor:'93%',  // anchor width by percentage
 		            id: 'IDCHCODE'
 		        },
                        {

                            xtype:'textfield',
 		            fieldLabel: 'Cluster*',
                            autoCreate : {tag: "input", type: "text", size: "20", autocomplete: "off", maxlength: "5"},
 		            name: 'CLUSIDNO',
 		            allowBlank:false,
 		            anchor:'93%',  // anchor width by percentage
 		            id: 'CLUSIDNO'
 		        }

 		        ]
 					}
 		        ]
 		    });

 		    subject_assignment.app.Form = form;
 		},
 		Add: function(){

 			subject_assignment.app.setForm();

 		  	var _window;

 		    _window = new Ext.Window({
 		        title: 'New Course',
 		        width: 510,
 		        height:300,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: subject_assignment.app.Form,
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',

 	                handler: function () {
 			            if(ExtCommon.util.validateFormFields(subject_assignment.app.Form)){//check if all forms are filled up

 		                subject_assignment.app.Form.getForm().submit({
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: 'icon'
  								 });
 				                ExtCommon.util.refreshGrid(subject_assignment.app.Grid.getId());
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
                            icon: '/images/icons/cancel.png', cls:'x-btn-text-icon',

 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });
 		  	_window.show();
 		},
 		AddFaculty: function(){
 			
 			var sm = subject_assignment.app.Grid.getSelectionModel();
 			var id = sm.getSelected().data.COURIDNO;
			var form = new Ext.form.FormPanel({
 		        labelWidth: 150,
 		        url:"<?=site_url("admin/addCourseFaculty")?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,

 		        items: [ {
 					xtype:'fieldset',
 					title:'Fields w/ Asterisks are required.',
 					width:'auto',
 					height:'auto',
 					items:[
					ExtCommon.util.createCombo('ADVISER', 'ADVIIDNO', '93%', '<?php echo site_url('filereference/getCombo/FILEADVI/ADVIIDNO/ADVISER')?>', 'Adviser*', false, false)
 		        ]
 					}
 		        ]
 		    });
 	

 		  	var _window;

 		    add_window = new Ext.Window({
 		        title: 'New Faculty',
 		        width: 510,
 		        height:160,
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
 		                	params: {COURIDNO: id},
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: 'icon'
  								 });
 				                ExtCommon.util.refreshGrid(subject_assignment.app.adviserGrid.getId());
 				                add_window.destroy();
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
 			            add_window.destroy();
 		            }
 		        }]
 		    });
 		  	add_window.show();
 		},
 		AddSubject: function(){
 			if(ExtCommon.util.validateSelectionGrid(subject_assignment.app.adviserGrid.getId())){
 			var sm = subject_assignment.app.adviserGrid.getSelectionModel();
 			var id = sm.getSelected().data.ADVIIDNO;
			var form = new Ext.form.FormPanel({
 		        labelWidth: 150,
 		        url:"<?=site_url("admin/addFacultySubject")?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,

 		        items: [ {
 					xtype:'fieldset',
 					title:'Fields w/ Asterisks are required.',
 					width:'auto',
 					height:'auto',
 					items:[
					ExtCommon.util.createCombo('SUBJECT', 'SUBJIDNO', '93%', '<?php echo site_url('filereference/getSubjectCombo')?>', 'Subject*', false, false)
 		        ]
 					}
 		        ]
 		    });
 	

 		  	var _window;

 		    add_window = new Ext.Window({
 		        title: 'New Subject Assignment',
 		        width: 510,
 		        height:160,
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
 		                	params: {ADVIIDNO: id},
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: 'icon'
  								 });
 				                ExtCommon.util.refreshGrid(subject_assignment.app.subjectGrid.getId());
 				                add_window.destroy();
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
 			            add_window.destroy();
 		            }
 		        }]
 		    });
 		  	add_window.show();
 		  	}else return;
 		},
 		Edit: function(){


 			if(ExtCommon.util.validateSelectionGrid(subject_assignment.app.Grid.getId())){//check if user has selected an item in the grid
 			var sm = subject_assignment.app.Grid.getSelectionModel();
 			var id = sm.getSelected().data.COURIDNO;

 			var Objstore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?=site_url("admin/getCourseFaculty")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "IDNO"},
 											{ name: "ADVISER"},
 											{ name: "ADVIIDNO"},
 											{ name: "id"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25, COURIDNO: id}
 					});


 			var grid = new Ext.grid.GridPanel({
 				id: 'adviser_grid',
 				height: '100%',
 				width: 'auto',
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                          { header: "Id", width: 100, sortable: true, dataIndex: "IDNO" },
 						  { header: "Adviser", width: 300, sortable: true, dataIndex: "ADVISER" }

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
				},'   ', new Ext.app.SearchField({ store: Objstore, width:150}),
 					    {
 					     	xtype: 'tbfill'
 					 	},{
 					     	xtype: 'tbbutton',
 					     	text: 'ADD',
							icon: '/images/icons/application_add.png',
 							cls:'x-btn-text-icon',
 					     	handler: subject_assignment.app.AddFaculty

 					 	}, "-",
 					 	{
 					     	xtype: 'tbbutton',
 					     	text: 'DELETE',
							icon: '/images/icons/application_delete.png',
 							cls:'x-btn-text-icon',
 					     	handler: subject_assignment.app.DeleteFaculty

 					 	}
 	    			 ],
 	    			 listeners: {
 	    			 	rowclick: function(grid, r, e){
 	    			 		var record = grid.getStore().getAt(r);  

						    // Get field name
						     
						    var data = record.get("ADVIIDNO");
 	    			 		subject_assignment.app.subjectGrid.getStore().setBaseParam("ADVIIDNO", data);
 	    			 		subject_assignment.app.subjectGrid.getStore().load();
 	    			 	}
 	    			 }
 	    	});

 			subject_assignment.app.adviserGrid = grid;
 			
 			var subjStore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?=site_url("admin/getFacultySubject")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "SUBJCODE"},
 											{ name: "COURSEDESC"},
 											{ name: "id"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});


 			var subjGrid = new Ext.grid.GridPanel({
 				id: 'subject_grid',
 				height: '100%',
 				width: 'auto',
 				border: true,
 				ds: subjStore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                          { header: "Subj Code", width: 100, sortable: true, dataIndex: "SUBJCODE" },
 						  { header: "Description", width: 300, sortable: true, dataIndex: "COURSEDESC" }

 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,
 	        	bbar:
 	        		new Ext.PagingToolbar({
 		        		autoShow: true,
 				        pageSize: 25,
 				        store: subjStore,
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
				},'   ', new Ext.app.SearchField({ store: subjStore, width:150}),
 					    {
 					     	xtype: 'tbfill'
 					 	},{
 					     	xtype: 'tbbutton',
 					     	text: 'ADD',
							icon: '/images/icons/application_add.png',
 							cls:'x-btn-text-icon',
 					     	handler: subject_assignment.app.AddSubject

 					 	}, "-",
 					 	{
 					     	xtype: 'tbbutton',
 					     	text: 'DELETE',
							icon: '/images/icons/application_delete.png',
 							cls:'x-btn-text-icon',
 					     	handler: subject_assignment.app.DeleteSubject

 					 	}
 	    			 ]
 	    	});

 			subject_assignment.app.subjectGrid = subjGrid;
 			
 		    _window = new Ext.Window({
 		        title: 'Faculty List',
 		        width: 910,
 		        height:500,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: [
 		        {
 		        	xtype: 'fieldset',
 		        	items: [
 		        		{
 		        			layout: 'column',
 		        			width: 'auto',
 		        			items: [
 		        				{
 		        					layout: 'fit',
 		        					height: 400,
 		        					columnWidth: .5,
 		        					items: subject_assignment.app.adviserGrid
 		        				},
 		        				{
 		        					layout: 'fit',
 		        					height: 400,
 		        					columnWidth: .5,
 		        					items: subject_assignment.app.subjectGrid
 		        				}
 		        			]
 		        		}
 		        	]
 		        }
 		        ],
 		        buttons: [{
 		            text: 'Close',
                            icon: '/images/icons/cancel.png', cls:'x-btn-text-icon',

 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });
 		   	
			 _window.show();
			 subject_assignment.app.adviserGrid.getStore().load();
 		  	
 			}else return;
 		},
		Delete: function(){


			if(ExtCommon.util.validateSelectionGrid(subject_assignment.app.Grid.getId())){//check if user has selected an item in the grid
			var sm = subject_assignment.app.Grid.getSelectionModel();
			var id = sm.getSelected().data.COURIDNO;
			Ext.Msg.show({
   			title:'Delete',
  			msg: 'Are you sure you want to delete this record?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
                            url: "<?=  site_url("filereference/deleteCourse")?>",
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
							subject_assignment.app.Grid.getStore().load({params:{start:0, limit: 25}});

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
		DeleteFaculty: function(){


			if(ExtCommon.util.validateSelectionGrid(subject_assignment.app.adviserGrid.getId())){//check if user has selected an item in the grid
			var sm = subject_assignment.app.adviserGrid.getSelectionModel();
			var id = sm.getSelected().data.id;
			Ext.Msg.show({
   			title:'Delete',
  			msg: 'Are you sure you want to delete this record?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
                            url: "<?=  site_url("admin/deleteCourseFaculty")?>",
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
							subject_assignment.app.adviserGrid.getStore().load({params:{start:0, limit: 25}});

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
		DeleteSubject: function(){


			if(ExtCommon.util.validateSelectionGrid(subject_assignment.app.subjectGrid.getId())){//check if user has selected an item in the grid
			var sm = subject_assignment.app.subjectGrid.getSelectionModel();
			var id = sm.getSelected().data.id;
			Ext.Msg.show({
   			title:'Delete',
  			msg: 'Are you sure you want to delete this record?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
                            url: "<?=  site_url("admin/deleteFacultySubject")?>",
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
							subject_assignment.app.subjectGrid.getStore().load({params:{start:0, limit: 25}});

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


		}
 	}

 }();

 Ext.onReady(subject_assignment.app.init, subject_assignment.app);

</script>
<div id="mainBody"></div>
