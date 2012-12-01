<script type="text/javascript">
 Ext.namespace("gradeView");
 gradeView.app = function()
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
 				id: 'gradeViewgrid',
 				height: 260,
 				width: 'auto',
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 						  //{ header: "Id", dataIndex: "id", width: 100, sortable: true},

                                                  { header: "Subject Code", width: 100, sortable: true, dataIndex: "SUBJCODE" },
                                                  { header: "Description", width: 250, sortable: true, dataIndex: "COURSEDESC" },
                                                  { header: "Units", width: 50, sortable: true, dataIndex: "UNITS_TTL" },
                                                  { header: "Days", width: 100, sortable: true, dataIndex: "DAYS" },
                                                  { header: "Time", width: 100, sortable: true, dataIndex: "TIME" },
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
                            //gradeView.app.Edit();
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
 					 	}
 	    			 ]
 	    	});
                /*grid.on("afterrender", function(component) {
                 component.getBottomToolbar().refresh.hideParent = true;
                 component.getBottomToolbar().refresh.hide();
                });*/


 			gradeView.app.Grid = grid;
 			//gradeView.app.Grid.getStore().load({params:{start: 0, limit: 25}});

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
 		        items: [  
                            {

 					xtype:'fieldset',

 					width:'auto',
 					height:'auto',
 					items:[

                                            {
			            layout:'column',
			            width: 'auto',
			            items: [
                                        {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [gradeView.app.semesterCombo()
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [gradeView.app.studentCombo()
                                              ]
                                              }
                                    ]
                                }


 		        ]
 					},

                            {
 					xtype:'fieldset',
 					
 					width:'auto',
 					height:'auto',
 					items:[
                                            
                                            {
			            layout:'column',
			            width: 'auto',
			            items: [
                                        {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [{

                                                  xtype:'textfield',
                                                  fieldLabel: 'First Name',
                                                  name: 'FIRSTNAME',
	 	  	 	 		  //  allowBlank:false,
                                                  readOnly: true,
                                                  anchor:'95%',  // anchor width by percentage
	 	  	 	 		  id: 'FIRSTNAME'

                                                  },
                                                  {

                                                  xtype:'textfield',
                                                  fieldLabel: 'Course',
                                                  name: 'COURSE',
	 	  	 	 		  //  allowBlank:false,
                                                  readOnly: true,
                                                  anchor:'95%',  // anchor width by percentage
	 	  	 	 		  id: 'COURSE'

                                                  }
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [{
	 	  	 	 			 					xtype:'textfield',
	 	  	 	 			 		            fieldLabel: 'Middle Name',
	 	  	 	 			 		            name: 'MIDDLENAME',
	 	  	 	 			 		            //  allowBlank:false,
                                                                                    readOnly: true,
	 	  	 	 			 		            anchor:'95%',  // anchor width by percentage
	 	  	 	 			 		            id: 'MIDDLENAME'
	 	  	 	 			 		        },
                                                        {

                                                  xtype:'textfield',
                                                  fieldLabel: 'Year',
                                                  name: 'YEAR',
	 	  	 	 		  //  allowBlank:false,
                                                  readOnly: true,
                                                  anchor:'95%',  // anchor width by percentage
	 	  	 	 		  id: 'YEAR'

                                                  }
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [{
	 	  	 	 			 					xtype:'textfield',
	 	  	 	 			 		            fieldLabel: 'Last Name',
	 	  	 	 			 		            name: 'LASTNAME',
	 	  	 	 			 		          //  allowBlank:false,
                                                                                  readOnly: true,
	 	  	 	 			 		            anchor:'95%',  // anchor width by percentage
	 	  	 	 			 		            id: 'LASTNAME'
	 	  	 	 			 		        },
                                                   {

                                                  xtype:'textfield',
                                                  fieldLabel: 'Section',
                                                  name: 'SECTION',
	 	  	 	 		  //  allowBlank:false,
                                                  readOnly: true,
                                                  anchor:'95%',  // anchor width by percentage
	 	  	 	 		  id: 'SECTION'

                                                  }
                                              ]
                                              }
                                    ]
                                }


 		        ]
 					}
 		        ],
                        buttons: [{
 		         	text: 'Load Grades',
                                icon: '<?=base_url()?>images/icons/arrow_rotate_clockwise.png',
 	                handler: function () {
                            if(ExtCommon.util.validateFormFields(_form)){//check if all forms are filled up
                            gradeView.app.Grid.getStore().reload({params:{studentId: Ext.getCmp('student').getValue()}});
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
                             gradeView.app.Grid
                             
                         ],
 		        resizable: false

 			    /*listeners : {
 				    	  close: function(p){
 					    	  window.location="../"
 					      }
 			       	} */
 	        });

                var teacherStore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?=site_url("faculty/getGradesPerSubject")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "id"},
                                                                                        { name: "STUDCODE"},
 											{ name: "STUDIDNO"},
                                                                                        { name: "IDNO"},
                                                                                        { name: "NAME"},
                                                                                        { name: "PRELIM"},
                                                                                        { name: "MIDTERM"},
                                                                                        { name: "FINAL"},
                                                                                        { name: "REMARKS"},
                                                                                        { name: "AVERAGE"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});

                                        var fm = Ext.form;

 			var teacherGrid = new Ext.grid.GridPanel({
 				id: 'teacherGrid',
 				height: 300,
                                title: "Student Grades",
 				width: 'auto',
 				border: true,
 				ds: teacherStore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                                                  { header: "Id No.", width: 100, sortable: true, dataIndex: "IDNO" },
                                                  { header: "Student Name", width: 300, sortable: true, dataIndex: "NAME" },
                                                  { header: "Prelim", width: 75, sortable: true, dataIndex: "PRELIM", renderer: this.gradeFormat, editor: new fm.NumberField({
                              allowBlank: false
                          }) },
                                                  { header: "Midterm", width: 75, sortable: true, dataIndex: "MIDTERM", renderer: this.gradeFormat, editor: new fm.NumberField({
                              allowBlank: false
                          }) },
                                                  { header: "Final", width: 75, sortable: true, dataIndex: "FINAL", renderer: this.gradeFormat, editor: new fm.NumberField({
                              allowBlank: false
                          }) },
                                                  { header: "Average", width: 75, sortable: true, renderer: this.gradeFormat, dataIndex: "AVERAGE" },
                                                  { header: "Remarks", width: 120, sortable: true, renderer: this.remarksFormat, dataIndex: "REMARKS" }

 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,
				bbar:
 	        		new Ext.PagingToolbar({
 		        		autoShow: true,
 				        pageSize: 25,
 				        store: teacherStore,
 				        displayInfo: true,
 				        displayMsg: 'Displaying Results {0} - {1} of {2}',
 				        emptyMsg: "No Data Found."
 				    }),
                                 listeners: {
			rowdblclick: function(grid, row, e){
                            //gradeView.app.Edit();
                        }
                        }
 	    	});



 			gradeView.app.teacherGrid = teacherGrid;
 			//gradeView.app.Grid.getStore().load({params:{start: 0, limit: 25}});

 			//var msgbx = Ext.MessageBox.wait("Redirecting to main page. . .","Status");
                        var topTenStore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?php echo site_url("gradeViewing/getTopTen"); ?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "teacherStore",
 								totalProperty: "totalCount",
 								fields: [
 											
                                                                                        { name: "rank"},
                                                                                        { name: "IDNO"},
                                                                                        { name: "NAME"},
                                                                                        { name: "AVERAGE"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});



 			var topTenGrid = new Ext.grid.GridPanel({
 				id: 'topTenGrid',
                                title: "Top Ten Students",
 				height: 300,
 				width: 'auto',
 				border: true,
 				ds: topTenStore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                                                  { header: "Rank", dataIndex: "rank", width: 35, sortable: true},
 						  { header: "Id No.", dataIndex: "IDNO", width: 75, sortable: true},
                                                  { header: "Student Name", width: 300, sortable: true, dataIndex: "NAME" },
                                                  { header: "Average", width: 60, sortable: true, dataIndex: "AVERAGE", renderer: this.gradeFormat }

 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,

                                 listeners: {
			rowdblclick: function(grid, row, e){
                            //gradeView.app.Edit();
                        }
                        }
 	    	});
                gradeView.app.topTenGrid = topTenGrid;
                    var teacherForm = new Ext.form.FormPanel({
 		        labelWidth: 80,
 		        url:"<?php echo site_url("hr/insertEmployee"); ?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,
                        id: 'teacherForm',
                       // autoScroll: true,
                       // width: 900,
 		        items: [ {
 					xtype:'fieldset',

 					width:'auto',
 					height:'auto',
 					items:[

                                            {
			            layout:'column',
			            width: 'auto',
			            items: [
                                        {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [
                                                      gradeView.app.teacherCombo(),
                                                           gradeView.app.teacherSubjectCombo()
                                                  
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [ gradeView.app.semesterCombo2(),
                                                           {
                                                               xtype: 'textfield',
                                                               id: 'COURSEDESC',
                                                               name: 'COURSEDESC',
                                                               anchor: '95%',
                                                               readOnly: true,
                                                               fieldLabel: 'Description'
                                                           }
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [
                                                   gradeView.app.teacherCourseCombo()
                                              ]
                                              }
                                    ]
                                }


 		        ]
 					}
 		        ],
                        buttons: [{
 		         	text: 'Load Grades',
                                icon: '<?=base_url()?>images/icons/arrow_rotate_clockwise.png',
 	                handler: function () {
                            if(ExtCommon.util.validateFormFields(teacherForm)){//check if all forms are filled up
                            gradeView.app.teacherGrid.getStore().load();
                            gradeView.app.topTenGrid.getStore().load();
                                }else return;





 	                }
 	            }]
 		    });

                var teacher_window = new Ext.Panel({
 		        width: '100%',
 		        height:490,
 		        //renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'form',
                        items:[ teacherForm,
                        {layout: 'column',
                         items:[
                             {columnWidth: .33,
                                 layout: 'fit',

                             items:gradeView.app.topTenGrid

                             },
                             {
                             columnWidth: .67,
                             layout: 'fit',
                             items: teacherGrid
                             }
                         ]
                        }

                         ],
 		        resizable: false

 			    /*listeners : {
 				    	  close: function(p){
 					    	  window.location="../"
 					      }
 			       	} */
 	        });

                var subjectStore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?php echo site_url("faculty/getGradesPerSubject"); ?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "subjectStore",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "id"},
                                                                                        { name: "STUDCODE"},
 											{ name: "STUDIDNO"},
                                                                                        { name: "IDNO"},
                                                                                        { name: "NAME"},
                                                                                        { name: "PRELIM"},
                                                                                        { name: "MIDTERM"},
                                                                                        { name: "FINAL"},
                                                                                        { name: "REMARKS"},
                                                                                        { name: "SUBJCODE"},
 																						{ name: "COURSEDESC"},
                                                                                        { name: "AVERAGE"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});



 			var subjectGrid = new Ext.grid.GridPanel({
 				id: 'subjectGrid',
 				height: 305,
 				width: 'auto',
 				border: true,
 				ds: subjectStore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 												  { header: "Subject Code", width: 100, sortable: true, dataIndex: "SUBJCODE" },
                                                  { header: "Description", width: 250, sortable: true, dataIndex: "COURSEDESC" },
                                                  { header: "Id No.", width: 100, sortable: true, dataIndex: "IDNO" },
                                                  { header: "Student Name", width: 300, sortable: true, dataIndex: "NAME" },
 						 // { header: "Semester", width: 150, sortable: true, dataIndex: "SEMESTER" },
                                                  //{ header: "Subject Code", width: 100, sortable: true, dataIndex: "SEMESTER" },
                                                 // { header: "Subject Description", width: 150, sortable: true, dataIndex: "SEMESTER" },
                                                  { header: "Prelim", width: 75, sortable: true, dataIndex: "PRELIM", renderer: this.gradeFormat, editor: new fm.NumberField({
                              allowBlank: false
                          }) },
                                                  { header: "Midterm", width: 75, sortable: true, dataIndex: "MIDTERM", renderer: this.gradeFormat, editor: new fm.NumberField({
                              allowBlank: false
                          }) },
                                                  { header: "Final", width: 75, sortable: true, dataIndex: "FINAL", renderer: this.gradeFormat, editor: new fm.NumberField({
                              allowBlank: false
                          }) },
                                                  { header: "Average", width: 75, sortable: true, renderer: this.gradeFormat, dataIndex: "AVERAGE" },
                                                  { header: "Remarks", width: 150, sortable: true, renderer: this.remarksFormat, dataIndex: "REMARKS" }

 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,
 	        	bbar:
 	        		new Ext.PagingToolbar({
 		        		autoShow: true,
 				        pageSize: 25,
 				        store: subjectStore,
 				        displayInfo: true,
 				        displayMsg: 'Displaying Results {0} - {1} of {2}',
 				        emptyMsg: "No Data Found."
 				    }),

                                 listeners: {
			rowdblclick: function(grid, row, e){
                            //gradeView.app.Edit();
                        }
                        }
 	    	});



 			gradeView.app.subjectGrid = subjectGrid;
 			//gradeView.app.Grid.getStore().load({params:{start: 0, limit: 25}});

 			//var msgbx = Ext.MessageBox.wait("Redirecting to main page. . .","Status");


                    var subjectForm = new Ext.form.FormPanel({
 		        labelWidth: 80,
 		        url:"<?php echo site_url("hr/insertEmployee"); ?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,
                        id: 'subjectForm',
                       // autoScroll: true,
                       // width: 900,
 		        items: [ {
 					xtype:'fieldset',

 					width:'auto',
 					height:'auto',
 					items:[

                                            {
			            layout:'column',
			            width: 'auto',
			            items: [
                                        {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [gradeView.app.semesterCombo3()

                                              ]
                                              },
                                              {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [
                                                           gradeView.app.courseCombo3()
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [
                                                           gradeView.app.subjectCombo3(),
                                                           {
                                                               xtype: 'textfield',
                                                               id: 'COURSEDESC3',
                                                               name: 'COURSEDESC3',
                                                               anchor: '95%',
                                                               readOnly: true,
                                                               fieldLabel: 'Description'
                                                           }
                                              ]
                                              }
                                    ]
                                }


 		        ]
 					}
 		        ],
                        buttons: [{
 		         	text: 'Load Grades',
                                icon: '<?=base_url()?>images/icons/arrow_rotate_clockwise.png',
 	                handler: function () {
                            if(ExtCommon.util.validateFormFields(subjectForm)){//check if all forms are filled up
                            
                                gradeView.app.subjectGrid.getStore().reload({params:{subjectId: Ext.getCmp('SUBJECT3').getValue(), courseId: Ext.getCmp('COURSE3').getValue()}});
				
                            }else return;





 	                }
 	            }]
 		    });

                var subject_window = new Ext.Panel({
 		        width: 'auto',
 		        height:510,
 		        //renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'form',
                        items:[subjectForm, gradeView.app.subjectGrid

                         ],
 		        resizable: false

 			    /*listeners : {
 				    	  close: function(p){
 					    	  window.location="../"
 					      }
 			       	} */
 	        });

 	       // _window.render();
            /*   var accordion = new Ext.Panel({
                renderTo: 'mainBody',
                width: '100%',
                height: 490,
                title: 'Grade Viewing',
               // margins:'5 0 5 5',
                //split:true,
               // width: 210,
                layout:'accordion',
                items: [_window, teacher_window, subject_window]
            }).render();*/

            var tabs = new Ext.TabPanel({
		        renderTo: 'mainBody',
		        width:'100%',
		        activeTab: 0,
		        frame:true,
		        height: 480,
                       // layout: 'fit',
		        //defaults:{autoHeight: true},
		        items:[
		            {title: 'By Student', items: _window},
		            {title: 'By Teacher', items: teacher_window},
                            {title: 'By Subject', items: [subject_window]}
		        ],
		        listeners: {
		        	tabchange: function(panel, tab){
		        		if(panel.items.indexOf(panel.getActiveTab()) == 0){
		        		_form.form.load({
							url:"<?php echo site_url("admin/loadActiveSemester"); ?>",
							waitMsg:'Loading...',
							success: function(f, action){
                                 Ext.get("SEMEIDNO").dom.value = action.result.data.SEMEIDNO;
                                 gradeView.app.Grid.getStore().setBaseParam("SEMEIDNO", action.result.data.SEMEIDNO);
                        		
							}

						});

		        		}else{
		        			if(panel.items.indexOf(panel.getActiveTab()) == 1){
		        			_form.form.load({
							url:"<?php echo site_url("admin/loadActiveSemester"); ?>",
							waitMsg:'Loading...',
							success: function(f, action){
								 Ext.getCmp("semester2").setValue(action.result.data.semester);
                                 Ext.get("SEMEIDNO2").dom.value = action.result.data.SEMEIDNO;
                                 
                                 gradeView.app.teacherGrid.getStore().setBaseParam("SEMEIDNO", action.result.data.SEMEIDNO);
                        		 gradeView.app.topTenGrid.getStore().setBaseParam("SEMEIDNO", action.result.data.SEMEIDNO);
                        		 Ext.getCmp("TEACHERCOURSE").enable().focus();
							}

							});
		        			}else{
		        			if(panel.items.indexOf(panel.getActiveTab()) == 2){
		        			_form.form.load({
							url:"<?php echo site_url("admin/loadActiveSemester"); ?>",
							waitMsg:'Loading...',
							success: function(f, action){
								 Ext.getCmp("SEMESTER3").setValue(action.result.data.semester);
                                 Ext.get("SEMEIDNO3").dom.value = action.result.data.SEMEIDNO;
                                 gradeView.app.subjectGrid.getStore().setBaseParam("SEMEIDNO", action.result.data.SEMEIDNO);
                                 
							}

							});
		        			}
		        		}
		        		}
		        	}
		        }
		    }).render();


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
			url: "<?php echo site_url("faculty/getSemesterCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
                        beforequery: function(qe)
					{

						delete qe.combo.lastQuery;
                       
					},

			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
                        gradeView.app.Grid.getStore().setBaseParam("SEMEIDNO", record.get("id"));
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
        semesterCombo2: function(){

		return {
			xtype:'combo',
			id:'semester2',
			hiddenName: 'SEMEIDNO2',
                        hiddenId: 'SEMEIDNO2',
			name: 'semester2',
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
			url: "<?php echo site_url("faculty/getSemesterCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
                        beforequery: function(qe)
					{
						delete qe.combo.lastQuery;

					},

			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
                        gradeView.app.teacherGrid.getStore().setBaseParam("SEMEIDNO", record.get("id"));
                        gradeView.app.topTenGrid.getStore().setBaseParam("SEMEIDNO", record.get("id"));
                        //Ext.getCmp("teacherRoom").setValue(record.get('room'));
                        Ext.getCmp("TEACHERCOURSE").enable().focus();

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
        courseCombo3: function(){

		return {
			xtype:'combo',
			id:'COURSE3',
			hiddenName: 'COURIDNO3',
                        hiddenId: 'COURIDNO3',
			name: 'COURSE3',
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
			url: "<?php echo site_url("faculty/getCourseCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {

                        beforequery: function(qe)
					{

                                    Ext.get("SUBJIDNO3").dom.value  = '';
                                    Ext.getCmp("SUBJECT3").setRawValue("");
                                    Ext.getCmp('COURSEDESC3').setRawValue('');
                                    if (Ext.get('SEMEIDNO3').dom.value == "")
					return false;

			            delete qe.combo.lastQuery;
					},
			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
			Ext.getCmp("SUBJECT3").enable().focus();
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
                        Ext.get("SUBJIDNO").dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Course*'

			}
	},
        
        studentCombo: function(){

		return {
			xtype:'combo',
			id:'student',
			hiddenName: 'STUDIDNO',
                        hiddenId: 'STUDIDNO',
			name: 'studentName',
			valueField: 'id',
			displayField: 'name',
			//width: 100,
			anchor: '95%',
                       // disabled: true,
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
			fields:[{name: 'id'}, {name: 'name'}, {name: 'STUDIDNO'}],
			url: "<?php echo site_url("studentProfile/getStudent"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
				beforequery: function(qe){
					this.store.setBaseParam("SEMEIDNO", Ext.get('SEMEIDNO').dom.value);
					delete qe.combo.lastQuery;
				},
			select: function (combo, record, index){
			
                        gradeView.app.Grid.getStore().setBaseParam("STUDIDNO", record.get("STUDIDNO"));
                       
                            Ext.getCmp('studentForm').getForm().load({
				url: '<?php echo site_url("studentProfile/loadStudent"); ?>',
                                params:{id: record.get('STUDIDNO'), SEMEIDNO: Ext.get('SEMEIDNO').dom.value},
                                method: 'POST',
				success: function(f,a){
                                    Ext.getCmp("student").setRawValue(a.result.data.NAME);
				},
				failure: function(f,a){

				},
				waitMsg: 'Loading data...'
				});
                        this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');

			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a student'});

			},
			keypress: {buffer: 100, fn: function() {
			//Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Student*'

			}
	},
        teacherCombo: function(){

		return {
			xtype:'combo',
			id:'teacher',
			hiddenName: 'teacherId',
                        hiddenId: 'teacherId',
			name: 'teacherName',
			valueField: 'id',
			displayField: 'name',
			//width: 100,
			anchor: '95%',
                       // disabled: true,
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
			url: "<?php echo site_url("filereference/getAdviserCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
                            beforequery: function(qe){
                            
                              Ext.getCmp('TEACHERSUBJECT').setValue('');
                              Ext.getCmp('COURSEDESC').setValue('');
                              delete qe.combo.lastQuery;
                            },

			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
                       // Ext.getCmp("teacherSubject").setValue("");


			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for an instructor'});

			},
			keypress: {buffer: 100, fn: function() {
			//Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Instructor*'

			}
	},
        teacherCourseCombo: function(){

		return {
			xtype:'combo',
			id:'TEACHERCOURSE',
			hiddenName: 'COURIDNO2',
                        hiddenId: 'COURIDNO2',
			name: 'TEACHERCOURSE',
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
			disabled: true,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id'}, {name: 'name'}],
			url: "<?php echo site_url("faculty/getCourseCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {

                        beforequery: function(qe)
					{

                                    Ext.get("SUBJIDNO2").dom.value  = '';
                                    Ext.getCmp("TEACHERSUBJECT").setRawValue("");
                                    Ext.getCmp('COURSEDESC').setValue('');
                                    if (Ext.get('SEMEIDNO2').dom.value == ""){
                                    	//Ext.getCmp("semester2").validate().focus();
										return false;
									}
									
									delete qe.combo.lastQuery;

			            
					},
			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
			Ext.getCmp("TEACHERSUBJECT").enable().focus();

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
                        Ext.get("SUBJIDNO").dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Course*'

			}
	},
        teacherSubjectCombo: function(){

		return {
			xtype:'combo',
			id:'TEACHERSUBJECT',
			hiddenName: 'SUBJIDNO2',
                        hiddenId: 'SUBJIDNO2',
			name: 'TEACHERSUBJECT',
			valueField: 'id',
			displayField: 'name',
			//width: 100,
			anchor: '95%',
			triggerAction: 'all',
			minChars: 2,
			forceSelection: true,
			enableKeyEvents: true,
			pageSize: 10,
			disabled: true,
			resizable: true,
			readOnly: false,
			minListWidth: 300,
			allowBlank: false,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id'}, {name: 'name'}, {name: 'description'}],
			url: "<?php echo site_url("faculty/getSubjectCombo"); ?>",
			baseParams: {start: 0, limit: 10},
			listeners:{
				load: function(store, rec){
					if(store.getTotalCount() == 0)
						Ext.Msg.show({
  								     title: 'Status',
 								     msg: "No subjects under this adviser/course for the selected semester",
  								     buttons: Ext.Msg.OK,
  								     icon: Ext.Msg.INFO
  								 });
				}
			}

			}),
			listeners: {
                        beforequery: function(qe)
					{
						if (Ext.get("COURIDNO2").dom.value == ""){
							Ext.getCmp("TEACHERCOURSE").validate().focus();
							return false;
						}
						delete qe.combo.lastQuery;
				    this.store.baseParams = {course_id: Ext.get("COURIDNO2").dom.value, semester_id: Ext.get("SEMEIDNO2").dom.value,  ADVIIDNO: Ext.get("teacherId").dom.value};

			            /*var o = {start: 0, limit:10};
			            this.store.baseParams = this.store.baseParams || {};
			            this.store.baseParams[this.paramName] = '';
			            this.store.load({params:o, timeout: 300000});*/
					},

			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
                        Ext.getCmp("COURSEDESC").setValue(record.get('description'));
                        gradeView.app.teacherGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));
                        gradeView.app.topTenGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));


			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a subject'});

			},
			keypress: {buffer: 100, fn: function() {
			Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Subject Code*'

			}
	},
       
        
        subjectCombo: function(){

		return {
			xtype:'combo',
			id:'SUBJECT',
			hiddenName: 'SUBJIDNO',
                        hiddenId: 'SUBJIDNO',
			name: 'SUBJECT',
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
			fields:[{name: 'id'}, {name: 'name'}, {name: 'description'}],
			url: "<?php echo site_url("faculty/getSubjectCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
                        beforequery: function(qe)
					{
						if (Ext.get("COURIDNO2").dom.value == "")
							return false;
					delete qe.combo.lastQuery;	
				    this.store.baseParams = {course_id: Ext.get("COURIDNO2").dom.value, semester_id: Ext.get("SEMEIDNO2").dom.value,  ADVIIDNO: Ext.get("teacherId").dom.value};
					
			            
					},

			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
                        Ext.getCmp("COURSEDESC").setValue(record.get('description'));
                        gradeView.app.teacherGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));
                        gradeView.app.topTenGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));


			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a subject'});

			},
			keypress: {buffer: 100, fn: function() {
			Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Subject*'

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
                semesterCombo3: function(){

		return {
			xtype:'combo',
			id:'SEMESTER3',
			hiddenName: 'SEMEIDNO3',
                        hiddenId: 'SEMEIDNO3',
			name: 'SEMESTER3',
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
			url: "<?php echo site_url("faculty/getSemesterCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
                        beforequery: function(qe)
					{

                                        Ext.get("SUBJIDNO3").dom.value  = '';
                                    Ext.getCmp("SUBJECT3").setRawValue("");
                                    delete qe.combo.lastQuery;
                              
					},

			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
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
        subjectCombo3: function(){

		return {
			xtype:'combo',
			id:'SUBJECT3',
			hiddenName: 'SUBJIDNO3',
                        hiddenId: 'SUBJIDNO3',
			name: 'SUBJECT3',
			valueField: 'id',
			displayField: 'name',
			//width: 100,
			anchor: '95%',
			triggerAction: 'all',
			minChars: 2,
			forceSelection: true,
			enableKeyEvents: true,
			pageSize: 10,
			disabled: true,
			resizable: true,
			readOnly: false,
			minListWidth: 300,
			allowBlank: false,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id'}, {name: 'name'}, {name: 'description'}],
			url: "<?php echo site_url("faculty/getSubjectCombo"); ?>",
			baseParams: {start: 0, limit: 10},
			listeners:{
				load: function(store, rec){
					if(store.getTotalCount() == 0)
						Ext.Msg.show({
  								     title: 'Status',
 								     msg: "No subjects under this course for the selected semester",
  								     buttons: Ext.Msg.OK,
  								     icon: Ext.Msg.INFO
  								 });
				}
			}

			}),
			listeners: {
                        beforequery: function(qe)
					{
						if (Ext.get("COURIDNO3").dom.value == "")
							return false;
					delete qe.combo.lastQuery;
				    this.store.baseParams = {course_id: Ext.get("COURIDNO3").dom.value, semester_id: Ext.get("SEMEIDNO3").dom.value};

			            /*var o = {start: 0, limit:10};
			            this.store.baseParams = this.store.baseParams || {};
			            this.store.baseParams[this.paramName] = '';
			            this.store.load({params:o, timeout: 300000});*/
					},

			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
                        Ext.getCmp("COURSEDESC3").setValue(record.get('description'));
                        gradeView.app.subjectGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));


			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a subject'});

			},
			keypress: {buffer: 100, fn: function() {
			Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Subject Code*'

			}
	}//end of functions
 	}

 }();

 Ext.onReady(gradeView.app.init, gradeView.app);

</script>

<div id="mainBody">
</div>