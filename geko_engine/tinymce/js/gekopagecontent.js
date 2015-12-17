(function() {
    tinymce.create('tinymce.plugins.GekoPageContent', {
        init : function(editor, url) {
            // Add a button that opens a window
            editor.addButton('gekopagecontent', {
                title: 'Show other page content',
                image: url+'/../img/gekopagecontent.png',
                onclick: function() {
                    // Open window
                    editor.windowManager.open({
                        title: 'Show other page content',
                        body: [
                            {type: 'form', items: [
                                {type: 'combobox', name: 'id', label: 'Page id:',
                                    values: geko_pagecontent_ids,
                                },
                            ]}
                        ],
                        onsubmit: function(e) {
                            // Insert content when the window form is submitted
                            editor.insertContent('[page-content id="'+e.data.id+'"]');
                        }
                    });
                }
            });

            // Adds a menu item to the tools menu
            editor.addMenuItem('gekopagecontent', {
                text: 'Show other page content',
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
                longname : "Show other page content",
                author : 'Elías Rodríguez Martín',
                authorurl : 'http://eliasrm.es/',
                infourl : 'http://igeko.es/',
                version : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('gekopagecontent', tinymce.plugins.GekoPageContent);
})();
