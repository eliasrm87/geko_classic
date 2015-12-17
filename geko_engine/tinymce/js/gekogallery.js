(function() {
    tinymce.create('tinymce.plugins.GekoGallery', {
        init : function(editor, url) {
            // Add a button that opens a window
            editor.addButton('gekogallery', {
                title: 'Insert Gallery',
                image: url+'/../img/gallery.png',
                onclick: function() {
                    // Open window
                    editor.insertContent('<p>[geko-gallery]</p><p>Insert your images here...</p><p>[/geko-gallery]</p>');
                }
            });

            // Adds a menu item to the tools menu
            editor.addMenuItem('gekogallery', {
                text: 'Geko Gallery',
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
                longname : "Gallery Shortcode",
                author : 'Elías Rodríguez Martín',
                authorurl : 'http://eliasrm.es/',
                infourl : 'http://igeko.es/',
                version : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('gekogallery', tinymce.plugins.GekoGallery);
})();
