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
 							url: "<?php echo site_url("admin/getStudentProfileRequest"); ?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [   
 											{name: "id"},
 											{name: "STUDCODE"},
 											{ name: "STUDIDNO"},
                                            { name: "NAME"},
 											{ name: "LASTNAME"},
                                            { name: "FIRSTNAME"},
                                            { name: "MIDDLENAME"},
                                            { name: "GENDER"},
                                            { name: "BIRTHDATE"},
                                            { name: "BIRTHPLACE"},
                                            { name: "RELIGION"},
                                            { name: "CITIZENSHIP"},
                                            { name: "C_ADDR01"},
                                            { name: "C_ADDR02"},
                                            { name: "C_ADDR03"},
                                            { name: "P_ADDR01"},
                                            { name: "P_ADDR02"},
                                            { name: "P_ADDR03"},
                                            { name: "WEBSITE"},
                                            { name: "STATUS"},
                                            { name: "EMAIL"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});
			var fm = Ext.form;
			
			

 			var grid = new Ext.grid.GridPanel({
 				id: 'studentProfilegrid',
 				height: 'auto',
 				width: 'auto',
 				border: true,
 				ds: Objstore,
 				clicksToEdit: 1,
 				cm:  new Ext.grid.ColumnModel(
 						[{ header: "Status", width: 150, sortable: true, dataIndex: "STATUS", renderer: this.statusFormat },
 						  { header: "Last Name", width: 150, sortable: true, dataIndex: "LASTNAME", editor: new fm.TextField({allowBlank: false}) },
                                                  { header: "First Name", width: 150, sortable: true, dataIndex: "FIRSTNAME", editor: new fm.TextField({allowBlank: false}) },
                                                  { header: "Middle Name", width: 150, sortable: true, dataIndex: "MIDDLENAME", editor: new fm.TextField({allowBlank: false}) },
                                                  { header: "Date of Birth", width: 150, sortable: true, dataIndex: "BIRTHDATE", editor: new fm.DateField({allowBlank: false, format: 'Y-m-d', listeners: {select: function(){this.setValue(this.getRawValue())}} }), renderer: this.dateFormat },
                                                  { header: "Place of Birth", width: 150, sortable: true, dataIndex: "BIRTHPLACE", editor: new fm.TextField({allowBlank: false}) },
                                                  { header: "Religion", width: 150, sortable: true, dataIndex: "RELIGION", editor: studentProfile.app.reliCombo()},
                                                  { header: "Citizenship", width: 150, sortable: true, dataIndex: "CITIZENSHIP", editor: studentProfile.app.citiCombo()},
                                                  { header: "Current Address line 1", width: 200, sortable: true, dataIndex: "C_ADDR01", editor: new fm.TextField({allowBlank: false}) },
                                                  { header: "Current Address line 2", width: 200, sortable: true, dataIndex: "C_ADDR02", editor: new fm.TextField({allowBlank: false}) },
                                                  { header: "Current Address line 3", width: 200, sortable: true, dataIndex: "C_ADDR03", editor: new fm.TextField({allowBlank: false}) },
                                                  { header: "Provincial Address line 1", width: 200, sortable: true, dataIndex: "P_ADDR01", editor: new fm.TextField({allowBlank: false}) },
                                                  { header: "Provincial Address line 2", width: 200, sortable: true, dataIndex: "P_ADDR02", editor: new fm.TextField({allowBlank: false}) },
                                                  { header: "Provincial Address line 3", width: 200, sortable: true, dataIndex: "P_ADDR03", editor: new fm.TextField({allowBlank: false}) },
                                                  { header: "Website", width: 150, sortable: true, dataIndex: "WEBSITE", editor: new fm.TextField({allowBlank: true}) },
                                                  { header: "Email", width: 150, sortable: true, dataIndex: "EMAIL", editor: new fm.TextField({allowBlank: true, vtype: 'email'}) },
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
 					     	text: 'APPROVE',
							 icon: '/images/icons/tick.png',
 							cls:'x-btn-text-icon',

 					     	handler: studentProfile.app.approveProfileChange

 					 	}, '-',
 					 	{
 					     	xtype: 'tbbutton',
 					     	text: 'DENY',
							icon: '/images/icons/cross.png',
 							cls:'x-btn-text-icon',

 					     	handler: studentProfile.app.denyProfileChange

 					 	}
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
 		        title: 'Student Profile Change Request',
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


 			
 			
 		    var form = new Ext.form.FormPanel({
 		        labelWidth: 100,
 		        url:"<?php echo site_url("studentProfile/insertStudentInfo"); ?>",
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
	 	  	 	 		  id: 'STUDIDNO'

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
	 	  	 	 		  id: 'FIRSTNAME'

                                                  },
                                                  {
	 	  	 	 			 					xtype:'textfield',
	 	  	 	 			 		            fieldLabel: 'Last Name*',
	 	  	 	 			 		            name: 'LASTNAME',
	 	  	 	 			 		            allowBlank:false,
	 	  	 	 			 		            anchor:'95%',  // anchor width by percentage
	 	  	 	 			 		            id: 'LASTNAME'
	 	  	 	 		},
                                                {xtype: 'datefield',
		 	 			        fieldLabel: 'Date of Birth*',
		 	 			        name: 'BIRTHDATE',
		 	 			        id: 'BIRTHDATE',
		 	 			        allowBlank: false,
		 	 			        format: 'Y-m-d',
		 	 			        anchor: '95%',
                                                        maxValue: new Date()

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
	 	  	 	 			 		            id: 'MIDDLENAME'
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
	 		 	 			       		            }
	 		 	 			          		    }),
                                                                                    {
	 	  	 	 			 					xtype:'textfield',
	 	  	 	 			 		            fieldLabel: 'Place of Birth*',
	 	  	 	 			 		            name: 'BIRTHPLACE',
	 	  	 	 			 		            allowBlank:false,
	 	  	 	 			 		            anchor:'95%',  // anchor width by percentage
	 	  	 	 			 		            id: 'BIRTHPLACE'
	 	  	 	 			 		        },
                                                                                studentProfile.app.reliCombo()
                                                                                
                                              ]
                                              }
                                    ]
                                }]
                        },
                                {xtype: 'fieldset',
                                title: 'Current Address',
                                labelWidth: 10,
                                items:[
                                {
                                    xtype: 'textfield',
                                    id: 'C_ADDR01',
                                    name: 'C_ADDR01',
                                    //fieldLabel: 'Line 1*',
                                    emptyText: 'Number, Street',
                                    anchor: '98.5%'
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'C_ADDR02',
                                    name: 'C_ADDR02',
                                   // fieldLabel: 'Line 2*',
                                    emptyText: 'Municipality, City',
                                    anchor: '98.5%'
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'C_ADDR03',
                                    name: 'C_ADDR03',
                                   // fieldLabel: 'Line 3*',
                                    emptyText: 'Province, Country, Zip Code',
                                    anchor: '98.5%'
                                }
                                ]
                                },
                                {xtype: 'fieldset',
                                title: 'Provincial Address',
                                labelWidth: 10,
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
                                  //  fieldLabel: 'Line 1*',
                                    emptyText: 'Number, Street',
                                    anchor: '98.5%'
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'P_ADDR02',
                                    name: 'P_ADDR02',
                                   // fieldLabel: 'Line 2*',
                                    emptyText: 'Municipality, City',
                                    anchor: '98.5%'
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'P_ADDR03',
                                    name: 'P_ADDR03',
                                  //  fieldLabel: 'Line 3*',
                                    emptyText: 'Province, Country, Zip Code',
                                    anchor: '98.5%'
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
                                    fieldLabel: 'Website',

                                    anchor: '95%'
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'EMAIL',
                                    name: 'EMAIL',
                                    fieldLabel: 'Email',
                                    vtype: 'email',
                                    anchor: '95%'
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

          						    autoEl: {tag: 'img', src: '<?=base_url()?>studentPhotos/icon_pic.jpg'}

          						})]}, {
          	 	 			          columnWidth:.6,
          	 	 			          layout: 'form',
          	 	 			          items: [/*{

          						        xtype: 'textfield',

          					            fieldLabel: 'Upload Photo',

          					            name: 'photo',

          					            id: 'photo',

          					            inputType: 'file',

          					            maxLength: 100,

          					            disableKeyFilter: true,

          					            width: 100

          					           // anchor:'95%'  // anchor width by percentage

          			            },*/ {xtype: 'button', text: 'Add Picture',
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
                                                                                                    name: 'student_id',
                                                                                                    id: 'student_id',
                                                                                                    value: Ext.getCmp('STUDIDNO').getValue()
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
						        							url: '<?php echo site_url("studentProfile/uploadPhoto"); ?>',
						        							
						        							method: 'POST',
						        							success: function(f,a){
						        								Ext.Msg.show({
						        									title: 'Success',
						        									msg: a.result.data, //"An error has occured while trying to save the record!",
						        									icon: Ext.Msg.INFO,
						        									buttons: Ext.Msg.OK
						        								});
                                                                                                                    Ext.getCmp('emp_photo').getEl().dom.src = a.result.filename;

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

              	 	  	                }]



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

 		    studentProfile.app.Form = form;
 		},
 		Add: function(){

 			studentProfile.app.setForm();

 		  	var _window;

 		    _window = new Ext.Window({
 		        title: 'New Student',
 		        width: 1000,
 		        height:720,
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
							url:"<?php echo site_url("studentProfile/loadStudentId"); ?>",
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
 			var id = sm.getSelected().data.STUDCODE;

 			studentProfile.app.setForm();
 		    _window = new Ext.Window({
 		        title: 'Update Student',
 		        width: 1000,
 		        height:720,
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
 			                url: "<?php echo site_url("studentProfile/updateStudent"); ?>",
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
							url:"<?php echo site_url("studentProfile/loadStudent"); ?>",
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

 			}else return;
 		},
                View: function(){


 			if(ExtCommon.util.validateSelectionGrid(studentProfile.app.Grid.getId())){//check if user has selected an item in the grid
 			var sm = studentProfile.app.Grid.getSelectionModel();
 			var id = sm.getSelected().data.STUDCODE;

 			var form = new Ext.form.FormPanel({
 		        labelWidth: 100,
 		        url:"<?php echo site_url("studentProfile/insertStudentInfo"); ?>",
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
                                labelWidth: 10,
                                items:[
                                {
                                    xtype: 'textfield',
                                    id: 'C_ADDR01',
                                    name: 'C_ADDR01',
                                    //fieldLabel: 'Line 1*',
                                    emptyText: 'Number, Street',
                                    anchor: '98.5%',
                                                  readOnly: true
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'C_ADDR02',
                                    name: 'C_ADDR02',
                                   // fieldLabel: 'Line 2*',
                                    emptyText: 'Municipality, City',
                                    anchor: '98.5%',
                                                  readOnly: true
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'C_ADDR03',
                                    name: 'C_ADDR03',
                                   // fieldLabel: 'Line 3*',
                                    emptyText: 'Province, Country, Zip Code',
                                    anchor: '98.5%',
                                                  readOnly: true
                                }
                                ]
                                },
                                {xtype: 'fieldset',
                                title: 'Provincial Address',
                                labelWidth: 10,
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
                                  //  fieldLabel: 'Line 1*',
                                    emptyText: 'Number, Street',
                                    anchor: '98.5%',
                                                  readOnly: true
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'P_ADDR02',
                                    name: 'P_ADDR02',
                                   // fieldLabel: 'Line 2*',
                                    emptyText: 'Municipality, City',
                                    anchor: '98.5%',
                                                  readOnly: true
                                },
                                {
                                    xtype: 'textfield',
                                    id: 'P_ADDR03',
                                    name: 'P_ADDR03',
                                  //  fieldLabel: 'Line 3*',
                                    emptyText: 'Province, Country, Zip Code',
                                    anchor: '98.5%',
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

          						    autoEl: {tag: 'img', src: '<?=base_url()?>studentPhotos/icon_pic.jpg'}

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
 			                url: "<?php echo site_url("studentProfile/updateStudent"); ?>",
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
							url:"<?php echo site_url("studentProfile/loadStudent"); ?>",
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
							url: "<?php echo site_url("studentProfile/deleteStudent"); ?>",
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
			url: "<?php echo site_url("studentProfile/getSchoolYear"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
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
			url: "<?php echo site_url("studentProfile/getSemester"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
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
			url: "<?php echo site_url("studentProfile/getSection"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
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
 				url: "<?=site_url("studentProfile/getCitizenshipCombo")?>",
 				baseParams: {start: 0, limit: 10}

 				}),
 				listeners: {
 				beforequery: function()
				{
					/*if (Ext.getCmp('SERIALNUM').getValue() == "")
						return false;

					this.store.baseParams = {id: Ext.getCmp('SERIALNUM').getValue()};

		            var o = {start: 0, limit:10};
		            this.store.baseParams = this.store.baseParams || {};
		            this.store.baseParams[this.paramName] = '';
		            this.store.load({params:o, timeout: 300000});*/
				},
 				select: function (combo, record, index){
 				this.setRawValue(record.get('name'));
 				this.setValue(record.get('name'));
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
 				url: "<?=site_url("studentProfile/getReligionCombo")?>",
 				baseParams: {start: 0, limit: 10}

 				}),
 				listeners: {
 				beforequery: function()
				{
					/*if (Ext.getCmp('SERIALNUM').getValue() == "")
						return false;

					this.store.baseParams = {id: Ext.getCmp('SERIALNUM').getValue()};

		            var o = {start: 0, limit:10};
		            this.store.baseParams = this.store.baseParams || {};
		            this.store.baseParams[this.paramName] = '';
		            this.store.load({params:o, timeout: 300000});*/
				},
 				select: function (combo, record, index){
 				this.setRawValue(record.get('name'));
 				this.setValue(record.get('name'));
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
	dateFormat: function(val){
       		// try record.data.teacher here
       		var d = new Date(val);
       		var month = d.getMonth()+1;
       		var day = d.getDate();
       		if(month < 10)
       		month = '0'+month; 
       		
       		if(day < 10)
       		day = '0'+day;
       		
       		return d.getFullYear()+"-"+month+"-"+day;

	},
	submitRequest: function(){
					 		var data = [];
					 		Ext.each(studentProfile.app.Grid.getStore().getModifiedRecords(), function(record){
					 		    data.push(record.data);
					 		});
					 		
					 		if(data.length >0){
					 		Ext.Ajax.request({
					 		    url: '<?php echo site_url('student/submitProfileChange')?>',
					 		    params: {data: Ext.encode(data)},
					 		    success: function(responseObj){
                                                                                var response = Ext.decode(responseObj.responseText);
                                                                                        if(response.success == true)
                                                                                        {
                                                                                        studentProfile.app.Grid.getStore().commitChanges();
                                                                                                Ext.Msg.show({
                                                                                                        title: 'Status',
                                                                                                        msg: response.data,
                                                                                                        icon: Ext.Msg.INFO,
                                                                                                        buttons: Ext.Msg.OK,
																							   			fn: function(btn, text){
																							   			if (btn == 'ok'){
																											window.location="<?php echo site_url("student/account/0");?>";
																							   			}
																							   			}
                                                                                                });
                                                                                               // hrisv2_company_setup.app.Grid.getStore().load();

                                                                                                return;

                                                                                        }
					 		    },
					 		    failure: function(){

					 		    }
					 		});

					 		}else{}
	},
	statusFormat: function(val){

			var fmtVal;

			switch(val){
				case "Approved"	: 	fmtVal = '<span style="color: blue; font-weight: bold;">'+val+'</span>'; break;
			 	case "Denied"	:  	fmtVal = '<span style="color: red; font-weight: bold;">'+val+'</span>'; break;
			 	case "Cancelled": 	fmtVal = '<span style="color: red; font-weight: bold;">'+val+'</span>'; break;
			 	case "Pending"	: 	fmtVal = '<span style="color: green; font-weight: bold;">'+val+'</span>'; break;
				case "Recalled" : fmtVal = '<span style="color: red; font-weight: bold;">'+val+'</span>'; break;
				case "System Void"	: 	fmtVal = '<span style="color: green; font-weight: bold;">'+val+'</span>'; break;

			}

			return fmtVal;
		},
		denyProfileChange: function(){


			if(ExtCommon.util.validateSelectionGrid(studentProfile.app.Grid.getId())){//check if user has selected an item in the grid
			var sm = studentProfile.app.Grid.getSelectionModel();
			var id = sm.getSelected().data.id;
			var status = sm.getSelected().data.STATUS;
			
			if(status == 'Pending'){
			Ext.Msg.show({
   			title:'Deny Application',
  			msg: 'Are you sure you want to deny this request?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
                            url: "<?=  site_url("admin/denyProfileChange")?>",
							params:{ id: id, type: 1},
							method: "POST",
							timeout:300000000,
			                success: function(responseObj){
                		    	var response = Ext.decode(responseObj.responseText);
						if(response.success == true)
						{
							Ext.Msg.show({
								title: 'Status',
								msg: "Request denied successfully",
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
								msg: response.data,
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
			                waitMsg: 'Updating Request...'
						});
   			}
   			},

   			icon: Ext.MessageBox.QUESTION
			});
			}else{
				Ext.Msg.show({
								title: 'Error!',
								msg: "Can't deny this request",
								icon: Ext.Msg.ERROR,
								buttons: Ext.Msg.OK
							});
			}

	                }else return;


		},
		
		approveProfileChange: function(){


			if(ExtCommon.util.validateSelectionGrid(studentProfile.app.Grid.getId())){//check if user has selected an item in the grid
			var sm = studentProfile.app.Grid.getSelectionModel();
			var id = sm.getSelected().data.id;
			var status = sm.getSelected().data.STATUS;
			
			if(status == 'Pending'){
			Ext.Msg.show({
   			title:'Deny Application',
  			msg: 'Are you sure you want to approve this request?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
                            url: "<?=  site_url("admin/approveProfileChange")?>",
							params:{ id: id},
							method: "POST",
							timeout:300000000,
			                success: function(responseObj){
                		    	var response = Ext.decode(responseObj.responseText);
						if(response.success == true)
						{
							Ext.Msg.show({
								title: 'Status',
								msg: "Request approved successfully",
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
								msg: response.data,
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
			                waitMsg: 'Updating Rquest...'
						});
   			}
   			},

   			icon: Ext.MessageBox.QUESTION
			});
			}else{
				Ext.Msg.show({
								title: 'Error!',
								msg: "Can't approve this request",
								icon: Ext.Msg.ERROR,
								buttons: Ext.Msg.OK
							});
			}

	                }else return;


		}//end of functions
}
	

 }();

 Ext.onReady(studentProfile.app.init, studentProfile.app);

</script>

<div id="mainBody">
</div>