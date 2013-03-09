<script type="text/javascript">
 Ext.namespace("ogs_admin_attendance_view");
 ogs_admin_attendance_view.app = function()
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
 							url: "<?php echo site_url("admin/getAttendancePerStudent"); ?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "id"},
 											{ name: "STUDIDNO"},
                                                                                        { name: "DAY"},
                                                                                        { name: "ADVISER"},
                                                                                        { name: "IDNO"},
                                                                                        { name: "NAME"},
                                                                                        {name: "STATUS"},
                                                                                        {name: "SUBJCODE"},
                                                                                        {name: "COURSEDESC"},
                                                                                        {name: "SCHEDULEDATE"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});



 			var grid = new Ext.grid.GridPanel({
 				id: 'gradeViewgrid',
 				height: 270,
 				width: 'auto',
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 						  //{ header: "Id", dataIndex: "id", width: 100, sortable: true},
												  { header: "Subject Code", width: 100, sortable: true, dataIndex: "SUBJCODE" },
												  { header: "Description", width: 200, sortable: true, dataIndex: "COURSEDESC" },
												  { header: "Adviser", width: 250, sortable: true, dataIndex: "ADVISER" },
                                                  { header: "Date", width: 75, sortable: true, dataIndex: "SCHEDULEDATE" },
                                                  { header: "Day", width: 75, sortable: true, dataIndex: "DAY" },
                                                  { header: "Status", width: 120, sortable: true, dataIndex: "STATUS", renderer: this.remarksFormat}

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


 			ogs_admin_attendance_view.app.Grid = grid;
			ogs_admin_attendance_view.app.Grid.store.on('load', function(store, records, options) {
  ogs_admin_attendance_view.app.studentAttendanceSummaryGrid.getStore().load();
}, ogs_admin_attendance_view.app.Grid);
			var studentAttendanceSummaryStore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?php echo site_url("admin/getStudentAttendanceSummary"); ?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "studentCourseSummaryStore",
 								totalProperty: "totalCount",
 								fields: [
 											
                                                                                        { name: "SUBJCODE"},
                                                                                        { name: "ABSENT"},
                                                                                        { name: "PRESENT"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});
 			
 			var studentAttendanceSummaryGrid = new Ext.grid.GridPanel({
 				id: 'studentattendancesummarygrid',
                 //               title: "Summary",
 				height: 260,
 				width:  'auto',
 				border: true,
 				ds: studentAttendanceSummaryStore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                                                  { header: "Subject", dataIndex: "SUBJCODE", width: 110, sortable: true},
 						  { header: "Present", dataIndex: "PRESENT", width: 110, sortable: true},
 						  { header: "Absent", dataIndex: "ABSENT", width: 110, sortable: true}

 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,

                                 listeners: {
			rowdblclick: function(grid, row, e){
                            //ogs_admin_attendance_view.app.Edit();
                        }
                        }
 	    	});
            
            ogs_admin_attendance_view.app.studentAttendanceSummaryGrid = studentAttendanceSummaryGrid;
                    

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
	 	 			          items: [ogs_admin_attendance_view.app.semesterCombo()
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [ogs_admin_attendance_view.app.studentCombo()
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.17,
	 	 			          layout: 'form',
	 	 			          items: [{
                                                            xtype: 'datefield',
                                                            name: 'date_from',
                                                            id: 'date_from',
                                                            format: 'Y-m-d',
                                                            fieldLabel: 'Date From*',
                                                            allowBlank: false,
                                                            anchor: '95%',
                                                            msgTarget: 'qtip',
                                                            vtype: 'daterange',
                                                            endDateField: 'date_to',
                                                            listeners:{
                                                                change: function(){
				                		//requests.app.setNoOfDays();
                                                            },
                                                                blur: function(){
					                  	//requests.app.setNoOfDays();
                                                            },
                                                            select: function(){
                                                                ogs_admin_attendance_view.app.Grid.getStore().setBaseParam("date_from", this.getRawValue());
                                                                ogs_admin_attendance_view.app.studentAttendanceSummaryGrid.getStore().setBaseParam("date_from", this.getRawValue());
                                                            }
                                                            }
                                                       }
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.17,
	 	 			          layout: 'form',
	 	 			          items: [{
                                                            xtype: 'datefield',
                                                            name: 'date_to',
                                                            id: 'date_to',
                                                            format: 'Y-m-d',
                                                            fieldLabel: 'Date To*',
                                                            allowBlank: false,
                                                            msgTarget: 'qtip',
                                                            anchor: '95%',
                                                            vtype: 'daterange',
                                                            startDateField: 'date_from',
                                                            listeners:{
                                                                change: function(){
				                		//requests.app.setNoOfDays();
                                                            },
                                                                blur: function(){
					                  	//requests.app.setNoOfDays();
                                                            },
                                                            select: function(){
                                                                ogs_admin_attendance_view.app.Grid.getStore().setBaseParam("date_to", this.getRawValue());
                                                                ogs_admin_attendance_view.app.studentAttendanceSummaryGrid.getStore().setBaseParam("date_to", this.getRawValue());
                                                            }
                                                            }
                                                       }
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
	 	 			          items: [
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
	 	 			          items: [
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
	 	 			          items: [
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
 		         	text: 'Load Attendance',
                                icon: '/images/icons/arrow_rotate_clockwise.png',
 	                handler: function () {
                            if(ExtCommon.util.validateFormFields(_form)){//check if all forms are filled up
                            ogs_admin_attendance_view.app.Grid.getStore().load();
                            }else return;

                           


 	                }
 	            }]
 		    });

 			var _window = new Ext.Panel({
 		        width: 'auto',
 		        height:510,
 		        //renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'form',
 		        frame: true,
                        items:[ _form,
                        {layout: 'column',
                         items:[
                             {columnWidth: .67,
                                 layout: 'form',

                             items:ogs_admin_attendance_view.app.Grid

                             },
                             {
                             columnWidth: .33,
                             layout: 'form',
                             style: 'marginLeft: 10px',
                             items: { xtype: 'fieldset', title: 'Summary', anchor: '100%', height: 270, items: [ogs_admin_attendance_view.app.studentAttendanceSummaryGrid]}
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

                var teacherStore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?=site_url("admin/getAttendancePerAdviser")?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "id",
 								totalProperty: "totalCount",
 								fields: [
 											{ name: "id"},
 											{ name: "STUDIDNO"},
                                                                                        { name: "DAY"},
                                                                                        { name: "ADVISER"},
                                                                                        { name: "IDNO"},
                                                                                        { name: "NAME"},
                                                                                        {name: "STATUS"},
                                                                                        {name: "SUBJCODE"},
                                                                                        {name: "SCHEDULEDATE"},
                                                                                        {name: "IDNO"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});

                                        var fm = Ext.form;

 			var teacherGrid = new Ext.grid.GridPanel({
 				id: 'teacherGrid',
 				height: 330,
                               
 				width: 'auto',
 				border: true,
 				ds: teacherStore,
 				cm:  new Ext.grid.ColumnModel(
 						[{ header: "Subject Code", width: 100, sortable: true, dataIndex: "SUBJCODE" },
												  { header: "Description", width: 200, sortable: true, dataIndex: "SUBJCODE" },
												  { header: "Adviser", width: 250, sortable: true, dataIndex: "ADVISER" },
												  { header: "Id No.", width: 100, sortable: true, dataIndex: "IDNO" },
												  { header: "Student Name", width: 300, sortable: true, dataIndex: "NAME" },
                                                  { header: "Date", width: 75, sortable: true, dataIndex: "SCHEDULEDATE" },
                                                  { header: "Day", width: 75, sortable: true, dataIndex: "DAY" },
                                                  { header: "Status", width: 120, sortable: true, dataIndex: "STATUS", renderer: this.remarksFormat}

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
                            //ogs_admin_attendance_view.app.Edit();
                        }
                        },
                        tbar: [new Ext.form.ComboBox({
                    fieldLabel: 'Search',
                    hiddenName:'searchby-form-teacher',
                    id: 'searchbyteacher',
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

			ogs_admin_attendance_view.app.teacherGrid = teacherGrid;
			
			ogs_admin_attendance_view.app.teacherGrid.store.on('load', function(store, records, options) {
  ogs_admin_attendance_view.app.adviserSummaryGrid.getStore().load();
}, ogs_admin_attendance_view.app.teacherGrid);

 			var adviserSummaryStore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?php echo site_url("admin/getAdviserAttendanceSummary"); ?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "adviserSummaryStore",
 								totalProperty: "totalCount",
 								fields: [
 											
                                                                                        { name: "SUBJCODE"},
                                                                                        { name: "ABSENT"},
                                                                                        { name: "ADVISER"},
                                                                                        { name: "PRESENT"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});
 			
 			var adviserSummaryGrid = new Ext.grid.GridPanel({
 				id: 'advisersummarygrid',
                 //               title: "Summary",
 				height: 290,
 				width:  'auto',
 				border: true,
 				ds: adviserSummaryStore,
 				cm:  new Ext.grid.ColumnModel(
 						[new Ext.grid.RowNumberer(),
                                                  { header: "Subject", dataIndex: "SUBJCODE", width: 110, sortable: true},
                                                  { header: "Adviser", dataIndex: "ADVISER", width: 200, sortable: true},
 						  { header: "Present", dataIndex: "PRESENT", width: 60, sortable: true},
 						  { header: "Absent", dataIndex: "ABSENT", width: 60, sortable: true}

 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,

                                 listeners: {
			rowdblclick: function(grid, row, e){
                            //ogs_admin_attendance_view.app.Edit();
                        }
                        }
 	    	});
                ogs_admin_attendance_view.app.adviserSummaryGrid = adviserSummaryGrid;
                
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
	 	 			          items: [ogs_admin_attendance_view.app.semesterCombo2()
                                                      
                                                  
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [ ogs_admin_attendance_view.app.teacherCombo()
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.17,
	 	 			          layout: 'form',
	 	 			          items: [{
                                                            xtype: 'datefield',
                                                            name: 'date_from_adviser',
                                                            id: 'date_from_adviser',
                                                            format: 'Y-m-d',
                                                            fieldLabel: 'Date From*',
                                                            allowBlank: false,
                                                            anchor: '95%',
                                                            msgTarget: 'qtip',
                                                            vtype: 'daterange',
                                                            endDateField: 'date_to_adviser',
                                                            listeners:{
                                                                change: function(){
				                		//requests.app.setNoOfDays();
                                                            },
                                                                blur: function(){
					                  	//requests.app.setNoOfDays();
                                                            },
                                                            select: function(){
                                                                ogs_admin_attendance_view.app.teacherGrid.getStore().setBaseParam("date_from", this.getRawValue());
                                                                ogs_admin_attendance_view.app.adviserSummaryGrid.getStore().setBaseParam("date_from", this.getRawValue());
                                                            }
                                                            }
                                                       }
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.17,
	 	 			          layout: 'form',
	 	 			          items: [{
                                                            xtype: 'datefield',
                                                            name: 'date_to_adviser',
                                                            id: 'date_to_adviser',
                                                            format: 'Y-m-d',
                                                            fieldLabel: 'Date To*',
                                                            allowBlank: false,
                                                            msgTarget: 'qtip',
                                                            anchor: '95%',
                                                            vtype: 'daterange',
                                                            startDateField: 'date_from_adviser',
                                                            listeners:{
                                                                change: function(){
				                		//requests.app.setNoOfDays();
                                                            },
                                                                blur: function(){
					                  	//requests.app.setNoOfDays();
                                                            },
                                                            select: function(){
                                                                ogs_admin_attendance_view.app.teacherGrid.getStore().setBaseParam("date_to", this.getRawValue());
                                                                ogs_admin_attendance_view.app.adviserSummaryGrid.getStore().setBaseParam("date_to", this.getRawValue());
                                                            }
                                                            }
                                                       }
                                              ]
                                              }
                                    ]
                                }


 		        ]
 					}
 		        ],
                        buttons: [{
 		         	text: 'Load Attendance',
                                icon: '/images/icons/arrow_rotate_clockwise.png',
 	                handler: function () {
                            if(ExtCommon.util.validateFormFields(teacherForm)){//check if all forms are filled up
                            ogs_admin_attendance_view.app.teacherGrid.getStore().load();
                           // ogs_admin_attendance_view.app.topTenGrid.getStore().load();
                                }else return;





 	                }
 	            }]
 		    });

                var teacher_window = new Ext.Panel({
 		        width: '100%',
 		        height:490,
 		        //renderTo: 'mainBody',
 		        draggable: false,
 		        frame: true,
 		        layout: 'form',
                        items:[ teacherForm,
                        {layout: 'column',
                         items:[
                             {columnWidth: .67,
                                 layout: 'form',

                             items:teacherGrid

                             },
                             {
                             columnWidth: .33,
                             layout: 'form',
                             style: 'marginLeft: 10px',
                             items: { xtype: 'fieldset', title: 'Summary', anchor: '100%', height: 330, items: [ogs_admin_attendance_view.app.adviserSummaryGrid]}
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
 							url: "<?php echo site_url("admin/getStudentsPerSubject"); ?>",
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
                                                                                        { name: "YEAR"},
                                                                                        { name: "COURSE"},
                                                                                        { name: "SECTION"},
                                                                                        { name: "ADVISER"},
                                                                                        { name: "COURSEDESC"},
                                                                                        { name: "UNITS_TTL"},
                                                                                        { name: "SUBJCODE"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});



 			var subjectGrid = new Ext.grid.GridPanel({
 				id: 'subjectGrid',
 				height: 175,
 				width: 'auto',
 				border: true,
 				ds: subjectStore,
 				cm:  new Ext.grid.ColumnModel(
 						[						  { header: "Subject", width: 100, sortable: true, dataIndex: "SUBJCODE" },
 												  { header: "Description", width: 150, sortable: true, dataIndex: "COURSEDESC" },
 												  { header: "Units", width: 70, sortable: true, dataIndex: "UNITS_TTL" },
 												  { header: "Adviser", width: 150, sortable: true, dataIndex: "ADVISER" },
                                                  { header: "Student Id", width: 100, sortable: true, dataIndex: "STUDIDNO" },
                                                  { header: "Id No.", width: 100, sortable: true, dataIndex: "IDNO" },
                                                  { header: "Student Name", width: 250, sortable: true, dataIndex: "NAME" },
                                                  { header: "Course", width: 150, sortable: true, dataIndex: "COURSE" },
                                                  { header: "Year", width: 70, sortable: true, dataIndex: "YEAR" },
                                                  { header: "Section", width: 100, sortable: true, dataIndex: "SECTION" }

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
                            //ogs_admin_attendance_view.app.Edit();
                        }
                        },
                        tbar: [new Ext.form.ComboBox({
                    fieldLabel: 'Search',
                    hiddenName:'searchby-form-subject',
                    id: 'searchby-subject',
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
				},'   ', new Ext.app.SearchField({ store: subjectStore, width:250}),
 					    {
 					     	xtype: 'tbfill'
 					 	}
 	    			 ]
 	    	});



 			ogs_admin_attendance_view.app.subjectGrid = subjectGrid;
 			
 			var subjSummaryStore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?php echo site_url("admin/getSubjectSummary"); ?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "subjSummaryStore",
 								totalProperty: "totalCount",
 								fields: [
 											
                                                                                        { name: "DESCRIPTION"},
                                                                                        { name: "TOTAL"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});
 			
 			var subjectSummaryGrid = new Ext.grid.GridPanel({
 				id: 'subjsummarygrid',
                 //               title: "Summary",
 				height: 95,
 				width:  'auto',
 				border: true,
 				ds: subjSummaryStore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                                                  { header: "Description", dataIndex: "DESCRIPTION", width: 125, sortable: true},
 						  { header: "Total No. of Students", dataIndex: "TOTAL", width: 125, sortable: true}

 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,

                                 listeners: {
			rowdblclick: function(grid, row, e){
                            //ogs_admin_attendance_view.app.Edit();
                        }
                        }
 	    	});
                ogs_admin_attendance_view.app.subjectSummaryGrid = subjectSummaryGrid;
 			//ogs_admin_attendance_view.app.Grid.getStore().load({params:{start: 0, limit: 25}});

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
	 	 			          items: [ogs_admin_attendance_view.app.semesterCombo3()

                                              ]
                                              },
                                              {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [
                                                           ogs_admin_attendance_view.app.subjectCombo3()
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [
                                                           
                                                           {
                                                               xtype: 'textfield',
                                                               id: 'COURSEDESC3',
                                                               name: 'COURSEDESC3',
                                                               anchor: '95%',
                                                               readOnly: true,
                                                               fieldLabel: 'Description'
                                                           },
                                                           {
                                                               xtype: 'textfield',
                                                               id: 'UNITS_TTL3',
                                                               name: 'UNITS_TTL3',
                                                               anchor: '95%',
                                                               readOnly: true,
                                                               fieldLabel: 'Units'
                                                           }
                                              ]
                                              }
                                    ]
                                }


 		        ]
 					}
 		        ],
                        buttons: [{
 		         	text: 'Load Students',
                                icon: '/images/icons/arrow_rotate_clockwise.png',
 	                handler: function () {
                            if(ExtCommon.util.validateFormFields(subjectForm)){//check if all forms are filled up
                            
                                ogs_admin_attendance_view.app.subjectGrid.getStore().reload();
                                ogs_admin_attendance_view.app.subjectSummaryGrid.getStore().reload();
				
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
 		        frame: true,
                        items:[subjectForm, ogs_admin_attendance_view.app.subjectGrid, { xtype: 'fieldset', title: 'Summary', width: 320, height: 130, items: [ogs_admin_attendance_view.app.subjectSummaryGrid]}

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
                    {title: 'By Adviser', items: [teacher_window]}
		        ],
		        listeners: {
		        	tabchange: function(panel, tab){
		        		if(panel.items.indexOf(panel.getActiveTab()) == 0){
		        		_form.form.load({
							url:"<?php echo site_url("admin/loadActiveSemester"); ?>",
							waitMsg:'Loading...',
							success: function(f, action){
                                 Ext.get("SEMEIDNO").dom.value = action.result.data.SEMEIDNO;
                                 ogs_admin_attendance_view.app.Grid.getStore().setBaseParam("SEMEIDNO", action.result.data.SEMEIDNO);
                        		 ogs_admin_attendance_view.app.studentAttendanceSummaryGrid.getStore().setBaseParam("SEMEIDNO", action.result.data.SEMEIDNO);
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
                                 
                                 ogs_admin_attendance_view.app.teacherGrid.getStore().setBaseParam("SEMEIDNO", action.result.data.SEMEIDNO);
                        		 ogs_admin_attendance_view.app.adviserSummaryGrid.getStore().setBaseParam("SEMEIDNO", action.result.data.SEMEIDNO);
							}

							});
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
					Ext.get('STUDIDNO').dom.value = '';
					Ext.getCmp('student').setRawValue('');
					Ext.getCmp('COURSE').setRawValue('');
					Ext.getCmp('YEAR').setRawValue('');
					Ext.getCmp('SECTION').setRawValue('');
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
                        ogs_admin_attendance_view.app.Grid.getStore().setBaseParam("SEMEIDNO", record.get("id"));
                        ogs_admin_attendance_view.app.studentAttendanceSummaryGrid.getStore().setBaseParam("SEMEIDNO", record.get("id"));
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
                        ogs_admin_attendance_view.app.teacherGrid.getStore().setBaseParam("SEMEIDNO", record.get("id"));
                        ogs_admin_attendance_view.app.adviserSummaryGrid.getStore().setBaseParam("SEMEIDNO", record.get("id"));
                        //ogs_admin_attendance_view.app.topTenGrid.getStore().setBaseParam("SEMEIDNO", record.get("id"));
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

                                   // Ext.get("SUBJIDNO3").dom.value  = '';
                                   // Ext.getCmp("SUBJECT3").setRawValue("");
                                    if (Ext.get('SEMEIDNO').dom.value == "")
										return false;

			            delete qe.combo.lastQuery;
					},
			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
			ogs_admin_attendance_view.app.Grid.getStore().setBaseParam("COURIDNO", record.get('id'));

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
			url: "<?php echo site_url("ogs_admin_attendance_view/getSection"); ?>",
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
					this.getStore().setBaseParam("SEMEIDNO", Ext.get('SEMEIDNO').dom.value);
					delete qe.combo.lastQuery;
				},
			select: function (combo, record, index){
			
                        ogs_admin_attendance_view.app.Grid.getStore().setBaseParam("STUDIDNO", record.get("STUDIDNO"));
                        ogs_admin_attendance_view.app.studentAttendanceSummaryGrid.getStore().setBaseParam("STUDIDNO", record.get("STUDIDNO"));
                       
                            Ext.getCmp('studentForm').getForm().load({
				url: '<?php echo site_url("studentProfile/loadStudent"); ?>',
                                params:{id: record.get('STUDIDNO')},
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
			url: "<?php echo site_url("admin/getAdviserCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
                            beforequery: function(qe){
                             delete qe.combo.lastQuery;
                            },

			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
			ogs_admin_attendance_view.app.teacherGrid.getStore().setBaseParam("ADVIIDNO", record.get("id"));
			ogs_admin_attendance_view.app.adviserSummaryGrid.getStore().setBaseParam("ADVIIDNO", record.get("id"));
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
                                    if (Ext.get('SEMEIDNO2').dom.value == "")
									return false;

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
			resizable: true,
			readOnly: false,
			minListWidth: 300,
			allowBlank: false,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id'}, {name: 'name'}, {name: 'description'}],
			url: "<?php echo site_url("admin/getSubjectCombo"); ?>",
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
                        ogs_admin_attendance_view.app.teacherGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));
                   //     ogs_admin_attendance_view.app.topTenGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));


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
        scheduleCombo: function(){

		return {
			xtype:'combo',
			id:'schedule',
			hiddenName: 'scheduleId',
			name: 'scheduleName',
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
			fields:[{name: 'id', type:'int', mapping:'id'}, {name: 'name', type:'string', mapping: 'name'}, {name: 'room'}],
			url: "<?php echo site_url("ogs_admin_attendance_viewing/getSchedule"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
                        beforequery: function(qe)
					{
                                    if (Ext.getCmp('teacherSubject').getValue() == "")
							return false;
							delete qe.combo.lastQuery;
				    this.store.baseParams = {id: Ext.getCmp('teacherSubject').getValue()};
						
			          
					},

			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			//Ext.get(this.hiddenName).dom.value  = record.get('id');
                        Ext.getCmp("teacherRoom").setValue(record.get('room'));

			},
			blur: function(){
			var val = this.getRawValue();
			this.setRawValue.defer(1, this, [val]);
			this.validate();
			},
			render: function() {
			this.el.set({qtip: 'Type at least ' + this.minChars + ' characters to search for a schedule'});

			},
			keypress: {buffer: 100, fn: function() {
			//Ext.get(this.hiddenName).dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Schedule*'

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
			url: "<?php echo site_url("admin/getSubjectCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
                        beforequery: function()
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
                        ogs_admin_attendance_view.app.teacherGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));
                    //    ogs_admin_attendance_view.app.topTenGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));


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
                        beforequery: function()
					{

                                        Ext.get("SUBJIDNO3").dom.value  = '';
                                    Ext.getCmp("SUBJECT3").setRawValue("");
                              
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
			resizable: true,
			readOnly: false,
			minListWidth: 300,
			allowBlank: false,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id'}, {name: 'name'}, {name: 'description'}, {name: 'UNITS_TTL'}],
			url: "<?php echo site_url("admin/getSubjectCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
                        beforequery: function()
					{
						if (Ext.get("SEMEIDNO3").dom.value == "")
							return false;

				    this.store.baseParams = {semester_id: Ext.get("SEMEIDNO3").dom.value};

			            var o = {start: 0, limit:10};
			            this.store.baseParams = this.store.baseParams || {};
			            this.store.baseParams[this.paramName] = '';
			            this.store.load({params:o, timeout: 300000});
					},

			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
                        Ext.getCmp("COURSEDESC3").setValue(record.get('description'));
                        Ext.getCmp("UNITS_TTL3").setValue(record.get('UNITS_TTL'));
                        ogs_admin_attendance_view.app.subjectGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));
                        ogs_admin_attendance_view.app.subjectSummaryGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));


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
                                case true: fmtVal = '<span style="color: green; font-weight: bold;">PRESENT</span>'; break;
                                case false : fmtVal = '<span style="color: red; font-weight: bold;">ABSENT</span>'; break;
				case "PRESENT"	: 	fmtVal = '<span style="color: green; font-weight: bold;">'+val+'</span>'; break;
			 	case "ABSENT"	:  	fmtVal = '<span style="color: red; font-weight: bold;">'+val+'</span>'; break;

			}

			return fmtVal;
		}//end of functions
 	}

 }();

 Ext.onReady(ogs_admin_attendance_view.app.init, ogs_admin_attendance_view.app);

</script>

<div id="mainBody">
</div>