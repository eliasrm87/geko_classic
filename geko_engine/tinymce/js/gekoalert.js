(function() {
    tinymce.create('tinymce.plugins.GekoAlert', {
        init : function(editor, url) {
            // Add a button that opens a window
            editor.addButton('gekoalert', {
                title: 'Insert Alert',
                image: url+'/../img/alert.png',
                onclick: function() {
                    // Open window
                    editor.windowManager.open({
                        title: 'Insert Alert',
                        body: [
                            {type: 'combobox', name: 'type', label: 'Type:',
                                values: [
                                    { text: 'success', value: 'success' },
                                    { text: 'info', value: 'info' },
                                    { text: 'danger', value: 'danger' },
                                    { text: 'warning', value: 'warning' }
                                ],
                            },
                        ],
                        onsubmit: function(e) {
                            // Insert content when the window form is submitted
                            editor.insertContent('<p>[alert type="'+e.data.type+'"]</p><p>Your message here</p><p>[/alert]</p>');
                        }
                    });
                }
            });

            // Adds a menu item to the tools menu
            editor.addMenuItem('gekoalert', {
                text: 'Geko Alert',
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
                longname : "Alert Shortcode",
                author : 'Elías Rodríguez Martín',
                authorurl : 'http://eliasrm.es/',
                infourl : 'http://igeko.es/',
                version : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('gekoalert', tinymce.plugins.GekoAlert);
})();
