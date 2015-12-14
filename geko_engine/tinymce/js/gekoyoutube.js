(function() {
    tinymce.create('tinymce.plugins.GekoYouTube', {
        init : function(editor, url) {
            // Add a button that opens a window
            editor.addButton('gekoyoutube', {
                title: 'Insert YouTube video',
                image: url+'/../img/youtube.png',
                onclick: function() {
                    // Open window
                    editor.windowManager.open({
                        title: 'Insert YouTube video',
                        body: [
                            {type: 'textbox', name: 'url', label: 'Video ID or URL:'}
                        ],
                        onsubmit: function(e) {
                            idPattern = /(?:(?:[^v]+)+v.)?([^&=]{11})(?=&|$)/;
                            var m = idPattern.exec(e.data.url);
                            if (m != null && m != 'undefined')
                            // Insert content when the window form is submitted
                            editor.insertContent('[embed-responsive src="http://www.youtube.com/embed/'+m[1]+'" aspect="16:9" allowfullscreen="allowfullscreen"]');
                        }
                    });
                }
            });

            // Adds a menu item to the tools menu
            editor.addMenuItem('gekoyoutube', {
                text: 'Geko YouTube',
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
                longname : "YouTube Shortcode",
                author : 'Elías Rodríguez Martín',
                authorurl : 'http://eliasrm.es/',
                infourl : 'http://igeko.es/',
                version : "1.0"
            };
        }
    });
    tinymce.PluginManager.add('gekoyoutube', tinymce.plugins.GekoYouTube);
})();
