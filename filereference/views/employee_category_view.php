
<div id="mainBody"></div>
<script type="text/javascript">
    Ext.namespace("employee_category");
    employee_category.app = function()
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
                var fields = [{ name: 'id'}, { name: 'description'}];
                var get_url = "<?php echo site_url('filereference/EmployeeCategory/getIndex') ?>";

                var columns = [{header: "Id", width: 100, sortable: true, dataIndex: 'id'}, {header: "Employee Category", width: 150, sortable: true, dataIndex: 'description'}];
                var title = 'Employee Category';
                var grid = new Application.filereferencegrid({
                    id: "employee_category_grid",
                    url: get_url,
                    fields: fields,
                    columns: columns,
                    addFn: employee_category.app.Add,
                    editFn: employee_category.app.Edit,
                    deleteFn: employee_category.app.Delete
                });

                employee_category.app.Grid = grid;
                employee_category.app.Grid.getStore().load({params:{start: 0, limit: 25}});

                var _window = new Ext.Panel({
                    title: title,
                    width: '100%',
                    height:'auto',
                    renderTo: 'mainBody',
                    draggable: false,
                    layout: 'fit',
                    items: [employee_category.app.Grid],
                    resizable: false
                });

                _window.render();


            },

            setForm: function(){

                var store_url = "<?php echo site_url('filereference/EmployeeCategory/store') ?>";

                var form = new Ext.form.FormPanel({
                    labelWidth: 150,
                    url: store_url,
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
                                fieldLabel: 'Employee Category*',
                                name: 'description',
                                allowBlank:false,
                                anchor:'95%'
                            }


                        ]
                    }
                    ]
                });

                employee_category.app.Form = form;
            },

            Add: function(){

                employee_category.app.setForm();

                var _window;

                _window = new Ext.Window({
                    title: 'New Employee Category',
                    width: 510,
                    height: 160,
                    layout: 'fit',
                    plain:true,
                    modal: true,
                    bodyStyle:'padding:5px;',
                    buttonAlign:'center',
                    items: employee_category.app.Form,
                    buttons: [{
                        text: 'Save',
                        icon: '/images/icons/disk.png',
                        cls:'x-btn-text-icon',
                        handler: function () {
                            if(ExtCommon.util.validateFormFields(employee_category.app.Form)){//check if all forms are filled up
                                employee_category.app.Form.getForm().submit({
                                    success: function(f,action){
                                        Ext.MessageBox.alert('Status', action.result.data);
                                        Ext.Msg.show({
                                            title: 'Status',
                                            msg: action.result.data,
                                            buttons: Ext.Msg.OK,
                                            icon: Ext.Msg.INFO,
                                            width: '100%'
                                        });
                                        ExtCommon.util.refreshGrid(employee_category.app.Grid.getId());
                                        _window.destroy();
                                    },
                                    failure: function(f,a){
                                        Ext.Msg.show({
                                            title: 'Error Alert',
                                            msg: a.result.data,
                                            icon: Ext.Msg.ERROR,
                                            buttons: Ext.Msg.OK,
                                            width: '100%'
                                        });
                                    },
                                    waitMsg: 'Saving Data...'
                                });
                            }else return;
                        }
                    },{
                        text: 'Cancel',
                        icon: '/images/icons/cancel.png',
                        cls:'x-btn-text-icon',
                        handler: function(){
                            _window.destroy();
                        }
                    }]
                });
                _window.show();
            },

            Edit: function(){
                var update_url = "<?php echo site_url('filereference/EmployeeCategory/update') ?>";
                var show_url = "<?php echo site_url('filereference/EmployeeCategory/show') ?>";
                if(ExtCommon.util.validateSelectionGrid(employee_category.app.Grid.getId())){//check if user has selected an item in the grid
                    var sm = employee_category.app.Grid.getSelectionModel().getSelections();
                    var id = sm[0].data.id;

                    employee_category.app.setForm();
                    _window = new Ext.Window({
                        title: 'Update Residency Status',
                        width: 510,
                        height:160,
                        layout: 'fit',
                        plain:true,
                        modal: true,
                        bodyStyle:'padding:5px;',
                        buttonAlign:'center',
                        items: employee_category.app.Form,
                        buttons: [{
                            text: 'Save',
                            icon: '/images/icons/disk.png',
                            cls:'x-btn-text-icon',
                            handler: function () {
                                if(ExtCommon.util.validateFormFields(employee_category.app.Form)){//check if all forms are filled up
                                    employee_category.app.Form.getForm().submit({
                                        url: update_url,
                                        params: {id: id},
                                        method: 'POST',
                                        success: function(f,action){
                                            Ext.MessageBox.alert('Status', action.result.data);
                                            ExtCommon.util.refreshGrid(employee_category.app.Grid.getId());
                                            _window.destroy();
                                        },
                                        failure: function(f,a){
                                            Ext.Msg.show({
                                                title: 'Error Alert',
                                                msg: a.result.data,
                                                icon: Ext.Msg.ERROR,
                                                buttons: Ext.Msg.OK,
                                                width: '100%'
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

                    employee_category.app.Form.getForm().load({
                        url: show_url,
                        method: 'GET',
                        params: {id: id},
                        timeout: 300000,
                        waitMsg:'Loading...',
                        success: function(form, action){
                            _window.show();
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
                var destroy_url = "<?php echo site_url('filereference/EmployeeCategory/destroy') ?>";

                if(ExtCommon.util.validateSelectionGrid(employee_category.app.Grid.getId())){//check if user has selected an item in the grid
                    var sm = employee_category.app.Grid.getSelectionModel().getSelections();

                    var objectJson = { data: new Array() };

                    for (var key in sm){
                        var tmpJson = Ext.util.JSON.encode(sm[key].data);
                        if(tmpJson != null && typeof(tmpJson) != "undefined" && tmpJson != "null"){
                            objectJson.data.push(sm[key].data.id);
                        }

                    }
                    Ext.Msg.show({
                        title:'Delete Selected',
                        msg: 'Are you sure you want to delete the selected records?',
                        buttons: Ext.Msg.OKCANCEL,
                        fn: function(btn, text){
                            if (btn == 'ok'){
                                Ext.Ajax.request({
                                    url: destroy_url,
                                    params:{ id: Ext.util.JSON.encode(objectJson)},
                                    method: "POST",
                                    timeout:300000000,
                                    success: function(responseObj){
                                        var response = Ext.decode(responseObj.responseText);
                                        if(response.success == true)
                                        {
                                            employee_category.app.Grid.getStore().load({params:{start:0, limit: 25}});
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

    Ext.onReady(employee_category.app.init, employee_category.app);

</script>
