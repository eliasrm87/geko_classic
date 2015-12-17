(function() {
    tinymce.create('tinymce.plugins.GekoImageBox', {
        init : function(editor, url) {
            // Add a button that opens a window
            editor.addButton('gekoimagebox', {
                title: 'Insert ImageBox',
                image: url+'/../img/imagebox.png',
                onclick: function() {
                    // Open window
                    var win = editor.windowManager.open({
                        title: 'Insert ImageBox',
                        body: [
                            {type: 'textbox', name: 'title', label: 'Title:'},
                            {type: 'textbox', name: 'text', label: 'Text:'},
                            {type: 'textbox', name: 'link', label: 'Link:'},
                            
                            {type: 'colorpicker', name: 'bcolor', label: 'Background color:',
                                onchange: function() {
                                    win.find('#bhex').value(this.value());
                                }
                            },
                            {type: 'textbox', name: 'bhex',
                                onchange: function() {
                                    win.find('#bcolor').value(this.value());
                                }
                            },
                            
                            {type: 'colorpicker', name: 'fcolor', label: 'Font color:',
                                onchange: function() {
                                    win.find('#fhex').value(this.value());
                                }
                            },
                            {type: 'textbox', name: 'fhex',
                                onchange: function() {
                                    fcolor.setColor(this.value());
                                }
                            },
                        ],
                        onsubmit: function(e) {
                            // Insert content when the window form is submitted
                            // http://archive.tinymce.com/wiki.php/api4:namespace.tinymce.ui
                            editor.insertContent('<p>[image-box title="'+e.data.title+'" text="'+e.data.text+'" link="'+e.data.link+'" bcolor="'+e.data.bhex+'" color="'+e.data.fhex+'"]</p><p>Put your image here...</p><p>[/image-box]</p>');
                        }
                    });
                }
            });

            // Adds a menu item to the tools menu
            editor.addMenuItem('gekoimagebox', {
                text: 'Geko ImageBox',
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
                longname : "ImageBox Shortcode",
                author : 'Elías Rodríguez Martín',
                authorurl : 'http://eliasrm.es/',
                infourl : 'http://igeko.es/',
                version : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('gekoimagebox', tinymce.plugins.GekoImageBox);
})();
