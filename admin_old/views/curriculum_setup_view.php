 <script type="text/javascript" src="/js/ext34/examples/ux/Spinner.js"></script>
 <script type="text/javascript" src="/js/ext34/examples/ux/SpinnerField.js"></script>
 <link rel="stylesheet" type="text/css" href="/js/ext34/examples/ux/css/Spinner.css" />
<script type="text/javascript">
 Ext.namespace("curriculum_setup");
 curriculum_setup.app = function()
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
 							url: "<?=site_url("admin/getAllCurriculum")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "CURRIDNO"},
 											{ name: "DESCRIPTION"},
 											{ name: "COURIDNO"},
 											{ name: "COURSE"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});


 			var grid = new Ext.grid.GridPanel({
 				id: 'curriculum_setupgrid',
 				height: 300,
 				width: '100%',
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                                                    { header: "Id", width: 75, sortable: true, dataIndex: "CURRIDNO" },
 						  { header: "Course", width: 300, sortable: true, dataIndex: "COURSE" },
 						  { header: "Description", width: 300, sortable: true, dataIndex: "DESCRIPTION" }
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
 					     	text: 'ADD',
							icon: '/images/icons/application_add.png',
 							cls:'x-btn-text-icon',

 					     	handler: curriculum_setup.app.Add

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'EDIT',
							icon: '/images/icons/application_edit.png',
 							cls:'x-btn-text-icon',

 					     	handler: curriculum_setup.app.Edit

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'DELETE',
							icon: '/images/icons/application_delete.png',
 							cls:'x-btn-text-icon',

 					     	handler: curriculum_setup.app.Delete

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'SUBJECTS',
							icon: '/images/icons2/book.png',
 							cls:'x-btn-text-icon',

 					     	handler: curriculum_setup.app.showSubjects

 					 	}
 	    			 ]
 	    	});

 			curriculum_setup.app.Grid = grid;
 			curriculum_setup.app.Grid.getStore().load({params:{start: 0, limit: 25}});

 			var _window = new Ext.Panel({
 		        title: 'Student Curriculum',
 		        width: '100%',
 		        height:420,
 		        renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'fit',
 		        items: [curriculum_setup.app.Grid],
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
 		        url:"<?=site_url("admin/addCourseCurriculum")?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,

 		        items: [ {
 					xtype:'fieldset',
 					title:'Fields w/ Asterisks are required.',
 					width:'auto',
 					height:'auto',
 					items:[
 					ExtCommon.util.createCombo('COURSE', 'COURIDNO', '93%', '<?php echo site_url('filereference/getCombo/FILECOUR/COURIDNO/COURSE')?>', 'Course*', false, false),
                        {

                    xtype:'textarea',
 		            fieldLabel: 'Description*',
 		            name: 'DESCRIPTION',
 		            allowBlank:false,
 		            anchor:'93%',  // anchor width by percentage
 		            id: 'DESCRIPTION'
 		        }

 		        ]
 					}
 		        ]
 		    });

 		    curriculum_setup.app.Form = form;
 		},
 		Add: function(){

 			curriculum_setup.app.setForm();

 		  	var _window;

 		    _window = new Ext.Window({
 		        title: 'New Course Curriculum',
 		        width: 510,
 		        height:230,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: curriculum_setup.app.Form,
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',

 	                handler: function () {
 			            if(ExtCommon.util.validateFormFields(curriculum_setup.app.Form)){//check if all forms are filled up

 		                curriculum_setup.app.Form.getForm().submit({
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: 'icon'
  								 });
 				                ExtCommon.util.refreshGrid(curriculum_setup.app.Grid.getId());
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
 		Edit: function(){


 			if(ExtCommon.util.validateSelectionGrid(curriculum_setup.app.Grid.getId())){//check if user has selected an item in the grid
 			var sm = curriculum_setup.app.Grid.getSelectionModel();
 			var id = sm.getSelected().data.CURRIDNO;

 			curriculum_setup.app.setForm();
 		    _window = new Ext.Window({
 		        title: 'Update Course Curriculum',
 		        width: 510,
 		        height:230,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: curriculum_setup.app.Form,
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',

 		            handler: function () {
 			            if(ExtCommon.util.validateFormFields(curriculum_setup.app.Form)){//check if all forms are filled up
 		                curriculum_setup.app.Form.getForm().submit({
 			                url: "<?=site_url("admin/updateCourseCurriculum")?>",
 			                params: {id: id},
 			                method: 'POST',
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
 				                ExtCommon.util.refreshGrid(curriculum_setup.app.Grid.getId());
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
                            icon: '/images/icons/cancel.png', cls:'x-btn-text-icon',

 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });

 		  	curriculum_setup.app.Form.getForm().load({
 				url: "<?=site_url("admin/loadCourseCurriculum")?>",
 				method: 'POST',
 				params: {id: id},
 				timeout: 300000,
 				waitMsg:'Loading...',
 				success: function(form, action){
                                    _window.show();
                                    Ext.get("COURIDNO").dom.value = action.result.data.COURIDNO;
 				},
 				failure: function(form, action) {
         					Ext.Msg.show({
 									title: 'Error Alert',
 									msg: "A connection to the server could not be established",
 									icon: Ext.Msg.ERROR,
 									buttons: Ext.Msg.OK,
 									fn: function(){ _window.destroy(); }
 								});
     			}
 			});
 			}else return;
 		},
		Delete: function(){


			if(ExtCommon.util.validateSelectionGrid(curriculum_setup.app.Grid.getId())){//check if user has selected an item in the grid
			var sm = curriculum_setup.app.Grid.getSelectionModel();
			var id = sm.getSelected().data.CURRIDNO;
			Ext.Msg.show({
   			title:'Delete',
  			msg: 'Are you sure you want to delete this record?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
                            url: "<?=  site_url("admin/deleteCourseCurriculum")?>",
							params:{ id: id, COURIDNO: sm.getSelected().data.COURIDNO},
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
							curriculum_setup.app.Grid.getStore().load({params:{start:0, limit: 25}});

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
		showSubjects: function(){
			if(ExtCommon.util.validateSelectionGrid(curriculum_setup.app.Grid.getId())){//check if user has selected an item in the grid
			var sm = curriculum_setup.app.Grid.getSelectionModel();
			var COURIDNO = sm.getSelected().data.COURIDNO;
			
			var Objstore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?=site_url("admin/getCurriculumSubjects")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "YEAR"},
 											{ name: "SUBJIDNO"},
 											{ name: "SUBJECT"},
 											{ name: "PREREQ"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25, COURIDNO: COURIDNO}
 					});


 			var grid = new Ext.grid.GridPanel({
 				id: 'curriculum_subjectgrid',
 				height: 300,
 				width: '100%',
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 						  { header: "Year", width: 200, sortable: true, dataIndex: "YEAR" },
 						  { header: "Subject", width: 400, sortable: true, dataIndex: "SUBJECT" },
 						  { header: "Pre-requisite", width: 250, sortable: true, dataIndex: "PREREQ" }
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
 					     	text: 'ADD',
							icon: '/images/icons/application_add.png',
 							cls:'x-btn-text-icon',

 					     	handler: curriculum_setup.app.AddSubject

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'EDIT',
							icon: '/images/icons/application_edit.png',
 							cls:'x-btn-text-icon',

 					     	handler: curriculum_setup.app.EditSubject

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'DELETE',
							icon: '/images/icons/application_delete.png',
 							cls:'x-btn-text-icon',

 					     	handler: curriculum_setup.app.DeleteSubject

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'PREREQUISITES',
							icon: '/images/icons/chart_organisation.png',
 							cls:'x-btn-text-icon',

 					     	handler: curriculum_setup.app.showPrereq

 					 	}
 	    			 ]
 	    	});

 			curriculum_setup.app.subjectGrid = grid;
 			curriculum_setup.app.subjectGrid.getStore().load({params:{start: 0, limit: 25}});
 			

 		  	var _window;

 		    _window = new Ext.Window({
 		        title: 'Curriculum Subjects: '+sm.getSelected().data.COURSE,
 		        width: 800,
 		        height:420,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: [curriculum_setup.app.subjectGrid]
 		    });
 		  	_window.show();
 		  	}else return;
 		},
 		setFormSubject: function(){
 		    var form = new Ext.form.FormPanel({
 		        labelWidth: 150,
 		        url:"<?=site_url("admin/addCurriculumSubject")?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,

 		        items: [ {
 					xtype:'fieldset',
 					title:'Fields w/ Asterisks are required.',
 					width:'auto',
 					height:'auto',
 					items:[
 					ExtCommon.util.createCombo('STUDLEVEL', 'YEAR', '93%', '<?php echo site_url('filereference/getCombo/FILESTLE/YEAR/DESCRIPTIO/YEAR')?>', 'Year*', false, false),
 					ExtCommon.util.createCombo('SUBJECT', 'SUBJIDNO', '93%', '<?php echo site_url('filereference/getSubjectCombo')?>', 'Subject*', false, false),
                    new Ext.ux.form.SpinnerField({
							                fieldLabel: 'Order',
							                name: 'CODE',
							                id: 'CODE',
							                anchor: '93%',
							                allowBlank: true,
							                minValue: 1
							            })    

 		        ]
 					}
 		        ]
 		    });

 		    curriculum_setup.app.subjectForm = form;
 		},
 		AddSubject: function(){
 			
 			var sm = curriculum_setup.app.Grid.getSelectionModel();
			var COURIDNO = sm.getSelected().data.COURIDNO;

 			curriculum_setup.app.setFormSubject();

 		  	var add_window;
 		  	
 		  	
 	    	/*
 		        {
 		        	xtype: 'fieldset',
 		        	title: 'Pre-requisites',
 		        	items: grid
 		        }*/

 		    add_window = new Ext.Window({
 		        title: 'New Subject',
 		        width: 550,
 		        height:210,
 		        layout: 'form',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: [curriculum_setup.app.subjectForm],
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',

 	                handler: function () {
 			            if(ExtCommon.util.validateFormFields(curriculum_setup.app.subjectForm)){//check if all forms are filled up

 		                curriculum_setup.app.subjectForm.getForm().submit({
 		                	params: {COURIDNO: COURIDNO},
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: 'icon'
  								 });
 				                ExtCommon.util.refreshGrid(curriculum_setup.app.subjectGrid.getId());
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
 		EditSubject: function(){


 			if(ExtCommon.util.validateSelectionGrid(curriculum_setup.app.subjectGrid.getId())){//check if user has selected an item in the grid
 			var sm = curriculum_setup.app.subjectGrid.getSelectionModel();
 			var id = sm.getSelected().data.SUBJIDNO;
 			
 			var sm2 = curriculum_setup.app.Grid.getSelectionModel();
			var COURIDNO = sm2.getSelected().data.COURIDNO;

 			curriculum_setup.app.setFormSubject();
 		    edit_window = new Ext.Window({
 		        title: 'Update Subject',
 		        width: 510,
 		        height:230,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: curriculum_setup.app.subjectForm,
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',

 		            handler: function () {
 			            if(ExtCommon.util.validateFormFields(curriculum_setup.app.subjectForm)){//check if all forms are filled up
 		                curriculum_setup.app.subjectForm.getForm().submit({
 			                url: "<?=site_url("admin/updateCurriculumSubject")?>",
 			                params: {id: id, COURIDNO: COURIDNO},
 			                method: 'POST',
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
 				                ExtCommon.util.refreshGrid(curriculum_setup.app.subjectGrid.getId());
 				                edit_window.destroy();
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
                            icon: '/images/icons/cancel.png', cls:'x-btn-text-icon',

 		            handler: function(){
 			            edit_window.destroy();
 		            }
 		        }]
 		    });

 		  	curriculum_setup.app.subjectForm.getForm().load({
 				url: "<?=site_url("admin/loadCurriculumSubject")?>",
 				method: 'POST',
 				params: {id: id, COURIDNO: COURIDNO},
 				timeout: 300000,
 				waitMsg:'Loading...',
 				success: function(form, action){
                                    edit_window.show();
                                    Ext.get("SUBJIDNO").dom.value = action.result.data.SUBJIDNO;
 				},
 				failure: function(form, action) {
         					Ext.Msg.show({
 									title: 'Error Alert',
 									msg: "A connection to the server could not be established",
 									icon: Ext.Msg.ERROR,
 									buttons: Ext.Msg.OK,
 									fn: function(){ edit_window.destroy(); }
 								});
     			}
 			});
 			}else return;
 		},
		DeleteSubject: function(){


			if(ExtCommon.util.validateSelectionGrid(curriculum_setup.app.subjectGrid.getId())){//check if user has selected an item in the grid
			var sm = curriculum_setup.app.subjectGrid.getSelectionModel();
			var id = sm.getSelected().data.SUBJIDNO;
			
			var sm2 = curriculum_setup.app.Grid.getSelectionModel();
			var COURIDNO = sm2.getSelected().data.COURIDNO;
			
			Ext.Msg.show({
   			title:'Delete',
  			msg: 'Are you sure you want to delete this record?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
                            url: "<?=  site_url("admin/deleteCurriculumSubject")?>",
							params:{ id: id, COURIDNO: COURIDNO},
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
							curriculum_setup.app.subjectGrid.getStore().load({params:{start:0, limit: 25}});

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
		,
		showPrereq: function(){
			if(ExtCommon.util.validateSelectionGrid(curriculum_setup.app.subjectGrid.getId())){//check if user has selected an item in the grid
			var sm = curriculum_setup.app.Grid.getSelectionModel();
			var COURIDNO = sm.getSelected().data.COURIDNO;
			var sm2 = curriculum_setup.app.subjectGrid.getSelectionModel();
			var SUBJIDNO = sm2.getSelected().data.SUBJIDNO;
			
			var Objstore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?=site_url("admin/getPrereq")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "PREREQ"},
 											{ name: "PRERCODE"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25, COURIDNO: COURIDNO, SUBJIDNO: SUBJIDNO}
 					});
 		  	
 		  	var grid = new Ext.grid.GridPanel({
 				id: 'prereq_grid',
 				height: 150,
 				width: '100%',
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 						  { header: "Description", width: 300, sortable: true, dataIndex: "PREREQ" }
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
 					     	text: 'ADD',
							icon: '/images/icons/application_add.png',
 							cls:'x-btn-text-icon',

 					     	handler: curriculum_setup.app.AddPrereq

 					 	},'-',{
 					     	xtype: 'tbbutton',
 					     	text: 'DELETE',
							icon: '/images/icons/application_delete.png',
 							cls:'x-btn-text-icon',

 					     	handler: curriculum_setup.app.DeletePrereq

 					 	}
 	    			 ]
 	    	});

 			curriculum_setup.app.prereqGrid = grid;
 			curriculum_setup.app.prereqGrid.getStore().load({params:{start: 0, limit: 25}});
 			

 		  	var _window;

 		    _window = new Ext.Window({
 		        title: 'Pre-requisites: '+sm2.getSelected().data.SUBJECT,
 		        width: 550,
 		        height:300,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: [curriculum_setup.app.prereqGrid]
 		    });
 		  	_window.show();
 		  	}else return;
 		},
 		setFormPrereq: function(){
 		    var form = new Ext.form.FormPanel({
 		        labelWidth: 1,
 		        url:"<?=site_url("admin/addPrerequisite")?>",
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
 						layout: 'column',
 						width: 'auto',
 						items: [
 							{
 								columnWidth: .25,
 								layout: 'form',
 								labelWidth: 1,
 								items: [
 								{
            xtype: 'radiogroup',
            // Put all controls in a single column with width 100%
            columns: 1,
            items: [
                {boxLabel: 'Subject', name: 'subj', inputValue: 1, checked: true},
                {boxLabel: 'Requirement', name: 'subj', inputValue: 2}
            ],
            listeners: {
            	change: function(rg, r){
            		if(r.getGroupValue() == 1){
            			Ext.getCmp("PREREQSUBJ").enable();
            			Ext.getCmp("PREREQ").reset();
            			Ext.getCmp("PREREQ").disable();
            		}else{
            			if(r.getGroupValue() == 2){
            				Ext.getCmp("PREREQ").enable();
            				Ext.getCmp("PREREQSUBJ").disable();
            				Ext.getCmp("PREREQSUBJ").reset();	
            			}
            		}
            	}
            }
        }
 								]
 							},
 							{
 								columnWidth: .75,
 								layout: 'form',
 								labelWidth: 1,
 								items: [
 								ExtCommon.util.createCombo('PREREQSUBJ', 'PREREQSUBJIDNO', '93%', '<?php echo site_url('filereference/getCombo/FILESUBJ/SUBJIDNO/SUBJCODE')?>', '', false, false),
 								{

                            xtype:'textfield',
		 		            name: 'PREREQ',
		 		            allowBlank:false,
		 		            anchor:'93%',  // anchor width by percentage
		 		            id: 'PREREQ',
		 		            disabled: true
 		        			}
 								]
 							}
 						]
 					}
 					
 				//	ExtCommon.util.createCombo('STUDLEVEL', 'YEAR', '93%', '<?php echo site_url('filereference/getCombo/FILESTLE/YEAR/DESCRIPTIO/YEAR')?>', 'Year*', false, false),
 					//ExtCommon.util.createCombo('SUBJECT', 'SUBJIDNO', '93%', '<?php echo site_url('filereference/getCombo/FILESUBJ/SUBJIDNO/SUBJCODE')?>', 'Subject*', false, false),
               /*     new Ext.ux.form.SpinnerField({
							                fieldLabel: 'Order',
							                name: 'ORDER',
							                id: 'ORDER',
							                anchor: '93%',
							                allowBlank: true,
							                minValue: 1
							            })*/    

 		        ]
 					}
 		        ]
 		    });

 		    curriculum_setup.app.prereqForm = form;
 		},
 		AddPrereq: function(){
 			
 			var sm = curriculum_setup.app.Grid.getSelectionModel();
			var COURIDNO = sm.getSelected().data.COURIDNO;
			var sm2 = curriculum_setup.app.subjectGrid.getSelectionModel();
			var SUBJIDNO = sm2.getSelected().data.SUBJIDNO;

 			curriculum_setup.app.setFormPrereq();

 		  	var add_window;
 		  	
 		  	
 	    	/*
 		        {
 		        	xtype: 'fieldset',
 		        	title: 'Pre-requisites',
 		        	items: grid
 		        }*/

 		    add_window = new Ext.Window({
 		        title: 'New Pre-requisite',
 		        width: 550,
 		        height:210,
 		        layout: 'form',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: [curriculum_setup.app.prereqForm],
 		        buttons: [{
 		         	text: 'Save',
                                icon: '/images/icons/disk.png',  cls:'x-btn-text-icon',

 	                handler: function () {
 			            if(ExtCommon.util.validateFormFields(curriculum_setup.app.prereqForm)){//check if all forms are filled up

 		                curriculum_setup.app.prereqForm.getForm().submit({
 		                	params: {COURIDNO: COURIDNO, SUBJIDNO: SUBJIDNO},
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
                  		    	 Ext.Msg.show({
  								     title: 'Status',
 								     msg: action.result.data,
  								     buttons: Ext.Msg.OK,
  								     icon: 'icon'
  								 });
 				                ExtCommon.util.refreshGrid(curriculum_setup.app.prereqGrid.getId());
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
		DeletePrereq: function(){


			if(ExtCommon.util.validateSelectionGrid(curriculum_setup.app.prereqGrid.getId())){//check if user has selected an item in the grid
			var sm = curriculum_setup.app.prereqGrid.getSelectionModel();
			var id = sm.getSelected().data.PRERCODE;
			
			
			
			Ext.Msg.show({
   			title:'Delete',
  			msg: 'Are you sure you want to delete this record?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
                            url: "<?=  site_url("admin/deletePrereq")?>",
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
							curriculum_setup.app.prereqGrid.getStore().load({params:{start:0, limit: 25}});

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

 Ext.onReady(curriculum_setup.app.init, curriculum_setup.app);

</script>
<div id="mainBody"></div>
