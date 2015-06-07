<script type="text/javascript">
 Ext.namespace("ogs_student_view");
 ogs_student_view.app = function()
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
 							url: "<?php echo site_url("admin/getStudentsPerCourse"); ?>",
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
 						baseParams: {start: 0, limit: 25},
 						listners: {
 							load: function(st, rec){
 								ogs_student_view.app.courseSummaryGrid.getStore().load();
 							}
 						}
 					});



 			var grid = new Ext.grid.GridPanel({
 				id: 'ogs_student_viewgrid',
 				height: 335,
 				width: 'auto',
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 						  //{ header: "Id", dataIndex: "id", width: 100, sortable: true},

                                                 { header: "Subject Code", width: 100, sortable: true, dataIndex: "SUBJCODE" },
 												  { header: "Description", width: 200, sortable: true, dataIndex: "COURSEDESC" },
 												  { header: "Units", width: 50, sortable: true, dataIndex: "UNITS_TTL" },
 												  { header: "Adviser", width: 250, sortable: true, dataIndex: "ADVISER" },
                                                  { header: "Id No.", width: 80, sortable: true, dataIndex: "IDNO" },
                                                  { header: "Student Name", width: 300, sortable: true, dataIndex: "NAME" },
                                                  { header: "Course", width: 230, sortable: true, dataIndex: "COURSE" },
                                                  { header: "Year", width: 70, sortable: true, dataIndex: "YEAR" },
                                                  { header: "Section", width: 70, sortable: true, dataIndex: "SECTION" }

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
                            //ogs_student_view.app.Edit();
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


 			ogs_student_view.app.Grid = grid;
			ogs_student_view.app.Grid.store.on('load', function(store, records, options) {
  ogs_student_view.app.courseSummaryGrid.getStore().load({params:{COURIDNO: Ext.get('COURIDNO3').dom.value}});
}, ogs_student_view.app.Grid);
			var courseSummaryStore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?php echo site_url("admin/getCourseSummary"); ?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "courseSummaryStore",
 								totalProperty: "totalCount",
 								fields: [
 											
                                                                                        { name: "DESCRIPTION"},
                                                                                        { name: "TOTAL"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});
 			
 			var courseSummaryGrid = new Ext.grid.GridPanel({
 				id: 'coursesummarygrid',
                 //               title: "Summary",
 				height: 325,
 				width:  'auto',
 				border: true,
 				ds: courseSummaryStore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                                                  { header: "Course", dataIndex: "DESCRIPTION", width: 250, sortable: true},
 						  { header: "Total No. of Students", dataIndex: "TOTAL", width: 110, sortable: true}

 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,

                                 listeners: {
			rowdblclick: function(grid, row, e){
                            //ogs_student_view.app.Edit();
                        }
                        }
 	    	});
            
            ogs_student_view.app.courseSummaryGrid = courseSummaryGrid;
                    

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
	 	 			          items: [ogs_student_view.app.semesterCombo()
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [ogs_student_view.app.courseCombo3()
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
                            if(ExtCommon.util.validateFormFields(_form)){//check if all forms are filled up
                            ogs_student_view.app.Grid.getStore().load({params:{COURIDNO: Ext.get('COURIDNO3').dom.value, SEMEIDNO: Ext.get('SEMEIDNO').dom.value}});
                         //   ogs_student_view.app.courseSummaryGrid.getStore().load({params:{COURIDNO: Ext.get('COURIDNO3').dom.value}});
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

                             items:ogs_student_view.app.Grid

                             },
                             {
                             columnWidth: .33,
                             layout: 'form',
                             style: 'marginLeft: 10px',
                             items: { xtype: 'fieldset', title: 'Summary', anchor: '100%', height: 335, items: [ogs_student_view.app.courseSummaryGrid]}
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
 							url: "<?=site_url("admin/getStudentsPerAdviser")?>",
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

                                        var fm = Ext.form;

 			var teacherGrid = new Ext.grid.GridPanel({
 				id: 'teacherGrid',
 				height: 335,
                               
 				width: 'auto',
 				border: true,
 				ds: teacherStore,
 				cm:  new Ext.grid.ColumnModel(
 						[{ header: "Subject Code", width: 100, sortable: true, dataIndex: "SUBJCODE" },
 												  { header: "Description", width: 200, sortable: true, dataIndex: "COURSEDESC" },
 												  { header: "Units", width: 50, sortable: true, dataIndex: "UNITS_TTL" },
 												  { header: "Adviser", width: 250, sortable: true, dataIndex: "ADVISER" },
                                                  { header: "Id No.", width: 80, sortable: true, dataIndex: "IDNO" },
                                                  { header: "Student Name", width: 300, sortable: true, dataIndex: "NAME" },
                                                  { header: "Course", width: 230, sortable: true, dataIndex: "COURSE" },
                                                  { header: "Year", width: 70, sortable: true, dataIndex: "YEAR" },
                                                  { header: "Section", width: 70, sortable: true, dataIndex: "SECTION" }

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
                            //ogs_student_view.app.Edit();
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

			ogs_student_view.app.teacherGrid = teacherGrid;
			
			ogs_student_view.app.teacherGrid.store.on('load', function(store, records, options) {
  ogs_student_view.app.adviserSummaryGrid.getStore().load();
}, ogs_student_view.app.teacherGrid);

 			var adviserSummaryStore = new Ext.data.Store({
 						proxy: new Ext.data.HttpProxy({
 							url: "<?php echo site_url("admin/getAdviserSummary"); ?>",
 							method: "POST"
 							}),
 						reader: new Ext.data.JsonReader({
 								root: "data",
 								id: "adviserSummaryStore",
 								totalProperty: "totalCount",
 								fields: [
 											
                                                                                        { name: "DESCRIPTION"},
                                                                                        { name: "TOTAL"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});
 			
 			var adviserSummaryGrid = new Ext.grid.GridPanel({
 				id: 'advisersummarygrid',
                 //               title: "Summary",
 				height: 325,
 				width:  'auto',
 				border: true,
 				ds: adviserSummaryStore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                                                  { header: "Adviser", dataIndex: "DESCRIPTION", width: 250, sortable: true},
 						  { header: "Total No. of Students", dataIndex: "TOTAL", width: 125, sortable: true}

 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,

                                 listeners: {
			rowdblclick: function(grid, row, e){
                            //ogs_student_view.app.Edit();
                        }
                        }
 	    	});
                ogs_student_view.app.adviserSummaryGrid = adviserSummaryGrid;
                
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
	 	 			          items: [ogs_student_view.app.semesterCombo2()
                                                      
                                                  
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [ ogs_student_view.app.teacherCombo()
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
                            if(ExtCommon.util.validateFormFields(teacherForm)){//check if all forms are filled up
                            ogs_student_view.app.teacherGrid.getStore().load();
                           // ogs_student_view.app.topTenGrid.getStore().load();
                                }else return;





 	                }
 	            }]
 		    });

                var teacher_window = new Ext.Panel({
 		        width: '100%',
 		        height:510,
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
                             items: { xtype: 'fieldset', title: 'Summary', anchor: '100%', height: 335, items: [ogs_student_view.app.adviserSummaryGrid]}
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
 				height: 285,
 				width: 'auto',
 				border: true,
 				ds: subjectStore,
 				cm:  new Ext.grid.ColumnModel(
 						[						  { header: "Subject Code", width: 100, sortable: true, dataIndex: "SUBJCODE" },
 												  { header: "Description", width: 200, sortable: true, dataIndex: "COURSEDESC" },
 												  { header: "Units", width: 50, sortable: true, dataIndex: "UNITS_TTL" },
 												  { header: "Adviser", width: 250, sortable: true, dataIndex: "ADVISER" },
                                                  { header: "Id No.", width: 80, sortable: true, dataIndex: "IDNO" },
                                                  { header: "Student Name", width: 300, sortable: true, dataIndex: "NAME" },
                                                  { header: "Course", width: 230, sortable: true, dataIndex: "COURSE" },
                                                  { header: "Year", width: 70, sortable: true, dataIndex: "YEAR" },
                                                  { header: "Section", width: 70, sortable: true, dataIndex: "SECTION" }

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
                            //ogs_student_view.app.Edit();
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



 			ogs_student_view.app.subjectGrid = subjectGrid;
 			
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
 				height: 245,
 				width:  'auto',
 				border: true,
 				ds: subjSummaryStore,
 				cm:  new Ext.grid.ColumnModel(
 						[
                                                  { header: "Subject", dataIndex: "DESCRIPTION", width: 250, sortable: true},
 						  { header: "Total No. of Students", dataIndex: "TOTAL", width: 125, sortable: true}

 						]
 				),
 				sm: new Ext.grid.RowSelectionModel({singleSelect:true}),
 	        	loadMask: true,

                                 listeners: {
			rowdblclick: function(grid, row, e){
                            //ogs_student_view.app.Edit();
                        }
                        }
 	    	});
                ogs_student_view.app.subjectSummaryGrid = subjectSummaryGrid;
 			//ogs_student_view.app.Grid.getStore().load({params:{start: 0, limit: 25}});

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
	 	 			          items: [ogs_student_view.app.semesterCombo3(),
	 	 			          ogs_student_view.app.subjectSectionCombo(),
	 	 			          {
                                                               xtype: 'textfield',
                                                               id: 'UNITS_TTL3',
                                                               name: 'UNITS_TTL3',
                                                               anchor: '95%',
                                                               readOnly: true,
                                                               fieldLabel: 'Units'
                                                           }

                                              ]
                                              },
                                              {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [
                                                           
                                                           ogs_student_view.app.subjectCourseCombo(),
                                                           ogs_student_view.app.subjectCombo3()
                                                           
                                              ]
                                              },
                                              {
	 	 			          columnWidth:.33,
	 	 			          layout: 'form',
	 	 			          items: [			ogs_student_view.app.subjectYearCombo(),
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
 		         	text: 'Load Students',
                                icon: '/images/icons/arrow_rotate_clockwise.png',
 	                handler: function () {
                            if(ExtCommon.util.validateFormFields(subjectForm)){//check if all forms are filled up
                            
                                ogs_student_view.app.subjectGrid.getStore().reload();
                                ogs_student_view.app.subjectSummaryGrid.getStore().reload();
				
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
                        items:[subjectForm,  
						{layout: 'column',
                         items:[
                             {columnWidth: .67,
                                 layout: 'form',

                             items:ogs_student_view.app.subjectGrid

                             },
                             {
                             columnWidth: .33,
                             layout: 'form',
                             style: 'marginLeft: 10px',
                             items: { xtype: 'fieldset', title: 'Summary', anchor: '100%', height: 285, items: [ogs_student_view.app.subjectSummaryGrid]}
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
		            {title: 'By Subject', items: subject_window},
		            {title: 'By Course', items: _window},
                            {title: 'By Adviser', items: [teacher_window]}
		        ],
		        listeners: {
		        	tabchange: function(panel, tab){
		        		if(panel.items.indexOf(panel.getActiveTab()) == 0){
		        		_form.form.load({
							url:"<?php echo site_url("admin/loadActiveSemester"); ?>",
							waitMsg:'Loading...',
							success: function(f, action){
								 Ext.getCmp("SEMESTER3").setValue(action.result.data.semester);
                                 Ext.get("SEMEIDNO3").dom.value = action.result.data.SEMEIDNO;
                                 ogs_student_view.app.subjectGrid.getStore().setBaseParam("SEMEIDNO", action.result.data.SEMEIDNO);
                        		 ogs_student_view.app.subjectSummaryGrid.getStore().setBaseParam("SEMEIDNO", action.result.data.SEMEIDNO);
                        		
							}

						});

		        		}else{
		        			if(panel.items.indexOf(panel.getActiveTab()) == 1){
		        			_form.form.load({
							url:"<?php echo site_url("admin/loadActiveSemester"); ?>",
							waitMsg:'Loading...',
							success: function(f, action){
								 Ext.getCmp("semester").setValue(action.result.data.semester);
                                 Ext.get("SEMEIDNO").dom.value = action.result.data.SEMEIDNO;
                                 
                                 ogs_student_view.app.Grid.getStore().setBaseParam("SEMEIDNO", action.result.data.SEMEIDNO);
                        		ogs_student_view.app.courseSummaryGrid.getStore().setBaseParam("SEMEIDNO", action.result.data.SEMEIDNO);
							}

							});
		        			}else{
		        			if(panel.items.indexOf(panel.getActiveTab()) == 2){
		        			_form.form.load({
							url:"<?php echo site_url("admin/loadActiveSemester"); ?>",
							waitMsg:'Loading...',
							success: function(f, action){
								
								Ext.getCmp("semester2").setValue(action.result.data.semester);
                                 Ext.get("SEMEIDNO2").dom.value = action.result.data.SEMEIDNO;
                                 
                                  ogs_student_view.app.teacherGrid.getStore().setBaseParam("SEMEIDNO", action.result.data.SEMEIDNO);
                        		ogs_student_view.app.adviserSummaryGrid.getStore().setBaseParam("SEMEIDNO", action.result.data.SEMEIDNO);
                        		 
								 
                                 
                                 
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
                        ogs_student_view.app.Grid.getStore().setBaseParam("SEMEIDNO", record.get("id"));
                        ogs_student_view.app.courseSummaryGrid.getStore().setBaseParam("SEMEIDNO", record.get("id"));
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
                        ogs_student_view.app.teacherGrid.getStore().setBaseParam("SEMEIDNO", record.get("id"));
                        ogs_student_view.app.adviserSummaryGrid.getStore().setBaseParam("SEMEIDNO", record.get("id"));
                        //ogs_student_view.app.topTenGrid.getStore().setBaseParam("SEMEIDNO", record.get("id"));
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
			ogs_student_view.app.Grid.getStore().setBaseParam("COURIDNO", record.get('id'));

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
	subjectCourseCombo: function(){

		return {
			xtype:'combo',
			id:'SUBJCOURSE',
			hiddenName: 'SUBJCOURIDNO',
                        hiddenId: 'SUBJCOURIDNO',
			name: 'SUBJCOURSE',
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
                                   Ext.get("SUBJIDNO3").dom.value  = '';
                                   Ext.getCmp("SUBJECT3").setRawValue("");
                                   
            					   Ext.get("SUBJSECTIDNO").dom.value  = '';
            					   Ext.getCmp("SUBJSECTION").setRawValue("");
            					   Ext.getCmp("COURSEDESC3").setValue("");
            					   Ext.getCmp("UNITS_TTL3").setValue("");
                                    if (Ext.get('SEMEIDNO3').dom.value == "")
										return false;

			            delete qe.combo.lastQuery;
					},
			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
			ogs_student_view.app.subjectGrid.getStore().setBaseParam("COURIDNO", record.get('id'));
			ogs_student_view.app.subjectSummaryGrid.getStore().setBaseParam("COURIDNO", record.get('id'));

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
            Ext.get("SUBJIDNO3").dom.value  = '';
            Ext.get("SUBJSECTIDNO").dom.value  = '';
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
					delete qe.combo.lastQuery;
				},
			select: function (combo, record, index){
			
                        ogs_student_view.app.Grid.getStore().setBaseParam("STUDIDNO", record.get("STUDIDNO"));
                       
                            Ext.getCmp('studentForm').getForm().load({
				url: '<?php echo site_url("studentProfile/loadStudent"); ?>',
                                params:{id: record.get('id')},
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
			ogs_student_view.app.teacherGrid.getStore().setBaseParam("ADVIIDNO", record.get("id"));
			ogs_student_view.app.adviserSummaryGrid.getStore().setBaseParam("ADVIIDNO", record.get("id"));
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
								delete qe.combo.lastQuery;
                                    Ext.get("SUBJIDNO2").dom.value  = '';
                                    Ext.getCmp("TEACHERSUBJECT").setRawValue("");
                                    if (Ext.get('SEMEIDNO2').dom.value == "")
					return false;

			           
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
                        //Ext.getCmp("COURSE").setValue(record.get('COURSE'));
                        //Ext.getCmp("SECTION").setValue(record.get('SECTION'));
                        ogs_student_view.app.teacherGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));
                   //     ogs_student_view.app.topTenGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));


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
			fields:[{name: 'id'}, {name: 'name'}, {name: 'description'}, {name: 'COURSE'}, {name: 'SECTION'}],
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
                        Ext.getCmp("COURSE").setValue(record.get('COURSE'));
                        Ext.getCmp("SECTION").setValue(record.get('SECTION'));
                        ogs_student_view.app.teacherGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));
                    //    ogs_student_view.app.topTenGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));


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
                        beforequery: function(qe)
					{

                                        Ext.get("SUBJIDNO3").dom.value  = '';
                                    Ext.getCmp("SUBJECT3").setRawValue("");
                                    Ext.get("SUBJSECTIDNO").dom.value  = '';
                                    Ext.getCmp("SUBJSECTION").setRawValue("");
                                    Ext.get("SUBJCOURIDNO").dom.value  = '';
                                    Ext.getCmp("SUBJCOURSE").setRawValue("");
                                    Ext.get("SUBJYEARIDNO").dom.value  = '';
                                    Ext.getCmp("SUBJYEAR").setRawValue("");
                                    
                                    
                                    
                                    Ext.getCmp("UNITS_TTL3").setRawValue("");
                                    Ext.getCmp("COURSEDESC3").setRawValue("");
                                    
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
			resizable: true,
			readOnly: false,
			minListWidth: 300,
			allowBlank: false,
			store: new Ext.data.JsonStore({
			id: 'idsocombo',
			root: 'data',
			totalProperty: 'totalCount',
			fields:[{name: 'id'}, {name: 'name'}, {name: 'description'}, {name: 'UNITS_TTL'}, {name: 'COURSE'}, {name: 'SECTION'}],
			url: "<?php echo site_url("admin/getSubjectCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
                        beforequery: function(qe)
					{
						if (Ext.get("SEMEIDNO3").dom.value == "")
							return false;
					delete qe.combo.lastQuery;
				    this.store.baseParams = {semester_id: Ext.get("SEMEIDNO3").dom.value, COURIDNO: Ext.get("SUBJCOURIDNO").dom.value, SECTIDNO: Ext.get("SUBJSECTIDNO").dom.value, YEAR: Ext.get("SUBJYEARIDNO").dom.value};

			           
					},

			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
                        Ext.getCmp("COURSEDESC3").setValue(record.get('description'));
                        Ext.getCmp("UNITS_TTL3").setValue(record.get('UNITS_TTL'));
                       // Ext.getCmp("COURSE").setValue(record.get('COURSE'));
                       // Ext.getCmp("SECTION").setValue(record.get('SECTION'));
                        ogs_student_view.app.subjectGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));
                        ogs_student_view.app.subjectSummaryGrid.getStore().setBaseParam("SCHEIDNO", record.get('id'));


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
	subjectSectionCombo: function(){

		return {
			xtype:'combo',
			id:'SUBJSECTION',
			hiddenName: 'SUBJSECTIDNO',
                        hiddenId: 'SUBJSECTIDNO',
			name: 'SUBJSECTION',
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
			url: "<?php echo site_url("faculty/getSectionCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {

                        beforequery: function(qe)
					{

                                    Ext.get("SUBJIDNO3").dom.value  = '';
                                   Ext.getCmp("SUBJECT3").setRawValue("");
                                   
            					   
            					   Ext.getCmp("COURSEDESC3").setValue("");
            					   Ext.getCmp("UNITS_TTL3").setValue("");
                                    if (Ext.get('SUBJCOURIDNO').dom.value == "")
										return false;
									delete qe.combo.lastQuery;
									this.store.baseParams = {COURIDNO: Ext.get('SUBJCOURIDNO').dom.value, YEAR: Ext.get('SUBJYEARIDNO').dom.value, SEMEIDNO: Ext.get('SEMEIDNO3').dom.value};
			            
					},
			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
			ogs_student_view.app.subjectGrid.getStore().setBaseParam("SECTIDNO", record.get('id'));
			ogs_student_view.app.subjectSummaryGrid.getStore().setBaseParam("SECTIDNO", record.get('id'));

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
            Ext.get("SUBJIDNO3").dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Section*'

			}
	},
	subjectYearCombo: function(){

		return {
			xtype:'combo',
			id:'SUBJYEAR',
			hiddenName: 'SUBJYEARIDNO',
                        hiddenId: 'SUBJYEARIDNO',
			name: 'SUBJYEAR',
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
			url: "<?php echo site_url("faculty/getYearCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {

                        beforequery: function(qe)
					{
									Ext.get("SUBJSECTIDNO").dom.value  = '';
                                   Ext.getCmp("SUBJSECTION").setRawValue("");
                                    Ext.get("SUBJIDNO3").dom.value  = '';
                                   Ext.getCmp("SUBJECT3").setRawValue("");
                                   
            					   
            					   Ext.getCmp("COURSEDESC3").setValue("");
            					   Ext.getCmp("UNITS_TTL3").setValue("");
                                    if (Ext.get('SUBJCOURIDNO').dom.value == "")
										return false;
									delete qe.combo.lastQuery;
									this.store.baseParams = {COURIDNO: Ext.get('SUBJCOURIDNO').dom.value};
			            
					},
			select: function (combo, record, index){
			this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
			ogs_student_view.app.subjectGrid.getStore().setBaseParam("YEAR", record.get('id'));
			ogs_student_view.app.subjectSummaryGrid.getStore().setBaseParam("YEAR", record.get('id'));

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
            Ext.get("SUBJIDNO3").dom.value  = '';
			if(!this.getRawValue()){
			this.doQuery('', true);
			}
			}}
			},
			fieldLabel: 'Year*'

			}
	}//end of functions
 	}

 }();

 Ext.onReady(ogs_student_view.app.init, ogs_student_view.app);

</script>

<div id="mainBody">
</div>