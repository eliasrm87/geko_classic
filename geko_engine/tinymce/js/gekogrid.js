(function() {
    tinymce.create('tinymce.plugins.GekoGrid', {
        init : function(editor, url) {
            // Add a button that opens a window
            editor.addButton('gekogrid', {
                title: 'Insert responsive grid',
                image: url+'/../img/gekogrid.png',
                onclick: function() {
                    // Open window
                    editor.windowManager.open({
                        title: 'Insert responsive grid',
                        body: [
                            {type: 'form', items: [
                                {type: 'label', text: 'Rows:', style: 'font-weight: bold;'},
                                {type: 'form', items: [
                                    {type: 'textbox', name: 'rows', label: 'Number:'},
                                    {type: 'checkbox', name: 'nogutter', label: 'No gutter:'},
                                    {type: 'textbox', name: 'rowclass', label: 'Class:'},
                                    {type: 'textbox', name: 'rowstyle', label: 'Style:'},
                                ]},
                                {type: 'label', text: 'Columns:', style: 'font-weight: bold;'},
                                {type: 'form', items: [
                                    {type: 'combobox', name: 'cols', label: 'Number:',
                                        values: [
                                            { text: '1', value: '1' },
                                            { text: '2', value: '2' },
                                            { text: '3', value: '3' },
                                            { text: '4', value: '4' },
                                            { text: '6', value: '6' },
                                            { text: '12', value: '12' }
                                        ],
                                    },
                                    {type: 'textbox', name: 'colclass', label: 'Class:'},
                                    {type: 'textbox', name: 'colstyle', label: 'Style:'},
                                ]}
                            ]}
                        ],
                        onsubmit: function(e) {
                            // Insert content when the window form is submitted
                            // http://archive.tinymce.com/wiki.php/api4:namespace.tinymce.ui
                            var content = '';
                            
                            var rowParams = '';
                            if (e.data.nogutter == true)
                                rowParams += 'no_gutter="true" ';
                            if (e.data.rowclass != '')
                                rowParams += 'class="'+e.data.rowclass+'" ';
                            if (e.data.rowstyle != '')
                                rowParams += 'style="'+e.data.rowstyle+'" ';
                            
                            var colParams = 'width_auto="'+e.data.cols+'" ';
                            if (e.data.colclass != '')
                                colParams += 'class="'+e.data.colclass+'" ';
                            if (e.data.colstyle != '')
                                colParams += 'style="'+e.data.colstyle+'" ';
                            
                            for (var i = 0; i < e.data.rows; i++) {
                                content += '<p>[row ' + rowParams + ']</p>';
                                for (var j = 0; j < e.data.cols; j++) {
                                    content += '<p>[col ' + colParams + ']</p>';
                                    content += '<p>...</p>';
                                    content += '<p>[/col]</p>';
                                }
                                content += '<p>[/row]</p><p></p>';
                            }
                            
                            editor.insertContent(content);
                        }
                    });
                }
            });

            // Adds a menu item to the tools menu
            editor.addMenuItem('gekogrid', {
                text: 'Geko responsive grid',
                context: 'tools',
                onclick: function() {
                    // Open window with a specific url
                    editor.windowManager.open({
                        title: 'Igeko site',
                        url: 'http://www.igeko.es',
                        width: 800,
                        height: 600,
                        buttons: [{
                            text: 'Close',
                            onclick: 'close'
                        }]
                    });
                }
            });
        },
        
        createControl : function(n, cm) {
            return null;
        },
        
        getInfo : function() {
            return {
                longname : "Responsive grid Shortcode",
                author : 'Elías Rodríguez Martín',
                authorurl : 'http://eliasrm.es/',
                infourl : 'http://igeko.es/',
                version : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('gekogrid', tinymce.plugins.GekoGrid);
})();
