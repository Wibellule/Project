
/**************************************
    Webutler V2.2 - www.webutler.de
    Copyright (c) 2008 - 2012
    Autor: Sven Zinke
    Free for any use
    Lizenz: GPL
**************************************/
/*var InternPagesSelectBox = new Array( 
	new Array( '', '' ), 
	new Array( 'Fichier 1', 'index.php?page=fichier1' ), 
	new Array( 'Fichier 2', 'index.php?page=fichier2' ), 
	new Array( 'Fichier 3', 'index.php?page=fichier3' )
);*/

(function()
{
    CKEDITOR.plugins.add('internpage', {lang : [CKEDITOR.lang.detect(CKEDITOR.config.language)]});
    //CKEDITOR.scriptLoader.load(internpageLink);
    
    ///////////////////////////////////////////////////////////////////////
    //   Récupération des données sur lesquelles on peut faire un lien   //	
    var sHref = window.location.href;
	var iSubStringPosition = sHref.indexOf('adm/', 0) + 4;
	var sUrl = sHref.substr(0, iSubStringPosition);
	
	var InternPagesSelectBox = new Array();
	$.post(sUrl + 'categories/ajax_get_pages.html', function(aData) {
			
		$.each(aData, function(sEntryIndex, aEntryValue) {
			
			var x = new Array(sEntryIndex, aEntryValue);
			InternPagesSelectBox.push(x); 
		});
	}, 'json');    
    ///////////////////////////////////////////////////////////////////////
	
    CKEDITOR.on('dialogDefinition', function(ev) {
    
    	var dialogName = ev.data.name;
    	var dialogDefinition = ev.data.definition;
    	var editor = ev.editor;
    	
		if( dialogName == 'link') {
			
			var infoTab = dialogDefinition.getContents('info');
            
            infoTab.add({
            	type : 'select',
    			id : 'intern',
    			label : 'Liens internes',
    			'default' : '',
    			style : 'width:100%',
    			items : InternPagesSelectBox,
    			onChange : function() {
    			
                    var d = CKEDITOR.dialog.getCurrent();
                    d.setValueOf('info', 'url', this.getValue());
                    d.setValueOf('info', 'protocol', !this.getValue() ? 'http://' : '');
                },
    			setup : function(data) {
    			
    				this.allowOnChange = false;
    				this.setValue( data.url ? data.url.url : '' );
    				this.allowOnChange = true;
    			}
            }, 'browse' );
            
            dialogDefinition.onLoad = function() {
                var internField = this.getContentElement('info', 'intern');
                internField.reset();
            };
    	}
    });
})();