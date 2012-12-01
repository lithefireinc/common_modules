<script type="text/javascript">
 Ext.namespace("ogs_student_account");
 ogs_student_account.app = function()
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
 							url: "<?php echo site_url("student/getSubjectsPerStudent"); ?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "id"},
                                            { name: "SUBJCODE"},
 											{ name: "COURSEDESC"},
                                            { name: "UNITS_TTL"},
                                            { name: "DAYS"},
                                            { name: "TIME"},
                                            { name: "ADVISER"},
                                            { name: "ROOM"},
                                            { name: "PRELIM"},
                                            { name: "MIDTERM"},
                                            { name: "FINAL"},
                                            { name: "AVERAGE"},
                                            { name: "REMARKS"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});



 			var grid = new Ext.grid.GridPanel({
 				id: 'ogs_student_accountgrid',
 				height: 377,
 				width: 'auto',
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                                                  { header: "Subject Code", width: 100, sortable: true, dataIndex: "SUBJCODE" },
                                                  { header: "Description", width: 250, sortable: true, dataIndex: "COURSEDESC" },
                                                  { header: "Units", width: 50, sortable: true, dataIndex: "UNITS_TTL" },
                                                  { header: "Days", width: 100, sortable: true, dataIndex: "DAYS" },
                                                  { header: "Time", width: 200, sortable: true, dataIndex: "TIME" },
                                                  { header: "Instructor", width: 150, sortable: true, dataIndex: "ADVISER" },
                                                  { header: "Room", width: 100, sortable: true, dataIndex: "ROOM" },
                                                  { header: "Prelim", width: 50, sortable: true, dataIndex: "PRELIM", renderer: this.gradeFormat },
                                                  { header: "Midterm", width: 50, sortable: true, dataIndex: "MIDTERM", renderer: this.gradeFormat },
                                                  { header: "Final", width: 50, sortable: true, dataIndex: "FINAL", renderer: this.gradeFormat },
                                                  { header: "Average", width: 60, sortable: true, dataIndex: "AVERAGE", renderer: this.gradeFormat },
                                                  { header: "Remarks", width: 100, sortable: true, dataIndex: "REMARKS", renderer: this.remarksFormat }

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

                                 listeners: {
			rowdblclick: function(grid, row, e){
                            //ogs_student_account.app.Edit();
                        }
                        },
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
 					 	},
                                                {
 					     	xtype: 'tbbutton',
 					     	text: 'VIEW ATTENDANCE',
							icon: '/images/icons2/magnifier.png',
 							cls:'x-btn-text-icon',

 					     	handler: ogs_student_account.app.viewAttendance
                                                },
                                                {
 					     	xtype: 'tbbutton',
 					     	text: 'COMPUTE GRADES',
							icon: '/images/icons2/calculator.png',
 							cls:'x-btn-text-icon',

 					     	handler: ogs_student_account.app.computeGrades
                                                }
 	    			 ]
 	    	});
                /*grid.on("afterrender", function(component) {
                 component.getBottomToolbar().refresh.hideParent = true;
                 component.getBottomToolbar().refresh.hide();
                });*/


 			ogs_student_account.app.Grid = grid;
 			//ogs_student_account.app.Grid.getStore().load({params:{start: 0, limit: 25}});

 			//var msgbx = Ext.MessageBox.wait("Redirecting to main page. . .","Status");


                    var _form = new Ext.form.FormPanel({
 		        labelWidth: 90,
 		        url:"<?php echo site_url("hr/insertEmployee"); ?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,
                        id: 'studentForm',
                       // autoScroll: true,
                       // width: 900,
 		        items: [ ogs_student_account.app.semesterCombo()

 		        ],
                        buttons: [{
 		         	text: 'Load Subjects',
                                icon: '/images/icons/arrow_rotate_clockwise.png',
 	                handler: function () {
                            if(ExtCommon.util.validateFormFields(_form)){//check if all forms are filled up
                            ogs_student_account.app.Grid.getStore().load();
                            }else return;




 	                }
 	            }]
 		    });

 			var _window = new Ext.Panel({
 		        width: 'auto',
 		        height:'auto',
 		        //renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'form',
                        items:[ _form,
                             ogs_student_account.app.Grid

                         ],
 		        resizable: false

 			    /*listeners : {
 				    	  close: function(p){
 					    	  window.location="../"
 					      }
 			       	} */
 	        });

                
                ogs_student_account.app.setForm();
 			var activeTab = <?php echo $activeTab; ?>;
            var tabs = new Ext.TabPanel({
		        renderTo: 'mainBody',
		        width:'100%',
		        activeTab: activeTab,
		        frame:true,
		        height: 480,
                       // layout: 'fit',
		        //defaults:{autoHeight: true},
		        items:[
		            {title: 'My Profile', autoScroll: true, items: [ogs_student_account.app.Form]},
		            {title: 'My Subjects', items: [_window]}
		        ],
		        listeners: {
		        	tabchange: function(panel, tab){
		        		if(panel.items.indexOf(panel.getActiveTab()) == 0){
		        		ogs_student_account.app.Form.form.load({
							url:"<?php echo site_url("student/loadStudent"); ?>",
							waitMsg:'Loading...',
                                                        params:{id: '<?php echo $userCode?>'},
							success: function(f, action){
                                                           // alert(action.result.data.firstName);

                                                            _window.show();
                                                            Ext.get("COURIDNO2").dom.value = action.result.data.COURIDNO;
                                                            Ext.get("RELIIDNO").dom.value = action.result.data.RELIIDNO;
                                                            Ext.get("CITIIDNO").dom.value = action.result.data.CITIIDNO;

                                                            Ext.getCmp('emp_photo').getEl().dom.src = action.result.data.filename;
							}

						});

                                                Ext.getCmp("COURSE").setReadOnly(true);
                                                            Ext.getCmp("yearlevel").setReadOnly(true);
                                                            Ext.getCmp("RELIGION").setReadOnly(true);
                                                            Ext.getCmp("CITIZENSHIP").setReadOnly(true);
		        		}else{
		        			if(panel.items.indexOf(panel.getActiveTab()) == 1){
		        				_form.form.load({
							url:"<?php echo site_url("admin/loadActiveSemester"); ?>",
							waitMsg:'Loading...',
							success: function(f, action){
								
                                 Ext.get("SEMEIDNO").dom.value = action.result.data.SEMEIDNO;
                                 ogs_student_account.app.Grid.getStore().setBaseParam("SEMEIDNO", action.result.data.SEMEIDNO);
                                 ogs_student_account.app.Grid.getStore().load();
							}

							});
		        			}
		        		}
		        	}
		        }
		    }).render();
			/*	if(activeTab == 0){
                    
                                                           }*/


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
                                                  name: 'IDNO',
                                                  anchor:'25%',  // anchor width by percentage
	 	  	 	 		  						  id: 'IDNO',
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
	 	  	 	 		  allowBlank:true,
                                                  anchor:'95%',  // anchor width by percentage
	 	  	 	 		  id: 'FIRSTNAME',
                                                  readOnly: true

                                                  },
                                                  {
	 	  	 	 			 					xtype:'textfield',
	 	  	 	 			 		            fieldLabel: 'Last Name*',
	 	  	 	 			 		            name: 'LASTNAME',
	 	  	 	 			 		            allowBlank:true,
	 	  	 	 			 		            anchor:'95%',  // anchor width by percentage
	 	  	 	 			 		            id: 'LASTNAME',
                                                  readOnly: true
	 	  	 	 		},
                                                {xtype: 'datefield',
		 	 			        fieldLabel: 'Date of Birth*',
		 	 			        name: 'BIRTHDATE',
		 	 			        id: 'BIRTHDATE',
		 	 			        allowBlank:true,
		 	 			        format: 'Y-m-d',
		 	 			        anchor: '95%',
                                                        maxValue: new Date(),
                                                        readOnly: true

		 	 			      },
                                                      ogs_student_account.app.citiCombo()
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.5,
	 	 			          layout: 'form',
	 	 			          items: [{
	 	  	 	 			 					xtype:'textfield',
	 	  	 	 			 		            fieldLabel: 'Middle Name*',
	 	  	 	 			 		            name: 'MIDDLENAME',
	 	  	 	 			 		            allowBlank:true,
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
                                                                                    allowBlank:true,
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
	 	  	 	 			 		            allowBlank:true,
	 	  	 	 			 		            anchor:'95%',  // anchor width by percentage
	 	  	 	 			 		            id: 'BIRTHPLACE',
                                                  readOnly: true
	 	  	 	 			 		        },
                                                                                ogs_student_account.app.reliCombo()

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
                  ogs_student_account.app.yearCombo(),
                  ogs_student_account.app.profileCourseCombo(),
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

 		    ogs_student_account.app.Form = form;
 		},
 		computeGrades: function(){
if(Ext.getCmp('semester').validate()){//check if all forms are filled up
                          
                          
 			ExtCommon.util.renderSearchField('searchby');

 			var Objstore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?=site_url("student/getSubjectsPerStudent")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "id"},
                                                                                        { name: "SUBJCODE"},
 											{ name: "COURSEDESC"},
                                                                                        { name: "UNITS_TTL"},
                                                                                        { name: "DAYS"},
                                                                                        { name: "TIME"},
                                                                                        { name: "ADVISER"},
                                                                                        { name: "ROOM"},
                                                                                        { name: "PRELIM"},
                                                                                        { name: "MIDTERM"},
                                                                                        { name: "FINAL"},
                                                                                        { name: "AVERAGE"},
                                                                                        { name: "REMARKS"},
                                                                                        { name: "PRELIM_EDITABLE"},
                                                                                        { name: "MIDTERM_EDITABLE"},
                                                                                        { name: "FINAL_EDITABLE"},
                                                                                        { name: "PRELIM_TO"},
                                                                                        { name: "MIDTERM_TO"},
                                                                                        { name: "FINAL_TO"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25, SEMEIDNO: Ext.get("SEMEIDNO").dom.value}
 					});

                        var fm = Ext.form;


 			var grid = new Ext.grid.EditorGridPanel({
 				id: 'ogs_student_account_compute_grid',
 				height: 333,
 				width: '100%',
                                clicksToEdit: 1,
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel({
 						columns: [
 						 { header: "Subject Code", width: 100, sortable: true, dataIndex: "SUBJCODE" },
                                                  { header: "Subject Description", width: 400, sortable: true, dataIndex: "COURSEDESC" },
                                                  { header: "Units", width: 50, sortable: true, dataIndex: "UNITS_TTL" },
                                                  { header: "Prelim", width: 75, sortable: true, dataIndex: "PRELIM", renderer: ogs_student_account.app.gradeFormat, editor: new fm.NumberField({
                              allowBlank: false,
                              maxValue: 100
                          }) },
                                                  { header: "Midterm", width: 75, sortable: true, dataIndex: "MIDTERM", renderer: ogs_student_account.app.gradeFormat, editor: new fm.NumberField({
                              allowBlank: false,
                              maxValue: 100
                          }) },
                                                  { header: "Final", width: 75, sortable: true, dataIndex: "FINAL", renderer: ogs_student_account.app.gradeFormat, editor: new fm.NumberField({
                              allowBlank: false,
                              maxValue: 100
                          }) },
                                                  { header: "Average", width: 75, sortable: true, renderer: ogs_student_account.app.gradeFormat, dataIndex: "AVERAGE" },
                                                  { header: "Remarks", width: 150, sortable: true, renderer: ogs_student_account.app.remarksFormat, dataIndex: "REMARKS" }
 						],
 						isCellEditable: function(col, row) {
				    	var record = Objstore.getAt(row);
				    	//alert(record.get('unit_price').indexOf("Grand Total"));
				    	//if (record.get('PRELIM') == 0 && col == 3) { // replace with your condition
				      	//	return false;
				    	//}
				    	
				    	//alert(record.get('PRELIM'));
				    	if(record.get('PRELIM_EDITABLE') == 0 && col == 7){
				    		return false;
				    	}
				    	
				    	if(record.get('MIDTERM_EDITABLE') == 0 && col == 8){
				    		return false;
				    	}
				    	
				    	if(record.get('FINAL_EDITABLE') == 0 && col == 9){
				    		return false;
				    	}
				    	
				    	return Ext.grid.ColumnModel.prototype.isCellEditable.call(this, col, row);
				  		}
 				}),
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
                                               
 	    			 ]
 	    	});

 			//ogs_student_account.app.Grid = grid;
 			//ogs_student_account.app.Grid.getStore().load();

                        grid.on('afteredit', function(e){
								var userType = '<?php echo $userType;?>';
			 					var prelim = Number(e.record.get('PRELIM'));
			    	    		var midterm = Number(e.record.get('MIDTERM'));
			    	    		var final_grade = Number(e.record.get('FINAL'));
			    	    		//var average = Number(e.record.get('AVERAGE'));
			    	    		var tot = prelim+midterm+final_grade;
								
								var prelim_to = e.record.get('PRELIM_TO');
								prelim_to = prelim_to.split(/[-]/);
								
								var prelims = new Date(prelim_to[0], prelim_to[1]-1, prelim_to[2]);
								
								var midterm_to = e.record.get('MIDTERM_TO');
								midterm_to = midterm_to.split(/[-]/);
								
								var midterms = new Date(midterm_to[0], midterm_to[1]-1, midterm_to[2]);
								
								var final_to = e.record.get('FINAL_TO');
								final_to = final_to.split(/[-]/);
								
								var finals = new Date(final_to[0], final_to[1]-1, final_to[2]);
								
								var divisor = 0;
								var date_today = new Date();
								
								//alert(prelims);
								/*if(userType == 'ADMIN'){
								if(prelim > 0)
									divisor++;
								if(midterm > 0)
									divisor++;
								if(final_grade > 0)
									divisor++;
								}else{*/
									if(prelim > 0 || prelims < date_today)
										divisor++;
									if(midterm > 0 || midterms < date_today)
										divisor++;
									if(final_grade > 0 || finals < date_today)
										divisor++;
								
								
								 
		                        var average_grade = tot/divisor;
		            	    	e.record.set('AVERAGE', average_grade.toFixed(2));
		
		                        if(average_grade >= 75)
		                            e.record.set('REMARKS', 'PASSED');
		                        else
		                            e.record.set('REMARKS', 'FAILED');



            			});

 		  	var _window;

 		    _window = new Ext.Window({
 		        title: 'Grade Computation',
 		        width: 1000,
 		        height:410,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: grid,
 		        buttons: [{
 		            text: 'Close',
                             icon: '/images/icons/cancel.png',
 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });
 		  	_window.show();
 		  	grid.getStore().load();
 		  	  }else return;
 		},
 		Edit: function(){


 			if(ExtCommon.util.validateSelectionGrid(ogs_student_account.app.Grid.getId())){//check if user has selected an item in the grid
 			var sm = ogs_student_account.app.Grid.getSelectionModel();
 			var id = sm.getSelected().data.id;

 			ogs_student_account.app.setForm();
 		    _window = new Ext.Window({
 		        title: 'Update Student',
 		        width: 1000,
 		        height:410,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: ogs_student_account.app.Form,
 		        buttons: [{
 		         	text: 'Save',
                                icon: 'http://www.pixelcatalyst.net/hrisv2/images/icons/disk.png',
 		            handler: function () {
 			            if(ExtCommon.util.validateFormFields(ogs_student_account.app.Form)){//check if all forms are filled up
 		                ogs_student_account.app.Form.getForm().submit({
 			                url: "<?php echo site_url("ogs_student_account/updateStudent"); ?>",
 			                params: {id: id},
 			                method: 'POST',
 			                success: function(f,action){
                 		    	Ext.MessageBox.alert('Status', action.result.data);
 				                ExtCommon.util.refreshGrid(ogs_student_account.app.Grid.getId());
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
                            icon: 'http://www.pixelcatalyst.net/hrisv2/images/icons/cancel.png',
 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });

                    ogs_student_account.app.Form.form.load({
							url:"<?php echo site_url("ogs_student_account/loadStudent"); ?>",
							waitMsg:'Loading...',
                                                        params:{id: id},
							success: function(f, action){
                                                           // alert(action.result.data.firstName);

                                                            _window.show();
                                                            Ext.getCmp('emp_photo').getEl().dom.src = action.result.data.filename;
							}

						});



 			}else return;
 		},
		Delete: function(){


			if(ExtCommon.util.validateSelectionGrid(ogs_student_account.app.Grid.getId())){//check if user has selected an item in the grid
			var sm = ogs_student_account.app.Grid.getSelectionModel();
			var id = sm.getSelected().data.id;
			Ext.Msg.show({
   			title:'Delete',
  			msg: 'Are you sure you want to delete this record?',
   			buttons: Ext.Msg.OKCANCEL,
   			fn: function(btn, text){
   			if (btn == 'ok'){

   			Ext.Ajax.request({
							url: "<?php echo site_url("ogs_student_account/deleteStudent"); ?>",
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
							ogs_student_account.app.Grid.getStore().load({params:{start:0, limit: 25}});

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
                viewAttendance: function(){


 			if(ExtCommon.util.validateSelectionGrid(ogs_student_account.app.Grid.getId())){//check if user has selected an item in the grid
 			var sm = ogs_student_account.app.Grid.getSelectionModel();
 			var id = sm.getSelected().data.id;

 			ExtCommon.util.renderSearchField('searchby');

 			var Objstore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?=site_url("student/getAttendancePerSubject")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "SCHEDULEDATE"},
 											{ name: "DAY"},
                                                                                        { name: "STATUS"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25, SCHEDULEIDNO: id, SEMEIDNO: Ext.get("SEMEIDNO").dom.value}
 					});


 			var grid = new Ext.grid.GridPanel({
 				id: 'ogs_student_attendance_grid',
 				height: 300,
 				width: 900,
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                                                 
 						  { header: "Date", width: 100, sortable: true, dataIndex: "SCHEDULEDATE" },
                                                  { header: "Day", width: 100, sortable: true, dataIndex: "DAY" },
                                                  { header: "Status", width: 130, sortable: true, dataIndex: "STATUS", renderer: ogs_student_account.app.attendanceFormat }
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
 	    			 ]
                    });
 		    _window = new Ext.Window({
 		        title: 'View Attendance',
 		        width: 600,
 		        height:410,
 		        layout: 'fit',
 		        plain:true,
 		        modal: true,
 		        bodyStyle:'padding:5px;',
 		        buttonAlign:'center',
 		        items: grid,
 		        buttons: [{
 		            text: 'Close',
                            icon: '/images/icons/cancel.png',
 		            handler: function(){
 			            _window.destroy();
 		            }
 		        }]
 		    });

                    _window.show();
                    grid.getStore().load();

 			}else return;
 		},
        semesterCombo: function(){

		return {
			xtype:'combo',
			id:'semester',
			hiddenName: 'SEMEIDNO',
                        hiddenId: 'SEMEIDNO',
			name: 'semester',
			valueField: 'id',
			displayField: 'name',
			//width: 100,
			anchor: '30%',
			triggerAction: 'all',
			minChars: 2,
			forceSelection: true,
			enableKeyEvents: true,
			pageSize: 10,
			resizable: true,
			readOnly: false,
			minListWidth: 300,
			allowBlank:false,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id'}, {name: 'name'}],
			url: "<?php echo site_url("lithefire/getSemesterCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
                        beforequery: function()
					{

                                      
                                /*    if (Ext.getCmp('teacherSubject').getValue() == "")
							return false;

				    this.store.baseParams = {id: Ext.getCmp('teacherSubject').getValue()};

			            var o = {start: 0, limit:10};
			            this.store.baseParams = this.store.baseParams || {};
			            this.store.baseParams[this.paramName] = '';
			            this.store.load({params:o, timeout: 300000});*/
					},

			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
                        ogs_student_account.app.Grid.getStore().setBaseParam("SEMEIDNO", record.get("id"));
                        //Ext.getCmp("teacherRoom").setValue(record.get('room'));

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
			Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Semester*'

			}
	},
        remarksFormat: function(val){

			var fmtVal;

			switch(val){
				case "PASSED"	: 	fmtVal = '<span style="color: green; font-weight: bold;">'+val+'</span>'; break;
			 	case "FAILED"	:  	fmtVal = '<span style="color: red; font-weight: bold;">'+val+'</span>'; break;

			}

			return fmtVal;
		},
        gradeFormat: function(val){

			var fmtVal;

			if(val >= 75)
				fmtVal = '<span style="color: blue; font-weight: bold;">'+val+'</span>';
                            else
			 	fmtVal = '<span style="color: red; font-weight: bold;">'+val+'</span>';

			if(val == null)
				fmtVal = '<span style="color: red; font-weight: bold;">0</span>';

			return fmtVal;
		},
                attendanceFormat: function(val){

			var fmtVal;

			switch(val){
                                case true: fmtVal = '<span style="color: green; font-weight: bold;">PRESENT</span>'; break;
                                case false : fmtVal = '<span style="color: red; font-weight: bold;">ABSENT</span>'; break;
				case "PRESENT"	: 	fmtVal = '<span style="color: green; font-weight: bold;">'+val+'</span>'; break;
			 	case "ABSENT"	:  	fmtVal = '<span style="color: red; font-weight: bold;">'+val+'</span>'; break;

			}

			return fmtVal;
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
 				enableKeyEvents: false,
 				pageSize: 10,
 				resizable: true,
 				//readOnly: true,
 				minListWidth: 300,
 				allowBlank:true,
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
 				enableKeyEvents: false,
 				pageSize: 10,
 				resizable: true,
 				//readOnly: true,
 				minListWidth: 300,
 				allowBlank:true,
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
			allowBlank:true,
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
        profileCourseCombo: function(){

		return {
			xtype:'combo',
			id:'COURSE',
			hiddenName: 'COURIDNO2',
                        hiddenId: 'COURIDNO2',
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
			allowBlank:true,
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
	}//end of functions
 	}

 }();

 Ext.onReady(ogs_student_account.app.init, ogs_student_account.app);

</script>

<div id="mainBody">
</div>
