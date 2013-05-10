
/**************************************
    Webutler V2.2 - www.webutler.de
    Copyright (c) 2008 - 2012
    Autor: Sven Zinke
    Free for any use
    Lizenz: GPL
**************************************/


( function()
{
    CKEDITOR.plugins.add( 'internpage', { lang : [CKEDITOR.lang.detect(CKEDITOR.config.language)] } );
    CKEDITOR.scriptLoader.load( CKEDITOR.plugins.getPath( 'internpage' ) + 'pages.php' );
    
    CKEDITOR.on( 'dialogDefinition', function( ev )
    {
    	var dialogName = ev.data.name;
    	var dialogDefinition = ev.data.definition;
    	var editor = ev.editor;
    	
    	if ( dialogName == 'link' )
    	{
            var infoTab = dialogDefinition.getContents('info');
            
            infoTab.add( {
    			type : 'select',
    			id : 'intern',
    			label : editor.lang.internpage.internpage,
    			'default' : '',
    			style : 'width:100%',
    			items : InternPagesSelectBox,
    			/*
    			onLoad : function ()
    			{
    				this.allowOnChange = true;
    			},
    			*/
    			onChange : function()
                {
                    var d = CKEDITOR.dialog.getCurrent();
                    d.setValueOf('info', 'url', this.getValue());
                    d.setValueOf('info', 'protocol', !this.getValue() ? 'http://' : '');
                },
    			setup : function( data )
    			{
    				this.allowOnChange = false;
    				/*
    				if ( data.url )
    					this.setValue( data.url.url );
    				*/
    				this.setValue( data.url ? data.url.url : '' );
    				this.allowOnChange = true;
    			}
                /*
                ,
    			commit : function( data )
    			{
    				this.onChange();
    				if ( !data.url )
    					data.url = {};
    				
        			var dialog = this.getDialog();
        			var urlValue = dialog.getContentElement( 'info', 'url' );
    				data.url.url = urlValue.getValue();
    				this.allowOnChange = false;
    			}
                */
            }, 'browse' );
            /*
            dialogDefinition.onFocus = function()
            {
                var urlField = this.getContentElement( 'info', 'url' );
                urlField.select();
            };
            */
            dialogDefinition.onLoad = function()
            {
                var internField = this.getContentElement( 'info', 'intern' );
                internField.reset();
            };
    	}
    });
})();

