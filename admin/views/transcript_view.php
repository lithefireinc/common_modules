<script type="text/javascript">
 Ext.namespace("ogs_admin_transcript");
 ogs_admin_transcript.app = function()
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
 							url: "<?php echo site_url("student/getTranscript"); ?>",
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
                                                                                        {name: "SEMESTER"}
 										]
 						}),
 						remoteSort: true,
 						baseParams: {start: 0, limit: 25}
 					});



 			var grid = new Ext.grid.GridPanel({
 				id: 'ogs_transcriptgrid',
 				height: 295,
 				width: 'auto',
 				border: true,
 				ds: Objstore,
 				cm:  new Ext.grid.ColumnModel(
 						[
 						  //{ header: "Id", dataIndex: "id", width: 100, sortable: true},
												  { header: "Semester", width: 200, sortable: true, dataIndex: "SEMESTER" },
                                                  { header: "Subject Code", width: 100, sortable: true, dataIndex: "SUBJCODE" },
                                                  { header: "Description", width: 400, sortable: true, dataIndex: "COURSEDESC" },
                                                  { header: "Units", width: 50, sortable: true, dataIndex: "UNITS_TTL" },
                                                 // { header: "Prelim", width: 50, sortable: true, dataIndex: "PRELIM", renderer: this.gradeFormat },
                                                 // { header: "Midterm", width: 50, sortable: true, dataIndex: "MIDTERM", renderer: this.gradeFormat },
                                                 // { header: "Final", width: 50, sortable: true, dataIndex: "FINAL", renderer: this.gradeFormat },
                                                  { header: "Final Grade", width: 100, sortable: true, dataIndex: "AVERAGE", renderer: this.gradeFormat }
                                                //  { header: "Remarks", width: 100, sortable: true, dataIndex: "REMARKS", renderer: this.remarksFormat }

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
                            //ogs_transcript.app.Edit();
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

 			ogs_admin_transcript.app.Grid = grid;
 			//ogs_admin_transcript.app.Grid.getStore().load({params:{start: 0, limit: 25}});
			
			var _form = new Ext.form.FormPanel({
 		        labelWidth: 90,
 		        url:"<?php echo site_url("hr/insertEmployee"); ?>",
 		        method: 'POST',
 		        defaultType: 'textfield',
 		        frame: true,
                        id: 'studentForm',
                       // autoScroll: true,
                       // width: 900,
 		        items: [ //ogs_admin_transcript.app.semesterCombo()
 		        {

 					xtype:'fieldset',

 					width:'auto',
 					height:'auto',
 					items:[
						{
							layout: 'column',
							items: [
							
							{
								columnWidth: .33,
								layout: 'form',
								items: ogs_admin_transcript.app.studentCombo()
							},
							{
								columnWidth: .33,
								layout: 'form',
								items: []
							},
							{
								columnWidth: .33,
								layout: 'form',
								items: []
							}
							]
						},
						{
							layout: 'column',
							items: [
							
							{
								columnWidth: .33,
								layout: 'form',
								items: [{

                                                  xtype:'textfield',
                                                  fieldLabel: 'Course',
                                                  name: 'COURSE',
	 	  	 	 		  //  allowBlank:false,
                                                  readOnly: true,
                                                  anchor:'95%',  // anchor width by percentage
	 	  	 	 		  id: 'COURSE'

                                                  }]
							},
							{
								columnWidth: .33,
								layout: 'form',
								items: [{

                                                  xtype:'textfield',
                                                  fieldLabel: 'Year',
                                                  name: 'YEAR',
	 	  	 	 		  //  allowBlank:false,
                                                  readOnly: true,
                                                  anchor:'95%',  // anchor width by percentage
	 	  	 	 		  id: 'YEAR'

                                                  }]
							},
							{
								columnWidth: .33,
								layout: 'form',
								items: [{

                                                  xtype:'textfield',
                                                  fieldLabel: 'Section',
                                                  name: 'SECTION',
	 	  	 	 		  //  allowBlank:false,
                                                  readOnly: true,
                                                  anchor:'95%',  // anchor width by percentage
	 	  	 	 		  id: 'SECTION'

                                                  }]
							}
							]
						}
						]
				}
 		        ]
 		    });
			
 			var _window = new Ext.Panel({
 		        title: 'Transcript of Records',
 		        width: '100%',
 		        height:420,
 		        renderTo: 'mainBody',
 		        draggable: false,
 		        layout: 'form',
 		        items: [_form, ogs_admin_transcript.app.Grid],
 		        resizable: false

 			    /*listeners : {
 				    	  close: function(p){
 					    	  window.location="../"
 					      }
 			       	} */
 	        });
 	        
 	        

 	        _window.render();


 		},
		studentCombo: function(){

		return {
			xtype:'combo',
			id:'STUDENT',
			hiddenName: 'STUDCODE',
            hiddenId: 'STUDCODE',
			name: 'STUDENT',
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
			fields:[{name: 'id'}, {name: 'name'}, {name: 'STUDIDNO'}, {name: 'SECTION'}, {name: 'COURSE'}, {name: 'YEAR'}],
			url: "<?php echo site_url("filereference/getStudentCombo"); ?>",
			baseParams: {start: 0, limit: 10}

			}),
			listeners: {
			beforequery: function(qe){
				delete qe.combo.lastQuery;
			},	
			select: function (combo, record, index){
			
                    
            this.setRawValue(record.get('name'));
			Ext.get(this.hiddenName).dom.value  = record.get('id');
			Ext.getCmp("SECTION").setValue(record.get('SECTION'));
			Ext.getCmp("COURSE").setValue(record.get('COURSE'));
			Ext.getCmp("YEAR").setValue(record.get('YEAR'));
			ogs_admin_transcript.app.Grid.getStore().setBaseParam("STUDIDNO", record.get("id"));
			ogs_admin_transcript.app.Grid.getStore().load();
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
		}//end of functions
 	}

 }();

 Ext.onReady(ogs_admin_transcript.app.init, ogs_admin_transcript.app);

</script>
<div id="mainBody"></div>
